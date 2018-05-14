<?php
error_reporting(E_ALL & ~E_NOTICE);
/* session */
session_start();

header("Content-Type: application/json");

/* includes */
include("../includes/Templates.php");
include("../model/Database.php");
include("../model/APIClass.php");

$api = new API();
$data = json_decode(file_get_contents('php://input'));
$chats = $api->updateChatStatus($data->hotel_id, $data->guest_id);
$result = array('success' => $chats);


echo json_encode($result);
?>
