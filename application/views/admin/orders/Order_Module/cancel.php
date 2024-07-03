<?

include_once( APPPATH."third_party/expressbess/auth2.php");
//$od = $orders_detail[0];



$data = array(
    'awb' =>
      $awb_no

);
$data_string = json_encode($data);

$url = 'https://shipment.xpressbees.com/api/shipments2/cancel';
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
