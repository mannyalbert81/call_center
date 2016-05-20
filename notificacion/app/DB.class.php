<?php 
	class DB{
		protected static $host = 'localhost';
		protected static $user = 'root';
		protected static $pass = '';
		protected static $db   = 'notificacion';

		public static function Conn(){
			try{
				return new PDO('mysql:host='.self::$host.';dbname='.self::$db.';', self::$user, self::$pass);
			}catch(PDOException $e){
				echo 'no conecta'. $e->getMessage();
			}
		}
	}