<nav>
	<ul>
		<li><a href="/">Home</a></li>
		<li><a href="products.php">Products</a></li>
		<li><a href="ref.php">Get Latium</a></li>
		<li><a href="#">Contact</a></li>
		<li><a href="#">About</a></li>
		<li><a href="cart.php">Basket (<?php session_start(); if(isset($_SESSION['CART'])) echo sizeof($_SESSION['CART']); else echo '0'; ?>)</a></li>
		<li><a href="#" onclick="return showLogin();">Login</a></li>
	</ul>
</nav>