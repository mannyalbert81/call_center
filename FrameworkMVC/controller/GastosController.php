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
		
		
		//Conseguimos todos los usuarios
		$columnas = "clientes.id_clientes,
				     clientes.nombres_clientes, 
                     juicios.juicio_referido_titulo_credito";
		$tablas   = "public.clientes, 
                     public.juicios";
		$where    = "juicios.id_clientes = clientes.id_clientes";
		$id = "juicios.juicio_referido_titulo_credito";
		 
		//creamos array con la consulta de registros
		$resultSet=$clientes->getCondiciones($columnas, $tablas, $where, $id);
		
		$oficios = new OficiosModel();
		
		
		//Conseguimos todos los usuarios
		$columnas = "oficios.id_oficios, 
                     oficios.numero_oficios";
		$tablas   = "public.oficios";
		
		$id = "oficios.numero_oficios";
			
		//creamos array con la consulta de registros
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
						
					$criterio_busqueda=$_POST["criterio_busqueda"];
					$contenido_busqueda=$_POST["contenido_busqueda"];
						
					$clientes = new ClientesModel();
						
						
					$columnas = " auto_pagos.id_auto_pagos,
									  titulo_credito.id_titulo_credito,
									  juicios.juicio_referido_titulo_credito,
									  clientes.identificacion_clientes,
									  clientes.nombres_clientes,
									  titulo_credito.total,
									  titulo_credito.fecha_corte,
									  titulo_credito.fecha_emision,
									  titulo_credito.fecha_juicio_titulo_credito,
									  estado.nombre_estado,
									  auto_pagos.id_usuario_asigna,
									  usuarios.nombre_usuarios";
						
					$tablas   = " public.clientes,
									  public.titulo_credito,
									  public.juicios,
									  public.auto_pagos,
									  public.estado,
									  public.usuarios";
						
					$where    = "clientes.id_clientes = titulo_credito.id_clientes AND
									  titulo_credito.id_titulo_credito = juicios.id_titulo_credito AND
									  auto_pagos.id_titulo_credito = titulo_credito.id_titulo_credito AND
									  auto_pagos.id_estado = estado.id_estado AND estado.nombre_estado = 'APROBADO' AND
									  usuarios.id_usuarios = auto_pagos.id_usuario_asigna";
						
					$id       = "titulo_credito.id_titulo_credito";
						
						
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
						
					switch ($criterio_busqueda) {
							
						case 0:
							// identificacion de cliente
							$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
							break;
						case 1:
							//id_titulo de credito
							$where_2 = " AND  titulo_credito.id_titulo_credito = '$contenido_busqueda'  ";
							break;
				
						case 2:
							//id_titulo de credito
							$where_3 = " AND  juicios.juicio_referido_titulo_credito = '$contenido_busqueda'  ";
							break;
								
					}
						
						
						
					$where_to  = $where . $where_1 . $where_2 . $where_3;
				
						
					$resultDatos=$impresion_auto_pago->getCondiciones($columnas ,$tablas ,$where_to, $id);
						
						
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