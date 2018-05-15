<?php
/**
 * Developed By: Joe John Ferrolino
 */
class Restaurant extends Database{
	function addRestaurant($data){
		extract($data);
		
		$ampm1 = explode(" ", $timepicker1);
		$time1 = explode(":", $ampm1[0]);
		$hour1 = "";
		if($ampm1[1] == "pm" || $ampm1[1] == "PM"){
			$hour1 = (int)$time1[0] + 12;
		}else{
			$hour1 = $time1[0];
		}		
		$time11 = $hour1 . ":" . $time1[1] . ":00";
		
		$ampm2 = explode(" ", $timepicker2);
		$time2 = explode(":", $ampm2[0]);
		$hour2 = "";
		if($ampm2[1] == "pm" || $ampm2[1] == "PM"){
			$hour2 = (int)$time2[0] + 12;
		}else{
			$hour2 = $time2[0];
		}			
		$time22 = $hour2 . ":" . $time2[1] . ":00";
		
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO restaurants (hotel_ID, restaurant_name, time_open, time_close, description, image, created_at) VALUES (:hotel_ID, :restaurant_name, :time_open, :time_close, :description, :image, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->bindParam(':restaurant_name', $restaurant_name);
		$stmt->bindParam(':time_open', $time11);
		$stmt->bindParam(':time_close', $time22);
        $stmt->bindParam(':description', $description);
		$stmt->bindParam(':image', $img_restaurant);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
    
    function deleteRestaurantByID($restaurant_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM restaurants WHERE restaurant_ID = '".$restaurant_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function getRestaurantByID($restaurant_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT * FROM restaurants WHERE restaurant_ID = '".$restaurant_ID."'";
        $result = false;
        try {
            $stmt = $dbconn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
			
			$hour1 = explode(":",$result['time_open']);
			if( (int)$hour1[0] > 12){
				$time = (int)$hour1[0] - 12;
				$result['time_open'] = $time . ":" . $hour1[1] . " PM";
				$result['3'] = $time . ":" . $hour1[1] . " PM";
			}else{
				$result['time_open'] = $hour1[0] . ":" . $hour1[1] . " AM";
				$result['3'] = $hour1[0] . ":" . $hour1[1] . " AM";
			}
			
			$hour2 = explode(":",$result['time_close']);
			if( (int)$hour2[0] > 12){
				$time = (int)$hour2[0] - 12;
				$result['time_close'] = $time . ":" . $hour2[1] . " PM";
				$result['4'] = $time . ":" . $hour2[1] . " PM";
			}else{
				$result['time_close'] = $hour2[0] . ":" . $hour2[1] . " AM";
				$result['4'] = $hour2[0] . ":" . $hour2[1] . " AM";
			}
            $dbconn = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return json_encode($result);
    }

    function editRestaurantByID($data) { 
		extract($data);
		
		$ampm1 = explode(" ", $timepicker1);
		$time1 = explode(":", $ampm1[0]);
		$hour1 = "";
		if($ampm1[1] == "pm" || $ampm1[1] == "PM"){
			$hour1 = (int)$time1[0] + 12;
		}else{
			$hour1 = $time1[0];
		}			
		$time11 = $hour1 . ":" . $time1[1] . ":00";
		
		$ampm2 = explode(" ", $timepicker2);
		$time2 = explode(":", $ampm2[0]);
		$hour2 = "";
		if($ampm2[1] == "pm" || $ampm2[1] == "PM"){
			$hour2 = (int)$time2[0] + 12;
		}else{
			$hour2 = $time2[0];
		}		
		$time22 = $hour2 . ":" . $time2[1] . ":00";
	
        $dbconn = $this->dbconn();
        $sql = "UPDATE restaurants
                SET restaurant_name = '".$restaurant_name."',
                    time_open       = '".$time11."',
                    time_close      = '".$time22."',
                    description     = '".$description."',
                    image           = '".$img_restaurant."'
                WHERE restaurant_ID = '".$restaurant_ID."'";
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

    function fetchRestaurantAll($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM restaurants WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $res){
			$result[$i]['img_path'] = "/restaurant/".preg_replace("/[^a-zA-Z]+/", "", $res['restaurant_name'])."/".$res['image'];
			$hour1 = explode(":",$res['time_open']);
			if( (int)$hour1[0] > 12){
				$time = (int)$hour1[0] - 12;
				$result[$i]['time_open'] = $time . ":" . $hour1[1] . " PM";
			}else{
				$result[$i]['time_open'] = $hour1[0] . ":" . $hour1[1] . " AM";
			}
			
			$hour2 = explode(":",$res['time_close']);
			if( (int)$hour2[0] > 12){
				$time = (int)$hour2[0] - 12;
				$result[$i]['time_close'] = $time . ":" . $hour2[1] . " PM";
			}else{
				$result[$i]['time_close'] = $hour2[0] . ":" . $hour2[1] . " AM";
			}
		}
		return $result;
    }
    
    function fetchRestaurantInformation($restaurant_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT restaurants.*, hotels.hotel_name FROM restaurants INNER JOIN hotels ON hotels.hotel_ID = restaurants.hotel_ID WHERE restaurants.restaurant_ID = ?");
        $stmt->execute([$restaurant_ID]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $res){
			$result[$i]['img_path'] = "/restaurant/".preg_replace("/[^a-zA-Z]+/", "", $res['restaurant_name'])."/".$res['image'];
			$hour1 = explode(":",$res['time_open']);
			if( (int)$hour1[0] > 12){
				$time = (int)$hour1[0] - 12;
				$result[$i]['time_open'] = $time . ":" . $hour1[1] . " PM";
			}else{
				$result[$i]['time_open'] = $hour1[0] . ":" . $hour1[1] . " AM";
			}
			
			$hour2 = explode(":",$res['time_close']);
			if( (int)$hour2[0] > 12){
				$time = (int)$hour2[0] - 12;
				$result[$i]['time_close'] = $time . ":" . $hour2[1] . " PM";
			}else{
				$result[$i]['time_close'] = $hour2[0] . ":" . $hour2[1] . " AM";
			}
		}
		return $result;
    }
    
    function checkRestaurant($restaurant_ID, $hotel_ID){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM restaurants WHERE restaurant_ID = :restaurant_ID AND hotel_ID = :hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':restaurant_ID', $restaurant_ID);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
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