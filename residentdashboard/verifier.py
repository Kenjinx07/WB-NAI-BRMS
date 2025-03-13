import onnxruntime as ort
import numpy as np
import requests

# Load models from Hugging Face
model_front_url = "https://huggingface.co/Kenjinx07/NIDmodel/resolve/main/NIDmodel.onnx"
model_back_url = "https://huggingface.co/Kenjinx07/NIDmodel-back/resolve/main/NIDmodel-back.onnx"

# Download and save models locally
for url, file_name in [(model_front_url, "NIDmodel.onnx"), (model_back_url, "NIDmodel-back.onnx")]:
    response = requests.get(url)
    with open(file_name, "wb") as f:
        f.write(response.content)

# Load ONNX models
session_front = ort.InferenceSession("NIDmodel.onnx")
session_back = ort.InferenceSession("NIDmodel-back.onnx")

def verify_image(input_img, validation_img, session):
    input_img = np.expand_dims(input_img, axis=0).astype(np.float32)
    validation_img = np.expand_dims(validation_img, axis=0).astype(np.float32)
    outputs = session.run(None, {"input_embedding": input_img, "validation_embedding": validation_img})
    return outputs[0]
