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


$id=$_GET['id_vehiculos_embargados'];
$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
$PHPJasperXML->arrayParameter=array("_id_vehiculos_embargados"=>$id);
$PHPJasperXML->load_xml_file("VehiculosSubReport.jrxml");


////$PHPJasperXML = new PHPJasperXML();
////$PHPJasperXML->xml_dismantle($xml); 
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");


?>