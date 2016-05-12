<html>
<head>
   <style type="text/css">
      #btnexaminar {display:none}
   </style>
</head>
<body>
<form action="upload.php" method="post" enctype="multipart/form-data">
  <input name="archivo" type="file" id="btnexaminar" class="oculto" size="35" />
  <img src="imagen.png" alt="Boton Examinar" onClick="document.getElementById('btnexaminar').click(); "/>
  <input name="archivo" type="file" size="35" />
  <input name="enviar" type="submit" value="Subir" />
  <input name="action" type="hidden" value="upload" />     
</form>
</body>
</html>