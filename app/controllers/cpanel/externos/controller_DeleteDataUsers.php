<?php
	
	require_once "../../../../config/Database/conexion_select.php";
    require_once "../../../../config/Database/conexion_delete.php";
    require_once '../SelectController.php';
    require_once '../DeleteController.php';


    $ctrSelec = new SelectController();
    $ctrDelet = new DeleteController();

    $password = $_POST['password'];
    $cod 	= $_POST['cod'];

    session_start();
   $query = $ctrSelec->Login($_SESSION['CEDULA'],$password);

    if($query != false){
    	$ctrDelet->DeleteSessionUser($cod);
    	$ctrDelet->DeleteUser($cod);
    	echo true;
    }else{
    	echo false;
    }

?>