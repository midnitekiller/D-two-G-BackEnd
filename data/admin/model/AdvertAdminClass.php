<?php

class AdvertiserAdmin extends Database {

	function registerAdvertiserUser($data){
			extract($data);
			$usertype = "advertiser";
			$password = password_hash($password, PASSWORD_DEFAULT);
			$created = date('Y-m-d H:i:s');
			$dbconn = $this->dbConn();
			$query = "INSERT INTO users (advertiser_company_ID,user_type, firstname, middlename, lastname, email, phone, address, password, username, Secret_Question, Secret_Answer, created_at) VALUES ((SELECT company_ID FROM places_nearby_companies WHERE company_email = :companyemail),:usertype,:firstname,:middlename,:lastname,:email,:phone,:address,:password,:username,:question,:answer,:createdat)";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':companyemail',$email);
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

}
?>