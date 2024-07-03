<?
require 'auth2.php';

$awb_id = 59650109492;
$url = "https://shipment.xpressbees.com/api/courier";
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    "Authorization: Bearer $token"
  )
);

$result = curl_exec($ch);
$result = json_decode($result);
print_r($result);
die;
?>
