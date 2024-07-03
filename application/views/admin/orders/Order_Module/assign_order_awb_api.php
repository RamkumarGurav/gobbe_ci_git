<?
include_once( APPPATH."third_party/expressbess/auth2.php");
$od = $orders_detail[0];
$courier_order_id = '';
$courier_shipment_id = '';
$courier_company_id = $_POST['courier_company_id'];
$shipping_rate = $_POST['shipping_rate'];

$insurance = 2;
if(!empty($_POST['insurance']))
{
	$insurance = $_POST['insurance'];
}


if($insurance==1) { $insurance = 'yes'; }
else { $insurance = 'no'; }

$box_l=0;
$box_b=0;
$box_h=0;

if(!empty($_POST['service_id']))
{
	$service = $_POST['service_id'];
}



if(!empty($_POST['box_l']))
{ $box_l = $_POST['box_l']; }

if(!empty($_POST['box_b']))
{ $box_b = $_POST['box_b']; }

if(!empty($_POST['box_h']))
{ $box_h = $_POST['box_h']; }



$total_product_weight = 0;
if(!empty($_POST['total_package_weight']))
{
	$total_product_weight_in_kg = round($_POST['total_package_weight']*1000 , 3);
}
else
{
	$total_product_weight_in_kg = round($od->total_weight , 3);
}


//echo "<pre>";
//echo "<h1>Product Data</h1>";
//print_r($od);


foreach($od->details as $odd)
{
	if(empty($odd->hsn_code)){$odd->hsn_code='000000';}
	$order_item[] = array(
		  "name"=> $odd->product_name.' - '.html_entity_decode($odd->combi),
		  "sku"=> $odd->combi_ref_code.'-'.$odd->orders_details_id,
		  "qty"=> $odd->prod_in_cart,
		  "price"=> $odd->final_price,
		);
}

$payment_method='';

if($od->is_cod==1)
{
	$payment_method='cod';
}
else
{
	$payment_method='prepaid';
	$shipping_rate = 0;
}

$_order_number = str_replace('#' , '' , $od->order_number);
$_order_number = str_replace('/' , '-' , $od->order_number);
$jsonData = array(
  "order_number"=> "$_order_number",
  "shipping_charges"=> 0,
  "discount"=> 0,
  "cod_charges"=> 0,
  "payment_type"=> "$payment_method",
  "order_amount"=> $od->total,
  "package_weight"=> $total_product_weight_in_kg,
  "package_length"=> $box_l,
  "package_breadth"=> $box_b,
  "package_height"=> $box_h,
  "request_auto_pickup"=> "yes",
  "consignee" => array(
      "name"=> "$od->d_name",
      "address"=> "$od->d_address",
      "address_2"=> "$od->d_address2".' , '."$od->d_address3",
      "city"=> "$od->d_city_name",
      "state"=> "$od->d_state_name",
      "pincode"=> "$od->d_zipcode",
      "phone"=> "$od->number"
  ),
  "pickup"=> array(
      "warehouse_name"=> "GOBBE INTERNATIONAL",
      "name"=> "Abinay",
      "address"=> "1ST FLOOR, 129, Mylara Krupa",
      "address_2"=> "Havanoor Layout,Nagasandra post",
      "city"=> "Bengaluru",
      "state"=> "Karnataka",
      "pincode"=> "560073",
      "phone"=> "8217712660"
  ),
  "order_items"=> $order_item,
  "courier_id"=> "$courier_company_id ",
  "collectable_amount"=> "$shipping_rate"
);
// $jsonData = '{
//     "order_number": "",
//     "shipping_charges": 40,
//     "discount": 100,
//     "cod_charges": 30,
//     "payment_type": "cod",
//     "order_amount": 1000,
//     "package_weight": 300,
//     "package_length": 10,
//     "package_breadth": 10,
//     "package_height": 10,
//     "request_auto_pickup": "yes",
//     "consignee": {
//         "name": "Customer Name",
//         "address": "190, ABC Road",
//         "address_2": "Near Bus Stand",
//         "city": "Mumbai",
//         "state": "Maharashtra",
//         "pincode": "400001",
//         "phone": "9999999999"
//     },
//     "pickup": {
//         "warehouse_name": "warehouse 1",
//         "name": "Nitish Kumar",
//         "address": "140, MG Road",
//         "address_2": "Near metro station",
//         "city": "Gurgaon",
//         "state": "Haryana",
//         "pincode": "122001",
//         "phone": "9999999999"
//     },
//     "order_items": [{
//         "name": "product 1",
//         "qty": "18",
//         "price": "100",
//         "sku": "sku001"
//     }],
//     "courier_id": "1",
//     "collectable_amount": "100"
// }';

$arrayData =  $post_json_data = json_encode($jsonData, true);

$url = 'https://shipment.xpressbees.com/api/shipments2';
$ch = curl_init($url);

curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    "Authorization: Bearer $token"
  )
);

$result = $responsejson =  curl_exec($ch);
$result = $response =  json_decode($result);

if($response->status){
  if(!empty($response->data))
  {

      $courier_order_id = $response->data->order_id;
      $courier_shipment_id = $response->data->shipment_id;
      $docket_number = $response->data->awb_number;
      $courier_name = $response->data->courier_name;
      $courier_id = $response->data->courier_id;
      $label_url = $response->data->label;
      $manifest_url = $response->data->manifest;
			//print_r($response->data->courier_name);die;

  }
  $add_new_order_docket_history_params = array('orders_id'=>$od->orders_id , 'docket_no'=>$docket_number ,'courier_name'=>$courier_name, 'order_status_id'=>7 , 'caption'=>"Assign Docket No." , 'posted_data'=>'', 'response'=>$responsejson , 'post_json'=>$post_json_data , 'updated_by'=>$this->session->userdata("sess_psts_uid") , 'courier_order_id'=>$courier_order_id , 'courier_shipment_id'=>$courier_shipment_id);
$orders_docket_history_id = $_sosl->add_new_order_docket_history($add_new_order_docket_history_params);
$add_new_order_history_params = array('orders_id'=>$od->orders_id , 'order_status_id'=>7 , 'caption'=>"Assign Docket No." , 'remarks'=>'' , 'updated_by'=>$this->session->userdata("sess_psts_uid"));
  $orders_history_id = $_sosl->add_new_order_history($add_new_order_history_params);

$h_description = "Docket Number Assign With $courier_name Docket No. Is : $docket_number";
		$this->Common_Model->update_operation(array('table'=>'orders_history' , 'data'=>array('description'=>$h_description) , 'condition'=>"(orders_history_id = $orders_history_id)"));
		if(empty($shipping_rate))
		{ $shipping_rate = ''; }

		$this->Common_Model->update_operation(array('table'=>'orders' , 'data'=>array('docket_no'=>$docket_number ,'is_label_ganerated'=>1 , 'label_url'=>$label_url ,'manifest_url'=>$manifest_url, 'courier_name'=>$courier_name , 'courier_order_id'=>$courier_order_id , 'courier_shipment_id'=>$courier_shipment_id , 'courier_status_id'=>1 , 'is_courier_txn'=>1  , 'shipping_price'=>$shipping_rate ) , 'condition'=>"(orders_id = $od->orders_id )"));
		//echo $this->db->last_query();
    $alert_message = $this->session->set_flashdata('alert_message', "<div class=' alert alert-success'>Shipping Label Generate Successfully</div>");

?>


        <? if($response->status){
		$search['orders_id'] = $od->orders_id;
		$list_data = $this->Orders_Model->getOrdersDetails($search);
		$list_data  = $list_data[0];
		?>
         		<?=$alert_message?>
                  <div class="tpt-inner">
                      <table>
                          <thead>
                              <tr>
                                  <td class="px-4 py-2 ">#</td>
                                  <td class="px-4 py-2 ">Label</td>
                                  <td class="px-4 py-2 ">Description</td>
                                  <td class="px-4 py-2 ">Action</td>
                              </tr>
                          </thead>
                          <tbody>
                              <!-- <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">1</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-label">Pickup Request</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-desc">Token : Reference No: 349872499 <br>
                                          Time : 23-05-2023 12:56:12 AM , Tuesday <br>
                                          Pickup is confirmed by Kerry Indev Express For AWB :- 2024592917</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-action">Pickup Scheduled</span>
                                  </td>
                              </tr> -->
                              <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">1</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-label">Shipping Label</span>
                                  </td>
                                  <td class="px-4 py-2">
                                    <? if(!empty($list_data->label_url)){ ?>
                                      <span class="spr-desc"><a href="<?=$list_data->label_url?>"  target="_blank" class="btn2 bg-ff tpc-cancel">Print/Download Shipping Label</a></span>

                                    <? }?>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-action">Shipping Label Generated</span>
                                  </td>
                              </tr>
                              <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">2</span>
                                  </td>
                                  <td class="px-4 py-2">
                                  <span class="spr-label">Print Manifests</span>

                                  </td>
                                  <td class="px-4 py-2">
                                    <?
                                    if(!empty($list_data->manifest_url)){ ?>
                                      <span class="spr-desc"><a href="<?=$list_data->manifest_url?>"  target="_blank" class="btn2 bg-ff tpc-cancel">Print Manifest</a></span>
                                        <? }else{ ?>

                                      <a class="btn2 bg-ff tpc-cancel" onclick="assignShiprocketGenerateManifests()" class="btn btn-primary assignShiprocketGenerateManifestsBTN">Generate Manifests</a>
                                        <? } ?>
                                  </td>
                                  <td class="px-4 py-2">
                                    <?
                                    if(!empty($list_data->manifest_url)){ ?>
                                      <span class="spr-action">Manifests Generated</span>
                                        <? }else{ ?>
                                          <span class="spr-action"> Generated Manifest</span>
                                        <? } ?>
                                  </td>
                              </tr>

                              <!-- <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">4</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-label">Shipping Invoice</span>
                                  </td>
                                  <td class="px-4 py-2">
                                    <? if(!empty($list_data->shipping_invoice_url)){ ?>
              <span class="spr-desc"><a href="<?=$list_data->shipping_invoice_url?>" target="_blank" class="btn2 bg-ff tpc-cancel">Print/Download Shipping Invoice</a></span>

              <? }else{ ?>
                <a class="btn2 bg-ff tpc-cancel" onclick="assignShiprocketOrderInvoice()"  class="btn btn-primary assignShiprocketOrderInvoiceBTN">Generate Shipping Invoice</a>


              <? } ?>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-action">Shipping Invoice Generated</span>
                                  </td>
                              </tr> -->
                              <tr>
                                  <td class="px-4 py-2">
                                      <span class="spr-no">3</span>
                                  </td>
                                  <td class="px-4 py-2" colspan="2">
                                      <span class="spr-label">Tracking</span>
                                  </td>
                                  <td class="px-4 py-2">
                                      <span class="spr-desc"><a onclick="trackShiprocketOrder()" class="btn2 bg-ff tpc-cancel trackShiprocketOrderBTN">Track Order</a></span>
                                  </td>
                              </tr>
                          </tbody>

                      </table>

                  </div>
                  <div class="col-md-12" id="shipRicketResponseDiv" style="color:green;font-size:30px;padding:10px;">
                                        </div>

          <?
          }
}else{
		echo $response->message;
	}
