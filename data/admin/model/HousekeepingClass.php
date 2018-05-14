<?php
/**
 * Developed By: Joe John Ferrolino
 */
class Housekeeping extends Database{
    
    function fetchViewHousekeeping($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                housekeepings.housekeeping_ID,
				housekeepings.notif_seen,
                housekeepings.hk_status,
                housekeepings.created_at
            FROM housekeepings
                INNER JOIN guests
                    ON guests.guest_ID = housekeepings.guest_ID
            WHERE guests.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewRequested($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                housekeepings.housekeeping_ID,
				housekeepings.notif_seen,
                housekeepings.hk_status,
                housekeepings.created_at
            FROM housekeepings
                INNER JOIN guests
                    ON guests.guest_ID = housekeepings.guest_ID
            WHERE housekeepings.hk_status = 'Requested HouseKeeping' AND guests.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewCancelHousekeeping($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                housekeepings.housekeeping_ID,
				housekeepings.notif_seen,
                housekeepings.hk_status,
                housekeepings.created_at
            FROM housekeepings
                INNER JOIN guests
                    ON guests.guest_ID = housekeepings.guest_ID
            WHERE housekeepings.hk_status = 'Cancel HouseKeeping Today' AND guests.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewStayHousekeeping($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT
                guests.guest_ID,
                guests.firstname,
                guests.lastname,
                guests.room_no,
                guests.hotel_ID,
                housekeepings.housekeeping_ID,
				housekeepings.notif_seen,
                housekeepings.hk_status,
                housekeepings.created_at
            FROM housekeepings
                INNER JOIN guests
                    ON guests.guest_ID = housekeepings.guest_ID
            WHERE housekeepings.hk_status = 'Cancelled HouseKeeping for Whole Stay' AND guests.hotel_ID = ?"
        );
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function deleteHousekeepingByID($housekeeping_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM housekeepings WHERE housekeeping_ID = '".$housekeeping_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
}
?>