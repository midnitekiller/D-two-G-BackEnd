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
if(isset($_GET['offer_id']) && isset($_GET['hotel_id'])){
	$menus = $api->getOfferDetailsList($_GET['offer_id'],$_GET['hotel_id']);
	$result = json_encode($menus);
}else{
	$result = json_encode(array('success' => "false"));
}

$output = array('data' => $result);
$content = new Template('views/index.php', $output);

echo $content->render();
?>
