<?php
	class UpdateController extends ConexionUpdate
	{
		
		function __construct()
		{
			# code...
		}

		public function UpdateStateUser($user,$estado){
			$query = "UPDATE session SET state= '$estado' WHERE user = '$user' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function UpdatUser($cod,$firstname,$lastname,$email,$rol){
			$query = "UPDATE `user_admin` SET `firstname`= '$firstname' ,`lastname`= '$lastname' ,`email`= '$email' ,`rol`= '$rol' WHERE cod = '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function UpdatPass($cod,$password){
			$query = "UPDATE `user_admin` SET `password`= '$password'  WHERE cod = '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function UpdateSession($browser,$version,$ip,$platform,$user,$estado){
			$query = "UPDATE session SET browser = '$browser',version='$version',dirIp= '$ip',platform='$platform',state='$estado' WHERE user = '$user' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function UpdateIp($browser,$version,$cod,$platform,$estado){
			$query = "UPDATE ip_bloqued SET browser= '$browser' ,version= '$version',platform= '$platform',state= '$estado'  WHERE cod= '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function updStateLogo(){
			$query = "UPDATE `logo` SET `state`= 'DESACTIVADA'  WHERE state = 'ACTIVA' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function updStateLogoActive($url){
			$query = "UPDATE `logo` SET `state`= 'ACTIVA'  WHERE url = '$url' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function updStateSlider($url,$state){
			$query = "UPDATE `sliders` SET `state`= '$state'  WHERE url = '$url' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function updNosotros($text,$tipo){
			$query = "UPDATE `nosotros` SET `texto`= '$text'  WHERE tipo = '$tipo' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function updProyectoState($cod,$estado){
			$query = "UPDATE `proyectos` SET `state`= '$estado'  WHERE cod = '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function updGaleriaState($cod,$estado){
			$query = "UPDATE `galerias` SET state = '$estado'  WHERE `proyecto`= '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
	}


?>