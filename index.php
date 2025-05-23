<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prediction Website</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 50px;
        }
        .option {
            margin: 20px;
            padding: 15px;
            border: 2px solid #007BFF;
            border-radius: 10px;
            display: inline-block;
            text-decoration: none;
            color: #007BFF;
            font-size: 18px;
            font-weight: bold;
        }
        .option:hover {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Welcome to the Prediction Website</h1>
    <p>Choose the type of prediction you want to perform:</p>
    <a href="iris.php" class="option">Iris Prediction</a>
    <a href="dogcat.php" class="option">Dog vs. Cat Classification</a>
</body>
</html>
