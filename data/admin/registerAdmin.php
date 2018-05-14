<?php
error_reporting(E_ALL & ~E_NOTICE);
/* session */
session_start();

header("Content-Type: text/html; charset=utf-8");


/* includes */
include("includes/Templates.php");
include("includes/Constants_login.php");
include("includes/Constants.php");
include("model/Database.php");
include("model/AdminClass.php");
include("model/UserClass.php");

$admin = new Admin();
$uc = new User();


/* data and display */
if(isset($_SESSION['email']) || isset($_SESSION['verify'])) {
	$usertype = $uc->checkUserType($_SESSION['email']);
	if($usertype == "superadmin"){
		header("location: ".BASE_URL."SuperDashboard.php");
	}elseif($usertype == "admin"){
		header("location: ".BASE_URL."main.php");
	}elseif($usertype == "advertiser"){
		
	}
}

$questions = $admin->loadQuestions();

$data_header = array('title' => MAIN_TITLE, 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_content = array('secquest' => $questions);

$header = new Template('views/content-header.php', $data_header);
$content = new Template('views/registerAdmin.php', $data_content);
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $content->render();
echo $footer->render();

?>
