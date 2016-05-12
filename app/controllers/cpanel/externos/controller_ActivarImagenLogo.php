<?php
	
    require_once "../../../../config/Database/conexion_update.php";
    require_once '../UpdateController.php';


    $ctrUpdat= new UpdateController();

    $image = $_POST['image'];

   	$ctrUpdat->updStateLogo();
   	$ctrUpdat->updStateLogoActive($image);
    echo true;
?>