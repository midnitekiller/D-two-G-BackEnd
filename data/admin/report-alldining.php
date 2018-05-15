<?php
error_reporting(E_ALL & ~E_NOTICE);
/* session */
session_start();

header("Content-Type: text/html; charset=utf-8");


/* includes */
include("includes/Templates.php");
include("includes/Constants.php");
include("model/Database.php");
include("model/UserClass.php");
include("model/ChatClass.php");
$ch = new Chats();
$uc = new User();

if(!isset($_SESSION['email']) || !isset($_SESSION['verify'])) {
	header("location: index.php");
	exit();
}else{
	$usertype = $uc->checkUserType($_SESSION['email']);
	if($usertype == "admin"){
		header("location: ".BASE_URL."main.php");
		exit();
	}elseif($usertype == "advertiser"){
		exit();
	}
}
/* data and display */
/* data and display */
$name = $uc->getName($_SESSION['email']);
$messages = $ch->getHotelIDsbyMessage('admin', 'superadmin');
$count = $ch->getCountUnseenMessages('admin', 'superadmin');
$data_header = array('title' => MAIN_TITLE, 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_nav = array('baseUrl' => BASE_URL, 'name' => $name, 'messages' => $messages, 'chatcount' => $count);

$header = new Template('views/content-header.php', $data_header);
$nav = new Template('views/content-sidenavbar.php',$data_nav);
$content = new Template('views/report-alldining.php');
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $nav->render();
echo $content->render();
echo $footer->render();

?>


