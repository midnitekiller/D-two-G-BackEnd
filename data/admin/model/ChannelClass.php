<?php
/**
 * Developed By: Ranz Daren Castillano
 */
class Channels extends Database{
    
	function getChannels(){
		$dbconn = $this->dbConn();
		$query = "SELECT channels.*, hotels.hotel_name FROM channels, hotels WHERE channels.hotel_ID = hotels.hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function addChannel($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO channels (hotel_ID, channel_type, channel_name, channel_url, channel_logo, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), :channeltype, :name, :url, :logo, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotel_id);
		$stmt->bindParam(':channeltype', $channel_type);
		$stmt->bindParam(':name', $channel_name);
		$stmt->bindParam(':url', $channel_url);
		$stmt->bindParam(':logo', $logo_text);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function checkChannel($name, $id){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM channels WHERE channel_name = :name AND hotel_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':name', $name);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
	
	function removeChannel($id){
		$dbconn = $this->dbconn();
        $sql = "DELETE FROM channels WHERE channel_ID = :id";
		$stmt = $dbconn->prepare($sql);
		$stmt->bindParam(':id',$id);
		$value = $stmt->execute();
		$dbconn = null;
        return $value;
	}
	
	function getChannelInfo($id){
		$dbconn = $this->dbConn();
		$query = "SELECT channels.*, hotels.hotel_name, hotels.hotel_ID FROM channels, hotels WHERE channels.hotel_ID = hotels.hotel_ID AND channels.channel_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	
	function getHotelID($id){
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_ID FROM channels WHERE channel_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function updateChannel($data){
		extract($data);
		$dbconn = $this->dbConn();
		$query = "UPDATE channels SET hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), channel_type = :channeltype, channel_name = :name, channel_url = :url, channel_logo = :logo WHERE channel_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':channeltype', $channeltype);
		$stmt->bindParam(':name', $channel_name);
		$stmt->bindParam(':url', $channel_url);
		$stmt->bindParam(':logo', $logo_text);
		$stmt->bindParam(':id', $channelid);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
    
    function getChannelAdmin($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT channels.*, hotels.hotel_name FROM channels, hotels WHERE channels.hotel_ID = hotels.hotel_ID AND channels.hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function addChannelAds($data){
		extract($data);
        $status = "active";
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO ticker (hotel_ID, ticker_description, ticker_start, duration, status, created_at) VALUES (:hotel_ID, :ticker_description, :show, :duration, :status, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->bindParam(':ticker_description', $ads_description);
		$stmt->bindParam(':show', $advisory_show);
		$stmt->bindParam(':duration', $duration);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
    function deleteChannelAdsByID($ticker_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM ticker WHERE ticker_ID = '".$ticker_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    function getChannelAdsByID($ticker_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT * FROM ticker WHERE ticker_ID = '".$ticker_ID."'";
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
    function editChannelAdsByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE ticker
                SET ticker_description = '".$data['ads_description']."', ticker_start = '".$data['advisory_show']."', duration = '".$data['duration']."' WHERE ticker_ID = '".$data['ticker_ID']."'";
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
    function changeStatus($data){
		$dbconn = $this->dbConn();
		$sql = "UPDATE ticker SET status = '".$data['status']."' WHERE ticker_ID = '".$data['ticker_ID']."'";;
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
    function fetchChannelAdsall($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM ticker WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     function fetchChannelAdsInformation($ticker_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM ticker WHERE ticker_ID = ?");
        $stmt->execute([$ticker_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>