<?php
	require 'paypal_IPN.php';
	
	$paypal = new paypal_IPN('sandbox');
	$paypal->run();

?>