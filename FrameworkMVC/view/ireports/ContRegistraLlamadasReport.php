	
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
$nombre_usuarios=0;
$identificacion=0;

$fecha_desde=0;
$fecha_hasta=0;

$sql="";
$detallesql="";


if ($_GET['id_ciudad']!="")
{
	$id_ciudad=$_GET['id_ciudad'];
	$detallesql=$detallesql." AND ciudad.id_ciudad = '$id_ciudad'";
}

if ($_GET['id_usuarios']!="")
{

	$nombre_usuarios= $_GET['id_usuarios'];
	$detallesql=$detallesql." AND usuarios.id_usuarios = '$nombre_usuarios'";
}
	
if ($_GET['identificacion_clientes']!="")
{

	$identificacion= $_GET['identificacion_clientes'];
	$detallesql=$detallesql." AND clientes.identificacion_clientes = '$identificacion'";
}
	

	
if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
{
	
	$fecha_desde= $_GET['fecha_desde'];
	$fecha_hasta= $_GET['fecha_hasta'];
	$detallesql=$detallesql." AND  registrar_llamadas.creado BETWEEN '$fecha_desde' AND '$fecha_hasta'";
}
	
	
	
 $cabeceraSql="select         registrar_llamadas.id_registrar_llamadas, 
							  usuarios.nombre_usuarios, 
							  registrar_llamadas.fecha_registrar_llamadas, 
							  registrar_llamadas.hora_registrar_llamadas, 
							  registrar_llamadas.recibio_registrar_llamadas, 
							  registrar_llamadas.persona_contesta_llamada, 
							  registrar_llamadas.observaciones_registra_llamadas, 
							  registrar_llamadas.parentesco_clientes, 
							  registrar_llamadas.creado, 
							  clientes.identificacion_clientes, 
							  clientes.nombres_clientes, 
							  clientes.telefono_clientes, 
							  clientes.celular_clientes, 
							  clientes.direccion_clientes, 
							  ciudad.nombre_ciudad, 
							  clientes.nombre_garantes, 
							  clientes.identificacion_garantes, 
							  clientes.telefono_garantes, 
							  clientes.celular_garantes, 
							  titulo_credito.numero_titulo_credito, 
							  titulo_credito.total_total_titulo_credito, 
							  juicios.juicio_referido_titulo_credito

	from	                   public.ciudad, 
							  public.clientes, 
							  public.usuarios, 
							  public.juicios, 
							  public.titulo_credito, 
							  public.registrar_llamadas
 		
	where		    clientes.id_clientes = titulo_credito.id_clientes AND
				  clientes.id_ciudad = ciudad.id_ciudad AND
				  usuarios.id_usuarios = registrar_llamadas.id_usuario_registra_llamada AND
				  juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
				  registrar_llamadas.id_clientes = clientes.id_clientes ";

 
 
 
$sql=$cabeceraSql.$detallesql;

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("LlamadasReport.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");



?>


