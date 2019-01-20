<?php
	include 'php/Mysql/Mysql.php';

	class UrlShortnerClass{

		protected static $hashKey = "123456789abcdfghjkmnpqrstvwxyzABCDFGHJKLMNPQRSTVWXYZ";

		public function __construct($db_host, $db_user, $db_password, $db_name){
			$this->Conn = new MysqlConn($db_host, $db_user, $db_password, $db_name);
			$this->timeStamp = date("Y-m-d",$_SERVER["REQUEST_TIME"]);

		}


		public function generateHashKey($url, $hashLen, $mainUrl){
			$hashKeyLen = strlen(self::$hashKey);
			$value = $this->Conn->readTable("url_table", "short_code", "long_url='$url'");
			if ($value){
				 return $mainUrl.$value['short_code'];
			}
			if ($hashKeyLen < 6){
				return False;
			}
			$hashValue = substr(str_shuffle(self::$hashKey), 0, $hashLen);
			$value = $this->Conn->readTable("url_table", "short_code", "short_code='$hashValue'");
			if ($value){
				$this->generateHashKey($url, $hashLen, $mainUrl);
			}
			$this->Conn->writeTable("url_table", "(long_url, short_code, date_created, counter)", "('$url', '$hashValue', '$this->timeStamp', 0)");
			return 	$mainUrl.$hashValue;
		}

		public function gerUrl($url){
			$value = $this->Conn->readTable("url_table", "id,long_url,counter", "short_code='$url'");
			if ($value){
				$counter = $value['counter'] + 1;
				$id = $value['id'];
				$this->Conn->updateTable("url_table", "counter=$counter","id=$id");
				return $value['long_url'];
			}
			return 0;
			$this->Conn->closeConn();
		}

	}
	
?>