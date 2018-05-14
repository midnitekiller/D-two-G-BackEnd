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
include("model/UserClass.php");

$uc = new User();

/* data and display */
if(isset($_GET['logout'])) {
	//offline table
	session_destroy();
}
if(isset($_SESSION['email']) || isset($_SESSION['verify'])) {
	$usertype = $uc->checkUserType($_SESSION['email']);
	if($usertype == "superadmin"){
		header("location:SuperDashboard.php");
	}elseif($usertype == "admin"){
		header("location:main.php");
	}elseif($usertype == "advertiser"){
		header("location:advertiser-dashboard.php");
	}
}

$data_header = array('title' => MAIN_TITLE, 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);

$header = new Template('views/content-header.php', $data_header);
$content = new Template('views/index.php');
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $content->render();
echo $footer->render();
?>
