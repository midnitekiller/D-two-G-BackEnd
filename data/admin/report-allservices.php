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
include("model/HotelClass.php");
include("model/ChatClass.php");
$ch = new Chats();
$uc = new User();
$ho = new Hotels();


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
$name = $uc->getName($_SESSION['email']);
$hotels = $ho->getHotels();
$messages = $ch->getHotelIDsbyMessage('admin', 'superadmin');
$count = $ch->getCountUnseenMessages('admin', 'superadmin');
$data_header = array('title' => MAIN_TITLE, 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_nav = array('baseUrl' => BASE_URL, 'name' => $name, 'messages'=>$messages, 'chatcount' => $count);
$data_modal = array('hotels' => $hotels);

$header = new Template('views/content-header.php', $data_header);
$nav = new Template('views/content-sidenavbar.php',$data_nav);
$adddevice = new Template('views/adddevice.php', $data_modal);
$content = new Template('views/report-allservices.php');
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $nav->render();
echo $adddevice->render();
echo $content->render();
echo $footer->render();

?>
