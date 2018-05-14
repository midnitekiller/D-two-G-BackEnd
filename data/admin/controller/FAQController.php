<?php
session_start();
include '../model/Database.php';
include '../model/FAQClass.php';

$FAQ_db = new FAQ();

switch ($_POST['action']) {
    case 'add FAQ':
        if($FAQ_db->addFAQ($_POST)){
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Get FAQ By ID':
        $result = $FAQ_db->getFAQByID($_POST['faq_ID']);
        echo $result;
        break;
    case 'Edit FAQ':
        if($FAQ_db->editFAQByID($_POST)) {
            echo 'true';
        }else{
            echo 'false';
        }
    break;
    case 'Remove FAQ':
        $FAQ_db->deleteFAQByID($_POST['faq_ID']);
        break;
    case 'Status FAQ':
        $updateResult = $FAQ_db->changeStatus($_POST);
        if($updateResult == true){
            echo 'success';
        }else{
            echo json_encode(['Error'=>$updateResult]);
        }
    break;
} 
?> 