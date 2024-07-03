<?php
$auth_api_data = array("email"=>"gobbeinternational@gmail.com" , "password"=>"Gobbe@123");
$headers = array(
    "Content-type : application/json"
);
$request_url = 'https://shipment.xpressbees.com/api/users/login';
$post = curl_init();
curl_setopt($post, CURLOPT_URL, $request_url);
curl_setopt($post, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($post, CURLOPT_POST,TRUE);
curl_setopt($post, CURLOPT_POSTFIELDS, $auth_api_data);
curl_setopt($post, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($post);
curl_close($post);


//$result = $response;
$auth_response = json_decode($response, true);
echo "<h1>AUTH RESPONSE</h1>";
print_r($auth_response);
die;
$token = $auth_response['token'];
