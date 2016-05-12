<?php
  require_once "../../../config/Database/conexion_select.php";
  require_once '../../controllers/cpanel/SelectController.php';
  require_once '../rec_data.php';
  $ctrSelec = new SelectController();
  $ua=getBrowser();
  $ip=$ua['dirIp'];
  $validateip = $ctrSelec->GetStateip($ip);
  $rn = false;
if($validateip != false){
  while ($res = mysqli_fetch_object($validateip)) {
    # code...
    if($res->state == 'BLOQUEADO'){
      $rn = true;
    }
  }
}

if($rn == false){
  header("location:../");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Bloqueado! | </title>

  <!-- Bootstrap core CSS -->

  <link href="../cpanel/css/bootstrap.min.css" rel="stylesheet">

  <link href="../cpanel/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="../cpanel/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="../cpanel/css/custom.css" rel="stylesheet">
  <link href="../cpanel/css/icheck/flat/green.css" rel="stylesheet">


  <script src="../cpanel/js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>


<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <!-- page content -->
      <div class="col-md-12">
        <div class="col-middle">
          <div class="text-center text-center">
            <h1 class="error-number">BLOQUEADO</h1>
            <h2>Nuestro sistema ha detectado que has querido violentar la seguridad del sitio.</h2>
            
            <div class="mid_center">
              
              
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->
    </div>
  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>

  <script src="../cpanel/js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="../cpanel/js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="../cpanel/js/icheck/icheck.min.js"></script>

  <script src="../cpanel/js/custom.js"></script>
  <!-- pace -->
  <script src="../cpanel/js/pace/pace.min.js"></script>
  <!-- /footer content -->
</body>

</html>
