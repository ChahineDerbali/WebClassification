<?php
$result = ""; // Initialize the result variable

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "predictions";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $sepal_length = $_POST["sepal_length"];
    $sepal_width = $_POST["sepal_width"];
    $petal_length = $_POST["petal_length"];
    $petal_width = $_POST["petal_width"];

    // Command to run the Python script with inputs
    // Ensure correct handling of the command
    $command = escapeshellcmd("python irismodel.py $sepal_length $sepal_width $petal_length $petal_width");
    $output = shell_exec($command);  // This will be the flower name

    // Capture the result
    $result = "The predicted Iris species is: <strong>$output</strong>";

    // Prepare the SQL query to insert data into the database
    $stmt = $conn->prepare("INSERT INTO iris_predictions (sepal_length, sepal_width, petal_length, petal_width, prediction) 
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ddddd", $sepal_length, $sepal_width, $petal_length, $petal_width, $output);

    // Execute the query
    if ($stmt->execute()) {
        // Successfully inserted into the database
        $result .= "<br><strong>Prediction saved to the database!</strong>";
    } else {
        // Failed to insert
        $result .= "<br><strong>Error saving prediction to the database.</strong>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iris Flower Classification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }
        h1 {
            color: #333333;
            margin-bottom: 20px;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
            font-weight: bold;
            color: #555555;
        }
        input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #dddddd;
            border-radius: 4px;
            font-size: 14px;
        }
        button {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .result {
            margin-top: 20px;
            color: #333333;
            font-size: 16px;
        }
        .return-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background: #28a745;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
        }
        .return-btn:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Iris Flower Classification</h1>
        <form method="POST" action="">
            <label for="sepal_length">Sepal Length:</label>
            <input type="number" step="0.01" name="sepal_length" id="sepal_length" required>

            <label for="sepal_width">Sepal Width:</label>
            <input type="number" step="0.01" name="sepal_width" id="sepal_width" required>

            <label for="petal_length">Petal Length:</label>
            <input type="number" step="0.01" name="petal_length" id="petal_length" required>

            <label for="petal_width">Petal Width:</label>
            <input type="number" step="0.01" name="petal_width" id="petal_width" required>

            <button type="submit">Classify</button>
        </form>

        <!-- Display the result -->
        <?php if ($result): ?>
            <div class="result">
                <?php echo $result ; ?>
            </div>
        <?php endif; ?>
        <br>

        <!-- Return to Main Page Button -->
        <a href="index.php" class="return-btn">Return to Main Page</a>
    </div>
</body>
</html>
