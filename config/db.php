<?php 	
	class conexion{
		public static function get_conexion(){
			/*$host="localhost";
			$db="erpc2";
			$user="userCanal";
			$pass="4QgmfSzz!HMt]nMd";*/

			$host="localhost:3307";
			$db="erpc5";
			$user="root";
			$pass="";

			$conexion=new PDO("mysql:host=$host; dbname=$db;",
			$user, $pass,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
			return $conexion;
		}
	}



?>