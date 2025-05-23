<?php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['image'])) {
    $image = $_FILES['image']['tmp_name'];

    // Command to run the Python script
    $command = escapeshellcmd("python dogcat_model.py " . escapeshellarg($image));
    $raw_output = shell_exec($command);
    $json_start = strpos($raw_output, '{'); // Find where the JSON starts
    if ($json_start !== false) {
        $json_output = substr($raw_output, $json_start); // Extract JSON part
        $result = json_decode($json_output, true);
    } else {
        $result = ["error" => "No valid JSON output from Python script."];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog vs Cat Prediction</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            color: #333;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        h1 {
            margin-top: 20px;
            animation: fadeIn 1.5s ease-in-out;
        }
        form {
            margin: 50px auto;
            padding: 20px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-in-out;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
        }
        input[type="file"] {
            padding: 10px;
            width: calc(100% - 22px);
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        button {
            padding: 10px 20px;
            background: #007BFF;
            border: none;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }
        button:hover {
            background: #0056b3;
        }
        .result {
            margin-top: 20px;
            font-size: 18px;
            animation: fadeIn 1.5s ease-in-out;
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
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>
    <h1>Dog vs Cat Image Prediction</h1>
    <?php if (!empty($result)): ?>
        <div class="result">
            <?php if (isset($result['error'])): ?>
                <p>Error: <?= htmlspecialchars($result['error']) ?></p>
            <?php else: ?>
                <p><strong>Prediction:</strong> <?= htmlspecialchars($result['label']) ?></p>
                <p><strong>Confidence:</strong> <?= round($result['confidence'] * 100, 2) ?>%</p>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="image">Upload an image:</label>
        <input type="file" name="image" id="image" accept="image/*" required>
        <button type="submit">Predict</button>
    </form>

    <a href="index.php" class="return-btn">Return to Main Page</a>
</body>
</html>
