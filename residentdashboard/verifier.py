import cv2
import easyocr
import os
import numpy as np
import tensorflow as tf
from tensorflow.keras.models import load_model
from pyzbar.pyzbar import decode

class L1Dist(tf.keras.layers.Layer):
    def __init__(self, **kwargs):
        super().__init__()

    def call(self, input_embedding, validation_embedding):
        return tf.math.abs(input_embedding - validation_embedding)

model_front = load_model('NIDmodel.keras', custom_objects={'L1Dist': L1Dist, 'BinaryCrossentropy': tf.losses.BinaryCrossentropy})
model_back = load_model('NIDmodel-back.keras', custom_objects={'L1Dist': L1Dist, 'BinaryCrossentropy': tf.losses.BinaryCrossentropy})

def preprocess(file_path):
    byte_img = tf.io.read_file(file_path)
    img = tf.io.decode_jpeg(byte_img)
    img = tf.image.resize(img, (100, 100))
    img = img / 255.0
    return img

reader = easyocr.Reader(['en'])

def verify_and_extract_text_front(frame, model_front, detection_threshold=0.9, verification_threshold=0.7):
    results = []

    for image in os.listdir(os.path.join('application_data', 'verification_images', 'front')):
        input_img = preprocess(os.path.join('application_data', 'input_image', 'front', 'input_image_front.jpg'))
        validation_img = preprocess(os.path.join('application_data', 'verification_images', 'front', image))

        result = model_front.predict([np.expand_dims(input_img, axis=0), np.expand_dims(validation_img, axis=0)])
        results.append(result)

    detection = np.sum(np.array(results) > detection_threshold)
    verification = detection /  len(os.listdir(os.path.join('application_data', 'verification_images', 'front')))
    verified = verification > verification_threshold

    if verified:
        ocr_results = reader.readtext(frame)
        extracted_text = " ".join([res[1] for res in ocr_results])
        return extracted_text, verified
    else:
        return None, verified

def verify_and_extract_text_back(frame, model_back, detection_threshold=0.9, verification_threshold=0.7):
    results = []

    for image in os.listdir(os.path.join('application_data','verification_images', 'back')):
        input_img = preprocess(os.path.join('application_data', 'input_image', 'back','input_image_back.jpg'))
        validation_img = preprocess(os.path.join('application_data', 'verification_images', 'back', image))

        result = model_back.predict([np.expand_dims(input_img, axis=0), np.expand_dims(validation_img, axis=0)])
        results.append(result)
        
    detection = np.sum(np.array(results) > detection_threshold)
    verification = detection /  len(os.listdir(os.path.join('application_data', 'verification_images', 'back')))
    verified = verification > verification_threshold

    if verified:
        ocr_results = reader.readtext(frame)
        extracted_text = " ".join([res[1] for res in ocr_results])
        return extracted_text, verified
    else:
        return None, verified
    
def verify_qr_and_extract_data(frame):
    qr_codes = decode(frame)
    if qr_codes:
        for qr_code in qr_codes:
            qr_data = qr_code.data.decode('utf-8')
            return qr_data, True
    return None, False

cap = cv2.VideoCapture(0)
while cap.isOpened():
    ret, frame = cap.read()
    frame = frame[:1080, :1920, :]

    cv2.imshow('verification', frame)

    if cv2.waitKey(5) & 0xFF == ord('v'):
        cv2.imwrite(os.path.join('application_data', 'input_image', 'front', 'input_image_front.jpg'), frame)
        extracted_text, verified = verify_and_extract_text_front(frame, model_front, detection_threshold=0.9, verification_threshold=0.7)
        if verified:
            print("Front Verified and Extracted Text:", extracted_text)
        else:
            print("Front Verification failed")

    elif cv2.waitKey(5) & 0xFF == ord('b'):
        cv2.imwrite(os.path.join('application_data', 'input_image', 'back', 'input_image_back.jpg'), frame)
        qr_data, verified = verify_qr_and_extract_data(frame)
        if verified:
            extracted_text, verified = verify_and_extract_text_back(frame, model_back, detection_threshold=0.9, verification_threshold=0.7)
            print("Back QR Code Verified and Extracted Data:", extracted_text, qr_data)
        else:
            print("Back Verification failed")

    if cv2.waitKey(5) & 0xFF == ord('q'):
        break

cap.release()
cv2.destroyAllWindows()
