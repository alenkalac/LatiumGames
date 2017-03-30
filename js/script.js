function showLogin()
{
	if($('#container').css("top") != "0px")
		$('#container').css("top", "0px");
	else
		$('#container').css("top", "-50px");
	return false;
}

function showItem(itemID)
{
	window.location.href = "item.php?itemid=" + itemID;
}

$(document).ready(function(){
	$('.newsticker').newsTicker({
    row_height: 25,
    max_rows: 1,
    speed: 300,
    direction: 'down',
    duration: 6000,
    autostart: 1,
    pauseOnHover: 0
	});
});

function addToCart(item, amount)
{
	$.ajax({
		type: 'POST',
		url: 'buy.php',
		data: {'itemID': item, 'amount': amount}
	}).done(function(){
		$('#navigation').load("navbar.php");
		show_lightbox();
		return false;
	});
	
	return false;
	
	
}

function remove_item(item) 
{
	$.ajax({
		type: 'POST',
		url: 'buy.php',
		data: {'delete_item': item}
	}).done(function(e){
		window.location.href = "cart.php";
	});
	
	return false;
}

function hide_lightbox()
{
	$("#lightbox").css("visibility", "hidden");
}

function show_lightbox()
{
	$("#lightbox").css("visibility", "visible");
}