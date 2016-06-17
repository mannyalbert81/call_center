<?php

class VerNotificacionesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
		
		session_start();
		
		$notificaciones = new NotificacionesModel();
		
		$resultSet=$notificaciones->verNotificaciones();
	
		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			$nombre_controladores = "Notificaciones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $notificaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
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
	
	

	
	
	function iniciaNotificaciones(){
		session_start();
		//ver notificaciones
				//$notificaciones=new NotificacionesModel();
				//$result_notificaciones="";
				//$result_notificaciones=$notificaciones->verNotificaciones();
				
				$result_notificaciones=array();
				
				$id_usuario=$_SESSION['id_usuarios'];
				$notificaciones=new NotificacionesModel();
				
				$columna="
					  notificaciones.id_notificaciones, 
					  notificaciones.id_tipo_notificacion, 
					  notificaciones.id_usuarios, 
					  notificaciones.descripcion_notificaciones, 
					  notificaciones.visto_notificaciones, 
					  tipo_notificacion.descripcion_notificacion, 
					  tipo_notificacion.controlador_tipo_notificacion, 
					  tipo_notificacion.accion_tipo_notificacion";
				
				$tabla="public.notificaciones,public.tipo_notificacion";
				
				$where = "tipo_notificacion.id_tipo_notificacion = notificaciones.id_tipo_notificacion AND id_usuarios = '$id_usuario' AND visto_notificaciones=false";
				
				
				$result_notificaciones=$notificaciones->getCondiciones($columna,$tabla,$where,"notificaciones.id_notificaciones");
				
				
		echo json_encode($result_notificaciones);
	}
	
	
	function startNotificaciones(){
		//ver notificaciones
		$notificaciones=new NotificacionesModel();
		$result_notificaciones="";
		$result_notificaciones=$notificaciones->verNotificaciones();
	return $result_notificaciones;
	
	}
	
	function actualizaNotificaciones(){
		
		session_start();
		
		$id_notificaciones=$_GET['id_notificaciones'];
		$controlador=$_GET['controlador'];
		$accion=$_GET['acciones'];
		$notificaciones= new NotificacionesModel();
		$colval="visto_notificaciones=true";
		$tabla="notificaciones";
		$where="id_notificaciones='$id_notificaciones'";
		$resultado=$notificaciones->UpdateBy($colval, $tabla, $where);
		
		$this->redirect($controlador, $accion);
		 
	}
	
	function mostrarNotificaciones(){
		session_start();
		//ver notificaciones
		//$notificaciones=new NotificacionesModel();
		//$result_notificaciones="";
		//$result_notificaciones=$notificaciones->verNotificaciones();
	
		$result_notificaciones=array();
	
		$id_usuario=$_SESSION['id_usuarios'];
		$notificaciones=new NotificacionesModel();
	
		$columna="
					  notificaciones.id_notificaciones,
					  notificaciones.id_tipo_notificacion,
					  notificaciones.id_usuarios,
					  notificaciones.descripcion_notificaciones,
					  notificaciones.visto_notificaciones,
					  tipo_notificacion.descripcion_notificacion,
					  tipo_notificacion.controlador_tipo_notificacion,
					  tipo_notificacion.accion_tipo_notificacion";
	
		$tabla="public.notificaciones,public.tipo_notificacion";
	
		$where = "tipo_notificacion.id_tipo_notificacion = notificaciones.id_tipo_notificacion AND id_usuarios = '$id_usuario' AND visto_notificaciones=false";
	
	
		$result_notificaciones=$notificaciones->getCondiciones($columna,$tabla,$where,"notificaciones.id_notificaciones");
	
	
		$string_out='<button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown">Notificacion <span class="badge">';
	
		if(empty($result_notificaciones)){
			$string_out.='0';
			$string_out.='</span></button>';
		}else{
			$string_out.=''.count($result_notificaciones);
			$string_out.='</span></button>';
			$string_out.='<ul class="dropdown-menu">';
	
			foreach ($result_notificaciones as $res){
	
				$string_out.='<li><a href="$helper->url("Notificaciones","actualizaNotificaciones");&id_notificaciones='.$res->id_notificaciones.'>'; $string_out.= $res->descripcion_notificaciones.'</a></li>';
	
			}
		}
	
		$string_out=0;
		echo json_encode($result_notificaciones);
	}
	
	
	
	
}
?>
