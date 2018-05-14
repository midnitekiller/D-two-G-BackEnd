<?php
error_reporting(E_ALL & ~E_NOTICE);
/* session */
session_start();

header("Content-Type: text/html; charset=utf-8");

/* includes */
include("includes/Templates.php");
include("includes/Constants.php");
include("model/Database.php");
include("model/AdminClass.php");
$admin_db = new Admin();
$info = $admin_db->fetchUserInformation($_SESSION['email']); 
$question = $admin_db->loadOneQuestion($info['Secret_Question']);

$data_header = array('title' => MAIN_TITLE, 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_content = array('question' => $question, 'email' => $info['email']);


$header = new Template('views/content-header.php', $data_header);
$content = new Template('views/SecretQuestion.php', $data_content);
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $content->render();
echo $footer->render();

?>
