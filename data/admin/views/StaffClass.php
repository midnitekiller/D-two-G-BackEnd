<?php
class Staff extends Database{
    function addStaff($data) {
        extract($data);
		$hotel = 1;
        $status = 'active';
		$password = password_hash($password, PASSWORD_DEFAULT);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO staff (hotel_ID,title,firstname,middlename,lastname,address,phone,email,username,password,status,created_at) VALUES                                                                   (:hotel_ID,:title,:firstname,:middlename,:lastname,:address,:phone,:email,:username,:password,:status,:created_at)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID',$hotel);
        $stmt->bindParam(':title',$title);
		$stmt->bindParam(':firstname',$firstname);
		$stmt->bindParam(':middlename',$middlename);
		$stmt->bindParam(':lastname',$lastname);
		$stmt->bindParam(':address',$address);
        $stmt->bindParam(':phone',$phone);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':username',$username);
		$stmt->bindParam(':password',$password);
        $stmt->bindParam(':status',$status);
		$stmt->bindParam(':created_at',$created);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }
    function addAssignment($data) {
        extract($data);
        $staff_ID = 1;
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
        $query = "INSERT INTO assignment (staff_ID,about_hotel,room_dining,frontdesk,services,offers,staff,housekeeping,pos,order_history,reports,created_at) VALUES                                                               ((SELECT staff_ID FROM staff WHERE staff_ID = :staff_ID),:about_hotel,:room_dining,:frontdesk,:services,:offers,:staff,:housekeeping,:pos,:order_history,:reports,:created_at)";
        $stmt = $dbconn->prepare($query);
        $stmt->bindParam(':staff_ID',$staff_ID);
        $stmt->bindParam(':about_hotel',$about_hotel);
        $stmt->bindParam(':room_dining',$room_dining);
		$stmt->bindParam(':frontdesk',$frontdesk);
		$stmt->bindParam(':services',$services);
		$stmt->bindParam(':offers',$offers);
        $stmt->bindParam(':staff',$staff);
		$stmt->bindParam(':housekeeping',$housekeeping);
		$stmt->bindParam(':pos',$pos);
		$stmt->bindParam(':order_history',$order_history);
        $stmt->bindParam(':reports',$reports);
		$stmt->bindParam(':created_at',$created);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }
    function getAllStaff() {
        $dbconn = $this->dbConn();
        $sql = "SELECT * FROM staff";
        $result = false;
        try {
            $stmt = $dbconn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $dbconn = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $result;
    }
    function fetchStaffInformation($staff_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM staff WHERE staff_ID = ?");
        $stmt->execute([$staff_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function deleteStaffByID($staff_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM staff WHERE staff_ID = '".$staff_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    function getStaffByID($staff_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT * FROM staff WHERE staff_ID = '".$staff_ID."'";
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
    function editStaffByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE staff
                SET title       = '".$data['title']."',
                    firstname   = '".$data['firstname']."',
                    middlename  = '".$data['middlename']."',
                    lastname    = '".$data['lastname']."',
                    permanent_address  = '".$data['permanent_addresss']."',
                    current_address    = '".$data['current_addresss']."',
                    email       = '".$data['email']."',
                    username    = '".$data['username']."',
                    password    = '".$data['password']."'
                WHERE staff_ID = '".$data['staff_ID']."'";
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
		$sql = "UPDATE staff SET status = '".$data['status']."' WHERE staff_ID = '".$data['staff_ID']."'";;
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
}
?>