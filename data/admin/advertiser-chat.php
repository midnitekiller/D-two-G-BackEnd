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
include("model/GuestsClass.php");
include("model/ChatClass.php");
include("model/HotelClass.php");
include("model/SettingClass.php");
  
$ho = new Hotels();
$uc = new User();
$gu = new Guests();
$ch = new Chats();
$profile_db = new Setting();

/*if(!isset($_SESSION['email']) || !isset($_SESSION['verify'])) {
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
}*/

if(!isset($_GET['guest_ID'])){
	$guestidd = "";
}else{
	$guestidd = $_GET['guest_ID'];
}
if(!isset($_GET['usertype'])){
	$usertype = "su";
}else{
	$usertype = $_GET['usertype'];
}
/* data and display */
$name = $uc->getName($_SESSION['email']);
$guests = $gu->getAllGuests($_SESSION['hotel_id']);
$sucount = $ch->getUnseenCountSuperadmin($_SESSION['hotel_id'],'superadmin');
$ourid = $_SESSION['hotel_id'];
$hotel_logo = $ho->fetchViewHotelLogo($_SESSION['hotel_id']);
$hotname =$ho->getHotelName($_SESSION['hotel_id']);
$hotelname = preg_replace("/[^a-zA-Z]+/", "", $hotname);
$guesss[0]['unseen_count'] = $sucount;
foreach($guests as $index => $gui){
	$guests[$index]['guest_name'] = $gui['firstname']." ".$gui['lastname'];
	$guests[$index]['unseen_count'] = $ch->getUnseenCountGuest($_SESSION['hotel_id'], $gui['guest_ID'], 'admin');
	
	$guesss[$index+1] = $guests[$index];
}
$guestnav = $ch->getGuestsByMessage($_SESSION['hotel_id']);
$gcount = $ch->getCountUnseenGuests($_SESSION['hotel_id']);
$profile_lists = $profile_db->displayProfile($_SESSION['email']);
$change_lists = $profile_db->displayProfile($_SESSION['email']);
$data_header = array('title' => CHATADS_TITLE , 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_nav = array('baseUrl' => BASE_URL, 'name' => $name,'guestnav'=>$guestnav,'gcount'=> $gcount, 'hotelid' => $ourid, 'hotelname' => $hotname, 'hotel_logo' => $hotel_logo);
$data_content = array('sucount' => $sucount, 'guests' => $guests, 'guestidd' => $guestidd, 'usertype' => $usertype, 'ourid' => $ourid, 'guesting' => $guesss,'hotelid'=>$ourid);
$data_modal = array('hotels' => $hotels, 'hotelid' => $hotelid, 'profile' => $profile_lists, 'change' => $change_lists);

$header = new Template('views/content-header.php', $data_header);
$nav = new Template('views/content-sideads.php',$data_nav);
$profile = new Template('views/ProfileManagement.php', $data_modal);
$change_pwd = new Template('views/changePassword.php', $data_modal);
$content = new Template('views/advertiser-chat.php', $data_content);
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $nav->render();
echo $profile->render();
echo $change_pwd->render();
echo $content->render();
echo $footer->render();

?>
