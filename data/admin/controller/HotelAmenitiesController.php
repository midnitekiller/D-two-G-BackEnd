<?php
session_start();
include '../model/Database.php';
include '../model/HotelAmenitiesClass.php';
include '../model/ImageUploadClass.php';
include '../model/HotelClass.php';

$image = new ImageUpload();
$hotel = new Hotels();
$Amenities_db = new Amenities();

switch ($_POST['action']) {
    case 'Add Amenities':
		$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhoto($_FILES['amenities_logo_image'],"amenities",$hotel_name,$_POST['amenities_name']);
        if($image_success == 1){
			if($Amenities_db->addAmenities($_POST)) {
				echo 'true';
			}else{
				echo 'false';
			}
		}elseif($image_success == 0){
			echo 'image';
		}else{
			echo 'not uploaded';
		}
    break;
    case 'Get Amenities By ID':
        $result = $Amenities_db->getAmenitiesByID($_POST['amenities_ID']);
        echo $result;
    break;
    case 'Edit Amenities':
        updateAmenities($_POST);
    break;
    case 'Remove Amenities':
        $Amenities_db->deleteAmenitiesByID($_POST['amenities_ID']);
    break;
    case 'Edit Guests':
        $device = $Guests_db->checkDevice($_POST);
        if($Guests_db->editGuestsByID($_POST)) 
           if($device == true){
              $Guests_db->deviceStatus($_POST);
              $Guests_db->deviceUpdateStatus($_POST);
              echo 'true';
           }else{
               echo 'false';
           }
    break;
}

function updateAmenities($data){
    global $Amenities_db;
	global $hotel;
    global $image;
    
    $amenities_check = $Amenities_db->checkAmenities($data['amenities_ID'], $data['hotel_ID']);
    $hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
    $image_success = $image->uploadPhoto($_FILES['amenities_logo_image'],"amenities",$hotel_name,$_POST['amenities_name']);
    if($image_success == 1 || $amenities_check == true){
        if($Amenities_db->editAmenitiesByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    }else{
        echo 'image';
    }
}
?> 