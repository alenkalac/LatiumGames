<!DOCTYPE html>
<?php
	include_once 'connect.php';
	include_once 'price_stuff.php';
?>
<html>
	<head>
		<meta charset="utf-8">
		<!--For Google-->
		<meta name="description" content="Latium Games provides real steam games for cheap price, we accept Latium as payment. More Games added every day" />
		<meta name="keywords" content="Latium Games, latiumgames, get games for latium, spend latium, accept latium, cheap, cheap games, games" />
		<meta name="author" content="Alen Kalac">
		<meta name="robots" content="index, follow">
		<meta name="revisit-after" content="3 days">
		
		<!-- For Facebook -->
		<meta property="og:title" content="Latium Games"/>
		<meta property="og:site_name" content="Latium Games"/>
		<meta property="og:description" content="Latium Games provides real steam games for cheap price, we accept Latium as payment. More Games added every day"/>
		<meta property="og:image" content="http://www.latiumgames.cf/images/latiumgames.png"/>
		<meta property="og:image" content="http://www.latiumgames.cf/images/supermeatboy.jpg"/>
		<meta property="og:image" content="http://www.latiumgames.cf/images/amnesia.jpg"/>
		<meta property="og:url" content="http://www.latiumgames.cf"/>
		
		<!-- Latiumgames, Latium, Accept Latium as payment -->
		<title>Latium Games | Home</title>
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
				<div id="featured" class="content_holder">
					<span class="content_label">FEATURED</span>
					<ul class="product_ul">
						<?php
							$query = "SELECT * FROM products WHERE amount > 0 AND featured = 1 ORDER BY id DESC LIMIT 4";
							$result = $link->query($query);
							
							while($row = mysqli_fetch_array($result))
							{
								?>
								<li>
									<div class='basic_info'>
										<div class='prod_img'>
											<img src="images/<?php echo $row['image']; ?>" alt="latium game image of <?php echo $row['image']; ?>">
											<div class='platform'>
												<?php
													switch((int)$row['platform'])
													{
														case 1: echo '<img src="images/steam.png" >'; break;
														case 2: echo '<img src="images/origin.png" >'; break;
														case 3: echo '<img src="images/download.png" >'; break;
													}
												?>
											</div>
										</div>
								
										<div class='prod_name'>
											<?php echo $row['name']; ?>
										</div>
								
										<div class='prod_price'>
											<?php
												$price = number_format(($eurobtc / (float)$lowprice) * (float)$row['price'], 0, ".", "");
											
												if($row['on_sale'])
													echo "<span class='steam_price'>$" . $row['old_price'] . " </span>";
												echo "<span class='lat_price'> " . $price . " LAT</span>";
											?>
										</div>
								
										<div class='prod_buttons'>
										<a href="" class="buy_button" onclick="return addToCart('<?php echo $row['gameid']; ?>', '1');">Add to Cart</a>
										<a href="item.php?itemid=<?php echo $row['gameid']; ?>" class="info_button">More Info</a>
										<!--<button onclick='addToCart(\"" . $row['gameid'] . "\", " . $row['amount'] . ");'>Buy</button><button onclick='showItem(\"" . $row['gameid'] . "\");'>Info</button>
										-->
										</div>
									</div>
								
									<div class='item_description'><?php echo $row['desc']; ?></div>
								</li>
							<?php
							} 	
							?>
					</ul>
				</div>
				
				<div id="new_stuff", class="content_holder new_games">
					<span class="content_label">FREE GAME</span>
					<iframe width="420" height="315" src="//www.youtube.com/embed/0PJGgVb8Atk" frameborder="0" allowfullscreen></iframe><br>
					<iframe id="jo2i8d_0_offer" scrolling="no" class="jo2i8d_0_offer" src="//woobox.com/plugins/offer/jo2i8d_0" style="border: none; border-top-left-radius: 3px; border-top-right-radius: 3px; border-bottom-right-radius: 3px; border-bottom-left-radius: 3px; -webkit-transition: height 0.2s ease-out; transition: height 0.2s ease-out; width: 800px; height: 931px; background: white;"></iframe>
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