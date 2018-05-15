<?php
/**
 * Developed By: Ranz Daren Castillano
 */
class Advertisement extends Database{
    	
	function getAdType(){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM places";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function setAdvertisement($data, $companyID, $imagecount, $images){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$image = [];
		if($imagecount == 5){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], $images['name'][3], $images['name'][4]);
		}elseif($imagecount == 4){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], $images['name'][3], "");
		}elseif($imagecount == 3){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], "", "");
		}elseif($imagecount == 2){
			$image = array($images['name'][0], $images['name'][1], "", "", "");
		}else{
			$image = array($images['name'][0], "", "", "", "");
		}
		$dbconn = $this->dbConn();
		$query = "INSERT INTO places_detail (adtype_ID,hotel_ID,company_ID,ad_title,ad_description,ad_address,ad_contact,ad_time_start,ad_time_end,image_count,image1,image2,image3,image4,image5,created_at) VALUES ((SELECT adtype_ID FROM places WHERE adtype_ID = :category),(SELECT hotel_ID FROM hotels WHERE hotel_ID =:hotel),(SELECT company_ID FROM places_nearby_companies WHERE company_ID = :companyid),:name,:desc,:address,:contact,:datestart,:dateend,:imagecount,:image1,:image2,:image3,:image4,:image5,:created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':category',$ad_category);
		$stmt->bindParam(':hotel',$hotel_name);
		$stmt->bindParam(':companyid',$companyID);
		$stmt->bindParam(':name',$ad_name);
		$stmt->bindParam(':desc',$description);
		$stmt->bindParam(':address',$ad_address);
		$stmt->bindParam(':contact',$ad_contact);
		$stmt->bindParam(':datestart',$daterange_in);
		$stmt->bindParam(':dateend',$daterange_out);
		$stmt->bindParam(':imagecount',$imagecount);
		$stmt->bindParam(':image1',$image[0]);
		$stmt->bindParam(':image2',$image[1]);
		$stmt->bindParam(':image3',$image[2]);
		$stmt->bindParam(':image4',$image[3]);
		$stmt->bindParam(':image5',$image[4]);
		$stmt->bindParam(':created',$created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function setCompany($data){
		extract($data);
		$created = date('Y-m-d H:i:s');
		$dbconn = $this->dbConn();
		$query = "INSERT INTO places_nearby_companies (company_name,company_email,company_contact,company_address,created_at) VALUES (:name,:email,:contact,:address,:created)";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':name',$companyname);
		$stmt->bindParam(':email',$email);
		$stmt->bindParam(':contact',$contactnumber);
		$stmt->bindParam(':address',$address);
		$stmt->bindParam(':created',$created);
		if($stmt->execute()){
			return true;
		}else{
			return false;
		}
	}
	
	function getCompanies(){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM places_nearby_companies";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
	
	function getCompanyID($email){
		$dbconn = $this->dbConn();
		$query = "SELECT company_ID FROM places_nearby_companies WHERE company_email = :email";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getCompanyInfo($companyID){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM places_nearby_companies WHERE company_ID = :compid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':compid',$companyID);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	
	function getAdvertisement(){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM places_detail";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
	}
    
	function getCompanyName($companyID){
		$dbconn = $this->dbConn();
		$query = "SELECT company_name FROM places_nearby_companies WHERE company_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id', $companyID);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getCompanyEmail($id){
		$dbconn = $this->dbConn();
		$query = "SELECT company_email FROM places_nearby_companies WHERE company_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getPlacesType($id){
		$dbconn = $this->dbConn();
		$query = "SELECT adtype_name FROM places WHERE adtype_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetchColumn();
		return $result;
	}
	
	function getAdDetails($id){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM places_detail WHERE ads_ID = :id";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':id', $id);
		$stmt->execute();
		$result = $stmt->fetch();
		return $result;
	}
	
	function removeAd($data){
		extract($data);
		$dbconn = $this->dbconn();
        $sql = "DELETE FROM places_detail WHERE ads_ID = :id";
		$stmt = $dbconn->prepare($sql);
		$stmt->bindParam(':id',$ad_ID);
		$value = $stmt->execute();
		$dbconn = null;
        return $value;
	}
	
	function updateCompany($data){
		extract($data);
		$dbconn = $this->dbConn();
		$query = "UPDATE places_nearby_companies SET company_email = :email, company_name = :name, company_contact = :contact, company_address = :address WHERE company_ID = :company_ID";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':email', $email);
		$stmt->bindParam(':name', $companyname);
		$stmt->bindParam(':contact', $contactnumber);
		$stmt->bindParam(':address', $address);
		$stmt->bindParam(':company_ID', $comp_id);
		if($stmt->execute()){
			return true;
		}else {
			return false;
		}
	}
	
	function updateAdvertisementWithImages($data, $companyid, $imagecount, $images){
		extract($data);
		$image = [];
		if($imagecount == 5){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], $images['name'][3], $images['name'][4]);
		}elseif($imagecount == 4){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], $images['name'][3], "");
		}elseif($imagecount == 3){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], "", "");
		}elseif($imagecount == 2){
			$image = array($images['name'][0], $images['name'][1], "", "", "");
		}else{
			$image = array($images['name'][0], "", "", "", "");
		}
		$dbconn = $this->dbConn();
		$query = "UPDATE places_detail SET ad_title = :name, hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), adtype_ID = (SELECT adtype_ID FROM places WHERE adtype_ID = :categoryid), ad_address = :address, ad_contact = :contact, ad_time_start = :from, ad_time_end = :to, ad_description = :desc, image_count = :imgcount, image1 = :img1, image2 = :img2, image3 = :img3, image4 = :img4, image5 = :img5 WHERE ads_ID = :adid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':name',$ad_name);
		$stmt->bindParam(':hotelid',$hotel_name);
		$stmt->bindParam(':categoryid',$ad_category);
		$stmt->bindParam(':address',$ad_address);
		$stmt->bindParam(':contact',$ad_contact);
		$stmt->bindParam(':from',$daterange_in);
		$stmt->bindParam(':to',$daterange_out);
		$stmt->bindParam(':desc',$description);
		$stmt->bindParam(':imgcount',$imagecount);
		$stmt->bindParam(':img1',$image[0]);
		$stmt->bindParam(':img2',$image[1]);
		$stmt->bindParam(':img3',$image[2]);
		$stmt->bindParam(':img4',$image[3]);
		$stmt->bindParam(':img5',$image[4]);
		$stmt->bindParam(':adid', $ad_id);
		if($stmt->execute()){
			return true;
		}else {
			return false;
		}
	}
	
	function updateAdvertisement($data){
		extract($data);
		$dbconn = $this->dbConn();
		$query = "UPDATE places_detail SET ad_title = :name, hotel_ID = (SELECT hotel_ID FROM hotels WHERE hotel_ID = :hotelid), adtype_ID = (SELECT adtype_ID FROM places WHERE adtype_ID = :categoryid), ad_address = :address, ad_contact = :contact, ad_time_start = :from, ad_time_end = :to, ad_description = :desc WHERE ads_ID = :adid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':name',$ad_name);
		$stmt->bindParam(':hotelid',$hotel_name);
		$stmt->bindParam(':categoryid',$ad_category);
		$stmt->bindParam(':address',$ad_address);
		$stmt->bindParam(':contact',$ad_contact);
		$stmt->bindParam(':from',$daterange_in);
		$stmt->bindParam(':to',$daterange_out);
		$stmt->bindParam(':desc',$description);
		$stmt->bindParam(':adid', $ad_id);
		if($stmt->execute()){
			return true;
		}else {
			return false;
		}
	}
    
    function editAdvertisementWithImages($data, $companyid, $imagecount, $images){
		extract($data);
		$image = [];
		if($imagecount == 5){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], $images['name'][3], $images['name'][4]);
		}elseif($imagecount == 4){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], $images['name'][3], "");
		}elseif($imagecount == 3){
			$image = array($images['name'][0], $images['name'][1], $images['name'][2], "", "");
		}elseif($imagecount == 2){
			$image = array($images['name'][0], $images['name'][1], "", "", "");
		}else{
			$image = array($images['name'][0], "", "", "", "");
		}
		$dbconn = $this->dbConn();
		$query = "UPDATE places_detail SET ad_title = :name, ad_address = :address, ad_contact = :contact, ad_description = :desc, image_count = :imgcount, image1 = :img1, image2 = :img2, image3 = :img3, image4 = :img4, image5 = :img5 WHERE ads_ID = :adid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':name',$ad_name);
		$stmt->bindParam(':address',$ad_address);
		$stmt->bindParam(':contact',$ad_contact);
		$stmt->bindParam(':desc',$description);
		$stmt->bindParam(':imgcount',$imagecount);
		$stmt->bindParam(':img1',$image[0]);
		$stmt->bindParam(':img2',$image[1]);
		$stmt->bindParam(':img3',$image[2]);
		$stmt->bindParam(':img4',$image[3]);
		$stmt->bindParam(':img5',$image[4]);
		$stmt->bindParam(':adid', $ad_id);
		if($stmt->execute()){
			return true;
		}else {
			return false;
		}
	}
	
	function editAdvertisement($data){
		extract($data);
		$dbconn = $this->dbConn();
		$query = "UPDATE places_detail SET ad_title = :name, ad_address = :address, ad_contact = :contact, ad_description = :desc WHERE ads_ID = :adid";
		$stmt = $dbconn->prepare($query);
		$stmt->bindParam(':name',$ad_name);
		$stmt->bindParam(':address',$ad_address);
		$stmt->bindParam(':contact',$ad_contact);
		$stmt->bindParam(':desc',$description);
		$stmt->bindParam(':adid', $ad_id);
		if($stmt->execute()){
			return true;
		}else {
			return false;
		}
	}
    
    function fetchAdvertiser($email){
		$dbconn = $this->dbConn();
		$query = "SELECT * FROM places_detail WHERE company_ID = (SELECT company_ID FROM places_nearby_companies WHERE company_email = '".$email."')";
		$stmt = $dbconn->prepare($query);
		$stmt->execute();
		$result = $stmt->fetchAll();
		return $result;
    }
}
?>