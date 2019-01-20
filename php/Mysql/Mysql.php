<?php 

class  MysqlConn{
	
	// private $dbHost;
	// private $dbUser; 
	// private $dbPassword;
	// private $db;
		
	public function __construct($dbHost, $dbUser, $password, $db) {
		
		// $this->dbPassword = $password;
		// $this->db =  $database;
		$this->dbConn = new mysqli($dbHost, $dbUser, $password, $db);
		if ($this->dbConn->connect_error){
				die("Connection Failed:". $this->dbConn->connect_error);
			}
		}
		
		public function writeTable($tableName,  $columns, $data){
			//create table value		
			$sql = "INSERT INTO $tableName  $columns VALUES $data";
		 	$queryStatus = $this->dbConn->query($sql);
		 	if ($queryStatus){
				return 1; 		 	
		 	}		
		 	return 0;
		}
		
		public function readTable($tableName,  $columns = "*",  $condition=1){
			//read table value
			$sql = "SELECT $columns FROM $tableName WHERE $condition";
			// echo $sql;
			$result = $this->dbConn->query($sql);
			// // $values = array();
			if($result->num_rows > 0){
				while($row = $result->fetch_assoc()){
					return $row;
				}
			}
			return 0;	
		}						
		
		public function updateTable($tableName, $data, $condition){
			//update value in a table
			$sql = "UPDATE $tableName SET $data WHERE $condition";
			$updateStat = $this->dbConn->query($sql);
			if ($updateStat){
				return 1	;		
			}
			return 0;
		}		
						
		public function deleteTableValue($tableName, $condition = 1){
			//delete table value	
			$sql = 	"DELETE FROM $tableName WHERE $condition";
			$delStatus = $this->dbConn->query($sql);
			if ($delStatus){
				return TRUE;
			}
			return 0;
		}		
		
		public function getRowCount($object){
			return mysqli_num_rows($object);

		}
		
		public function closeConn(){
			$this->dbConn->close();
		}
			
		public function __destruct(){
			$this->closeConn();		
		}
}


//$mysqlTest = new MysqlConn($database="iot", $password = "");
//echo ($mysqlTest->readTable($tableName = "iotTable"));
?>