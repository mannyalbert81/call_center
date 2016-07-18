<?php

#<?php
#Importas la librer�a PhpJasperLibrary
ob_end_clean(); //add this line here

include_once('PhpJasperLibrary/class/tcpdf/tcpdf.php');
include_once("PhpJasperLibrary/class/PHPJasperXML.inc.php");

include_once ('conexion.php');

$server  = server;
$user    = user;
$pass    = pass;
$db      = db;
$driver  = driver;
ini_set('display_errors', 0);
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
$PHPJasperXML->debugsql=false;
#aqu� va el reporte


$id_ciudad=0;
$id_usuarios=0;
$identificacion=0;
$numero_juicio=0;
$fecha_desde=0;
$fecha_hasta=0;
$sql="";
$detallesql="";




if ($_GET['id_ciudad']!=0)
{
	$id_ciudad=$_GET['id_ciudad'];
	$detallesql=$detallesql." AND ciudad.id_ciudad = '$id_ciudad'";
}


if ($_GET['id_usuarios']!=0)
{
		
	$id_usuarios= $_GET['id_usuarios'];
	$detallesql=$detallesql." AND usuarios.id_usuarios = '$id_usuarios'";
}

if ($_GET['identificacion']!="")
{

	$identificacion= $_GET['identificacion'];
	$detallesql=$detallesql." AND clientes.identificacion_clientes = '$identificacion'";
}

if ($_GET['numero_juicio']!="")
{

	$numero_juicio= $_GET['numero_juicio'];
	$detallesql=$detallesql." AND juicios.juicio_referido_titulo_credito = '$numero_juicio'";
}

if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
{

	//$fecha_desde= $_GET['fecha_desde']. " 00:00:27.528-05";
	//$fecha_hasta= $_GET['fecha_hasta']. " 23:59:27.528-05";
	$fecha_desde= $_GET['fecha_desde'];
	$fecha_hasta= $_GET['fecha_hasta'];
	$detallesql=$detallesql." AND  documentos.fecha_emision_documentos BETWEEN '$fecha_desde' AND '$fecha_hasta'";
}



$cabeceraSql="select      documentos.id_documentos, 
								  ciudad.nombre_ciudad, 
								  juicios.juicio_referido_titulo_credito, 
								  clientes.nombres_clientes, 
								  clientes.identificacion_clientes, 
								  estados_procesales_juicios.nombre_estado_procesal_juicios, 
								  documentos.fecha_emision_documentos, 
								  documentos.hora_emision_documentos, 
								  documentos.detalle_documentos, 
								  documentos.observacion_documentos, 
								  documentos.avoco_vistos_documentos, 
								  usuarios.id_usuarios,
							      usuarios.nombre_usuarios, 
								  usuarios.imagen_usuarios

from	public.documentos, 
							  public.ciudad, 
							  public.juicios, 
							  public.usuarios, 
							  public.clientes, 
							  public.estados_procesales_juicios

where		ciudad.id_ciudad = documentos.id_ciudad AND
						  juicios.id_juicios = documentos.id_juicio AND
						  usuarios.id_usuarios = documentos.id_usuario_registra_documentos AND
						  clientes.id_clientes = juicios.id_clientes AND
						  estados_procesales_juicios.id_estados_procesales_juicios = documentos.id_estados_procesales_juicios";


$sql=$cabeceraSql.$detallesql;


$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;

$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("DocumentosGeneralReport.jrxml");
                       
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");



?>


