import sys
import json
import numpy as np
from tensorflow.keras.models import load_model
from tensorflow.keras.preprocessing.image import load_img, img_to_array
import os
import tensorflow as tf
os.environ['TF_CPP_MIN_LOG_LEVEL'] = '3'  # Suppresses INFO and WARNING messages
tf.get_logger().setLevel('ERROR')  # Suppresses additional TensorFlow logs

# Load the trained model
model = load_model('dogcat_model.h5')  # Replace with your .h5 file name



# Define a function for prediction
def predict_image(image_path):
    # Load the image with the target size matching the model's input size
    img = load_img(image_path, target_size=(150, 150))  # Adjust size as per your model
    img_array = img_to_array(img)
    img_array = np.expand_dims(img_array, axis=0)  # Add batch dimension
    img_array = img_array / 255.0  # Normalize pixel values

    # Predict
    prediction = model.predict(img_array)
    class_label = "dog" if prediction[0] > 0.5 else "cat"
    confidence = prediction[0][0] if prediction[0] > 0.5 else 1 - prediction[0][0]
    
    return {"label": class_label, "confidence": float(confidence)}

# Get image path from command-line arguments
if len(sys.argv) > 1:
    image_path = sys.argv[1]
    result = predict_image(image_path)
    print(json.dumps(result))  # Return result as JSON
else:
    print(json.dumps({"error": "No image path provided"}))
