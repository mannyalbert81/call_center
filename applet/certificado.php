<?php

//comprobamos que los datos POST existen y fueron recibidos correctamente
  if( isset($_POST['certificado']) && isset($_POST['mac']))
  {
   //se colocan los datos en  variables
    $datos = $_POST['certificado'];
	
    //despues podemos devolver un mensaje al usuario
   echo 'su registro ha sido un exito';
   
  }
  else
  {
  echo "Error: al registrar Certificado";
  }

  ?>