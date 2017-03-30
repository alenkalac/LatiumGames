<!DOCTYPE html>
<?php
	include_once 'connect.php';
	include_once 'wallet_connect.php';
	include_once 'price_stuff.php';
	
	function searchForId($id, $array) 
	{
		foreach ($array as $key => $val) 
		{
			if ($val['prod_id'] === $id)
				return $key;
		}
	   return -1;
	}
	
	if(isset($_POST['email']))
	{
		$email = $_POST['email'];
	}
	else
	{
		header("location: cart.php");
	}
	
	$id1 = uniqid();
	$id2 = uniqid();
	$id3 = uniqid();
	
	$transactionID = $id1 . $id2 . $id3;
	
	$transactionID = hash("sha1", $transactionID);
	
	$_SESSION['transactionID'] = $transactionID;
	
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Latium Games</title>
		<style>
			@import "css/css.css";
			@import "css/1430.css";
			@import url(http://fonts.googleapis.com/css?family=PT+Serif:400,700,400italic,700italic);
			@import url(http://fonts.googleapis.com/css?family=Audiowide);
		</style>
		<script src="js/jquery-1.11.1.min.js"></script>
		
		<script src="js/script.js"></script>
		<script type="text/javascript">var switchTo5x=true;</script>
		<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
		<script type="text/javascript">stLight.options({publisher: "b866ba91-c444-4b62-8777-8b6d3261d54b", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
		<script src="js/newsTicker.js"></script>
		<script>
			
			$(document).ready(function(){
				
				var time = (1000 * 60) * 15; //15 minutes
				var time_since_last_check = 0;
				
				function updateTime()
				{
					if(time <= 0)
					{
						//transaction ended.
					}
					
					if(time_since_last_check >= 10)
					{
						time_since_last_check = 0;
						//make an ajax request to server.
						$.ajax({
							type: 'POST',
							url: 'confirm.php',
							data: {'transactionID': $('#tid').attr('value')}
						}).done(function(e){
							console.log(e);
							if(e == "success")
							{
								window.location = "thankyou.php?tid=" + $('#tid').attr('value');
							}
						})
						//if payment is made redirect to page final.php/tid=id
						
						
					}
					
					var min = Math.floor((time / (60 * 1000)) % 60);
					var sec = Math.floor((time / 1000) % 60);
					
					if(sec < 10) 	$("#timer").html(min + ":0" + sec);
					else			$("#timer").html(min + ":" + sec);
					time = time - 1000;
					
					time_since_last_check++;
					
				}
				
				setInterval(updateTime, 1000);
			
			});
		
		
		</script>
	</head>
	<body>
		<div id="container">
			<!-- LOGIN FORM GOES HERE -->
			<?php  include 'loginform.php'; ?>
			<!-------------------------->
			
			<!-- HEADER GOES HERE -->
			<div id="header_holder">
			<?php  include 'header.php';  ?>
			</div>
			<!---------------------->
			
			<!-- NEWS GOES HERE -->
			<?PHP include 'news.php'; ?>
			<!-------------------->
			
			<div id="body_content">
				<div id="payment" class="content_holder">
					<span class="content_label">Make a payment</span>
					<span class="content_label">DO NOT REFRESH</span>
					
					
					<?php 
						// loop though the items in the cart
						if(isset($_SESSION['CART']) && count($_SESSION['CART']) > 0)
						{
							$query = "SELECT * FROM products WHERE gameid IN(";
								
							foreach($_SESSION['CART'] as $item)
							{
								$query .= "'" . $item['prod_id'] . "',";
							}
							
							$query = substr($query, 0, -1);
							$query .= ")";
							
							$result = $link->query($query);
							$total_price = 0;
							//calculate the cost of items based on the new price
							while($row = mysqli_fetch_array($result))
							{
								if($row['amount'] > 0)
								{
									$price = number_format(($eurobtc / (float)$lowprice) * (float)$row['price'], 0, ".", "");
									$total_price += $price;
								}
								else
								{
									unset($_SESSION['CART']);
								?>
									<script>
										alert("Some of the items in the cart are already sold. Try re-adding items again");
										window.location = "index.php";
									</script>
								<?php
									
								}
							}
							$products = serialize($_SESSION['CART']);
							//commence the transaction by storing the transaction ID inside the database
							$query = "INSERT into transactions VALUES(NULL, '$transactionID', '$email', '$products', $total_price, '0')";
							//echo ($query);
						
							$link->query($query) or die("error connecting to database....reload or try again later");
							
							//create the wallet ID and subtract price from it so we can keep checking on wallet's status
							//and when the value is = 0 payment is paid in full.
							$user_wallet = $wallet->getaccountaddress($transactionID) or die("error 1");
							if($total_price > 0)
								$wallet->move($user_wallet, "PRE_ORDER_CREDIT", (float)$total_price);
							
							//echo "Please Make a deposit of " . $total_price . " to this address";
							//echo "<h1>$user_wallet</h1>";
						} 
					?>
					<div id="payment_container">
						Your Transaction ID: <?php echo $transactionID; ?>
						<div class="lat_pay_sys">LATIUM PAYMENT SYSTEM</div>
						<div id="payment_box">
							<div id="lataddress">
								<?php echo "Please Make a deposit of " . $total_price . " to this address"; ?>
								<?php echo "<h1>$user_wallet</h1>"; ?>
							</div>
							<div id="timer">
								15:00
							</div>
							<input id="tid" type="hidden" value="<?php echo $transactionID;  ?>">
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>