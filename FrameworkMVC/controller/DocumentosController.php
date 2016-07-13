<?php
class DocumentosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
	        
			$juicios = new JuiciosModel();
			$resultJui = $juicios->getAll("juicio_referido_titulo_credito");
			
			$estados_procesales = new EstadosProcesalesModel();
			$resultEstPro = $estados_procesales->getAll("nombre_estado_procesal_juicios");
				
			
			$documentos = new DocumentosModel();
			
			$resulSet=array();

			//NOTIFICACIONES
			$documentos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "Documentos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				
				if(isset($_POST['Validar']))
				{
					
					$juicio = new  JuiciosModel();
					$juicio_referido=$_POST['id_juicios'];
				
					$resulSet=$juicio->getCondiciones("id_juicios,juicio_referido_titulo_credito", "juicios", "juicio_referido_titulo_credito='$juicio_referido'", "id_juicios");
				
				if(!empty($resulSet)){
					
					echo "Existe";
					
				}else{
					
              		echo "No Existe";
				}
					
				}
			
					
			
				$resultEdit = "";
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Documentos"
			
				));
				exit();
			
			}
			
			$this->view("Documentos",array(
					"resultCiu"=>$resultCiu, "resultEdit"=>$resultEdit, "resultJui"=>$resultJui, "resultEstPro"=>$resultEstPro,"resulSet"=>$resulSet
			
			));
			
			
		}
		else 
		{
			$this->view("Error",array(
					"resultado"=>"Debe Iniciar Sesion"
		
			));
			
			
			
		}
		
	}
	
	public function InsertaDocumentos(){
		
		
		session_start();
		$documentos=new DocumentosModel();
		
		$juicio = new  JuiciosModel();
		$nombre_controladores = "Documentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			$documentos=new DocumentosModel();
		
		
		
		//_nombre_categorias character varying, _path_categorias character varying
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
					
				$colval = " id_tipo_identificacion = '$_id_tipo_identificacion',  identificacion_clientes = '$_identificacion_clientes', nombres_clientes = '$_nombres_clientes', telefono_clientes = '$_telefono_clientes', celular_clientes = '$_celular_clientes', direccion_clientes = '$_direccion_clientes', id_ciudad = '$_id_ciudad', id_tipo_persona = '$_id_tipo_persona'  ";
				$tabla = "clientes";
				$where = "id_clientes = '$_id_clientes'    ";
					
				$resultado=$clientes->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				$funcion = "ins_clientes";
					
				$parametros = " '$_id_tipo_identificacion' ,'$_identificacion_clientes' , '$_nombres_clientes' , '$_telefono_clientes' , '$_celular_clientes' , '$_direccion_clientes' , '$_id_ciudad' , '$_id_tipo_persona'";
				$clientes->setFuncion($funcion);
				
				$clientes->setParametros($parametros);
				
				
				$resultado=$clientes->Insert();
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Clientes";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombres_clientes;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				$this->redirect("Clientes", "index");
	
			}
			
			
			
		}	
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Documentos"
	
		));
	
	
	}

	}
	
	
		
		public function consulta(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
	
		$citaciones = new CitacionesModel();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $citaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){
	
					$id_ciudad=$_POST['id_ciudad'];
					$identificacion=$_POST['identificacion'];
					$numero_juicio=$_POST['numero_juicio'];
					$titulo_credito=$_POST['numero_titulo'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
	
					$citaciones= new CitacionesModel();
	
	
					$columnas = "juicios.id_juicios,
					clientes.id_clientes,
  					clientes.nombres_clientes,
  					clientes.identificacion_clientes,
  					ciudad.nombre_ciudad,
  					tipo_persona.nombre_tipo_persona,
  					juicios.juicio_referido_titulo_credito,
  					usuarios.nombre_usuarios,
  					titulo_credito.id_titulo_credito,
  					etapas_juicios.nombre_etapas,
  					tipo_juicios.nombre_tipo_juicios,
  					juicios.creado,
  					titulo_credito.total";
	
					$tablas="public.clientes,
					  public.ciudad,
					  public.tipo_persona,
					  public.juicios,
					  public.titulo_credito,
					  public.etapas_juicios,
					  public.tipo_juicios,
					  public.usuarios";
	
					$where="ciudad.id_ciudad = clientes.id_ciudad AND
					  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
					  juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
					  juicios.id_clientes = clientes.id_clientes AND
					  juicios.id_tipo_juicios = tipo_juicios.id_tipo_juicios AND
					  etapas_juicios.id_etapas_juicios = juicios.id_etapas_juicios AND
					  usuarios.id_usuarios=juicios.id_usuarios";
	
					$id="juicios.id_juicios";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
	
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
	
					if($identificacion!=""){$where_2=" AND clientes.identificacion='$identificacion'";}
	
					if($titulo_credito!=""){$where_3=" AND juicios.id_titulo_credito='$titulo_credito'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  juicios.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
				}
	
	
	
	
				$this->view("ConsultaClientes",array(
						"resultSet"=>$resultSet,"resultCiu"=>$resultCiu
							
				));
	
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Citaciones"
	
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
