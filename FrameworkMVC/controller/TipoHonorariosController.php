<?php

class TipoHonorariosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipo_honorarios= new TipoHonorariosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_honorarios->getAll("id_tipo_honorarios");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$tipo_honorarios= new TipoHonorariosModel();
			//Notificaciones
			$tipo_honorarios->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TipoHonorarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_honorarios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_honorarios"])   )
				{

					$nombre_controladores = "TipoHonorarios";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_honorarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_honorarios = $_GET["id_tipo_honorarios"];
						$columnas = " id_tipo_honorarios, descripcion_tipo_honorarios";
						$tablas   = "tipo_honorarios";
						$where    = "id_tipo_honorarios = '$_id_tipo_honorarios' "; 
						$id       = "descripcion_tipo_honorarios";
							
						$resultEdit = $tipo_honorarios->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo Honorarios";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_honorarios;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Honorarios"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoHonorarios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Honorarios"
				
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
	
	public function InsertaTipoHonorarios(){
			
		session_start();

		
		$tipo_honorarios=new TipoHonorariosModel();
		$nombre_controladores = "TipoHonorarios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_honorarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_honorarios=new TipoHonorariosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["descripcion_tipo_honorarios"]) )
				
			{
				
				
				
				$_nombre_tipo_honorarios = $_POST["descripcion_tipo_honorarios"];
				
				if(isset($_POST["id_tipo_honorarios"])) 
				{
					
					$_id_tipo_honorarios = $_POST["id_tipo_honorarios"];
					$colval = " descripcion_tipo_honorarios = '$_descripcion_tipo_honorarios'   ";
					$tabla = "tipo_honorarios";
					$where = "id_tipo_honorarios = '$_id_tipo_honorarios'    ";
					
					$resultado=$tipo_honorarios->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_honorarios";
				
				$parametros = " '$_descripcion_tipo_honorarios'  ";
					
				$tipo_honorarios->setFuncion($funcion);
		
				$tipo_honorarios->setParametros($parametros);
		
		
				$resultado=$tipo_honorarios->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Honorarios";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_descripcion_tipo_honorarios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("tipo_honorarios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de honorarios"
		
			));
		
		
		}
	

		$tipo_honorarios=new TipoHonorariosModel();

		$nombre_controladores = "TipoHonorarios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_honorarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_honorarios=new TipoHonorariosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["descripcion_tipo_honorarios"]) )
				
			{
				$_descripcion_tipo_honorarios = $_POST["descripcion_tipo_honorarios"];
				
				if(isset($_POST["id_tipo_honorarios"]))
				{
				$_id_tipo_honorarios = $_POST["id_tipo_honorarios"];
				$colval = " descripcion_tipo_honorarios = '$_descripcion_tipo_honorarios'   ";
				$tabla = "tipo_honorarios";
				$where = "id_tipo_honorarios = '$_id_tipo_honorarios'    ";
					
				$resultado=$tipo_honorarios->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_honorarios";
				
				$parametros = " '$_descripcion_tipo_honorarios'  ";
					
				$tipo_honorarios->setFuncion($funcion);
		
				$tipo_honorarios->setParametros($parametros);
		
		
				$resultado=$tipo_honorarios->Insert();
			 }
		
			}
			$this->redirect("TipoHonorarios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Honorarios"
		
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
			if(isset($_GET["id_tipo_honorarios"]))
			{
				$id_tipo_honorarios=(int)$_GET["id_tipo_honorarios"];
				
				$tipo_honorarios=new TipoHonorariosModel();
				
				$tipo_honorarios->deleteBy(" id_tipo_honorarios",$id_tipo_honorarios);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Honorarios";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_honorarios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoHonorarios", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Honorarios"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_honorarios=new TipoHonorariosModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoHonorarios",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>