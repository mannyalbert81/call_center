<?php
class RegistrarLlamadasController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		
		
		
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//creacion menu busqueda
			//$resultMenu=array("1"=>Nombre,"2"=>Usuario,"3"=>Correo,"4"=>Rol);
			$resultMenu=array(0=>'--Seleccione--',1=>'Nombre', 2=>'Identificación');
			//Creamos el objeto usuario
			
			$tipo_identificacion = new TipoIdentificacionModel();
			$resultTipoIdent = $tipo_identificacion->getAll("nombre_tipo_identificacion");
			
			$tipo_persona = new TipoPersonaModel();
			$resultTipoPer =$tipo_persona->getAll("nombre_tipo_persona");
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
	        
		
            $registrar_llamadas = new RegistrarLLamadasModel();	
             //NOTIFICACIONES
			$registrar_llamadas->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "RegistrarLlamadas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $registrar_llamadas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$columnas = " clientes.id_clientes, tipo_identificacion.nombre_tipo_identificacion,tipo_identificacion.id_tipo_identificacion, clientes.identificacion_clientes, clientes.nombres_clientes, clientes.telefono_clientes, clientes.celular_clientes, clientes.direccion_clientes, ciudad.nombre_ciudad, ciudad.id_ciudad, tipo_persona.nombre_tipo_persona, tipo_persona.id_tipo_persona";
					$tablas   = "public.clientes, public.ciudad, public.tipo_persona, public.tipo_identificacion";
					$where    = "clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND clientes.id_ciudad = ciudad.id_ciudad AND clientes.id_tipo_persona = tipo_persona.id_tipo_persona";
					$id       = "clientes.identificacion_clientes"; 
			
				
					$resultSet=$registrar_llamadas->getCondiciones($columnas ,$tablas ,$where, $id);
					
					
					$resultEdit = "";
			
					if (isset ($_GET["id_clientes"])   )
					{
						$_id_clientes = $_GET["id_clientes"];
					    $where    = " clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND clientes.id_ciudad = ciudad.id_ciudad AND clientes.id_tipo_persona = tipo_persona.id_tipo_persona AND clientes.id_clientes = '$_id_clientes' "; 
						$resultEdit = $registrar_llamadas->getCondiciones($columnas ,$tablas ,$where, $id); 
					
						$traza=new TrazasModel();
						$_nombre_controlador = "Clientes";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_clientes;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					}
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Registrar Llamadas"
			
				));
			
			}
			
			
			$resultPerVer= $registrar_llamadas->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPerVer))
			{
				if (isset ($_POST["criterio"])  && isset ($_POST["contenido"])  )
				{
				
					$columnas = " clientes.id_clientes, 
							tipo_identificacion.nombre_tipo_identificacion, 
							clientes.identificacion_clientes, 
							clientes.nombres_clientes, 
							clientes.telefono_clientes, 
							clientes.celular_clientes, 
							clientes.direccion_clientes, 
							ciudad.nombre_ciudad, 
							tipo_persona.nombre_tipo_persona";
					
					$tablas   = "public.clientes, public.ciudad, public.tipo_persona, public.tipo_identificacion";
					$where    = "clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND clientes.id_ciudad = ciudad.id_ciudad AND clientes.id_tipo_persona = tipo_persona.id_tipo_persona";
					$id       = "clientes.identificacion_clientes"; 

					$criterio = $_POST["criterio"];
					$contenido = $_POST["contenido"];
						
					
					//$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
						
					if ($contenido !="")
					{
							
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						
							
						switch ($criterio) {
							case 0:
								$where_0 = "OR  clientes.nombres_clientes LIKE '$contenido'   OR clientes.identificacion_clientes LIKE '$contenido'";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  clientes.nombres_clientes LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND clientes.identificacion_clientes LIKE '$contenido'  ";
								break;
							
						}
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2;
							
						$resul = $where_to;
						
						//Conseguimos todos los usuarios con filtros
						$resultSet=$registrar_llamadas->getCondiciones($columnas ,$tablas ,$where_to, $id);
							
								
					}
				}
			}
			
			//"resultMenu"=>$resultMenu
			
			$this->view("RegistrarLlamadas",array(
					"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultMenu"=>$resultMenu, "resultTipoIdent"=> $resultTipoIdent, "resultTipoPer"=> $resultTipoPer, "resultCiu"=>$resultCiu
			
			));
			
			
		}
		else 
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
			));
			
		}
		
	}
	
	public function InsertaRegistrarLlamadas(){
		
		session_start();
		$registrar_llamadas = new RegistrarLLamadasModel();	

		$nombre_controladores = "RegistrarLlamadas";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $registrar_llamadas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			$registrar_llamadas = new RegistrarLLamadasModel();
			$resultado = null;
		
		
		if (isset ($_POST["identificacion_clientes"]) )
		{

			$_id_tipo_identificacion     = $_POST["id_tipo_identificacion"];
			$_identificacion_clientes      = $_POST["identificacion_clientes"];
			$_nombres_clientes   = $_POST["nombres_clientes"];
			$_telefono_clientes   = $_POST["telefono_clientes"];
			$_celular_clientes   = $_POST["celular_clientes"];
			$_direccion_clientes   = $_POST["direccion_clientes"];
			$_id_ciudad   = $_POST["id_ciudad"];
			$_id_tipo_persona   = $_POST["id_tipo_persona"];
			
			
			if(isset($_POST["id_clientes"]))
			{
	
				$_id_clientes = $_POST["id_clientes"];
					
				$colval = " id_tipo_identificacion = '$_id_tipo_identificacion',  identificacion_clientes = '$_identificacion_clientes', nombres_clientes = '$_nombres_clientes', telefono_clientes = '$_telefono_clientes', celular_clientes = '$_celular_clientes', direccion_clientes = '$_direccion_clientes', id_ciudad = '$_id_ciudad', id_tipo_persona = '$_id_tipo_persona' ";
				$tabla = "clientes";
				$where = "id_clientes = '$_id_clientes'    ";
					
				$resultado=$registrar_llamadas->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				$funcion = "ins_clientes";
					
				$parametros = " '$_id_tipo_identificacion' ,'$_identificacion_clientes' , '$_nombres_clientes' , '$_telefono_clientes' , '$_celular_clientes' , '$_direccion_clientes' , '$_id_ciudad' , '$_id_tipo_persona' ";
				$registrar_llamadas->setFuncion($funcion);
				
				$registrar_llamadas->setParametros($parametros);
				$resultado=$registrar_llamadas->Insert();
			    
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Clientes";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombres_clientes;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				
			}
			$this->redirect("RegistrarLlamadas", "index");
			
		}
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Registrar Llamadas"
	
		));
	
	
	}

	}
	
	
	
	
}
?>
