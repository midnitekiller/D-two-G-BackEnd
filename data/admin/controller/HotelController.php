<?php
session_start();
include '../model/Database.php';
include '../model/SecurityPinClass.php';
include '../model/SuperAdminClass.php';
include '../model/UserClass.php';
include '../model/HotelClass.php';

$sp = new SecurityPin();
$superuser = new SuperAdmin();
$uc = new User();
$hotel = new Hotels();

switch ($_POST['action']) {
	case 'Add Admin':
		registerHotel($_POST);
		break;
	case 'Hotel Status':
		changeHotelStatus($_POST);
		break;
    case 'Status AccessAdmin':
        $updateResult = $hotel->statusAdminAccess($_POST);
        if($updateResult == true){
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
		break;
	case 'Update Hotel':
		updateHotel($_POST);
		break;
	case 'Access Status':
		changeHotelAccessAll($_POST);
		break;
	default:
		echo "unknown post";
		
}

function updateHotel($data){
	global $hotel;
	global $sp;
	global $mail;
	
	$hotelcheck = $hotel->checkHotelUpdate($data['hotel_name'], $data['hotel_id']);
	if($hotelcheck == false){
		
		if (is_uploaded_file($_FILES['hotel_logo_img']['tmp_name']) && $_FILES['hotel_logo_img']['error'] == 0){
			$logo = uploadPhoto($_FILES['hotel_logo_img'], "logo", $_POST['hotel_name']);
		}else {
			$logo = 1;
		}
		
		if (is_uploaded_file($_FILES['back_logo_img']['tmp_name']) && $_FILES['back_logo_img']['error'] == 0){
			$background = uploadPhoto($_FILES['back_logo_img'], "background", $_POST['hotel_name']);
		}else {
			$background = 1;
		}
	
		if($logo == 1 && $background == 1){
			$result = $hotel->updateHotel($data);
			if($result){
				echo "true";
			}else {
				echo "false";
			}
		}else {
			echo "image";
		}
	}else {
		echo "hotel";
	}
}

function registerHotel($data){
	global $hotel;
	global $mail;
	global $sp;
	
	$emailcheck = $hotel->checkEmail($data['email']);
	$hotelcheck = $hotel->checkHotel($data['hotel_name']);
	if($emailcheck == false && $hotelcheck == false){
		//upload logo
		$logo = uploadPhoto($_FILES['hotel_logo_img'], "logo", $_POST['hotel_name']);
		//check if background is uploaded
		if (is_uploaded_file($_FILES['back_logo_img']['tmp_name']) && $_FILES['back_logo_img']['error'] == 0){
			$background = uploadPhoto($_FILES['back_logo_img'], "background", $_POST['hotel_name']);
		}else {
			$background = 1;
		}
		
		//generate pin and check if exist
		$pin = generateRandomString();
		do {
			$pin = generateRandomString();
		} while ($sp->checkPinExist($pin));
		//stores pin in dba_close
		$usertype = "admin";
		$addpin = $sp->addPin($pin, $data['email'], $usertype);
		if($logo == 1 && $background == 1){
			//$result = $hotel->setHotelData($data);
			$result = $hotel->setHotelData($data);
			if($result){
				$to = $data['email'];

				$subject = 'Direct2Guests Admin Registration';

				$headers = "From: info@direct2guests.com \r\n";
				$headers .= "Reply-To: info@direct2guests.com \r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				
				$message ="<html style=\"font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\">
				<head>
				<meta name=\"viewport\" content=\"width=device-width\" />
				<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
				<title>Direct2Guests Admin Registration</title>
				<style type=\"text/css\">
				img {
				max-width: 100%;
				}
				body {
				-webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
				}
				body {
				background-color: #f6f6f6;
				}
				@media only screen and (max-width: 640px) {
				  body {
					padding: 0 !important;
				  }
				  h1 {
					font-weight: 800 !important; margin: 20px 0 5px !important;
				  }
				  h2 {
					font-weight: 800 !important; margin: 20px 0 5px !important;
				  }
				  h3 {
					font-weight: 800 !important; margin: 20px 0 5px !important;
				  }
				  h4 {
					font-weight: 800 !important; margin: 20px 0 5px !important;
				  }
				  h1 {
					font-size: 22px !important;
				  }
				  h2 {
					font-size: 18px !important;
				  }
				  h3 {
					font-size: 16px !important;
				  }
				  .container {
					padding: 0 !important; width: 100% !important;
				  }
				  .content {
					padding: 0 !important;
				  }
				  .content-wrap {
					padding: 10px !important;
				  }
				  .invoice {
					width: 100% !important;
				  }
				}
				</style>
				</head>
				<body style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em; background-color: #f6f6f6; margin: 0;\" bgcolor=\"#f6f6f6\">
				<table class=\"body-wrap\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;\" bgcolor=\"#f6f6f6\"><tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><td style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\" valign=\"top\"></td>
						<td class=\"container\" width=\"600\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;\" valign=\"top\">
							<div class=\"content\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; max-width: 600px; display: block; margin: 0 auto; padding: 20px;\">
								<table class=\"main\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;\" bgcolor=\"#fff\"><tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><td class=\"content-wrap\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 20px;\" valign=\"top\">
											<meta content=\"Confirm Email\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\" /><table width=\"100%\" cellpadding=\"0\" cellspacing=\"0\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><td class=\"content-block\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\" valign=\"top\">
														Hey there.
													</td>
												</tr><tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><td class=\"content-block\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\" valign=\"top\">
														".$data['hotel_name']." is now registered in Direct2Guests. To access your dashboard, please register for an admin account using this PIN : <strong>".$pin."</strong>. 
													</td>
												</tr><tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><td class=\"content-block\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\" valign=\"top\">
														<a href=\"http://dashboard.direct2guests.tv/registerAdmin.php\" class=\"btn-primary\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; color: #FFF; text-decoration: none; line-height: 2em; font-weight: bold; text-align: center; cursor: pointer; display: inline-block; border-radius: 5px; text-transform: capitalize; background-color: #348eda; margin: 0; border-color: #348eda; border-style: solid; border-width: 10px 20px;\">Register Now</a>
													</td>
												</tr><tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><td class=\"content-block\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0; padding: 0 0 20px;\" valign=\"top\">
														&mdash; Direct2Guests Team
													</td>
												</tr></table></td>
									</tr></table><div class=\"footer\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; clear: both; color: #999; margin: 0; padding: 20px;\">
									<table width=\"100%\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><tr style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;\"><td class=\"aligncenter content-block\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0 0 20px;\" align=\"center\" valign=\"top\">Follow <a href=\"https://www.facebook.com/Direct2Guests/\" style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; color: #999; text-decoration: underline; margin: 0;\">@Direct2Guests</a> on Facebook.</td>
										</tr></table></div></div>
						</td>
						<td style=\"font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; vertical-align: top; margin: 0;\" valign=\"top\"></td>
					</tr></table></body>
				</html>";
				
				$mail = mail($to, $subject, $message, $headers);
				if($mail){
					echo "true";
				}else {
					echo "mail";
				}
			}else{
				echo "notadded";
			}
		}else{
			echo "image";
		}
	}elseif($emailcheck == true && $hotelcheck == false){
		echo "email";
	}elseif($emailcheck == false && $hotelcheck == true){
		echo "hotel";
	}elseif($emailcheck == true && $hotelcheck == true){
		echo "emailhotel";
	}
}

function generateRandomString($length = 7) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
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
	}
}

function changeHotelStatus($data){
	global $hotel;
	$status = $hotel->changeStatus($data['hotel_id'], $data['hotel_status']);
	echo $status;
}

function changeHotelAccessAll($data){
	global $hotel;
	$status = $hotel->changeAccessAllStatus($data);
	if($status){
		echo "true";
	}else{
		echo "false";
	}
}

?>