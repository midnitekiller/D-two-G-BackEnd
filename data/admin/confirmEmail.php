<?php
error_reporting(E_ALL & ~E_NOTICE);
/* session */
session_start();

header("Content-Type: text/html; charset=utf-8");


/* includes */
include("includes/Templates.php");
include("includes/Constants_login.php");

/* data and display */

$data_header = array('title' => MAIN_TITLE, 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);


$header = new Template('views/content-header.php', $data_header);
$content = new Template('views/confirmEmail.php');
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $content->render();
echo $footer->render();

?>
