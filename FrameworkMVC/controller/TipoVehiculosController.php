<?php

class TipoVehiculosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipo_vehiculos= new TipoVehiculosModel(); 
     	
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_vehiculos->getAll("id_tipo_vehiculos");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$tipo_vehiculos= new TipoVehiculosModel();
			//Notificaciones
			$tipo_vehiculos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TipoVehiculos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_vehiculos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_vehiculos"])   )
				{

					$nombre_controladores = "TipoVehiculos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_vehiculos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_vehiculos= $_GET["id_tipo_vehiculos"];
						$columnas = " id_tipo_vehiculos, nombre_tipo_vehiculos";
						$tablas   = "tipo_vehiculos";
						$where    = "id_tipo_vehiculos= '$_id_tipo_vehiculos' "; 
						$id       = "nombre_tipo_vehiculos";
							
						$resultEdit = $tipo_vehiculos->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo Vehiculos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_vehiculos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Vehiculos"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoVehiculos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Vehiculos"
				
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
	
	public function InsertaTipoVehiculos(){
			
		session_start();

		
		$tipo_vehiculos=new TipoVehiculosModel();
		$nombre_controladores = "TipoVehiculos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_vehiculos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_vehiculos=new TipoVehiculosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_vehiculos"]) )
				
			{
				
				
				
				$_nombre_tipo_vehiculos= $_POST["nombre_tipo_vehiculos"];
				
				if(isset($_POST["id_tipo_vehiculos"])) 
				{
					
					$_id_tipo_vehiculos= $_POST["id_tipo_vehiculos"];
					$colval = " nombre_tipo_vehiculos= '$_nombre_tipo_vehiculos'   ";
					$tabla = "tipo_vehiculos";
					$where = "id_tipo_vehiculos= '$_id_tipo_vehiculos'    ";
					
					$resultado=$tipo_vehiculos->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_vehiculos";
				
				$parametros = " '$_nombre_tipo_vehiculos'  ";
					
				$tipo_vehiculos->setFuncion($funcion);
		
				$tipo_vehiculos->setParametros($parametros);
		
		
				$resultado=$tipo_vehiculos->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Vehiculos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_vehiculos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("tipo_vehiculos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de vehiculos"
		
			));
		
		
		}
	

		$tipo_vehiculos=new TipoVehiculosModel();

		$nombre_controladores = "TipoVehiculos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_vehiculos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_vehiculos=new TipoVehiculosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_vehiculos"]) )
				
			{
				$_nombre_tipo_vehiculos= $_POST["nombre_tipo_vehiculos"];
				
				if(isset($_POST["id_tipo_vehiculos"]))
				{
				$_id_tipo_vehiculos= $_POST["id_tipo_vehiculos"];
				$colval = " nombre_tipo_vehiculos= '$_nombre_tipo_vehiculos'   ";
				$tabla = "tipo_vehiculos";
				$where = "id_tipo_identificacion = '$_id_tipo_vehiculos'    ";
					
				$resultado=$tipo_vehiculos->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_vehiculos";
				
				$parametros = " '$_nombre_tipo_vehiculos'  ";
					
				$tipo_vehiculos->setFuncion($funcion);
		
				$tipo_vehiculos->setParametros($parametros);
		
		
				$resultado=$tipo_vehiculos->Insert();
			 }
		
			}
			$this->redirect("TipoVehiculos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de vehiculos"
		
			));
		
		
		}
		
	}




	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Roles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_vehiculos"]))
			{
				$id_tipo_vehiculos=(int)$_GET["id_tipo_vehiculos"];
				
				$tipo_vehiculos=new TipoVehiculosModel();
				
				$tipo_vehiculos->deleteBy(" id_tipo_vehiculos",$id_tipo_vehiculos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Vehiculos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_vehiculos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoVehiculos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Vehiculos"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_vehiculos=new TipoVehiculosModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoVehiculos",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>