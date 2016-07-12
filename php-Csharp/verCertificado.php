 <?php
/* empezamos comprobando si la petición se hizo en modo seguro o no. La variable de entorno HTTPS recoge es condición.
   Si estamos en modo seguro recogerá en la variable cert el valor transferido en la peticion
   y en caso contrario leería el fichero de ejemplo que tenemos en el directorio cursophp y al que se accede en modo no seguro */

if (getenv('HTTPS')=='on'){
   $cert=$_SERVER['SSL_CLIENT_CERT'];
 }else{
   $f = fopen("juan_certificado.cer", "r");
 $cert = fread($f, 8192);
 fclose($f);
 }

/* Extraemos los datos del certificado usando nombres cortos para los índices */

 $datos = openssl_x509_parse($cert,0);
?>
<table style='border-width:2px;border-style:solid;border-color:#eeeeee;padding:2px;font-family:Arial;font-size:10px;text-align:left;' align='center'>
<tr><td align="center" width="200">Indices del array de datos</td><td align="center" >Valores del array</td></tr>
<?php
/* recogemos en variables los estilos aplicables a cada tipo de fila o celda de la tabla de resultados
   con el ánimo de agregar un poco de legibilidad al código */
$estilo1="<tr style='font-size:12px;background-color:#dddddd'><td style='text-align:right;color:#ff0000'>['";
$estilo2="']</td><td><span style='color:#0000ff'>";
$estilo3="</td></tr>\r\n";
$estilo21="<tr style='font-size:11px;background-color:#cccccc'><td style='text-align:right;color:#ff0000'>['";
$estilo22="']['";
$estilo23="']</td><td style='color:#0000ff'>";
$estilo31= "<tr style='font-size:10px;background-color:#eeeeee'><td style='text-align:right;color:#ff0000'>['";

/* como el array de datos contiene valores unidimensionales, bidimensionales y tridimensionales vamos extrayendo los valores imprimiendo aquello que no son array y agregando un bucle foreach al resultado en el caso de serlo */
foreach ($datos as $c1=>$v1){
     if (!is_array($v1)){
             print $estilo1.$c1.$estilo2.$v1.$estilo3;
     }else{
             foreach ($datos[$c1] as $c2=>$v2){
                  if (!is_array($v2)){
                        print $estilo21.$c1.$estilo22.$c2.$estilo23.$v2.$estilo3;
                  }else{
                        foreach ($datos[$c1][$c2] as $c3=>$v3){
                            print$estilo31.$c1.$estilo22.$c2.$estilo22.$c3.$estilo23.$v3.$estilo3;
                        }
                  }
             }

     }

}
print "</table>" ;
?> 