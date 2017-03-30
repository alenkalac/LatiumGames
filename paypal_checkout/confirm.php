<?php
	include_once 'connect.php';
	error_reporting(0);

	if(isset($_GET['tid']))
	{
		$tid = $_GET['tid'];
		$tid = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($tid))))));
		
		$get_transaction = "SELECT * FROM transactions_new WHERE transactionid = '$tid' LIMIT 1";
		$result = $link->query($get_transaction);
		
		$row = mysqli_fetch_array($result);
		
		if($row['status'] == 1)
		{
			$products = unserialize( $row['items'] );
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
			
			header("location: ../thankyou.php?tid=$tid");
		}
	}
?>

<!doctype html>
<html>
	<head>
	
	</head>
	
	<body>
		Loading
	</body>


</html>