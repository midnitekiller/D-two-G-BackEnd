<?php
/**
 *\\================ Developer ==================\\
 * \\ Ranz Daren Castillano \\ Joe John Ferrolino \\
 *  \\=============================================\\
 */
class AppUpdate extends Database{
    	
	function addAPK($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$status = "inactive";
		$dbconn = $this->dbConn();
		$query = "INSERT INTO appupdate (hotel_ID, versionname, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), :versionname, :createdat)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotel_ids);
		$stmt->bindParam(':versionname', $versionname);
		$stmt->bindParam(':createdat', $created);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function deleteAPK($data){
		extract($data);
		$dbconn = $this->dbConn();
        $sql = "DELETE FROM appupdate WHERE appupdate_ID = :appid";
		$stmt = $dbconn->prepare($sql);
		$stmt->bindParam(':appid',$appupdate_ID);
		$value = $stmt->execute();
		$dbconn = null;
        return $value;
	}
	
	function getAPKS(){
		$dbconn = $this->dbConn();
		$sql = "SELECT appupdate.*, hotels.hotel_name FROM appupdate, hotels WHERE hotels.hotel_ID = appupdate.hotel_ID ORDER BY appupdate_ID ASC";
		$stmt = $dbconn->prepare($sql);
		$stmt->execute();
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);	
		return $results;
	}
}
?>