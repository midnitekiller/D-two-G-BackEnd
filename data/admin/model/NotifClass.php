<?php
class Notif extends Database{
      /*--------------------------------------------*/
     /*--------------RESTAURANT ORDERS-------------*/
    /*--------------------------------------------*/
    
    function fetchOrder($hotelid){
        $dbconn = $this->dbConn();
		$seen = "false";
        $stmt = $dbconn->prepare("SELECT COUNT(*) AS res_numbers FROM restaurant_order WHERE hotel_ID = :hotelid AND notif_seen = :seen");
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':seen', $seen);
        $stmt->execute();
        return $result = $stmt->fetchColumn();
    }
    
    
      /*---------------------------------------------*/
     /*----------------SERVICE ORDERS---------------*/
    /*---------------------------------------------*/
    
    function fetchService($hotelid){
        $dbconn = $this->dbConn();
		$seen = "false";
        $stmt = $dbconn->prepare("SELECT COUNT(*) AS ser_numbers FROM services_order WHERE hotel_ID = :hotelid AND notif_seen = :seen");
        $stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':seen', $seen);
        $stmt->execute();
        return $result = $stmt->fetchColumn();
    }
	
	  /*----------------------------------------------*/
	 /*-----------------HOUSEKEEPING-----------------*/
	/*----------------------------------------------*/
	
	function fetchHouseK($hotelid){
		$dbconn = $this->dbConn();
		$seen = "false";
        $stmt = $dbconn->prepare("SELECT COUNT(*) AS hk_numbers FROM housekeepings WHERE hotel_ID = :hotelid AND notif_seen = :seen");
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':seen', $seen);
        $stmt->execute();
        return $result = $stmt->fetchColumn();
	}
	
	function fetchFeedback($hotelid){
		$dbconn = $this->dbConn();
		$seen = "false";
		$stmt = $dbconn->prepare("SELECT COUNT(*) AS fb_numbers FROM feedbacks WHERE hotel_ID = :hotelid AND notif_seen = :seen");
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':seen', $seen);
		$stmt->execute();
		return $result = $stmt->fetchColumn();
	}
	
	function setFoods($data){
		extract($data);
		$dbconn = $this->dbConn();
		$seen = "true";
		$stmt = $dbconn->prepare("UPDATE restaurant_order SET notif_seen = :seen WHERE hotel_ID = :hotelid AND restoorder_ID = :orderid");
		$stmt->bindParam(':seen', $seen);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':orderid', $orderid);
		$stmt->execute();
	}
	
	function setServices($data){
		extract($data);
		$dbconn = $this->dbConn();
		$seen = "true";
		$stmt = $dbconn->prepare("UPDATE services_order SET notif_seen = :seen WHERE hotel_ID = :hotelid AND serviceOrder_ID = :orderid");
		$stmt->bindParam(':seen', $seen);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':orderid', $orderid);
		$stmt->execute();
	}
	
	function setHousekeeping($data){
		extract($data);
		$dbconn = $this->dbConn();
		$seen = "true";
		$stmt = $dbconn->prepare("UPDATE housekeepings SET notif_seen = :seen WHERE hotel_ID = :hotelid AND housekeeping_ID = :housekeepingid");
		$stmt->bindParam(':seen', $seen);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':housekeepingid', $hkid);
		$stmt->execute();
	}
	
	function setFeedBack($data){
		extract($data);
		$dbconn = $this->dbConn();
		$seen = "true";
		$stmt = $dbconn->prepare("UPDATE feedbacks SET notif_seen = :seen WHERE hotel_ID = :hotelid AND feedback_ID = :feedid");
		$stmt->bindParam(':seen', $seen);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':feedid', $feedid);
		$stmt->execute();
    }
   
}
?>