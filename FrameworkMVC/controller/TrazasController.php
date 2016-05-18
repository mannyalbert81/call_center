<?php

class TrazasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
	
		//Creamos el objeto usuario
		$trazas = new TrazasModel();
		$usuarios=new UsuariosModel();
		//Conseguimos todos los usuarios
		$resultSet=$trazas->getAll("id_trazas");
	
		$columnas = "trazas.id_trazas, usuarios.usuario_usuarios, trazas.nombre_controlador, trazas.accion_trazas, trazas.parametros_trazas, trazas.creado";
		$tablas="public.trazas, public.usuarios";
		$where="usuarios.id_usuarios = trazas.id_usuarios";
		$id="creado";
		$resultActi=$trazas->getCondiciones($columnas ,$tablas , $where, $id);
		
		
		//$resultEdit = "";
	
		$resultEdit = "";
		session_start();
	
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
	
			$nombre_controladores = "Trazas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $trazas->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
	
	
				if (isset ($_GET["id_trazas"])   )
				{
						
					$nombre_controladores = "Trazas";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $trazas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
					if (!empty($resultPer))
					{
							
						$_id_trazas = $_GET["id_trazas"];
						$columnas = " trazas.id_trazas, usuarios.usuario_usuarios, trazas.nombre_controlador, trazas.accion_trazas, trazas.parametros_trazas, trazas.creado";
						$tablas   = "public.trazas, public.usuarios";
						$where    = " usuarios.id_usuarios = trazas.id_usuarios AND id_trazas = '$_id_trazas' ";
						$id       = "nombre_etapas";
							
	
						$resultset = $trazas->getCondiciones($columnas ,$tablas ,$where, $id);
	
	
							
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Trazas"
			
						));
							
							
					}
						
				}
	
	
				$this->view("Trazas",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultActi" =>$resultActi
							
				));
	
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Trazas"
	
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
	
}
?>