<?php
    error_reporting(E_ALL & ~E_NOTICE);
    $servername = "localhost";
    $username = "root";
    $password = "qwerty!@#123";
    $dbname = "direct2guests";


    try {
        $dbconn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        
		
		/*$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO pins (pin_code,created_at)
        VALUES ('qwe123!@#','".date('Y-m-d H:i:s')."' )";
        // use exec() because no results are returned
        $conn->exec($sql);
        echo "New record created successfully";*/
		$query = "SELECT username FROM users";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		print_r($result);
		
        }
    catch(PDOException $e)
        {
        echo $query . "<br>" . $e->getMessage();
        }

    $conn = null;
?>