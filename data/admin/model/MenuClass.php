<?php
/**
 * Developed By: Ranz Daren Castillano
 */
class Menus extends Database{
    	
	function getCate($id){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM categories WHERE restaurant_ID = (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :id)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function getDishstyle($id, $id2){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM dishstyles WHERE restaurant_ID = (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :id) AND category_ID = (SELECT category_ID FROM categories WHERE category_ID = :catid)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->bindParam(':catid',$id2);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}
	
	function addCategory($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO categories (hotel_ID, restaurant_ID, category_name, created_at) VALUES ((SELECT hotel_ID FROM restaurants WHERE restaurant_ID = :resid), (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :resid2), :name, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':resid', $selRestaurants);
		$stmt->bindParam(':resid2', $selRestaurants);
		$stmt->bindParam(':name', $categoryin);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function addDishstyle($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO dishstyles (hotel_ID, restaurant_ID, category_ID, dishstyle_name, created_at) VALUES ((SELECT hotel_ID FROM restaurants WHERE restaurant_ID = :hotelid), (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :resid2), (SELECT category_ID FROM categories WHERE category_ID = :catid), :name, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid', $selRestaurants1);
		$stmt->bindParam(':resid2', $selRestaurants1);
		$stmt->bindParam(':catid', $selCategory);
		$stmt->bindParam(':name', $dishstylein);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function addMenu($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO restaurant_menus (hotel_ID, dishstyle_ID, category_ID, restaurant_ID, menu_image, menu_name, menu_price, menu_basicPrice, menu_desc, menu_shortDesc, pos_ref_ID, created_at) VALUES ((SELECT hotel_ID FROM restaurants WHERE restaurant_ID = :hotelid),(SELECT dishstyle_ID FROM dishstyles WHERE dishstyle_ID = :dishid), (SELECT category_ID FROM categories WHERE category_ID = :catid), (SELECT restaurant_ID FROM restaurants WHERE restaurant_ID = :resid), :image, :name, :price, :basicprice, :desc, :shortdesc, :posid, :created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':hotelid',$menRestaurants);
		$stmt->bindParam(':dishid', $menDishstyle);
		$stmt->bindParam(':catid', $menCategories);
		$stmt->bindParam(':resid', $menRestaurants);
		$stmt->bindParam(':image', $menu_image);
		$stmt->bindParam(':name', $dishname);
		$stmt->bindParam(':price', $price);
		$stmt->bindParam(':basicprice', $price);
		$stmt->bindParam(':desc', $description);
		$stmt->bindParam(':shortdesc', $shortdescription);
		$stmt->bindParam(':posid', $posid);
		$stmt->bindParam(':created', $created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function getHotelID($id){
		$dbconn = $this->dbConn();
		$query = "SELECT hotel_ID FROM restaurants WHERE restaurant_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$id);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getAllMenus($hotelid){
		$dbconn = $this->dbConn();
		$query = "SELECT restaurant_menus.*, categories.category_name, dishstyles.dishstyle_name, hotels.hotel_name, restaurants.restaurant_name FROM restaurant_menus, categories, dishstyles, hotels, restaurants WHERE restaurant_menus.hotel_ID = :id AND restaurant_menus.category_ID = categories.category_ID AND restaurant_menus.dishstyle_ID = dishstyles.dishstyle_ID AND restaurant_menus.hotel_ID = hotels.hotel_ID AND restaurant_menus.restaurant_ID = restaurants.restaurant_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id',$hotelid);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		foreach($result as $i => $res){
			$result[$i]['img_path'] = "media/images/".preg_replace("/[^a-zA-Z]+/", "", $res['hotel_name'])."/restaurant/".$res['menu_image'];
		}
		return $result;
	}
}
?>