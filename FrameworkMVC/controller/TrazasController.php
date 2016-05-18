<?php

class TrazasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
	
		//Creamos el objeto usuario
		$trazas = new TrazasModel();
	
		//Conseguimos todos los usuarios
		$resultSet=$trazas->getAll("id_trazas");
	
		//$resultEdit = "";
	
	
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
							
						$_id_etapas_juicios = $_GET["id_etapas_juicios"];
						$columnas = " id_etapas_juicios, nombre_etapas";
						$tablas   = "etapas_juicios";
						$where    = "id_etapas_juicios = '$_id_etapas_juicios' ";
						$id       = "nombre_etapas";
							
	
						//$resultEdit = $trazas->getCondiciones($columnas ,$tablas ,$where, $id);
	
	
						$traza=new TrazasModel();
						$_nombre_controlador = "Etapas Juicios";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_etapas_juicios;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
	
							
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Etapas Juicios"
			
						));
							
							
					}
						
				}
	
	
				$this->view("EtapasJuicios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
							
				));
	
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Etapas Juicios"
	
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