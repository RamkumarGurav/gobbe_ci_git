<?
include_once( APPPATH."third_party/expressbess/auth2.php");
$od = $orders_detail[0];

$order_api_data = array(
"shipment_id"=> $od->courier_shipment_id);

$data = array(
    'awbs' => array(
      $od->docket_number
    )
);
$data_string = $order_api_data_json = $post_json_data = json_encode($data);

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

$result = $responsejson =  curl_exec($ch);
$result = json_decode($result);
// print_r($result);
// die;
if($result->status){
  $manifest_url = $response->data;

$add_new_order_docket_history_params = array('orders_id'=>$od->orders_id , 'docket_no'=>$od->docket_no ,'courier_name'=>$od->courier_name, 'order_status_id'=>7 , 'caption'=>"Manifests Generate" , 'posted_data'=>'', 'response'=>$responsejson , 'post_json'=>$order_api_data_json , 'updated_by'=>$this->session->userdata("sess_user_id") , 'courier_order_id'=>$od->courier_order_id , 'courier_shipment_id'=>$od->courier_shipment_id);

$orders_docket_history_id = $_sosl->add_new_order_docket_history($add_new_order_docket_history_params);

$add_new_order_history_params = array('orders_id'=>$od->orders_id , 'order_status_id'=>7 , 'caption'=>"Manifests Generate" , 'remarks'=>'' , 'updated_by'=>$this->session->userdata("sess_user_id"));
$orders_history_id = $_sosl->add_new_order_history($add_new_order_history_params);


$h_description = "Manifests Generate";
$this->Common_Model->update_operation(array('table'=>'orders_history' , 'data'=>array('description'=>$h_description) , 'condition'=>"(orders_history_id = $orders_history_id)"));


$this->Common_Model->update_operation(array('table'=>'orders' , 'data'=>array('is_manifest_ganerated'=>1 , 'manifest_url'=>$manifest_url , 'courier_status_id'=>3 ) , 'condition'=>"(orders_id = $od->orders_id )"));
//echo $this->db->last_query();
$is_docket_assign = true;
$this->session->set_flashdata('message', "<div class=' alert alert-success'>Manifests Generate Successfully</div>");
echo "<script>window.location.reload();location.reload();</script>";
}else{
?>
<div class="alert alert-warning alert-dismissible"><i class="icon fas fa-ban"></i><?=$result->message?></div>

<?
}
?>
