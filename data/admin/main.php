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
include("model/AdminDashboardClass.php");
include("model/SettingClass.php");

$ho = new Hotels();
$ch = new Chats();
$uc = new User();
$dashboard_db = new AdminDashboard();
$profile_db = new Setting();


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
|=======================DISPLAYING DATA INTO DASHBOARD======================
|===========================================================================
*/
$guests = $dashboard_db->fetchViewGuests($_SESSION['hotel_id']);
$restaurant = $dashboard_db->fetchRestaurant($_SESSION['hotel_id']);
$service = $dashboard_db->fetchService($_SESSION['hotel_id']);
$booking = $dashboard_db->fetchBooking($_SESSION['hotel_id']);
$channels = $dashboard_db->fetchChannels($_SESSION['hotel_id']);
$housekeeping = $dashboard_db->fetchHousekeeping($_SESSION['hotel_id']);
$feedback = $dashboard_db->fetchFeedback($_SESSION['hotel_id']);
$staff = $dashboard_db->fetchStaff($_SESSION['hotel_id']);
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
$profile_lists = $profile_db->displayProfile($_SESSION['email']);
$change_lists = $profile_db->displayProfile($_SESSION['email']);
$data_header = array('title' => MAIN_TITLE.$hotname , 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_nav = array('baseUrl' => BASE_URL, 'name' => $name, 'hotelid' => $hotelid, 'guestnav' => $guestnav, 'gcount' => $gcount, 'hotelname' => $hotname, 'hotel_logo' => $hotel_logo);
$data_content = array('baseUrl' => BASE_URL, 'name' => $name, 'hotelid' => $hotelid, 'hotelname' => $hotelname, 'guests' => $guests,  'restaurant' => $restaurant, 'service' =>                           $service, 'booking' => $booking, 'channels' => $channels, 'housekeeping' => $housekeeping, 'feedback' => $feedback, 'staff' => $staff);
$data_modal = array('hotels' => $hotels, 'hotelid' => $hotelid, 'profile' => $profile_lists, 'change' => $change_lists);

$header = new Template('views/content-header.php', $data_header);
$nav = new Template('views/content-sidenav.php', $data_nav);
$write_up = new Template('views/hotel-writeup.php', $data_modal);
$profile = new Template('views/ProfileManagement.php', $data_modal);
$change_pwd = new Template('views/changePassword.php', $data_modal);
$content = new Template('views/dashboard.php',$data_content);
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $nav->render();
echo $write_up->render();
echo $profile->render();
echo $change_pwd->render();
echo $content->render();
echo $footer->render();

?>