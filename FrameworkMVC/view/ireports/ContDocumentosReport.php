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
$id=$_GET['id_documentos'];

$Documentos = new DocumentosModel();
$resultado = $Documentos->UpdateBy($colval,$tabla, $where);

//nombre del pdf
$juicio="uio-1-2016";
$fecha="13-07-2016";
$archivo = 'Providencia'.$juicio.$fecha;

//visualizar

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
$PHPJasperXML->arrayParameter=array("_id_documentos"=>$id);
$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->load_xml_file("DocumentosReport.jrxml");
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");

//descargar en repositorio
$directorio = $_SERVER['DOCUMENT_ROOT'].'/documentos/Providencias/';
$PHPJasperXML = new PHPJasperXML();
$PHPJasperXML->arrayParameter=array();
$PHPJasperXML->load_xml_file("DocumentosReport.jrxml");
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("F",$directorio. $archivo.'.pdf'); //page output method I:standard output D:Download file, F =save as filename and submit 2nd parameter as destinate file name /$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file
?>
