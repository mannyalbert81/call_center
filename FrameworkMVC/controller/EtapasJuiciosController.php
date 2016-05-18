<?php

class EtapasJuiciosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$etapas_juicios = new EtapasJuiciosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$etapas_juicios->getAll("id_etapas_juicios");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			$nombre_controladores = "EtapasJuicios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $etapas_juicios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_etapas_juicios"])   )
				{
					
					$nombre_controladores = "EtapasJuicios";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $etapas_juicios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_etapas_juicios = $_GET["id_etapas_juicios"];
						$columnas = " id_etapas_juicios, nombre_etapas";
						$tablas   = "etapas_juicios";
						$where    = "id_etapas_juicios = '$_id_etapas_juicios' "; 
						$id       = "nombre_etapas";
							
						
						$resultEdit = $etapas_juicios->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Etapas Juicios";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_etapas_juicios;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Etapas Juicios"
					
						));
					
					
					}
					
				}
		
				
				$this->view("EtapasJuicios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Etapas Juicios"
				
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
	
	public function InsertaEtapasJuicios(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();

		$etapas_juicios = new EtapasJuiciosModel(); 

		$permisos_rol=new PermisosRolesModel();

		
		$nombre_controladores = "EtapasJuicios";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		$resultPer = $etapas_juicios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
			$etapas_juicios = new EtapasJuiciosModel(); 
		
			//_nombre_controladores
			
			if (isset ($_POST["nombre_etapas"]) )
				
			{
				
				
				
				$_nombre_etapas = $_POST["nombre_etapas"];
				
				
				if(isset($_POST["id_etapas_juicios"])) 
				{
					
					$_id_etapas_juicios = $_POST["id_etapas_juicios"];
					
					$colval = " nombre_etapas = '$_nombre_etapas'   ";
					$tabla = "etapas_juicios";
					$where = "id_etapas_juicios = '$_id_etapas_juicios'    ";
					
					$resultado=$etapas_juicios->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			
				
				$funcion = "ins_etapas_juicios";
				
				$parametros = " '$_nombre_etapas'  ";
					
				$etapas_juicios->setFuncion($funcion);
		
				$etapas_juicios->setParametros($parametros);
		
		
				$resultado=$etapas_juicios->Insert();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Etapas Juicios";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_etapas;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("EtapasJuicios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Etapas Juicios"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "EtapasJuicios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_etapas_juicios"]))
			{
				$id_etapas_juicios=(int)$_GET["id_etapas_juicios"];
				
				$etapas_juicios = new EtapasJuiciosModel(); 
				
				$etapas_juicios->deleteBy(" id_etapas_juicios", $id_etapas_juicios);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Etapas Juicios";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_etapas_juicios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("EtapasJuicios", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Etapas Juicios"
			
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