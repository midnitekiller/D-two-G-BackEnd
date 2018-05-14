<?php
/**
 * Developed By: Joe John Ferrolino
 */
class FAQ extends Database{
	function addFAQ($data){
		extract($data);
        $status = "active";
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO faq (hotel_ID, question, answer, status, created_at) VALUES (:hotel_ID, :question, :answer, :status, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotel_ID', $hotel_ID);
		$stmt->bindParam(':question', $question);
		$stmt->bindParam(':answer', $answer);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
    function deleteFAQByID($faq_ID){
        $dbconn = $this->dbconn();
        $sql = "DELETE FROM faq WHERE faq_ID = '".$faq_ID."'";
         try {
            $stmt = $dbconn->prepare($sql);
            $value = $stmt->execute();
            $dbconn = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
    function getFAQByID($faq_ID){
        $dbconn =$this->dbconn();
        $sql = "SELECT * FROM faq WHERE faq_ID = '".$faq_ID."'";
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
    function editFAQByID($data) { 
        $dbconn = $this->dbconn();
        $sql = "UPDATE faq
                SET question = '".$data['question']."',
                    answer   = '".$data['answer']."'
                WHERE faq_ID = '".$data['faq_ID']."'";
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
		$sql = "UPDATE faq SET status = '".$data['status']."' WHERE faq_ID = '".$data['faq_ID']."'";;
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
    function fetchFAQall($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM faq WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
				$result[$i]['ans'] = trim(substr($r['answer'], 0, 25))."...";
		}
		return $result;
    }
     function fetchFAQInformation($faq_ID){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM faq WHERE faq_ID = ?");
        $stmt->execute([$faq_ID]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>