<?php
/**
 * Developed By: Ranz Daren Castillano
 */
class User extends Database{
	
	function getEmail($email){
		$dbconn = $this->dbConn();
		
		$query = "SELECT email FROM users WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		
		if(!empty($result)){
			return $result;
		}else{
			return $this->getEmailUsername($email);
		}
	}
	
	function getEmailUsername($username){
		$dbconn = $this->dbConn();
		
		$query = "SELECT email FROM users WHERE username = :username";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		
		if(!empty($result)){
			return $result;
		}else{
			return $this->getEmailStaff($username);
		}
	}
	
	function getEmailStaff($email){
		$dbconn = $this->dbConn();
		
		$query = "SELECT email FROM staff WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		
		if(!empty($result)){
			return $result;
		}else{
			$query = "SELECT email FROM staff WHERE username = :username";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':username', $email);
			$stmt->execute();
			$result = $stmt->fetchColumn();
			if(!empty($result)){
				return $result;
			}else{
				return false;
			}
		}
	}
	
	
	
	function checkEmail($email){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM users WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetch();
		if(!empty($result)){
			return true;
		}else {
			return $this->checkUsername($email);
		}
	}
	
	function checkUsername($username){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM users WHERE username = :username";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetch();
		if(!empty($result)){
			return true;
		}else { 
			return $this->checkStaff($username);
		}
	}
	
	function checkStaff($email){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM staff WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetch();
		if(!empty($result)){
			return true;
		}else { 
			$query = "SELECT 1 FROM staff WHERE username = :username";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':username', $email);
			$stmt->execute();
			$result = $stmt->fetch();
			if(!empty($result)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	
	function checkUserType($email){
		$dbconn = $this->dbConn();
		
		$query = "SELECT user_type FROM users WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		
		if(!empty($result)){
			return $result;
		}else{
			return $this->checkUsertypeUN($email);
		}
		
	}
	
	function checkUsertypeUN($username){
		$dbconn = $this->dbConn();
		$query = "SELECT user_type FROM users WHERE username = :username";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "admin";
		}
	}
		
	
	function checkUserTypeC($email){
		$dbconn = $this->dbConn();
		
		$query = "SELECT user_type FROM users WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		
		if(!empty($result)){
			return $result;
		}else{
			return $this->checkUsertypeUNC($email);
		}
		
	}
	
	function checkUsertypeUNC($username){
		$dbconn = $this->dbConn();
		$query = "SELECT user_type FROM users WHERE username = :username";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "staff";
		}
	}
	
	
	function verifyPassword($email,$password){
		$dbconn = $this->dbConn();
		$query = "SELECT password FROM users WHERE email = :email";
		$stmt = $dbconn->prepare($query);
        $stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(password_verify($password,$result)){
			return true;
		}else{
			return $this->verifyPasswordUsername($email,$password);
		}
	}
	
	function verifyPasswordUsername($username, $password){
		$dbconn = $this->dbConn();
		$query = "SELECT password FROM users WHERE username = :username";
		$stmt = $dbconn->prepare($query);
        $stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(password_verify($password,$result)){
			return true;
		}else{
			return $this->verifyPasswordStaff($username, $password);
		}
	}
	
	function verifyPasswordStaff($email,$password){
		$dbconn = $this->dbConn();
		$query = "SELECT password FROM staff WHERE email = :email";
		$stmt = $dbconn->prepare($query);
        $stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(password_verify($password,$result)){
			return true;
		}else{
			$query = "SELECT password FROM staff WHERE username = :username";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':username', $email);
			$stmt->execute();
			$result = $stmt->fetchColumn();
			if(password_verify($password,$result)){
				return true;
			}else{
				return false;
			}
		}
	}
	
	
	function getStaffHotelID($email){
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_ID FROM staff WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email',$email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			$query = "SELECT hotel_ID FROM staff WHERE username = :username";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':username',$email);
			$stmt->execute();
			$result = $stmt->fetchColumn();
			if(!empty($result)){
				return $result;
			}else{
				return false;
			}
		}
	}
	
	function getName($email){
		$dbconn = $this->dbConn();
		$query = "SELECT CONCAT(firstname ,' ', lastname) as FullName FROM users WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return $this->getNameStaff($email);
		}
	}
	
	function getNameStaff($email){
		$dbconn = $this->dbConn();
		$query = "SELECT CONCAT(firstname ,' ', lastname) as FullName FROM staff WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getStaffID($email){
		$dbconn = $this->dbConn();
		$query = "SELECT staff_ID FROM staff WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getUserInfo($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM users WHERE hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	
	function updateAdvertiserEmail($companyid, $email){
		$dbconn = $this->dbConn();
		$query = "UPDATE users SET email = :email WHERE advertiser_company_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$companyid);
		$stmt->bindParam(':email',$email);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>