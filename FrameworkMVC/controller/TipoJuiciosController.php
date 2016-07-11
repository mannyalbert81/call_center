<?php

class TipoJuiciosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipo_juicios= new TipoJuiciosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_juicios->getAll("id_tipo_juicios");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$tipo_juicios= new TipoJuiciosModel();
			//Notificaciones
			$tipo_juicios->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TipoJuicios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_juicios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_juicios"])   )
				{

					$nombre_controladores = "TipoJuicios";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_juicios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_juicios = $_GET["id_tipo_juicios"];
						$columnas = " id_tipo_juicios, nombre_tipo_juicios";
						$tablas   = "tipo_juicios";
						$where    = "id_tipo_juicios = '$_id_tipo_juicios' "; 
						$id       = "nombre_tipo_juicios";
							
						$resultEdit = $tipo_juicios->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo Jucios";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_juicios;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Juicios"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoJuicios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Juicios"
				
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
	
	public function InsertaTipoJuicios(){
			
		session_start();

		
		$tipo_juicios=new TipoJuiciosModel();
		$nombre_controladores = "TipoJuicios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_juicios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_juicios=new TipoJuiciosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_juicios"]) )
				
			{
				
				
				
				$_nombre_tipo_juicios = $_POST["nombre_tipo_juicios"];
				
				if(isset($_POST["id_tipo_juicios"])) 
				{
					
					$_id_tipo_juicios = $_POST["id_tipo_juicios"];
					$colval = " nombre_tipo_juicios = '$_nombre_tipo_juicios'   ";
					$tabla = "tipo_juicios";
					$where = "id_tipo_juicios = '$_id_tipo_juicios'    ";
					
					$resultado=$tipo_juicios->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_juicios";
				
				$parametros = " '$_nombre_tipo_juicios'  ";
					
				$tipo_juicios->setFuncion($funcion);
		
				$tipo_juicios->setParametros($parametros);
		
		
				$resultado=$tipo_juicios->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Jucios";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_juicios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
			 
			 
			 //$this->view("Error",array(
			 //"resultado"=>$resultado
			 //));
			 
	
			
			}
			$this->redirect("TipoJuicios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Juicios"
		
			));
			exit();
		
		
		}
	

		$tipo_juicios=new TipoJuiciosModel();

		$nombre_controladores = "TipoJuicios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_juicios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_juicios=new TipoJuiciosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_juicios"]) )
				
			{
				$_nombre_tipo_juicios = $_POST["nombre_tipo_juicios"];
				
				if(isset($_POST["id_tipo_juicios"]))
				{
				$_id_tipo_identificacion = $_POST["id_tipo_juicios"];
				$colval = " nombre_tipo_juicios = '$_nombre_tipo_juicios'   ";
				$tabla = "tipo_juicios";
				$where = "id_tipo_juicios = '$_id_tipo_juicios'    ";
					
				$resultado=$tipo_juicios->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_juicios";
				
				$parametros = " '$_nombre_tipo_juicios'  ";
					
				$tipo_juicios->setFuncion($funcion);
		
				$tipo_juicios->setParametros($parametros);
		
		
				$resultado=$tipo_juicios->Insert();
			 }
		
			}
			$this->redirect("TipoJuicios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Juicios"
		
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
			if(isset($_GET["id_tipo_juicios"]))
			{
				$id_tipo_juicios=(int)$_GET["id_tipo_juicios"];
				
				$tipo_juicios=new TipoJuiciosModel();
				
				$tipo_juicios->deleteBy(" id_tipo_juicios",$id_tipo_juicios);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Jucios";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_juicios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("TipoJuicios", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Juicios"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_juicios=new TipoJuiciosModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoJuicios",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>