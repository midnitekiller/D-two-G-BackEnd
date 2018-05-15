<?php
session_start();
include '../model/Database.php';
include '../model/DeviceClass.php';

$dev = new Device();

switch($_POST['action']){
	case 'Add Device':
		addDevice($_POST);
		break;
	case 'Remove Device':
		deleteDevice($_POST);
		break;
	case 'Update Device':
		editDevice($_POST);
		break;
	case 'Get Rooms':
		getRooms($_POST);
		break;
	default:
		echo "Unknown Post";
		break;
}

function addDevice($data){
	global $dev;
	$result = ($dev->registerDevice($data)) ? "true" : "false";
	echo $result;
}

function deleteDevice($data){
	global $dev;
	$result = ($dev->removeDevice($data)) ? "true" : "false";
	echo $result;
}

function editDevice($data){
	global $dev;
	if($dev->checkRoomNumberExist($data['roomnumber'], $data['hotelname'])){
		
		$result = "exist";
	}else{
		$result = ($dev->updateDevice($data)) ? "true" : "false";
	}
	echo $result;
}

function getRooms($data){
	global $dev;
	$result = $dev->getRooms($data);
	if(!empty($result)){
		foreach($result as $key => $device){
			$devs[$key] = $device['room_no'];
		}
	
		echo json_encode($devs);
	}else{
		echo "0";
	}
}

?>