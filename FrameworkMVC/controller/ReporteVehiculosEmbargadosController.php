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

			//creacion ddl de secretarios o abogadpos
			$resultAsignacion=array(0=>'--Seleccione--',1=>'Secretario',2=>'Abg Impulsor');
	
			$permisos_rol = new PermisosRolesModel();
			
			//notificaciones
			$permisos_rol->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "ReporteVehiculosEmbargados";
			$id_rol= $_SESSION['id_rol'];
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
			
			$usuarios=new UsuariosModel();
			$resultUsu = $usuarios->getAll("nombre_usuarios");
			
			$estado=new EstadoModel();
			$resultEstado=$estado->getBy("nombre_estado='PENDIENTE'");
			
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
				
					//CONSULTA DE USUARIOS POR SU ROL 
					$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
					$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
					$id="rol.id_rol";
					
					$usuarios=new UsuariosModel();
					
					$where="rol.nombre_rol='CIUDAD'";
					$resultCiudad=$ciudad->getCondiciones($columnas ,$tablas , $where, $id);
					
					$where="rol.nombre_rol='SECRETARIO'";
					$resultUsuarioSecretario=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
					
					$where="rol.nombre_rol='ABOGADO IMPULSOR'";
					$resultUsuarioImpulsor=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
					
					
					//roles
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
										  tipo_vehiculos.nombre_tipo_vehiculos, 
										  marca_vehiculos.nombre_marca_vehiculos, 
										  vehiculos_embargados.placa_vehiculos_embargados, 
										  vehiculos_embargados.modelo_vehiculos_embargados, 
										  vehiculos_embargados.fecha_ingreso_vehiculos_embargados, 
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