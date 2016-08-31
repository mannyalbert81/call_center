<?php
class RazonAvocoController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		
		$documentos = new DocumentosModel();
		
		$columnas = "juicios.juicio_referido_titulo_credito";
		$tablas   = "public.juicios,
					  public.documentos";
		$where    = " juicios.id_juicios = documentos.id_juicio ";
		$id = "juicios.juicio_referido_titulo_credito";
		 
		//creamos array con la consulta de registros
		$resultSet=$documentos->getCondiciones($columnas, $tablas, $where, $id);
		
		
		$id_juicios = "";
		$id_documentos = "";
		
		
		
		
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$datos=array();
			
			//NOTIFICACIONES
			$documentos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "ConsultaAvocoSecretarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
				
				$resultEdit = "";
				
				if(isset($_GET["id_juicios"]) && isset($_GET["id_avoco_conocimiento"]))
				{
					$avoco_conocimiento = new AvocoConocimientoModel();
						
					$id_juicios = $_GET["id_juicios"];
					$id_avoco_conocimiento = $_GET["id_avoco_conocimiento"];
				
					$datos=array("idJuicios"=>$id_juicios,"idAvoco"=>$id_avoco_conocimiento);
					
				}
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Razon Avoco"
			
				));
				exit();
			
			}
			
			$this->view("RazonAvoco",array(
					 "resultEdit"=>$resultEdit, "resultSet"=>$resultSet,"datos"=>$datos
			
			));
			
			
		}
		else 
		{
			$this->view("Error",array(
					"resultado"=>"Debe Iniciar Sesion"
		
			));
		}
		
	}
	
	
	
	public function InsertaRazonAvoco(){
		
		
		session_start();
		$razon_avoco=new RazonAvocoModel();
		
		$juicio = new  JuiciosModel();
		$nombre_controladores = "ConsultaAvocoSecretarios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $razon_avoco->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		$avoco='';
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			$razon_avoco = new RazonAvocoModel();
		
		//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["id_avoco_conocimiento"]) && isset($_POST["Guardar"]))
			{
				//estado de documento pdf
				$_estado = "";
				$cuerpo="";
				$dato=array();
				
				//identificador de pdf
				$identificador="";
				
				//parametros
				$_id_avoco_conocimiento     = $_POST["id_avoco_conocimiento"];
				$_id_usuario_registra   = $_SESSION['id_usuarios'];
			    $_cuerpo_razon_avoco_conocimiento   = $cuerpo. $_POST["cuerpo_razon_avoco_conocimiento"];
				
				
					if (isset($_POST["Guardar"]))
					{
						
						//Guarda en la base de datos
						
						$consecutivo= new ConsecutivosModel();
						$resultConsecutivo= $consecutivo->getBy("documento_consecutivos='RAZONAVOCO'");
						
						$identificador=$resultConsecutivo[0]->real_consecutivos;
						
						
						$ruta_razon_avoco_conocimiento = "RazonAvoco";
						
						$nombre_razon_avoco_conocimiento = $ruta_razon_avoco_conocimiento.$identificador;
						
						$funcion = "ins_razon_avoco_conocimiento";
					
						$parametros = " '$_id_avoco_conocimiento' ,'$nombre_razon_avoco_conocimiento' , '$ruta_razon_avoco_conocimiento' , '$identificador' , '$_id_usuario_registra' , '$_cuerpo_razon_avoco_conocimiento'";
						$razon_avoco->setFuncion($funcion);
						
						$razon_avoco->setParametros($parametros);
						$resultado=$razon_avoco->Insert();
						
						//auditoria
						$traza=new TrazasModel();
						$_nombre_controlador = "RazonAvoco";
						$_accion_trazas  = "Guardar";
						$_parametros_trazas = $nombre_razon_avoco_conocimiento;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
						//$this->view("Error", array("resultado"=>print_r($resultado)));
						
						$consecutivo->UpdateBy("real_consecutivos=real_consecutivos+1", "consecutivos", "documento_consecutivos='RAZONAVOCO'");
						
						$_estado = "Guardar";
					}
				}
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				
				
				print "<script language='JavaScript'>
				setTimeout(window.open('http://$host$uri/view/ireports/ContRazonAvocoReport.php?identificador=$identificador&estado=$_estado&nombre=$nombre_razon_avoco_conocimiento','Popup','height=300,width=400,scrollTo,resizable=1,scrollbars=1,location=0'), 5000);
				</script>";
				
				print("<script>window.location.replace('index.php?controller=ConsultaAvocoSecretarios&action=consulta_secretarios_avoco_firmados');</script>");
			
			}else
				{
					
					$this->view("Error",array(
						
					"resultado"=>"No tiene Permisos de Insertar Razon Avoco"
		
					));
	
	
				}

	}
	
	public function VisualizarRazonAvoco(){
		
		session_start();
		
		$cuerpo='';
			
		$razon_avoco = new RazonAvocoModel();
		
		$identificador="";
		$_estado="Visualizar";
		$dato=array();
		$arrayGet=array();
		
		if (isset($_POST["Visualizar"]))
		{
			$_id_avoco_conocimiento     = $_POST["id_avoco_conocimiento"];
			$_id_usuario_registra   = $_SESSION['id_usuarios'];
			$_cuerpo_razon_avoco_conocimiento   = $_POST["cuerpo_razon_avoco_conocimiento"];
			
			
             //traer datos para el reporte	
			$dato['cuerpo_razon_avoco_conocimiento']=$cuerpo.$_cuerpo_razon_avoco_conocimiento;
		
			$traza=new TrazasModel();
			$_nombre_controlador = "Avoco";
			$_accion_trazas  = "Visualizar";
			$_parametros_trazas = $_id_avoco_conocimiento;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
			
			//cargar array q va por get
			$arrayGet['cuerpo']=$_cuerpo_razon_avoco_conocimiento;
			$arrayGet['idAvoco']=$_id_avoco_conocimiento;
			
		}
		

		$result=urlencode(serialize($dato));
		
		$resultArray=urlencode(serialize($arrayGet));
		
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
		
        
		print "<script language='JavaScript'>
			 setTimeout(window.open('http://$host$uri/view/ireports/ContRazonAvocoReport.php?estado=$_estado&dato=$result','Popup','height=700,width=800,scrollTo,resizable=1,scrollbars=1,location=0'), 5000); 
		      </script>";
		
		print("<script>window.location.replace('index.php?controller=RazonAvoco&action=index&dato=$resultArray');</script>");
		

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
	
	
	
}
?>
