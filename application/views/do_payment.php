<?php
	require('config.php');
	require('razorpay-php/Razorpay.php');
	use Razorpay\Api\Api;

$temp_currency_id = $this->session->userdata('application_sess_currency_id');


	//include_once('razorpay-php/src/Api.php');


	//$className = new Razorpay();
	//$api = $className->api();

	//$api = new Api();

	$api = new Api($keyId, $keySecret);

$this->CI =& get_instance();

	$name = $payment_gateway_data['name']; //echo "<br/>".$name ;
	$email = $payment_gateway_data['email']; //echo "<br/>".$email;
	$number = $payment_gateway_data['number']; //echo "<br/>".$number ;
	//$order_id = $customers_row['order_id']; //echo "<br/>".$order_id;
	$order_id = $payment_gateway_data['temp_orders_id']; //echo "<br/>".$order_id;
	$email = $payment_gateway_data['email'];
	$total = $payment_gateway_data['Amount'];
	$customer = array("name"=>$name , "email"=>$email , "number"=>$number , 'order_id'=>$order_id , 'amountPayable'=>round($total));
	//print_r($customer);
	//require('do_payment.php');

if(!empty($customer['name']) && !empty($customer['email']) && !empty($customer['number']) && !empty($customer['order_id']) && !empty($total) ){
		$amountPayable = $total;  //echo $amountPayable;
		//$classes_amount = 1;

		// We create an razorpay order using orders api
		// Docs: https://docs.razorpay.com/docs/orders
		//
		$orderData = array(
		    'amount'          => $amountPayable * 100, // 2000 rupees in paise
			'currency'        => 'INR',
			'receipt'         => $order_id,
			'payment_capture' =>1 // auto capture
		);

	$razorpayOrder = $api->order->create($orderData);
 		/*echo "<pre>";
 		print_r($orderData);
 		print_r($razorpayOrder);
 		echo "</pre>";
		exit;*/
		$razorpayOrderId = $razorpayOrder['id'];
		$razorpayAmount = $razorpayOrder['amount'];
		$this->session->set_userdata('razorpayOrderId',$razorpayOrderId);
		$this->session->set_userdata('razorpayAmount',$razorpayAmount);
		unset($order_master_update_data);
		$order_master_update_data = array();
		$order_master_update_data['r_order_id'] = $razorpayOrderId;
		$this->CI->Common_Model->update_operation(array('table'=>'temp_orders' , 'data'=>$order_master_update_data , 'condition'=>"temp_orders_id = $order_id"));

		$_SESSION['razorpay_order_id'] = $razorpayOrderId;

		$displayAmount = $amount = $orderData['amount'];

		if ($displayCurrency !== 'INR')
		{
			$url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
			$exchange = json_decode(file_get_contents($url), true);

			$displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
		}

		$checkout = 'automatic';

		if (isset($_GET['checkout']) and in_array($_GET['checkout'], array('automatic', 'manual'), true))
		{
			$checkout = $_GET['checkout'];
		}


		$data = array(
			"key"               => $keyId,
			"amount"            => $amount,
			"name"              => $payment_gateway_data['name'],
			"description"       => _project_name_,
			"image"             => base_url()."assets/front/images/logo.jpg",
			"prefill"           => array(
			"name"              => $payment_gateway_data['name'],
			"email"             => $payment_gateway_data['email'],
			"contact"           => $payment_gateway_data['number'],
			"invoice_id"	    => $payment_gateway_data['temp_orders_id'],
			),
			"notes"             => array(
			"address"           => "",
			"merchant_order_id" => "12312321",
			),
			"theme"             => array(
			"color"             => "#F37254"
			),
			"order_id"          => $razorpayOrderId,
		);

		if ($displayCurrency !== 'INR')
		{
			$data['display_currency']  = $displayCurrency;
			$data['display_amount']    = $displayAmount;
		}

		//$data['stu_dob']  = $_POST['stu_dob'];
		//$data['stu_class']  = $_POST['stu_class'];
		$data['amountPayable']  = $customer['amountPayable'];

		$json = json_encode($data);

		?>


        <?



		require("checkout/do_checkout.php");
		exit;
	}

?>
