<?php

class ConexionSelect {
    
    public function Conectar(){
        $connect = mysqli_connect('127.0.0.1','root','','cordescor') 
            or die ("No hay conexion a la Base de Datos ". mysqli_error($connect));
        return $connect;   
    }
    
    public function Ejecutar($sql){
        $connect = $this->Conectar();
        $result = $connect->query($sql);
        return $result;
    }
    
}

?>