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



$juicio="uio-1-2016";
$fecha="14-07-2016_guardar";
$archivo = 'Providencia'.$juicio.$fecha;

$id= $_GET['id_juicio'];
$estado=$_GET['estado'];
///por parametro get mandar si estoy visualizando o guardando

///Visualizar Pdf

if ($estado == 'Visualizar') {
	
	$PHPJasperXML = new PHPJasperXML ( "en", "TCPDF" );
	$PHPJasperXML->debugsql = false;
	
	$PHPJasperXML->arrayParameter = array (
			
			"_id_juicios" => $id 
	);
	
	$PHPJasperXML->xml_dismantle ( $xml );
	$PHPJasperXML->load_xml_file ( "DocumentosReport.jrxml" );
	$PHPJasperXML->transferDBtoArray ( $server, $user, $pass, $db, $driver );
	$PHPJasperXML->outpage ( "I" );

} else 

if ($estado == 'Guardar') {
	
	//guardar Pdf
	
	$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/Providencias/';
	$PHPJasperXML = new PHPJasperXML ();
	// $PHPJasperXML->debugsql=true;
	$PHPJasperXML->arrayParameter = array (
			"_id_juicios" => $id 
	);
	$PHPJasperXML->load_xml_file ( "DocumentosReport.jrxml" );
	
	$PHPJasperXML->transferDBtoArray ( $server, $user, $pass, $db, $driver );
	
	$PHPJasperXML->outpage ( "F", $directorio . $archivo . '.pdf' );
}

?>

