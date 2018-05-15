<?php
session_start();
include '../model/Database.php';
include '../model/GuestsClass.php';

$Guests_db = new Guests();

switch ($_POST['action']) {
    case 'Add Guests':
        if($Guests_db->addGuests($_POST)){
           $Guests_db->addGuestsHistory($_POST);
           $Guests_db->deviceStatus($_POST);
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Get Guests By ID':
        $result = $Guests_db->getGuestsByID($_POST['guest_ID']);
        echo $result;
    break;
    case 'Edit Guests':
        $device = $Guests_db->checkDevice($_POST);
        if($Guests_db->editGuestsByID($_POST)) 
           if($device == true){
              $Guests_db->deviceStatus($_POST);
              $Guests_db->deviceUpdateStatus($_POST);
              echo 'true';
           }else{
               echo 'false';
           }
    break;
    case 'Remove Guests':
        $Guests_db->deviceDeleteStatus($_POST);
        $Guests_db->deleteGuestsByID($_POST['guest_ID']);
        $Guests_db->updateGuestsHistory($_POST['guest_ID']);
        echo 'true';
    break;
    case 'Status Guests':
        $updateResult = $Guests_db->changeStatus($_POST);
        if($updateResult == true){
            $Guests_db->deviceCheckOutStatus($_POST);
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
    break;
} 
?>