<?php

class NotificacionesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
		
		session_start();
	
		//Creamos el objeto usuario
  	    $notificaciones=new NotificacionesModel();
					//Conseguimos todos los usuarios
		$resultSet=$notificaciones->getAll("id_notificaciones");
				
		$resultEdit = "";
		$tipo_notificacion = new TipoNotificacionModel();
		$resultTipoNotificacion=$tipo_notificacion->getAll("descripcion_notificacion");
		
		$usuarios = new UsuariosModel();
		$resultUsuarios=$usuarios->getAll("nombre_usuarios");
		
		$result_notificaciones=array();
		//$result_notificaciones=$notificaciones->verNotificaciones();
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			
			$notificaciones=new NotificacionesModel();
			//Notificaciones
			$notificaciones->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			
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
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultTipoNotificacion"=>$resultTipoNotificacion,"resultUsuarios"=>$resultUsuarios,"result_notificaciones"=>$result_notificaciones
						
			
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
				//"resultado"=>$parametros
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
	
	function iniciaNotificaciones(){
		//ver notificaciones
		$notificaciones=new NotificacionesModel();
		$result_notificaciones="";
		$result_notificaciones=$notificaciones->verNotificaciones();
		
		if(empty($result_notificaciones)){$this->view("Error",array(
				"resultado"=>"No hay datos"
			
		)); exit();}else{$this->view("Error",array(
				"resultado"=>"array lleno"
			
		)); exit();}
		
		return $result_notificaciones;
	}
	
     function actualizaNotificaciones(){
		
		session_start();
		
		//toma el id de notificaciones
		$id_notificaciones=$_GET['id_notificaciones'];
		
		$notificaciones= new NotificacionesModel();
		$resultNotificaciones=array();
		
		$colval="visto_notificaciones=TRUE";
		$tabla="notificaciones";
		$where="id_notificaciones='$id_notificaciones'";
		$resultado=$notificaciones->UpdateBy($colval, $tabla, $where);
		
		$columnas=" notificaciones.id_notificaciones,
			  notificaciones.numero_movimiento_notificaciones,
			  tipo_notificacion.controlador_tipo_notificacion, 
			  tipo_notificacion.accion_tipo_notificacion";
		$tablas="public.notificaciones, 
  				public.tipo_notificacion";
		$where1="tipo_notificacion.id_tipo_notificacion = notificaciones.id_tipo_notificacion
 				 AND notificaciones.id_notificaciones='$id_notificaciones'";
		

		$resultNotificaciones=$notificaciones->getCondiciones($columnas, $tablas, $where1, "notificaciones.id_notificaciones");
		
		
		    //crear variable se session numero movimiento para aprobar solicitud
		
		    $_SESSION['numero_movimiento']=$resultNotificaciones[0]->numero_movimiento_notificaciones;
		
			$controlador=$resultNotificaciones[0]->controlador_tipo_notificacion;
		    $accion=$resultNotificaciones[0]->accion_tipo_notificacion;
		    
		    $id_usuario=$_SESSION['id_usuarios'];
		    	
		    $notificaciones->MostrarNotificaciones($id_usuario);
		    
		$this->redirect($controlador,$accion);
			
	 
	}
	
	public function notificacionAvoco()
	{
		session_start();
		//Creamos el objeto usuario
		$usuarios=new UsuariosModel();
		
		$id_usuario=$_SESSION['id_usuarios'];
		 
		//Conseguimos todos los usuarios
		$allusers=$usuarios->getBy("id_usuarios='$id_usuario'");
		 
		//Cargamos la vista index y l e pasamos valores
		$this->view("Bienvenida",array(
				"allusers"=>$allusers
		));
	}
	
	
	
}
?>
