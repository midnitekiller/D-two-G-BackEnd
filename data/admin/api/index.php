<?php
error_reporting(E_ALL & ~E_NOTICE);
/* session */
session_start();

header("Content-Type: text/html; charset=utf-8");


/* includes */
include("../includes/Templates.php");
include("../model/Database.php");
include("../model/APIClass.php");

$api = new API();

if(isset($_GET['device_id'])){
	$result = $api->getHotelID($_GET['device_id']);

	$hotel = $api->getHotelInfo($result['hotel_ID']);

	$guest = $api->getGuestInfoByRoomNo($result['room_no'], $result['hotel_ID']);

	$restaurants = $api->getRestaurants($result['hotel_ID']);

	$acs = $api->getHotelAccess($result['hotel_ID']);

	$access = [];
	foreach($acs as $i => $ac){
		array_push($access, $ac['access_name']);
	}

	$adRestaurant = $api->getAdsRestaurant($result['hotel_ID']);

	$adNightlife = $api->getAdsNightlife($result['hotel_ID']);

	$adActivities = $api->getAdsActivities($result['hotel_ID']);

	$placesnearby = array('restaurant' => $adRestaurant, 'activities' => $adActivities, 'nightlife' => $adNightlife);
	
	if($result){
		$success = true;
	}else{
		$success = false;
	}
	$data = json_encode(array('hotel' => $hotel, 'access' => $access, 'guest' => $guest, 'restaurants' => $restaurants, 'ads' => $placesnearby, 'success' => $success));

}else{
	$data = json_encode(array('success' => "false"));
}
$output = array('data' => $data);

$content = new Template('views/index.php', $output);

echo $content->render();
?>
