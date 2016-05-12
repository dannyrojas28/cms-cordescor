<?php

session_start();

    require_once "../../../../config/Database/conexion_update.php";
    require_once '../../../controllers/cpanel/UpdateController.php';
    require_once '../../rec_data.php';


    $ua=getBrowser();
    $ip=$ua['dirIp'];
	$browser=$ua['name'];
	$version=$ua['version'];
	$platform=$ua['platform'];

	$ctrUpdat = new UpdateController();

	$ctrUpdat->UpdateSession($browser,$version,$ip,$platform,$_SESSION['SESSION'],'OFFLINE');

	$_SESSION['SESSION'] = "";
    $_SESSION['CEDULA']  = "";
    $_SESSION['NAMES']   = "";
    $_SESSION['EMAIL']   = "";
    $_SESSION['ROL']     = "";

    session_destroy();

    header("location:../");
?>