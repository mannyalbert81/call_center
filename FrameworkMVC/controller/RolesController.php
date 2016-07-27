<?php

class RolesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$roles=new RolesModel();
					//Conseguimos todos los usuarios
		$resultSet=$roles->getAll("id_rol");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			//Notificaciones
			$roles->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "Roles";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $roles->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				$this->view("Roles",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
							
				));
				
				
				if (isset ($_GET["id_rol"])   )
				{

					$nombre_controladores = "Roles";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $roles->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_rol = $_GET["id_rol"];
						$columnas = " id_rol, nombre_rol ";
						$tablas   = "rol";
						$where    = "id_rol = '$_id_rol' "; 
						$id       = "nombre_rol";
							
						$resultEdit = $roles->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Registro Carton Documentos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_rol;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						$this->view("Error",array(
								"resultado"=>$resultado
			
						));
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Roles"
					
						));
					
					
					}
					
				}
		
				
				
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Roles"
				
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
	
	public function InsertaRoles(){
			
		session_start();
		$permisos_rol = new  PermisosRolesModel();

		$nombre_controladores = "Roles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$roles=new RolesModel();
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["nombre_rol"])   )
				
			{
				
				$_nombre_rol = $_POST["nombre_rol"];
				
				
				if(isset($_POST["id_rol"]))
				{
						
					$_id_rol = $_POST["id_rol"];
					$colval = " nombre_rol = '$_nombre_rol'   ";
					$tabla = "rol";
					$where = "id_rol = '$_id_rol'    ";
						
					$resultado=$roles->UpdateBy($colval, $tabla, $where);
						
				}else {
						
					$funcion = "ins_rol";
				$parametros = " '$_nombre_rol'  ";
					
				$roles->setFuncion($funcion);
		
				$roles->setParametros($parametros);
		
		
				$resultado=$roles->Insert();
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Rol";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_rol;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
		
			}
			$this->redirect("Roles", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Roles"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol = new  PermisosRolesModel();
		
		
		$nombre_controladores = "Roles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_rol"]))
			{
				$id_rol=(int)$_GET["id_rol"];
		
				$roles=new RolesModel();
				
				$roles->deleteBy(" id_rol",$id_rol);
				
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Roles";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_rol;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Roles", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Roles"
			
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