<?php
$id_firma_electronica="1";
$origen="C:/Users/User/Desktop/coactiva/LIQ-BTEL-JC-GYE-1-2014-PEAB-2019.pdf";
$destino="C:\\Users\\User\\Desktop\\PdfFirmados\\nuevo.pdf";

$comando='start "" /b "C:\Users\User\git\coactiva\php-Csharp\Firmar\FirmadorElectronico.exe" '.$id_firma_electronica.' '.$origen.' '.$destino.' ';

$comando_esc = escapeshellcmd($comando);

exec($comando_esc,$resultadoSalida,$ejecucion);

echo "valor estatus de la aplicacion en C# ".$ejecucion."<br>(0=> la aplicacion se ejecuto exitosamente)<br> (1=>la aplicacion no se ejecuto correctamente ocurrio algun error)<br>";

if(count($resultadoSalida)>0)
{
	echo utf8_encode("<strong> ".$resultadoSalida[0]." </strong>");
}else{
	
}


?>