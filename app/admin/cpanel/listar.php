<?php
  include "includes/validate_session.php"; 

    require_once "../../../config/Database/conexion_select.php";
    require_once '../../controllers/cpanel/SelectController.php';
    
    $ctrSelec = new SelectController();
    
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Cordescor</title>

  <!-- Bootstrap core CSS -->

  <link href="css/bootstrap.min.css" rel="stylesheet">

  <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animate.min.css" rel="stylesheet">

  <!-- Custom styling plus plugins -->
  <link href="css/custom.css" rel="stylesheet">
  <link href="css/icheck/flat/green.css" rel="stylesheet">

  <link href="js/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/buttons.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/fixedHeader.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="js/datatables/scroller.bootstrap.min.css" rel="stylesheet" type="text/css" />

  <script src="js/jquery.min.js"></script>
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
                    Usuarios Administrativos
                </h3>
            </div>

          </div>
          <div class="clearfix"></div>

          <div class="row">

            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="x_panel">
                <div class="x_title">
                  <h2>Nuestros usuarios</small></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                  
                  <table id="datatable-buttons" class="table table-striped table-bordered dt responsive">
                    <thead>
                      <tr style="font-size:14px;">
                        <th>Nombres</th>
                        <th>Cedula</th>
                        <th>Email</th>
                        <th>Rol</th>
                        <th>Ultima Entrada</th>
                        <th>Estado</th>
                        <th>Navegador</th>
                        <th>Version</th>
                        <th>S.O</th>
                        <th></th>
                      </tr>
                    </thead>


                    <tbody>
                      <?php
                        $res = $ctrSelec->GetUsers();
                        while ($row = mysqli_fetch_object($res)) {
                          # code...
                            echo '<tr style="font-size:15px;">
                                      <td>'.$row->firstname.' '.$row->lastname.'</td>
                                      <td>'.$row->cedula.'</td>
                                      <td>'.$row->email.'</td>
                                      <td>'.$row->descrip.'</td>
                                      <td>'.$row->last_entry.'</td>
                                      <td>'.$row->state.'</td>
                                      <td>'.$row->browser.'</td>
                                      <td>'.$row->version.'</td>
                                      <td>'.$row->platform.'</td>
                                      <td><i class="fa fa-eye " data-toggle="modal" data-target="#MyModalDos" data-whatever="@mdo" onclick="VerUser('.$row->cod.')"></i></td>
                                  </tr>';
                        }

                      ?>
                  </table>
                </div>
              </div>
            </div

            

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

        <div id="custom_notifications" class="custom-notifications dsp_none">
          <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
          </ul>
          <div class="clearfix"></div>
          <div id="notif-group" class="tabbed_notifications"></div>
        </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="MyModalDos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">Datos del usuario</h4>
      </div>
      <div class="modal-body">
       <div class="x_content" id="formul">

                 
      </div>
      <div class="x_content" id="validar_delete" style="display: none">
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
          <p>Digita tu clave por seguridad</p>
          <div class="item form-group">
                      <label for="password2" class="control-label col-md-3 col-sm-3 col-xs-12">Contraseña</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="password" type="password" name="password" class="form-control col-md-7 col-xs-12">
                      </div>
          </div>
          <input type="hidden" id="intentos" name="intentos" value="1">
          <input type="hidden" id="cod_delet" name="cod_delet">
          <div class="col-xs-12 col-md-12">
            <center><br>
              <p>Seguro deseas borrarlo ?</p>
              <button type="button" class="btn btn-default" onclick="CancelDelete()">Atras</button>
              <button type="button" class="btn btn-danger" onclick="DeleteUser()">Validar y Borrar</button>
            </center>
          </div>
          
          
                    
        
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
        <style type="text/css">
            .right{
              float: right;
            }
        </style>
        <script src="js/bootstrap.min.js"></script>

        <!-- bootstrap progress js -->
        <script src="js/progressbar/bootstrap-progressbar.min.js"></script>
        <!-- icheck -->
        <script src="js/icheck/icheck.min.js"></script>

        <script src="js/custom.js"></script>


        <!-- Datatables -->
        <!-- <script src="js/datatables/js/jquery.dataTables.js"></script>
  <script src="js/datatables/tools/js/dataTables.tableTools.js"></script> -->

        <!-- Datatables-->
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

          function VerUser(cod){
            $('#formul').css('display','block');
          $('#validar_delete').css('display','none');
            $.ajax({
                data:{'cod':cod},
                type:"post",
                url:"../../controllers/cpanel/externos/controller_showDataUsers.php",
                success:function(data){
                  console.log(data);
                  $('#formul').html(data);
                   /* var print = JSON.parse(data);
                    $('#firstname').val(print.firstname);
                    $('#lastname').val(print.lastname);
                    $('#cedula').val(print.cedula);
                    $('#email').val(print.email);
                    $('#rol').val(print.rol);
                    $('#estado').val(print.estado);*/
                }
            });
          }
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

    //ACTUALIZAR DATOS DEL USUARIO
      function UpdateDatos(){
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var password2 = $('#password2').val();
        var password3 = $('#password3').val();
         $('#alertsuccess').css('display','none'); 
         $('#alerterror').css('display','none');
        if(firstname.length > 4){
          $('#firstname').css('border','1px solid #e0e0e0');
          if(lastname.length > 4){
               $('#lastname').css('border','1px solid #e0e0e0');
              if(email.length > 4){
                   $('#email').css('border','1px solid #e0e0e0');
                   var hj = true;
                   if(password2.length > 0 || password3.length > 0){
                    if(password2 == password3){
                      $('#password2').css('border','1px solid #e0e0e0');
                      hj = true;
                      $('#error_pass').css('display','none');

                    }else{
                      $('#password2').css('border','1px solid #e53935');
                      $('#error_pass').css('display','block');
                      hj = false;
                    }
                   }

                   if(hj == true){
                     var formData= new FormData(document.forms.namedItem("formUpdate"));
                      $.ajax({
                          data:formData,
                          type:'POST',
                          url:'../../controllers/cpanel/externos/controller_UpdateDataUsers.php',
                          cache: false,
                          contentType: false,
                           processData: false,
                          success:function(data){
                              if (data == true){
                                  $('#alertsuccess').css('display','block');
                                  setTimeout(function(){
                                      window.location.href="listar.php";
                                  },1000);
                              }else{
                                  $('#alerterror').css('display','block');
                                  $('#errorss').html(data);
                              }
                          }
                      });                   
                    }
              }else{
                $('#email').css('border','1px solid #e53935');
              }
          }else{
            $('#lastname').css('border','1px solid #e53935');
          }
        }else{
          $('#firstname').css('border','1px solid #e53935');
        }
      }


      function Delete(cod){
          $('#formul').css('display','none');
          $('#validar_delete').css('display','block');
          $('#cod_delet').val(cod);
      }

      function CancelDelete(){
          $('#formul').css('display','block');
          $('#validar_delete').css('display','none');
      }

    function DeleteUser(){
        var cod = $('#cod_delet').val();
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
            url:'../../controllers/cpanel/externos/controller_DeleteDataUsers.php',
            success:function(data){
              console.log(data);
                if(data == true){
                   $('#alertsuccessDos').css('display','block');
                    setTimeout(function(){
                        window.location.href="listar.php";
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
              $('#MyModalDos').modal('hide');
              $('#myModal').modal('show');
               setTimeout(function(){
                        window.location.href="listar.php";
                    },2000);
            }
          });
        }
    }

        </script>
</body>

</html>
