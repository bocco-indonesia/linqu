<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form inputs
    $client_id = $_POST['client-id'];
    $client_secret = $_POST['client-secret'];
    $username = $_POST['username'];
    $pin = $_POST['pin'];
    $bank_code = $_POST['bank-code'];
    $customer_id = $_POST['customer-id'];
    $customer_name = $_POST['customer-name'];
    $customer_email = $_POST['customer-email'];


    // Define constants
    $path = "/transaction/create/vadedicated/add";
    $method = "POST";
    $server_key = $_POST['signkey'];

    // Remove non-alphanumeric characters and convert to lowercase
    $regex = '/[^0-9a-zA-Z]/';
    $second_value = strtolower(preg_replace($regex, '', $bank_code . $customer_id . $customer_name . $customer_email . $client_id));
    $first_value = $path . $method;
    $build_key = $first_value . $second_value;

    // Create the signature
    $signature = hash_hmac('sha256', $build_key, $server_key);

    // Prepare the payload
    $payload = json_encode([
        "customer_id" => (int)$customer_id,
        "customer_name" => $customer_name,
        "username" => $username,
        "pin" => $pin,
        "customer_email" => $customer_email,
        "bank_code" => $bank_code,
        "is_custom" => false,
        "signature" => $signature,
        "url_callback" => ""
    ]);

    // Initialize cURL
    $ch = curl_init('https://gateway.linkqu.id/linkqu-partner/transaction/create/vadedicated/add');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'client-id: ' . $client_id,
        'client-secret: ' . $client_secret,
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

    // Execute the request and fetch the response
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Save the response if HTTP status code is 200 or response_desc is "Virtual Account Successfully Created"
    $response_data = json_decode($response, true);
    $response_desc = $response_data['response_desc'] ?? '';
    

    if ($http_code == 200 || $response_desc === "Virtual Account Successfully Created") {
        // Prepare the data to be saved
        $record = [
            'partner_reff' => $response_data['partner_reff'] ?? 'N/A',
            'virtual_account' => $response_data['virtual_account'] ?? 'N/A',
            'bank_name' => $response_data['bank_name'] ?? 'N/A',
            'bank_code' => $bank_code,
            'customer_email' => $customer_email,
            'feeadmin' => $response_data['feeadmin'] ?? 'N/A',
            'response' => $response
        ];

        // Path to the file
        $file_path = 'responses.json';

        // Load existing records
        if (file_exists($file_path)) {
            $existing_records = json_decode(file_get_contents($file_path), true);
        } else {
            $existing_records = [];
        }

        // Append the new record
        $existing_records[] = $record;

        // Save back to the file
        file_put_contents($file_path, json_encode($existing_records, JSON_PRETTY_PRINT));
    }

    // Redirect to index.php or another page
    header("Location: index.php");
    exit();
}
?>
