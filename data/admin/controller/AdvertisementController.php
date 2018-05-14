<?php
session_start();
include '../model/Database.php';
include '../model/SecurityPinClass.php';
include '../model/SuperAdminClass.php';
include '../model/AdminClass.php';
include '../model/UserClass.php';
include '../model/HotelClass.php';
include '../model/AdvertClass.php';

$sp = new SecurityPin();
$superuser = new SuperAdmin();
$adminuser = new Admin();
$uc = new User();
$hotel = new Hotels();
$ads = new Advertisement();

switch($_POST['action']){
	case 'Add Advertisement':
		registerAdvert($_POST);
		break;
	case 'Remove Ad':
		removeAd($_POST);
		break;
	case 'Update Advertisement':
		updateAdvert($_POST);
		break;
    case 'Edit Advertisement':
		editAdvert($_POST);
		break;
}

function registerAdvert($data){
	global $uc;
	global $hotel;
	global $sp;
	global $ads;
	
	if($data['advertisertype'] == "newuser"){
		
		$emailcheck = $hotel->checkEmail($data['email']);
		if($emailcheck == false){ //email not in use
			$imagecount = count(array_filter($_FILES['adImagesFiles']['name']));
			$images = uploadPhoto($_FILES['adImagesFiles'], $data['companyname'], $data['ad_name']);
			
			//generate pin and check if exist
			$pin = generateRandomString();
			do {
				$pin = generateRandomString();
			} while ($sp->checkPinExist($pin));
			//stores pin in dba_close
			$usertype = "advertiser";
			$addpin = $sp->addPin($pin, $data['email'], $usertype);
			$companyresult = $ads->setCompany($data);
			$companyID = $ads->getCompanyID($data['email']);
			$result = $ads->setAdvertisement($data, $companyID, $imagecount, $_FILES['adImagesFiles']);
			if($result){
				$to = $data['email'];

				$subject = 'Direct2Guests Advertiser Registration';

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
														".$data['companyname']." is now registered in Direct2Guests. To access your dashboard, please register for an advertiser account using this PIN : <strong>".$pin."</strong>. 
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
			
		}
		
	}else{
		$company = $ads->getCompanyInfo($data['existingUser']);
		$imagecount = count(array_filter($_FILES['adImagesFiles']['name']));
		$images = uploadPhoto($_FILES['adImagesFiles'], $company['company_name'], $data['ad_name']);
		
		$result = $ads->setAdvertisement($data, $data['existingUser'], $imagecount, $_FILES['adImagesFiles']);
		if($result){
			echo "true";
		}else{
			echo "notadded";
		}
	}
	
}

function updateAdvert($data){
	global $hotel;
	global $ads;
	global $uc;
	global $sp;
	
	$imagecount = count(array_filter($_FILES['adImagesFiles']['name']));
	$images = uploadPhoto($_FILES['adImagesFiles'], $data['companyname'], $data['ad_name']);
	$oldemail = $ads->getCompanyEmail($data['comp_id']);
	$pinstatus = $sp->checkPinOn($oldemail);
	$pin = $sp->getPin($oldemail);
	$upem = $sp->updateEmail($pin,$data['email']);
	$company = $ads->updateCompany($data);
	$companyID = $ads->getCompanyID($data['email']);
	if($pinstatus == "off"){
		$email = $uc->updateAdvertiserEmail($companyID, $data['email']);
		if($imagecount != 0){
			
			$result = $ads->updateAdvertisementWithImages($data, $companyID, $imagecount, $_FILES['adImagesFiles']);
		}else{
			$result = $ads->updateAdvertisement($data, $companyID);
		}
	}else{
		if($imagecount != 0){
			$result = $ads->updateAdvertisementWithImages($data, $companyID, $imagecount, $_FILES['adImagesFiles']);
		}else{
			$result = $ads->updateAdvertisement($data, $companyID);
		}
		if($oldemail != $data['email']){
			$to = $data['email'];

			$subject = 'Direct2Guests Advertiser Registration';

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
													".$data['companyname']." is now registered in Direct2Guests. To access your dashboard, please register for an advertiser account using this PIN : <strong>".$pin."</strong>. 
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
			}else {
				echo "mail";
			}
		}
	}
	if($result){
		echo "true";
	}else {
		echo "false";
	}
}

function editAdvert($data){
	global $hotel;
	global $ads;
	global $uc;
	global $sp;
	
	$imagecount = count(array_filter($_FILES['adImagesFiles']['name']));
	$images = uploadPhoto($_FILES['adImagesFiles'], $data['companyname'], $data['ad_name']);
	$oldemail = $ads->getCompanyEmail($data['comp_id']);
	$pinstatus = $sp->checkPinOn($oldemail);
	$pin = $sp->getPin($oldemail);
	$upem = $sp->updateEmail($pin,$data['email']);
	$company = $ads->updateCompany($data);
	$companyID = $ads->getCompanyID($data['email']);
	if($pinstatus == "off"){
		$email = $uc->updateAdvertiserEmail($companyID, $data['email']);
		if($imagecount != 0){
			
			$result = $ads->editAdvertisementWithImages($data, $companyID, $imagecount, $_FILES['adImagesFiles']);
		}else{
			$result = $ads->editAdvertisement($data, $companyID);
		}
	}else{
		if($imagecount != 0){
			$result = $ads->editAdvertisementWithImages($data, $companyID, $imagecount, $_FILES['adImagesFiles']);
		}else{
			$result = $ads->editAdvertisement($data, $companyID);
		}
		if($oldemail != $data['email']){
			$to = $data['email'];

			$subject = 'Direct2Guests Advertiser Registration';

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
													".$data['companyname']." is now registered in Direct2Guests. To access your dashboard, please register for an advertiser account using this PIN : <strong>".$pin."</strong>. 
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
			}else {
				echo "mail";
			}
		}
	}
	if($result){
		echo "true";
	}else {
		echo "false";
	}
}


function removeAd($data){
	global $ads;
	$result = ($ads->removeAd($data)) ? "true" : "false";
	echo $result;
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

function uploadPhoto($photo, $companyname, $adname){
	$photos = reArrayFiles($photo);
	foreach($photos as $photo){
		if (is_uploaded_file($photo['tmp_name']) && $photo['error'] == 0) {
		$filename = $photo['name'];
		$tmp_name = $photo['tmp_name'];
		$file_parts = pathinfo($filename);
		$file_type = $file_parts['extension'];
		$img_path = $_SERVER['DOCUMENT_ROOT']."/media/images";
		$photo_path = $img_path."/Superadmin/places";
		if(!file_exists($photo_path)){
			mkdir($photo_path, 0755, true);
		}
		$companyname = preg_replace("/[^a-zA-z]+/", "", $companyname);
		$adcompany_path = $photo_path."/".$companyname;
		if(!file_exists($adcompany_path)){
			mkdir($adcompany_path);
			chmod($adcompany_path,0755);
		}
		$adname = preg_replace("/[^a-zA-z]+/", "", $adname);
		$ads_path = $adcompany_path."/".$adname;
		if(!file_exists($ads_path)){
			mkdir($ads_path);
			chmod($ads_path,0755);
		}
		if($file_type == 'jpg' || $file_type == 'JPEG' || $file_type == 'jpeg' || $file_type == 'png' || $file_type == 'JPG' || $file_type == 'PNG') {
						
			if(move_uploaded_file($tmp_name, $ads_path."/". $filename)){
				//return 1; //success
			}else{
				//return 0; //fail
			}
		}else{
			//return 0; //fail
		}
	}
	}
	
}

function reArrayFiles($file)
{
    $file_ary = array();
    $file_count = count($file['name']);
    $file_key = array_keys($file);
    
    for($i=0;$i<$file_count;$i++)
    {
        foreach($file_key as $val)
        {
            $file_ary[$i][$val] = $file[$val][$i];
        }
    }
    return $file_ary;
}
?>