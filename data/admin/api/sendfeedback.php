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

$feedback = $api->sendFeedbackRating($data->message, $data->hotel_id, $data->guest_id, $data->overall, $data->location, $data->room, $data->service, $data->value, $data->cleanliness, $data->restaurant);
$result = json_encode(array('success' => $feedback));

$output = array('data' => $result);
$content = new Template('views/index.php', $output);

echo $content->render();
?>
