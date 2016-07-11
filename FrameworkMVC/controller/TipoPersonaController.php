<?php

class TipoPersonaController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipo_persona= new TipoPersonaModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_persona->getAll("id_tipo_persona");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$tipo_persona= new TipoPersonaModel();
			//Notificaciones
			$tipo_persona->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TipoPersona";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_persona->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_persona"])   )
				{

					$nombre_controladores = "TipoPersona";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_persona->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_persona = $_GET["id_tipo_persona"];
						$columnas = " id_tipo_persona, nombre_tipo_persona";
						$tablas   = "tipo_persona";
						$where    = "id_tipo_persona = '$_id_tipo_persona' "; 
						$id       = "nombre_tipo_persona";
							
						$resultEdit = $tipo_persona->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo Persona";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_persona;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Persona"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoPersona",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Persona"
				
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
	
	public function InsertaTipoPersona(){
			
		session_start();

		
		$tipo_persona=new TipoPersonaModel();
		$nombre_controladores = "TipoPersona";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_persona->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_persona=new TipoPersonaModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_persona"]) )
				
			{
				
				
				
				$_nombre_tipo_persona = $_POST["nombre_tipo_persona"];
				
				if(isset($_POST["id_tipo_persona"])) 
				{
					
					$_id_tipo_persona = $_POST["id_tipo_persona"];
					$colval = " nombre_tipo_persona = '$_nombre_tipo_persona'   ";
					$tabla = "tipo_persona";
					$where = "id_tipo_persona = '$_id_tipo_persona'    ";
					
					$resultado=$tipo_persona->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_persona";
				
				$parametros = " '$_nombre_tipo_persona'  ";
					
				$tipo_persona->setFuncion($funcion);
		
				$tipo_persona->setParametros($parametros);
		
		
				$resultado=$tipo_persona->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Persona";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_persona;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("tipo_persona", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Persona"
		
			));
		
		
		}
	

		$tipo_persona=new TipoPersonaModel();

		$nombre_controladores = "TipoPersona";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_persona->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_persona=new TipoPersonaModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_persona"]) )
				
			{
				$_nombre_tipo_persona = $_POST["nombre_tipo_persona"];
				
				if(isset($_POST["id_tipo_persona"]))
				{
				$_id_tipo_persona = $_POST["id_tipo_persona"];
				$colval = " nombre_tipo_persona = '$_nombre_tipo_persona'   ";
				$tabla = "tipo_persona";
				$where = "id_tipo_persona = '$_id_tipo_persona'    ";
					
				$resultado=$tipo_persona->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_persona";
				
				$parametros = " '$_nombre_tipo_persona'  ";
					
				$tipo_persona->setFuncion($funcion);
		
				$tipo_persona->setParametros($parametros);
		
		
				$resultado=$tipo_persona->Insert();
			 }
		
			}
			$this->redirect("TipoPersona", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo de Persona"
		
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
			if(isset($_GET["id_tipo_persona"]))
			{
				$id_tipo_persona=(int)$_GET["id_tipo_persona"];
				
				$tipo_persona=new TipoPersonaModel();
				
				$tipo_persona->deleteBy(" id_tipo_persona",$id_tipo_persona);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Persona";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_persona;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoPersona", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Persona"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_persona=new TipoPersonaModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoPersona",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>