<?php
class Staff extends Database{
    function addStaff($data) {
        extract($data);
        $status = 'active';
		$password = password_hash($password, PASSWORD_DEFAULT);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO staff (hotel_ID,title,firstname,middlename,lastname,address,phone,email,username,password,status,created_at) VALUES                                                               (:hotel_ID,:title,:firstname,:middlename,:lastname,:address,:phone,:email,:username,:password,:status,:created_at)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID',$hotel_ID);
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
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
        $query = "INSERT INTO assignment (staff_ID,about_hotel,room_dining,frontdesk,services,offers,staff,housekeeping,feedbacks,channels,pos,order_history,reports,others,created_at) VALUES                                                      ((select staff_ID from staff  WHERE email='".$data['email']."'),:about_hotel,:room_dining,:frontdesk,:services,:offers,:staff,:housekeeping,:feedbacks,:channels,:pos,:order_history,:reports,:others,:created_at)";
        $stmt = $dbconn->prepare($query);
        $stmt->bindParam(':about_hotel',$about_hotel);
        $stmt->bindParam(':room_dining',$room_dining);
		$stmt->bindParam(':frontdesk',$frontdesk);
		$stmt->bindParam(':services',$services);
		$stmt->bindParam(':offers',$offers);
        $stmt->bindParam(':staff',$staff);
		$stmt->bindParam(':housekeeping',$housekeeping);
        $stmt->bindParam(':feedbacks',$feedbacks);
		$stmt->bindParam(':channels',$channels);
		$stmt->bindParam(':pos',$pos);
		$stmt->bindParam(':order_history',$order_history);
        $stmt->bindParam(':reports',$reports);
		$stmt->bindParam(':others',$others);
		$stmt->bindParam(':created_at',$created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
    }

    function getAllStaff($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM staff WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchStaffData($staff_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT staff.staff_ID, staff.lastname, staff.firstname, staff.phone, staff.address, staff.email, staff.status, staff.username, staff.created_at, assignment.about_hotel,assignment.room_dining, assignment.frontdesk, assignment.services, assignment.offers, assignment.staff, assignment.housekeeping,assignment.feedbacks,assignment.channels, assignment.pos, assignment.order_history, assignment.reports, assignment.others FROM staff INNER JOIN assignment ON staff.staff_ID=assignment.staff_ID where staff.staff_ID = ? ");
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
        $sql = "SELECT staff.staff_ID, staff.title,  staff.firstname, staff.middlename, staff.lastname, staff.phone, staff.address, staff.email, staff.status, staff.username, staff.created_at, assignment.about_hotel,assignment.room_dining, assignment.frontdesk, assignment.services, assignment.offers, assignment.staff, assignment.housekeeping, assignment.feedbacks, assignment.channels, assignment.pos, assignment.order_history, assignment.reports, assignment.others FROM staff INNER JOIN assignment ON staff.staff_ID=assignment.staff_ID where staff.staff_ID = '".$staff_ID."'";
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
        extract($data);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $dbconn = $this->dbconn();
        $sql = "UPDATE staff
                SET title       = '".$data['title']."',
                    firstname   = '".$data['firstname']."',
                    middlename  = '".$data['middlename']."',
                    lastname    = '".$data['lastname']."',
                    address     = '".$data['address']."',
                    phone       = '".$data['phone']."',
                    email       = '".$data['email']."',
                    username    = '".$data['username']."',
                    password    = '".$password."'
                WHERE staff_ID  = '".$data['staff_ID']."'";
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
    
    function editAssignmentByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE assignment
                SET about_hotel      = '".$data['about_hotel']."',
                    room_dining      = '".$data['room_dining']."',
                    frontdesk        = '".$data['frontdesk']."',
                    services         = '".$data['services']."',
                    offers           = '".$data['offers']."',
                    staff            = '".$data['staff']."',
                    housekeeping     = '".$data['housekeeping']."',
					feedbacks		 = '".$data['feedbacks']."',
					channels		 = '".$data['channels']."',
                    pos              = '".$data['pos']."',
                    order_history    = '".$data['order_history']."',
                    reports          = '".$data['reports']."',
					others			 = '".$data['others']."'
                WHERE staff_ID       = '".$data['staff_ID']."'";
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
    
    function checkEmail($email){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM staff WHERE email = :email";
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
    
    function checkUsername($username){
		$dbconn = $this->dbConn();
		$query = "SELECT 1 FROM staff WHERE username = :username";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':username', $username);
		$stmt->execute();
		$result = $stmt->fetch();
		if($result){
			return true;
		}else {
			return false;
		}
	}
	
	
	
	function getAboutHotel($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT about_hotel FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getRoomDining($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT room_dining FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getFrontDesk($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT frontdesk FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getServices($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT services FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getOffers($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT offers FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getStaff($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT staff FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getHousekeeping($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT housekeeping FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getFeedbacks($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT feedbacks FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getChannels($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT channels FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getPOS($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT pos FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getOrderHistory($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT order_history FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getReports($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT reports FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	function getOthers($staffid){
		$dbconn = $this->dbConn();
		$stmt = $dbconn->prepare("SELECT others FROM assignment WHERE staff_ID = ?");
		$stmt->execute([$staffid]);
		$result = $stmt->fetchColumn();
		if(!empty($result)){
			return $result;
		}else{
			return "blank";
		}
	}
	
	
}
?>