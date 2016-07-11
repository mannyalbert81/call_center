<?php

class TipoIdentificacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipo_identificacion= new TipoIdentificacionModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_identificacion->getAll("id_tipo_identificacion");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$tipo_identificacion= new TipoIdentificacionModel();
			//Notificaciones
			$tipo_identificacion->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TipoIdentificacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_identificacion->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_identificacion"])   )
				{

					$nombre_controladores = "TipoIdentificacion";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_identificacion = $_GET["id_tipo_identificacion"];
						$columnas = " id_tipo_identificacion, nombre_tipo_identificacion";
						$tablas   = "tipo_identificacion";
						$where    = "id_tipo_identificacion = '$_id_tipo_identificacion' "; 
						$id       = "nombre_tipo_identificacion";
							
						$resultEdit = $tipo_identificacion->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo Identificacion";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_identificacion;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Identificaciones"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoIdentificacion",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Identificaciones"
				
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
	
	public function InsertaTipoIdentificacion(){
			
		session_start();

		
		$tipo_identificacion=new TipoIdentificacionModel();
		$nombre_controladores = "TipoIdentificacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_identificacion=new TipoIdentificacionModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_identificacion"]) )
				
			{
				
				
				
				$_nombre_tipo_identificacion = $_POST["nombre_tipo_identificacion"];
				
				if(isset($_POST["id_tipo_identificacion"])) 
				{
					
					$_id_tipo_identificacion = $_POST["id_tipo_identificacion"];
					$colval = " nombre_tipo_identificacion = '$_nombre_tipo_identificacion'   ";
					$tabla = "tipo_identificacion";
					$where = "id_tipo_identificacion = '$_id_tipo_identificacion'    ";
					
					$resultado=$tipo_identificacion->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_identificacion";
				
				$parametros = " '$_nombre_tipo_identificacion'  ";
					
				$tipo_identificacion->setFuncion($funcion);
		
				$tipo_identificacion->setParametros($parametros);
		
		
				$resultado=$tipo_identificacion->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Identificacion";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_identificacion;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("tipo_identificacion", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de identificacion"
		
			));
		
		
		}
	

		$tipo_identificacion=new TipoIdentificacionModel();

		$nombre_controladores = "TipoIdentificacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_identificacion=new TipoIdentificacionModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_identificacion"]) )
				
			{
				$_nombre_tipo_identificacion = $_POST["nombre_tipo_identificacion"];
				
				if(isset($_POST["id_tipo_identificacion"]))
				{
				$_id_tipo_identificacion = $_POST["id_tipo_identificacion"];
				$colval = " nombre_tipo_identificacion = '$_nombre_tipo_identificacion'   ";
				$tabla = "tipo_identificacion";
				$where = "id_tipo_identificacion = '$_id_tipo_identificacion'    ";
					
				$resultado=$tipo_identificacion->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_identificacion";
				
				$parametros = " '$_nombre_tipo_identificacion'  ";
					
				$tipo_identificacion->setFuncion($funcion);
		
				$tipo_identificacion->setParametros($parametros);
		
		
				$resultado=$tipo_identificacion->Insert();
			 }
		
			}
			$this->redirect("TipoIdentificacion", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de identificacion"
		
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
			if(isset($_GET["id_tipo_identificacion"]))
			{
				$id_tipo_identificacion=(int)$_GET["id_tipo_identificacion"];
				
				$tipo_identificacion=new TipoIdentificacionModel();
				
				$tipo_identificacion->deleteBy(" id_tipo_identificacion",$id_tipo_identificacion);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Identificacion";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_identificacion;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoIdentificacion", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Identificacion"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_identificacion=new TipoIdentificacionModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoIdentificacion",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>