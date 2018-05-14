<?php
/**
 *\\================ Developer ==================\\
 * \\ Ranz Daren Castillano \\ Joe John Ferrolino \\
 *  \\=============================================\\
 */
class Device extends Database{
    	
	function registerDevice($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$status = "inactive";
		$dbconn = $this->dbConn();
		$query = "INSERT INTO device (hotel_ID, room_no, mac_address, status, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid),:roomno,:macaddress,:status,:createdat)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotel_id);
		$stmt->bindParam(':roomno', $roomnumber);
		$stmt->bindParam(':macaddress', $macaddress);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':createdat', $created);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function getDevices(){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM device";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function removeDevice($data){
		extract($data);
		$dbconn = $this->dbconn();
        $sql = "DELETE FROM device WHERE tabs_ID = :tabid";
		$stmt = $dbconn->prepare($sql);
		$stmt->bindParam(':tabid',$device_ID);
		$value = $stmt->execute();
		$dbconn = null;
        return $value;
	}
	
	function updateDevice($data){
		extract($data);
		$dbconn = $this->dbConn();
		$status = "inactive";
		$query = "UPDATE device SET hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), room_no = :roomno, mac_address = :mac, status = :status WHERE tabs_ID = :deviceid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status',$status);
		$stmt->bindParam(':hotelid',$hotelname);
		$stmt->bindParam(':roomno',$roomnumber);
		$stmt->bindParam(':mac',$macaddress);
		$stmt->bindParam(':deviceid',$deviceid);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function getDeviceInfo($deviceid){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM device WHERE tabs_ID = :deviceid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':deviceid',$deviceid);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	
	function checkRoomNumberExist($roomnumber, $hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM device WHERE room_no = :roomno AND hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':roomno', $roomnumber);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
	
	function getRooms($data){
		extract($data);
		$dbconn = $this->dbConn();
		$query = "SELECT room_no FROM device WHERE hotel_ID = :id ORDER BY room_no ASC";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id', $hotel_ID);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
}
?>