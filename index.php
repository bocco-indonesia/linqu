<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Customer Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h2 {
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .feedback {
            margin-top: 20px;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <h2>Submit Customer Data</h2>
    <form action="./submit_form.php" method="post">
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required><br>

        <label for="customer_phone">Customer Phone:</label>
        <input type="text" id="customer_phone" name="customer_phone" required><br>

        <label for="customer_email">Customer Email:</label>
        <input type="email" id="customer_email" name="customer_email" required><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
