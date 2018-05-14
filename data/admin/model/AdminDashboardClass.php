<?php
/**
 * Developed By: Joe John Ferrolino
 */
class AdminDashboard extends Database{
    
    /* ------------------------------------------------------ */
    /* -------------------ADMIN DASHBOARD-------------------- */
    /* ------------------------------------------------------ */
    
    function fetchViewGuests($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(guest_ID)guest_ID from guests WHERE hotel_ID  = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchColumn();
    }
    
    function fetchBooking($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(guest_ID)guest_ID from guests WHERE created_at >= CURDATE() and  hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchColumn();
    }
    
    function fetchRestaurant($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(restoorder_ID)restototal_ID from restaurant_order WHERE created_at >= CURDATE() and  hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchColumn();
    }
    
    function fetchService($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(serviceOrder_ID)serviceOrder_ID from services_order WHERE created_at >= CURDATE() and  hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchColumn();
    }
    
    function fetchChannels($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(channel_ID)channel_ID from channels WHERE  hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchColumn();
    }
    
    function fetchFeedback($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(feedback_ID)feedback_ID from feedbacks WHERE created_at >= CURDATE() and  hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchColumn();
    }
    
    function fetchHousekeeping($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(housekeeping_ID)housekeeping_ID from housekeepings WHERE created_at >= CURDATE() and  hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchColumn();
    }
    
    function fetchStaff($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(staff_ID)staff_ID from staff WHERE  hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchColumn();
    }
    
    /* ------------------------------------------------------ */
    /* -----------------SUPER ADMIN DASHBOARD---------------- */
    /* ------------------------------------------------------ */
    
    function fetchViewAllHotel(){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(hotel_ID)hotel_ID from hotels");
        $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewAllChannels(){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT channels.*,hotels.hotel_name, COUNT(*)channel 
             FROM channels
                INNER JOIN hotels
             ON hotels.hotel_ID = channels.hotel_ID
             GROUP BY hotel_ID;"
        );
        $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewAllDevice(){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT device.*,hotels.hotel_name, COUNT(*)device
             FROM device
                INNER JOIN hotels
             ON hotels.hotel_ID = device.hotel_ID
             GROUP BY hotel_ID;"
        );
        $stmt->execute();
         return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchViewAllFeedback(){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare(
            "SELECT feedbacks.*,hotels.hotel_name, COUNT(*)feedback
             FROM feedbacks
                INNER JOIN hotels
             ON hotels.hotel_ID = feedbacks.hotel_ID
             GROUP BY hotel_ID;"
        );
        $stmt->execute();
         return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    function fetchPlaceNearby(){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(company_ID)company from places_nearby_companies");
        $stmt->execute();
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /* ------------------------------------------------------ */
    /* ------------------ADVERTISER DASHBOARD---------------- */
    /* ------------------------------------------------------ */
    
    function fetchLiveAds($email){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(ads_ID)ads_ID from places_detail where ad_time_end > CURDATE() and company_ID = (SELECT company_ID FROM places_nearby_companies WHERE company_email = ?)");
        $stmt->execute([$email]);
        return $result = $stmt->fetchColumn();
    }
    function fetchExpiredAds($email){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("select COUNT(ads_ID)ads_ID from places_detail where ad_time_end <= CURDATE() and company_ID = (SELECT company_ID FROM places_nearby_companies WHERE company_email = ?)");
        $stmt->execute([$email]);
        return $result = $stmt->fetchColumn();
    }
}
?>