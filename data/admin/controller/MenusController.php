<?php
session_start();
include '../model/Database.php';
include '../model/MenuClass.php';
include '../model/ImageUploadClass.php';
include '../model/HotelClass.php';
$image = new ImageUpload();
$menus = new Menus();
$hotel = new Hotels();
switch ($_POST['action']) {
    case 'Get Categories':
		getCategories($_POST['restaurant_id']);
		break;
	case 'Get Dishstyle':
		getDishes($_POST['restaurant_id'],$_POST['category_id']);
		break;
	case 'Add Category':
		addCategory($_POST);
		break;
	case 'Add Dishstyle';
		addDishstyle($_POST);
		break;
	case 'Add Menu':
		addMenu($_POST);
		break;
} 


function getCategories($restaurantid){
	global $menus;
	$result = $menus->getCate($restaurantid);
	echo json_encode($result);
}

function getDishes($restaurantid, $categoryid){
	global $menus;
	$result = $menus->getDishstyle($restaurantid, $categoryid);
	echo json_encode($result);
}

function addCategory($data){
	global $menus;
	$result = $menus->addCategory($data);
	if($result){
		echo "true";
	}else{
		echo "false";
	}
}

function addDishstyle($data){
	global $menus;
	$result = $menus->addDishstyle($data);
	if($result){
		echo "true";
	}else{
		echo "false";
	}
}

function addMenu($data){
	global $menus, $hotel, $image;
	$hotelid = $menus->getHotelID($data['menRestaurants']);
	$hotel_name = $hotel->getHotelName($hotelid);
	$image_success = $image->uploadPhotoMenu($_FILES['menu_image_logo'],"restaurant",$hotel_name);
	if($image_success == 1){
		$result = $menus->addMenu($data);
	}else{
		echo "false";
	}
	if($result){
		echo "true";
	}else{
		echo "false";
	}
}
?>