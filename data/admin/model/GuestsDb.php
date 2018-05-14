<?php
/**
 * Developer By: Joe John Ferrolino
 */
class AdminDB {
    public function connectDB() {
        return new PDO('mysql:host=' . DB_HOST.  ';dbname=' . DB_NAME, DB_UID, DB_PWD);
    }
     // for login
     public function checkUsernameAndPassword($data) {
            $db = $this->connectDB();
            $params = array($data['username'],md5($data['password']));
            $sql = "SELECT * FROM registration WHERE username = ? AND password = ?";
            $stmt = $db->prepare($sql);
            $stmt ->execute($params);
            $result = $stmt->fetch();
            if($result){
                return true;
            }else{
                return false;
            }
        }
    //inserting data from database
    public function addGuests($data) {
        $db_con = $this->connectDB();
        $encryptedpass = md5($data['password']);
        $stmt = $db_con->prepare("INSERT INTO users ( firstname,lastname,address, emailAdd, username, password) VALUES (:firstname, :lastname,  :address, :emailAdd, :username, :password);");
        $stmt->bindParam(':firstname', $data['firstname']);
        $stmt->bindParam(':lastname', $data['lastname']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':emailAdd', $data["emailAdd"]);
        $stmt->bindParam(':username', $data["username"]);
        $stmt->bindParam(':password', $encryptedpass);

        if($stmt->execute())
        {
          return true;
        }

      }
    //read data from database
    public function getAllAdmin() {
        $db = $this->connectDB();
        $sql = "SELECT * FROM registration";
        $result = false;
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            $db = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $result;
    }
    //delete data by ID from database   
    public function deleteAdminByID($RegId) {
        $db = $this->connectDB();
        $sql = "DELETE FROM registration WHERE RegId = '".$RegId."'";
        try {
            $stmt = $db->prepare($sql);
            $value = $stmt->execute();
            $db = null;
        } catch (PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $value;
    }
     //getting ID from database
     public function getAdminByID($RegId) {
        $db = $this->connectDB();
        $sql = "SELECT * FROM Registration WHERE RegId = $RegId";
        $result = false;
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            $db = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return json_encode($result);
    }
    //update data from database
    public function editAdminByID($data) { 
        $db = $this->connectDB();
        $sql = "UPDATE registration
                SET firstname = '".$data['lastname']."',
                    lastname = '".$data['firstname']."',
                    address = '".$data['address']."',
                    emailAdd = '".$data['emailAdd']."',
                    Username = '".$data['username']."'
                WHERE RegId = '".$data['RegId']."'";
        $result = false;
        try {
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();
            $db = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $result;
    }
    public function fetchName($username){
        $db_con=$this->connectDB();
        $stmt=$db_con->prepare("SELECT concat(lastname,', ',firstname) FROM registration WHERE username=?");
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
  }
    public function checkEmail($email)
    {
        $db_con = $this->connectDB();

        $stmt = $db_con->prepare("SELECT emailAdd FROM registration WHERE emailAdd = '".$email."' ");
        $stmt->execute();
        $result = $stmt->rowCount();
        if ($result == 1)
        {
            echo "Email already exists!"; // if exists!
        }
    }

    public function fetchUserInformation($username)
    {
        $db_con = $this->connectDB();

        $stmt = $db_con->prepare("SELECT * FROM registration WHERE username = ?");
        $stmt->execute([$username]);
        return $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function checkPassword($password) {
        $db = $this->connectDB();
        $sql = "SELECT RegId FROM registration WHERE password = '".md5($password)."'";
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetch();
            $db = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $result['RegId'];
    }

    public function changePassword($data) {
        $db = $this->connectDB();
        $sql = "UPDATE registration
                SET password = '".md5($data['password'])."'
                WHERE RegId = ".$data['RegId']."";
        $result = false;
        try {
            $stmt = $db->prepare($sql);
            $result = $stmt->execute();
            $db = null;
        } catch(PDOException $ex) {
            echo "DB Error:", $ex->getMessage();
        }
        return $result;
    }
   
}
?>
