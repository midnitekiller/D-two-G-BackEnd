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
$data = json_decode(file_get_contents('php://input'));

$res = ($api->addRestaurantCart($data->menu_id, $data->guest_id, $data->hotel_id, $data->restaurant_id, $data->qty))? "true":"false";
$result = json_encode(array('success' => $res));

$output = array('data' => $result);
$content = new Template('views/index.php', $output);

echo $content->render();
?>
