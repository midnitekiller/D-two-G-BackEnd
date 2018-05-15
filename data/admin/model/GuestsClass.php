<?php
class Guests extends Database{
    
    function addGuests($data) {
        extract($data);
        $status = 'active';
        $deleted = 1;
        $created = date('Y-m-d H:i:s');
        $dbconn = $this->dbConn();
        $stmt = $dbconn->prepare("INSERT INTO guests (hotel_ID,title,status,firstname,middlename,lastname,email,phone,room_no,inclusion_Breakfast,inclusion_Lunch,inclusion_Dinner,inclusion_Spa,inclusion_Transportation,inclusion_SightSeeing,check_in,check_out,address,street,city,country,postal,deleted,created_at)VALUES(:hotel_ID,:title,:status,:firstname,:middlename,:lastname,:email,:phone,:room_no,:inclusion_Breakfast,:inclusion_Lunch,:inclusion_Dinner,:inclusion_Spa,:inclusion_Transportation,:inclusion_SightSeeing,:check_in,:check_out,:address,:street,:city,:country,:postal,:deleted,:created_at);");
        $stmt->bindParam(':hotel_ID',$data['hotel_ID']);
        $stmt->bindParam(':title',$data['title']);
        $stmt->bindParam(':status',$status);
        $stmt->bindParam(':firstname',$data['firstname']);
        $stmt->bindParam(':middlename',$data['middlename']);
        $stmt->bindParam(':lastname',$data['lastname']);
        $stmt->bindParam(':email',$data['email']);
        $stmt->bindParam(':phone',$data['phone']);
        $stmt->bindParam(':room_no',$data['room_no']);
        $stmt->bindParam(':inclusion_Breakfast',$data['breakfast']);
        $stmt->bindParam(':inclusion_Lunch',$data['lunch']);
        $stmt->bindParam(':inclusion_Dinner',$data['dinner']);
        $stmt->bindParam(':inclusion_Spa',$data['spa']);
        $stmt->bindParam(':inclusion_Transportation',$data['transportation']);
        $stmt->bindParam(':inclusion_SightSeeing',$data['sightseeing']);
        $stmt->bindParam(':check_in',$data['daterange_in']);
        $stmt->bindParam(':check_out',$data['daterange_out']);
        $stmt->bindParam(':address',$data['Address']);
        $stmt->bindParam(':street',$data['street']);
        $stmt->bindParam(':city',$data['city']);
        $stmt->bindParam(':country',$data['country']);
        $stmt->bindParam(':postal',$data['postal_code']);
        $stmt->bindParam(':deleted',$deleted);
        $stmt->bindParam(':created_at',$created);
        if($stmt->execute())
        {
          return true;
        }
    }
    
    function addGuestsHistory($data) {
        extract($data);
        $created = date('Y-m-d H:i:s');
        $dbconn = $this->dbConn();
        $stmt = $dbconn->prepare("INSERT INTO guestshistory (hotel_ID,title,firstname,middlename,lastname,email,phone,room_no,inclusion_Breakfast,inclusion_Lunch,inclusion_Dinner,inclusion_Spa,inclusion_Transportation,inclusion_Sightseeing,check_in,check_out,address,created_at)VALUES(:hotel_ID,:title,:firstname,:middlename,:lastname,:email,:phone,:room_no,:inclusion_Breakfast,:inclusion_Lunch,:inclusion_Dinner,:inclusion_Spa,:inclusion_Transportation,:inclusion_Sightseeing,:check_in,:check_out,:address,:created_at);");
        $stmt->bindParam(':hotel_ID',$data['hotel_ID']);
        $stmt->bindParam(':title',$data['title']);
        $stmt->bindParam(':firstname',$data['firstname']);
        $stmt->bindParam(':middlename',$data['middlename']);
        $stmt->bindParam(':lastname',$data['lastname']);
        $stmt->bindParam(':email',$data['email']);
        $stmt->bindParam(':phone',$data['phone']);
        $stmt->bindParam(':room_no',$data['room_no']);
        $stmt->bindParam(':inclusion_Breakfast',$data['breakfast']);
        $stmt->bindParam(':inclusion_Lunch',$data['lunch']);
        $stmt->bindParam(':inclusion_Dinner',$data['dinner']);
        $stmt->bindParam(':inclusion_Spa',$data['spa']);
        $stmt->bindParam(':inclusion_Transportation',$data['transportation']);
        $stmt->bindParam(':inclusion_Sightseeing',$data['sightseeing']);
        $stmt->bindParam(':check_in',$data['daterange_in']);
        $stmt->bindParam(':check_out',$data['daterange_out']);
        $stmt->bindParam(':address',$data['Address']);
        $stmt->bindParam(':created_at',$created);
        if($stmt->execute())
        {
          return true;
        }
    }
    
    function getAllGuests($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM guests WHERE hotel_ID = ? ORDER BY room_no ASC");
        $stmt->execute([$hotelid]);
		return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		/*foreach($result as $i => $re){
			$datetoday = strtotime(date('Y-m-d H:i:s'));
			if($datetoday > strtotime($re['check-out']){
				$result = $this->changeStatus($$data);
				$result[$i]['status'] = "inactive";
			}else{
				
			}
		}*/
       /* return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);*/
    }
    
    function fetchHotelRoomInformation($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM device  WHERE hotel_ID = ? and status = 'inactive' ORDER BY room_no+0 ASC");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchGuestsInformation($guest_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM guests WHERE guest_ID = ?");
        $stmt->execute([$guest_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function deleteGuestsByID($guest_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM guests WHERE guest_ID = '".$guest_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function getGuestsByID($guest_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT guests.*, device.* FROM guests, device WHERE guest_ID = '".$guest_ID."' AND guests.room_no = device.room_no";
        $result = false;
        try {
            $stmt = $dbconn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            $dbconn = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
		
        return json_encode($result);
    }
    
    function editGuestsByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE guests
                SET title       = '".$data['title']."',
                    firstname   = '".$data['firstname']."',
                    middlename  = '".$data['middlename']."',
                    lastname    = '".$data['lastname']."',
                    email       = '".$data['email']."',
                    phone       = '".$data['phone']."',
                    room_no     = '".$data['room_no']."',
                    inclusion_Breakfast = '".$data['breakfast']."',
                    inclusion_Lunch     = '".$data['lunch']."',
                    inclusion_Dinner    = '".$data['dinner']."',
                    inclusion_Spa       = '".$data['spa']."',
                    inclusion_Transportation  = '".$data['transportation']."',
                    inclusion_Sightseeing     = '".$data['sightseeing']."',
                    check_in    = '".$data['daterange_in']."',
                    check_out   = '".$data['daterange_out']."',
                    address     = '".$data['Address']."',
                    street      = '".$data['street']."',
                    city        = '".$data['city']."',
                    country     = '".$data['country']."',
                    postal      = '".$data['postal_code']."'
                WHERE guest_ID = '".$data['guest_ID']."'";
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
    
    function updateGuestsHistory($guest_ID) { 
        $deleted = date('Y-m-d H:i:s');
        $dbconn = $this->dbconn();
        $sql = "UPDATE guestshistory SET deleted_at = '".$deleted."'  WHERE guest_ID = '".$guest_ID."'";
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
    
   function checkEmail($email){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM guests WHERE email = :email";
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
    
    function changeStatus($data){
		$dbconn = $this->dbConn();
		$sql = "UPDATE guests SET status = '".$data['status']."' WHERE guest_ID = '".$data['guest_ID']."'";
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
    
    function deviceStatus($data){
		$dbconn = $this->dbConn();
		$sql = "UPDATE device SET status = 'active' WHERE tabs_ID = '".$data['device_ID']."'";
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
    
    function deviceUpdateStatus($data){
        extract($data);
		$dbconn = $this->dbConn();
		$sql = "UPDATE device SET status = 'inactive' WHERE hotel_ID = '".$data['hotel_ID']."' and room_no = '".$data['previous_room']."'";
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
    
    function deviceCheckOutStatus($data){
        extract($data);
		$dbconn = $this->dbConn();
		$sql = "UPDATE device SET status = '".$data['status']."' WHERE hotel_ID = (SELECT hotel_ID FROM guests WHERE guest_ID ='".$data['guest_ID']."') and room_no = (SELECT room_no FROM guests WHERE guest_ID = '".$data['guest_ID']."')";
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
    
    function deviceDeleteStatus($data){
        extract($data);
		$dbconn = $this->dbConn();
		$sql = "UPDATE device SET status = 'inactive' WHERE hotel_ID = (SELECT hotel_ID FROM guests WHERE guest_ID ='".$data['guest_ID']."') and room_no = (SELECT room_no FROM guests WHERE guest_ID = '".$data['guest_ID']."')";
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
    
    function checkDevice($data){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM device WHERE hotel_ID = '".$data['hotel_ID']."' and room_no = '".$data['previous_room']."'";
		$stmt = $dbconn->prepare($query);
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