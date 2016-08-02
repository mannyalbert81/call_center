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

$estado=$_GET['estado'];

		if ($estado == 'Visualizar') 
		{
	
			$a=stripslashes($_GET['dato']);
			
			$_dato=urldecode($a);
			
			$_dato=unserialize($a);
			
			
			$PHPJasperXML = new PHPJasperXML ( "en", "TCPDF" );
			
			$PHPJasperXML->debugsql = false;
		
		    $PHPJasperXML->arrayParameter=$_dato;
		    
			$PHPJasperXML->load_xml_file( "AutoPagoJURIDICOCREGARANTEVizualizarReport.jrxml" );
			
			$PHPJasperXML->transferDBtoArray ( $server, $user, $pass, $db, $driver );
			
			$PHPJasperXML->outpage ( "I" );
		
			/* para prueba de llegar datos
			 * 
			$dato['id_ciudad']='504';
			$dato['id_juicios']='18';
			$dato['id_estados_procesales_juicios']='4';
			$dato['fecha_emision_documentos']='2016-07-14';
			$dato['hora_emision_documentos']='10:30';
			$dato['detalle_documentos']='lskerlkse';
			$dato['observacion_documentos']='valiste';
			$dato['avoco_vistos_documentos']='qvbvccv';
			$dato['id_usuarios']='41';
				
			$result=urlencode(serialize($_dato));
			
			header('Location: ' . '/FrameworkMVC/index.php?controller=Controladores&action=verError&dato='.$result);
			*/

	
		} else 
		{
	
				$id= $_GET['identificador'];
				$nombre=$_GET['nombre'];
				//aqui va la consulta
				$sql="SELECT 
				  juicios.juicio_referido_titulo_credito, 
				  juicios.creado, 
				  clientes.nombres_clientes, 
				  clientes.identificacion_clientes, 
				  titulo_credito.total, 
				  asignacion_secretarios_view.secretarios, 
				  asignacion_secretarios_view.impulsores, 
				  asignacion_secretarios_view.liquidador, 
				  auto_pagos.identificador, 
				  titulo_credito.id_titulo_credito, 
				  clientes.nombre_garantes, 
				  clientes.identificacion_garantes
				FROM 
				  public.juicios, 
				  public.titulo_credito, 
				  public.clientes, 
				  public.asignacion_secretarios_view, 
				  public.auto_pagos
				WHERE 
				  juicios.id_usuarios = asignacion_secretarios_view.id_abogado AND
				  titulo_credito.id_titulo_credito = auto_pagos.id_titulo_credito AND
				  clientes.id_clientes = juicios.id_clientes AND
				  clientes.id_clientes = titulo_credito.id_clientes AND
				documentos.identificador= '$id'";
				
				$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/AutoPagos/';
	
	
	
	
				$PHPJasperXML = new PHPJasperXML();
				
				
				$PHPJasperXML->arrayParameter=array("_sql" => $sql);
				
				$PHPJasperXML->load_xml_file("AutoPagoJURIDICOCREGARANTEReport.jrxml");
				
				$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
				
				$PHPJasperXML->outpage("F",$directorio.$nombre.'.pdf');
	

		
		}

?>

