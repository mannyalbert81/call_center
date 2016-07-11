<?php

class OrigenCarteraController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$origen_cartera= new OrigenCarteraModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$origen_cartera->getAll("id_origen_cartera");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$origen_cartera= new OrigenCarteraModel();
			//Notificaciones
			$origen_cartera->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "OrigenCartera";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $origen_cartera->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_origen_cartera"])   )
				{

					$nombre_controladores = "OrigenCartera";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $origen_cartera->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_origen_cartera = $_GET["id_origen_cartera"];
						$columnas = " id_origen_cartera, nombre_origen_cartera";
						$tablas   = "origen_cartera";
						$where    = "id_origen_cartera = '$_id_origen_cartera' "; 
						$id       = "nombre_origen_cartera";
							
						$resultEdit = $origen_cartera->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Origen Cartera";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_origen_cartera;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Origen de Cartera"
					
						));
					
					
					}
					
				}
		
				
				$this->view("OrigenCartera",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Origen de Cartera"
				
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
	
	public function InsertaOrigenCartera(){
			
		session_start();

		
		$origen_cartera=new OrigenCarteraModel();
		$nombre_controladores = "OrigenCartera";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $origen_cartera->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$origen_cartera=new OrigenCarteraModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_origen_cartera"]) )
				
			{
				
				
				
				$_nombre_origen_cartera = $_POST["nombre_origen_cartera"];
				
				if(isset($_POST["id_origen_cartera"])) 
				{
					
					$_id_origen_cartera = $_POST["id_origen_cartera"];
					$colval = " nombre_origen_cartera = '$_nombre_origen_cartera'   ";
					$tabla = "origen_cartera";
					$where = "id_origen_cartera = '$_id_origen_cartera'    ";
					
					$resultado=$origen_cartera->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_origen_cartera";
				
				$parametros = " '$_nombre_origen_cartera'  ";
					
				$origen_cartera->setFuncion($funcion);
		
				$origen_cartera->setParametros($parametros);
		
		
				$resultado=$origen_cartera->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Origen Cartera";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_origen_cartera;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("origen_cartera", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Origen de Cartera"
		
			));
		
		
		}
	

		$origen_cartera=new OrigenCarteraModel();

		$nombre_controladores = "OrigenCartera";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $origen_cartera->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$origen_cartera=new OrigenCarteraModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_origen_cartera"]) )
				
			{
				$_nombre_origen_cartera = $_POST["nombre_origen_cartera"];
				
				if(isset($_POST["id_origen_cartera"]))
				{
				$_id_origen_cartera = $_POST["id_origen_cartera"];
				$colval = " nombre_origen_cartera = '$_nombre_origen_cartera'   ";
				$tabla = "origen_cartera";
				$where = "id_origen_cartera = '$_id_origen_cartera'    ";
					
				$resultado=$origen_cartera->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_origen_cartera";
				
				$parametros = " '$_nombre_origen_cartera'  ";
					
				$origen_cartera->setFuncion($funcion);
		
				$origen_cartera->setParametros($parametros);
		
		
				$resultado=$origen_cartera->Insert();
			 }
		
			}
			$this->redirect("OrigenCartera", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Origen de Cartera"
		
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
			if(isset($_GET["id_origen_cartera"]))
			{
				$id_origen_cartera=(int)$_GET["id_origen_cartera"];
				
				$origen_cartera=new OrigenCarteraModel();
				
				$origen_cartera->deleteBy(" id_origen_cartera",$id_origen_cartera);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Origen Cartera";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_origen_cartera;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("OrigenCartera", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Origen de Cartera"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$origen_cartera=new OrigenCarteraModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("OrigenCartera",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>