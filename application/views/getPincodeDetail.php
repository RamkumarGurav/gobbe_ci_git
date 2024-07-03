<?
include_once( APPPATH."third_party/expressbess/auth2.php");
$destination_pincode = $params['delivery_pin_code'] =  $pincode;

$data = array(
  "origin" => "560073",
"destination" => $params['delivery_pin_code'],
"payment_type" => "prepaid",
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
// echo "<pre>";
// print_r($result);
// echo "</pre>";
?>
	<?
    if($result->status)
    {

			?>

    <span style="color:#14c614">Delivery Available</span>
    <?
  }
		else
		{
			?>
    <span style="color:#F00">There is No delivery</span>
    <?
		}
