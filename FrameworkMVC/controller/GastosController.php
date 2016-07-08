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
		
		
		$columnas = "oficios.id_oficios, 
					  oficios.numero_oficios, 
					  juicios.juicio_referido_titulo_credito, 
					  clientes.identificacion_clientes, 
					  clientes.nombres_clientes";
		
		$tablas   = "public.clientes, 
					  public.juicios, 
					  public.oficios";
		
		$where    = "juicios.id_clientes = clientes.id_clientes AND
  						oficios.id_juicios = juicios.id_juicios";
		
		$id = "juicios.juicio_referido_titulo_credito";
		 
	
		$resultSet=$clientes->getCondiciones($columnas, $tablas, $where, $id);
		
		
		
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//Notificaciones
			$gastos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
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
						
						
					$columnas = "oficios.id_oficios, 
								  oficios.numero_oficios, 
								  juicios.juicio_referido_titulo_credito, 
								  clientes.identificacion_clientes, 
								  clientes.nombres_clientes";
					
					$tablas   = "public.clientes, 
								  public.juicios, 
								  public.oficios";
					
					$where    = "juicios.id_clientes = clientes.id_clientes AND
 								 oficios.id_juicios = juicios.id_juicios";
					
					$id = "juicios.juicio_referido_titulo_credito";
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
						
					switch ($criterio_busqueda) {
							
						case 0:
							// identificacion de cliente
							$where_0 = "";
							break;
							
						case 1:
								// identificacion de cliente
							$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
							break;
							
						case 2:
							//id_titulo de credito
							$where_2 = " AND  juicios.juicio_referido_titulo_credito = '$contenido_busqueda'  ";
							break;
				
						case 3:
								//id_titulo de credito
							$where_3 = " AND   oficios.numero_oficios = '$contenido_busqueda'  ";
							break;
								
					}
						
						
						
					$where_to  = $where .$where_0 . $where_1 . $where_2 . $where_3 ;
				
					$resultSet=$clientes->getCondiciones($columnas, $tablas, $where_to, $id);
					
						
						
				}
				
				
				
				$this->view("Gastos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultEnti" =>$resultEnti 
			
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
			
			if (isset ($_POST["Guardar"]) )
			
			{
				$_id_entidades = $_POST["id_entidades"];
				$_array_oficios = $_POST["id_oficios"];
				
			
				foreach($_array_oficios  as $id  )
				{
					if (!empty($id) )
					{
						//busco si exties este nuevo id
						try
						{
							$_id_oficios = $id;
			
							
							$funcion = "ins_gastos";
							$parametros = "'$_id_oficios','$_id_entidades' ";
							$gastos->setFuncion($funcion);
							$gastos->setParametros($parametros);
							$resultado=$gastos->Insert();
							
			
						} catch (Exception $e)
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Asignar ->". $id
							));
						}
			
					}
						
				}
					
				$traza=new TrazasModel();
				$_nombre_controlador = "Gastos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_oficios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
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