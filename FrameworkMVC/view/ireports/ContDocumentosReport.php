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
#aqu� va el reporte



$juicio="uio-1-2016";
$fecha="14-07-2016-Prueba";
$archivo = 'Providencia'.$juicio.$fecha;

$id= $_GET['identificador'];
$estado=$_GET['estado'];
///por parametro get mandar si estoy visualizando o guardando

///Visualizar Pdf

if ($estado == 'Visualizar') {
/*
	$PHPJasperXML = new PHPJasperXML ( "en", "TCPDF" );
	$PHPJasperXML->debugsql = false;

	$PHPJasperXML->arrayParameter = array (	);

	$PHPJasperXML->xml_dismantle ( $xml );
	$PHPJasperXML->load_xml_file ( "DocumentosVisualizarReport.jrxml" );
	$PHPJasperXML->transferDBtoArray ( $server, $user, $pass, $db, $driver );
	$PHPJasperXML->outpage ( "I" );
*/

} else {

	//header('Location: ' . '/FrameworkMVC/index.php');

	//localizaciondel pdf
	$ruta="Providencias";


	//guardar Pdf
	$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/Providencias/';

	$PHPJasperXML = new PHPJasperXML ();
	// $PHPJasperXML->debugsql=true;
	$PHPJasperXML->arrayParameter = array (
			"_identificador" => $id
	);

	$PHPJasperXML->load_xml_file ( "DocumentosReport.jrxml" );

	$PHPJasperXML->transferDBtoArray ( $server, $user, $pass, $db, $driver );

	$PHPJasperXML->outpage ( "F", $directorio . $archivo . '.pdf' );

	/*
	 $documentos = new  DocumentosModel();

	 $result=$documentos->UpdateBy("ruta_documento='$ruta',nombre_documento='$archivo'", "documentos", "identificador='$id'");*/
}

?>

