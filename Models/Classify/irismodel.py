import sys
import numpy as np
import joblib

# Load the trained model
model = joblib.load("iris_model.pkl")

# Define the mapping from numerical predictions to Iris species names
species_mapping = {
    0: 'Setosa',
    1: 'Versicolor',
    2: 'Virginica'
}

# Function to classify Iris species based on input features
def classify_iris(features):
    features = np.array(features).reshape(1, -1)
    prediction = model.predict(features)
    return species_mapping[prediction[0]]  # Map the prediction to the species name

if __name__ == "__main__":
    # Get the input features from the command line arguments
    input_features = [float(x) for x in sys.argv[1:5]]
    
    # Classify and get the Iris species name
    result = classify_iris(input_features)
    
    # Print the result (species name)
    print(result)  # This should be the species name, not the numeric prediction
