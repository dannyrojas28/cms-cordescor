<?php

class ConexionInsert {
    
    public function Conectar(){
        $connect = mysqli_connect('127.0.0.1','usuario_insert','','cordescor') 
            or die ("Error ". mysqli_error($connect));
        return $connect;   
    }
    
    public function Ejecutar($sql){
        $connect = $this->Conectar();
        $result = $connect->query($sql);
        return $result;
    }
    
}

?>