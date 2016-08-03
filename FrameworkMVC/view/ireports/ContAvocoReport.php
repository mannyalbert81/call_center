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
		    
			$PHPJasperXML->load_xml_file( "AvocoVisualizarReport.jrxml" );
			
			$PHPJasperXML->transferDBtoArray ( $server, $user, $pass, $db, $driver );
			
			$PHPJasperXML->outpage ( "I" );
		
			

	
		} else 
		{
			
			 $id= $_GET['identificador'];
			 $nombre=$_GET['nombre'];
			 //aqui va la consulta
			 $sql="SELECT 
					  avoco_conocimiento.id_avoco_conocimiento, 
					  juicios.juicio_referido_titulo_credito,
					  clientes.nombres_clientes,
					  clientes.identificacion_clientes, 
					  ciudad.nombre_ciudad, 
					  asignacion_secretarios_view.secretarios, 
					  asignacion_secretarios_view.impulsores, 
					  usuarios.nombre_usuarios as secretario_reemplazo,
					  clientes.nonbre_garantes,
					  clientes.identificacion_garantes
					  
					FROM 
					  public.avoco_conocimiento, 
					  public.juicios, 
					  public.ciudad, 
					  public.asignacion_secretarios_view, 
					  public.usuarios,
					  public.clientes
					WHERE 
					  avoco_conocimiento.id_secretario = asignacion_secretarios_view.id_secretario AND
					  avoco_conocimiento.id_impulsor = asignacion_secretarios_view.id_abogado AND
					  avoco_conocimiento.secretario_reemplazo = usuarios.id_usuarios AND
					  juicios.id_juicios = avoco_conocimiento.id_juicios AND
					  ciudad.id_ciudad = avoco_conocimiento.id_ciudad AND
					  juicios.id_clientes = clientes.id_clientes AND
					  avoco_conocimiento.identificador= '$id' ";
			
			 $directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/Avoco/';
			
			 $PHPJasperXML = new PHPJasperXML();
			
			 $PHPJasperXML->arrayParameter=array("_sql" => $sql);
			
			 $PHPJasperXML->load_xml_file("AvocoGuardarReport.jrxml");
			
			
			 $PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
			
			 $PHPJasperXML->outpage("F",$directorio.$nombre.'.pdf');
		
	
           }
           
       

?>

