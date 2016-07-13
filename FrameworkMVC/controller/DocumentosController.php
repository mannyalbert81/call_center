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
				
			
			$ciudad = new CiudadModel();
			
			$_id_usuarios= $_SESSION["id_usuarios"];
			
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
		
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			$documentos=new DocumentosModel();
		
		
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["id_ciudad"]) )
		{

			$_id_ciudad     = $_POST["id_ciudad"];
			$_id_juicio      = $_POST["id_juicios"];
			$_id_estados_procesales_juicios   = $_POST["id_estados_procesales_juicios"];
			$_fecha_emision_documentos   = $_POST["fecha_emision_documentos"];
			$_hora_emision_documentos   = $_POST["hora_emision_documentos"];
			$_detalle_documentos   = $_POST["detalle_documentos"];
			$_observacion_documentos   = $_POST["observacion_documentos"];
			$_avoco_vistos_documentos   = $_POST["avoco_vistos_documentos"];
			$_id_usuario_registra_documentos   = $_SESSION['id_usuarios'];
		
			
			
			
				$funcion = "ins_documentos";
					
				$parametros = " '$_id_ciudad' ,'$_id_juicio' , '$_id_estados_procesales_juicios' , '$_fecha_emision_documentos' , '$_hora_emision_documentos' , '$_detalle_documentos' , '$_observacion_documentos' , '$_avoco_vistos_documentos', '$_id_usuario_registra_documentos'";
				$documentos->setFuncion($funcion);
				
				$documentos->setParametros($parametros);
				$resultado=$documentos->Insert();
			
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Documentos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_detalle_documentos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				$this->redirect("Documentos", "index");
	
			
		}	
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Documentos"
	
		));
	
	
	}

	}
	
	
	
}
?>
