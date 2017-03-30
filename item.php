<!DOCTYPE html>
<?php

	include_once 'connect.php';
	include_once 'price_stuff.php';
	
	if(isset($_GET['itemid']))
	{
		$itemID = $_GET['itemid'];
		$itemID = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($itemID))))));
		$itemID = mysqli_real_escape_string($link, $itemID);
		
		$query = "SELECT * FROM products WHERE gameid='$itemID' LIMIT 1";
		$result = $link->query($query);
		
		$row = mysqli_fetch_array($result);
	}

?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Latium Games | <?php echo $row['name']; ?></title>
		<style>
			@import "css/css.css";
			@import "css/item.css";
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
				<h1 class="game_info_name"><?php echo $row['name']; ?></h1>
				<div id="game_info_container">
					
					<div id="game_info_header">
						<div id="game_info_img">
							<img src="images/<?php echo $row['image']; ?>" alt="Latium Games Image of <?php $row['image']; ?>">
							<a href="" class="buy_button" onclick="return addToCart('<?php echo $row['gameid']; ?>', '1');">Add to Cart</a>
						</div>
						<div id="game_info_specs">
							<fieldset>
								<legend>Requirements</legend>
								Platform: 
								
								<?php
									switch((int)$row['platform'])
									{
										case 1: echo 'Steam'; break;
										case 2: echo 'Origin'; break;
										case 3: echo 'Download'; break;
									}
								?>
								<br>
								CPU: <br>
								Graphics:<br>
								RAM:<br>
								OS:<br>
								NET: <br>
							</fieldset>
						</div>
					</div>
					
					<div id="game_info_description"><?php echo $row['desc']; ?></div>
					<br style="clear:both;">
				</div>
			</div>
		</div>
	</body>
</html>