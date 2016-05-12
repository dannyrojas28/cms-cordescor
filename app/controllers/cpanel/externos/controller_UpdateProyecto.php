<?php
	
	require_once "../../../../config/Database/conexion_select.php";
    require_once "../../../../config/Database/conexion_update.php";
    require_once '../SelectController.php';
    require_once '../UpdateController.php';


    $ctrSelec = new SelectController();
    $ctrUpdat = new UpdateController();

    $password = $_POST['password'];
    $cod      = $_POST['cod'];
    $estado   = $_POST['estado'];

    session_start();
   $query = $ctrSelec->Login($_SESSION['CEDULA'],$password);

    if($query != false){
    	$ctrUpdat->updProyectoState($cod,$estado);
    	$ctrUpdat->updGaleriaState($cod,$estado);
    	echo true;
    }else{
    	echo false;
    }

?>