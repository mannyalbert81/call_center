	
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
$nombre_clientes=0;
$celular_clientes=0;
$fecha_desde=0;
$fecha_hasta=0;
$sql="";
$detallesql="";



if ($_GET['id_ciudad']!=0)
{
	$id_ciudad=$_GET['id_ciudad'];
	$detallesql=$detallesql." AND ciudad.id_ciudad = '$id_ciudad'";
}
	
	
if ($_GET['identificacion']!="")
{

	$identificacion= $_GET['identificacion'];
	$detallesql=$detallesql." AND clientes.identificacion_clientes = '$identificacion'";
}
	
if ($_GET['nombres_clientes']!="")
{
		
	$nombre_clientes= $_GET['nombres_clientes'];
	$detallesql=$detallesql." AND clientes.nombres_clientes = '$nombre_clientes'";
}
	
if ($_GET['celular_clientes']!="")
{
		
	$celular_clientes= $_GET['celular_clientes'];
	$detallesql=$detallesql." AND clientes.celular_clientes = '$celular_clientes'";
}
	
if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
{
	
	$fecha_desde= $_GET['fecha_desde'];
	$fecha_hasta= $_GET['fecha_hasta'];
	$detallesql=$detallesql." AND  juicios.creado BETWEEN '$fecha_desde' AND '$fecha_hasta'";
}
	
	
	
 $cabeceraSql="select           clientes.id_clientes, 
							  tipo_identificacion.nombre_tipo_identificacion, 
							  clientes.identificacion_clientes, 
							  clientes.nombres_clientes, 
							  clientes.telefono_clientes, 
							  clientes.celular_clientes, 
							  clientes.direccion_clientes, 
							  ciudad.nombre_ciudad, 
							  tipo_persona.nombre_tipo_persona, 
							  clientes.creado

	from	                   public.clientes, 
							  public.ciudad, 
							  public.tipo_persona, 
							  public.tipo_identificacion

	where		    ciudad.id_ciudad = clientes.id_ciudad AND
							  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
							  tipo_identificacion.id_tipo_identificacion = clientes.id_tipo_identificacion";

 
 
 
$sql=$cabeceraSql.$detallesql;

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("ClientesReport.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");



?>


