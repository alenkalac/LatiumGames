<?php
	require_once 'jsonRPCClient.php';
	try
	{
		$wallet = new jsonRPCClient('http://alenkalac:c$1WOCTTds6p38l5mA@192.168.2.7:8332/');
	}catch (Exception $e)
	{
		die("Could not connect to the database. try again later.");
	}

?>