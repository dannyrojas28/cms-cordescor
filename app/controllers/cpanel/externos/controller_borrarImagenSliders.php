<?php
	
    require_once "../../../../config/Database/conexion_delete.php";
    require_once '../DeleteController.php';


    $ctrDelet = new DeleteController();

    $image = $_POST['image'];

    $ctrDelet->DeleteSliders($image);
    unlink('../../../../public/img/sliders/'.$image);
    echo true;
?>