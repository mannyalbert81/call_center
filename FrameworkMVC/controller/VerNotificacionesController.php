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
				
				
				
				
				/*$this->view("Notificaciones",array(
						
						
			
				));*/
		
				
				
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
				
				$id_usuario=$_SESSION['id_usuarios'];
				$notificaciones=new NotificacionesModel();
				$where_notificacion = " id_usuarios = '$id_usuario' AND visto_notificaciones=0";
				$result_notificaciones=$notificaciones->getBy($where_notificacion);
				
				
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
		echo json_encode($string_out);
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
