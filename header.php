<header class="clearall">
	<div class="border_thin"></div>
	<div class="border_thin"></div>
	<div class="border_thin border_thick"></div>
	
	<div id="logo">
		<a href="/">
		<span id="LATIUM">LATIUM</span> <br>
		<span id="GAMES">GAMES</span>
		</a>
	</div>
	
	<div id="navigation">
		<?php include 'navbar.php'; ?>
	</div>
	
	<div id="latprice">
		<div id="lat_label"> <!-- spreads 100% -->
			LAT/BTC (coin-swap) <?php echo $change;?><br>
		</div>
		<div id="price_content">
			<div class="lat_cell">
				Last Price <br> <?php echo $lastprice; ?>
			</div>
			<div class="lat_cell lat_cell_even">
				24h High <br> <?php echo $highprice; ?>
			</div>
			<div class="lat_cell">
				24h Low <br> <?php echo $lowprice; ?>
			</div>
		</div>
	</div>
	<div id="media">
		<span class='st_fblike_large' displayText='Facebook Like'></span>
		<span class='st_facebook_large' displayText='Facebook'></span>
		<span class='st_twitter_large' displayText='Tweet'></span>
		<span class='st_blogger_large' displayText='Blogger'></span>
		<span class='st_sharethis_large' displayText='ShareThis'></span>
		<span class='st_googleplus_large' displayText='Google +'></span>
		<span class='st_email_large' displayText='Email'></span>
	</div>
	<div class="border_thin border_thick fix_top"></div>
	<div class="border_thin fix_top"></div>
	<div class="border_thin fix_top"></div>
</header>