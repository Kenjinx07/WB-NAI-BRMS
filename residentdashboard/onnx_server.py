from flask import Flask, request, jsonify
import onnxruntime as ort
import numpy as np

app = Flask(__name__)

# Load ONNX Model
onnx_model_path = "NIDmodel.onnx"
session = ort.InferenceSession(onnx_model_path)

@app.route("/predict", methods=["POST"])
def predict():
    try:
        data = request.get_json()
        input_data = np.array(data["input"]).astype(np.float32)  # Adjust input type as needed

        # Prepare input for ONNX model
        input_name = session.get_inputs()[0].name
        result = session.run(None, {input_name: input_data})

        return jsonify({"prediction": result[0].tolist()})
    
    except Exception as e:
        return jsonify({"error": str(e)})

if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)
