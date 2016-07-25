<?php


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
		
		if ($estado == 'Guardar') {
	
				$id= $_GET['identificador'];
				$nombre=$_GET['nombre'];
				//aqui va la consulta
				$sql="SELECT entidades.nombre_entidades,
					juicios.juicio_referido_titulo_credito,
					oficios.creado,
					juicios.creado,
					titulo_credito.id_titulo_credito,
					titulo_credito.total,
					clientes.identificacion_clientes,
					clientes.nombres_clientes,
					clientes.direccion_clientes,
					ciudad.nombre_ciudad,
					asignacion_secretarios_view.secretarios,
					asignacion_secretarios_view.impulsores,
					asignacion_secretarios_view.liquidador,
					oficios.numero_oficios
				FROM oficios,
					juicios,
					titulo_credito,
					entidades,
					clientes,
					ciudad,
					asignacion_secretarios_view
				WHERE 
					 oficios.id_juicios = juicios.id_juicios 
					 AND juicios.id_usuarios = asignacion_secretarios_view.id_abogado 
					 AND titulo_credito.id_titulo_credito = juicios.id_titulo_credito 
					 AND entidades.id_entidades = oficios.id_entidades 
					 AND clientes.id_clientes = juicios.id_clientes 
				     AND ciudad.id_ciudad = juicios.id_ciudad
				     AND oficios.identificador='$id'";
				
				$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/Oficios/';
	
	
	
	
				$PHPJasperXML = new PHPJasperXML();
				
				
				$PHPJasperXML->arrayParameter=array("_sql" => $sql);
				
				$PHPJasperXML->load_xml_file("OficiosReport.jrxml");
				
				$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
				
				$PHPJasperXML->outpage("F",$directorio.$nombre.'.pdf');
	

		
		}

?>

