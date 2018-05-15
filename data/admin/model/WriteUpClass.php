<?php
/**
 * Developed By: Joe John Ferrolino
 */
class WriteUp extends Database{
    
    function fetchWriteUpInformation($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM write_up WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    function editWriteUpAreaByID($data){
        extract($data);
        $dbconn = $this->dbconn();
        $sql = "UPDATE write_up
                SET area_description  = '".$data['aboutarea']."'
                WHERE writeUp_ID      = '".$data['writeUp_ID']."'";
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
    function editWriteUpByID($data) { 
        extract($data);
        $dbconn = $this->dbconn();
        $sql = "UPDATE write_up
                SET hotel_name         = '".$data['hotel_name']."',
                    hotel_description   = '".$data['description']."'
                WHERE writeUp_ID       = '".$data['writeUp_ID']."'";
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