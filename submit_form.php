<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customerName = $_POST['customer_name'];
    $customerPhone = $_POST['customer_phone'];
    $customerEmail = $_POST['customer_email'];

    $url = "https://gateway-dev.linkqu.id/linkqu-partner/transaction/create/vadedicated/update";
    $clientId = "testing";
    $clientSecret = "123";

    $data = array(
        "customer_id" => "31857118",
        "customer_name" => $customerName,
        "username" => "LI307GXIN",
        "pin" => "2K2NPCBBNNTovgB",
        "customer_phone" => $customerPhone,
        "customer_email" => $customerEmail,
        "bank_code" => "013",
        "url_callback" => "https://webhook.site/634b7df7-98bb-4433-8558-d4f1c8e3ed7f"
    );

    $payload = json_encode($data);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload),
        'client-id: ' . $clientId,
        'client-secret: ' . $clientSecret
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Include the API response and HTTP status code in the output
    echo "<h2>API Response</h2>";
    echo "<strong>Response:</strong><br><pre>" . htmlspecialchars($response) . "</pre><br>";
    echo "<strong>HTTP Status Code:</strong> " . $httpcode;
    echo "<br><a href='index.php'>Back to Form</a>";
}
?>
