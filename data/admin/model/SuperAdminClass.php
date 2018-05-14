<?php
/**
 * Developed By: Ranz Daren Castillano
 */
class SuperAdmin extends Database{
    	
	function registerSuperUser($data){
		extract($data);
		$usertype = "superadmin";
		$password = password_hash($password, PASSWORD_DEFAULT);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO users (user_type,firstname,middlename,lastname,email,phone,address,password,username,created_at) VALUES (:usertype,:firstname,:middlename,:lastname,:email,:phone,:address,:password,:username,:createdat)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':usertype', $usertype);
		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':middlename', $middlename);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':address', $address);
		$stmt->bindParam(':phone', $contact);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
		$stmt->bindParam(':createdat', $created);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function checkEmail($email){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM users WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
	
	function checkUsername($username){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM users WHERE username = :username";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
}
?>
