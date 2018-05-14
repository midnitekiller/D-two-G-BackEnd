<?php
session_start();
include '../model/Database.php';
include '../model/FeedbackClass.php';

$Feedback_db = new Feedback();

switch ($_POST['action']) {
    case 'Remove Feedback':
        $Feedback_db->deletefeedbackByID($_POST['feedback_ID']);
    break;
} 
?> 