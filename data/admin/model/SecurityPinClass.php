<?php
/**
 * Developed By: Ranz Daren Castillano
 */
class SecurityPin extends Database{
    
	function checkPin($data){
		$dbconn = $this->dbConn();
		//$params = array($data);
		$query = "SELECT 1 FROM pins WHERE pin_code = :pincode";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':pincode', $data);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			$query2 = "SELECT pin_status, pin_type FROM pins WHERE pin_code = :pincode";
			$stmt2 = $dbconn->prepare($query2);
			$stmt2->bindParam(':pincode', $data);
			$stmt2->execute();
			$status = $stmt2->fetch();
			if($status[0]== "on"){
				if($status[1] == "superadmin"){
					return "superadmin";
				}elseif($status[1] == "admin"){
					return "admin";
				}elseif($status[1] == "advertiser"){
					return "advertiser";
				}
			}else{
				return "pindown";
			}
		}else{
			return "false";
		}
	}
	
	function checkPinExist($pin){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM pins WHERE pin_code COLLATE latin1_general_cs = :pin";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':pin', $pin);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
	
	function addPin($pin, $email, $usertype){
		$created = date('Y-m-d H:i:s');
		$status = "on";
		$dbconn = $this->dbConn();
		$query = "INSERT INTO pins (pin_status, pin_type, pin_code, email, created_at) VALUES (:status, :pintype, :pincode, :email, :createdat)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':pintype', $usertype);
		$stmt->bindParam(':pincode', $pin);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':createdat', $created);
		if($stmt->execute()){
			return true;
		}else {
			return false;
		}
	}
	
	function getEmail($pin){
		$dbconn = $this->dbConn();
		$query = "SELECT email FROM pins WHERE pin_code = :pin";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':pin', $pin);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function setPinStatusOff($email){
		$dbconn = $this->dbConn();
		$status = "off";
		$query = "UPDATE pins SET pin_status = :status WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status',$status);
		$stmt->bindParam(':email',$email);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function checkPinOn($email){
		$dbconn = $this->dbConn();
		$query = "SELECT pin_status FROM pins WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email',$email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getPin($email){
		$dbconn = $this->dbConn();
		$query = "SELECT pin_code FROM pins WHERE email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email',$email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function updateEmail($pin,$email){
		$dbconn = $this->dbConn();
		$query = "UPDATE pins SET email = :email WHERE pin_code = :pin";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':pin',$pin);
		$stmt->bindParam(':email',$email);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
}
?>