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
		    
			$PHPJasperXML->load_xml_file( "AutoPagoVizualizarJURIDICOCREGARANTEReport.jrxml" );
			
			$PHPJasperXML->transferDBtoArray ( $server, $user, $pass, $db, $driver );
			
			$PHPJasperXML->outpage ( "I" );
		
		
	
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
				  auto_pagos.identificador= '$id'";
				
				$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/AutoPagos/';
	
	
				$PHPJasperXML = new PHPJasperXML();
				
				$PHPJasperXML->arrayParameter=array("_sql" => $sql,"identificador"=>$id);
				
				$PHPJasperXML->load_xml_file("AutoPagoJURIDICOCREGARANTEReport.jrxml");
				
				$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
				
				$PHPJasperXML->outpage("F",$directorio.$nombre.'.pdf');

		
		}

?>

