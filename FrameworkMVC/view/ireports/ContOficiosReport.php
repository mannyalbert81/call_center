	
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


$id_usuarios=0;
$identificacion=0;
$numero_juicio=0;
$numero_oficios=0;
$fecha_desde=0;
$fecha_hasta=0;
$sql="";
$detallesql="";



if ($_GET['id_usuarios']!=0)
{
	$id_usuarios=$_GET['id_usuarios'];
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
	
if ($_GET['numero_oficios']!="")
{
		
	$numero_oficios= $_GET['numero_oficios'];
	$detallesql=$detallesql." AND oficios.numero_oficios = '$numero_oficios'";
}
	
if ($_GET['fecha_desde']!="" && $_GET['fecha_hasta']!="")
{
	
	$fecha_desde= $_GET['fecha_desde'];
	$fecha_hasta= $_GET['fecha_hasta'];
	$detallesql=$detallesql." AND  oficios.creado BETWEEN '$fecha_desde' AND '$fecha_hasta'";
}
	
	
	
 $cabeceraSql="select           oficios.id_oficios,
					oficios.creado,
					oficios.numero_oficios,
					juicios.id_juicios,
					juicios.juicio_referido_titulo_credito,
					juicios.id_titulo_credito,
					clientes.nombres_clientes,
					clientes.identificacion_clientes,
					entidades.id_entidades,
					entidades.nombre_entidades,
 		             entidades.nombre_entidades,
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

	from	                    public.oficios,
					public.juicios,
					public.entidades,
					public.clientes,
					public.usuarios,
 		            public.ciudad,
 		            public.titulo_credito,
 		            public.asignacion_secretarios_view

	where		    juicios.id_juicios = oficios.id_juicios AND
					entidades.id_entidades = oficios.id_entidades AND
					clientes.id_clientes = juicios.id_clientes AND usuarios.id_usuarios = oficios.id_usuario_registra_oficios
 					 AND juicios.id_usuarios = asignacion_secretarios_view.id_abogado
 						AND titulo_credito.id_titulo_credito = juicios.id_titulo_credito AND ciudad.id_ciudad = juicios.id_ciudad";

 
 
 
$sql=$cabeceraSql.$detallesql;

$PHPJasperXML = new PHPJasperXML("en","TCPDF");
$PHPJasperXML->debugsql=false;
//$PHPJasperXML->arrayParameter=array("_id_entidades"=>$id_entidades, "_id_tipo_operaciones"=>$id_tipo_operaciones, "_id_tipo_contenido_cartones"=>$id_tipo_contenido_cartones, "_numero_cartones"=>$numero_cartones);
$PHPJasperXML->arrayParameter=array("sql"=>$sql);
$PHPJasperXML->load_xml_file("OficiosReport.jrxml");


////$PHPJasperXML = new PHPJasperXML();
////$PHPJasperXML->xml_dismantle($xml);
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db, $driver);
$PHPJasperXML->outpage("I");



?>


