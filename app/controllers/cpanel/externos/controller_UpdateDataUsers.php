<?php

	require_once "../../../../config/Database/conexion_update.php";
    require_once "../../../../config/Database/conexion_select.php";
    require_once '../UpdateController.php';
    require_once '../SelectController.php';

    $ctrUpdat = new UpdateController();
    $ctrSelec = new SelectController();


	$firstname	=	$_POST['firstname'];
	$lastname	=	$_POST['lastname'];
	$email		=	$_POST['email'];
	$rol		=	$_POST['rol'];
	$state		=	$_POST['estado'];
	$cod		=	$_POST['cod'];
	$ML = false;

	if ($email != $_POST['emailhidden']) {
          # code...
          if ($ctrSelec->ValidateEmail($email) != false ) {
         	echo  $error =  "Email Registrado";
              $ML=true;
          }
    }

	if ($ML != true) {
		$ctrUpdat->UpdatUser($cod,$firstname,$lastname,$email,$rol);
		if (!empty($_POST['password2'])) {
			# code...
			$password2 = $_POST['password2'];
			$password2 = md5($password2);
			$ctrUpdat->UpdatPass($cod,$password2);
			
		}
		
			$ctrUpdat->UpdateStateUser($cod,$state);
		
		echo true;
	}
	



?>