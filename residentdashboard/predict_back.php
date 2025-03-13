<?php
$data = json_encode(["input" => [[0.1, 0.2, 0.3, 0.4]]]); // Replace with actual input

$ch = curl_init("http://localhost:5000/predict");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

$response = curl_exec($ch);
curl_close($ch);

echo "ONNX Model Prediction: " . $response;
?>
