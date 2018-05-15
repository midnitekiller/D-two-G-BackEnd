<?php
session_start();
include '../model/Database.php';
include '../model/AdminAllReportClass.php';

$report_db = new AdminReport();

switch ($_POST['action']) {
    case 'Remove Guests':
        $report_db->deleteGuestsByID($_POST['guest_ID']);
        break;
} 
?>