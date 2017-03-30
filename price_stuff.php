<?php
	include_once 'simple_html_dom.php';
	include_once 'connect.php';
	
	$query = "SELECT * FROM prices";
	$result = $link->query($query);
	
	while($row = mysqli_fetch_assoc($result))
	{
		$date = new DateTime($row['date']);
		$now = new DateTime();
		$diff=date_diff($date,$now);
		if($diff->i > 10)
		{
			
			try
			{
				//$html = file_get_html('https://coin-swap.net/market/LAT/BTC');
				$lastprice = 1;
				$highprice = 1;
				$lowprice = 1;
				$change = 1;
		
				$eurobtc = (float)file_get_contents('https://blockchain.info/tobtc?currency=EUR&value=1');
			
				$query = "UPDATE prices SET lat_current = '$lastprice', lat_24high ='$highprice', lat_24low = '$lowprice', price_change = '$change', eurobtc = '$eurobtc', date = NOW() WHERE id=1";
				$link->query($query) or die("Cannot connect to database");

			
			}
			catch(Exception $e){
				
				$lastprice = $row['lat_current'];
				$highprice = $row['lat_24high'];
				$lowprice = $row['lat_24low'];
				$change = $row['price_change'];

				$eurobtc = (float)$row['eurobtc'];
			}
		}
		else
		{
			
			$lastprice = $row['lat_current'];
			$highprice = $row['lat_24high'];
			$lowprice = $row['lat_24low'];
			$change = $row['price_change'];
	
			$eurobtc = (float)$row['eurobtc'];
		}
	}
?>