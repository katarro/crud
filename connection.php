<?php 

// Conexion a la base de datos mediante Clase
class Db
{
	private $host = "bjxmjd2imx3dkki78ezk-mysql.services.clever-cloud.com";
	private $dbname = "bjxmjd2imx3dkki78ezk";
	private $user = "uz1bk9pjbikrhtox";
	private $pass = "pOAtklbVCBXzu62dLQ35";

	private static $instance=NULL;
	
	function __construct(){}

	public static function  getConnect(){
		if (!isset(self::$instance)) {
			$pdo_options[PDO::ATTR_ERRMODE]=PDO::ERRMODE_EXCEPTION;
			self::$instance= new PDO('mysql:host=bjxmjd2imx3dkki78ezk-mysql.services.clever-cloud.com;dbname=bjxmjd2imx3dkki78ezk','uz1bk9pjbikrhtox','pOAtklbVCBXzu62dLQ35',$pdo_options);
		} 
		return self::$instance;
	}
}

 ?>