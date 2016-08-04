<?php
class DocumentosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		
		//$dato=array();
		
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
			
			$juicios = new JuiciosModel();
			$resultJui = $juicios->getAll("juicio_referido_titulo_credito");
			
			$estados_procesales = new EstadosProcesalesModel();
			$resultEstPro = $estados_procesales->getBy("nombre_estado_procesal_juicios='Providencia'");
			
			
			
			$_id_usuarios= $_SESSION["id_usuarios"];
			
			//notificaciones
			$juicios->MostrarNotificaciones($_id_usuarios);
			
			$columnas = " usuarios.id_ciudad,
					  ciudad.nombre_ciudad,
					  usuarios.nombre_usuarios";
				
			$tablas   = "public.usuarios,
                     public.ciudad";
				
			$where    = "ciudad.id_ciudad = usuarios.id_ciudad AND usuarios.id_usuarios = '$_id_usuarios'";
				
			$id       = "usuarios.id_ciudad";
			
				
			$resultDatos=$ciudad->getCondiciones($columnas ,$tablas ,$where, $id);
			

			
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
					$juicio_referido=$_POST['juicios'];
				
					$resulSet=$juicio->getCondiciones("id_juicios,juicio_referido_titulo_credito", "juicios", "juicio_referido_titulo_credito='$juicio_referido'", "id_juicios");
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
					"resultCiu"=>$resultCiu, "resultEdit"=>$resultEdit, "resultJui"=>$resultJui, "resultEstPro"=>$resultEstPro,"resulSet"=>$resulSet, "resultDatos"=>$resultDatos
			
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
		
		$avoco='';
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			$documentos=new DocumentosModel();
		
		
		
		//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["id_juicios"]) && isset($_POST["Guardar"]))
			{
				//estado de documento pdf
				$_estado = "";
				
				$dato=array();
				
				//identificador de pdf
				$identificador="";
				
				//parametros
				$_id_ciudad     = $_POST["id_ciudad"];
				$_id_juicio      = $_POST["id_juicios"];
				$_id_estados_procesales_juicios   = $_POST["id_estados_procesales_juicios"];
				$_fecha_emision_documentos   = $_POST["fecha_emision_documentos"];
				$_hora_emision_documentos   = $_POST["hora_emision_documentos"];
				$_detalle_documentos   = $_POST["detalle_documentos"];
				$_observacion_documentos   = $_POST["observacion_documentos"];
				$_avoco_vistos_documentos   = $avoco. $_POST["avoco_vistos_documentos"];
				$_id_usuario_registra_documentos   = $_SESSION['id_usuarios'];
				
			
					if (isset($_POST["Guardar"]))
					{
						
						//Guarda en la base de datos
						
						$consecutivo= new ConsecutivosModel();
						$resultConsecutivo= $consecutivo->getBy("documento_consecutivos='PROVIDENCIAS'");
						
						$identificador=$resultConsecutivo[0]->real_consecutivos;
						
						
						$repositorio_documento="Providencias";
						
						$nombre_documento=$repositorio_documento.$identificador;
						
						$funcion = "ins_documentos_report";
							
						$parametros = " '$_id_ciudad' ,'$_id_juicio' , '$_id_estados_procesales_juicios' , '$_fecha_emision_documentos' , '$_hora_emision_documentos' , '$_detalle_documentos' , '$_observacion_documentos' , '$_avoco_vistos_documentos', '$_id_usuario_registra_documentos','$identificador','$nombre_documento','$repositorio_documento'";
						$documentos->setFuncion($funcion);
						
						$documentos->setParametros($parametros);
						$resultado=$documentos->Insert();
						
						//auditoria
						$traza=new TrazasModel();
						$_nombre_controlador = "Documentos";
						$_accion_trazas  = "Guardar";
						$_parametros_trazas = $_detalle_documentos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
						//$this->view("Error", array("resultado"=>print_r($resultado)));
						
						$consecutivo->UpdateBy("real_consecutivos=real_consecutivos+1", "consecutivos", "documento_consecutivos='PROVIDENCIAS'");
						
						$_estado = "Guardar";
					}
				}
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				
				
				print "<script language='JavaScript'>
				setTimeout(window.open('http://$host$uri/view/ireports/ContDocumentosReport.php?identificador=$identificador&estado=$_estado&nombre=$nombre_documento','Popup','height=300,width=400,scrollTo,resizable=1,scrollbars=1,location=0'), 5000);
				</script>";
				
				print("<script>window.location.replace('index.php?controller=Documentos&action=index');</script>");
				
				
				
				
			
			}else
				{
					
					$this->view("Error",array(
						
					"resultado"=>"No tiene Permisos de Insertar Documentos"
		
					));
	
	
				}

	}
	
	public function VisualizarDocumentos(){
		
		session_start();
		
		$avoco='';
			
		$documentos = new DocumentosModel();
		$juicios = new JuiciosModel();
		$ciudad = new CiudadModel();
		
		$identificador="";
		$_estado="Visualizar";
		$dato=array();
		$arrayGet=array();
		
		if (isset($_POST["Visualizar"]))
		{
			
			//parametros
			$_id_ciudad     = $_POST["id_ciudad"];
			$_id_juicio      = $_POST["id_juicios"];
			$_id_estados_procesales_juicios   = $_POST["id_estados_procesales_juicios"];
			$_fecha_emision_documentos   = $_POST["fecha_emision_documentos"];
			$_hora_emision_documentos   = $_POST["hora_emision_documentos"];
			$_detalle_documentos   = $_POST["detalle_documentos"];
			$_observacion_documentos   = $_POST["observacion_documentos"];
			$_avoco_vistos_documentos   = $_POST["avoco_vistos_documentos"];
			$_id_usuario_registra_documentos   = $_SESSION['id_usuarios'];
			
			//traer datos temporales para el reporte
			$resultCiudad = $ciudad->getBy("id_ciudad='$_id_ciudad'");	
			
			//consulta datos de juicio
			$columnas="juicios.juicio_referido_titulo_credito,
			clientes.nombres_clientes";
			
			$tablas="public.juicios,public.clientes";
			
			$where="clientes.id_clientes = juicios.id_clientes AND  juicios.id_juicios='$_id_juicio'";
			
			$resultJuicio = $juicios->getCondiciones($columnas, $tablas, $where, "clientes.id_clientes");
			
			
			//cargar datos para el reporte
			
			$dato['ciudad']=$resultCiudad[0]->nombre_ciudad;
			$dato['juicio_referido']=$resultJuicio[0]->juicio_referido_titulo_credito;
			$dato['cliente']=$resultJuicio[0]->nombres_clientes;
			$dato['fecha_emision_documentos']=$_fecha_emision_documentos;
			$dato['hora_emision_documentos']=$_hora_emision_documentos;
			$dato['avoco_vistos_documentos']=$avoco.$_avoco_vistos_documentos;
		
			$traza=new TrazasModel();
			$_nombre_controlador = "Documentos";
			$_accion_trazas  = "Visualizar";
			$_parametros_trazas = $_detalle_documentos;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
			
			//cargar array q va por get
			
			$arrayGet['id_juicio']=$_id_juicio;
			$arrayGet['juicio']=$resultJuicio[0]->juicio_referido_titulo_credito;
			$arrayGet['detalle']=$_detalle_documentos;
			$arrayGet['observacion']=$_observacion_documentos;
			$arrayGet['avoco']=$_avoco_vistos_documentos;
			
		}
		

		$result=urlencode(serialize($dato));
		
		$resultArray=urlencode(serialize($arrayGet));
		
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
		
        
		print "<script language='JavaScript'>
			 setTimeout(window.open('http://$host$uri/view/ireports/ContDocumentosReport.php?estado=$_estado&dato=$result','Popup','height=700,width=800,scrollTo,resizable=1,scrollbars=1,location=0'), 5000); 
		      </script>";
		
		print("<script>window.location.replace('index.php?controller=Documentos&action=index&dato=$resultArray');</script>");
		

	}
	
	
	public function GuardarReporte()
	{
		$resultado=$_GET['dato'];
		
		$result=explode(".", $resultado);
		
		$documentos = new  DocumentosModel();
		
		$result=$documentos->UpdateBy("ruta_documento='$result[0]',nombre_documento='$result[1]'", "documentos", "identificador='$result[2]'");
		
	}
	
	public function verError(){
		$resultado=$_GET['dato'];
		$this->view("error", array('resultado'=>print_r($resultado)));
	}
	
	public function devuelveArray($dato)
	{
		$a=stripslashes($dato);
		
		$array=urldecode($a);
		
		$array=unserialize($a);
		
		return $array;
	}
	
	public function prueba(){
	
		//Creamos el objeto usuario
		//$usuarios=new UsuariosModel();
		 
		//Conseguimos todos los usuarios
		//$allusers=$usuarios->getLogin();
		 
		//Cargamos la vista index y l e pasamos valores
		$this->view("Bienvenida",array(
				"allusers"=>""
		));
	}
	
	//funcion para los pdf rechazados por los secretarios
	public function  pdfRechazado()
	{
		$archivo="";
		$this->view("Error",array(
				"resultado"=>"Archivo ".$archivo." fue eliminado"
		));
	}
	
}
?>
