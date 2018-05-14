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

if(isset($_GET['hotel_id'])){
	
	$hotelstatus = $api->getHotelStatus($_GET['hotel_id']);
	$data = json_encode(array('status' => $hotelstatus));

}else{
	$data = json_encode(array('status' => "false"));
}
$output = array('data' => $data);

$content = new Template('views/index.php', $output);

echo $content->render();
?>
