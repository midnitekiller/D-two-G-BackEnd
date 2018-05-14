<?php
/**
 * Developed By: Joe John Ferrolino
 */
class Services extends Database{
    
    function addServices($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO services (hotel_ID, serviceName, description, image, created_at) VALUES (:hotel_ID, :serviceName, :description, :image, :created_at)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->bindParam(':serviceName', $serviceName);
		$stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $img_service);
		$stmt->bindParam(':created_at', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
    
    function addServicesDetail($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO services_product (service_ID, hotel_ID, serviceProdName, serviceProdDesc, serviceProdPrice, duration, image, created_at) 
        VALUES (:service_ID, :hotel_ID, :serviceProdName, :serviceProdDesc, :serviceProdPrice, :duration, :image, :created_at)";
		$stmt = $dbconn->prepare($query);
        $stmt->bindParam(':service_ID', $service_ID);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
        $stmt->bindParam(':serviceProdName', $services_detail_name);
        $stmt->bindParam(':serviceProdDesc', $description);
		$stmt->bindParam(':serviceProdPrice', $service_price);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':image', $img_service);
		$stmt->bindParam(':created_at', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
    
    function deleteServicesByID($service_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM services WHERE service_ID = '".$service_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function deleteServicesDetailByID($serviceProd_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM services_product WHERE serviceProd_ID = '".$serviceProd_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function getServicesByID($service_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT * FROM services WHERE service_ID = '".$service_ID."'";
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
    
    function getServicesDetailByID($serviceProd_ID){
        $dbconn =$this->dbconn();
        $sql =  "SELECT services.serviceName, services_product.* FROM services_product INNER JOIN services ON services.service_ID = services_product.service_ID where services_product.serviceProd_ID = '".$serviceProd_ID."'";
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
    
    function editServicesByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE services
                SET serviceName   = '".$data['serviceName']."',
                    description   = '".$data['description']."',
                    image         = '".$data['img_service']."'
                WHERE service_ID  = '".$data['service_ID']."'";
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
    
    function checkServices($service_ID, $hotel_ID){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM services  WHERE service_ID = :service_ID AND hotel_ID = :hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':service_ID', $service_ID);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
    
    function editServicesDetailByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE services_product
                SET service_ID        = '".$data['service_ID']."',
                    serviceProdName   = '".$data['services_detail_name']."',
                    serviceProdDesc   = '".$data['description']."',
                    serviceProdPrice  = '".$data['service_price']."',
                    duration          = '".$data['duration']."',
                    image             = '".$data['img_service']."'
                WHERE serviceProd_ID  = '".$data['serviceProd_ID']."'";
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
    
    function checkServicesDetail($serviceProd_ID, $hotel_ID){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM services_product WHERE serviceProd_ID = :serviceProd_ID AND hotel_ID = :hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':serviceProd_ID', $serviceProd_ID);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
    
    function fetchServicesAll($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT services.*, hotels.hotel_name FROM services, hotels WHERE services.hotel_ID = hotels.hotel_ID AND services.hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchServicesDetailAll($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT services.*, services_product.*, hotels.hotel_name FROM services_product INNER JOIN services ON services.service_ID = services_product.service_ID INNER JOIN hotels ON
        hotels.hotel_ID = services_product.hotel_ID where services_product.hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function fetchServicesType($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM services WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchServicesInformation($service_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT services.*, hotels.hotel_name FROM services, hotels WHERE services.hotel_ID = hotels.hotel_ID AND services.service_ID = ?");
        $stmt->execute([$service_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchServicesDetailInformation($serviceProd_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT services.serviceName, services_product.*, hotels.hotel_name FROM services_product INNER JOIN services ON services.service_ID = services_product.service_ID
        INNER JOIN hotels ON hotels.hotel_ID = services_product.hotel_ID where services_product.serviceProd_ID = ?");
        $stmt->execute([$serviceProd_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>