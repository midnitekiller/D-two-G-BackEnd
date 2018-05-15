<?php
/**
 * Developed By: Joe John Ferrolino
 */
class Offer extends Database{
    
    function addOffer($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO offers (hotel_ID, offer_name, description, image, created_at) VALUES (:hotel_ID, :offer_name, :description, :image, :created_at)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->bindParam(':offer_name', $offer_name);
		$stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $img_offer);
		$stmt->bindParam(':created_at', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
    
    function addOfferdetail($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO offers_detail (offer_ID, hotel_ID, offerdetail_name, offer_description, selling_price, original_price, duration, image, created_at)
        VALUES (:offer_ID, :hotel_ID, :offerdetail_name, :offer_description, :selling_price, :original_price, :duration, :image, :created_at)";
		$stmt = $dbconn->prepare($query);
        $stmt->bindParam(':offer_ID', $offer_ID);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->bindParam(':offerdetail_name', $offerdetail_name); 
		$stmt->bindParam(':offer_description', $description);
        $stmt->bindParam(':selling_price', $s_price);
        $stmt->bindParam(':original_price', $o_price);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':image', $img_offer);
		$stmt->bindParam(':created_at', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
     
    function deleteOfferByID($offer_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM offers WHERE offer_ID = '".$offer_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function deleteOfferdetailByID($offerdetail_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM offers_detail WHERE offerdetail_ID = '".$offerdetail_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function getOfferByID($offer_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT * FROM offers WHERE offer_ID = '".$offer_ID."'";
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
    
    function getOfferdetailByID($offerdetail_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT offers.offer_name, offers_detail.* FROM offers_detail INNER JOIN offers ON offers.offer_ID = offers_detail.offer_ID where offers_detail.offerdetail_ID = '".$offerdetail_ID."'";
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
    
    function editOfferByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE offers
                SET offer_name    = '".$data['offer_name']."',
                    description   = '".$data['description']."',
                    image         = '".$data['img_offer']."'
                WHERE offer_ID    = '".$data['offer_ID']."'";
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
    
    function checkOffer($offer_ID, $hotel_ID){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM offers WHERE offer_ID = :offer_ID AND hotel_ID = :hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':offer_ID', $offer_ID);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
    
    function editOfferDetailByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE offers_detail
                SET offer_ID            = '".$data['offer_ID']."',
                    offerdetail_name    = '".$data['offerdetail_name']."',
                    offer_description   = '".$data['description']."',
                    selling_price       = '".$data['s_price']."',
                    original_price      = '".$data['o_price']."',
                    duration            = '".$data['duration']."',
                    image               = '".$data['img_offer']."'
                WHERE offerdetail_ID    = '".$data['offerdetail_ID']."'";
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
    
    function checkOfferDetail($offerdetail_ID, $hotel_ID){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM offers_detail WHERE offerdetail_ID = :offerdetail_ID AND hotel_ID = :hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':offerdetail_ID', $offerdetail_ID);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
    
    function fetchOfferAll($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT offers.*, hotels.hotel_name FROM offers INNER JOIN hotels ON hotels.hotel_ID = offers.hotel_ID where offers.hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchOfferDetailAll($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT offers.offer_name, offers_detail.*, hotels.hotel_name FROM offers_detail INNER JOIN offers ON offers.offer_ID = offers_detail.offer_ID INNER JOIN hotels ON hotels.hotel_ID = offers_detail.hotel_ID where offers_detail.hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    
    function fetchOfferInformation($offer_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT offers.*, hotels.hotel_name FROM offers INNER JOIN hotels ON hotels.hotel_ID = offers.hotel_ID WHERE offers.offer_ID = ?");
        $stmt->execute([$offer_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchOfferDetailInformation($offerdetail_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT offers.offer_name, offers_detail.*, hotels.hotel_name FROM offers_detail INNER JOIN offers ON offers.offer_ID = offers_detail.offer_ID INNER JOIN hotels ON hotels.hotel_ID = offers_detail.hotel_ID where offers_detail.offerdetail_ID = ?");
        $stmt->execute([$offerdetail_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchOfferType($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM offers WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>