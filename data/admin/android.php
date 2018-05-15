<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();

header("Content-Type: text/html; charset=utf-8");

include("includes/Templates.php");
include("includes/Constants.php");
include("model/Database.php");
include("model/UserClass.php");
include("model/ChatClass.php");
include("model/HotelClass.php");

$ho = new Hotels();
$ch = new Chats();
$uc = new User();


if(!isset($_SESSION['email']) || !isset($_SESSION['verify'])) {
	header("location: index.php");
	exit();
}else{
	$usertype = $uc->checkUserType($_SESSION['email']);
	if($usertype == "superadmin"){
		header("location: ".BASE_URL."SuperDashboard.php");
		exit();
	}elseif($usertype == "advertiser"){
		exit();
	}
}
/*
|===========================================================================
|=======================DISPLAYING DATA FROM DATABASE=======================
|===========================================================================
*/
$name = $uc->getName($_SESSION['email']);
$hotelid = $_SESSION['hotel_id'];
$hotel_logo = $ho->fetchViewHotelLogo($_SESSION['hotel_id']);
$hotname = $ho->getHotelName($_SESSION['hotel_id']);
$hotelname = preg_replace("/[^a-zA-Z]+/", "", $hotname);
$guestnav = $ch->getGuestsByMessage($hotelid);
$gcount = $ch->getCountUnseenGuests($hotelid);
$hotel_lists = $ho->fetchViewHotelImage($hotelid);
$data_header = array('title' => HOTEL_PROFILE.$hotname , 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_nav = array('baseUrl' => BASE_URL, 'name' => $name, 'hotelid' => $hotelid, 'guestnav' => $guestnav, 'gcount' => $gcount, 'hotelname' => $hotname, 'hotel_logo' => $hotel_logo);
$data_content = array('baseUrl' => BASE_URL, 'name' => $name, 'hotelid' => $hotelid,  'hotel' => $hotel_lists, 'hotel_name' => $hotname, 'hotel_logo' => $hotel_logo, 'hotel_image' => $hotel_logo, 'background_image' => $hotel_logo);
$header = new Template('views/content-header.php', $data_header);
$nav = new Template('views/content-sidenav.php', $data_nav);
$content = new Template('views/android.php',$data_content);
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $nav->render();
echo $content->render();
echo $footer->render();
?>