<?php


	/**
	* 
	*/
	class DeleteController extends ConexionDelete
	{
		
		function __construct()
		{
			# code...
		}

		public function DeleteSessionUser($cod){
			$query = "DELETE FROM `session` WHERE user = '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function DeleteUser($cod){
			$query = "DELETE FROM `user_admin` WHERE cod = '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function DeleteLogo($imagen){
			$query = "DELETE FROM `logo` WHERE url = '$imagen' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function DeleteSliders($imagen){
			$query = "DELETE FROM `sliders` WHERE url = '$imagen' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function DeleteProyecto($cod){
			$query = "DELETE FROM `proyectos` WHERE cod = '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
		public function DeleteGaleria($cod){
			$query = "DELETE FROM `galerias` WHERE proyecto = '$cod' ";
	        $result = $this->Ejecutar($query);
	        return $result;
		}
	}


?>