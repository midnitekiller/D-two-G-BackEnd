<?php
/**
 * Developed By: Joe John Ferrolino
 */
class Feedback extends Database{
    
    function fetchViewFeedback($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                feedbacks.*
            FROM feedbacks
                INNER JOIN guests
                    ON guests.guest_ID = feedbacks.guest_ID
            WHERE guests.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function deletefeedbackByID($feedback_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM feedbacks WHERE feedback_ID = '".$feedback_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    
    function fetchViewAllFeedback(){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                hotels.hotel_name,
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                feedbacks.*
            FROM feedbacks
                INNER JOIN guests
                    ON guests.guest_ID = feedbacks.guest_ID
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