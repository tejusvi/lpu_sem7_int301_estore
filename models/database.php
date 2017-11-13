<?php
/*
	CREATE USER 'estore_web'@'localhost' IDENTIFIED BY 'xFnzegXFGwPFCR5y';
	GRANT SELECT, INSERT, UPDATE, EXECUTE ON estore.* TO 'estore_web'@'localhost';
	CREATE USER 'estore_root'@'localhost' IDENTIFIED BY 'R00t@cce$$';
	GRANT ALL PRIVILEGES ON estore . * TO 'estore_root'@'localhost';
	FLUSH PRIVILEGES;
*/

//start session
session_start();

class Database{
	private static $servername = "localhost";
	private static $username = "estore_web";
	private static $password = "xFnzegXFGwPFCR5y";
	private static $dbname = "eStore";
	public function getConnection(){
		$conn = null;
		try{
			// Create connection
			$conn = new mysqli(Database::$servername, Database::$username, Database::$password);
			
			// Check connection
			if ($conn->connect_error) {
				throw new Exception($conn->connect_error);
			}
			
			$conn->select_db(Database::$dbname);
			
		}catch(Exception $e){
			throw $e;
		}
		return $conn;
	}
}
?>