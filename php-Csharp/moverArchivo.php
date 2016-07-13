 <?php
 
 $directorio = $_SERVER['DOCUMENT_ROOT'].'/documentos/';
 
$origen = $directorio."firmados/DocumentoPruebacop.pdf";
$destino = $directorio."/DocumentoPruebacop.pdf";


rename($origen,$destino);
?> 