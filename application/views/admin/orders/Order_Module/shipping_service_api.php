
<?
include_once( APPPATH."third_party/expressbess/auth2.php");
$od = $orders_detail[0];
$total_product_weight = 0;
$box_l=0;
$box_b=0;
$box_h=0;

if(!empty($_POST['box_l']))
{ $box_l = $_POST['box_l']; }

if(!empty($_POST['box_b']))
{ $box_b = $_POST['box_b']; }

if(!empty($_POST['box_h']))
{ $box_h = $_POST['box_h']; }

if(!empty($_POST['total_package_weight']))
{
	$total_product_weight_in_kg = round($_POST['total_package_weight']*1000 );
}
else
{
	$total_product_weight_in_kg = round($od->total_weight , 3);
}
//echo 	$total_product_weight_in_kg;die;
$delivery_postcode = $od->d_zipcode;
if($od->is_cod==1)
{
	$cod='cod';
}
else
{
	$cod='prepaid';
}
$data = array(
  "origin" => "560073",
"destination" => "$delivery_postcode",
"payment_type" => "$cod",
"order_amount" => "$od->total",
"weight" => "$total_product_weight_in_kg",
"length" => "$box_l",
"breadth" => "$box_b",
"height" => "$box_h"
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
// echo '<pre>';
// print_r($result);
// echo '</pre>';
// die;
if($result->status){
  ?>
   <div class="ship-procedure">
              <div class="podt-title">
                  <h3>Shipping Procedure</h3>
              </div>
              
  <div class="shp-table tpi-product-table">
      <div class="tpt-inner">
          <table>
              <thead>
                  <tr>
                      <td class="px-4 py-2 ">Sl No.</td>
                      <td class="px-4 py-2 ">Courier Name</td>
                      <td class="px-4 py-2 ">COD Price</td>
                      <td class="px-4 py-2 ">Frieght Charges</td>
                      <td class="px-4 py-2">Total</td>
                      <td class="px-4 py-2 text-center">Action</td>
                  </tr>
              </thead>
              <tbody>


  <?
  $count = 0;
  foreach ($result->data as $shipping_data ) {
      $count++;
    ?>
    <tr>
        <td class="px-4 py-2">
            <span><?=$count?></span>
        </td>
        <td class="px-4 py-2">
            <span><?=$shipping_data->name?></span>
        </td>
        <td class="px-4 py-2">
            <span><?=$shipping_data->cod_charges?></span>
        </td>
        <td class="px-4 py-2">
            <span><?=$shipping_data->freight_charges?></span>
        </td>
        <td class="px-4 py-2">
            <span><?=$shipping_data->total_charges?></span>
        </td>

        <td class="px-4 py-2 text-center">
            <a onclick="assignShiprocketOrderAWB(<?=$shipping_data->id?> , '<?=$shipping_data->total_charges?>')"class="btn1 assignShiprocketOrderAWBBTN">Assign Docket</a>
        </td>
    </tr>
    <?
  }
  ?>
</tbody>

</table>
</div>
</diV>
</div>
  <?
}else{
  ?>
  <div class="alert alert-warning alert-dismissible"><i class="icon fas fa-ban"></i><?=$result->message?></div>

  <?
}
?>
