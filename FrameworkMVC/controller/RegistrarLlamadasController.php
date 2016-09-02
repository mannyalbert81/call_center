<?php
class RegistrarLlamadasController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		$resultSet="";
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
				
		
			
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
				$resultEdit="";
			
				if(isset($_POST["buscar"])){
				
					
					$identificacion=$_POST['identificacion'];
					
					
					if($identificacion==""){
						
					}
					
					else{
				    $clientes = new ClientesModel();
				
				    $columnas = "clientes.id_clientes,
				    		      tipo_identificacion.id_tipo_identificacion,
								  tipo_identificacion.nombre_tipo_identificacion, 
								  clientes.identificacion_clientes, 
								  clientes.nombres_clientes, 
								  clientes.telefono_clientes, 
								  clientes.celular_clientes, 
								  clientes.direccion_clientes, 
				    		      ciudad.id_ciudad,
								  ciudad.nombre_ciudad, 
				    		      tipo_persona.id_tipo_persona,
								  tipo_persona.nombre_tipo_persona";
				
					$tablas=" public.clientes, 
							  public.ciudad, 
							  public.tipo_persona, 
							  public.tipo_identificacion";
				
					$where="ciudad.id_ciudad = clientes.id_ciudad AND
						  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
						  tipo_identificacion.id_tipo_identificacion = clientes.id_tipo_identificacion";
				
					$id="clientes.id_clientes";
				
				
					$where_0 = "";
					
				
				
					
					if($identificacion!=""){$where_0=" AND clientes.identificacion_clientes='$identificacion'";}
				
					
				
					$where_to  = $where . $where_0;
				
					
					$resultSet=$clientes->getCondiciones($columnas ,$tablas , $where_to, $id);
					}
				
				}
				$this->view("RegistrarLlamadas",array(
					"resultSet"=>$resultSet, "resultEdit"=>$resultEdit, "resultTipoIdent"=> $resultTipoIdent, "resultTipoPer"=> $resultTipoPer, "resultCiu"=>$resultCiu
						
			));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Registrar Llamadas"
			
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
		
		
		if (isset ($_POST["Guardar"]) )
		{

			$_id_clientes     = $_POST["id_clientes"];
			$_id_usuario_registra_llamada      = $_SESSION['id_usuarios'];
			$_fecha_registrar_llamadas   = $_POST["fecha_registrar_llamadas"];
			$_hora_registrar_llamadas   = $_POST["hora_registrar_llamadas"];
			$_recibio_registrar_llamadas   = $_POST["recibio_registrar_llamadas"];
			$_persona_contesta_llamada   = $_POST["persona_contesta_llamada"];
			$_observaciones_registra_llamadas   = $_POST["observaciones_registra_llamadas"];
			$_id_parentesco_clientes   = $_POST["parentesco_clientes"];
			
			$funcion = "ins_registrar_llamadas";
			$parametros = " '$_id_clientes' ,'$_id_usuario_registra_llamada' , '$_fecha_registrar_llamadas' , '$_hora_registrar_llamadas' , '$_recibio_registrar_llamadas' , '$_persona_contesta_llamada' , '$_observaciones_registra_llamadas', '$_id_parentesco_clientes'  ";
			$registrar_llamadas->setFuncion($funcion);
			$registrar_llamadas->setParametros($parametros);
			$resultado=$registrar_llamadas->Insert();
			 
			
			$traza=new TrazasModel();
			$_nombre_controlador = "Clientes";
			$_accion_trazas  = "Guardar";
			$_parametros_trazas = $_nombres_clientes;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
		}
			
			
			
			if(isset($_POST["id_clientes"]))
			{
	
				$_id_clientes = $_POST["id_clientes"];
				$_id_tipo_identificacion     = $_POST["id_tipo_identificacion"];
				$_identificacion_clientes      = $_POST["identificacion_clientes"];
				$_nombres_clientes   = $_POST["nombres_clientes"];
				$_telefono_clientes   = $_POST["telefono_clientes"];
				$_celular_clientes   = $_POST["celular_clientes"];
				$_direccion_clientes   = $_POST["direccion_clientes"];
				$_id_ciudad   = $_POST["id_ciudad"];
				$_id_tipo_persona   = $_POST["id_tipo_persona"];
				
				$colval = " id_tipo_identificacion = '$_id_tipo_identificacion',  identificacion_clientes = '$_identificacion_clientes', nombres_clientes = '$_nombres_clientes', telefono_clientes = '$_telefono_clientes', celular_clientes = '$_celular_clientes', direccion_clientes = '$_direccion_clientes', id_ciudad = '$_id_ciudad', id_tipo_persona = '$_id_tipo_persona' ";
				$tabla = "clientes";
				$where = "id_clientes = '$_id_clientes'    ";
					
				$resultado=$registrar_llamadas->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				
				
				
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
