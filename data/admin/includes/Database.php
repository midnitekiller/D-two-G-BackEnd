<?php session_start();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databasename = "d2g_db";

    print_r(PDO::getAvailableDrivers());
    //Establishing Connection with Server
    try {
      $db_con = new PDO("mysql:host={$servername};dbname={$databasename}",$username, $password);
      $db_con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
      //getMessage
      die('Cannot Connect to database');
    }
    echo 'your connected to database';
?>
