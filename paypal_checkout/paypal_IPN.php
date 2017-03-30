<?php

	class paypal_IPN
	{	
			
		
		
		public function __construct($mode = 'live')
		{
			if($mode == 'live')
				$this->_url = "https://www.paypal.com/cgi-bin/webscr";
			if($mode == 'sandbox')
				$this->_url = "https://www.sandbox.paypal.com/cgi-bin/webscr";
		}

		public function run()
		{
			include "../connect.php";
		
			$postFields = 'cmd=_notify-validate';
			foreach($_POST as $key => $value)
			{
				$postFields .= "&$key=" . urlencode($value);
			}
			$ch = curl_init();
			curl_setopt_array($ch, array(
				CURLOPT_URL => $this->_url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_POST => true,
				CURLOPT_POSTFIELDS => $postFields
			));
			
			$result = curl_exec($ch);
			curl_close($ch);
			
			//$pid = $_POST['payer_id'];
			//$query = "UPDATE transactions_new SET status = 1 WHERE payerID = $pid";
			$query = "INSERT INTO ipn VALUES(NULL, '$postFields')";
			$link->query($query) or die();
		}
	}
?>