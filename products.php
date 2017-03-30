<!DOCTYPE html>
<?php
	include_once 'connect.php';
	include_once 'price_stuff.php';
	include_once 'classes/Game.php';
	
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Latium Games | Products</title>
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
				<div id="new_stuff", class="content_holder new_games">
					<span class="content_label">ALL GAMES</span>
					<ul class="product_ul">
						<?php
							$query = "SELECT * FROM products WHERE amount > 0 ORDER BY name ASC";
							$result = $link->query($query);
							$count = 0;
							while($row = mysqli_fetch_array($result))
							{
								if($count % 4 == 0)
									echo "<br>";
								
								$price = number_format(($eurobtc / (float)$lowprice) * (float)$row['price'], 0, ".", "");
								echo "<li>";
								$game = new Game($row, $price);
								echo "</li>";
								
								$count++;
							} 
						?>
					</ul>
				</div>
			</div>
			<div id="lightbox">
				<div id="basketMessage">
					<h1>Item added to Basket</h1>
					<p>
						Your Item has been added to the basket, You can Press go to basket or continue shopping.<br>
						<span class="alert_button" onclick="hide_lightbox();">Continue Shopping</span>
						<span class="alert_button" onclick="window.location.href = 'cart.php';">Go To Basket</span>
					</p>
				</div>
			</div>
		</div>
	</body>
</html>