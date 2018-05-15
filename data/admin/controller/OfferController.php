<?php
session_start();
include '../model/Database.php';
include '../model/OfferClass.php';
include '../model/ImageUploadClass.php';
include '../model/HotelClass.php';

$image = new ImageUpload();
$hotel = new Hotels();
$offer_db = new Offer();

switch ($_POST['action']) {
    case 'Add Offer':
		$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhoto($_FILES['offer_logo_image'],"offer",$hotel_name,$_POST['offer_name']);
        if($image_success == 1){
			if($offer_db->addOffer($_POST)) {
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
    case 'Add OfferDetail':
		$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhotoMenu($_FILES['offer_logo_image'],"offer",$hotel_name);
        if($image_success == 1){
			if($offer_db->addOfferdetail($_POST)) {
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
    case 'Get Offer By ID':
        $result = $offer_db->getOfferByID($_POST['offer_ID']);
        echo $result;
    break;
    case 'Get Offer Detail By ID':
        $result = $offer_db->getOfferdetailByID($_POST['offerdetail_ID']);
        echo $result;
    break;
    case 'Edit Offer':
		/*$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhoto($_FILES['offer_logo_image'],"offer",$hotel_name,$_POST['offer_name']);
        if($image_success == 1){
			if($offer_db->editOfferByID($_POST)) {
				echo 'true';
			}else{
				echo 'false';
			}
		}elseif($image_success == 0){
			echo 'image';
		}else{
			echo 'not uploaded';
		}*/
        updateOffer($_POST);
    break;
    case 'Edit Offer Detail':
		/*$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhotoMenu($_FILES['offer_logo_image'],"offer",$hotel_name);
        if($image_success == 1){
			if($offer_db->editOfferDetailByID($_POST)) {
				echo 'true';
			}else{
				echo 'false';
			}
		}elseif($image_success == 0){
			echo 'image';
		}else{
			echo 'not uploaded';
		}*/
        updateOfferDetail($_POST);
    break;
    case 'Remove Offer':
        $offer_db->deleteOfferByID($_POST['offer_ID']);
    break;
    case 'Remove Offerdetail':
        $offer_db->deleteOfferdetailByID($_POST['offerdetail_ID']);
    break;
} 
function updateOffer($data){
    global $offer_db;
	global $hotel;
    global $image;
    
    $offer_check = $offer_db->checkOffer($data['offer_ID'], $data['hotel_ID']);
    $hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
    $image_success = $image->uploadPhoto($_FILES['offer_logo_image'],"offer",$hotel_name,$_POST['offer_name']);
    if($image_success == 1 || $offer_check == true){
        if($offer_db->editOfferByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    }else{
        echo 'image';
    }
}
function updateOfferDetail($data){
    global $offer_db;
	global $hotel;
    global $image;
    
    $offerdetail_check = $offer_db->checkOfferDetail($data['offerdetail_ID'], $data['hotel_ID']);
    $hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
    $image_success = $image->uploadPhotoMenu($_FILES['offer_logo_image'],"offer",$hotel_name);
    if($image_success == 1 || $offerdetail_check == true){
        if($offer_db->editOfferDetailByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    }else{
        echo 'image';
    }
}
?>