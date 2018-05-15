<?php
session_start();
include '../model/Database.php';
include '../model/RestaurantClass.php';
include '../model/ImageUploadClass.php';
include '../model/HotelClass.php';

$image = new ImageUpload();
$hotel = new Hotels();
$Restaurant_db = new Restaurant();


switch ($_POST['action']) {  
    case 'Add Restaurant':
        $hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
        $image_success = $image->uploadPhoto($_FILES['restaurant_logo_image'],"restaurant",$hotel_name,$_POST['restaurant_name']);
        if($image_success == 1){
			if($Restaurant_db->addRestaurant($_POST)) {
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
    case 'Get Restaurant By ID':
        $result = $Restaurant_db->getRestaurantByID($_POST['restaurant_ID']);
        echo $result;
    break;

    case 'Edit Restaurant':
		// $hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		// $image_success = $image->uploadPhoto($_FILES['restaurant_logo_image'],"restaurant",$hotel_name,$_POST['restaurant_name']);
  //       if($image_success == 1){
		// 	if($Restaurant_db->editRestaurantByID($_POST)) {
		// 		echo 'true';
		// 	}else{
		// 		echo 'false';
		// 	}
		// }elseif($image_success == 0){
		// 	echo 'image';
		// }else{
		// 	echo 'not uploaded';
		// }
        updateRestaurant($_POST);
    break;
    case 'Remove Restaurant':
        if($Restaurant_db->deleteRestaurantByID($_POST['restaurant_ID'])){
			echo 'true';
		}else{
			echo 'false';
        }
    break;
}
function updateRestaurant($data){
    global $Restaurant_db;
	global $hotel;
    global $image;
    
    $restaurant_check = $Restaurant_db->checkRestaurant($data['restaurant_ID'], $data['hotel_ID']);
    $hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
    $image_success = $image->uploadPhoto($_FILES['restaurant_logo_image'],"restaurant",$hotel_name,$_POST['restaurant_name']);
    if($image_success == 1 || $restaurant_check == true){
        if($Restaurant_db->editRestaurantByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    }else{
        echo 'image';
    }
}
?>