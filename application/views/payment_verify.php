<?php
//session_start();

if(empty($_POST))
{
	REDIRECT(MAINSITE);
	exit;
}

//print_r($_POST);
require(APPPATH.'views/config.php');
require(APPPATH.'views/razorpay-php/Razorpay.php');
use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
$razorpay_order_id='';
$razorpay_payment_id='';
$razorpay_signature='';
$temp_order_id='';
$success = true;
$error = "Payment Failed";
//echo "$keyId:$keySecret";
function verify_razorpay_payment_id($razorpay_payment_id )
{
	$pc = new payment_config();
	$GATEWAYAPI ="https://$pc->keyId:$pc->keySecret@api.razorpay.com/v1/payments/".$razorpay_payment_id;
	//$key = "$keyId:$keySecret";
	//$GATEWAYAPI ="https://api.razorpay.com/v1/payments/".$_POST['razorpay_payment_id'];
	//echo $GATEWAYAPI;
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $GATEWAYAPI);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	if(curl_exec($ch) === false){
	$error_info= curl_error($ch);
	$mail_status = 'Not Sent';
	$error_info=$mail->ErrorInfo;
	$msg = 'psfail';
	}else{
	$mailMessageStatus = "sent";
	}
	$response = curl_exec($ch);
	$response = json_decode($response);
	/*echo "<pre>";
	print_r($response);
	echo "</pre>";*/
	curl_close($ch);
	return $response;
}

$success= false;
if(!empty($_POST['razorpay_order_id']) && !empty($_POST['razorpay_order_id']) && !empty($_POST['razorpay_order_id']))
{
	$razorpay_order_id = $_POST['razorpay_order_id'];
	$razorpay_payment_id = $_POST['razorpay_payment_id'];
	$razorpay_signature = $_POST['razorpay_signature'];
	// echo $_POST['temp_order_id']."<br>";
	$check_signature = "$razorpay_order_id|$razorpay_payment_id";
	$generated_signature = hash_hmac ('sha256' , $check_signature, $keySecret);

	/*echo "<h4>keySecret : $keySecret</h4>";
	echo "<h4>razorpay_order_id|razorpay_payment_id : $check_signature</h4>";
	echo "<h4>Generated Signature : $generated_signature</h4>";*/

	if ($generated_signature == $razorpay_signature) {
		if(!empty($_POST['razorpay_payment_id']))
		{
			$response = verify_razorpay_payment_id($razorpay_payment_id);
		}


		if(!empty($response))
		{
			if(!empty($response->status))
			{
				if($response->status === 'authorized' ||  $response->status === 'captured')
				{
					$success= true;
				}
				if(!empty($response->notes->shopping_order_id))
				{
					$temp_order_id = $response->notes->shopping_order_id;
				}
			}
		}
	 }
}
else
{
	$error = $_POST['error'];
	$metadata = $error['metadata'];
	$metadata = json_decode($metadata);
	if(!empty($metadata->order_id))
	    $razorpay_order_id=$metadata->order_id;
	if(!empty($metadata->payment_id))
	$razorpay_payment_id=$metadata->payment_id;
	$razorpay_signature='';

	if(!empty($razorpay_payment_id))
	{
		$response = verify_razorpay_payment_id($razorpay_payment_id);
	}


	if(!empty($response))
	{
		if(!empty($response->status))
		{
			if(!empty($response->notes->transaction_id))
			{
				$temp_order_id = $response->notes->transaction_id;
			}
		}
	}
}
/*echo $temp_order_id;
exit;*/
echo '<form name="paymentVerify" id="paymentVerify" method="post" action="'.MAINSITE.'order_confirmation">';
if (($success === true || $success === 1) && !empty($temp_order_id))
{

if(!empty($_POST['razorpay_order_id'])) { $razorpay_order_id = $_POST['razorpay_order_id']; }
if(!empty($_POST['razorpay_payment_id'])) { $razorpay_payment_id = $_POST['razorpay_payment_id']; }
if(!empty($_POST['razorpay_signature'])) { $razorpay_signature = $_POST['razorpay_signature']; }
	?>
    <input type="hidden" name="amountPayable" id="amountPayable" value="<? echo $response->amount; ?>" />
    <input type="hidden" name="temp_order_id" id="temp_order_id" value="<? echo $temp_order_id; ?>" />
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="<? echo $razorpay_order_id; ?>" />
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="<? echo $razorpay_payment_id; ?>" />
    <input type="hidden" name="razorpay_signature" id="razorpay_signature" value="<? echo $razorpay_signature; ?>" />
    <input type="hidden" name="response" id="response" value="success" />
    <?
}
else
{
//	echo "fail";
	?>
    <input type="hidden" name="temp_order_id" id="temp_order_id" value="<? echo $temp_order_id; ?>" />
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="<? echo $razorpay_order_id; ?>" />
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id" value="<? echo $razorpay_payment_id; ?>" />
    <input type="hidden" name="razorpay_signature" id="razorpay_signature" value="<? echo $razorpay_signature; ?>" />
	<input type="hidden" name="response" id="response" value="fail" />
    <?
}
echo "</form>";

?>
<style type="text/css">
.spinner-border {
    display: inline-block;
    width: 5rem;
    height: 5rem;
    vertical-align: text-bottom;
    border: .25em solid currentColor;
    border-right-color: transparent;
    border-radius: 50%;
    -webkit-animation: spinner-border .75s linear infinite;
    animation: spinner-border .75s linear infinite; position:fixed; z-index:2000; top:50%; left:50%; }
	.text-primary {
    color: #007bff!important;
}
@keyframes spinner-border {
  to { transform: rotate(360deg); }
}
@keyframes spinner-grow {
  0% {
    transform: scale(0);
  }
  50% {
    opacity: 1;
  }
}
.loader{background-color: rgba(0, 0, 0, 0.3); width:100%; height:100%; position:fixed; top:0; left:0; z-index:20000000;}
</style>
<div class="loader" >
    <div class="spinner-border text-primary spinner-grow" role="status">
      <!--<span class="sr-only">Loading...</span>-->
    </div>
</div>

<script>document.paymentVerify.submit();</script>
