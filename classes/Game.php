<?php
	//require_once '/../price_stuff.php';
	class Game
	{
		function __construct($row, $price)
		{
			?>
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
				
					if($row['on_sale'])
						echo "<span class='steam_price'>$" . $row['old_price'] . " </span>";
					echo "<span class='lat_price'> " . $price . " LAT</span>";
				?>
			</div>
	
			<div class='prod_buttons'>
			<a href="" class="buy_button" onclick="return addToCart('<?php echo $row['gameid']; ?>', '1');">Add to Cart</a>
			<a href="item.php?itemid=<?php echo $row['gameid']; ?>" class="info_button">More Info</a>
			</div>
		</div>
	
		<div class='item_description'><?php echo $row['desc']; ?></div>
		<?php 
		}
	}
?>