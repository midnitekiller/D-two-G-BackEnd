<?php
	define('DB_HOST', 'localhost');
	define('DB_UID', 'root');
	define('DB_PWD', 'qwerty!@#123');
	define('DB_NAME', 'direct2guests');
	define('ROWS_PER_PAGE', 20);
	define('DB_ENCODING', 'utf8');
$dbconn = new PDO('mysql:host=' . DB_HOST.  ';dbname=' . DB_NAME, DB_UID, DB_PWD);
        $created = date('Y-m-d H:i:s');
    
        $hotel = null;
		$query = "INSERT INTO users (hotel_ID, firstname, middlename, lastname, email, phone, address,  created_at) VALUES (:hotel_ID,:firstname,:middlename,:lastname,:email,:phone,:address,:created_at)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID', $hotel);
		$stmt->bindParam(':firstname', $hotel);
		$stmt->bindParam(':middlename', $hotel);
		$stmt->bindParam(':lastname', $hotel);
		$stmt->bindParam(':email', $hotel);
		$stmt->bindParam(':phone', $hotel);
		$stmt->bindParam(':address', $hotel);
        $stmt->bindParam(':created_at', $created);

    	
        if($stmt->execute())
        {
          return true;
        }
var_dump($stmt->execute());
?>

		