<?php
  include "includes/validate_session.php"; 
  //si la variable name es difernete de vacio quiere decir que se envio el fomrulario con los datos
$error = "";
$true  = "";
require_once "../../../config/Database/conexion_update.php";
    require_once "../../../config/Database/conexion_select.php";
    require_once '../../controllers/cpanel/UpdateController.php';
    require_once '../../controllers/cpanel/SelectController.php';
    require_once '../rec_data.php';

    //instanciamos los objetos de los controladores
    $ctrUpdat = new UpdateController();
    $ctrSelec = new SelectController();
  if(!empty($_POST['firstname'])){
    //incluimos los controladores
    
    $ua=getBrowser();

    //Recibimos las variables
    $firstname = $_POST['firstname'];
    $lastname  = $_POST['lastname'];
    $cedula    = $_POST['cedula'];
    $email     = $_POST['email'];
    $rol       = $_POST['rol'];
    $password  = $_POST['password'];

    
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
          header("location:../bloqued/");
        }
      }
    }

    $log = $ctrSelec->Login($cedula,$password);
    if ($log != false) {
         # code...
        //encriptamos la contraseña del usuario
        $ML = false;
        if ($email != $_SESSION['EMAIL']) {
          # code...
          if ($ctrSelec->ValidateEmail($email) != false ) {
              $error =  "Email Registrado";
              $ML=true;
          }
        }
        if ($ML != true) {
          # code...
        
            if($ctrUpdat->UpdatUser($_SESSION['SESSION'],$firstname,$lastname,$email,$rol) != false){
                  
                if (!empty($_POST['password3'])) {
                  # code...
                  $password2=$_POST['password3'];
                  $ctrUpdat->UpdatPass($_SESSION['SESSION'],$password2);
                }
                $_SESSION['CEDULA']      = $cedula;
                $_SESSION['FIRSTNAME']   = $firstname;
                $_SESSION['LASTNAME']    = $lastname;
                $_SESSION['EMAIL']       = $email;
                $_SESSION['ROL']         = $rol;
                $true = "Se ha actualizado Correctamente";

           }else{
                $error = "No se ha podido Actualizar";
           }
        }
   }else{
      $intentos = $_POST['intentos'] + 1;
      if ($intentos == 5) {
        # code...
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
        header("location:../bloqued/");
      }
       $error ="Contraseña Incorrecta";
   }
  }
 
?>


<!DOCTYPE html>
<html lang="es">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CORDESCOR! | </title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">


  <script src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/notify/pnotify.core.js"></script>
  <script type="text/javascript" src="js/notify/pnotify.buttons.js"></script>
  <script type="text/javascript" src="js/notify/pnotify.nonblock.js"></script>

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

      <?php include "includes/navbar.php"; ?>

      <!-- page content -->
      <div class="right_col" role="main">

        <div class="">
          <div class="page-title">
            <div class="title_left">
              <h3>
                    Informacion Personal
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Perfil </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <form class="form-horizontal form-label-left" novalidate action="perfil.php" method="post">
 <input type="hidden" id="intentos" value="<?php echo $intentos; ?>" name="intentos">
                    <p>Este usuario tendra todos los permisos en el panel de administracion.</a>
                    </p>
                    <span class="section">Mis Datos</span>

                    <?php if(!empty($error)){ ?>
                          <script> new PNotify({
                                title: 'Error',
                                text: '<?php echo $error; ?>',
                                type: 'error',
                                hide: false
                            });
                          </script>
                    <?php  } ?>


                    <?php if(!empty($true)){ ?>
                      <script> new PNotify({
                                title: 'Bien',
                                text: '<?php echo $true; ?>',
                                type: 'success',
                                hide: false
                            });</script>
                    <?php  } ?>
                   
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Nombre <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="firstname" class="form-control col-md-7 col-xs-12" data-validate-length-range="4"  name="firstname" placeholder="" required="required" type="text" value="<?php echo $_SESSION['FIRSTNAME'];?>">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Apellido <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="lastname" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="lastname" placeholder="" required="required" type="text" value="<?php echo $_SESSION['LASTNAME'];?>">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Cedula <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" readonly="true" id="cedula" name="cedula" required="required" data-validate-minmax="10" class="form-control col-md-7 col-xs-12" value="<?php echo $_SESSION['CEDULA'];?>">
                      </div>
                    </div>
                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $_SESSION['EMAIL'];?>">
                      </div>
                    </div>
                    <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rol">Rol <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="rol" name="rol">
                            <?php
                              $query = $ctrSelec->GetRols();
                            while ($rel = mysqli_fetch_object($query)) {
                              # code...
                                if ($_SESSION['ROL'] == $rel->id) {
                                  # code...
                                   echo ' <option value="'.$rel->id.'" selected>'.$rel->descrip.'</option>';
                                }else{
                                  echo ' <option value="'.$rel->id.'">'.$rel->descrip.'</option>';
                                }
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Contraseña</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password" type="password" name="password" data-validate-length="4,8" class="form-control col-md-7 col-xs-12" required="required">
                      </div>
                    </div>
                     <div class="item form-group">
                     <div class="col-md-12 col-sm-12 col-xs-12">
                        <hr>
                     </div>
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password3">Nueva Contraseña</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password3" type="password" name="password3" data-validate-length="4,8" class="form-control col-md-7 col-xs-12" onkeyup="Required()">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Repetir Contraseña</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password2" type="password" name="password2" data-validate-linked="password3" class="form-control col-md-7 col-xs-12" onkeyup="Required()">
                      </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="form-group">
                      <div class="col-md-6 col-md-offset-3">
                        <button id="send" type="submit" class="btn btn-success">Actualizar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
         Cordescor- Panel Administrativo<a href="https://colorlib.com">cordescor.com</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>

  <div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
  </div>



  <script src="js/bootstrap.min.js"></script>

  <!-- bootstrap progress js -->
  <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
  <!-- icheck -->
  <script src="js/icheck/icheck.min.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script src="js/custom.js"></script>

  <script src="js/select/select2.full.js"></script>
  <!-- form validation -->

  <script src="js/validator/validator.js"></script>
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

    function Required(){
      var password2=$('#password2').val();
      var password3=$('#password3').val();
      if(password2.length > 0 || password3.length > 0){
        document.getElementById('password2').required=true;
        document.getElementById('password3').required=true;
        console.log("estan required");
      }else{
         document.getElementById('password2').required=false;
        console.log(" noooooooo estan required");
        document.getElementById('password3').required=false;
      }
    }
  </script> 
<script type="text/javascript">
    var permanotice, tooltip, _alert;
    $(function() {
     

    });
  </script>
</body>

</html>
