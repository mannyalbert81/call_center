<?php

class VehiculosEmbargadosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$vehiculos_embargados= new VehiculosEmbargadosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$vehiculos_embargados->getAll("id_vehiculos_embargados");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "VehiculosEmbargados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $vehiculos_embargados->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_vehiculos_embargados"])   )
				{

					$nombre_controladores = "VehiculosEmbargados";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $vehiculos_embargados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_identificacion = $_GET["id_vehiculos_embargados"];
						$columnas = " id_vehiculos_embargados, observaciones_vehiculos_embargados, placa_vehiculos_embargados ,modelo_vehiculos_embargados";
						$tablas   = "vehiculos_embargados";
						$where    = "id_vehiculos_embargados= '$_id_vehiculos_embargados' "; 
						$id       = "observaciones_vehiculos_embargados";
							
						$resultEdit = $vehiculos_embargados->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "VehiculosEmbargados";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_vehiculos_embargados;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de vehiculos embargados"
					
						));
					
					
					}
					
				}
		
				
				$this->view("VehiculosEmbargados",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Vehiculos Embargados"
				
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
	
	public function InsertaVehiculosEmbargados(){
			
		session_start();

		
		$vehiculos_embargados=new VehiculosEmbargadosModel();
		$nombre_controladores = "VehiculosEmbargados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $vehiculos_embargados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$vehiculos_embargados=new VehiculosEmbargadosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["observaciones_vehiculos_embargados"]) )
				
			{
				
				
				
				$_observaciones_vehiculos_embargados= $_POST["observaciones_vehiculos_embargados"];
				
				if(isset($_POST["id_vehiculos_embargados"])) 
				{
					
					$_id_vehiculos_embargados = $_POST["id_vehiculos_embargados"];
					$colval = " observaciones_vehiculos_embargados= '$_observaciones_vehiculos_embargados'";
					$tabla = "vehiculos_embargados";
					$where = "id_vehiculos_embargados= '$_id_vehiculos_embargados'    ";
					
					$resultado=$vehiculos_embargados->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_vehiculos_embargados";
				
				$parametros = " '$_observaciones_vehiculos_embargados'  ";
					
				$vehiculos_embargados->setFuncion($funcion);
		
				$vehiculos_embargados->setParametros($parametros);
		
		
				$resultado=$vehiculos_embargados->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Vehiculos Embargados";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_observaciones_vehiculos_embargados;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("vehiculos_embargados", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de vehiculos embargados"
		
			));
		
		
		}
	

		$vehiculos_embargados=new VehiculosEmbargadosModel();

		$nombre_controladores = "VehiculosEmbargados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$vehiculos_embargados=new VehiculosEmbargadosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["observaciones_vehiculos_embargados"]) )
				
			{
				$_observaciones_vehiculos_embargados= $_POST["observaciones_vehiculos_embargados"];
				
				if(isset($_POST["id_vehiculos_embargados"]))
				{
				$_id_vehiculos_embargados= $_POST["id_vehiculos_embargados"];
				$colval = " observaciones_vehiculos_embargados= '$_observaciones_vehiculos_embargados'   ";
				$tabla = "vehiculos_embargados";
				$where = "id_vehiculos_embargados= '$_id_vehiculos_embargados'    ";
					
				$resultado=$vehiculos_embargados->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_vehiculos_embargados";
				
				$parametros = " '$_observaciones_vehiculos_embargados'  ";
					
				$vehiculos_embargados->setFuncion($funcion);
		
				$vehiculos_embargados->setParametros($parametros);
		
		
				$resultado=$vehiculos_embargados->Insert();
			 }
		
			}
			$this->redirect("VehiculosEmbargados", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de vehiculos embargados"
		
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
			if(isset($_GET["id_vehiculos_embargados"]))
			{
				$id_vehiculos_embargados=(int)$_GET["id_vehiculos_embargados"];
				
				$tipo_vehiculos_embargados=new VehiculosEmbargadosModel();
				
				$tipo_vehiculos_embargados->deleteBy(" id_vehiculos_embargados",$id_vehiculos_embargados);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Vehiculos Embargados";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_vehiculos_embargados;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("VehiculosEmbargados", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de vehiculos embargados"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$vehiculos_embargados=new VehiculosEmbargadosModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("VehiculosEmbargados",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>