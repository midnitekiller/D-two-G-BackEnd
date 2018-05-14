<?php
session_start();
include '../model/Database.php';
include '../model/NotifClass.php';

$notif = new Notif();

switch($_POST['action']){
	case 'Ajax Notifications':
		getNotifications($_POST);
		break;
	case 'Set Notification Foods':
		setNotificationFoods($_POST);
		break;
	case 'Set Notification Services':
		setNotificationServices($_POST);
		break;
	case 'Set Notification Housekeeping':
		setNotificationHousekeeping($_POST);
		break;
	case 'Set Notification FeedBack':
		setNotificationFeedback($_POST);
		break;
	
	default:
		echo "Unknown Post";
		break;
}

function getNotifications($data){
	extract($data);
	global $notif;
	
	$food = $notif->fetchOrder($hotelid);
	$services = $notif->fetchService($hotelid);
	$housekeeping = $notif->fetchHouseK($hotelid);
	$feedback = $notif->fetchFeedback($hotelid);
	if($food == null){
		$food = 0;
	}
	
	if($services == null){
		$services = 0;
	}
	
	if($housekeeping == null){
		$housekeeping = 0;
	}
	
	if($feedback == null){
		$feedback = 0;
	}
	
	$json = new \stdClass();
	$json->foods_count = (string)$food;
	$json->services_count = (string)$services;
	$json->housekeeping_count = (string)$housekeeping;
	$json->feedback_count = (string)$feedback;
	$Obj = json_encode($json);
	
	echo $Obj;
	
	
}

function setNotificationFoods($data){
	extract($data);
	global $notif;
	$set = $notif->setFoods($data);
}

function setNotificationServices($data){
	extract($data);
	global $notif;
	$set = $notif->setServices($data);
}

function setNotificationHousekeeping($data){
	extract($data);
	global $notif;
	$set = $notif->setHousekeeping($data);
}

function setNotificationFeedback($data){
	extract($data);
	global $notif;
	$set = $notif->setFeedBack($data);
}
?>