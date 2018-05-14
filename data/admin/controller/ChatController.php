<?php
session_start();
include '../model/Database.php';
include '../model/ChatClass.php';
include '../model/HotelClass.php';
include '../model/GuestsClass.php';

$chat = new Chats();
$ho = new Hotels();
$gu = new Guests();

switch($_POST['action']){
	case 'Send Message':
		sendMessage($_POST);
		break;
	case 'Get Messages':
		getMessages($_POST);
		break;
	case 'Refresh Count':
		getUCount($_POST);
		break;
	case 'Get Last Unseen Messages':
		getLastUnseenMessages($_POST);
		break;
	case 'Change Status':
		changeMessageStatus($_POST);
		break;
	case 'Refresh Nav Message':
		getMessageNav($_POST);
		break;
	case 'Refresh Nav Message Guest':
		getMessageNavGuest($_POST);
		break;
	case 'Refresh Unseen Count':
		getRefreshUCount($_POST);
		break;
	case 'Refresh Unseen Guest Count':
		getRefreshGuestCount($_POST);
		break;
	default:
		echo "Unknown Post";
		break;
}

function sendMessage($data){
	extract($data);
	global $chat;
	if($msg == ""){echo "";
	}else{$result = $chat->sendMessageFromSuperadmin($data);
	echo $result;}
}

function getMessages($data){
	global $chat;
	$result = $chat->getMessages($data);
	foreach($result as $key => $res){
		$result[$key]['created_at'] = date('M d, Y - H:i', strtotime($res['created_at']));
		
	}
	echo json_encode($result);
}

function getUCount($data){
	extract($data);
	global $chat, $ho, $gu;
	if(isset($hotel_id)){
		$guestcontent = $gu->getAllGuests($hotel_id);
		$sucount = $chat->getUnseenCountSuperadmin($hotel_id,'superadmin');
		$guests = [];
		$guests[0]['unseen_count'] = $sucount;
		foreach($guestcontent as $i => $gui){
			$guestcontent[$i]['unseen_count'] = $chat->getUnseenCountGuest($hotel_id,$gui['guest_ID'],'admin');
			$guests[$i+1] = $guestcontent[$i];
		}
		echo json_encode($guests);
	}else{
		$hotelcontent = $ho->getHotels();
		foreach($hotelcontent as $i => $hot){
			$hotelcontent[$i]['unseen_count'] = $chat->getUnseenCount($hot['hotel_ID'], 'superadmin');
		}
		echo json_encode($hotelcontent);
	}
	
}

function getLastUnseenMessages($data){
	global $chat;
	$result = $chat->getLUMessages($data);
	foreach($result as $key => $res){
		$result[$key]['created_at'] = date('M d, Y - H:i', strtotime($res['created_at']));
	}
	echo json_encode($result);
}

function changeMessageStatus($data){
	global $chat;
	$result = ($chat->changeStatus($data)) ? "true" : "false";
	echo $result;
}

function getMessageNav($data){
	global $chat;
	$result = $chat->getHotelIDsbyMessage('admin','superadmin');
	foreach($result as $key => $res){
		$result[$key]['hot_name'] = preg_replace("/[^a-zA-Z]+/", "", $res['hotel_name']);
		$result[$key]['mssg'] = $res[7];
	}
	echo json_encode($result);
}

function getMessageNavGuest($data){
	global $chat;
	extract($data);
	$result = $chat->getGuestsByMessage($hotelid);
	echo json_encode($result);
}

function getRefreshUCount($data){
	global $chat;
	extract($data);
	$result = $chat->getCountUnseenMessages($msgfrom, $msgto);
	echo json_encode($result);
}

function getRefreshGuestCount($data){
	global $chat;
	extract($data);
	$result = $chat->getCountUnseenGuests($hotelid);
	echo json_encode($result);
}
?>