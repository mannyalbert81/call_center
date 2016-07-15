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



$id= $_GET['identificador'];
$estado=$_GET['estado'];

//aqui va la consulta
$sql="SELECT
ciudad.nombre_ciudad,
juicios.juicio_referido_titulo_credito,
clientes.nombres_clientes,
documentos.fecha_emision_documentos,
documentos.hora_emision_documentos,
documentos.avoco_vistos_documentos
FROM
public.documentos,
public.ciudad,
public.juicios,
public.clientes
WHERE
ciudad.id_ciudad = documentos.id_ciudad AND
juicios.id_juicios = documentos.id_juicio AND
clientes.id_clientes = juicios.id_clientes AND
documentos.identificador= '$id'";
///por parametro get mandar si estoy visualizando o guardando


///por parametro get mandar si estoy visualizando o guardando

///Visualizar Pdf

if ($estado == 'Visualizar') {
	
	$_dato=unserialize($_GET['dato']);
	
	$dato['id_ciudad']='504';
	$dato['id_juicios']='18';
	$dato['id_estados_procesales_juicios']='4';
	$dato['fecha_emision_documentos']='2016-07-14';
	$dato['hora_emision_documentos']='10:30';
	$dato['detalle_documentos']='lskerlkse';
	$dato['observacion_documentos']='valiste';
	$dato['avoco_vistos_documentos']='qvbvccv';
	$dato['id_usuarios']='41';
	

	
	$PHPJasperXML = new PHPJasperXML ( "en", "TCPDF" );
	$PHPJasperXML->debugsql = false;

    $PHPJasperXML->arrayParameter=$dato;
    
	
	$PHPJasperXML->load_xml_file ( "DocumentosVisualizarReport.jrxml" );
	$PHPJasperXML->transferDBtoArray ( $server, $user, $pass, $db, $driver );
	$PHPJasperXML->outpage ( "I" );


} else {
	
	
	$archivo = 'Providencia'.$id;

	#aqu� va el reporte
	
	$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/Providencias/';
	
	
	$PHPJasperXML = new PHPJasperXML();
	
	
	$PHPJasperXML->arrayParameter=array("_sql" => $sql);
	
	$PHPJasperXML->load_xml_file("DocumentosReport.jrxml");
	
	$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
	
	$PHPJasperXML->outpage("F",$directorio.$archivo.'.pdf');


/*
	 $repositorio="Providencias";
	 $documentos = new  DocumentosModel();

	 $result=$documentos->UpdateBy("ruta_documento='$repositorio',nombre_documento='$archivo'", "documentos", "identificador='$id'");
	 
	 header("location:$helper->url()");
	 
	 print_r($result);
	 */
	 
}

?>

