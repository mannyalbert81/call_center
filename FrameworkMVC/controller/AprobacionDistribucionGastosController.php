<?php


class AprobacionDistribucionGastosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	//maycol

	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$resultEdit="";
			$resultSet=array();
			
			//creacion ddl de secretarios o abogadpos
			
	
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "AprobacionDistribucionGastos";
			$id_rol= $_SESSION['id_rol'];
			
			$aprobacion_distribucion_gastos = new DistribucionGastosModel();
			
			//NOTIFICACIONES
			$aprobacion_distribucion_gastos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$estado=new EstadoModel();
			$resultEstado=$estado->getBy("nombre_estado='PENDIENTE'");
			
			$resultPer = $permisos_rol->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
				
					
					if(isset($_POST["buscar"])){
					
						$criterio_busqueda=$_POST["criterio_busqueda"];
						$contenido_busqueda=$_POST["contenido_busqueda"];
						$id_estado=$resultEstado[0]->id_estado;
					
							
							
						$columnas="distribucion_gastos.id_distribucion_gastos,	 
							  tipo_gastos.nombre_tipo_gastos,
							  titulo_credito.id_titulo_credito, 
							  juicios.juicio_referido_titulo_credito,
							  oficios.nombre_oficios,
							  oficios.numero_oficios,
							  distribucion_gastos.documento_soporte_distribucion_gastos,
							  distribucion_gastos.creado, 
							  distribucion_gastos.descripcion_distribucion_gastos, 
							  estado.nombre_estado, 
							 distribucion_gastos.numero_documento_distribucion_gastos, 
 							 distribucion_gastos.a_favor_de_distribucion_gastos, 
							  tipo_gastos.valor_tipo_gasto,juicios.id_ciudad";
					$tablas="public.clientes, 
							  public.distribucion_gastos, 
							  public.juicios, 
							  public.oficios, 
							  public.estado, 
							  public.titulo_credito, 
							  public.tipo_gastos,
							  public.ciudad";
					$where="clientes.id_clientes = juicios.id_clientes AND
							  distribucion_gastos.id_oficios = oficios.id_oficios AND
							  juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
							  oficios.id_juicios = juicios.id_juicios AND
							  estado.id_estado = distribucion_gastos.id_estado AND
							  tipo_gastos.id_tipo_gastos = distribucion_gastos.id_tipo_gastos
							  AND ciudad.id_ciudad = juicios.id_ciudad AND
							  estado.id_estado = '$id_estado'";
					
					$id       = "distribucion_gastos.id_distribucion_gastos";
							
					
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
					
						switch ($criterio_busqueda) {
							
							case 1:
								// identificacion de cliente
								$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
								break;
							case 2:
								//id_titulo de credito
								$where_2 = " AND  titulo_credito.id_titulo_credito = '$contenido_busqueda'  ";
								break;
							case 3:
									//id_titulo de credito
								$where_3 = " AND   oficios.numero_juicios = '$contenido_busqueda'  ";
								break;
					
						}
					
					
					
						$where_to  = $where . $where_1 . $where_2;
						
							
						$resultSet=$aprobacion_distribucion_gastos->getCondiciones($columnas ,$tablas ,$where_to, $id);
					
							
					}
					
					
			
					
				
					
					$this->view("AprobacionDistribucionGastos",array(
							
							 "resultEdit"=>$resultEdit, "resultSet"=>$resultSet
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Aprobacion Distribucion Gastos"
			
				));
			
			
			}
			
		}
		else
		{
	
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
						));
		}
	
	}
	 
	public function ActualizarDistribucionGastos(){
		session_start();
		
		$resultado = null;
		$permisos_rol = new PermisosRolesModel();
		$aprobacion_distribucion_gastos = new DistribucionGastosModel();
		$nombre_controladores = "AprobacionDistribucionGastos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			if(isset($_GET["id_distribucion_gastos"])){
				
			
				
				$estado=new EstadoModel();
				$resultEstado=$estado->getBy("nombre_estado='APROBADO'");
				
				$id_estado=$resultEstado[0]->id_estado;
				$id_distribucion_gastos=$_GET["id_distribucion_gastos"];
				
				$colval="id_estado='$id_estado'";
				
				$tabla="distribucion_gastos";
				
				$where="id_distribucion_gastos='$id_distribucion_gastos'";
				
				try {

					$resultado=$aprobacion_distribucion_gastos->UpdateBy($colval, $tabla, $where);
					
					
				} catch (Exception $e) {
					
					$this->view("Error",array(
							"resultado"=>"Eror al Aprobar Auto pago ->". $id_distribucion_gastos
					));
					
				}
				
				
				
			}
			
			$this->redirect("AprobacionDistribucionGastos", "index");
		
		}
		
	}
	
	public function InsertaAutoPagos(){

		session_start();
		
		$resultado = null;
		$permisos_rol=new PermisosRolesModel();
		$auto_pagos = new AutoPagosModel();
	    $nombre_controladores = "AutoPagos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $auto_pagos->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			

			if (isset ($_POST["Guardar"])   )
			{
				
				$_array_titulo_credito = $_POST["id_titulo_credito"];
				$_usuario_asigna = $_SESSION['id_usuarios'];
				$_id_ciudad = $_POST["id_ciudad"];
				$_id_usuario_impulsor = $_POST["id_usuarioImpulsor"];
				$_id_usuario_agente = $_POST["id_usuarioAgente"];
				$_fecha_asignado=$_POST["fecha_asignacion"];
				$_estado =$_POST["id_estado"];
				
				foreach($_array_titulo_credito  as $id  )
				{
						if (!empty($id) )
					{
						//busco si exties este nuevo id
						try 
						{
							$_id_titulo_credito = $id;
							//parametros  _id_titulo_credito integer, _id_usuario_asigna integer, _id_usuario_impulsor integer, _id_usuario_agente integer, _id_estado integer, _fecha_asiganacion_auto_pagos date
							$funcion = "ins_auto_pagos";
							$parametros = "'$_id_titulo_credito','$_usuario_asigna', '$_id_usuario_impulsor','$_id_usuario_agente','$_estado','$_fecha_asignado'";
							$auto_pagos->setFuncion($funcion);
							$auto_pagos->setParametros($parametros);
							$resultado=$auto_pagos->Insert();
										
						} catch (Exception $e) 
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Asignar ->". $id
							));
						}
							
					}
					 
				}
				$traza=new TrazasModel();
				$_nombre_controlador = "AutoPagos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_titulo_credito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
		
				
			}
			
			

			$this->redirect("AutoPagos", "index");
				
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Asignacion Titulo Credito"
		
			));
		
		
		}
		
		
		
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$subcategorias=new SubCategoriasModel();
		//Conseguimos todos los usuarios
	
	
		$columnas = " subcategorias.id_subcategorias, categorias.nombre_categorias, subcategorias.nombre_subcategorias, subcategorias.path_subcategorias";
		$tablas   = "public.subcategorias, public.categorias";
		$where    = "subcategorias.id_categorias = categorias.id_categorias";
		$id       = "categorias.nombre_categorias,subcategorias.nombre_subcategorias";
		
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $subcategorias->getCondicionesPDF($columnas, $tablas, $where, $id);
			
			$this->report("SubCategorias",array(	"resultRep"=>$resultRep));
	
		}
			
	
	}
	

	
}
?>      