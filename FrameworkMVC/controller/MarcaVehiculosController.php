<?php

class MarcaVehiculosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$marca_vehiculos= new MarcaVehiculosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$marca_vehiculos->getAll("id_marca_vehiculos");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$marca_vehiculos=new MarcaVehiculosModel();
			//Notificaciones
			$marca_vehiculos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "MarcaVehiculos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $marca_vehiculos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_marca_vehiculos"])   )
				{

					$nombre_controladores = "MarcaVehiculos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $marca_vehiculos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_marca_vehiculos= $_GET["id_marca_vehiculos"];
						$columnas = " id_marca_vehiculos, nombre_marca_vehiculos";
						$tablas   = "marca_vehiculos";
						$where    = "id_marca_vehiculos= '$_id_marca_vehiculos' "; 
						$id       = "nombre_marca_vehiculos";
							
						$resultEdit = $marca_vehiculos->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Marca Vehiculos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_marca_vehiculos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Marca Vehiculos"
					
						));
					
					
					}
					
				}
		
				
				$this->view("MarcaVehiculos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Marca Vehiculos"
				
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
	
	public function InsertaMarcaVehiculos(){
			
		session_start();

		
		$marca_vehiculos=new MarcaVehiculosModel();
		$nombre_controladores = "MarcaVehiculos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $marca_vehiculos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$marca_vehiculos=new MarcaVehiculosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_marca_vehiculos"]) )
				
			{
				
				
				
				$_nombre_marca_vehiculos= $_POST["nombre_marca_vehiculos"];
				
				if(isset($_POST["id_marca_vehiculos"])) 
				{
					
					$_id_marca_vehiculos= $_POST["id_marca_vehiculos"];
					$colval = " nombre_marca_vehiculos= '$_nombre_marca_vehiculos'   ";
					$tabla = "marca_vehiculos";
					$where = "id_marca_vehiculos= '$_id_marca_vehiculos'    ";
					
					$resultado=$marca_vehiculos->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_marca_vehiculos";
				
				$parametros = " '$_nombre_marca_vehiculos'  ";
					
				$marca_vehiculos->setFuncion($funcion);
		
				$marca_vehiculos->setParametros($parametros);
		
		
				$resultado=$marca_vehiculos->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Marca Vehiculos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_marca_vehiculos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("marca_vehiculos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de marca vehiculos"
		
			));
		
		
		}
	

		$marca_vehiculos=new MarcaVehiculosModel();

		$nombre_controladores = "MarcaVehiculos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $marca_vehiculos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$marca_vehiculos=new MarcaVehiculosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_marca_vehiculos"]) )
				
			{
				$_nombre_marca_vehiculos= $_POST["nombre_marca_vehiculos"];
				
				if(isset($_POST["id_marca_vehiculos"]))
				{
				$_id_marca_vehiculos= $_POST["id_marca_vehiculos"];
				$colval = " nombre_marca_vehiculos= '$_nombre_marca_vehiculos'   ";
				$tabla = "marca_vehiculos";
				$where = "id_marca_vehiculos= '$_id_marca_vehiculos'    ";
					
				$resultado=$marca_vehiculos->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_marca_vehiculos";
				
				$parametros = " '$_nombre_marca_vehiculos'  ";
					
				$marca_vehiculos->setFuncion($funcion);
		
				$marca_vehiculos->setParametros($parametros);
		
		
				$resultado=$marca_vehiculos->Insert();
			 }
		
			}
			$this->redirect("MarcaVehiculos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de marca vehiculos"
		
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
			if(isset($_GET["id_marca_vehiculos"]))
			{
				$id_marca_vehiculos=(int)$_GET["id_marca_vehiculos"];
				
				$marca_vehiculos=new MarcaVehiculosModel();
				
				$marca_vehiculos->deleteBy(" id_marca_vehiculos",$id_marca_vehiculos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Marca Vehiculos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_marca_vehiculos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("MarcaVehiculos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Marca Vehiculos"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$marca_vehiculos=new MarcaVehiculosModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("MarcaVehiculos",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>