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

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
$PHPJasperXML->debugsql=false;
#aqu� va el reporte

//UHU
$id=$_GET['identificador'];

//se crea el identificador
$id = 'report001';

$documentos = new DocumentosModel();




$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
$PHPJasperXML->arrayParameter=array("_identificador"=>$id);
$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->load_xml_file("PruebaDocumentosReport.jrxml");
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");


$directorio = $_SERVER['DOCUMENT_ROOT'].'/documentos/Providencias/';
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("_identificador"=>$id);
$PHPJasperXML->load_xml_file("PruebaDocumentosReport.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);

$juicio="uio-1-2016";
$fecha="13-07-2016";
$archivo = 'Providencia'.$juicio.$fecha;

$PHPJasperXML->outpage("F",$archivo.'.pdf');

?>
