<?php

class NotificacionesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$notificaciones=new NotificacionesModel();
					//Conseguimos todos los usuarios
		$resultSet=$notificaciones->getAll("id_notificaciones");
				
		$resultEdit = "";
		$tipo_notificacion = new TipoNotificacionModel();
		$resultTipoNotificacion=$tipo_notificacion->getAll("descripcion_notificacion");
		
		$usuarios = new UsuariosModel();
		$resultUsuarios=$usuarios->getAll("nombre_usuarios");
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			$nombre_controladores = "Notificaciones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $notificaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_notificaciones"])   )
				{

					$nombre_controladores = "Notificaciones";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $notificaciones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_notificaciones = $_GET["id_notificaciones"];
						$columnas = " notificaciones.descripcion_notificaciones, notificaciones.id_tipo_notificacion, notificaciones.id_notificaciones, usuarios.nombre_usuarios, usuarios.id_usuarios, tipo_notificacion.descripcion_notificacion";
						$tablas   = "  public.notificaciones, public.usuarios, public.tipo_notificacion";
						$where    = "  notificaciones.id_usuarios = usuarios.id_usuarios AND tipo_notificacion.id_tipo_notificacion = notificaciones.id_tipo_notificacion AND id_notificaciones= '$_id_notificaciones'"; 
						$id       = "id_notificaciones";
							
						$resultEdit = $notificaciones->getCondiciones($columnas ,$tablas ,$where, $id);
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Notificaciones";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_notificaciones;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Notificaciones"
					
						));
					
					
					}
					
				}
		
				
				$this->view("Notificaciones",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultTipoNotificacion"=>$resultTipoNotificacion,"resultUsuarios"=>$resultUsuarios
						
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Notificaciones"
				
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
	
	public function InsertaNotificaciones(){
			
		session_start();
		
		$notificaciones=new NotificacionesModel();
		$nombre_controladores = "Notificaciones";
        $id_rol= $_SESSION['id_rol'];
		$resultPer = $notificaciones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$notificaciones=new NotificacionesModel();
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["id_tipo_notificacion"])   )
				
			{
				
		
				$_id_tipo_notificacion = $_POST["id_tipo_notificacion"];
				$_id_usuarios = $_POST["id_usuarios"];
				$_descripcion_notificaciones = $_POST["descripcion_notificaciones"];
				
				
				$funcion = "ins_notificaciones";
				$parametros = "'$_id_tipo_notificacion', '$_id_usuarios', '$_descripcion_notificaciones'";
				$notificaciones->setFuncion($funcion);
		        $notificaciones->setParametros($parametros);
		
		
				$resultado=$notificaciones->Insert();
		
				$traza=new TrazasModel();
				$_nombre_controlador = "Notificaciones";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_descripcion_notificaciones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);

				//$this->view("Error",array(
				//"resultado"=>"entro"
				//));				
				
			}
			$this->redirect("Notificaciones", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Notificaciones"
		
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
			if(isset($_GET["id_notificaciones"]))
			{
				$id_notificaciones=(int)$_GET["id_notificaciones"];
		
				$notificaciones=new NotificacionesModel();
				
				$notificaciones->deleteBy(" id_notificaciones",$id_notificaciones);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Notificaciones";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_notificaciones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Notificaciones", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Notificaciones"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$notificaciones=new NotificacionesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_notificaciones, nombre_notificaciones", " nombre_notificaciones != '' ");
			$this->report("Notificaciones",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	function actualizaNotificaciones(){
		
		session_start();
		
		$id_notificaciones=$_GET['id_notificaciones'];
		$notificaciones= new NotificacionesModel();
		$colval="visto_notificaciones=1";
		$tabla="notificaciones";
		$where="id_notificaciones='$id_notificaciones'";
		$resultado=$notificaciones->UpdateBy($colval, $tabla, $where);
		
		$_usuario=$_SESSION['usuario_usuarios'];
		
		$id_usuario=$_SESSION['id_usuarios'];
		$result_notificaciones=$notificaciones->verNotificaciones($id_usuario);
		
	
		$this->view("Bienvenida",array(
    				"allusers"=>$_usuario,"result_notificaciones"=>$result_notificaciones
	    		));
		 
	}
	
	
	
	
}
?>
