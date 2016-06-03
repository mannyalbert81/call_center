<?php 

#Importas la librer�a PhpJasperLibrary
include_once('PhpJasperLibrary/tcpdf/tcpdf.php');
include_once("PhpJasperLibrary/PHPJasperXML.inc.php");
include_once ('conexion.php');  
#Conectas a la base de datos 
$server  = server;
$user    = user;
$pass    = pass;
$db      = db;
$driver  = driver;
ini_set('display_errors', 0);
  
#aqu� va el reporte
$xml =  simplexml_load_file("UsuariosReport.jrxml");
  
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->xml_dismantle($xml); 

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);

$PHPJasperXML->outpage("I");


?>