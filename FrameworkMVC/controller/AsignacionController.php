<?php
class AsignacionController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
		
			$clientes = new ClientesModel();
			$usuarios = new UsuariosModel();
			$resultMenu=array(0=>'--Seleccione--',1=>'Nombre', 2=>'Identificaci�n');
			
			$nombre_controladores = "Asignacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
				$columnas = " usuarios.id_usuarios,  usuarios.nombre_usuarios, usuarios.usuario_usuarios ,  usuarios.telefono_usuarios, usuarios.celular_usuarios, usuarios.correo_usuarios, rol.nombre_rol, estado.nombre_estado, rol.id_rol, estado.id_estado, usuarios.cedula_usuarios, ciudad.id_ciudad, ciudad.nombre_ciudad";
				$tablas   = "public.rol,  public.usuarios, public.estado, public.ciudad";
				$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND ciudad.id_ciudad = usuarios.id_ciudad AND rol.nombre_rol='OPERADOR'";
				$id       = "usuarios.nombre_usuarios";
				$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
					
				
					$this->view("Asignacion",array(
							"resultSet"=>$resultSet, "resultMenu"=>$resultMenu
								
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Asignacion"
			
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
	
	public function InsertaAsignacion(){
		
		session_start();
		$clientes=new ClientesModel();

		$nombre_controladores = "Asignacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $clientes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			$clientes=new ClientesModel();
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
			$_nombre_garantes   = $_POST["nombre_garantes"];
			$_identificacion_garantes   = $_POST["identificacion_garantes"];
			
			if(isset($_POST["id_clientes"]))
			{
	
				$_id_clientes = $_POST["id_clientes"];
					
				$colval = " id_tipo_identificacion = '$_id_tipo_identificacion',  identificacion_clientes = '$_identificacion_clientes', nombres_clientes = '$_nombres_clientes', telefono_clientes = '$_telefono_clientes', celular_clientes = '$_celular_clientes', direccion_clientes = '$_direccion_clientes', id_ciudad = '$_id_ciudad', id_tipo_persona = '$_id_tipo_persona', nombre_garantes = '$_nombre_garantes', identificacion_garantes = '$_identificacion_garantes'  ";
				$tabla = "clientes";
				$where = "id_clientes = '$_id_clientes'    ";
					
				$resultado=$clientes->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				$funcion = "ins_clientes";
					
				$parametros = " '$_id_tipo_identificacion' ,'$_identificacion_clientes' , '$_nombres_clientes' , '$_telefono_clientes' , '$_celular_clientes' , '$_direccion_clientes' , '$_id_ciudad' , '$_id_tipo_persona' , '$_nombre_garantes' , '$_identificacion_garantes'";
				$clientes->setFuncion($funcion);
				
				$clientes->setParametros($parametros);
				$resultado=$clientes->Insert();
			    
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Asignacion";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombres_clientes;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				
			}
			$this->redirect("Asignacion", "index");
			
		}
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Asignacion"
	
		));
	
	
	}

	}
	
	
    
   
	
	
	public function consulta_clientes(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getBy("nombre_ciudad='QUITO' OR nombre_ciudad='GUAYAQUIL'"); 
		
		$clientes = new ClientesModel();
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){
	
					$id_ciudad=$_POST['id_ciudad'];
					$identificacion=$_POST['identificacion'];
					$nombre_clientes=$_POST['nombres_clientes'];
					$celular_clientes=$_POST['celular_clientes'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
	
					$clientes = new ClientesModel();
	
	
					$columnas = "clientes.id_clientes, 
							  tipo_identificacion.nombre_tipo_identificacion, 
							  clientes.identificacion_clientes, 
							  clientes.nombres_clientes, 
							  clientes.telefono_clientes, 
							  clientes.celular_clientes, 
							  clientes.direccion_clientes, 
							  ciudad.nombre_ciudad, 
							  tipo_persona.nombre_tipo_persona, 
							  clientes.creado";
	
					$tablas="public.clientes, 
							  public.ciudad, 
							  public.tipo_persona, 
							  public.tipo_identificacion";
	
					$where=" ciudad.id_ciudad = clientes.id_ciudad AND
							  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
							  tipo_identificacion.id_tipo_identificacion = clientes.id_tipo_identificacion";
								
					$id="clientes.id_clientes";
						
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
					
					if($identificacion!=""){$where_1=" AND clientes.identificacion_clientes='$identificacion'";}
						
					if($nombre_clientes!=""){$where_2=" AND clientes.nombres_clientes='$nombre_clientes'";}
					
					if($celular_clientes!=""){$where_3=" AND clientes.celular_clientes='$celular_clientes'";}
						
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  clientes.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$clientes->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
				}
	                    $this->view("ConsultaClientes",array(
						"resultSet"=>$resultSet, "resultCiu"=>$resultCiu
							
				));
	
	         }
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consutar Clientes"
	
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
	
}
?>
