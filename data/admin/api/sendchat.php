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
$chats = $api->sendChatMessage($data);
$result = array('success' => $chats);

echo json_encode($result);

?>
