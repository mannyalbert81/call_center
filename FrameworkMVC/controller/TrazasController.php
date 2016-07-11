<?php

class TrazasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		
		//creamos el array de busqueda
		$resulMenu=array(0=>'TODOS',1=>'Usuario', 2=>'Controladores', 3=>'Accion');
	
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
		$resultActi=null;
		
		
		//$resultEdit = "";
	
		$resultEdit = "";
		session_start();
	
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$trazas = new TrazasModel();
			//Notificaciones
			$trazas->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
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
				
				
				
				if(isset($_POST["Buscar"]) )
				{
					//isset($_POST["ddl_criterio"])&&((isset($_POST["fecha_desde"])&&isset($_POST["fecha_desde"]))||isset($_POST["ddl_accion"])||isset($_POST["contenido"]))
					$desde=$_POST["fecha_desde"];
					$hasta=$_POST["fecha_hasta"];
						
					
					$columnas = "trazas.id_trazas, usuarios.usuario_usuarios, trazas.nombre_controlador, trazas.accion_trazas, trazas.parametros_trazas, trazas.creado";
					$tablas="public.trazas, public.usuarios";
					$where="usuarios.id_usuarios = trazas.id_usuarios AND trazas.creado BETWEEN '$desde' AND '$hasta' ";
					$id="creado";
					
					$accion="";	
					
					$id_accion = $_POST["ddl_accion"];
					
					switch ($id_accion){
						case 0: 
						$accion = "Guardar";
						break; 
						case 1: 
						$accion = "Editar";
						break; 
						case 2: 
						$accion = "Borrar";
						break;
					}
					
					$criterio = $_POST["ddl_criterio"];
					$contenido = $_POST["contenido"];
					
						
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						switch ($criterio) 
						{
							case 0:
								$where_0 = " ";
								break;
							case 1:
								//USUARIO
								$where_1 = " AND  usuarios.usuario_usuarios LIKE '$contenido'  ";
								break;
							case 2:
								//Controladores
								$where_2 = " AND trazas.nombre_controlador LIKE '$contenido'  ";
								break;
							case 3:
								//Accion
								$where_3 = " AND trazas.accion_trazas LIKE '$accion' ";
								break;
							
							
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3;
							
							
						$resul = $accion;
						
						/*$this->view("Error",array(
								"resultado"=>$where_to
									
						));
						exit();*/
					
						$resultActi=$trazas->getCondiciones($columnas ,$tablas , $where_to, $id);
					
					
				
				}
				else{
					
					
					
				}
				
	
	
				$this->view("Trazas",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultActi" =>$resultActi,"resulMenu"=>$resulMenu
							
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