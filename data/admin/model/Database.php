<?php 

class Database {
    function dbConn(){
        $dbhost = "localhost";
        $dbname = "direct2guests_beta";
        $username = "root";
        $password = "qwe!@#123";
        try{
            $dbconn = new PDO("mysql:host=$dbhost;dbname=$dbname", $username, $password);
            $dbconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$dbconn->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
            return $dbconn;
        }catch(PDOException $e){
            echo $sql . "<br/>" . $e->getMessage();
			return null;
        }
        
    }
}

?>
