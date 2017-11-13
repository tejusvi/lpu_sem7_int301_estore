<?php
require_once('utility.php');
require_once('database.php');
/*
password regex for strong password
^ # start of line
(?=(?:.*[A-Z])+) # atleast 1 upper case letters
(?=(?:.*[a-z])+) # atleast 1 lower case letters
(?=(?:.*\d)+) # atleast 1 digits
(?=(?:.*[!@#$%^&*()_\s-])+) # atleast 1 special characters
([A-Za-z\d!@#$%^&*()_\s-]{8,20}) # length 8-20, only above char classes
$ # end of line

CREATE TABLE `estore`.`UserMaster` (
    `ID` SERIAL NOT NULL , 
    `EmailId` VARCHAR(128) NOT NULL UNIQUE, 
    `Name` VARCHAR(256) NOT NULL , 
    `Password` VARBINARY(512) NOT NULL , 
    `IsActive` BOOLEAN NOT NULL DEFAULT TRUE , 
    `IsAdmin` BOOLEAN NOT NULL DEFAULT FALSE , 
    `PasswordChangedOn` DATETIME NULL DEFAULT NULL , 
    `CreatedOn` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , 
    `ModifiedOn` DATETIME NULL DEFAULT NULL
);

DELIMITER $$
DROP PROCEDURE IF EXISTS pNewUser$$
CREATE PROCEDURE pNewUser(IN name varchar(256),IN email varchar(128),IN pass varchar(256))
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY INVOKER
BEGIN
DECLARE EXIT HANDLER FOR SQLEXCEPTION
BEGIN
	ROLLBACK;
    RESIGNAL;
END;
DECLARE EXIT HANDLER FOR SQLWARNING
BEGIN
	ROLLBACK;
    RESIGNAL;
END;

START TRANSACTION;

INSERT INTO usermaster(Name,EmailId,Password,IsActive,IsAdmin)
VALUES(name,email,pass,1,0);

COMMIT;
END$$
DELIMITER ;

DELIMITER $$
DROP PROCEDURE IF EXISTS pAuthenticateUser$$
CREATE PROCEDURE pAuthenticateUser(IN email varchar(128))
NOT DETERMINISTIC CONTAINS SQL SQL SECURITY INVOKER
BEGIN

SELECT Name,EmailId,Password,IsAdmin
FROM usermaster WHERE IsActive = 1 AND EmailId = email;

END$$
DELIMITER ;
*/
class User{
	public $name,$email,$password;
	
	public function Create(){
		$con = null;
		$stmt = null;
		$qr = new QueryResult();
		try{
			$inputValid = true;
			$inputMessage = array();
			if(!isset($this->name) || trim($this->name)===""||filter_var($this->name, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^[a-zA-Z\s.]+$/")))===false){
				$inputValid = false;
				array_push($inputMessage,"Please enter a valid name.");
			}
			if(!isset($this->email) || trim($this->email)===""||filter_var($this->email, FILTER_VALIDATE_EMAIL)===false){
				$inputValid = false;
				array_push($inputMessage,"Please enter a valid email address.");
			}
			if(!isset($this->password) || trim($this->password)===""||filter_var($this->password, FILTER_VALIDATE_REGEXP,array("options"=>array("regexp"=>"/^(?=(?:.*[A-Z])+)(?=(?:.*[a-z])+)(?=(?:.*\d)+)(?=(?:.*[!@#$%^&*()_\s-])+)([A-Za-z\d!@#$%^&*()_\s-]{8,20})$/")))===false){
				$inputValid = false;
				array_push($inputMessage,"Please enter a valid password of 8-20 length having numerical digits, small and capital alphabets and symbols !@#$%^&*()_- only.");
			}
			
			if($inputValid !== true){
				$qr->data = $inputMessage;
				throw new Exception("Input validation error(s)!!");
			}
			
			$h_pass = password_hash($this->password,PASSWORD_DEFAULT);
			if(!$h_pass){
				throw new Exception("Unable to secure password. Try later.");
			}
			
			$db = new Database();
			$con = $db->getConnection();
			
			if (!($stmt = $con->prepare("CALL pNewUser(?,?,?)"))) {
				throw new Exception("Prepare failed: (" . $con->errno . ") " . $con->error);
			}
			
			$stmt->bind_param("sss", $this->name,$this->email,$h_pass);
			
			if (!$stmt->execute()) {
				throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
			}
			
			$qr->status = true;
		}catch(Exception $e){
			$qr->status = false;
			$qr->message = $e->getMessage();
		}finally{
			if($stmt !== null){
				$stmt->close();
			}
			if($con !== null){
				$con->close();
			}
		}
		return $qr;
	}
	
	public function Login(){
		$con = null;
		$stmt = null;
		$qr = new QueryResult();
		try{
			$inputValid = true;
			$inputMessage = array();
			if(!isset($this->email) || trim($this->email)===""||filter_var($this->email, FILTER_VALIDATE_EMAIL)===false){
				$inputValid = false;
				array_push($inputMessage,"Please enter a valid email address.");
			}
			
			if($inputValid !== true){
				$qr->data = $inputMessage;
				throw new Exception("Input validation error(s)!!");
			}
			
			$db = new Database();
			$con = $db->getConnection();
			
			if (!($stmt = $con->prepare("CALL pAuthenticateUser(?)"))) {
				throw new Exception("Prepare failed: (" . $con->errno . ") " . $con->error);
			}
			
			$stmt->bind_param("s", $this->email);
			
			if (!$stmt->execute()) {
				throw new Exception("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
			}
			
			$result = $stmt->get_result();
			if($result ===false){
				throw new Exception("Fetch failed: (" . $con->errno . ") " . $con->error);
			}else if($result->num_rows===1){
				$row=$result->fetch_assoc();
				if(password_verify($this->password,$row['Password'])){
					User::Logout();
				
					//Session must be available before using session variable.
					session_start();
					//set session data
					$_SESSION['name'] = trim($row['Name']);
					$_SESSION['email'] = trim($row['EmailId']);
					
					$result->free();
					$qr->status = true;
				}else{
					$qr->status = false;
					$qr->message = 'Wrong username/password.';
				}
			}else{
				$qr->status = false;
				$qr->message = 'Unable to fetch data.';
			}
		}catch(Exception $e){
			$qr->status = false;
			$qr->message = $e->getMessage();
		}finally{
			if($stmt !== null){
				$stmt->close();
			}
			if($con !== null){
				$con->close();
			}
		}
		return $qr;
	}
	
	public static function Logout(){
		session_destroy();
	}
}
?>