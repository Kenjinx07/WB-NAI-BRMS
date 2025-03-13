from flask import Flask, request, jsonify
import numpy as np
import cv2
import onnxruntime as ort

app = Flask(__name__)

session_front = ort.InferenceSession("NIDmodel.onnx")
session_back = ort.InferenceSession("NIDmodel-back.onnx")

def preprocess_image(image):
    image = cv2.resize(image, (100, 100)) / 255.0
    return image.astype(np.float32)

@app.route('/verify', methods=['POST'])
def verify():
    front_img = request.files['front_image']
    back_img = request.files['back_image']

    # Read images
    front_np = preprocess_image(cv2.imdecode(np.fromstring(front_img.read(), np.uint8), cv2.IMREAD_COLOR))
    back_np = preprocess_image(cv2.imdecode(np.fromstring(back_img.read(), np.uint8), cv2.IMREAD_COLOR))

    # Verify
    front_result = session_front.run(None, {"input_embedding": front_np, "validation_embedding": front_np})
    back_result = session_back.run(None, {"input_embedding": back_np, "validation_embedding": back_np})

    return jsonify({"front_verification": front_result[0].tolist(), "back_verification": back_result[0].tolist()})

if __name__ == '__main__':
    app.run(debug=True)
