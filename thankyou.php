<!DOCTYPE html>
<?php
	include_once 'connect.php';
	include_once 'price_stuff.php';
?>
<html>
	<html>
	<head>
		<meta charset="utf-8">
		<title>Thank You!</title>
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
				<div class="content_holder new_games">
					
						<?php
							include_once('connect.php');
							
							if(isset($_GET['tid']))
							{
								$tid = $_GET['tid'];
								$tid = mysqli_real_escape_string($link, $tid);
								$query = "SELECT * FROM gamekeys INNER JOIN products ON gamekeys.gameid = products.gameid WHERE belongs_to = '$tid'";
								$result = $link->query($query) or die("ERROR");
								echo "<span class=\"content_label\">Your Keys for Transaction: $tid</span>";
								
								echo "<ul class=\"product_ul\">";
								while($row = mysqli_fetch_assoc($result))
								{
									echo "<li>";
									echo "<div class='basic_info'>";
									echo "<div class='prod_img'>";
									echo "<img src=images/" . $row['image'] . ">";
									echo "<div class='platform'>";
									
									switch((int)$row['platform'])
									{
										case 1: echo '<img src="images/steam.png" >'; break;
										case 2: echo '<img src="images/origin.png" >'; break;
										case 3: echo '<img src="images/download.png" >'; break;
									}
									
									echo "</div>";
									echo "</div>";
									
									echo "<div class='prod_name'>";
									echo $row['name'];
									echo "</div>";
								
								
									echo "<div class='prod_key'>";
									echo $row['key'];
									echo "</div>";
									
									
									echo "</div>";
									
									echo "<div class='item_description'>";
									echo $row['desc'];
									echo "</div>";
									echo "</li>";
								}
							}
						?>
					</ul>
				</div>
			</div>
		</div>
	</body>
</html>