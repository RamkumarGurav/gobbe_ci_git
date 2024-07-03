<?
include_once( APPPATH."third_party/expressbess/auth2.php");
$od = $orders_detail[0];
$awb_number = $od->docket_no;
$awb_id = $awb_number;
$url = "https://shipment.xpressbees.com/api/shipments2/track/$awb_id";
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
// print_r($result);
// die;
echo json_encode(array('result'=>$result));
die;
?>
