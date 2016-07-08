<?php

class ProductosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$productos= new ProductosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$productos->getAll("id_productos");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$productos= new ProductosModel();
			//Notificaciones
			$productos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Productos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $productos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_productos"])   )
				{

					$nombre_controladores = "Productos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $productos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_productos = $_GET["id_productos"];
						$columnas = " id_productos, nombre_productos";
						$tablas   = "productos";
						$where    = "id_productos = '$_id_productos' "; 
						$id       = "nombre_productos";
							
						$resultEdit = $productos->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Productos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_productos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos Productos"
					
						));
					
					
					}
					
				}
		
				
				$this->view("Productos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Productos"
				
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
	
	public function InsertaProductos(){
			
		session_start();

		
		$productos=new ProductosModel();
		$nombre_controladores = "Productos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $productos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$productos=new ProductosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_productos"]) )
				
			{
				
				
				
				$_nombre_productos = $_POST["nombre_productos"];
				
				if(isset($_POST["id_productos"])) 
				{
					
					$_id_productos = $_POST["id_productos"];
					$colval = " nombre_productos = '$_nombre_productos'   ";
					$tabla = "productos";
					$where = "id_productos = '$_id_productos'    ";
					
					$resultado=$productos->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_productos";
				
				$parametros = " '$_nombre_productos'  ";
					
				$productos->setFuncion($funcion);
		
				$productos->setParametros($parametros);
		
		
				$resultado=$productos->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Productos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_productos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("Productos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de productos"
		
			));
		
		
		}
	

		$productos=new ProductosModel();

		$nombre_controladores = "Productos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $productos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$productos=new ProductosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_productos"]) )
				
			{
				$_nombre_productos = $_POST["nombre_productos"];
				
				if(isset($_POST["id_productos"]))
				{
				$_id_productos = $_POST["id_productos"];
				$colval = " nombre_productos = '$_nombre_productos'   ";
				$tabla = "productos";
				$where = "id_productos = '$_id_productos'    ";
					
				$resultado=$productos->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_productos";
				
				$parametros = " '$_nombre_productos'  ";
					
				$productos->setFuncion($funcion);
		
				$productos->setParametros($parametros);
		
		
				$resultado=$productos->Insert();
			 }
		
			}
			$this->redirect("Productos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de productos"
		
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
			if(isset($_GET["id_productos"]))
			{
				$id_productos=(int)$_GET["id_productos"];
				
				$productos=new ProductosModel();
				
				$productos->deleteBy(" id_productos",$id_productos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Productos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_productos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("Productos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de productos"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$productos=new ProductosModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("Productos",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>