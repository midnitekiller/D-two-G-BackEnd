<?php
/**
 *\\================ Developer ==================\\
 * \\ Ranz Daren Castillano \\ Joe John Ferrolino \\
 *  \\=============================================\\
 */
class Chats extends Database{
    	
	function sendMessageFromSuperadmin($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$status = "unseen";
		
		$dbconn = $this->dbConn();
		if(isset($guest_id)){
			if($guest_id != "su"){
				$from = "admin";
				$to = "guest";
				$query = "INSERT INTO chats (hotel_ID, guest_ID, msg, msg_from, msg_to, status, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid),(SELECT guest_ID FROM guests WHERE guest_ID = :guestid),:message, :from, :to, :status,:createdat)";
				$stmt = $dbconn->prepare($query);
				$stmt->bindParam(':hotelid', $hotel_id);
				$stmt->bindParam(':guestid', $guest_id);
				$stmt->bindParam(':message', $msg);
				$stmt->bindParam(':from', $from);
				$stmt->bindParam(':to', $to);
				$stmt->bindParam(':status', $status);
				$stmt->bindParam(':createdat', $created);
			}else{
				$from = "admin";
				$to = "superadmin";
				$query = "INSERT INTO chats (hotel_ID, msg, msg_from, msg_to, status, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid),:message, :from, :to, :status,:createdat)";
				$stmt = $dbconn->prepare($query);
				$stmt->bindParam(':hotelid', $hotel_id);
				$stmt->bindParam(':message', $msg);
				$stmt->bindParam(':from', $from);
				$stmt->bindParam(':to', $to);
				$stmt->bindParam(':status', $status);
				$stmt->bindParam(':createdat', $created);
			}
		}else{
			$from = "superadmin";
			$to = "admin";
			$query = "INSERT INTO chats (hotel_ID, msg, msg_from, msg_to, status, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid),:message, :from, :to, :status,:createdat)";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':hotelid', $hotel_id);
			$stmt->bindParam(':message', $msg);
			$stmt->bindParam(':from', $from);
			$stmt->bindParam(':to', $to);
			$stmt->bindParam(':status', $status);
			$stmt->bindParam(':createdat', $created);
		}
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function getMessages($data){
		extract($data);
		
		$dbconn = $this->dbConn();
		if(isset($guestid)){
			if($guestid == "su"){
				$query = "SELECT * FROM chats WHERE hotel_ID = :id AND ((msg_from = :from AND msg_to = :to) OR (msg_from = :from1 AND msg_to = :to1)) ORDER BY created_at ASC";
				$id = $hotelid;
			}else{
				$query = "SELECT * FROM chats WHERE guest_ID = :id AND ((msg_from = :from AND msg_to = :to) OR (msg_from = :from1 AND msg_to = :to1)) ORDER BY created_at ASC";
				$id = $guestid;
			}
		}else{
			$query = "SELECT * FROM chats WHERE hotel_ID = :id AND ((msg_from = :from AND msg_to = :to) OR (msg_from = :from1 AND msg_to = :to1)) ORDER BY created_at ASC";
			$id = $hotelid;
		}
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':from', $msgfrom);
		$stmt->bindParam(':to', $msgto);
		$stmt->bindParam(':from1', $msgto);
		$stmt->bindParam(':to1', $msgfrom);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	//superadmin
	function getUnseenCount($hotelid, $to){
		$dbconn = $this->dbConn();
		$status = "unseen";
		$query = "SELECT COUNT(status) FROM chats WHERE hotel_ID = :id AND msg_to = :to AND status = :stat";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$hotelid);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':stat', $status);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	//admin side (guest to admin)
	function getUnseenCountGuest($hotelid, $guestid, $to){
		$dbconn = $this->dbConn();
		$status = "unseen";
		$query = "SELECT COUNT(status) FROM chats WHERE hotel_ID = :id AND guest_ID = :guestid AND msg_to = :to AND status = :stat";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$hotelid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':stat', $status);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	//admin side(count superadmin chats)
	function getUnseenCountSuperadmin($hotelid, $from){
		$dbconn = $this->dbConn();
		$status = "unseen";
		$query = "SELECT COUNT(status) FROM chats WHERE hotel_ID = :id AND msg_from = :to AND status = :stat";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$hotelid);
		$stmt->bindParam(':to',$from);
		$stmt->bindParam(':stat', $status);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getLUMessages($data){
		extract($data);
		$stat = "unseen";
		$dbconn = $this->dbConn();
		if(isset($guestid)){
			if($guestid == "su"){
				$query = "SELECT * FROM chats WHERE hotel_ID = :hotelid AND (msg_from = :msgfrom AND msg_to = :msgto) AND status = :stat ORDER BY created_at DESC LIMIT :num";
				$stmt = $dbconn->prepare($query);
				$stmt->bindParam(':hotelid', $hotelid);
				$stmt->bindParam(':msgfrom', $msgfrom);
				$stmt->bindParam(':msgto', $msgto);
				$stmt->bindParam(':stat', $stat);
				$stmt->bindParam(':num', $ucount, PDO::PARAM_INT);
			}else{
				$query = "SELECT * FROM chats WHERE hotel_ID = :hotelid AND guest_ID = :guestid AND (msg_from = :msgfrom AND msg_to = :msgto) AND status = :stat ORDER BY created_at DESC LIMIT :num";
				$stmt = $dbconn->prepare($query);
				$stmt->bindParam(':hotelid', $hotelid);
				$stmt->bindParam(':guestid', $guestid);
				$stmt->bindParam(':msgfrom', $msgfrom);
				$stmt->bindParam(':msgto', $msgto);
				$stmt->bindParam(':stat', $stat);
				$stmt->bindParam(':num', $ucount, PDO::PARAM_INT);
			}
		}else{
			$query = "SELECT * FROM chats WHERE hotel_ID = :hotelid AND (msg_from = :msgfrom AND msg_to = :msgto) AND status = :stat ORDER BY created_at DESC LIMIT :num";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':hotelid', $hotelid);
			$stmt->bindParam(':msgfrom', $msgfrom);
			$stmt->bindParam(':msgto', $msgto);
			$stmt->bindParam(':stat', $stat);
			$stmt->bindParam(':num', $ucount, PDO::PARAM_INT);
		}
		
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	
	function changeStatus($data){
		extract($data);
		$status = "seen";
		$dbconn = $this->dbConn();
		if(isset($guestid)){
			if($guestid == "su"){
				$query = "UPDATE chats SET status = :status WHERE hotel_ID = :id AND msg_from = :from AND msg_to = :to";
				$id = $hotelid;
			}else{
				$query = "UPDATE chats SET status = :status WHERE guest_ID = :id AND msg_from = :from AND msg_to = :to";
				$id = $guestid;
			}
		}else{
			$query = "UPDATE chats SET status = :status WHERE hotel_ID = :id AND msg_from = :from AND msg_to = :to";
			$id = $hotelid;
		}
		
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':id', $id);
		$stmt->bindParam(':from', $msgfrom);
		$stmt->bindParam(':to', $msgto);
		
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function getLastMN($hotelid, $to){
		$dbconn = $this->dbConn();
		$status = "unseen";
		$query = "SELECT msg FROM chats WHERE hotel_ID = :id AND msg_to = :to AND status = :stat ORDER BY created_at DESC LIMIT 1";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$hotelid);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':stat', $status);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getHotelIDsbyMessage($from, $to){
		$dbconn = $this->dbConn();
		$status = "unseen";
		$query = "SELECT hotels.hotel_ID, hotels.hotel_name, hotels.hotel_image, chats.msg, chats.msg_from, chats.msg_to, chats.status, chats.created_at FROM hotels, chats WHERE hotels.hotel_ID = chats.hotel_ID AND msg_to = :to AND status = :stat AND chats.chats_ID IN (SELECT MAX(chats_ID) FROM chats WHERE msg_to = :to1 AND status = :stat1 GROUP BY hotel_ID) GROUP BY hotel_ID ORDER BY hotel_ID DESC";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':stat', $status);
		$stmt->bindParam(':to1',$to);
		$stmt->bindParam(':stat1',$status);
		$stmt->execute();
		$result = $stmt->fetchAll();
		$query2 = "SELECT COUNT(status) FROM chats WHERE msg_to = :to AND status = :stat GROUP BY hotel_ID ORDER BY hotel_ID DESC";
		$stmt = $dbconn->prepare($query2);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':stat',$status);
		$stmt->execute();
		$count = $stmt->fetchAll();
		foreach($result as $key => $re){
			$result[$key]['created_at'] = date('F d, Y', strtotime($re['created_at']));
			$result[$key]['max_count'] = $count[$key][0];
			$result[$key]['timestamp'] = strtotime($re['created_at']);
		}
		$result = $this->array_sort($result, 'timestamp', SORT_DESC);
		return $result;
	}
	
	function getCountUnseenMessages($from, $to){
		$dbconn = $this->dbConn();
		$status = "unseen";
		$query = "SELECT status FROM chats WHERE msg_from = :from AND msg_to = :to AND status = :status";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':from',$from);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':status',$status);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function getGuestsbyMessage($hotelid){
		$dbconn = $this->dbConn();
		$status = "unseen";
		$from = "superadmin";
		$from1 = "guest";
		$to = "admin";
		$messages = [];
		$query = "SELECT guests.guest_ID, guests.firstname, guests.room_no, chats.guest_ID, chats.msg, chats.msg_from, chats.msg_to, chats.status, chats.created_at FROM guests, chats WHERE guests.guest_ID = chats.guest_ID AND chats.msg_to = :to AND msg_from = :from AND chats.status = :status AND chats.hotel_ID = :hotelid AND chats.chats_ID IN (SELECT MAX(chats_ID) FROM chats WHERE msg_to = :to1 AND msg_from = :from1 AND status = :status1 AND hotel_ID = :hotelid2 GROUP BY guest_ID ORDER BY guest_ID ASC) GROUP BY guests.guest_ID ORDER BY guests.guest_ID ASC";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':from',$from1);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':to1',$to);
		$stmt->bindParam(':from1',$from1);
		$stmt->bindParam(':status1',$status);
		$stmt->bindParam(':hotelid2',$hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll();
		
		
		$query2 = "SELECT COUNT(status) FROM chats WHERE msg_to = :to AND msg_from = :from AND status = :status AND hotel_ID = :hotelid GROUP BY guest_ID ORDER BY guest_ID ASC";
		$stmt = $dbconn->prepare($query2);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':from',$from1);
		$stmt->bindParam(':status',$status);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$count = $stmt->fetchAll();
		foreach($result as $key => $re){
			$messages[$key]['created_at'] = date('F d, Y', strtotime($re['created_at']));
			$messages[$key]['max_count'] = $count[$key][0];
			$messages[$key]['timestamp'] = strtotime($re['created_at']);
			$messages[$key]['name'] = $re['firstname']." (RM ".$re['room_no'].")";
			$messages[$key]['id'] = $re['guest_ID'];
			$messages[$key]['msg'] = $re['msg'];
		}
		
		$query3 = "SELECT * FROM chats WHERE hotel_ID = :hotelid AND (msg_from = :from AND msg_to = :to) AND status = :status AND chats_ID IN (SELECT MAX(chats_ID) FROM chats WHERE msg_to = :to1 AND msg_from = :from1 AND status = :status1 AND hotel_ID = :hotelid1 GROUP BY msg_from ORDER BY created_at DESC) GROUP BY msg_from ORDER BY created_at DESC";
		$stmt2 = $dbconn->prepare($query3);
		$stmt2->bindParam(':hotelid',$hotelid);
		$stmt2->bindParam(':from',$from);
		$stmt2->bindParam(':to',$to);
		$stmt2->bindParam(':status',$status);
		$stmt2->bindParam(':to1', $to);
		$stmt2->bindParam(':from1',$from);
		$stmt2->bindParam(':status1',$status);
		$stmt2->bindParam(':hotelid1',$hotelid);
		$stmt2->execute();
		$result2 = $stmt2->fetchAll();
		
		$query4 = "SELECT COUNT(status) FROM chats WHERE msg_to = :to AND msg_from = :from AND status = :status AND hotel_ID = :hotelid GROUP BY msg_from ORDER BY msg_from DESC";
		$stmt = $dbconn->prepare($query4);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':from',$from);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$count2 = $stmt->fetchColumn();
		if($stmt2->rowCount() > 0){
			$total = count($messages);
			$messages[$total]['id'] = "su";
			$messages[$total]['name'] ="Superadmin";
			$messages[$total]['max_count'] = $count2;
			$messages[$total]['created_at'] = date('F d, Y', strtotime($result2[0]['created_at']));
			$messages[$total]['timestamp'] = strtotime($result2[0]['created_at']);
			$messages[$total]['msg'] = $result2[0]['msg'];
		}
		$messages = $this->array_sort($messages, 'timestamp', SORT_DESC);
		return $messages;
	}
	
	function getCountUnseenGuests($hotelid){
		$dbconn = $this->dbConn();
		$status = "unseen";
		$to = "admin";
		$query = "SELECT status FROM chats WHERE msg_to = :to AND hotel_ID = :hotelid AND status = :status";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':status',$status);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function array_sort($array, $on, $order=SORT_ASC){
		$new_array = array();
		$sortable_array = array();
		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $on) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}
			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
				break;
				case SORT_DESC:
					arsort($sortable_array);
				break;
			}
			foreach ($sortable_array as $k => $v) {
				$new_array[$k] = $array[$k];
			}
		}
		return $new_array;
	}
}	
?>