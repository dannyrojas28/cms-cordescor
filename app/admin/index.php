<?php
  session_start();
  if(!empty($_SESSION['SESSION'])){
    header("location:cpanel/");
  }
  require_once "../../config/Database/conexion_select.php";
  require_once "../../config/Database/conexion_update.php";
  require_once "../../config/Database/conexion_insert.php";
  require_once '../controllers/cpanel/UpdateController.php';
  require_once '../controllers/cpanel/InsertController.php';
  require_once '../controllers/cpanel/SelectController.php';
  require_once 'rec_data.php';
$ua=getBrowser();
$error= "";
$intentos = 0;
$bloq = "";
$usuario = "";
$ip=$ua['dirIp'];
$browser=$ua['name'];
$version=$ua['version'];
$platform=$ua['platform'];
$ctrSelec = new SelectController();
$ctrUpdat = new UpdateController();
$ctrInser = new InsertController();
$validateip = $ctrSelec->GetStateip($ip);
if($validateip != false){
  while ($res = mysqli_fetch_object($validateip)) {
    # code...
     $cod=$res->cod;
    if($res->state == 'BLOQUEADO'){
      header("location:bloqued/");
    }
  }
}

if(!empty($_POST['usuario'])){
 $usuario  = $_POST['usuario'];
  $password = $_POST['password'];

  $log = $ctrSelec->Login($usuario,$password);
  if ($log != false) {
    # code...
      while ( $res = mysqli_fetch_object($log)) {
        # code..
            if($res->state == "BLOQUEADO"){
              $bloq = "Este usuario esta bloqueado";
              $intentos = 0;
            }else{
              $bloq="entro";
              $_SESSION['SESSION'] = $res->cod;
              $_SESSION['CEDULA']  = $res->cedula;
              $_SESSION['FIRSTNAME']   = $res->firstname;
              $_SESSION['LASTNAME']   = $res->lastname;
              $_SESSION['EMAIL']   = $res->email;
              $_SESSION['ROL']     = $res->rol;

              $ctrUpdat->UpdateSession($browser,$version,$ip,$platform,$res->cod,'EN LINEA');
               header("location:cpanel/");
            }
      }
  }else{
    $error ="Datos Incorrectos";
    $intentos = $_POST['intentos'] + 1;
    if ($intentos == 5) {
      # code...
      if($validateip != false){
          $ctrUpdat->UpdateIp($browser,$version,$cod,$platform,'BLOQUEADO');
      }else{
          $ctrInser->BloquedIp($browser,$version,$ip,$platform,'BLOQUEADO');
      }
       header("location:bloqued/");
    }
  }
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

  <title>Gentallela Alela! | </title>

  <!-- Bootstrap core CSS -->

  <link href="cpanel/css/bootstrap.min.css" rel="stylesheet">

  <link href="cpanel/fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="cpanel/css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="cpanel/css/custom.css" rel="stylesheet">
  <link href="cpanel/css/icheck/flat/green.css" rel="stylesheet">


  <script src="cpanel/js/jquery.min.js"></script>

  <!--[if lt IE 9]>
        <script src="../assets/js/ie8-responsive-file-warning.js"></script>
        <![endif]-->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

</head>

<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>
    <input id="direccionip" name="direccionip" value="<?php echo $ip; ?>" type="hidden">
    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content row">
          <form  novalidate action="" method="post">
          <input type="hidden" id="intentos" value="<?php echo $intentos; ?>" name="intentos">
                 <?php if(!empty($error)){ ?>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong><?php echo $error; ?></strong>
                        <p>Intentos Restantes <?php echo (5 - $intentos); ?></p>
                      </div>
                    <?php  } ?>

                    <?php if(!empty($bloq)){ ?>
                        <div class="alert alert-warning alert-dismissible fade in" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong><?php echo $bloq; ?></strong>
                      </div>
                    <?php  } ?>
            <h1>Iniciar Sesiòn</h1>
                <div class=" form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                      <input type="number" id="usuario" name="usuario" required="required" class="form-control col-md-7 col-xs-12" placeholder="Usuario" value="<?php echo $usuario;?>">
                    </div>
                </div>
                <div class=" form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <input type="password" id="password" name="password" required="required" class="form-control col-md-7 col-xs-12" value="" placeholder="Contraseña">
                    </div>
                </div>
            <div class="col-md-12">
              <button id="send" type="submit" class="btn btn-success" onclick="Validate()">Entrar</button>
              <!--<a class="reset_pass" href="#">Olvidaste la Contraseña?</a>-->
            </div>
            <div class="clearfix"></div>
            <div class="separator">

             
              <div class="clearfix"></div>
              <br />
              <div>
                <img src="cpanel/images/coordescor.jpeg" width="280px"><br><br>
                <p style="position: fixed;bottom: 10px;margin-left: 37px;">©2016 Todos los derechos Son reservados.</p>
              </div>
            </div>
          </form>
          <!-- form -->
        </section>
        <!-- content -->
      </div>
    </div>
  </div>

</body>
  <script src="cpanel/js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="cpanel/js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="cpanel/js/icheck/icheck.min.js"></script>
  <!-- pace -->
  <script src="cpanel/js/pace/pace.min.js"></script>
  <script src="cpanel/js/custom.js"></script>

  <script src="cpanel/js/select/select2.full.js"></script>
  <!-- form validation -->

  <script src="cpanel/js/validator/validator.js"></script>
  <script>

   
    // initialize the validator function
    validator.message['date'] = 'not a real date';

    // validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
    $('form')
      .on('blur', 'input[required], input.optional, select.required', validator.checkField)
      .on('change', 'select.required', validator.checkField)
      .on('keypress', 'input[required][pattern]', validator.keypress);

    $('.multi.required')
      .on('keyup blur', 'input', function() {
        validator.checkField.apply($(this).siblings().last()[0]);
      });

    // bind the validation to the form submit event
    //$('#send').click('submit');//.prop('disabled', true);

    $('form').submit(function(e) {
      e.preventDefault();
      var submit = true;
      // evaluate the form using generic validaing
      if (!validator.checkAll($(this))) {
        submit = false;
      }

      if (submit)
        this.submit();
      return false;
    });

    /* FOR DEMO ONLY */
    $('#vfields').change(function() {
      $('form').toggleClass('mode2');
    }).prop('checked', false);

    $('#alerts').change(function() {
      validator.defaults.alerts = (this.checked) ? false : true;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);

   function Validate(){
    if($('#usuario').val().length > 4){
        $('#usuario').css('border','1px solid #e0e0e0 ');
      if($('#password').val().length > 4){
        $('#password').css('border','1px solid #e0e0e0');
      }else{
        $('#password').css('border','1px solid #e53935');
      }
    }else{
      $('#usuario').css('border','1px solid #e53935');
    }
   }
  </script>
</html>
