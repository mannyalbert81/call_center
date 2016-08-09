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

		if ($estado == 'Guardar') 
		{
	
				$id= $_GET['identificador'];
				$nombre=$_GET['nombre'];
				//aqui va la consulta
				$sql="SELECT usuarios.nombre_usuarios,
						tipo_citaciones.nombre_tipo_citaciones,
						juicios.juicio_referido_titulo_credito,
						citaciones.nombre_persona_recibe_citaciones,
						citaciones.relacion_cliente_citaciones,
						citaciones.fecha_citaciones,
						ciudad.nombre_ciudad,
						clientes.nombres_clientes,
						clientes.identificacion_clientes,
						clientes.direccion_clientes
					FROM citaciones,
						clientes,
						ciudad,
						tipo_citaciones,
						juicios,
						usuarios
					WHERE 
						 ciudad.id_ciudad = citaciones.id_ciudad 
						 AND tipo_citaciones.id_tipo_citaciones = citaciones.id_tipo_citaciones 
						 AND juicios.id_juicios = citaciones.id_juicios 
						 AND juicios.id_clientes = clientes.id_clientes 
						 AND usuarios.id_usuarios = citaciones.id_usuarios
						 AND citaciones.identificador='$id'";
				
				$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/Citaciones/';
	
	            $PHPJasperXML = new PHPJasperXML();
				
				$PHPJasperXML->arrayParameter=array("_sql" => $sql);
				
				$PHPJasperXML->load_xml_file("CitacionesGuardarReport.jrxml");
				
				$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
				
				$PHPJasperXML->outpage("F",$directorio.$nombre.'.pdf');

	
                 echo 'hola';
		

		}

?>

