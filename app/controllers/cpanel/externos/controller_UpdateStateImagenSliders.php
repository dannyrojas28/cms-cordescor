<?php
	
    require_once "../../../../config/Database/conexion_update.php";
    require_once "../../../../config/Database/conexion_select.php";
    require_once '../UpdateController.php';
    require_once '../SelectController.php';


    $ctrUpdat = new UpdateController();
    $ctrSelec = new SelectController();

   	$image = $_POST['image'];
   	$state = $_POST['state'];

   	if($state == 'DESACTIVAR'){
   		 $ctrUpdat->updStateSlider($image,"DESACTIVADA");
   		 echo true;
   	}else{
   		$numActivos = mysqli_num_rows($ctrSelec->GetSlidersActive());
   		if($numActivos == $ctrSelec->numSliders){
   			echo 'Desactiva una imagen para poder activar esta';
   		}else{
   			$ctrUpdat->updStateSlider($image,"ACTIVA");
   		 	echo true;
   		}
   	}
    
?>