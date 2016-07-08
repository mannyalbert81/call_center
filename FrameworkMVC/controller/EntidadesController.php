<?php

class EntidadesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$entidades=new EntidadesModel();
					//Conseguimos todos los usuarios
		$resultSet=$entidades->getAll("id_entidades");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//Notificaciones
			$entidades->MostrarNotificaciones($_SESSION['id_usuarios']);

			$nombre_controladores = "Entidades";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $entidades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_entidades"])   )
				{

					$nombre_controladores = "Entidades";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $entidades->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_entidades = $_GET["id_entidades"];
						$columnas = " id_entidades, ruc_entidades, nombre_entidades, telefono_entidades, direccion_entidades, ciudad_entidades ";
						$tablas   = "entidades";
						$where    = "id_entidades = '$_id_entidades' "; 
						$id       = "ruc_entidades";
							
						$resultEdit = $entidades->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Entidades";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_entidades;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar entidades"
					
						));
					
					
					}
					
				}
		
				
				$this->view("Entidades",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Entidades"
				
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
	
	public function InsertaEntidades(){
			
		session_start();
		$entidades=new EntidadesModel();
		

		$nombre_controladores = "Entidades";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $entidades->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$entidades=new EntidadesModel();
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["ruc_entidades"])   )
				
			{
				
				$_ruc_entidades = $_POST["ruc_entidades"];
				$_nombre_entidades = $_POST["nombre_entidades"];
				$_telefono_entidades = $_POST["telefono_entidades"];
				$_direccion_entidades = $_POST["direccion_entidades"];
				$_ciudad_entidades = $_POST["ciudad_entidades"];
				
				$funcion = "ins_entidades";
				$parametros = "'$_ruc_entidades', '$_nombre_entidades', '$_telefono_entidades', '$_direccion_entidades', '$_ciudad_entidades'";
					
				$entidades->setFuncion($funcion);
		
				$entidades->setParametros($parametros);
		
		
				$resultado=$entidades->Insert();
		
				//$this->view("Error",array(
				//"resultado"=>"entro"
				//));
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Entidades";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_entidades;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			$this->redirect("Entidades", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Entidades"
		
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
			if(isset($_GET["id_entidades"]))
			{
				$id_entidades=(int)$_GET["id_entidades"];
		
				$entidades=new EntidadesModel();
				
				$entidades->deleteBy(" id_entidades",$id_entidades);
				
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Entidades";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_entidades;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				
			}
			
			$this->redirect("Entidades", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Entidades"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$entidades=new EntidadesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_entidades, nombre_entidades", " nombre_entidades != '' ");
			$this->report("Entidades",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>