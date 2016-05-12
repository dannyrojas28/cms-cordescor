<?php

	require_once "../../../../config/Database/conexion_update.php";
    require_once "../../../../config/Database/conexion_select.php";
    require_once '../UpdateController.php';
    require_once '../SelectController.php';
    require_once '../../../admin/rec_data.php';
    session_start();
	$ctrSelec = new SelectController();
    $ctrUpdat = new UpdateController();
    $ua=getBrowser();
    

    $ip=$ua['dirIp'];
    $browser=$ua['name'];
    $version=$ua['version'];
    $platform=$ua['platform'];

    $validateip = $ctrSelec->GetStateip($ip);
      //validamos si la cedula y email del usuario esta registrado
    if($validateip != false){
      while ($res = mysqli_fetch_object($validateip)) {
        # code...
         $cod=$res->cod;
        if($res->state == 'BLOQUEADO'){
          header("location:../../../admin/bloqued/");
        }
      }
    }
    
    if(!empty($_POST['bloq'])){
        $ctrUpdat->UpdateStateUser($_SESSION['SESSION'],'BLOQUEADO');
        if($validateip != false){
            $ctrUpdat->UpdateIp($browser,$version,$cod,$platform,'BLOQUEADO');
        }
        $_['SESSION'] = "";
        $_SESSION['CEDULA']  = "";
        $_SESSION['NAMES']   = "";
        $_SESSION['EMAIL']   = "";
        $_SESSION['ROL']     = "";

        session_destroy();
        header("location:../../../admin/bloqued/");
    }