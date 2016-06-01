<?php

class EstadosProcesalesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}
	//maycol


	public function index(){
	
		//Creamos el objeto usuario
     	$estados_procesales = new EstadosProcesalesModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$estados_procesales->getAll("id_estados_procesales_juicios");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			$nombre_controladores = "EstadosProcesales";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $estados_procesales->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_estados_procesales_juicios"])   )
				{
					
					$nombre_controladores = "EstadosProcesales";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $estados_procesales->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_estados_procesales_juicios = $_GET["id_estados_procesales_juicios"];
						$columnas = " id_estados_procesales_juicios, nombre_estado_procesal_juicios";
						$tablas   = "estados_procesales_juicios";
						$where    = "id_estados_procesales_juicios = '$_id_estados_procesales_juicios' "; 
						$id       = "nombre_estado_procesal_juicios";
							
						
						$resultEdit = $estados_procesales->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "EstadosProcesales";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_estados_procesales_juicios;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Estados Procesales"
					
						));
					
					
					}
					
				}
		
				
				$this->view("EstadosProcesales",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Estados Procesales"
				
				));
				
				exit();	
			}
				
		}
		else 
		{
				$this->view("ErrorSesion",array(
						"resultSet"=>""
			
				));
		
		}
	
	}
	
	public function InsertaEstadosProcesales(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();

		$estados_procesales = new EstadosProcesalesModel();

		$permisos_rol=new PermisosRolesModel();

		
		$nombre_controladores = "EstadosProcesales";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		$resultPer = $estados_procesales->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
			$estados_procesales = new EstadosProcesalesModel(); 
		
			//_nombre_controladores
			
			if (isset ($_POST["nombre_estado_procesal_juicios"]) )
				
			{
				
				
				
				$_nombre_estado_procesal_juicios = $_POST["nombre_estado_procesal_juicios"];
				
				
				if(isset($_POST["id_estados_procesales_juicios"])) 
				{
					
					$_id_estados_procesales_juicios = $_POST["id_estados_procesales_juicios"];
					
					$colval = " nombre_estado_procesal_juicios = '$_nombre_estado_procesal_juicios'   ";
					$tabla = "estados_procesales_juicios";
					$where = "id_estados_procesales_juicios = '$_id_estados_procesales_juicios'    ";
					
					$resultado=$estados_procesales->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			
				
				$funcion = "ins_estados_procesales_juicios";
				
				$parametros = " '$_nombre_estado_procesal_juicios'  ";
					
				$estados_procesales->setFuncion($funcion);
		
				$estados_procesales->setParametros($parametros);
		
		
				$resultado=$estados_procesales->Insert();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Estados Procesales";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_estado_procesal_juicios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("EstadosProcesales", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Estados Procesales"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "EstadosProcesales";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_estados_procesales_juicios"]))
			{
				$id_estados_procesales_juicios=(int)$_GET["id_estados_procesales_juicios"];
				
				$estados_procesales = new EstadosProcesalesModel();
				
				$estados_procesales->deleteBy(" id_estados_procesales_juicios", $id_estados_procesales_juicios);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Estados Procesales";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_estados_procesales_juicios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("EstadosProcesales", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Estados Procesales"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$roles=new RolesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("Roles",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>