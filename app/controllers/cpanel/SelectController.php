<?php

	

	/**
	* 
	*/
	class SelectController extends ConexionSelect
	{
		public $numSliders = 5;



		function __construct()
		{
			# code...
		}
		public function getCodUser(){
			$query = "SELECT `cod` FROM `user_admin` ORDER BY cod DESC limit 0,1 ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 
	        	while ($ro = mysqli_fetch_object($result)) {
	       		 	# code...
	       		 	$num = $ro->cod + 1;
	       		 }
	       		 return $num;
	        }
	        return false;
		}

		public function ValidateCedula($cedula){
			$query = "SELECT `cedula` FROM `user_admin` WHERE `cedula` = '$cedula' ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}

		public function ValidateEmail($email){
			$query = "SELECT `email` FROM `user_admin` WHERE `email` = '$email' ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function GetStateip($ip){
			$query = "SELECT * FROM `ip_bloqued` WHERE `ip` = '$ip'  ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}

		public function Login($usuario,$password){
			$password = md5($password);
			$query = "SELECT * FROM `session`,user_admin WHERE `cedula` = '$usuario' AND password = '$password' AND user_admin.cod=session.user ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function GetUsers(){
			$query = "SELECT * FROM `user_admin`,session,rol WHERE user_admin.cod=session.user AND user_admin.rol=rol.id ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function GetRols(){
			$query = "SELECT * FROM `rol` ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function GetSlidersActive(){
			$query = "SELECT * FROM `sliders` WHERE state = 'ACTIVA' ORDER BY state ASC ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function GetSliders(){
			$query = "SELECT * FROM `sliders` ORDER BY state ASC ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function GetState($cod){
			$query = "SELECT state FROM `session` WHERE user = '$cod' ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function ValidarImagen($image){
			$query = "SELECT * FROM `logo` WHERE url = '$image' ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function ValidarImagenSliders($image){
			$query = "SELECT * FROM `sliders` WHERE url = '$image' ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function GetLogos(){
			$query = "SELECT * FROM `logo` ORDER BY state ASC ";
	        $result = $this->Ejecutar($query);
	        if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function ShowUser($cod){
			$query = "SELECT * FROM `user_admin`,session,rol WHERE user_admin.cod=session.user AND user_admin.rol=rol.id AND user_admin.cod = '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function GetNosotros($tipo){
			$query = "SELECT * FROM nosotros WHERE tipo = '$tipo' ";
	        $result = $this->Ejecutar($query);
	        while ($res = mysqli_fetch_object($result)) {
	        	# code...
	        	return $res->texto;
	        }
		}

		public function GetProyectos(){
			$query = "SELECT * FROM proyectos WHERE 1 ";
	        $result = $this->Ejecutar($query);
	      	if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function GetGalerias($cod){
			$query = "SELECT * FROM galerias WHERE proyecto = '$cod' ";
	        $result = $this->Ejecutar($query);
	      	if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function GetProyectosMin5(){
			$query = "SELECT * FROM proyectos WHERE state = 'ACTIVO' ORDER BY date_upload DESC limit 0,5 ";
	        $result = $this->Ejecutar($query);
	      	if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function GetProyectosActive(){
			$query = "SELECT * FROM proyectos WHERE state = 'ACTIVO' ORDER BY date_upload DESC";
	        $result = $this->Ejecutar($query);
	      	if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
		public function GetProyectosSelect($proyecto){
			$query = "SELECT * FROM proyectos WHERE tittle = '$proyecto' AND state = 'ACTIVO' ";
	        $result = $this->Ejecutar($query);
	      	if (mysqli_num_rows($result) > 0) {
	        	# code...
	       		 return $result;
	        }
	        return false;
		}
	}


?>