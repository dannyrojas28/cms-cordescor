<?php
session_start();
if(empty($_SESSION['SESSION'])){
	header("location:../");
}else{
	require_once "../../../config/Database/conexion_select.php";
    require_once '../../controllers/cpanel/SelectController.php';
    $ctrSelec = new SelectController();


    $query = $ctrSelec->GetState($_SESSION['SESSION']);
    if($query != false){
	    while ($row = mysqli_fetch_object($query)) {
	    	# code...
	    	if($row->state == "BLOQUEADO"){
	    		$_['SESSION'] = "";
		        $_SESSION['CEDULA']  = "";
		        $_SESSION['NAMES']   = "";
		        $_SESSION['EMAIL']   = "";
		        $_SESSION['ROL']     = "";
		        echo '<div class="modal fade bs-example-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
					  <div class="modal-dialog modal-sm">
					    <div class="modal-content">
					      	
					      	 
					      	 <div class="modal-header">
						        <h4 class="modal-title" id="myModalLabel">BLOQUEADO</h4>
						      </div>
						     <div class="modal-body">
						       		<center><h5>Has sido bloqueado por nuestro sistema</h5></center>
	      					</div>
					    	<div class="modal-footer">
					       				<a type="button" class="btn btn-primary"  href="../">Aceptar</a>
					      	</div>
					      </div>
					  </div>
					</div> <input type="hidden" value="1" id="bloq" >';
		        session_destroy();
	    	}else{
	    		 echo '<input type="hidden" value="0" id="bloq" >';
	    	}
	    }
	}else{
		$_['SESSION'] = "";
		$_SESSION['CEDULA']  = "";
		$_SESSION['NAMES']   = "";
		$_SESSION['EMAIL']   = "";
		$_SESSION['ROL']     = "";
		session_destroy();
		header("location:../");
	}
}

?>