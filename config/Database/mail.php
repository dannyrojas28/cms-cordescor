<?php

/**
* 
*/
class Mail 
{
  
  function __construct($name,$email)
  {
    // Varios destinatarios
        $para  = $email ;
        // título
        $título = 'Soporte Cordescor';

        // mensaje
        $mensaje = '
        <html>
        <head>
          <title>Cordescor te saluda.</title>
        </head>
        <body>
         <center> 
          <img src="../../public/img/logo-app.png"  style="width:270px;height:170px;" >
           <h1 style="color:#497D55;">Cordescor</h1></center><br>
          <h3>Hola '.$name.' ya resivimos tu peticion, en las proximas horas nuestro equipo se pondra en contacto com tigo.</h3>
          <p>**Execelente semana</p>
          <img src="../../public/img/coordescor.jpeg"  style="width:270px;height:170px;" >
        </body>
        </html>
        ';

        // Para enviar un correo HTML, debe establecerse la cabecera Content-type
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $cabeceras .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        // Cabeceras adicionales
        $cabeceras .= 'From: Cordecor < soporte@cordescor.com>' . "\r\n";
        // Enviarlo
        $mail=mail($para, $título, $mensaje, $cabeceras);
        return $mail;
}

}


?>			