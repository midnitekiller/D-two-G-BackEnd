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

/* data and display */
$name = $uc->getName($_SESSION['email']);
$hotels = $ho->getHotels();
$categories = $ads->getAdType();
$companies = $ads->getCompanies();
$messages = $ch->getHotelIDsbyMessage('admin', 'superadmin');
$count = $ch->getCountUnseenMessages('admin', 'superadmin');
$profile_lists = $profile_db->displayProfile($_SESSION['email']);
$change_lists = $profile_db->displayProfile($_SESSION['email']);
$data_header = array('title' => ADDNEARBY_TITLE, 'keywords' => MAIN_KEYWORDS, 'description' => MAIN_DESCRIPTION);
$data_nav = array('baseUrl' => BASE_URL, 'name' => $name, 'messages' => $messages, 'chatcount' => $count);
$data_modal = array('hotels' => $hotels, 'categories' => $categories, 'profile' => $profile_lists, 'change' => $change_lists);
$data_content = array('hotels' => $hotels, 'categories' => $categories, 'companies' => $companies);

$header = new Template('views/content-header.php', $data_header);
$nav = new Template('views/content-sidenavbar.php', $data_nav);
$adddevice = new Template('views/adddevice.php', $data_modal);
$profile = new Template('views/ProfileManagement.php', $data_modal);
$change_pwd = new Template('views/changePassword.php', $data_modal);
$content = new Template('views/manage-advertiserAds.php', $data_content);
$footer = new Template('views/content-footer.php');

echo $header->render();
echo $nav->render();
echo $adddevice->render();
echo $profile->render();
echo $change_pwd->render();
echo $content->render();
echo $footer->render();

?>