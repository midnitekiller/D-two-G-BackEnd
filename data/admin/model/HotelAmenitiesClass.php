<?php
/**
 * Developed By: Joe John Ferrolino
 */
class Amenities extends Database{
    
	function addAmenities($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO amenities (hotel_ID, amenities_name, amenities_type, description, image, created_at) VALUES (:hotel_ID, :amenities_name, :amenities_type, :description, :image, :created_at)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->bindParam(':amenities_name', $amenities_name);
		$stmt->bindParam(':amenities_type', $amenities_type);
		$stmt->bindParam(':description', $amenities_description);
        $stmt->bindParam(':image', $img_amenities);
		$stmt->bindParam(':created_at', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
    
    function deleteAmenitiesByID($amenities_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM amenities WHERE amenities_ID = '".$amenities_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function getAmenitiesByID($amenities_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT * FROM amenities WHERE amenities_ID = '".$amenities_ID."'";
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
    
    function editAmenitiesByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE amenities
                SET amenities_name = '".$data['amenities_name']."',
                    amenities_type = '".$data['amenities_type']."',
                    description    = '".$data['description']."',
                    image          = '".$data['img_amenities']."'
                WHERE amenities_ID = '".$data['amenities_ID']."'";
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
    
    function checkAmenities($amenities_ID, $hotel_ID){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM amenities WHERE amenities_ID = :amenities_ID AND hotel_ID = :hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':amenities_ID', $amenities_ID);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
    
    function getAmenitiesID($amenities_ID){
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_ID FROM amenities WHERE amenities_ID = :amenities_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':amenities_ID', $amenities_ID);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
    
    function fetchAmenitiesAll($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT amenities.*, hotels.hotel_name FROM amenities INNER JOIN hotels ON hotels.hotel_ID = amenities.hotel_ID WHERE amenities.hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchAmenitiesInformation($amenities_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT amenities.*, hotels.hotel_name FROM amenities INNER JOIN hotels ON hotels.hotel_ID = amenities.hotel_ID WHERE amenities.amenities_ID = ?");
        $stmt->execute([$amenities_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>