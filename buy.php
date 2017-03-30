<?php
	session_start();
	//unset($_SESSION['CART']);
	function searchForId($id, $array) 
	{
		foreach ($array as $key => $val) 
		{
			if ($val['prod_id'] === $id)
				return $key;
		}
	   return -1;
	}
	
	
	
	if(isset($_POST['itemID']))
	{
		$itemID = $_POST['itemID'];
		$itemID = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9 ]/', ' ', urldecode(html_entity_decode(strip_tags($itemID))))));
		if(isset($_SESSION['CART']))
		{
			
			$key = searchForId($itemID, $_SESSION['CART']);
			if($key != -1)
			{
				$amount = (int)$_POST['amount'];
				if($amount > $_SESSION['CART'][$key]['amount'])
					$_SESSION['CART'][$key] = array('prod_id' => $itemID, 'amount' => $_SESSION['CART'][$key]['amount']+1);
			}
			else
				array_push($_SESSION['CART'], array('prod_id' => $itemID, 'amount' => 1));
		}
		else
		{
			$_SESSION['CART'] = array();
			array_push($_SESSION['CART'], array('prod_id' => $itemID, 'amount' => 1));
		}
	}
	
	if(isset($_POST['delete_item']))
	{
		$item = (int)$_POST['delete_item'];
		unset($_SESSION['CART'][$item]);
		
		if(count($_SESSION['CART']) == 0)
		{
			unset($_SESSION['CART']);
		}
	}
	
	$sarray = serialize($_SESSION['CART']); 
	//echo $sarray; 
?>