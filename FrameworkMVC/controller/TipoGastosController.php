<?php

class TipoGastosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$tipo_gastos= new TipoGastosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$tipo_gastos->getAll("id_tipo_gastos");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			$tipo_gastos=new TipoGastosModel();
			//Notificaciones
			$tipo_gastos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "TipoGastos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $tipo_gastos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_tipo_gastos"])   )
				{

					$nombre_controladores = "TipoGastos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $tipo_gastos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_tipo_gastos = $_GET["id_tipo_gastos"];
						$columnas = " id_tipo_gastos, nombre_tipo_gastos";
						$tablas   = "tipo_gastos";
						$where    = "id_tipo_gastos = '$_id_tipo_gastos' "; 
						$id       = "nombre_tipo_gastos";
							
						$resultEdit = $tipo_gastos->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Tipo Gastos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_tipo_gastos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Gastos"
					
						));
					
					
					}
					
				}
		
				
				$this->view("TipoGastos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Gastos"
				
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
	
	public function InsertaTipoGastos(){
			
		session_start();

		
		$tipo_gastos=new TipoGastosModel();
		$nombre_controladores = "TipoGastos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_gastos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_gastos=new TipoGastosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_gastos"]) )
				
			{
				
				
				
				$_nombre_tipo_gastos = $_POST["nombre_tipo_gastos"];
				
				if(isset($_POST["id_tipo_gastos"])) 
				{
					
					$_id_tipo_gastos = $_POST["id_tipo_gastos"];
					$colval = " nombre_tipo_gastos = '$_nombre_tipo_gastos'   ";
					$tabla = "tipo_gastos";
					$where = "id_tipo_gastos = '$_id_tipo_gastos'    ";
					
					$resultado=$tipo_gastos->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_gastos";
				
				$parametros = " '$_nombre_tipo_gastos'  ";
					
				$tipo_gastos->setFuncion($funcion);
		
				$tipo_gastos->setParametros($parametros);
		
		
				$resultado=$tipo_gastos->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Gastos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_gastos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("tipo_gastos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de gastos"
		
			));
		
		
		}
	

		$tipo_gastos=new TipoGastosModel();

		$nombre_controladores = "TipoGastos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_gastos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_gastos=new TipoGastosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_gastos"]) )
				
			{
				$_nombre_tipo_gastos = $_POST["nombre_tipo_gastos"];
				
				if(isset($_POST["id_tipo_gastos"]))
				{
				$_id_tipo_gastos = $_POST["id_tipo_gastos"];
				$colval = " nombre_tipo_gastos = '$_nombre_tipo_gastos'   ";
				$tabla = "tipo_gastos";
				$where = "id_tipo_gastos = '$_id_tipo_gastos'    ";
					
				$resultado=$tipo_gastos->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_gastos";
				
				$parametros = " '$_nombre_tipo_gastos'  ";
					
				$tipo_gastos->setFuncion($funcion);
		
				$tipo_gastos->setParametros($parametros);
		
		
				$resultado=$tipo_gastos->Insert();
			 }
		
			}
			$this->redirect("TipoGastos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de gastos"
		
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
			if(isset($_GET["id_tipo_gastos"]))
			{
				$id_tipo_gastos=(int)$_GET["id_tipo_gastos"];
				
				$tipo_gastos=new TipoGastosModel();
				
				$tipo_gastos->deleteBy(" id_tipo_gastos",$id_tipo_gastos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Gastos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_gastos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoGastos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Gastos"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_gastos=new TipoGastosModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoGastos",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>