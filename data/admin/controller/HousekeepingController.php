<?php
session_start();
include '../model/Database.php';
include '../model/HousekeepingClass.php';

$keeping_db = new Housekeeping();

switch ($_POST['action']) {
    case 'Remove Housekeeping':
        $keeping_db->deleteHousekeepingByID($_POST['housekeeping_ID']);
        break;
} 
?>