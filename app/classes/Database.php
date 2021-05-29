<?php
	class Database{
		private static $conn;

		public static function  getConnection(){
			include_once(__DIR__ ."/../core/settings.php");

			if(self::$conn === null){
				self::$conn = new PDO("mysql:host=" . SETTINGS['db']['host'] . ":8889;charset=utf8mb4;dbname=" . SETTINGS['db']['dbName'] , SETTINGS['db']['user'] , SETTINGS['db']['password'] );
				return self::$conn;
			} else {
				return self::$conn;
			}
		}
	}
?>