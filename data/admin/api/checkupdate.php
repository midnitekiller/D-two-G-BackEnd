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

$menus = $api->getAppUpdate();
$result = json_encode($menus);

$output = array('data' => $result);

$content = new Template('views/index.php', $output);

echo $content->render();
?>
