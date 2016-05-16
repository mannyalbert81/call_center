<?php

class TipoNotificacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipoNotificacion = new TipoNotificacionModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipoNotificacion->getAll("id_tipo_notificacion");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$permisos_rol=new PermisosRolesModel();
			$nombre_controladores = "TipoNotificacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_notificacion"])   )
				{

					$nombre_controladores = "Controladores";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_notificacion = $_GET["id_tipo_notificacion"];
						$columnas = " id_tipo_notificacion, descripcion_notificacion";
						$tablas   = "tipo_notificacion";
						$where    = "id_tipo_notificacion = '$_id_tipo_notificacion' "; 
						$id       = "id_tipo_notificacion";
							
						$resultEdit = $tipoNotificacion->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipo Notificacion"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoNotificacion",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipo Notificacion"
				
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
	
	public function InsertaTipoNotificacion(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();
		$tipoNotificacion=new TipoNotificacionModel();

		$nombre_controladores = "TipoNotificacion";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
			$resultado = null;

		
			//_nombre_tipoNotificacion
			
			if (isset ($_POST["desc_tipoNotificacion"]) )
				
			{
				
				$_nombre_tipoNotificacion = $_POST["desc_tipoNotificacion"];
				
				if( isset ($_POST["id_tipo_notificacion"])) 
				{
					
					
					$_id_tipoNotificacion = $_POST["id_tipo_notificacion"];
					
					$colval = "descripcion_notificacion = '$_nombre_tipoNotificacion'   ";
					$tabla = "tipo_notificacion";
					$where = "id_tipo_notificacion = '$_id_tipoNotificacion' ";
					
					$resultado=$tipoNotificacion->UpdateBy($colval, $tabla, $where);
					
					
					
				}else {
					
			
				
				$funcion = "ins_tipo_notificacion";
				
				$parametros = " '$_nombre_tipoNotificacion'  ";
					
				$tipoNotificacion->setFuncion($funcion);
		
				$tipoNotificacion->setParametros($parametros);
		
		
				$resultado=$tipoNotificacion->Insert();
			 }
		
			}
			$this->redirect("TipoNotificacion", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Tipo Notificaciones"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "TipoNotificacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_tipo_notificacion"]))
			{
				$id_tipoNotificacion=(int)$_GET["id_tipo_notificacion"];
				
				$tipoNotificacion=new TipoNotificacionModel();
				
				$tipoNotificacion->deleteBy("id_tipo_notificacion",$id_tipoNotificacion);
				
				
			}
			
			$this->redirect("TipoNotificacion", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Controladores"
			
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