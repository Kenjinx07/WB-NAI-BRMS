from flask import Flask, request, jsonify
import cv2
import easyocr
import os
import numpy as np
import tensorflow as tf
from tensorflow.keras.models import load_model
from pyzbar.pyzbar import decode

app = Flask(__name__)

class L1Dist(tf.keras.layers.Layer):
    def __init__(self, **kwargs):
        super().__init__()

    def call(self, input_embedding, validation_embedding):
        return tf.math.abs(input_embedding - validation_embedding)

# Load your models
model_front = load_model('models/NIDmodel.keras', custom_objects={'L1Dist': L1Dist, 'BinaryCrossentropy': tf.losses.BinaryCrossentropy})
model_back = load_model('models/NIDmodel-back.keras', custom_objects={'L1Dist': L1Dist, 'BinaryCrossentropy': tf.losses.BinaryCrossentropy})

# EasyOCR reader
reader = easyocr.Reader(['en'])

def preprocess(file_path):
    byte_img = tf.io.read_file(file_path)
    img = tf.io.decode_jpeg(byte_img)
    img = tf.image.resize(img, (100, 100))
    img = img / 255.0
    return img

@app.route('/verify/front', methods=['POST'])
def verify_and_extract_text_front():
    if 'file' not in request.files:
        return jsonify({"error": "No file provided"}), 400
    
    file = request.files['file']
    file_path = os.path.join('uploaded_images', 'front.jpg')
    file.save(file_path)

    # Verification logic
    results = []
    input_img = preprocess(file_path)
    front_verification_dir = os.path.join('application_data', 'verification_images', 'front')
    
    for image in os.listdir(front_verification_dir):
        validation_img = preprocess(os.path.join(front_verification_dir, image))
        result = model_front.predict([np.expand_dims(input_img, axis=0), np.expand_dims(validation_img, axis=0)])
        results.append(result)

    detection = np.sum(np.array(results) > 0.9)
    verification = detection / len(os.listdir(front_verification_dir))
    verified = verification > 0.7

    if verified:
        ocr_results = reader.readtext(file_path)
        extracted_text = " ".join([res[1] for res in ocr_results])
        return jsonify({"extracted_text": extracted_text, "verified": verified}), 200
    else:
        return jsonify({"error": "Verification failed", "verified": verified}), 400

@app.route('/verify/back', methods=['POST'])
def verify_and_extract_text_back():
    if 'file' not in request.files:
        return jsonify({"error": "No file provided"}), 400
    
    file = request.files['file']
    file_path = os.path.join('uploaded_images', 'back.jpg')
    file.save(file_path)

    # Verification logic
    results = []
    input_img = preprocess(file_path)
    back_verification_dir = os.path.join('application_data', 'verification_images', 'back')
    
    for image in os.listdir(back_verification_dir):
        validation_img = preprocess(os.path.join(back_verification_dir, image))
        result = model_back.predict([np.expand_dims(input_img, axis=0), np.expand_dims(validation_img, axis=0)])
        results.append(result)

    detection = np.sum(np.array(results) > 0.9)
    verification = detection / len(os.listdir(back_verification_dir))
    verified = verification > 0.7

    qr_data, qr_verified = verify_qr_and_extract_data(file_path)
    return jsonify({"qr_data": qr_data, "verified": verified}), 200

def verify_qr_and_extract_data(file_path):
    frame = cv2.imread(file_path)
    qr_codes = decode(frame)
    if qr_codes:
        for qr_code in qr_codes:
            qr_data = qr_code.data.decode('utf-8')
            return qr_data, True
    return None, False

if __name__ == '__main__':
    app.run(debug=True)
