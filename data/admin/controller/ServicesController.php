<?php
session_start();
include '../model/Database.php';
include '../model/ServicesClass.php';
include '../model/ImageUploadClass.php';
include '../model/HotelClass.php';

$image = new ImageUpload();
$hotel = new Hotels();
$services_db = new Services();

switch ($_POST['action']) {
    case 'Add Services':
		$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhoto($_FILES['services_logo_image'],"services",$hotel_name,$_POST['serviceName']);
        if($image_success == 1){
			if($services_db->addServices($_POST)) {
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
    case 'Add Service Detail':
		$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhotoMenu($_FILES['services_logo_image'],"services",$hotel_name);
        if($image_success == 1){
			if($services_db->addServicesDetail($_POST)) {
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
    case 'Get Services By ID':
        $result = $services_db->getServicesByID($_POST['service_ID']);
        echo $result;
    break;
    case 'Get Services Detail By ID':
        $result = $services_db->getServicesDetailByID($_POST['serviceProd_ID']);
        echo $result;
    break;
    case 'Edit Services':
		/*$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhoto($_FILES['service_logo_image'],"services",$hotel_name,$_POST['serviceName']);
        if($image_success == 1){
			if($services_db->editServicesByID($_POST)) {
				echo 'true';
			}else{
				echo 'false';
			}
		}elseif($image_success == 0){
			echo 'image';
		}else{
			echo 'not uploaded';
		}*/
        updateServices($_POST);
    break;
    case 'Edit Services Detail':
		/*$hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
		$image_success = $image->uploadPhotoMenu($_FILES['services_logo_image'],"services",$hotel_name);
        if($image_success == 1){
			if($services_db->editServicesDetailByID($_POST)) {
				echo 'true';
			}else{
				echo 'false';
			}
		}elseif($image_success == 0){
			echo 'image';
		}else{
			echo 'not uploaded';
		}*/
        updateServicesDetail($_POST);
    break;
    case 'Remove Services':
        $services_db->deleteServicesByID($_POST['service_ID']);
    break;
    case 'Remove ServicesDetail':
        $services_db->deleteServicesDetailByID($_POST['serviceProd_ID']);
    break;
}
function updateServices($data){
    global $services_db;
	global $hotel;
    global $image;
    
    $services_check = $services_db->checkServices($data['service_ID'], $data['hotel_ID']);
    $hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
    $image_success = $image->uploadPhoto($_FILES['service_logo_image'],"services",$hotel_name,$_POST['serviceName']);
    if($image_success == 1 || $services_check == true){
        if($services_db->editServicesByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    }else{
        echo 'image';
    }
}
function updateServicesDetail($data){
    global $services_db;
	global $hotel;
    global $image;
    
    $servicesdetail_check = $services_db->checkServicesDetail($data['serviceProd_ID'], $data['hotel_ID']);
    $hotel_name = $hotel->getHotelName($_POST['hotel_ID']);
    $image_success = $image->uploadPhotoMenu($_FILES['services_logo_image'],"services",$hotel_name);
    if($image_success == 1 || $servicesdetail_check == true){
        if($services_db->editServicesDetailByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    }else{
        echo 'image';
    }
}
?>