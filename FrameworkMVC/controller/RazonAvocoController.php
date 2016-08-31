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
				
				if(isset($_GET["id_juicios"]) && isset($_GET["id_avoco"]))
				{
					$documentos = new DocumentosModel();
						
					$id_juicios = $_GET["id_juicios"];
					$id_documentos = $_GET["id_avoco"];
				
					$datos=array("idJuicios"=>$id_juicios,"idAvoco"=>$id_documentos);
					
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
		$resultPer = $razon_documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		$avoco='';
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			$razon_avoco = new RazonAvocoModel();
		
		//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["id_documentos"]) && isset($_POST["Guardar"]))
			{
				//estado de documento pdf
				$_estado = "";
				$cuerpo="";
				$dato=array();
				
				//identificador de pdf
				$identificador="";
				
				//parametros
				$_id_documentos     = $_POST["id_documentos"];
				$_id_usuario_registra   = $_SESSION['id_usuarios'];
			    $_cuerpo_razon_avoco   = $cuerpo. $_POST["cuerpo_razon_avoco"];
				
				
					if (isset($_POST["Guardar"]))
					{
						
						//Guarda en la base de datos
						
						$consecutivo= new ConsecutivosModel();
						$resultConsecutivo= $consecutivo->getBy("documento_consecutivos='RAZONAVOCO'");
						
						$identificador=$resultConsecutivo[0]->real_consecutivos;
						
						
						$ruta_razon_avoco = "RazonAvoco";
						
						$nombre_razon_avoco = $ruta_razon_avoco.$identificador;
						
						$funcion = "ins_razon_avoco";
					
						$parametros = " '$_id_avoco' ,'$nombre_razon_avoco' , '$ruta_razon_avoco' , '$identificador' , '$_id_usuario_registra' , '$_cuerpo_razon_avoco'";
						$razon_avoco->setFuncion($funcion);
						
						$razon_avoco->setParametros($parametros);
						$resultado=$razon_avoco->Insert();
						
						//auditoria
						$traza=new TrazasModel();
						$_nombre_controlador = "RazonAvoco";
						$_accion_trazas  = "Guardar";
						$_parametros_trazas = $nombre_razon_avoco;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
						//$this->view("Error", array("resultado"=>print_r($resultado)));
						
						$consecutivo->UpdateBy("real_consecutivos=real_consecutivos+1", "consecutivos", "documento_consecutivos='RAZONDOCUMENTOS'");
						
						$_estado = "Guardar";
					}
				}
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				
				
				print "<script language='JavaScript'>
				setTimeout(window.open('http://$host$uri/view/ireports/ContRazonDocumentosReport.php?identificador=$identificador&estado=$_estado&nombre=$nombre_razon_documentos','Popup','height=300,width=400,scrollTo,resizable=1,scrollbars=1,location=0'), 5000);
				</script>";
				
				print("<script>window.location.replace('index.php?controller=ConsultaAvvocoSecretarios&action=consulta_secretarios_firmados');</script>");
			
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
			
			//parametros
			$_id_documentos     = $_POST["id_documentos"];
			$_id_usuario_registra   = $_SESSION['id_usuarios'];
			$_cuerpo_razon_documentos   = $_POST["cuerpo_razon_documentos"];
			
             //traer datos para el reporte	
			$dato['cuerpo_razon_documentos']=$cuerpo.$_cuerpo_razon_documentos;
		
			$traza=new TrazasModel();
			$_nombre_controlador = "Documentos";
			$_accion_trazas  = "Visualizar";
			$_parametros_trazas = $_id_documentos;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
			
			//cargar array q va por get
			$arrayGet['cuerpo']=$_cuerpo_razon_documentos;
			$arrayGet['idDocumento']=$_id_documentos;
			
		}
		

		$result=urlencode(serialize($dato));
		
		$resultArray=urlencode(serialize($arrayGet));
		
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
		
        
		print "<script language='JavaScript'>
			 setTimeout(window.open('http://$host$uri/view/ireports/ContRazonDocumentosReport.php?estado=$_estado&dato=$result','Popup','height=700,width=800,scrollTo,resizable=1,scrollbars=1,location=0'), 5000); 
		      </script>";
		
		print("<script>window.location.replace('index.php?controller=RazonDocumentos&action=index&dato=$resultArray');</script>");
		

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
