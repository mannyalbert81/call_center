<?php

class SeguimientoGastosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		
		//creamos el array de busqueda
		$resulMenu=array(0=>'Todos',1=>'Numero Juicio', 2=>'Numero Titulo', 3=>'Tipo Gastos' , 4=>'Gastos Por');
	
		//Creamos el objeto usuario
		$distribucion_gastos = new DistribucionGastosModel();
		$trazas = new TrazasModel();
		$usuarios=new UsuariosModel();
		$ciudad = new CiudadModel();
		$resultCiudad= $ciudad->getAll("nombre_ciudad");
		//Conseguimos todos los usuarios
		$resultSet="";
	
		$columnas = "trazas.id_trazas, usuarios.usuario_usuarios, trazas.nombre_controlador, trazas.accion_trazas, trazas.parametros_trazas, trazas.creado";
		$tablas="public.trazas, public.usuarios";
		$where="usuarios.id_usuarios = trazas.id_usuarios";
		$id="creado";
		$resultActi=$trazas->getCondiciones($columnas ,$tablas , $where, $id);
		$resultActi=null;
		
		
		//$resultEdit = "";
	
		$resultEdit = "";
		session_start();
	
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$distribucion_gastos = new DistribucionGastosModel();
			//Notificaciones
			$distribucion_gastos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
	
			$nombre_controladores = "SeguimientoGastos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $distribucion_gastos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
	
				
				if(isset($_POST["Buscar"]) )
				{
					$id_ciudad=$_POST['id_ciudad'];
					$numero_juicio=$_POST['numero_juicio'];
					$titulo_credito=$_POST['numero_titulo'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
					
					$columnas="distribucion_gastos.id_distribucion_gastos, 
							  titulo_credito.id_titulo_credito, 
							  juicios.juicio_referido_titulo_credito, 
							  distribucion_gastos.creado, 
							  tipo_gastos.nombre_tipo_gastos, 
							  distribucion_gastos.descripcion_distribucion_gastos, 
							  estado.nombre_estado, 
							  tipo_gastos.valor_tipo_gasto,juicios.id_ciudad";
					$tablas="public.clientes, 
							  public.distribucion_gastos, 
							  public.juicios, 
							  public.oficios, 
							  public.estado, 
							  public.titulo_credito, 
							  public.tipo_gastos,
							  public.ciudad";
					$where="clientes.id_clientes = juicios.id_clientes AND
							  distribucion_gastos.id_oficios = oficios.id_oficios AND
							  juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
							  oficios.id_juicios = juicios.id_juicios AND
							  estado.id_estado = distribucion_gastos.id_estado AND
							  tipo_gastos.id_tipo_gastos = distribucion_gastos.id_tipo_gastos
							AND ciudad.id_ciudad = juicios.id_ciudad ";
					$id="distribucion_gastos.id_distribucion_gastos";
					
					
					
					$where_0="";
					$where_1="";
					$where_2="";
					$where_3="";
					$where_4="";
						
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
						
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
						
					if($titulo_credito!=""){$where_2=" AND titulo_credito.id_titulo_credito='$titulo_credito'";}
						
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  distribucion_gastos.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
						
						
					$where_to=$where.$where_0.$where_1.$where_2.$where_3.$where_4;
						
					$resultSet=$distribucion_gastos->getCondiciones($columnas, $tablas, $where_to,$id);
					
					
				
				}
				else{
					
					
					
				}
				
	
	
				$this->view("SeguimientoGastos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultActi" =>$resultActi,"resulMenu"=>$resulMenu,"resultCiudad"=>$resultCiudad
							
				));
	
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Seguimiento de Gastos"
	
				));
	
				
			}
	
		}
		else
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
			));
	
		}
	
	}
	
}
?>