	
<?php 
#<?php 
#Importas la librer�a PhpJasperLibrary
ob_end_clean(); //add this line here

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

$id_ciudad=0;
$identificacion=0;
$numero_juicio=0;
$numero_titulo=0;
$fecha_desde=0;
$fecha_hasta=0;
$sql="";
$detallesql="";



if ($_GET['id_ciudad']!=0)
{
	$id_ciudad=$_GET['id_ciudad'];
	$detallesql=$detallesql." AND citaciones.id_ciudad = '$id_ciudad'";
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
	
if ($_GET['numero_titulo']!="")
{
		
	$numero_titulo= $_GET['numero_titulo'];
	$detallesql=$detallesql." AND juicios.id_titulo_credito = '$numero_titulo'";
}
	
if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
{
	
	$fecha_desde= $_GET['fecha_desde'];
	$fecha_hasta= $_GET['fecha_hasta'];
	$detallesql=$detallesql." AND  citaciones.creado BETWEEN '$fecha_desde' AND '$fecha_hasta'";
}
	
	
	
 $cabeceraSql="select           citaciones.id_citaciones,
								juicios.id_juicios,
			  					juicios.juicio_referido_titulo_credito,
			 					clientes.nombres_clientes,
			  					clientes.identificacion_clientes,
			  					citaciones.fecha_citaciones,
			  					ciudad.nombre_ciudad,
			  					ciudad.id_ciudad,
			  					tipo_citaciones.id_tipo_citaciones,
			  					tipo_citaciones.nombre_tipo_citaciones,
			  					citaciones.nombre_persona_recibe_citaciones,
			  					citaciones.relacion_cliente_citaciones,
			  					usuarios.nombre_usuarios

	from	                    public.citaciones,
			  					public.juicios,
			  					public.ciudad,
			  					public.tipo_citaciones,
			  					public.usuarios,
			  					public.clientes

	where		    juicios.id_juicios = citaciones.id_juicios AND
  					ciudad.id_ciudad = citaciones.id_ciudad AND
  					tipo_citaciones.id_tipo_citaciones = citaciones.id_tipo_citaciones AND
  					usuarios.id_usuarios = citaciones.id_usuarios AND
  					clientes.id_clientes = juicios.id_clientes";


$sql=$cabeceraSql.$detallesql;

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("CitacionesReport.jrxml");


////$PHPJasperXML = new PHPJasperXML();
////$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");



?>


