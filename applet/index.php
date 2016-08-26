<?php


  //comprobamos que los datos POST existen y fueron recibidos correctamente
  if( isset($_POST['name']) and isset($_POST['app'])  
        and isset($_POST['apm'])  and isset($_POST['mail'])  )
  {
   //se colocan los datos en  variables
    $name = $_POST['name'];
    $app = $_POST['app'];
    $apm = $_POST['apm'];
    $mail = $_POST['mail'];
    //con los datos que nos pasa el applet ya pdemos proseguir con el registro en la BD
    // [ interaccion con la base de datos ]
   // ....
    //despues podemos devolver un mensaje al usuario
   $guion="-";
   echo 'GRACIAS POR REGISTRARTE'.$guion;
    echo 'Nombre: '.$name.$guion;
    echo 'Ap. Paterno:'.$app.$guion;
    echo 'Ap. Materno:'.$apm.$guion;
    echo 'Mail:'.$mail.$guion;
    echo $guion;
    echo 'FIN';
  }
  else
  {
  echo "Error: No existen datos";
  }


?>