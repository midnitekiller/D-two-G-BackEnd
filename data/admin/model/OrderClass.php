<?php
/**
 * Developed By: Joe John Ferrolino
 */
class Order extends Database{
    /*--------------------------------------------*/
    /*--------------RESTAURANT ORDERS-------------*/
    /*--------------------------------------------*/
    function fetchViewOrder($order_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                restaurant_order_detail.*,
                restaurant_order.*
             FROM  restaurant_order_detail
                INNER JOIN restaurant_order
                    ON restaurant_order.restoorder_ID = restaurant_order_detail.restoorder_ID
                WHERE restaurant_order_detail.restoorder_ID = ?"
        );
        $stmt->execute([$order_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchDataOrder($order_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                restaurant_order.restoorder_ID,
                restaurant_order.guest_ID,
                restaurant_order.hotel_ID,
                restaurant_order.grand_total,
                restaurant_order.created_at
            FROM restaurant_order
                INNER JOIN guests
                    ON guests.guest_ID = restaurant_order.guest_ID
            WHERE restaurant_order.restoorder_ID = ?"
        );
        $stmt->execute([$order_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchOrder($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                restaurant_order.restoorder_ID,
				restaurant_order.notif_seen,
                restaurant_order.guest_ID,
                restaurant_order.hotel_ID,
                restaurant_order.grand_total,
                restaurant_order.confirm_status,
                restaurant_order.created_at
            FROM restaurant_order
                INNER JOIN guests
                    ON guests.guest_ID = restaurant_order.guest_ID
            WHERE restaurant_order.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
		
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $res){
			$result[$i]['created'] = date("F j, Y, g:i a", strtotime($res['created_at']));
		}
		return $result;
    }
    
    function changeStatus($data){
		$dbconn = $this->dbConn();
		$sql = "UPDATE restaurant_order SET confirm_status = '".$data['status']."' WHERE  restoorder_ID  = '".$data['restoorder_ID']."'";
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
    
    function confirmStatus($data){
		$dbconn = $this->dbConn();
		$sql = "UPDATE restaurant_order SET confirm_status = 'active' WHERE restoorder_ID  = '".$data['restoorder_ID']."'";
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
    /*--------------------------------------------*/
    /*-----------------ORDER ORDERS---------------*/
    /*--------------------------------------------*/
    function fetchViewService($order_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                services_order_detail.*,
                services_order.*
             FROM  services_order_detail
                INNER JOIN services_order
                    ON services_order.serviceOrder_ID = services_order_detail.serviceOrder_ID
             WHERE services_order_detail.serviceOrder_ID = ?"
        );
        $stmt->execute([$order_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchDataService($order_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                services_order.serviceOrder_ID,
                services_order.guest_ID,
                services_order.hotel_ID,
                services_order.grand_total,
                services_order.created_at
             FROM services_order
                INNER JOIN guests
                    ON guests.guest_ID = services_order.guest_ID
             WHERE services_order.serviceOrder_ID = ?"
        );
        $stmt->execute([$order_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchService($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                services_order.serviceOrder_ID,
				services_order.notif_seen,
                services_order.guest_ID,
                services_order.hotel_ID,
                services_order.grand_total,
                services_order.confirm_status,
                services_order.created_at
             FROM services_order
                INNER JOIN guests
                    ON guests.guest_ID = services_order.guest_ID
             WHERE services_order.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function changeStatusService($data){
		$dbconn = $this->dbConn();
		$sql = "UPDATE services_order SET confirm_status = '".$data['status']."' WHERE  serviceOrder_ID  = '".$data['serviceOrder_ID']."'";
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
    
    function confirmStatusService($data){
		$dbconn = $this->dbConn();
		$sql = "UPDATE services_order SET confirm_status = 'active' WHERE serviceOrder_ID  = '".$data['serviceOrder_ID']."'";
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