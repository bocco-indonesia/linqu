<!DOCTYPE html>
<html>
<head>
    <title>API Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            overflow: auto;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }
        input[type="text"], input[type="email"], select {
            width: calc(100% - 22px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"], button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #5cb85c;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            margin-top: 10px;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #4cae4c;
        }
        .generate-container {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        .generate-container input {
            flex: 1;
            margin-right: 10px;
        }
        .generate-container button {
            flex: 0;
            width: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .table-container {
            margin-top: 20px;
            width: 100%;
            max-width: 1000px;
        }
        @media (max-width: 768px) {
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            th, td {
                display: block;
                width: 100%;
                box-sizing: border-box;
            }
            th::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
            }
            td::before {
                content: attr(data-label);
                float: left;
                font-weight: bold;
                text-transform: uppercase;
            }
            td {
                text-align: left;
                padding-left: 50%;
            }
            .copy-button {
                display: inline-block;
                margin-top: 5px;
                padding: 5px 10px;
                background-color: #007bff;
                color: white;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }
            .copy-button:hover {
                background-color: #0056b3;
            }
        }
        @media (max-width: 480px) {
            .container {
                padding: 10px;
            }
            input[type="text"], input[type="email"], select, button {
                font-size: 14px;
            }
            input[type="submit"], button {
                padding: 8px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>API Request Form</h1>
        <form action="process_request.php" method="post">
            <label for="client-id">Client ID:</label>
            <input type="text" id="client-id" name="client-id" value="your client id">

            <label for="client-secret">Client Secret:</label>
            <input type="text" id="client-secret" name="client-secret" value="your client secret">

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="your username">

            <label for="pin">PIN:</label>
            <input type="text" id="pin" name="pin" value="your pin">

            <label for="signkey">Signature key:</label>
            <input type="text" id="signkey" name="signkey" value=" server key or signature key">

            <label for="bank-code">Bank Code:</label>
            <select id="bank-code" name="bank-code">
                <option value="013">Permata</option>
                <option value="008">MANDIRI</option>
                <!-- <option value="009">BNI</option> -->
                <option value="002">BRI</option>
                <option value="451">BSI</option>
                <!-- <option value="022">CIMB</option> -->
                <option value="011">Danamon</option>
                <option value="490">BNC</option>
                <option value="028">OCBC</option>
                <option value="147">MUAMALAT</option>
            </select>

            <label for="customer-id">Customer ID:</label>
            <div class="generate-container">
                <input type="text" id="customer-id" name="customer-id" placeholder="Customer ID">
                <button type="button" onclick="generateRandomNumber()">Generate</button>
            </div>

            <label for="customer-name">Customer Name:</label>
            <input type="text" id="customer-name" name="customer-name">

            <label for="customer-email">Customer Email:</label>
            <input type="email" id="customer-email" name="customer-email">

            <input type="submit" value="Submit">
        </form>
    </div>

    <div class="table-container">
        <h1>Saved Responses</h1>
        <table>
            <thead>
                <tr>
                    <th>Partner Reff</th>
                    <th>Virtual Account</th>
                    <th>Bank Name</th>
                    <th>Bank Code</th>
                    <th>Customer Email</th>
                    <th>Fee Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Path to the JSON file
                $file_path = 'responses.json';

                // Load existing records
                if (file_exists($file_path)) {
                    $records = json_decode(file_get_contents($file_path), true);

                    // Display each record in a table row
                    foreach ($records as $record) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($record['partner_reff']) . '</td>';
                        echo '<td>' . htmlspecialchars($record['virtual_account']) . '</td>';
                        echo '<td>' . htmlspecialchars($record['bank_name']) . '</td>';
                        echo '<td>' . htmlspecialchars($record['bank_code']) . '</td>';
                        echo '<td>' . htmlspecialchars($record['customer_email']) . '</td>';
                        echo '<td>' . htmlspecialchars($record['feeadmin']) . '</td>';
                        // echo '<td><pre>' . htmlspecialchars($record['response']) . '</pre></td>';
                        echo '<td><button class="copy-button" onclick="copyToClipboard(\'' . htmlspecialchars($record['virtual_account']) . '\')">Copy</button></td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="8">No records found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function generateRandomNumber() {
            // Generate a random number between 100000 and 999999
            const randomNumber = Math.floor(Math.random() * 900000) + 100000;
            // Set the value of the customer-id input to the generated number
            document.getElementById('customer-id').value = randomNumber;
        }

        function copyToClipboard(text) {
            // Create a temporary input element
            const tempInput = document.createElement('input');
            tempInput.value = text;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('Virtual Account copied to clipboard!');
        }
    </script>
</body>
</html>
