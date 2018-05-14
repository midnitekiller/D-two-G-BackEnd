<?php
/**
 * Developed By: Joe John Ferrolino
 */
class AdminReport extends Database{
    
    function fetchViewOrder($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                restaurant_order_detail.restoorder_ID,
                restaurant_order_detail.menu_name,
                restaurant_order_detail.menu_shortDesc,
                restaurant_order_detail.menu_price,
                restaurant_order_detail.quantity,
                restaurant_order_detail.subtotal,
                restaurant_order_detail.created_at,
                restaurant_order.restoorder_ID,
                restaurant_order.grand_total,
                restaurant_order.confirm_status
            FROM restaurant_order_detail
                INNER JOIN restaurant_order
                    ON restaurant_order.restoorder_ID = restaurant_order_detail.restoorder_ID
                INNER JOIN guests
                    ON guests.guest_ID = restaurant_order.guest_ID
                WHERE guests.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewService($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.hotel_ID,
                services_order_detail.*,
                services_order.*
            FROM services_order
                INNER JOIN services_order_detail
                    ON services_order_detail.serviceOrder_ID = services_order.serviceOrder_ID
                INNER JOIN guests
                    ON guests.guest_ID = services_order.guest_ID
            WHERE guests.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewFeedback($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                feedbacks.feedback_overall,
                feedbacks.feedback_location,
                feedbacks.feedback_room,
                feedbacks.feedback_service,
                feedbacks.feedback_value,
                feedbacks.feedback_cleanliness,
                feedbacks.feedback_restaurant,
                feedbacks.feedback_message,
                feedbacks.created_at
            FROM feedbacks
                INNER JOIN guests
                    ON guests.guest_ID = feedbacks.guest_ID
            WHERE guests.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewHotel($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM guestshistory WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function deleteGuestsByID($guest_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM guestshistory WHERE guest_ID = '".$guest_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function fetchViewAllHotelGuests(){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                hotels.hotel_name,
                guests.*
            FROM guests
                INNER JOIN hotels
                    ON hotels.hotel_ID = guests.hotel_ID"
        );
        $stmt->execute();
        $result = $stmt->fetchAll();
		return $result;
    }
    
    function fetchViewAllHotel(){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT hotel_name FROM hotels");
        $stmt->execute();
        $result = $stmt->fetchAll();
		return $result;
    }
}
?>