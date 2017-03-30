<?php
	require 'paypalfunctions.php';

	echo GetExpressCheckoutDetails($_GET['token']);

?>