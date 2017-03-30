<?php
	include_once 'connect.php';
	include_once 'wallet_connect.php';
	error_reporting(0);

	if(isset($_POST['transactionID']))
	{
		$tid = $_POST['transactionID'];
		$tid = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($tid))))));
		$balance = -1;
		
		try
		{
			$address = $wallet->getaddressesbyaccount($tid);
			$balance = (float)$wallet->getbalance($address[0]);
		}catch(Exception $e)
		{
			echo "error";
			die();
		}
		
		if($balance >= 0)
		{	
			$tid = mysqli_real_escape_string($link, $tid);
			$query = "UPDATE transactions SET paid = '1' WHERE transactionid='$tid'";
			$link->query($query) or die("error");
			
			$query = "SELECT * FROM transactions WHERE transactionid='$tid' LIMIT 1";
			$result = $link->query($query) or die("error");
			
			$products = "";
			
			while($row = mysqli_fetch_array($result))
			{
				$products = unserialize( $row['items'] );
			}
			
			$query2 = "SELECT * FROM products WHERE gameid IN(";					
							
			foreach($products as $product)
			{
				$safe_item = $product['prod_id'];
				$safe_item = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($safe_item))))));
				$query = "UPDATE gamekeys SET belongs_to = '$tid', used = 1 WHERE gameid='" . $safe_item . "' AND used = 0 LIMIT 1" ;
				$link->query($query) or die("ERROR 2");
				$query = "UPDATE products SET amount = amount-1 WHERE gameid='" . $safe_item . "' LIMIT 1";
				$link->query($query) or die("ERROR 3");
				$query2 .= "'" . $safe_item . "',";
			}
			
			$query2 = substr($query2, 0, -1);
			
			$query2 .= ")";
			$link->query($query2) or die("ERROR");
			unset($_SESSION['CART']);
			echo "success";
			
		}
		else
		{
			echo "deny";
		}
	}
?>