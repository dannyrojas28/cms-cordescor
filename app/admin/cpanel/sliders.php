
<?php
  include "includes/validate_session.php"; 
  //si la variable name es difernete de vacio quiere decir que se envio el fomrulario con los datos
$error = "";
$true  = "";
	require_once "../../../config/Database/conexion_update.php";
    require_once "../../../config/Database/conexion_select.php";
    require_once "../../../config/Database/conexion_insert.php";
    require_once '../../controllers/cpanel/InsertController.php';
    require_once '../../controllers/cpanel/UpdateController.php';
    require_once '../../controllers/cpanel/SelectController.php';

    //instanciamos los objetos de los controladores
    $ctrUpdat = new UpdateController();
    $ctrSelec = new SelectController();
    $ctrInser = new InsertController();
    $numActivos = mysqli_num_rows($ctrSelec->GetSlidersActive());
  	if(!empty($_FILES['file-input']['name'])){
	    //Recibimos las variables
	    $image = $_FILES['file-input']['name'];
	   	 $validarImagenSliders = $ctrSelec->ValidarImagenSliders($image);
	    if ($validarImagenSliders == false) {
	      	$nameimage=$image;
	   	}else{
	   		$nameimage = time().$image; 
	   }
	   $archivo='../../../public/img/sliders/'.$nameimage;
	   if(move_uploaded_file($_FILES['file-input']['tmp_name'],$archivo)){
        if($numActivos < $ctrSelec->numSliders){
          $state = "ACTIVA";
        }else{
          $state = "DESACTIVADA";
        }
	   	  $ctrInser->postSliders($nameimage,$state);
	   	  $true = "Se Subio Correctamente";
	   }else{
	   	$error ="No se ha podido Subir";
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
                    Logo de la Pagina Web
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
                  <h2>Editar o Cargar Sliders </h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                	 <div class="" role="tabpanel" data-example-id="togglable-tabs">
                    <ul id="myTab1" class="nav nav-tabs bar_tabs right" role="tablist">
                       <li role="presentation" class="active"><a href="#tab_content11" id="home-tabb" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Sliders</a>
                      </li>
                       <li role="presentation" class=""><a href="#tab_content22" role="tab" id="profile-tabb" data-toggle="tab" aria-controls="profile" aria-expanded="false">Editar</a>
                      </li>
                      <li role="presentation" class=""><a href="#tab_content33" role="tab" id="profile-tabb3" data-toggle="tab" aria-controls="profile" aria-expanded="false">Cargar</a>
                      </li>

                      </li>
                    </ul>

                    <div id="myTabContent2" class="tab-content">
                    <div role="tabpanel" class="tab-pane fade active in" id="tab_content11" aria-labelledby="home-tab">
                      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                            
                              
                            <?php
                                $slidersActive = $ctrSelec->GetSlidersActive();
                                if($slidersActive != false){
                                  $j = 0;
                                  $indicator = '<ol class="carousel-indicators">';
                                  $wrapper = '<div class="carousel-inner" role="listbox">';
                                  while ($res = mysqli_fetch_object($slidersActive)){
                                    # code...
                                    if($j == 0){
                                       $indicator = $indicator.'<li data-target="#carousel-example-generic" data-slide-to="'.$j.'" class="active"></li>';
                                       $wrapper = $wrapper . '<div class="item active">
                                                                  <img src="/cms-cordescor/public/img/sliders/'.$res->url.'" alt="">
                                                                  <div class="carousel-caption">
                                                                  </div>
                                                                </div>';
                                    }else{
                                       $indicator = $indicator .'<li data-target="#carousel-example-generic" data-slide-to="'.$j.'"></li>';
                                        $wrapper = $wrapper .  '<div class="item">
                                                              <img src="/cms-cordescor/public/img/sliders/'.$res->url.'" alt="">
                                                              <div class="carousel-caption">
                                                              </div>
                                                            </div>';
                                    }
                                    $j = $j + 1;
                                  }
                                  echo $indicator."</ol>".$wrapper.'</div>';
                                }else{
                                  echo "<center>No hay Galeria de Sliders..</center>";
                                }
                            ?>
                            <!-- Controls -->
                            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                              <span class="sr-only">Previous</span>
                            </a>
                            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                              <span class="sr-only">Next</span>
                            </a>
                          </div>
                    </div>
                     <div role="tabpanel" class="tab-pane fade" id="tab_content22" aria-labelledby="profile-tab">
                        <p>Imagenes Subidas para logos</p>
                        <?php
                        	$sliders = $ctrSelec->GetSliders();
                        	if($sliders != false){
                            $o = 0;
                        		while ($res = mysqli_fetch_object($sliders)) {
                        			# code...
                            
                             if ($o == 0) {
                                if ($res->state != 'ACTIVA') {
                                  echo "<div class='col-md-12 col-xs-12 col-sm-12'><h5>Imagenes Desactivadas</h5><hr></div>";
                                  $o="424";
                                }
                            }
                        			echo '<div class="col-md-55">
						                      <div class="thumbnail" style="height:230px">
						                        <div class="image view view-first">
						                          <img style="width: 100%; display: block;" src="/cms-cordescor/public/img/sliders/'.$res->url.'" alt="image" />
						                        </div>
						                        <div class="caption">
						                          <p><strong>IMAGEN '.$res->state.'</strong></p>
						                          ';
                                      
    						                          if ($res->state != 'ACTIVA') {
                                            
                                            echo '<a class="btn btn-app btn-danger" style="float:right;min-width:60px;height:50px;" onclick="BorrarImagenSliders(\''.$res->url.'\')">
                                                    <i class="fa fa-trash"></i> Borrar
                                                  </a><a class="btn btn-app btn-success" style="float:left;min-width:60px;height:50px;" onclick="UpdateStateImagenSliders(\''.$res->url.'\',\'ACTIVAR\')">
                                                    <i class="fa fa-check-square"></i> Activar
                                                  </a>';
    					                    			     
    						                          }else{
                                            if ($numActivos > 2) {
                                                echo '<a class="btn btn-app btn-danger" style="float:right;min-width:60px;height:50px;" onclick="UpdateStateImagenSliders(\''.$res->url.'\',\'DESACTIVAR\')">
                                                    <i class="fa fa-power-off"></i> Desactivar
                                                  </a>';
                                            }
                                          }
					                     echo '
						                        </div>
						                      </div>
						                    </div>';
                        		}
                        	}else{
                        		echo "<center>No hay Galeria de Sliders..</center>";
                        	}

                        ?>
                      </div>
                      <div role="tabpanel" class="tab-pane fade text-center" id="tab_content33" aria-labelledby="profile-tab">
                      	 <form class="form-horizontal form-label-left" novalidate name="formUpdate" enctype="multipart/form-data" method="post" action="sliders.php">
    	                        <p>Subir foto</p>
    	                        <center>
    	                        <div style="width: 700px;height: 342px;text-align: center;" >
                  								<img id="imgSalida" width="100%" height="100%" src="" /><br><br>
                  								<img id="imgSalidaDos" style="display: none" src="" /><br><br>
    	                        </div></center><br><br>
    	                        	<p>Recuerda que las dimensiones del logo son de 1600 * 882</p>
    	                        <div class="item form-group">
    			                      <label class="control-label col-md-4 col-sm-4 col-xs-12" for="firstname">
                                  <span class="required"></span>
    			                      </label>
    			                      <div class="col-md-4 col-sm-4 col-xs-6">
    			                        <input id="file-input" class="btn btn-success form-control col-md-4 col-xs-6" style="color:#26B99A" name="file-input" required="required" type="file">
    			                      </div>
    			                   </div>
    							           <br />
    							           <button type="submit" class="btn btn-primary right" >Subir Foto</button>
	                      </form>
                      </div>
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
    $('.carousel').carousel();
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
      if(imagen.width() == 1600 && imagen.height() == 882 ){
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

	function BorrarImagenSliders(name){
		console.log(name);
		$.ajax({
			data:{'image':name},
			type:'POST',
			url:'../../controllers/cpanel/externos/controller_borrarImagenSliders.php',
			success:function(data){
				console.log(data);
				window.location.href="sliders.php";
			}
		});
	}
  function UpdateStateImagenSliders(name,state){
    console.log(name);
    $.ajax({
      data:{'image':name,'state':state},
      type:'POST',
      url:'../../controllers/cpanel/externos/controller_UpdateStateImagenSliders.php',
      success:function(data){
        console.log(data);
        if(data == true){
          window.location.href="sliders.php";
        }else{
          new PNotify({
                title: 'Error',
                text: data,
                type: 'error',
                hide: false
            });
        }
      }
    });
  }
</script>

</script>
</body>

</html>
