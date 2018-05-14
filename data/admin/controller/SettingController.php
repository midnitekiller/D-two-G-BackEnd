<?php
session_start();
include '../model/Database.php';
include '../model/SettingClass.php';

$setting_db = new Setting();

switch ($_POST['action']) {
    case 'Edit Profile':
        if($setting_db->editProfileByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Change Password':
        $password_checker = $setting_db->checkPassword($_POST['email'],$_POST['current_password']);
        if($password_checker == false){
            echo 'Incorrect';
        }else if($password_checker == true){
            $setting_db->changeNewPassword($_POST);
            echo 'true';
        }else{
            echo 'false';
        }
    break;
} 
?> 