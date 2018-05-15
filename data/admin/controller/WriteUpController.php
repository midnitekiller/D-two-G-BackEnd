<?php
session_start();
include '../model/Database.php';
include '../model/WriteUpClass.php';

$writeUp_db = new writeUp();

switch ($_POST['action']) {
    case 'Edit WriteUp':
        if($writeUp_db->editWriteUpByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Edit WriteUpArea':
        if($writeUp_db->editWriteUpAreaByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    break;
} 
?>