<?php
/**
 * Developed By: Ranz Daren Castillano
 **/
class ImageUpload{
	//$photo = $_FILES['file_input_name']
	//$type = "restaurants" || "services" || "offers"
	//$hotelname = "hotelname"
	//$rsoname = "Restaurant Name" || "Services Name" || "Offers Name"
	
	//ex. uploadPhoto($_FILES['file_input_name'], "restaurant", $hotelname, $restaurantname);
	function uploadPhoto($photo, $type, $hotelname, $rsoname){
		if (is_uploaded_file($photo['tmp_name']) && $photo['error'] == 0) {
			$filename = $photo['name'];
			$tmp_name = $photo['tmp_name'];
			$file_parts = pathinfo($filename);
			$file_type = $file_parts['extension'];
			$img_path = $_SERVER['DOCUMENT_ROOT']."/media/images";
			$hotelname = preg_replace("/[^a-zA-Z]+/", "", $hotelname);
			$rsoname = preg_replace("/[^a-zA-Z]+/", "", $rsoname);
			$location_path = $img_path."/".$hotelname."/".$type."/".$rsoname;
			if(!file_exists($location_path)){
				mkdir($location_path, 0755, true);
			}

			if($file_type == 'jpg' || $file_type == 'JPEG' || $file_type == 'jpeg' || $file_type == 'png' || $file_type == 'JPG' || $file_type == 'PNG') {
				
				if(move_uploaded_file($tmp_name, $location_path."/". $filename)){
					return 1; //success
				}else{
					return 0; //fail
				}
			}else{
				return 0; //fail
			}
		}else{
			return 2;
		}
	}
	
	function uploadPhotoMenu($photo, $type, $hotelname){
		if (is_uploaded_file($photo['tmp_name']) && $photo['error'] == 0) {
			$filename = $photo['name'];
			$tmp_name = $photo['tmp_name'];
			$file_parts = pathinfo($filename);
			$file_type = $file_parts['extension'];
			$img_path = $_SERVER['DOCUMENT_ROOT']."/media/images";
			$hotelname = preg_replace("/[^a-zA-Z]+/", "", $hotelname);
			$location_path = $img_path."/".$hotelname."/".$type;
			if(!file_exists($location_path)){
				mkdir($location_path, 0755, true);
			}

			if($file_type == 'jpg' || $file_type == 'JPEG' || $file_type == 'jpeg' || $file_type == 'png' || $file_type == 'JPG' || $file_type == 'PNG') {
				
				if(move_uploaded_file($tmp_name, $location_path."/". $filename)){
					return 1; //success
				}else{
					return 0; //fail
				}
			}else{
				return 0; //fail
			}
		}else{
			return 2;
		}
	}
}

?>