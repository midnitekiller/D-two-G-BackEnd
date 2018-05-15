<?php
session_start();
include '../model/Database.php';
include '../model/OrderClass.php';

$Order_db = new Order();

switch ($_POST['action']) {
    case 'Status Order':
        $updateResult = $Order_db->changeStatus($_POST);
        if($updateResult == true){
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
    break;
    case 'Confirm Order':
        $updateResult = $Order_db->confirmStatus($_POST);
        if($updateResult == true){
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
    break;
        case 'Status ServiceOrder':
        $updateResult = $Order_db->changeStatusService($_POST);
        if($updateResult == true){
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
    break;
    case 'Confirm serviceOrder':
        $updateResult = $Order_db->confirmStatusService($_POST);
        if($updateResult == true){
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
    break;
} 
?>