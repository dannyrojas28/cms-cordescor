<?php
  include "includes/validate_session.php"; 
  //si la variable name es difernete de vacio quiere decir que se envio el fomrulario con los datos
$error = "";
$true  = "";
   require_once "../../../config/Database/conexion_insert.php";
    require_once "../../../config/Database/conexion_select.php";
    require_once '../../controllers/cpanel/InsertController.php';
    require_once '../../controllers/cpanel/SelectController.php';
     //instanciamos los objetos de los controladores
    $ctrInser = new InsertController(); 
    $ctrSelec = new SelectController();
    if(!empty($_POST['tittle'])){
      //incluimos los controladores
        $tittle = $_POST['tittle'];
        $descripcion_small = $_POST['descripcion'];
        $descripcion_large = $_POST['descripcion2'];
        $id=time();
        $nameimage = $id.$_FILES['file-input1']['name'];
        mkdir("../../../public/proyectos/imgs/".$id, 0700);
        $archivo='../../../public/proyectos/imgs/'.$id.'/'.$nameimage;
         if(move_uploaded_file($_FILES['file-input1']['tmp_name'],$archivo)){
            $ctrInser->postProyectos($id,$tittle,$descripcion_small,$descripcion_large,$nameimage);
            for($i= 2 ; $i <= 11;$i++){
                if(!empty($_FILES['file-input'.$i]['name'])){
                    $nameimage = $id.$i.$_FILES['file-input'.$i]['name'];
                    $archivo='../../../public/proyectos/imgs/'.$id.'/'.$nameimage;
                     if(move_uploaded_file($_FILES['file-input'.$i]['tmp_name'],$archivo)){
                        $true = "Se Subio Correctamente";
                        $ctrInser->postGaleria($id,$nameimage);
                      }else{
                         $error ="No se ha podido Subir la imagen de galeria #".$i;
                      }
                }
            }
            $true = "Se Subio Correctamente";
         }else{
          $error ="No se ha podido Subir la imagen principal del proyecto";
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

  <title>CORDESCOR! | </title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">
  <!-- editor -->
  <link href="css/editor/external/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="css/editor/index.css" rel="stylesheet">
  <!-- select2 -->
  <link href="css/select/select2.min.css" rel="stylesheet">
  <!-- switchery -->
  <link rel="stylesheet" href="css/switchery/switchery.min.css" />

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
                   Nuevo Proyecto
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Informacion del proyecto</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                      <!-- start form for validation -->
                      <form id="demo-form" data-parsley-validate action="nuevoproyecto.php" method="post" enctype="multipart/form-data" name="demoform">
                          <div class="col-md-offset-3 col-md-6">
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
                                      });
                                  </script>
                                <?php  } ?>
                            <label for="fullname">Titulo del Proyecto * :</label>
                            <input type="text" id="tittle" class="form-control" name="tittle" required />
                            <label for="descripcion">Descripcion Corta (30 Caracteres minimo, 100 maximo) :</label>
                                <textarea id="descripcion" required="required" class="form-control" name="descripcion" data-parsley-trigger="keyup" data-parsley-minlength="30" data-parsley-maxlength="100" data-parsley-minlength-message="Es necesario introducir al menos 30 caracteres" data-parsley-maxlength-message="Reduce tu descripcion, solo aceptamos hasta 100 caracteres!"
                                  data-parsley-validation-threshold="10" ></textarea>
                              <label for="descripcion2">Informacion del Proyecto (80 Caracteres minimo, 500 maximo) :</label>
                                <textarea id="descripcion2" required="required" class="form-control" name="descripcion2" data-parsley-trigger="keyup" data-parsley-minlength="80" data-parsley-maxlength="500" data-parsley-minlength-message="Es necesario introducir al menos 80 caracteres" data-parsley-maxlength-message="Reduce tu descripcion, solo aceptamos hasta 500 caracteres!"
                                  data-parsley-validation-threshold="10" rows="9"></textarea>
                                <br/>
                                 <label>Imagen Principal del Poyecto, Dimensiones 600*450</label>
                                  <center> 
                                    <div  style="width: 280px;height: 210px;position: relative;overflow: hidden;display: inline-block;" id="imgpro">
                                      
                                        <img id="imgSalida1" width="100%" height="100%" src="" alt="
                                        Seleccionar Imagen" />
                                        <img id="imgSalidaDos1" style="display: none" src="" /><br><br>
                                        <input type="file" id="file-input1" name="file-input1" multiple style="position: absolute;top: 0;right: 0;margin: 0;opacity: 0;-ms-filter: 'alpha(opacity=0)';font-size: 200px !important;direction: ltr;cursor: pointer;" required class="form-control" >
                                      </div>
                                      <p id="textpro" style="display: none;color:#E85445;">Seleccione una Imagen</p>
                                </center>
                              </div>
                              <div class="col-md-12"><br><br>
                                <label>Galeria del Proyeto, Dimensiones 600*450</label>
                                  <div id="in">
                                     <input type="text" id="galeriasinput" name="galeriasinput" multiple style="position: absolute;top: 0;right: 0;margin: 0;opacity: 0;-ms-filter: 'alpha(opacity=0)';font-size: 200px !important;direction: ltr;cursor: pointer;" required class="form-control" data-parsley-id="778" >
                                     <p id="textgal" style="display: none;color:#E85445;">Debes Seleccionar almenos 2 imagenes</p>
                                   </div>
                                <hr>
                              </div>
                              <?php
                              $j=1;
                                for ($i=2; $i <= 11; $i++) { 
                                  # code...
                                  $j = $j + 1;
                                  echo'<div class="col-md-3">
                                    <center> 
                                    <div  style="width: 100%;height: 210px;position: relative;overflow: hidden;display: inline-block;">
                                      
                                        <img id="imgSalida'.$i.'" width="100%" height="100%" src="" alt="
                                        Seleccionar Imagen" />
                                        <img id="imgSalidaDos'.$i.'" style="display: none" src="" /><br><br>
                                            <input type="file" id="file-input'.$i.'" name="file-input'.$i.'" multiple style="position: absolute;top: 0;right: 0;margin: 0;opacity: 0;-ms-filter: \'alpha(opacity=0)\';font-size: 200px !important;direction: ltr;cursor: pointer;"  >
                                          </div>
                                    </center>
                                  </div>';
                                  
                                  if($j == 5){
                                    echo '<div class="col-md-12"><br><hr></div>';
                                    $j=1;
                                  }
                                }
                              ?>


                                     
                           <div class="col-md-12"><br><br>
                                <center> 
                                    <button type="submit" onclick="EnviarFormulario()" class="btn btn-primary" >Subir Proyecto</button>
                                </center>
                            </div>

                      </form>
                      <!-- end form for validations -->
                </div>
              </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!-- footer content -->
      <footer>
        <div class="pull-right">
          Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>
<input type="hidden" id="input-selec-file" value="0">
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
  <!-- tags -->
  <script src="js/tags/jquery.tagsinput.min.js"></script>
  <!-- switchery -->
  <script src="js/switchery/switchery.min.js"></script>
  <!-- daterangepicker -->
  <script type="text/javascript" src="js/moment/moment.min.js"></script>
  <script type="text/javascript" src="js/datepicker/daterangepicker.js"></script>
  <!-- richtext editor -->
  <script src="js/editor/bootstrap-wysiwyg.js"></script>
  <script src="js/editor/external/jquery.hotkeys.js"></script>
  <script src="js/editor/external/google-code-prettify/prettify.js"></script>
  <!-- select2 -->
  <script src="js/select/select2.full.js"></script>
  <!-- form validation -->
  <script type="text/javascript" src="js/parsley/parsley.min.js"></script>
  <!-- textarea resize -->
  <script src="js/textarea/autosize.min.js"></script>
  <script>
    autosize($('.resizable_textarea'));
  </script>
  <!-- Autocomplete -->
  <script type="text/javascript" src="js/autocomplete/countries.js"></script>
  <script src="js/autocomplete/jquery.autocomplete.js"></script>
  <!-- pace -->
  <script src="js/pace/pace.min.js"></script>
  <script type="text/javascript">
    $(function() {
      'use strict';
      var countriesArray = $.map(countries, function(value, key) {
        return {
          value: value,
          data: key
        };
      });
      // Initialize autocomplete with custom appendTo:
      $('#autocomplete-custom-append').autocomplete({
        lookup: countriesArray,
        appendTo: '#autocomplete-container'
      });
    });
  </script>
  <script src="js/custom.js"></script>


  <!-- select2 -->
  <script>
    $(document).ready(function() {
      $(".select2_single").select2({
        placeholder: "Select a state",
        allowClear: true
      });
      $(".select2_group").select2({});
      $(".select2_multiple").select2({
        maximumSelectionLength: 4,
        placeholder: "With Max Selection limit 4",
        allowClear: true
      });
    });
  </script>
  <!-- /select2 -->
  <!-- input tags -->
  <script>
    function onAddTag(tag) {
      alert("Added a tag: " + tag);
    }

    function onRemoveTag(tag) {
      alert("Removed a tag: " + tag);
    }

    function onChangeTag(input, tag) {
      alert("Changed a tag: " + tag);
    }

    $(function() {
      $('#tags_1').tagsInput({
        width: 'auto'
      });
    });
  </script>
  <!-- /input tags -->
  <!-- form validation -->
  <script type="text/javascript">
    $(document).ready(function() {
      $.listen('parsley:field:validate', function() {
        validateFront();
      });
      $('#demo-form .btn').on('click', function() {
        $('#demo-form').parsley().validate();
        validateFront();
      });
      var validateFront = function() {
        if (true === $('#demo-form').parsley().isValid()) {
          $('.bs-callout-info').removeClass('hidden');
          $('.bs-callout-warning').addClass('hidden');
        } else {
          $('.bs-callout-info').addClass('hidden');
          $('.bs-callout-warning').removeClass('hidden');
        }
      };
    });

   
    try {
      hljs.initHighlightingOnLoad();
    } catch (err) {}
  </script>
  <!-- /form validation -->
  <!-- editor -->
  <script>
    $(document).ready(function() {
        $('.xcxc').click(function() {
        $('#descr').val($('#editor').html());
      });
    });

    $(function() {
      function initToolbarBootstrapBindings() {
        var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'
          ],
          fontTarget = $('[title=Font]').siblings('.dropdown-menu');
        $.each(fonts, function(idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
        });
        $('a[title]').tooltip({
          container: 'body'
        });
        $('.dropdown-menu input').click(function() {
            return false;
          })
          .change(function() {
            $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
          })
          .keydown('esc', function() {
            this.value = '';
            $(this).change();
          });

        $('[data-role=magic-overlay]').each(function() {
          var overlay = $(this),
            target = $(overlay.data('target'));
          overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
        });
        if ("onwebkitspeechchange" in document.createElement("input")) {
          var editorOffset = $('#editor').offset();
          $('#voiceBtn').css('position', 'absolute').offset({
            top: editorOffset.top,
            left: editorOffset.left + $('#editor').innerWidth() - 35
          });
        } else {
          $('#voiceBtn').hide();
        }
      };

      function showErrorAlert(reason, detail) {
        var msg = '';
        if (reason === 'unsupported-file-type') {
          msg = "Unsupported format " + detail;
        } else {
          console.log("error uploading file", reason, detail);
        }
        $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
          '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
      };
      initToolbarBootstrapBindings();
      $('#editor').wysiwyg({
        fileUploadError: showErrorAlert
      });
      window.prettyPrint && prettyPrint();
    });


  $('#file-input1').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);
          $('#input-selec-file').val(1);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input1').val('');
      }
     });
  
     function fileOnload(e) {
     var result=e.target.result;
      var i = $('#input-selec-file').val();
      $('#imgSalida'+i).attr("src",result);
      $('#imgSalidaDos'+i).attr("src",result);
      var imagen = $('#imgSalidaDos'+i);
      if(imagen.width() == 600 && imagen.height() == 450 ){
          new PNotify({
                title: 'Bien',
                text: 'Esta imagen esta perfecta',
                type: 'success',
                hide: false
            });
      }else{
        $('#file-input'+i).val('');
        $('#imgSalida'+i).attr("src",'');
        $('#imgSalidaDos'+i).attr("src",'');
        new PNotify({
                title: 'Error',
                text: 'Las dimensiones de la imagen tienen que ser de 600*450',
                type: 'error',
                hide: false
            });
      }
        
        
     }  
    
   $('#file-input2').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(2);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input2').val('');
      }
     });
    $('#file-input3').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(3);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input3').val('');
      }
     });
     $('#file-input4').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(4);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input4').val('');
      }
     });
      $('#file-input5').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(5);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input5').val('');
      }
     });
       $('#file-input6').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(6);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input6').val('');
      }
     });
        $('#file-input7').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(7);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input7').val('');
      }
     });
         $('#file-input8').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(8);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input8').val('');
      }
     });
          $('#file-input9').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(9);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input9').val('');
      }
     });
           $('#file-input10').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(10);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input10').val('');
      }
     });
        
           $('#file-input11').change(function(e) {
      var file = e.target.files[0],
      imageType = /image.*/;
      if (file.type.match(imageType)){
          var reader = new FileReader();
          reader.onload = fileOnload;
          reader.readAsDataURL(file);

          $('#input-selec-file').val(11);
      }else{
        new PNotify({
                title: 'Error',
                text: 'Solo se pueden subir Imagenes',
                type: 'error',
                hide: false
            });
            $('#file-input11').val('');
      }
     });

           function EnviarFormulario(){
             if($('#file-input1').val().length == 0){
                $('#imgpro').css('background','#FAEDEC');
                $('#textpro').css('display','block');
                $('#imgpro').css('border','1px solid #E85445');
                $('#textpro').css('display','block');
             }else{
                $('#imgpro').css('background','#FFF');
                $('#textpro').css('display','none');
                $('#imgpro').css('border','1px solid #000');
             }
             var sum = 0;
             for (var i=2; i <= 11; i++) {
                if($('#file-input'+i).val().length > 0){
                  sum = parseInt(sum) + 1;
                }
                if(i == 11){
                  if (sum >= 2){
                    $('#galeriasinput').val('2736gj');
                    $('#textgal').css('display','none');
                  }else{
                    $('#galeriasinput').val('');
                    $('#textgal').css('display','block');
                  }
                }
             }
           }
  </script>
  <!-- /editor -->
</body>
<style type="text/css">
  #in .parsley-errors-list{
    display: none
  }
</style>
</html>
