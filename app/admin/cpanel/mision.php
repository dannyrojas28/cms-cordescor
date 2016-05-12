
<?php
  include "includes/validate_session.php"; 
  //si la variable name es difernete de vacio quiere decir que se envio el fomrulario con los datos
$error = "";
$true  = "";
  require_once "../../../config/Database/conexion_update.php";
    require_once "../../../config/Database/conexion_select.php";
    require_once '../../controllers/cpanel/UpdateController.php';
    require_once '../../controllers/cpanel/SelectController.php';

    //instanciamos los objetos de los controladores
    $ctrUpdat = new UpdateController();
    $ctrSelec = new SelectController();
    if(!empty($_POST['text'])){
     
      $text = $_POST['text'];
      if($ctrUpdat->updNosotros($text,'Mision')){
        $true = "Se Actualizo Correctamente";
      }else{
        $error = "No se ha podido Actualizar";
      }
    }

    $text  = $ctrSelec->GetNosotros('Mision');
 
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
  <script src="js/jquery.filestyle.js"></script>
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
                   Misiòn
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>
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
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Editar Texto</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="x_panel">
                <div class="x_title">
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">

                  <!-- start form for validation -->
                  <form id="demo-form" data-parsley-validate action="mision.php" method="post">
                        <label for="text">Text (Minimo 40 caracteres, Maximo 300 caracteres) :</label>
                        <textarea id="text" required="required" class="form-control" name="text" data-parsley-trigger="keyup" onkeyup="ValidateText()" data-parsley-minlength="40" data-parsley-maxlength="300" data-parsley-minlength-message=""
                          data-parsley-validation-threshold="0"  rows="10"><?php echo $text; ?></textarea>
                          <p style="color:#d32f2f;display: none" id="text-error">El texto debe tener maximo 300 caracteres y minimo 40.</p>
                        <br/>
                        <button class="btn btn-primary" type="submit" id="Actualizar">Actualizar Texto</button>

                  </form>
                  <!-- end form for validations -->

                </div>
              </div>
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

   
  </script>
<script type="text/javascript" language="javascript">
$(window).load(function(){


 $(function() {
  $('#file-input').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input').val('');
      }
     });
  
     function fileOnload(e) {
      var result=e.target.result;
      $('#imgSalida').attr("src",result);
      $('#imgSalidaDos').attr("src",result);
      var imagen = $('#imgSalidaDos');
      if(imagen.width() == 400 && imagen.height() == 242 ){
          new PNotify({
                title: 'Bien',
                text: 'Esta imagen esta perfecta',
                type: 'success',
                hide: false
            });
      }else{
        $('#file-input').val('');
        new PNotify({
                title: 'Error',
                text: 'Las dimensiones de la imagen tienen que ser de 400*242',
                type: 'error',
                hide: false
            });
      }
        
     }  
    });
  });
function ValidateText(){
  var text = $('#text').val();
  if(text.length < 40 || text.length > 300){
      $('#text-error').css('display','block');
      $('#text').css('border', '1px solid #d32f2f');
      document.getElementById("Actualizar").disabled = true; 
  }else{
      $('#text-error').css('display','none');
      $('#text').css('border', '1px solid #616161');
       document.getElementById("Actualizar").disabled = false; 
  }
}
</script>

</script>
</body>

</html>
