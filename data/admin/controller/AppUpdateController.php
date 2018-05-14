<?php
session_start();
error_reporting(E_ALL & ~E_NOTICE);
include '../model/Database.php';
include '../model/AppUpdateClass.php';

$apk = new AppUpdate();

switch($_POST['action']){
	case 'Add APK':
		addAPK($_POST);
		break;
	case 'Remove APK':
		deleteAPK($_POST);
		break;
	case 'Update APK':
		editAPK($_POST);
		break;
	default:
		echo "Unknown Post";
		break;
}

function addAPK($data){
	global $apk;
	$file = $_FILES['apkfile'];
	$error = 0;
	if (is_uploaded_file($file['tmp_name']) && $file['error'] == 0) {
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/update/d2g_support.apk")){
			unlink($_SERVER['DOCUMENT_ROOT']."/update/d2g_support.apk");
		}
		
		$filename = "d2g_support.apk";
		$tmp_name = $file['tmp_name'];
		$file_parts = pathinfo($filename);
		$file_type = $file_parts['extension'];
		$apk_path = $_SERVER['DOCUMENT_ROOT']."/update";
		
		if($file_type == 'apk') {
			
			if(move_uploaded_file($tmp_name, $apk_path."/". $filename)){
				chmod($apk_path."/".$filename, 0777);
				$error = 1; //success
			}else{
				$error = 0; //fail
			}
		}else{
			$error = 0; //fail
		}
	}else{
		$error = 0;
	}
	if($error == 1){
		$result = ($apk->addAPK($data)) ? "true" : "false";
	}else{
		$result = "false";
	}
	echo $result;
}

function deleteAPK($data){
	global $apk;
	if(file_exists($_SERVER['DOCUMENT_ROOT']."/update/d2g_support.apk")){
		unlink($_SERVER['DOCUMENT_ROOT']."/update/d2g_support.apk");
	}
	$result = ($apk->deleteAPK($data)) ? "true" : "false";
	echo $result;
}


?>