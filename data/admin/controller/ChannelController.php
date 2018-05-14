<?php
session_start();
include '../model/Database.php';
include '../model/HotelClass.php';
include '../model/ChannelClass.php';

$hotel = new Hotels();
$ch = new Channels();

switch($_POST['action']){
	case 'Add Channel':
		registerChannel($_POST);
		break;
	case 'Remove Channel':
		removeChannel($_POST);
		break;
	case 'Update Channel':
		updateChannel($_POST);
		break;
    case 'add ChannelAds':
        if($ch->addChannelAds($_POST)){
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Get ChannelAds By ID':
        $result = $ch->getChannelAdsByID($_POST['ticker_ID']);
        echo $result;
        break;
    case 'Edit ChannelAds':
        if($ch->editChannelAdsByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Remove ChannelAds':
        $ch->deleteChannelAdsByID($_POST['ticker_ID']);
        break;
    case 'Status ChannelAds':
        $updateResult = $ch->changeStatus($_POST);
        if($updateResult == true){
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
    break;
}

function registerChannel($data){
	global $ch, $hotel;
	
	extract($data);
	$channelcheck = $ch->checkChannel($channel_name, $hotel_id);
	$hotelname = $hotel->getHotelName($hotel_id);
	if($channelcheck == false){
		$logo = uploadPhoto($_FILES['channel_logo'], "channel", $hotelname);
		if($logo == 1){
			$result = ($ch->addChannel($data)) ? "true" : "false";
			echo $result;
		}else{
			echo "image";
		}
	}else{
		echo "channelname";
	}
}

function removeChannel($data){
	global $ch;
	$result = $ch->removeChannel($data['channel_ID']) ? "true" : "false";
	echo $result;
}

function updateChannel($data){
	global $ch,$hotel;
	
	extract($data);
	$hotID = $ch->getHotelID($channelid);
	if($hotelid != $hotID){
		$channelcheck = $ch->checkChannel($channel_name, $hotelid);
	}else{
		$channelcheck = false;
	}
	$hotelname = $hotel->getHotelName($hotelid);
	if($channelcheck == false){
		$logo = uploadPhoto($_FILES['channel_logo'], "channel", $hotelname);
		if($logo == 1){
			$result = ($ch->updateChannel($data)) ? "true": "false";
			echo $result;
		}else{
			echo "image";
		}
	}else{
		echo "channelname";
	}
}
	

function uploadPhoto($photo, $type, $hotelname){
	if (is_uploaded_file($photo['tmp_name']) && $photo['error'] == 0) {
		$filename = $photo['name'];
		$tmp_name = $photo['tmp_name'];
		$file_parts = pathinfo($filename);
		$file_type = $file_parts['extension'];
		$img_path = $_SERVER['DOCUMENT_ROOT']."/media/images";
		$hotelname = preg_replace("/[^a-zA-Z]+/", "", $hotelname);
		$hotel_path = $img_path."/".$hotelname;
		if(!file_exists($hotel_path)){
				mkdir($hotel_path);
				chmod($hotel_path,0755);
			}
		$photo_path = $img_path."/".$hotelname."/".$type;
		

		if($file_type == 'jpg' || $file_type == 'JPEG' || $file_type == 'jpeg' || $file_type == 'png' || $file_type == 'JPG' || $file_type == 'PNG') {
			if(!file_exists($photo_path)){
				mkdir($photo_path);
				chmod($photo_path,0755);
			}
			
			if(move_uploaded_file($tmp_name, $photo_path."/". $filename)){
				return 1; //success
			}else{
				return 0; //fail
			}
		}else{
			return 0; //fail
		}
	}else{
		return 1;
	}
}
?>