<?php
/**
 * Developed By: Joe John Ferrolino
 */
class Setting extends Database{
    
    function changeNewPassword($data) { 
        $encrypted = password_hash($data['new_password'], PASSWORD_DEFAULT);
        $dbconn = $this->dbconn();
        $sql = "UPDATE users
                SET password   = '".$encrypted."'
                WHERE user_ID  = '".$data['user_ID']."'";
        $result = false;
        try {
            $stmt = $dbconn->prepare($sql);
            $result = $stmt->execute();
            $dbconn = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $result;
    }

    function checkPassword($email, $current_password){
        $dbconn = $this->dbConn();
		$query = "SELECT password FROM users WHERE email = :email";
		$stmt = $dbconn->prepare($query);
        $stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(password_verify($current_password,$result)){
			return true;
		}else{
			return false;
		}
    }

    function displayProfile($email) {
        $dbconn = $this->dbConn();
        $query = "SELECT * FROM users  WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function editProfileByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE users
                SET firstname   = '".$data['firstname']."',
                    lastname    = '".$data['lastname']."',
                    address     = '".$data['address']."',
                    phone       = '".$data['phone']."',
                    email       = '".$data['email']."',
                    username    = '".$data['username']."'
                WHERE user_ID   = '".$data['user_ID']."'";
        $result = false;
        try {
            $stmt = $dbconn->prepare($sql);
            $result = $stmt->execute();
            $dbconn = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $result;
    }
}

?>