<?php
session_start();
include '../model/Database.php';
include '../model/SecurityPinClass.php';
include '../model/SuperAdminClass.php';
include '../model/AdminClass.php';
include '../model/AdvertAdminClass.php';
include '../model/UserClass.php';
include '../model/HotelClass.php';

$sp = new SecurityPin();
$superuser = new SuperAdmin();
$adminuser = new Admin();
$advertuser = new AdvertiserAdmin();
$uc = new User();
$hotel = new Hotels();

if(isset($_POST['pincode'])){
	extract($_POST);
	//$pin = trim(preg_replace('/ +/', ' ', preg_replace('/[^A-Za-z0-9]/', ' ', urldecode(html_entity_decode(strip_tags($pin))))));
	$status = $sp->checkPin($pin);
	$email = $sp->getEmail($pin);
	
	if($status == "superadmin"){
		echo "{\"status\":\"true\",\"pin\":\"".$pin."\",\"type\":\"superadmin\",\"email\":\"".$email."\"}";
	}elseif($status == "admin"){
		$hotelid = $hotel->getHotelID($email);
		echo "{\"status\":\"true\",\"pin\":\"".$pin."\",\"type\":\"admin\",\"email\":\"".$email."\",\"hotelid\":\"".$hotelid."\"}";
	}elseif($status == "advertiser"){
		echo "{\"status\":\"true\",\"pin\":\"".$pin."\",\"type\":\"advertiser\",\"email\":\"".$email."\"}";
	}elseif($status == "pindown"){
		echo "{\"status\":\"pindown\",\"pin\":\"0\"}";
	}else{
		echo "{\"status\":\"false\",\"pin\":\"0\"}";
	}
}

if(isset($_POST['register'])){
	$email = $superuser->checkEmail($_POST['email']);
	$username = $superuser->checkUsername($_POST['username']);
	if($email == false && $username == false){
		$pin_status = $sp->checkPin($_POST['token']);
		if($pin_status){
			$status = $superuser->registerSuperUser($_POST);
			if($status){
				$_SESSION['valid'] = true;
				$_SESSION['verify'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$_SESSION['email'] = $_POST['email'];
				$_SESSION['time'] = time();
				$pinstatus = $sp->setPinStatusOff($_POST['email']);
				echo "true";
			}else{
				echo "false";
			}
		}else{
			echo "pin";
		}
	}elseif($email == true && $username == false){
		echo "email";
	}elseif($email == false && $username == true){
		echo "username";
	}else if($email == true && $username == true){
		echo "both";
	}
	
}

if(isset($_POST['logmein'])){
	extract($_POST);
	$email = $uc->checkEmail($logemail);
	$password = $uc->verifyPassword($logemail,$logpassword);
	$usertype = $uc->checkUserTypeC($logemail);
	$eemail = $uc->getEmail($logemail);
	if($email == true && $password == true){
		$_SESSION['valid'] = true;
		$_SESSION['verify'] = password_hash($_POST['logpassword'], PASSWORD_DEFAULT);
		$_SESSION['email'] = $eemail;
		$_SESSION['time'] = time();
		$_SESSION['usertype'] = $usertype;
		if($usertype == "admin"){
			$hotelid = $hotel->getHotelID($eemail);
			$_SESSION['hotel_id'] = $hotelid;
			$_SESSION['employee'] = "admin";
			$_SESSION['staff_id'] = "";
		}elseif($usertype == "staff"){
			$hotelid = $uc->getStaffHotelID($eemail);
			$_SESSION['staff_id'] = $uc->getStaffID($eemail);
			$_SESSION['hotel_id'] = $hotelid;
			$_SESSION['usertype'] = "admin";
			$_SESSION['employee'] = "staff";
		}
		echo "true";
	}elseif($email == true && $password == false){
		echo "password";
	}elseif($email == false && $password == true){
		echo "email";
	}else {
		echo "false";
	}
}

if(isset($_POST['registerAdmin'])){
	$email = $adminuser->checkEmail($_POST['email']);
	$username = $adminuser->checkUsername($_POST['username']);
	$usertype = $uc->checkUserType($_POST['email']);
	if($email == false && $username == false){
		$pin_status = $sp->checkPin($_POST['token']);
		if($pin_status){
			if($_POST['utype'] == "admin"){
				$status = $adminuser->registerAdminUser($_POST);
				if($status){
					$_SESSION['valid'] = true;
					$_SESSION['verify'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['time'] = time();
					$_SESSION['hotel_id'] = $_POST['hotelid'];
					$_SESSION['usertype'] = $usertype;
					$sp->setPinStatusOff($_POST['email']);
					echo "true";
				}else{
					echo "false";
				}
			}elseif($_POST['utype'] == "superadmin"){
				$status = $superuser->registerSuperUser($_POST);
				if($status){
					$_SESSION['valid'] = true;
					$_SESSION['verify'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['time'] = time();
					$_SESSION['usertype'] = $usertype;
					$pinstatus = $sp->setPinStatusOff($_POST['email']);
					echo "true";
				}else{
					echo "false";
				}
			}elseif($_POST['utype'] == "advertiser"){
				$status = $advertuser->registerAdvertiserUser($_POST);
				if($status){
					$_SESSION['valid'] = true;
					$_SESSION['verify'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
					$_SESSION['email'] = $_POST['email'];
					$_SESSION['time'] = time();
					$_SESSION['usertype'] = $usertype;
					$pinstatus = $sp->setPinStatusOff($_POST['email']);
					echo "advertiser";
				}else{
					echo "false";
				}
			}
		}else{
			echo "pin";
		}
	}elseif($email == true && $username == false){
		echo "email";
	}elseif($email == false && $username == true){
		echo "username";
	}else if($email == true && $username == true){
		echo "both";
	}
}

if(isset($_POST['emailconfirm'])){
    $email = $adminuser->checkEmail($_POST['email']);
	if($email){
        $_SESSION['islogin'] = true;
        //$_SESSION['email'] = $adminuser->fetchQuestion($_POST['email']);
        $_SESSION['email'] = $_POST['email'];
       
        echo "true";
    }else {
        echo "false";
    }
}

if(isset($_POST['checkAnswer'])){
    $Secret_Answer = $adminuser->checkAnswer($_POST);
    if($Secret_Answer){
        echo "true";
    }else{
        echo "false";
    }
}


if(isset($_POST['ConfirmReset'])){
    if($adminuser->changeResetPassword($_POST)){
		session_destroy();
        echo "true";
    }else{
        echo "false";
    }      
}

?>