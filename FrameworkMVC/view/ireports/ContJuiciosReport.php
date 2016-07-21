	
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
$titulo_credito=0;
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
	
if ($_GET['numero_juicio']!="")
{
		
	$numero_juicio= $_GET['numero_juicio'];
	$detallesql=$detallesql." AND juicios.juicio_referido_titulo_credito = '$numero_juicio'";
}
	
if ($_GET['numero_titulo']!="")
{
		
	$titulo_credito= $_GET['numero_titulo'];
	$detallesql=$detallesql." AND juicios.id_titulo_credito = '$titulo_credito'";
}
	
if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
{
	
	$fecha_desde= $_GET['fecha_desde'];
	$fecha_hasta= $_GET['fecha_hasta'];
	$detallesql=$detallesql." AND  juicios.creado BETWEEN '$fecha_desde' AND '$fecha_hasta'";
}
	
	
	
 $cabeceraSql="select           juicios.id_juicios,
					clientes.id_clientes,
  					clientes.nombres_clientes, 
  					clientes.identificacion_clientes, 
  					ciudad.nombre_ciudad, 
  					tipo_persona.nombre_tipo_persona, 
  					juicios.juicio_referido_titulo_credito, 
  					asignacion_secretarios_view.impulsores,
  					asignacion_secretarios_view.secretarios,
					titulo_credito.id_titulo_credito, 
  					etapas_juicios.nombre_etapas, 
  					tipo_juicios.nombre_tipo_juicios, 
  					juicios.creado, 
  					titulo_credito.total

	from	                    public.clientes, 
					  public.ciudad, 
					  public.tipo_persona, 
					  public.juicios, 
					  public.titulo_credito, 
					  public.etapas_juicios, 
					  public.tipo_juicios,
					  public.asignacion_secretarios_view

	where		    ciudad.id_ciudad = clientes.id_ciudad AND
					  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
					  juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
					  juicios.id_clientes = clientes.id_clientes AND
					  juicios.id_tipo_juicios = tipo_juicios.id_tipo_juicios AND
					  etapas_juicios.id_etapas_juicios = juicios.id_etapas_juicios AND
					  juicios.id_usuarios= asignacion_secretarios_view.id_abogado";

 
 
 
$sql=$cabeceraSql.$detallesql;

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("JuiciosReport.jrxml");

$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");



?>


