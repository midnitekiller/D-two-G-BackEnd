<?php
/**
 *\\================ Developer ==================\\
 * \\ Ranz Daren Castillano \\ Joe John Ferrolino \\
 *  \\=============================================\\
 */
class Admin extends Database{
    	
	function registerAdminUser($data){
		extract($data);
		$usertype = "admin";
		$password = password_hash($password, PASSWORD_DEFAULT);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO users (hotel_ID,user_type, firstname, middlename, lastname, email, phone, address, password, username, Secret_Question, Secret_Answer, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid),:usertype,:firstname,:middlename,:lastname,:email,:phone,:address,:password,:username,:question,:answer,:createdat)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':usertype', $usertype);
		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':middlename', $middlename);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':address', $address);
		$stmt->bindParam(':phone', $contact);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $password);
        $stmt->bindParam(':question', $question);
        $stmt->bindParam(':answer', $answer);
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
    
    function getAdminByID($email) {
        $dbconn = $this->dbConn();
        $sql = "SELECT * FROM users WHERE email = $email";
        $result = false;
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            $dbconn = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return json_encode($result);
    }
    
    function getAllAdmin() {
        $dbconn = $this->dbConn();
        $sql = "SELECT * FROM users";
        $result = false;
        try {
            $stmt = $dbconn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $dbconn = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $result;
    }
        
    function fetchQuestion($email){
        $dbconn=$this->dbConn();
        $stmt=$dbconn->prepare("SELECT Secret_Question FROM users WHERE email=?");
        $stmt->execute([$email]);
        return $stmt->fetchColumn();
	}
        
    function fetchUserInformation($email){
        $dbconn = $this->dbConn();
        $stmt = $dbconn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $result = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    function checkAnswer($data) {
        $dbconn = $this->dbConn();
        $sql = "SELECT 1 FROM users WHERE Secret_Answer = :answer AND email= :email";
        $stmt = $dbconn->prepare($sql);
		$stmt->bindParam(':answer', $data['Secret_Answer']);
		$stmt->bindParam(':email', $data['email']);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
    }
    
    function changeResetPassword($data) {
        $dbconn = $this->dbConn();
        $sql = "UPDATE users
                SET password ='".password_hash($data['password'],PASSWORD_DEFAULT)."'
                WHERE email ='".$data['email']."'";
        $stmt = $dbconn->prepare($sql);
        if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }
	
	function loadQuestions(){
		$dbconn = $this->dbConn();
		$query = "SELECT qID, questions FROM security_questions";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function loadOneQuestion($id){
		$dbconn = $this->dbConn();
		$query = "SELECT questions FROM security_questions WHERE qID = :qid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':qid', $id);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
}

?>