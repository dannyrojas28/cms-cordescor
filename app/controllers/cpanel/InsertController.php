<?php

	
	date_default_timezone_set('America/Bogota');
	/**
	* 
	*/
	class InsertController extends ConexionInsert
	{
		
		function __construct()
		{
			# code...
		}

		public function InsertUser($cod,$firstname,$lastname,$cedula,$email,$password,$rol,$user_create){
			$date_register= date('Y-m-d H:i:s');
			$query = "INSERT INTO `user_admin`(`cod`,`firstname`, `lastname`, `cedula`, `email`, `password`, `rol`, `date_register`, `user_create`) VALUES ('$cod','$firstname','$lastname','$cedula','$email','$password','$rol','$date_register','$user_create')";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function InserSession($user){
			$query = "INSERT INTO `session`(`user`, `last_entry`) VALUES ('$user','0000-00-00 00:00:00')";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function BloquedIp($browser,$version,$ip,$platform,$estado){
			$query = "INSERT INTO `ip_bloqued`(`ip`, `browser`, `version`, `platform`, `state`) VALUES ('$ip','$browser','$version','$platform','$estado')";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function postLogo($url){
			$date= date('Y-m-d H:i:s');
			$query = "INSERT INTO `logo`(`url`, `state`, `date_upload`) VALUES ('$url','ACTIVA','$date')";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function postSliders($url,$state){
			$date= date('Y-m-d H:i:s');
			$query = "INSERT INTO `sliders`(`url`, `state`, `date_uploaded`) VALUES ('$url','$state','$date')";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function postProyectos($id,$tittle,$descripcion_small,$descripcion_large,$img_icon){
			$date= date('Y-m-d H:i:s');
			$query = "INSERT INTO `proyectos`(`cod`, `tittle`, `description_small`, `description_large`, `img_icon`, `date_upload`, `state`) VALUES ('$id','$tittle','$descripcion_small','$descripcion_large','$img_icon','$date','ACTIVO')";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function postGaleria($id,$imagen){
			$date= date('Y-m-d H:i:s');
			$query = "INSERT INTO `galerias`( `imagen`, `proyecto`, `date_upload`, `state`) VALUES ('$imagen','$id','$date','ACTIVO')";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function postContacto($nombre,$mensage,$email){
			$date= date('Y-m-d H:i:s');
			$query = "INSERT INTO `contacto`(`name`, `email`, `message`, `estate`, `date_upload`) VALUES ('$nombre','$email','$mensage','SIN REVISAR','$date')";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
	}


?>