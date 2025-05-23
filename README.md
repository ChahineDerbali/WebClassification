# WebClassification

**WebClassification** is a simple PHP-based web interface that allows users to test two different machine learning models:

1. **Iris Flower Classification**
2. **Dog vs Cat Image Classification**

Each model was trained using datasets downloaded from **Kaggle**, and is integrated into the website using Python scripts and model files.

## 🌐 How It Works

- The homepage (`index.php`) allows users to select one of the two models.
- Depending on the choice:
  - **iris.php**: Lets you input flower measurements to classify the iris species.
  - **dogcat.php**: Lets you upload an image of a cat or dog to classify it using a pre-trained model.

## 🧠 Models & Files

- **Iris Classification**
  - `iris_model.py`: Used for prediction
  - `iris_train.py`: Used to train the model

- **Dog vs Cat Classification**
  - `dogcat_model.py`: Used for prediction
  - `train_dogcat_model.py`: Used to train the model


## ⚙️ Tech Stack

- PHP (frontend and backend integration)
- Python (model training and inference)
- Scikit-learn (Iris model)
- TensorFlow/Keras (Dog vs Cat CNN model)
- Kaggle datasets

## 🚀 Getting Started

1. Clone the repo:
   ```bash
   git clone https://github.com/ChahineDerbali/WebClassification.git
   ```
2. Set up a local PHP server (e.g., XAMPP)
3. Make sure Python and the necessary packages are installed
4. Ensure models and scripts are accessible by PHP backend (via shell execution or API)

