<?php
error_reporting(E_ALL & ~E_NOTICE);
/* session */
session_start();

header("Content-Type: text/html; charset=utf-8");

/* includes */
include("../includes/Templates.php");
include("../model/Database.php");
include("../model/APIClass.php");

$api = new API();
if(isset($_GET['guest_id']) && isset($_GET['restaurant_id'])){
	$cart = $api->getRestaurantCartList($_GET['guest_id'],$_GET['restaurant_id']);
	$carttotal = 0;
	foreach($cart as $i => $c){
		$carttotal += $c['subtotal'];
	}
	$data = json_encode(array('cart' => $cart, 'cart_grand_total' => $carttotal));
	
}else{
	$data = json_encode(array('success' => "false"));
}
$output = array('data' => $data);
$content = new Template('views/index.php', $output);

echo $content->render();
?>
