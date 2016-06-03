<?php

class GastosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		$gastos= new GastosModel();
	    $resultEdit = "";

		$entidades = new EntidadesModel();
		$resultEnti=$entidades->getAll("nombre_entidades");
		
		$clientes = new ClientesModel();
		
		
		$columnas = "clientes.id_clientes,
				    clientes.identificacion_clientes,
				     clientes.nombres_clientes, 
                     juicios.juicio_referido_titulo_credito";
		$tablas   = "public.clientes, 
                     public.juicios";
		$where    = "juicios.id_clientes = clientes.id_clientes";
		$id = "juicios.juicio_referido_titulo_credito";
		 
	
		$resultSet=$clientes->getCondiciones($columnas, $tablas, $where, $id);
		
		$oficios = new OficiosModel();
		
		
		$columnas = "oficios.id_oficios, 
                     oficios.numero_oficios";
		$tablas   = "public.oficios";
		
		$id = "oficios.numero_oficios";
			
		
		$resultOfi=$oficios->getAll($id);
		
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Gastos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $gastos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				
				
				
				if (isset ($_GET["id_gastos"])   )
				{

					$nombre_controladores = "Gastos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $ciudad->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_gastos = $_GET["id_gastos"];
						$columnas = " id_ciudad, nombre_ciudad";
						$tablas   = "gastos";
						$where    = "id_gastos = '$_id_gastos' "; 
						$id       = "nombre_ciudad";
							
						$resultEdit = $gastos->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Gastos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_gastos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Gastos"
					
						));
					
					
					}
					
				}
		
				
				if(isset($_POST["buscar_clientes"])){
						
					$criterio_busqueda=$_POST["criterio_clientes"];
					$contenido_busqueda=$_POST["contenido_clientes"];
						
					$clientes = new ClientesModel();
						
						
					$columnas = "clientes.id_clientes,
					clientes.identificacion_clientes,
				     clientes.nombres_clientes,
                     juicios.juicio_referido_titulo_credito";
					$tablas   = "public.clientes,
                                 public.juicios";
					$where    = "juicios.id_clientes = clientes.id_clientes";
					
					$id = "juicios.juicio_referido_titulo_credito";
						
					
					$where_1 = "";
					$where_2 = "";
					
						
					switch ($criterio_busqueda) {
							
						case 0:
							// identificacion de cliente
							$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
							break;
						case 1:
							//id_titulo de credito
							$where_2 = " AND  juicios.juicio_referido_titulo_credito = '$contenido_busqueda'  ";
							break;
				
					
								
					}
						
						
						
					$where_to  = $where . $where_1 . $where_2 ;
				
					$resultSet=$clientes->getCondiciones($columnas, $tablas, $where_to, $id);
					
						
						
				}
				
				
				
				
				if(isset($_POST["buscar_oficios"])){
				
					$criterio_busqueda=$_POST["criterio_oficios"];
					$contenido_busqueda=$_POST["contenido_oficios"];
				
					$oficios = new OficiosModel();
					
					
					$columnas = "oficios.id_oficios,
                                oficios.numero_oficios";
					$tablas   = "public.oficios";
					
					$id = "oficios.numero_oficios";
						
					
					$where_1 = "";
				
				
					switch ($criterio_busqueda) {
							
						case 0:
							// identificacion de cliente
							$where_1 = " AND  oficios.numero_oficios = '$contenido_busqueda'  ";
							break;
					}
				   
				
				
					$where_to  = $where_1;
				
				
					//$resultOfi=$oficios->getCondiciones($columnas ,$tablas , $where_to, $id);
					$resultOfi=$oficios->getAll($id);
				
				
				}
				
				
				
				
				$this->view("Gastos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEnti" =>$resultEnti , "resultOfi" =>$resultOfi
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Gastos"
				
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
	
	public function InsertaGastos(){
			
		session_start();

		
		$gastos=new GastosModel();
		$nombre_controladores = "Gastos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $gastos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$gastos=new GastosModel();
			
			if (isset ($_POST["nombre_ciudad"]) )
				
			{
				$_nombre_ciudad = $_POST["nombre_ciudad"];
				
				if(isset($_POST["id_ciudad"])) 
				{
					$_id_ciudad = $_POST["id_ciudad"];
					$colval = " nombre_ciudad = '$_nombre_ciudad'   ";
					$tabla = "ciudad";
					$where = "id_ciudad = '$_id_ciudad'";
					
					$resultado=$ciudad->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_ciudad";
				
				$parametros = " '$_nombre_ciudad'  ";
					
				$ciudad->setFuncion($funcion);
		
				$ciudad->setParametros($parametros);
		
		
				$resultado=$ciudad->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Gastos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_ciudad;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("Gastos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Gastos"
		
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
			if(isset($_GET["id_gastos"]))
			{
				$id_gastos=(int)$_GET["id_gastos"];
				
				$gastos=new GastosModel();
				
				$gastos->deleteBy(" id_gastos",$id_gastos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Gastos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_gastos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("Gastos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Gastos"
			
			));
		}
				
	}
	
	
	
	
	
	
}
?>