<?
require 'auth2.php';


//   $jsonData = '{
//  "awbs": [
//  "4152911775885",
//  "XBC0001789312"
//  ]
// }';
$data = array(
    'awbs' => array(
      '4152911775885',
      'XBC0001789312'
    )
);
$data_string = json_encode($data);

$url = 'https://shipment.xpressbees.com/api/shipments2/manifest';
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
print_r($result);
die;
?>
