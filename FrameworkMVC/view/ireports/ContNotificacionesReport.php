<?php

#<?php
#Importas la librer�a PhpJasperLibrary
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

#aqu� va el reporte

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->load_xml_file("NotificacionesReport.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I") 
?>
