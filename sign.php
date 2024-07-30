<?php

$regex = '/[^0-9a-zA-Z]/';
$path = "/transaction/create/vadedicated/add";
$method = "POST";
$clientID = "33d11cb6-69da-45c6-a5c3-948ee10c6927";
$serverKey = "OscgqW04Cpsm5E3YT3Z4xgqZ";
$bank_code = "013";
$customer_id = '0921444';
$customer_name = "PAY GPI";
$customer_email = "22@linkqu.id";
$secondvalue = strtolower(preg_replace($regex, "",$bank_code.$customer_id.$customer_name.$customer_email.$clientID));
$firstvalue = $path . $method;
$buildkey = $firstvalue . $secondvalue;
$signature = hash_hmac('sha256', $buildkey, $serverKey);
echo "INPUT: ", $buildkey . " \n";
echo "SIGNATURE: ", $signature;

?>

