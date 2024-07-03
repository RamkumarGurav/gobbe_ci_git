
<?
require 'auth2.php';

$data = array(
  "origin" => "122001",
"destination" => "122001",
"payment_type" => "cod",
"order_amount" => "999",
"weight" => "600",
"length" => "10",
"breadth" => "10",
"height" => "10"
);
$data_string = json_encode($data);

$url = 'https://shipment.xpressbees.com/api/courier/serviceability';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    "Authorization: Bearer $token"
  )
);

$result = curl_exec($ch);
$result = json_decode($result);
echo '<pre>';
print_r($result);
echo '</pre>';
die;
?>
