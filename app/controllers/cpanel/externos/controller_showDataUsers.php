<?php
	
	require_once "../../../../config/Database/conexion_select.php";
    require_once '../SelectController.php';

    $ctrSelec = new SelectController();

    $cod = $_POST['cod'];

    $query = $ctrSelec->ShowUser($cod);

    while ($res = mysqli_fetch_object($query)) {
    	# code...
    	//$post = array('firstname' => $res->firstname,'lastname' => $res->lastname,'cedula'=>$res->cedula,'email' => $res->email,'rol'=>$res->descrip,'estado'=>$res->state);



    		echo '  <div class="alert alert-success alert-dismissible fade in" role="alert" id="alertsuccess" style="display:none">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                      </button>
                      <strong>Se ha actualizado Correctamente</strong>
                    </div>
                     <div class="alert alert-danger alert-dismissible fade in" role="alert" id="alerterror" style="display:none">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                        <strong id="errorss"></strong>
                      </div>

                    <form class="form-horizontal form-label-left" novalidate name="formUpdate" enctype="multipart/form-data">
                    <p>Este usuario tendra todos los permisos en el panel de administracion.</a>
                    </p>
                    <input type="hidden" value="'.$cod.'" id="cod" name="cod">
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="firstname">Nombre <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="firstname" class="form-control col-md-7 col-xs-12" data-validate-length-range="4"  name="firstname" placeholder="" required="required" type="text" value="'.$res->firstname.'">
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lastname">Apellido <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="lastname" class="form-control col-md-7 col-xs-12" data-validate-length-range="4" name="lastname" placeholder="" required="required" type="text" value="'.$res->lastname.'" >
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cedula">Cedula <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="number" readonly="true" id="cedula" name="cedula" required="required" data-validate-minmax="10" class="form-control col-md-7 col-xs-12" value="'.$res->cedula.'">
                      </div>
                    </div>
                     <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="hidden" id="emailhidden" name="emailhidden" value="'.$res->email.'" >
                        <input type="email" id="email" name="email" required="required" class="form-control col-md-7 col-xs-12" value="'.$res->email.'">
                      </div>
                    </div>
                    <div class="form-group">
                     <label class="control-label col-md-3 col-sm-3 col-xs-12" for="rol">Rol <span class="required">*</span>
                      </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                        <select class="form-control" id="rol" name="rol">';
                            
                              $query = $ctrSelec->GetRols();
                            while ($rel = mysqli_fetch_object($query)) {
                              # code...
                                if ($res->descrip == $rel->id) {
                                  # code...
                                   echo ' <option value="'.$rel->id.'" selected>'.$rel->descrip.'</option>';
                                }else{
                                  echo ' <option value="'.$rel->id.'">'.$rel->descrip.'</option>';
                                }
                            }
                           
                     echo '</select>
                      </div>
                    </div>
                    <div class="item form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="password">Estado</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                      		 <select class="form-control" id="estado" name="estado">';
                            
                            	if($res->state == "BLOQUEADO"){
                            		echo '<option value="BLOQUEADO">BLOQUEADO</option>
                                      <option value="ACTIVO">ACTIVAR</option>';
                            	}else{
                            		echo '<option value="ACTIVO" selected>ACTIVO</option>
                            			  <option value="BLOQUEADO">BLOQUEAR</option>';
                            	}
                    echo '</select></div>
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
                        <p style="color:#e53935;display:none" id="error_pass">Las Contraseñas no coinciden</p>
                      </div>
                    </div>
                    
                    <div class="ln_solid"></div>
                      <button type="button" class="btn btn-danger" onclick="Delete('.$cod.')">Borrar Usuario</button>

                        <button type="button" class="btn btn-default right" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary right" onclick="UpdateDatos()">Guardar</button>
                  </form>';
    }

   // echo json_encode($post);