<!DOCTYPE html>
<?php
	include_once 'connect.php';
	include_once 'price_stuff.php';
	$gameid = uniqid();
	
	if(isset($_POST['submit']))
	{
		if(1)
		{
			$itemID = $_POST['gameid'];
			$item = $_POST['item_name'];
			$filename = $_FILES['upload']['name'];
			$desc = mysqli_real_escape_string($link, $_POST['description']);
			$price = $_POST['price'];
			$sale = $_POST['onsale'];
			$oldPrice = $_POST['old_price'];
			$key = $_POST['gamekey'];
			$amount = (int)$_POST['amount'];
			$platform = $_POST['platform'];

			$featured = $_POST['featured'];
			
			if($featured == 'on')
				$featured = 1;
			else
				$featured = 0;
				
			if($sale == 'on')
				$sale = 1;
			else
				$sale = 0;
			
			$query = "INSERT INTO products VALUES (NULL, '$itemID', '$item', '$desc', '$filename', '$amount', '$price', '$platform','$sale', '$oldPrice', '$featured')";
			
			if($link->query($query) or die(mysqli_error($link)))
			{
				for($i = 0; $i < $amount; $i++)
				{
					$query = "INSERT INTO gamekeys VALUES(NULL, '$key', '$itemID','0', '');";
					$link->query($query) or die(mysqli_error($link));
				}
				
				move_uploaded_file($_FILES['upload']['tmp_name'], "images/" . $filename);
			}
		}
	}
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
				<form action="addgames.php" method='POST' id="game_add" enctype="multipart/form-data">
					<div class="game_name">
						<label for="item_name">Name: </label>
						<input type="text" name="item_name" id="item_name" placeholder="Item Name">
					</div>
					
					<div class="game_image">
						<label for="upload">Image: </label> 
						<input type="file" name="upload" id="upload">
					</div>
					
					<div class="game_description">
						<label for="description">Description: </label>
						<textarea name="description" id="description" placeholder="Item Description"></textarea>
					</div>
					
					<div class="game_price">
						<label for="price">Price: </label>
						<input type="text" name="price" id="price" placeholder="Item Price in euro">
					</div>
					
					<div class="game_sale">
						<label for="onsale">On Sale: </label>
						<input type="checkbox" name="onsale" id="onsale">
					</div>
					
					<div class="game_old_price">
						<label for="old_price">Old Price: </label>
						<input type="text" name="old_price" id="old_price" placeholder="Item Old price in USD">
					</div>
					
					<div class="game_platform">
						<label for="platform">Platform: </label>
						Steam <input type="radio" name="platform" value="1">
						Origin <input type="radio" name="platform" value="2">
						Direct <input type="radio" name="platform" value="3">
					</div>
					
					<div class="game_key">
						<label for="gamekey">Game Key: </label>
						<input type="text" name="gamekey" id="gamekey" placeholder="Game Keys or download link">
					</div>
					
					<div class="game_amount">
						<label for="amount">Quantity: </label>
						<input type="number" name="amount" id="amount" min="0" value="1">
					</div>
					
					<div class="game_featured">
						<label for="featured">Featured: </label>
						<input type="checkbox" name="featured" id="featured">
					</div>
						<input type="hidden" name="gameid" value='<?php echo $gameid; ?>'>
						<input type="submit" name="submit" value="submit">
				</form>
			</div>
		</div>
	</body>
</html>