<?php
#test mode
$keyId = 'rzp_test_HKu9BGVyUBEhsm';
$keySecret = 'xoZ7v5ON38e5wRrxHFNOPQG3';

#live mode
//$keyId = 'rzp_live_HD4aQO67WA0UXZ';
//$keySecret = 'COiU8kWE9LtFK7vvYJadn7Gx';

$displayCurrency = 'INR';

error_reporting(E_ALL);
ini_set('display_errors', 1);

class payment_config {

	function __construct($params = array())
	{
		//$this->keyId = 'rzp_live_HD4aQO67WA0UXZ';
	//	$this->keySecret = 'COiU8kWE9LtFK7vvYJadn7Gx';
		$this->keyId = 'rzp_test_HKu9BGVyUBEhsm';
		$this->keySecret = 'xoZ7v5ON38e5wRrxHFNOPQG3';
	}
}
