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
include("model/AdvertClass.php");
include("model/ChatClass.php");
include("model/SettingClass.php");

$uc = new User();
$ho = new Hotels();
$ads = new Advertisement();
$ch = new Chats();
$profile_db = new Setting();

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
$advertisements = $ads->getAdvertisement();
$datetoday = date('F d, Y');
$dt = strtotime(date('Y-m-d H:i:s'));
$messages = $ch->getHotelIDsbyMessage('admin', 'superadmin');
$count = $ch->getCountUnseenMessages('admin', 'superadmin');
$profile_lists = $profile_db->displayProfile($_SESSION['email']);
$change_lists = $profile_db->displayProfile($_SESSION['email']);

foreach($advertisements as $key => $ad){
	if(strtotime($ad['ad_time_end']) < $dt){
		$expired = "expired";
	}else{
		$expired = "active";
	}
	$advert[$key]['id'] = $ad['ads_ID'];
	$advert[$key]['company'] = $ads->getCompanyName($ad['company_ID']);
	$advert[$key]['name'] = $ad['ad_title'];
	$advert[$key]['type'] = $ads->getPlacesType($ad['adtype_ID']);
	$advert[$key]['hotel'] = $ho->getHotelName($ad['hotel_ID']);
	$advert[$key]['from'] = date('F d, Y', strtotime($ad['ad_time_start']));
	$advert[$key]['to'] =	date('F d, Y', strtotime($ad['ad_time_end']));
	$advert[$key]['expired'] = $expired;
}

$data_header = array('title' => NEARBY_TITLE, 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_nav = array('baseUrl' => BASE_URL, 'name' => $name, 'chats' => $messages, 'chatcount' => $count);
$data_modal = array('hotels' => $hotels, 'profile' => $profile_lists, 'change' => $change_lists);
$data_content = array('hotels' => $hotels, 'advertisements' => $advert);

$header = new Template('views/content-header.php', $data_header);
$nav = new Template('views/content-sidenavbar.php',$data_nav);
$adddevice = new Template('views/adddevice.php', $data_modal);
$profile = new Template('views/ProfileManagement.php', $data_modal);
$change_pwd = new Template('views/changePassword.php', $data_modal);
$content = new Template('views/displaynearby.php', $data_content);
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $nav->render();
echo $adddevice->render();
echo $profile->render();
echo $change_pwd->render();
echo $content->render();
echo $footer->render();

?>