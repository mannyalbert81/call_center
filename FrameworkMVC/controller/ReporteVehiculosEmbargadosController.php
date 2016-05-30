<?php

class ReporteVehiculosEmbargadosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
		
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$resultDatos=array();
			
			
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "ReporteVehiculosEmbargados";
			$id_rol= $_SESSION['id_rol'];
			
			
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				
				
			
			
			 
					$rol = new RolesModel();
					$resultRol=$rol->getAll("nombre_rol");
					
					$controladores=new ControladoresModel();
					$resultCon=$controladores->getAll("nombre_controladores");
			
			
					
					$resultEdit = "";
					$resul = "";
			
					if (isset ($_GET["id_asignacion_secretarios"])   )
					{
						$nombre_controladores = "ReporteVehiculosEmbargados";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
							
							
							
							
							$resultEdit=$asignacionSecretario->getCondiciones($columnas, $tablas, $where, $id);
							
							
							$traza=new TrazasModel();
							$_nombre_controlador = "ReporteVehiculosEmbargados";
							$_accion_trazas  = "Editar";
							$_parametros_trazas = $_id_asignacion_secretarios;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Aprobacion Auto de Pago"
						
									
							));
						
							exit();
						}
						
						
						
					}
					
					if(isset($_POST["buscar"])){
					
						$criterio_busqueda=$_POST["criterio_busqueda"];
						$contenido_busqueda=$_POST["contenido_busqueda"];
					
						$aprobacion_auto_pago = new AutoPagosModel();
							
							
						$columnas = "   vehiculos_embargados.id_vehiculos_embargados, 
								          tipo_vehiculos.id_tipo_vehiculos,
								          tipo_vehiculos.nombre_tipo_vehiculos, 
										  marca_vehiculos.nombre_marca_vehiculos, 
								           vehiculos_embargados.id_marca_vehiculos,
										  vehiculos_embargados.placa_vehiculos_embargados, 
										  vehiculos_embargados.modelo_vehiculos_embargados, 
										  vehiculos_embargados.fecha_ingreso_vehiculos_embargados, 
										  clientes.id_clientes,
								          clientes.nombres_clientes, 
										  clientes.identificacion_clientes";
						
					
						$tablas   = "public.vehiculos_embargados, 
									  public.clientes, 
									  public.tipo_vehiculos, 
									  public.marca_vehiculos";
														
						$where    = "vehiculos_embargados.id_clientes = clientes.id_clientes AND
									  tipo_vehiculos.id_tipo_vehiculos = vehiculos_embargados.id_tipo_vehiculos AND
									  marca_vehiculos.id_marca_vehiculos = vehiculos_embargados.id_marca_vehiculos";
														
						$id       = "id_vehiculos_embargados";
							
					
						$where_1 = "";
						$where_2 = "";
						
					
						switch ($criterio_busqueda) {
							
							case 0:
								// identificacion de cliente
								$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
								break;
							case 1:
								//id_titulo de credito
								$where_2 = " AND  vehiculos_embargados.placa_vehiculos_embargados = '$contenido_busqueda'  ";
								break;
								    
							}
					
					
					
						$where_to  = $where . $where_1 . $where_2 ;
						
							
						$resultDatos=$aprobacion_auto_pago->getCondiciones($columnas ,$tablas ,$where_to, $id);
					
							
					}
					
					
			
					
				
					
					$this->view("ReporteVehiculosEmbargados",array(
							
							 "resultEdit"=>$resultEdit,"resultRol"=>$resultRol, "resultDatos"=>$resultDatos
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Registro Vehiculos Embargados"
			
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
	 
	
	
	
	

	
}
?>      