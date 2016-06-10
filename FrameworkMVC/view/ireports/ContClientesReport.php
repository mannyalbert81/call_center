<?php 
#<?php 
#Importas la librer�a PhpJasperLibrary
ob_end_clean(); //add this line here

include_once('PhpJasperLibrary/class/tcpdf/tcpdf.php');
include_once("PhpJasperLibrary/class/PHPJasperXML.inc.php");

include_once ('conexion.php');


#Conectas a la base de datos 
$server  = server;
$user    = user;
$pass    = pass;
$db      = db;
$driver  = driver;
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
$PHPJasperXML->debugsql=false;
#aqu� va el reporte

$PHPJasperXML->arrayParameter=array("_id_clientes"=>80);

$xml =  simplexml_load_file("ClientesReport.jrxml");

$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->xml_dismantle($xml); 
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");


?>