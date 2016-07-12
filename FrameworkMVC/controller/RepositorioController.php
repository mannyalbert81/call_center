<?php

class RepositorioController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
	
	
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$controladores = new ControladoresModel();
			//NOTIFICACIONES
			$controladores->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "Repositorio";
			
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $controladores->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				$resultEdit="";
				$resultado="";
				
				if(isset($_POST['guardar']))
				{
					$nombre_repositorio=$_POST['nombre_repositorio'];
					
				}
				
				$this->view("Repositorio",array(
						
						"resultado"=>$resultado,"resultEdit"=>$resultEdit
				
				));
					
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Gestion de Repositorio"
				
				));
				
				exit();
			}
				
		}
		else 
		{
				$this->view("ErrorSesion",array(
						"resultSet"=>""
			
				));
				
				exit();
		
		}
	
	}
	
	
	public function InsertaRepositorio(){
			
		
		$directorio = $_SERVER['DOCUMENT_ROOT'].'/Documentos/';
		
		
		if (!file_exists($directorio)) {
			mkdir($directorio, 0777, true);
		}
		
		
				
				
				
					
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Repositorio";
				$_accion_trazas  = "GUARDAR";
				$_parametros_trazas = $_nombre_directorio;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
			
			
		
			/*
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Controladores"
		
			));
		*/
		
	}
	
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Controladores";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_controladores"]))
			{
				$id_controladores=(int)$_GET["id_controladores"];
				
				$controladores=new ControladoresModel();
				
				$controladores->deleteBy(" id_controladores",$id_controladores);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Controladores";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_controladores;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("Controladores", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Controladores"
			
			));
		}
				
	}
	
	/*public function InsertaRepositorio(){
			
	
		$carpeta = '/ruta/a/mi/carpeta';
		if (!file_exists($carpeta)) {
			mkdir($carpeta, 0777, true);
		}
	
	
		session_start();
	
		$permisos_rol=new PermisosRolesModel();
	
		$nombre_controladores = "Repositorio";
	
		$id_rol= $_SESSION['id_rol'];
	
	
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
		if (!empty($resultPer))
		{
	
			$resultado = "";
				
			if (isset ($_POST["nombre_controladores"]) )
	
			{
	
	
	
	
					
			}else
			{
					
				$traza=new TrazasModel();
				$_nombre_controlador = "Repositorio";
				$_accion_trazas  = "GUARDAR";
				$_parametros_trazas = $_nombre_directorio;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
	
				
			$this->redirect("Controladores", "index");
	
		}
		else
		{
			$this->view("Error",array(
						
					"resultado"=>"No tiene Permisos de Insertar Controladores"
	
			));
	
	
		}
	
	}*/
	
	
	
	
}
?>