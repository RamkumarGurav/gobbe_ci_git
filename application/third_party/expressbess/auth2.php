<?php
$url = 'https://shipment.xpressbees.com/api/users/login';
$data = array(
    'email' => 'gobbeinternational@gmail.com',
    'password' => 'Gobbe@123'
);

$data_string = json_encode($data);

$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string)
  )
);

$result = curl_exec($ch);

curl_close($ch);

$auth_response = json_decode($result, true);
//print_r($auth_response);
$token = $auth_response['data'];

?>
