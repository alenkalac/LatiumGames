<!DOCTYPE html>
<?php
	include_once 'connect.php';
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
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Latium Games | Cart</title>
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
			
			<?php
				if(isset($_POST['clear_cart']))
				{
					unset($_SESSION['CART']);
					unset($_SESSION['PRICE_EURO']);
				}
			
			?>
			
			<div id="body_content">
				<div id="cart" class="content_holder payment">
					<span class="content_label">Your Basket</span>
					<table>
						<tr>
							<th>Item Name</th>
							<th>Quantity</th>
							<th>Price LAT</th>
							<th>Price EUR</th>
							<th>Delete</th>
						</tr>
						<?php
						
							if(isset($_SESSION['CART']) && count($_SESSION['CART']) > 0)
							{
								$query = "SELECT * FROM products WHERE gameid IN(";
								
								foreach($_SESSION['CART'] as $item)
								{
									$safe_item = $item['prod_id'];
									$safe_item = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($safe_item))))));
									$query .= "'" . $safe_item . "',";
								}
								
								$query = substr($query, 0, -1);
								$query .= ")";
								
							//	echo $query;
								$result = $link->query($query);
								$total_price = 0;
								$total_price_euro = 0;
								while($row = mysqli_fetch_array($result))
								{
									$total_price_euro += $row['price'];
									$item = searchForId($row['gameid'], $_SESSION['CART']);
									echo "<tr id='product_" . $item . "'>";
									echo "<td class='td_name'>";
									echo $row['name'];
									echo "</td>";
									
									echo "<td>";
									//echo "<input type='number' max='" . (int)$row['amount'] . "' min='0' value='" . $_SESSION['CART'][$item]['amount'] . "'>";
									echo $_SESSION['CART'][$item]['amount'];
									echo "</td>";
									
									echo "<td class='row_price'>";
									$price = number_format(($eurobtc / (float)$lowprice) * (float)$row['price'], 0, "." ,"");
									$total_price += $price;
									echo $price . " LAT";
									echo "</td>";
										
									echo "<td class='row_price'>";
										echo "&euro;" . number_format($row['price'], 2, "." ,"");
									echo "</td>";
									
									echo "<td>";
									echo "<a href='#' class='delete_item' onclick='return remove_item($item);'>X</a>";
									echo "</td>";
									echo "</tr>";
									
								}
								
									$total_price_euro = number_format($total_price_euro, 2, ".", "");
									$_SESSION["PRICE_EURO"] = $total_price_euro;			
								echo 	"<tr>
											<td colspan='2'>Total LAT - EURO</td>
											<td class='row_price'>$total_price LAT</td>
											<td class='row_price'>&euro;" . $_SESSION['PRICE_EURO'] . "</td>
											<td></td>
										</tr>";
								
										
								
							}
							else
							{
								echo "<tr><td>cart is empty</td></tr>";
								unset($_SESSION['CART']);
							}
						?>
					</table>
					<form action="#" method="post">
						<input type="hidden" name="clear_cart">
						<input type="submit" value="Empty Cart">
					</form>
					
					
				</div>
				<div id="cart" class="content_holder payment">
					<span class="content_label">Payment Section</span>
					<form action="payment.php" method="post" class="cart_form">
						<input type="submit" value="PAY WITH LATIUM" class="pay_link" >
					</form>
					
					<!-- INFO: The post URL "checkout.php" is invoked when clicked on "Pay with PayPal" button.-->
					<form action='paypal_checkout/checkout.php' METHOD='POST' class="cart_form">
						<input type='image' name='paypal_submit' id='paypal_submit'  src='https://www.paypal.com/en_US/i/btn/btn_dg_pay_w_paypal.gif' border='0' align='top' alt='Pay with PayPal'/>
					</form>
					
				</div>
			</div>
		</div>
	</body>
	
<!-- Add Digital goods in-context experience. Ensure that this script is added before the closing of html body tag -->

<script src='https://www.paypalobjects.com/js/external/dg.js' type='text/javascript'></script>


<script>

	var dg = new PAYPAL.apps.DGFlow(
	{
		trigger: 'paypal_submit',
		expType: 'instant'
		 //PayPal will decide the experience type for the buyer based on his/her 'Remember me on your computer' option.
	});

</script>

</html>