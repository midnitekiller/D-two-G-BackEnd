<?php
/**
 * Developed By: Ranz Daren Castillano
 */
class API extends Database{
    	
	function getHotelID($deviceid){
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_ID,room_no,status FROM device WHERE mac_address = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id', $deviceid);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function getHotelInfo($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM hotels WHERE hotel_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$hotelid);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$result['full_image'] = "/media/images/".preg_replace("/[^a-zA-z]+/", "", $result['hotel_name'])."/logo/".$result['hotel_image'];
		return $result;
	}
	
	function getGuestInfoByRoomNo($roomno, $hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM guests WHERE room_no = :roomno AND hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':roomno',$roomno);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function getRestaurants($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT restaurants.*, hotels.hotel_name FROM restaurants, hotels WHERE restaurants.hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :id) AND restaurants.hotel_ID = hotels.hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $res){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-Z]+/", "", $res['hotel_name'])."/restaurant/".preg_replace("/[^a-zA-Z]+/", "", $res['restaurant_name'])."/".$res['image'];
		}
		return $result;
	}
	
	function getHotelAccess($hotelid){
		$dbconn = $this->dbConn();
		$adminstatus = "active";
		$adstat = "off";
		$query = "SELECT access_name FROM hotel_access WHERE hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :id) AND (admin_status = :adminstatus OR admin_status = :adstat) AND status = :stat";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$hotelid);
		$stmt->bindParam(':adminstatus',$adminstatus);
		$stmt->bindParam(':adstat',$adstat);
		$stmt->bindParam(':stat',$adminstatus);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function getHotelStatus($hotelid){
		
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_status FROM hotels WHERE hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->execute();
		$result = $stmt->fetch();
	}
	
	function getAdsRestaurant($hotelid){
		$adtypeid = "3";
		$dbconn = $this->dbConn();
		$query = "SELECT places_detail.*,places_nearby_companies.company_name FROM places_detail, places_nearby_companies WHERE places_detail.company_ID = places_nearby_companies.company_ID AND hotel_ID = :hotelid AND adtype_ID = :adtypeid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':adtypeid',$adtypeid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $res){
			$result[$i]['img_path'] = preg_replace("/[^a-zA-z]+/", "", $res['company_name'])."/".preg_replace("/[^a-zA-z]+/", "", $res['ad_title'])."/";
		}
		return $result;
	}
	
	function getAdsNightLife($hotelid){
		$adtypeid = "2";
		$dbconn = $this->dbConn();
		$query = "SELECT places_detail.*,places_nearby_companies.company_name FROM places_detail, places_nearby_companies WHERE places_detail.company_ID = places_nearby_companies.company_ID AND hotel_ID = :hotelid AND adtype_ID = :adtypeid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':adtypeid',$adtypeid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $res){
			$result[$i]['img_path'] = preg_replace("/[^a-zA-z]+/", "", $res['company_name'])."/".preg_replace("/[^a-zA-z]+/", "", $res['ad_title'])."/";
		}
		return $result;
	}
	
	function getAdsActivities($hotelid){
		$adtypeid = "1";
		$dbconn = $this->dbConn();
		$query = "SELECT places_detail.*,places_nearby_companies.company_name FROM places_detail, places_nearby_companies WHERE places_detail.company_ID = places_nearby_companies.company_ID AND hotel_ID = :hotelid AND adtype_ID = :adtypeid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':adtypeid',$adtypeid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $res){
			$result[$i]['img_path'] = preg_replace("/[^a-zA-z]+/", "", $res['company_name'])."/".preg_replace("/[^a-zA-z]+/", "", $res['ad_title'])."/";
		}
		return $result;
	}
/*				start MenuList API				*/
	function getRestaurantMenuList($restaurantid, $hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT restaurant_menus.*, hotels.hotel_name FROM restaurant_menus, hotels WHERE restaurant_menus.restaurant_ID = (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :restaurantid AND hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid)) AND restaurant_menus.hotel_ID = hotels.hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':restaurantid', $restaurantid);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-z]+/", "", $r['hotel_name'])."/restaurant/".$r['menu_image'];
		}
		return $result;
	}
	
	function getRestaurantCartList($guestid, $restaurantid){
		$dbconn = $this->dbConn();
		$query = "SELECT restaurant_cart.*,restaurant_menus.restaurant_ID, restaurant_menus.menu_image, hotels.hotel_name FROM restaurant_cart,restaurant_menus, hotels WHERE restaurant_menus.restomenu_ID = restaurant_cart.restomenu_ID AND restaurant_menus.restaurant_ID = :restaurantid AND restaurant_cart.guest_ID = :guestid AND restaurant_cart.hotel_ID = hotels.hotel_ID ORDER BY created_at DESC";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':restaurantid',$restaurantid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-z]+/", "", $r['hotel_name'])."/restaurant/".$r['menu_image'];
		}
		return $result;
	}
	
	function addRestaurantCart($menuid, $guestid, $hotelid, $restaurantid, $qty){
		$dbconn = $this-> dbConn();
		$created = date('Y-m-d H:i:s');
		
		$query = "SELECT restaurant_menus.*,restaurants.hotel_ID FROM restaurant_menus, restaurants WHERE restaurant_menus.restaurant_ID = restaurants.restaurant_ID AND restomenu_ID = :menuid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->execute();
		$menu = $stmt->fetch(PDO::FETCH_ASSOC);
		$menu['subtotal'] = $menu['menu_price'] * $qty;
		$query = "SELECT 1 FROM restaurant_cart WHERE restomenu_ID = :menuid and guest_ID = (SELECT guest_ID FROM guests WHERE guest_ID = :guestid) AND restaurant_id = (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :restaurantid)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':restaurantid', $restaurantid);
		$stmt->execute();
		$status = $stmt->fetch();
		if($status){
			$query = "UPDATE restaurant_cart SET quantity = quantity+:quantity, subtotal = subtotal + (menu_price * :qty) WHERE restomenu_ID = :menuid AND guest_ID = :guestid AND restaurant_ID = :restaurantid";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':quantity', $qty);
			$stmt->bindParam(':qty', $qty);
			$stmt->bindParam(':menuid', $menuid);
			$stmt->bindParam(':guestid', $guestid);
			$stmt->bindParam(':restaurantid', $restaurantid);
			if($stmt->execute()){
				$report = true;
			}else{
				$report = false;
			}
		}else{
			$query = "INSERT INTO restaurant_cart (restomenu_ID, restaurant_ID, hotel_ID, guest_ID, menu_name, menu_shortDesc, menu_price, quantity, subtotal, created_at) VALUES ((SELECT restomenu_ID FROM restaurant_menus WHERE restomenu_ID = :menuid), (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :restaurantid),(SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid),(SELECT guest_ID FROM guests WHERE guest_ID = :guestid),:menuname,:shortdesc,:price,:qty,:subtotal,:created)";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':menuid',$menuid);
			$stmt->bindParam(':restaurantid',$restaurantid);
			$stmt->bindParam(':hotelid',$menu['hotel_ID']);
			$stmt->bindParam(':guestid',$guestid);
			$stmt->bindParam(':menuname',$menu['menu_name']);
			$stmt->bindParam(':shortdesc',$menu['menu_shortDesc']);
			$stmt->bindParam(':price',$menu['menu_price']);
			$stmt->bindParam(':qty',$qty);
			$stmt->bindParam(':subtotal',$menu['subtotal']);
			$stmt->bindParam(':created',$created);
			if($stmt->execute()){
				$report = true;
			}else{
				$report = false;
			}
		}
		return $report;
	}
	
	function deductRestaurantCart($menuid, $qty, $guestid, $restaurantid){
		$dbconn = $this-> dbConn();
		$created = date('Y-m-d H:i:s');
		
		$query = "SELECT restaurant_menus.*,restaurants.hotel_ID FROM restaurant_menus, restaurants WHERE restaurant_menus.restaurant_ID = restaurants.restaurant_ID AND restomenu_ID = :menuid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->execute();
		$menu = $stmt->fetch(PDO::FETCH_ASSOC);
		$menu['subtotal'] = $menu['menu_price'] * $qty;
		$query = "SELECT quantity FROM restaurant_cart WHERE restomenu_ID = :menuid AND guest_ID = (SELECT guest_ID FROM guests WHERE guest_ID = :guestid) AND restaurant_ID = (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :restaurantid)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':restaurantid',$restaurantid);
		$stmt->execute();
		$status = $stmt->fetchColumn();
		if($status > 1){
			$query = "UPDATE restaurant_cart SET quantity = quantity-:quantity, subtotal = subtotal - (menu_price * :qty) WHERE restomenu_ID = :menuid AND guest_ID = :guestid AND restaurant_ID = :restaurantid";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':quantity', $qty);
			$stmt->bindParam(':qty', $qty);
			$stmt->bindParam(':menuid', $menuid);
			$stmt->bindParam(':guestid', $guestid);
			$stmt->bindParam(':restaurantid',$restaurantid);
			if($stmt->execute()){
				$report = true;
			}else{
				$report = false;
			}
		}else{
			$report = false;
		}
		return $report;
	}
	
	function deleteRestaurantCart($menuid,$guestid, $restaurantid, $hotelid){
		$dbconn = $this->dbConn();
		$query = "DELETE FROM restaurant_cart WHERE restomenu_ID = :menuid AND guest_ID = :guestid AND restaurant_ID = :restaurantid AND hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':restaurantid',$restaurantid);
		$stmt->bindParam(':hotelid', $hotelid);
		$report = $stmt->execute();
		return $report;
	}

	function checkoutMenuCart($guestid, $restaurantid, $grandtotal, $hotelid){
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO restaurant_order (hotel_ID, guest_ID, grand_total, confirm_status, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), (SELECT guest_ID FROM guests WHERE guest_ID = :guestid), :grandtotal, 'inactive', :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':grandtotal',$grandtotal);
		$stmt->bindParam(':created',$created);
		if($stmt->execute()){
			$orderid = $dbconn->lastInsertId();
			$query = "SELECT * FROM restaurant_cart WHERE guest_ID = :guestid AND restaurant_ID = :restaurantid AND hotel_ID = :hotelid";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':guestid',$guestid);
			$stmt->bindParam(':restaurantid',$restaurantid);
			$stmt->bindParam(':hotelid',$hotelid);
			$stmt->execute();
			$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($menus as $i => $m){
				$created2 = date('Y-m-d H:i:s');
				$query = "INSERT INTO restaurant_order_detail (restoorder_ID, restomenu_ID, menu_name, menu_shortDesc, menu_price, quantity, subtotal, created_at) VALUES ((SELECT restoorder_ID FROM restaurant_order WHERE restoorder_ID = :orderid), (SELECT restomenu_ID FROM restaurant_menus WHERE restomenu_ID = :menuid),:menuname,:menushortdesc,:price,:quantity,:subtotal,:created)";
				$stmt = $dbconn->prepare($query);
				$stmt->bindParam(':orderid', $orderid);
				$stmt->bindParam(':menuid', $m['restomenu_ID']);
				$stmt->bindParam(':menuname', $m['menu_name']);
				$stmt->bindParam(':menushortdesc', $m['menu_shortDesc']);
				$stmt->bindParam(':price', $m['menu_price']);
				$stmt->bindParam(':quantity', $m['quantity']);
				$stmt->bindParam(':subtotal', $m['subtotal']);
				$stmt->bindParam(':created', $created2);
				$stmt->execute();
			}
			$query = "DELETE FROM restaurant_cart WHERE guest_ID = :guestid AND restaurant_ID = :restaurantid AND hotel_ID = :hotelid";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':guestid', $guestid);
			$stmt->bindParam(':restaurantid', $restaurantid);
			$stmt->bindParam(':hotelid', $hotelid);
			if($stmt->execute()){
				$report = true;
			}else{
				$report = false;
			}
		}else{
			$report = false;
		}
		return $report;
	}
/*				end MenuList API				*/
	
/*				start ChatActivity API				*/
	function getChatMessages($hotelid, $guestid){
		$dbconn = $this->dbConn();
		$from = "admin";
		$to = "guest";
		$query = "SELECT chats_ID, hotel_ID, guest_ID, msg, msg_from, msg_to, status, created_at FROM chats WHERE hotel_ID = :hotelid AND guest_ID = :guestid AND ((msg_from = :from AND msg_to = :to) OR (msg_from = :from1 AND msg_to = :to1)) ORDER BY created_at ASC";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':from',$from);
		$stmt->bindParam(':to',$to);
		$stmt->bindParam(':from1',$to);
		$stmt->bindParam(':to1',$from);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function sendChatMessage($data){
		$dbconn = $this->dbConn();
		$created = date('Y-m-d H:i:s');
		$from = "guest";
		$to = "admin";
		$status = "unseen";
		$query = "INSERT INTO chats (hotel_ID, guest_ID, msg, msg_from, msg_to, status, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), (SELECT guest_ID FROM guests WHERE guest_ID = :guestid), :msg, :from, :to, :status, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $data->hotel_id);
		$stmt->bindParam(':guestid', $data->guest_id);
		$stmt->bindParam(':msg', $data->msg);
		$stmt->bindParam(':from', $from);
		$stmt->bindParam(':to', $to);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			$report = true;
		}else{
			$report = false;
		}
		return $report;
	}
	
	function updateChatStatus($hotelid, $guestid){
		$status = "seen";
		$from = "admin";
		$to = "guest";
		$dbconn = $this->dbConn();
		$query = "UPDATE chats SET status = :status WHERE hotel_ID = :id AND guest_ID = :guestid AND msg_from = :from AND msg_to = :to";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':id', $hotelid);
		$stmt->bindParam(':guestid', $guestid);
		$stmt->bindParam(':from', $from);
		$stmt->bindParam(':to', $to);
		if($stmt->execute()){
			$report = true;
		}else{
			$report = false;
		}
		return $report;
	}
/*				end ChatActivity API				*/
	
/*				start Feedback API					*/
	function sendFeedbackRating($message, $hotelid, $guestid, $overall, $location, $room, $service, $value, $cleanliness, $restaurant){
		$overall = $this->changeRating($overall);
		$location = $this->changeRating($location);
		$room = $this->changeRating($room);
		$service = $this->changeRating($service);
		$value = $this->changeRating($value);
		$cleanliness = $this->changeRating($cleanliness);
		$restaurant = $this->changeRating($restaurant);
		$dbconn = $this->dbConn();
		$created = date('Y-m-d H:i:s');
		$query = "INSERT INTO feedbacks (hotel_ID, guest_ID, feedback_overall, feedback_location, feedback_room, feedback_service, feedback_value, feedback_cleanliness, feedback_restaurant, feedback_message, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), (SELECT guest_ID FROM guests WHERE guest_ID = :guestid), :overall, :location, :room, :service, :value, :cleanliness, :restaurant, :message, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':guestid', $guestid);
		$stmt->bindParam(':overall', $overall);
		$stmt->bindParam(':location', $location);
		$stmt->bindParam(':room', $room);
		$stmt->bindParam(':service',$service);
		$stmt->bindParam(':value',$value);
		$stmt->bindParam(':cleanliness', $cleanliness);
		$stmt->bindParam(':restaurant', $restaurant);
		$stmt->bindParam(':message', $message);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			$report = true;
		}else{
			$report = false;
		}
		return $report;
	}
	
	function changeRating($number){
		if($number == "1"){
			$number = "Extremely Unsatisfied";
		}elseif($number == "2"){
			$number = "Unsatisfied";
		}elseif($number == "3"){
			$number = "Neutral";
		}elseif($number == "4"){
			$number = "Satisfied";
		}elseif($number == "5"){
			$number = "Extremely Satisfied";
		}
		return $number;
	}
/*				end Feedback API				*/

/*				start Housekeeping API			*/
	function getHousekeepingStatus($hotelid, $guestid){
		$dbconn = $this->dbConn();
		$query = "SELECT hk_status FROM housekeepings WHERE hotel_ID = :hotelid AND guest_ID = :guestid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->execute();
		$status = $stmt->fetchColumn();
		if($status == false){
			
			$created = date('Y-m-d H:i:s');
			$stat = 0;
			$status = "Requested Housekeeping";
			$query2 = "INSERT INTO housekeepings (hotel_ID, guest_ID, room_no, hk_date, hk_status, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), (SELECT guest_ID FROM guests WHERE guest_ID = :guestid), (SELECT room_no FROM guests WHERE guest_ID = :guestid2), :hkdate, :hkstatus, :created)";
			$stmt = $dbconn->prepare($query2);
			$stmt->bindParam(':hotelid',$hotelid);
			$stmt->bindParam(':guestid',$guestid);
			$stmt->bindParam(':guestid2',$guestid);
			$stmt->bindParam(':hkdate',$created);
			$stmt->bindParam(':hkstatus', $status);
			$stmt->bindParam(':created', $created);
			if($stmt->execute()){
				return $status;
			}
		}
		return $status;
	}
	
	function requestHousekeeping($hotelid, $guestid){
		$dbconn = $this->dbConn();
		$status = "Requested Housekeeping";
		$seen = "false";
		$query = "UPDATE housekeepings SET hk_status = :status, notif_seen = :seen WHERE hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid) AND guest_ID = (SELECT guest_ID FROM guests WHERE guest_ID = :guestid)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':guestid', $guestid);
		$stmt->bindParam(':seen', $seen);
		if($stmt->execute()){
			$report = true;
		}else{
			$report = false;
		}
		return $report;
	}
	
	function cancelTodayHousekeeping($hotelid, $guestid){
		$dbconn = $this->dbConn();
		$status = "Cancel Housekeeping Today";
		$seen = "false";
		$query = "UPDATE housekeepings SET hk_status = :status, notif_seen = :seen WHERE hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid) AND guest_ID = (SELECT guest_ID FROM guests WHERE guest_ID = :guestid)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':guestid', $guestid);
		$stmt->bindParam(':seen', $seen);
		if($stmt->execute()){
			$report = true;
		}else{
			$report = false;
		}
		return $report;
	}
	
	function cancelWholeHousekeeping($hotelid, $guestid){
		$dbconn = $this->dbConn();
		$status = "Cancel Housekeeping Whole Stay";
		$seen = "false";
		$query = "UPDATE housekeepings SET hk_status = :status, notif_seen = :seen WHERE hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid) AND guest_ID = (SELECT guest_ID FROM guests WHERE guest_ID = :guestid)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':status', $status);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->bindParam(':guestid', $guestid);
		$stmt->bindParam(':seen', $seen);
		if($stmt->execute()){
			$report = true;
		}else{
			$report = false;
		}
		return $report;
	}
/*				end Housekeeping API			*/

/*				start Services API				*/
	function getServicesType($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT services.*, hotels.hotel_name FROM services, hotels WHERE services.hotel_ID = :hotelid AND hotels.hotel_ID = services.hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-z]+/", "", $r['hotel_name'])."/services/".preg_replace("/[^a-zA-z]+/", "", $r['serviceName'])."/".$r['image'];
		}
		return $result;
	}
	
	function getServicesMenuList($serviceid, $hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT services_product.*, hotels.hotel_name FROM services_product, hotels WHERE services_product.service_ID = :serviceid AND services_product.hotel_ID = :hotelid AND services_product.hotel_ID = hotels.hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':serviceid', $serviceid);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-z]+/", "", $r['hotel_name'])."/services/".$r['image'];
		}
		return $result;
	}
	
	function addServicesCart($menuid, $guestid, $hotelid, $serviceid){
		$dbconn = $this-> dbConn();
		$created = date('Y-m-d H:i:s');
		$qty = 1;
		$query = "SELECT * FROM services_product WHERE serviceProd_ID = :menuid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->execute();
		$menu = $stmt->fetch(PDO::FETCH_ASSOC);
		$menu['subtotal'] = $menu['serviceProdPrice'];
		$query = "SELECT 1 FROM services_cart WHERE serviceProd_ID = :menuid and guest_ID = (SELECT guest_ID FROM guests WHERE guest_ID = :guestid) AND service_ID = (SELECT service_ID FROM services WHERE service_ID = :serviceid)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':serviceid', $serviceid);
		$stmt->execute();
		$status = $stmt->fetch();
		if($status){
			$query = "UPDATE services_cart SET quantity = quantity+:quantity, subtotal = subtotal + (serviceProdPrice * :qty) WHERE serviceProd_ID = :menuid AND guest_ID = :guestid AND service_ID = :serviceid";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':quantity', $qty);
			$stmt->bindParam(':qty', $qty);
			$stmt->bindParam(':menuid', $menuid);
			$stmt->bindParam(':guestid', $guestid);
			$stmt->bindParam(':serviceid', $serviceid);
			if($stmt->execute()){
				$report = true;
			}else{
				$report = false;
			}
		}else{
			$query = "INSERT INTO services_cart (serviceProd_ID, service_ID, hotel_ID, guest_ID, serviceProdName, serviceProdDesc, serviceProdPrice, serviceProdDuration, quantity, subtotal, created_at) VALUES ((SELECT serviceProd_ID FROM services_product WHERE serviceProd_ID = :menuid), (SELECT service_ID FROM services WHERE service_ID = :serviceid),(SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid),(SELECT guest_ID FROM guests WHERE guest_ID = :guestid),:menuname,:shortdesc,:price,:duration,:qty,:subtotal,:created)";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':menuid',$menuid);
			$stmt->bindParam(':serviceid',$serviceid);
			$stmt->bindParam(':hotelid',$menu['hotel_ID']);
			$stmt->bindParam(':guestid',$guestid);
			$stmt->bindParam(':menuname',$menu['serviceProdName']);
			$stmt->bindParam(':shortdesc',$menu['serviceProdDesc']);
			$stmt->bindParam(':price',$menu['serviceProdPrice']);
			$stmt->bindParam(':duration',$menu['duration']);
			$stmt->bindParam(':qty',$qty);
			$stmt->bindParam(':subtotal',$menu['subtotal']);
			$stmt->bindParam(':created',$created);
			if($stmt->execute()){
				$report = true;
			}else{
				$report = false;
			}
		}
		return $report;
	}
	
	function getServicesCartList($guestid, $serviceid){
		$dbconn = $this->dbConn();
		$query = "SELECT services_cart.*,services_product.service_ID, services_product.image, hotels.hotel_name FROM services_cart,services_product, hotels WHERE services_product.serviceProd_ID = services_cart.serviceProd_ID AND services_product.service_ID = :serviceid AND services_cart.guest_ID = :guestid AND services_cart.hotel_ID = hotels.hotel_ID ORDER BY created_at DESC";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':serviceid',$serviceid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-z]+/", "", $r['hotel_name'])."/services/".$r['image'];
		}
		return $result;
	}
	
	function deductServiceCart($menuid, $qty, $guestid, $serviceid){
		$dbconn = $this-> dbConn();
		$created = date('Y-m-d H:i:s');
		
		$query = "SELECT services_product.*,services.hotel_ID FROM services_product, services WHERE services_product.service_ID = services.service_ID AND serviceProd_ID = :menuid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->execute();
		$menu = $stmt->fetch(PDO::FETCH_ASSOC);
		$menu['subtotal'] = $menu['serviceProdPrice'] * $qty;
		$query = "SELECT quantity FROM services_cart WHERE serviceProd_ID = :menuid AND guest_ID = :guestid AND service_ID = :serviceid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':serviceid',$serviceid);
		$stmt->execute();
		$status = $stmt->fetchColumn();
		if($status > 1){
			$query = "UPDATE services_cart SET quantity = quantity-:quantity, subtotal = subtotal - (serviceProdPrice * :qty) WHERE serviceProd_ID = :menuid AND guest_ID = :guestid AND service_ID = :serviceid";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':quantity', $qty);
			$stmt->bindParam(':qty', $qty);
			$stmt->bindParam(':menuid', $menuid);
			$stmt->bindParam(':guestid', $guestid);
			$stmt->bindParam(':serviceid',$serviceid);
			if($stmt->execute()){
				$report = true;
			}else{
				$report = false;
			}
		}else{
			$report = false;
		}
		return $report;
	}
	
	function deleteServiceCart($menuid, $guestid, $serviceid, $hotelid){
		$dbconn = $this->dbConn();
		$query = "DELETE FROM services_cart WHERE serviceProd_ID = :menuid AND guest_ID = :guestid AND service_ID = :serviceid AND hotel_ID = :hotelid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':menuid',$menuid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':serviceid',$serviceid);
		$stmt->bindParam(':hotelid', $hotelid);
		$report = $stmt->execute();
		return $report;
	}
	
	function checkoutServicesCart($guestid, $serviceid, $grandtotal, $hotelid){
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO services_order (hotel_ID, guest_ID, grand_total, confirm_status, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), (SELECT guest_ID FROM guests WHERE guest_ID = :guestid), :grandtotal, 'inactive', :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->bindParam(':guestid',$guestid);
		$stmt->bindParam(':grandtotal',$grandtotal);
		$stmt->bindParam(':created',$created);
		if($stmt->execute()){
			$orderid = $dbconn->lastInsertId();
			$query = "SELECT * FROM services_cart WHERE guest_ID = :guestid AND service_ID = :serviceid AND hotel_ID = :hotelid";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':guestid',$guestid);
			$stmt->bindParam(':serviceid',$serviceid);
			$stmt->bindParam(':hotelid',$hotelid);
			$stmt->execute();
			$menus = $stmt->fetchAll(PDO::FETCH_ASSOC);
			foreach($menus as $i => $m){
				$created2 = date('Y-m-d H:i:s');
				$query = "INSERT INTO services_order_detail (serviceOrder_ID, serviceProd_ID, service_name, serviceProdDesc, serviceProdPrice, serviceProdDuration, quantity, subtotal, created_at) VALUES ((SELECT serviceOrder_ID FROM services_order WHERE serviceOrder_ID = :orderid), (SELECT serviceProd_ID FROM services_product WHERE serviceProd_ID = :menuid),:menuname,:menushortdesc,:price,:duration,:quantity,:subtotal,:created)";
				$stmt = $dbconn->prepare($query);
				$stmt->bindParam(':orderid', $orderid);
				$stmt->bindParam(':menuid', $m['serviceProd_ID']);
				$stmt->bindParam(':menuname', $m['serviceProdName']);
				$stmt->bindParam(':menushortdesc', $m['serviceProdDesc']);
				$stmt->bindParam(':price', $m['serviceProdPrice']);
				$stmt->bindParam(':duration', $m['serviceProdDuration']);
				$stmt->bindParam(':quantity', $m['quantity']);
				$stmt->bindParam(':subtotal', $m['subtotal']);
				$stmt->bindParam(':created', $created2);
				$stmt->execute();
			}
			$query = "DELETE FROM services_cart WHERE guest_ID = :guestid AND service_ID = :serviceid AND hotel_ID = :hotelid";
			$stmt = $dbconn->prepare($query);
			$stmt->bindParam(':guestid', $guestid);
			$stmt->bindParam(':serviceid', $serviceid);
			$stmt->bindParam(':hotelid', $hotelid);
			if($stmt->execute()){
				$report = true;
			}else{
				$report = false;
			}
		}else{
			$report = false;
		}
		return $report;
	}
/*				end Services API				*/

/*				start Offers API				*/
	function getOffersType($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT offers.*, hotels.hotel_name FROM offers, hotels WHERE offers.hotel_ID = :hotelid AND hotels.hotel_ID = offers.hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-z]+/", "", $r['hotel_name'])."/offer/".preg_replace("/[^a-zA-z]+/", "", $r['offer_name'])."/".$r['image'];
		}
		return $result;
	}
	
	function getOfferDetailsList($offerid, $hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT offers_detail.*, hotels.hotel_name FROM offers_detail, hotels WHERE offers_detail.offer_ID = :offerid AND offers_detail.hotel_ID = :hotelid AND offers_detail.hotel_ID = hotels.hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':offerid', $offerid);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-z]+/", "", $r['hotel_name'])."/offer/".$r['image'];
		}
		return $result;
	}
/*				end Offers API				*/

	function getChannelList($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT channels.*, hotels.hotel_name FROM channels, hotels WHERE channels.hotel_ID = :hotelid AND channels.hotel_ID = hotels.hotel_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-z]+/", "", $r['hotel_name'])."/channel/".$r['channel_logo'];
		}
		return $result;
	}
	
	function getFaq($hotelid){
        $dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM faq WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $r){
				$result[$i]['ans'] = trim(substr($r['answer'], 0, 25))."...";
		}
		return $result;
    }
	
	function getMarquee($hotelid){
		$dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM ticker WHERE hotel_ID = ?");
        $stmt->execute([$hotelid]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	function addDevice($deviceid, $modelname, $hotelname, $roomnumber){
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbconn();
		if($hotelname == "aloha"){
			$hotelname = "Aloha Boracay Hotel";
		}
		
		if($hotelname == "matt"){
			$hotelname = "Matt's Hotel";
		}
		
		if($hotelname == "bagarabon"){
			$hotelname = "Mount Bagarabon Resort & Hotel";
		}
		$stmt = $dbconn->prepare("INSERT INTO undevice (hotel_ID, device_ID, model_name, room_number, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_name = :hotelname),:uid,:mname,:roomnumber, :created)");
		$stmt->bindParam(':hotelname',$hotelname);
		$stmt->bindParam(':uid',$deviceid);
		$stmt->bindParam(':mname',$modelname);
		$stmt->bindParam(':roomnumber',$roomnumber);
		$stmt->bindParam(':created',$created);
		
		$status = "inactive";
		$stmt2 = $dbconn->prepare("INSERT INTO device (hotel_ID, mac_address, status, room_no, created_at) VALUES ((SELECT hotel_ID FROM hotels WHERE hotel_name = :hotelname),:uid,:mname,:roomnumber, :created)");
		$stmt2->bindParam(':hotelname',$hotelname);
		$stmt2->bindParam(':uid',$deviceid);
		$stmt2->bindParam(':mname',$status);
		$stmt2->bindParam(':roomnumber',$roomnumber);
		$stmt2->bindParam(':created',$created);
		$stmt2->execute();
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
		
	}
	
	function getAppUpdate(){
		$dbconn = $this->dbconn();
        $stmt = $dbconn->prepare("SELECT * FROM appupdate ORDER BY appupdate_ID ASC");
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
}
?>