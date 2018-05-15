<?php
session_start();
include '../model/Database.php';
include '../model/StaffClass.php';

$Staff_db = new Staff();

switch ($_POST['action']) {
    case 'Add Staff':
        if($Staff_db->addStaff($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Assignment Staff':
        if($Staff_db->addAssignment($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Get Staff By ID':
        $result = $Staff_db->getStaffByID($_POST['staff_ID']);
        echo $result;
        break;
    case 'Edit Staff':
        if($Staff_db->editStaffByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
        break;
    case 'Remove Staff':
        $Staff_db->deleteStaffByID($_POST['staff_ID']);
        break;
    case 'Status Staff':
        $updateResult = $Staff_db->changeStatus($_POST);
        if(updateResult == true){
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
        break;
} 
?>