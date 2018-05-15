<?php
/**
 * Developed By: Ranz Daren Castillano
 */
class Hotels extends Database{
    	
	function setHotelData($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$address = $hotel_street.", ".$hotel_city.", ".$hotel_country;
		$status = "active";
		$dbconn = $this->dbConn();
		$query = "INSERT INTO hotels (hotel_status,main_email,hotel_image,hotel_name,hotel_phone,hotel_currency,hotel_max_room,hotel_address,hotel_street,hotel_city,hotel_state,hotel_country,hotel_postal,background_image,weather_ID,flight_code,created_at) VALUES (:status,:email,:logo,:name,:phone,:currency,:maxroom,:address,:street,:city,:state,:country,:postal,:background,:weather,:flight,:created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status',$status);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':logo',$hotel_logo);
		$stmt->bindParam(':name',$hotel_name);
		$stmt->bindParam(':phone',$hotel_phone);
		$stmt->bindParam(':currency',$currency);
		$stmt->bindParam(':maxroom',$max_no);
		$stmt->bindParam(':address',$address);
		$stmt->bindParam(':street',$hotel_street);
		$stmt->bindParam(':city',$hotel_city);
		$stmt->bindParam(':state',$hotel_state);
		$stmt->bindParam(':country',$hotel_country);
		$stmt->bindParam(':postal',$hotel_postal);
		$stmt->bindParam(':background',$back_logo);
		$stmt->bindParam(':weather',$weather_id);
		$stmt->bindParam(':flight',$flight_id);
		$stmt->bindParam(':created',$created);
		if($stmt->execute()){
			$this->setAccessAll($email, $status);
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
	
	function checkHotel($hotelname){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM hotels WHERE hotel_name = :hotelname";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelname', $hotelname);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
	
	function getHotels(){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM hotels";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function changeStatus($hotelid, $status){
		$dbconn = $this->dbConn();
		$query = "UPDATE hotels SET hotel_status = :status WHERE hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status',$status);
		$stmt->bindParam(':hotelid',$hotelid);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
		
	function getHotelInfo($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM hotels WHERE hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	
	function getHotelID($email){
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_ID FROM hotels WHERE main_email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function updateHotel($data){
		extract($data);
		$address = $street.", ".$city.", ".$country;
		$status = "active";
		$dbconn = $this->dbConn();
		$query = "UPDATE hotels SET hotel_name = :name, hotel_currency = :currency, hotel_max_room = :maxroom, hotel_street = :street, hotel_city = :city, hotel_country = :country, hotel_state = :state, hotel_postal = :postal, hotel_image = :logo, background_image = :background, hotel_address = :address, weather_ID = :weather, flight_code = :flight WHERE hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotel_id);
		$stmt->bindParam(':logo',$hotel_logo);
		$stmt->bindParam(':name',$hotel_name);
		$stmt->bindParam(':currency',$currency);
		$stmt->bindParam(':maxroom',$max_no);
		$stmt->bindParam(':address',$address);
		$stmt->bindParam(':street',$street);
		$stmt->bindParam(':city',$city);
		$stmt->bindParam(':state',$state);
		$stmt->bindParam(':country',$country);
		$stmt->bindParam(':postal',$postal_code);
		$stmt->bindParam(':background',$back_logo);
		$stmt->bindParam(':weather',$weather_id);
		$stmt->bindParam(':flight',$flight_id);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function checkHotelUpdate($hotelname, $hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM hotels WHERE hotel_name = :hotelname AND hotel_ID <> :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelname', $hotelname);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
	
	function setAccessAll($email, $status){
		$accessname = array("chat_acc", "food_acc", "ads_acc", "housekeeping_acc", "services_acc", "offers_acc", "feedback_acc", "info_acc", "watchtv_acc", "forex_acc", "flight_acc");
		$query = "INSERT INTO hotel_access (hotel_ID, access_name, status, admin_status) VALUES ((SELECT hotel_ID FROM hotels WHERE main_email = :email), :accessname, :status, :adstatus)";
		$dbconn = $this->dbConn();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[0]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[1]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[2]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[3]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[4]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[5]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[6]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[7]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[8]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[9]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':accessname', $accessname[10]);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':adstatus', $status);
		$stmt->execute();
		
		
	}
	
	function getAccessAll($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM hotel_access WHERE hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$ac = array('chat_acc' => 'Frontdesk Chat', 'food_acc' => 'Food & Drinks', 'ads_acc' => 'Places Nearby', 'housekeeping_acc' => 'Housekeeping', 'services_acc' => 'Services', 'offers_acc' => 'Offers', 'feedback_acc' => 'Feedback', 'info_acc' => 'Your Info', 'watchtv_acc' => 'Watch TV', 'forex_acc' => 'Foreign Exchange', 'flight_acc' => 'Flight Tracker');
		foreach($result as $key => $a){
			$result[$key]['real_name'] = $ac[$a['access_name']];
		}
		return $result;
	}
	
	function changeAccessAllStatus($data){
        extract($data);
		$dbconn = $this->dbConn();
		$query = "UPDATE hotel_access SET status = :status, admin_status = :adminstatus WHERE hotel_ID = :hotelid AND access_name = :accessname";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status',$access_status);
		$stmt->bindParam(':adminstatus',$admin_status);
		$stmt->bindParam(':hotelid',$hotel_id);
		$stmt->bindParam(':accessname',$accessname);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function getHotelName($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_name FROM hotels WHERE hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}

    function fetchAccessAdmin($hotelid){
        $dbconn = $this->dbConn();
        $query = "SELECT * FROM hotel_access WHERE (admin_status = 'active' or admin_status = 'inactive') and  hotel_ID = :hotelid";
        $stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
        $result = $stmt->fetchAll();
		$ac = array('chat_acc' => 'Frontdesk Chat', 'food_acc' => 'Food & Drinks', 'housekeeping_acc' => 'Housekeeping', 'services_acc' => 'Services', 'offers_acc' => 'Offers', 'feedback_acc' => 'Feedback', 'info_acc' => 'Your Info', 'watchtv_acc' => 'Watch TV', 'forex_acc' => 'Foreign Exchange', 'flight_acc' => 'Flight Tracker');
		foreach($result as $key => $a){
			$result[$key]['real_name'] = $ac[$a['access_name']];
		}
		return $result;
    }

    function statusAdminAccess($data){
		$dbconn = $this->dbConn();
		$sql = "UPDATE hotel_access SET admin_status = '".$data['status']."' WHERE access_ID = '".$data['access_ID']."'";
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
    
    function fetchViewHotelImage($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM hotels WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewHotelLogo($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_image FROM hotels WHERE hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
}
?>