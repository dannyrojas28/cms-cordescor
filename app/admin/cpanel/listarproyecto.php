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
                   PROYECTOS
                </h3>
            </div>
          </div>
          <div class="clearfix"></div>

          <div class="row">
              <div class="x_panel">
                <div class="x_content">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="x_panel">
                          <div class="x_title">
                            <h2>Lista de Nuestros Proyectos</h2>
                            <ul class="nav navbar-right panel_toolbox">
                              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                              </li>
                            </ul>
                            <div class="clearfix"></div>
                          </div>
                          <div class="x_content">

                            <p>Encontraras todos nuestros proyectos, del creado recientemente hasta el primero, podras filtar y ver los estado en que se encuentra el proyecto.</p>

                            <!-- start project list -->
                            <table id="datatable-buttons" class="table table-striped dt projects">
                              <thead>
                                <tr>
                                  <th style="width: 1%">#</th>
                                  <th>Codigo</th>
                                  <th style="width: 20%">Nombre</th>
                                  <th>Imagenes</th>
                                  <th>Progreso</th>
                                  <th>Estado</th>
                                  <th style="width: 20%">Editar</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $query =$ctrSelec->GetProyectos();

                                  if($query != false){
                                      $num = 1;
                                      while ($res = mysqli_fetch_object($query)) {
                                        # code...
                                        if($res->state == "ACTIVO"){
                                          $button = '<a onclick="CodProyecto('.$res->cod.',\'DESACTIVADO\')" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".bf-example-modal-sm"><i class="fa fa-power-off"></i> Desactivar </a>';
                                        }else{
                                          $button = '<a onclick="CodProyecto('.$res->cod.',\'ACTIVO\')" class="btn btn-warning btn-xs" data-toggle="modal" data-target=".bf-example-modal-sm"><i class="fa fa-power-off"></i> Activar </a>';
                                        }
                                        echo '
                                              <tr>
                                                <td>'.$num.'</td>
                                                <td>'.$res->cod.'</td>
                                                <td>
                                                  <a>'.$res->tittle.'</a>
                                                  <br />
                                                  <small>Creado '.$res->date_upload.'</small>
                                                </td>
                                                <td>
                                                  <ul class="list-inline">';
                                                     $query2 =$ctrSelec->GetGalerias($res->cod);
                                                     $i = 0;
                                                     if($query2 != false){
                                                        while ($resT = mysqli_fetch_object($query2)) {
                                                          $i = $i + 1;
                                                          echo '<li>
                                                                  <img src="/cms-cordescor/public/proyectos/imgs/'.$res->cod.'/'.$resT->imagen.'" class="avatar" alt="Avatar">
                                                                </li>';
                                                        }
                                                      }else{
                                                        echo '<li>Sin Imagenes</li>';
                                                      } 
                                                    echo '
                                                  </ul>
                                                </td>
                                                <td class="project_progress">
                                                  <div class="progress progress_sm">
                                                    <div class="progress-bar bg-green" role="progressbar" data-transitiongoal="'.$i.'0"></div>
                                                  </div>
                                                  <small>'.$i.'0% Completo</small>
                                                </td>
                                                <td>'.$res->state.'</td>
                                                <td><center>
                                                  <a href="#" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i> Editar </a>
                                                  '.$button.'
                                                  <a onclick="CodProyecto('.$res->cod.',\'delete\')" class="btn btn-danger btn-xs" data-toggle="modal" data-target=".bs-example-modal-sm"><i class="fa fa-trash-o" ></i> Borrar </a></center>
                                                </td>
                                              </tr>';
                                          $num =  $num + 1;
                                      }
                                  }else{
                                    echo "<h5><center>No hay ningun proyecto</center></h5>";
                                  }

                                ?>
                              </tbody>
                            </table>
                            <!-- end project list -->

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
          Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
        </div>
        <div class="clearfix"></div>
      </footer>
      <!-- /footer content -->
    </div>
  </div>
  <div class="modal fade bs-example-modal-sm" tabindex="-1" id="myModal2" role="dialog" aria-hidden="true">
                  <div class="modal-dialog ">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Borrar Proyecto</h4>
                      </div>
                      <div class="modal-body">
                          <div class="alert alert-success alert-dismissible fade in" role="alert" id="alertsuccessDos" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Se Borro Correctamente</strong>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerterrorDos" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong >Contraseña Incorrecta</strong>
                        </div>
                        <h4>Digita tu contraseña para borrar el proyecto</h4>
                          <div class="item form-group">
                                      <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12">
                                      </div>
                                      <br><br>
                          </div>
                      </div>
                      <div class="modal-footer"><br><br>
                        <center><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" onclick="Borrar()">Borrar</button></center>
                        
                      </div>

                    </div>
                  </div>
                </div>

        <div class="modal fade bf-example-modal-sm" tabindex="-1" id="myModal3" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">

                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <h4 class="modal-title" id="myModalLabel2">Actualizar Estado<h4>
                      </div>
                      <div class="modal-body">
                          <div class="alert alert-success alert-dismissible fade in" role="alert" id="alertsuccessTres" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Se Actualizo</strong>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerterrorTres" style="display:none">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong >Contraseña Incorrecta</strong>
                        </div>
                        <h4>Digita tu contraseña para actualizar el proyecto</h4>
                          <div class="item form-group">
                                      <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="password2" type="password" name="password2" class="form-control col-md-7 col-xs-12">
                                      </div>
                                      <br><br>
                          </div>
                      </div>
                      <div class="modal-footer">
                      <center><button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-warning" onclick="Actualizar()">Actualizar Estado</button></center>
                        
                      </div>

                    </div>
                  </div>
                </div>
<input type="hidden" id="input-selec-file" value="0">
<input type="hidden" id="input-borrar-use" value="0">
<input type="hidden" id="intentos" value="0">
<input type="hidden" id="intentos2" value="0">
<input type="hidden" id="estado" value="0">
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
<script src="js/datatables/jquery.dataTables.min.js"></script>
        <script src="js/datatables/dataTables.bootstrap.js"></script>
        <script src="js/datatables/dataTables.buttons.min.js"></script>
        <script src="js/datatables/buttons.bootstrap.min.js"></script>
        <script src="js/datatables/jszip.min.js"></script>
        <script src="js/datatables/pdfmake.min.js"></script>
        <script src="js/datatables/vfs_fonts.js"></script>
        <script src="js/datatables/buttons.html5.min.js"></script>
        <script src="js/datatables/buttons.print.min.js"></script>
        <script src="js/datatables/dataTables.fixedHeader.min.js"></script>
        <script src="js/datatables/dataTables.keyTable.min.js"></script>
        <script src="js/datatables/dataTables.responsive.min.js"></script>
        <script src="js/datatables/responsive.bootstrap.min.js"></script>
        <script src="js/datatables/dataTables.scroller.min.js"></script>


        <!-- pace -->
        <script src="js/pace/pace.min.js"></script>
        <script>
          var handleDataTableButtons = function() {
              "use strict";
              0 !== $("#datatable-buttons").length && $("#datatable-buttons").DataTable({
                dom: "Bfrtip",
                buttons: [{
                  extend: "copy",
                  className: "btn-sm"
                }, {
                  extend: "csv",
                  className: "btn-sm"
                }, {
                  extend: "excel",
                  className: "btn-sm"
                }, {
                  extend: "pdf",
                  className: "btn-sm"
                }, {
                  extend: "print",
                  className: "btn-sm"
                }],
                responsive: !0
              })
            },
            TableManageButtons = function() {
              "use strict";
              return {
                init: function() {
                  handleDataTableButtons()
                }
              }
            }();
        </script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({
              keys: true
            });
            $('#datatable-responsive').DataTable();
            $('#datatable-scroller').DataTable({
              ajax: "js/datatables/json/scroller-demo.json",
              deferRender: true,
              scrollY: 380,
              scrollCollapse: true,
              scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({
              fixedHeader: true
            });
          });
          TableManageButtons.init();
          </script>
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
      });
    function CodProyecto(cod,estado){
      $('#input-borrar-use').val(cod);
      $('#estado').val(estado);
    }
    function Borrar(){
       var cod   = $('#input-borrar-use').val();
        var pass = $('#password').val();
        console.log(pass);
        var intentos = $('#intentos').val();
        $('#alerterrorDos').css('display','none');
        var data ={'password':pass,'cod':cod};
        console.log(intentos);
        if(intentos <= 4){
          $.ajax({
            data:data,
            type:'POST',
            url:'../../controllers/cpanel/externos/controller_DeleteProyectos.php',
            success:function(data){
              console.log(data);
                if(data == true){
                   $('#alertsuccessDos').css('display','block');
                    setTimeout(function(){
                        window.location.href="listarproyecto.php";
                    },1000);
                }else{  
                  intentos = parseInt(intentos) + 1;
                  $('#intentos').val(intentos);
                  $('#alerterrorDos').css('display','block');
                }
            }
          });
        }else{
          console.log("se bloque");
           $.ajax({
            data:{'bloq':'bloq'},
            type:'POST',
            url:'../../controllers/cpanel/externos/controller_BloquedDataUsers.php',
            success:function(data){
              console.log(data);
              $('#myModal2').modal('hide');
              $('#myModal').modal('show');
               setTimeout(function(){
                        window.location.href="listarproyecto.php";
                    },2000);
            }
          });
        }
    }

    function Actualizar(){
       var cod   = $('#input-borrar-use').val();
        var pass = $('#password2').val();
        var estado = $('#estado').val();
        console.log(pass);
        var intentos = $('#intentos2').val();
        $('#alerterrorTres').css('display','none');
        var data ={'password':pass,'cod':cod,'estado':estado};
        console.log(intentos);
        if(intentos <= 4){
          $.ajax({
            data:data,
            type:'POST',
            url:'../../controllers/cpanel/externos/controller_UpdateProyecto.php',
            success:function(data){
              console.log(data);
                if(data == true){
                   $('#alertsuccessTres').css('display','block');
                    setTimeout(function(){
                        window.location.href="listarproyecto.php";
                    },1000);
                }else{  
                  intentos = parseInt(intentos) + 1;
                  $('#intentos2').val(intentos);
                  $('#alerterrorTres').css('display','block');
                }
            }
          });
        }else{
          console.log("se bloque");
           $.ajax({
            data:{'bloq':'bloq'},
            type:'POST',
            url:'../../controllers/cpanel/externos/controller_BloquedDataUsers.php',
            success:function(data){
              console.log(data);
              $('#myModal3').modal('hide');
              $('#myModal').modal('show');
               setTimeout(function(){
                        window.location.href="listarproyecto.php";
                    },2000);
            }
          });
        }
    }
      </script>
  <!-- /editor -->
</body>

</html>
