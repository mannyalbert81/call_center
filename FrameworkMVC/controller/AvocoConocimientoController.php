<?php
class AvocoConocimientoController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    
    
    
    
public function index(){
	
		session_start();
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$ciudad = new CiudadModel();
			$usarios= new UsuariosModel();
			$avoco = new AvocoConocimientoModel();
			
			$resulSecretario=array();
			$resultDatos=array();
			$resulSet=array();
			
			$_id_usuarios= $_SESSION["id_usuarios"];
			
			//notificaciones
			$usarios->MostrarNotificaciones($_id_usuarios);
			
			$documentos = new DocumentosModel();
			
			
			$nombre_controladores = "Avoco";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				
				if(isset($_POST['Validar']))
				{
					$resultDatos=$ciudad->getAll("nombre_ciudad");
					
					$resulSecretario=$usarios->getCondiciones("usuarios.id_usuarios,usuarios.nombre_usuarios",
																"public.rol,public.usuarios", 
																"rol.id_rol = usuarios.id_rol AND rol.nombre_rol='SECRETARIO'",
																"usuarios.nombre_usuarios");
					
					//$this->view("Error", array("resultado"=>print_r($resulSecretario))); exit();
					
					$juicio = new  JuiciosModel();
					$juicio_referido=$_POST['juicios'];
				
					$resulSet=$juicio->getCondiciones("id_juicios,juicio_referido_titulo_credito", "juicios", "juicio_referido_titulo_credito='$juicio_referido'", "id_juicios");
				}
				
				
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Documentos"
			
				));
				exit();
			
			}
			
			$this->view("AvocoConocimiento",array(
					 "resulSecretario"=>$resulSecretario,"resulSet"=>$resulSet, "resultDatos"=>$resultDatos
			
			));
			
			
		}
		else 
		{
			$this->view("Error",array(
					"resultado"=>"Debe Iniciar Sesion"
		
			));
			
			
			
		}
		
	}
	
	
	
	public function InsertaAvoco(){
		
		
		session_start();

		$avoco = new AvocoConocimientoModel();
		
		$juicio = new  JuiciosModel();
		$nombre_controladores = "Avoco";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $avoco->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		$id_usuario=$_SESSION['id_usuarios'];
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
		
			if (isset ($_POST["id_juicios"]))
			{
				//estado de documento pdf
				$_estado = "";
				
				$dato=array();
				
				//identificador de pdf
				$identificador="";
				
				
				//parametros
				$_id_ciudad     			= $_POST["id_ciudad"];
				$_id_juicio      			= $_POST["id_juicios"];
				$_id_secretario_reemplazar  = $_POST["id_secretario_reemplazo"];
				$_id_secretario     		= $_POST["id_secretario"];
				$_id_impulsor     			= $_POST["id_impulsor"];
				
			
					if (isset($_POST["Guardar"]))
					{
						
						//Guarda en la base de datos
						
						$consecutivo= new ConsecutivosModel();
						$resultConsecutivo= $consecutivo->getBy("documento_consecutivos='AVOCO'");
						
						$identificador=$resultConsecutivo[0]->real_consecutivos;
						
						
						$repositorio_documento="Avoco";
						
						$nombre_documento=$repositorio_documento.$identificador;
						
						$funcion = "ins_avoco_conocimiento";
						
						//parametrsos sql
						//_id_juicios integer, _id_ciudad integer, _id_secretario integer, _id_impulsor integer, _id_usuario_registra_avoco integer, _nombre_documento character varying, _ruta_documento character varying, _identificador character varying, _secretario_reemplazo integer
						
							
						$parametros = " '$_id_juicio' ,'$_id_ciudad' , '$_id_secretario' , '$_id_impulsor' , '$id_usuario' , '$nombre_documento' , '$repositorio_documento' , '$identificador','$_id_secretario_reemplazar'";
						$avoco->setFuncion($funcion);
														
						$avoco->setParametros($parametros);
						$resultado=$avoco->Insert();
						
						//auditoria
						$traza=new TrazasModel();
						$_nombre_controlador = "Avoco";
						$_accion_trazas  = "Guardar";
						$_parametros_trazas = "Archivo ".$nombre_documento." en ".$repositorio_documento;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
						//$this->view("Error", array("resultado"=>print_r($resultado)));
						
						$consecutivo->UpdateBy("real_consecutivos=real_consecutivos+1", "consecutivos", "documento_consecutivos='AVOCO'");
						
						$_estado = "Guardar";
					}
				}
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				
				
				print "<script language='JavaScript'>
				setTimeout(window.open('http://$host$uri/view/ireports/ContAvocoReport.php?identificador=$identificador&estado=$_estado&nombre=$nombre_documento','Popup','height=300,width=400,scrollTo,resizable=1,scrollbars=1,location=0'), 5000);
				</script>";
				
				print("<script>window.location.replace('index.php?controller=AvocoConocimiento&action=index');</script>");

		$documentos=new DocumentosModel();
		
		$juicio = new  JuiciosModel();
		$nombre_controladores = "Documentos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $documentos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		$avoco='<p align = "justify"><font face="univers" size=1>  La información contenida en este mensaje y sus anexos tiene carácter confidencial,y está dirigida únicamente al destinatario de la misma y sólo podrá ser usada por éste. Si el lector de este mensaje no es el destinatario del mismo, se le notifica que cualquier copia o distribución de éste se encuentra totalmente prohibida. Si usted ha recibido este mensaje por error, por favor notifique inmediatamente al remitente por este mismo medio y borre el mensaje de su sistema. Las opiniones que contenga este mensaje son exclusivas de su autor y no necesariamente representan la opinión oficial del BANCO NACIONAL DE FOMENTO. Este mensaje ha sido examinado por Symantec y se considera libre de virus y spam.</font></p>';
		
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
	}
	
	public function VisualizarAvoco(){
		
		session_start();
		
		
		$usuarios = new UsuariosModel();
		$juicios = new JuiciosModel();
		$ciudad = new CiudadModel();
		
		$identificador="";
		$_estado="Visualizar";
		$dato=array();
		$arrayGet=array();
		$resultCiudad=array();
		
		if (isset($_POST["Visualizar"]))
		{
			
			//parametros
			$_id_ciudad     			= $_POST["id_ciudad"];
			$_id_juicio      			= $_POST["id_juicios"];
			$_id_secretario_reemplazar  = $_POST["id_secretario_reemplazo"];
			$_id_secretario     		= $_POST["id_secretario"];
			$_id_abogado      			= $_POST["id_impulsor"];
			
			
			//consulta datos de juicio
			$columnas="juicios.juicio_referido_titulo_credito,
			clientes.nombres_clientes,clientes.identificacion_clientes";
			
			$tablas="public.juicios,public.clientes";
			
			$where="clientes.id_clientes = juicios.id_clientes AND  juicios.id_juicios='$_id_juicio'";
			
			$resultJuicio = $juicios->getCondiciones($columnas, $tablas, $where, "clientes.id_clientes");
			
			//datos ciudad
			$resultCiudad=$ciudad->getBy("id_ciudad='$_id_ciudad'");
			
			//datos secretario q se reemplaza
			$resultSecretario=$usuarios->getBy("id_usuarios='$_id_secretario_reemplazar'");
			
			//datos Secretario e impulsor
			$resultAbogados=$usuarios->getCondiciones("asignacion_secretarios_view.id_abogado,asignacion_secretarios_view.id_secretario, 
                                                      asignacion_secretarios_view.secretarios,asignacion_secretarios_view.impulsores",
													  "public.asignacion_secretarios_view", 
													 "asignacion_secretarios_view.id_abogado = '$_id_abogado' AND asignacion_secretarios_view.id_secretario='$_id_secretario'",
													 "asignacion_secretarios_view.secretarios");
			
			
			//cargar datos para el reporte
			
			$dato['ciudad']=$resultCiudad[0]->nombre_ciudad;
			$dato['juicio_referido']=$resultJuicio[0]->juicio_referido_titulo_credito;
			$dato['cliente']=$resultJuicio[0]->nombres_clientes;
			$dato['identificacion']=$resultJuicio[0]->identificacion_clientes;
			$dato['secretario_reemplazar']=$resultSecretario[0]->nombre_usuarios;
			$dato['secretario']=$resultAbogados[0]->secretarios;
			$dato['abogado']=$resultAbogados[0]->impulsores;
			
			//$this->view("Error", array("resultado"=>print_r($dato))); exit();
						
		
			$traza=new TrazasModel();
			$_nombre_controlador = "Avoco";
			$_accion_trazas  = "Visualizar";
			$_parametros_trazas = "Cambiar".($resultSecretario[0]->nombre_usuarios)."Por".$resultAbogados[0]->secretarios;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
			
			//cargar array q va por get
			
			/*$arrayGet['id_juicio']=$_id_juicio;
			$arrayGet['juicio']=$resultJuicio[0]->juicio_referido_titulo_credito;
			$arrayGet['detalle']=$_detalle_documentos;
			$arrayGet['observacion']=$_observacion_documentos;
			$arrayGet['avoco']=$_avoco_vistos_documentos;*/
			
			$arrayGet=array();
			
		}
		

		$result=urlencode(serialize($dato));
		
		$resultArray=urlencode(serialize($arrayGet));
		
		$host  = $_SERVER['HTTP_HOST'];
		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
		
		
        
		print "<script language='JavaScript'>
			 setTimeout(window.open('http://$host$uri/view/ireports/ContAvocoReport.php?estado=$_estado&dato=$result','Popup','height=700,width=800,scrollTo,resizable=1,scrollbars=1,location=0'), 5000); 
		      </script>";
		
		print("<script>window.location.replace('index.php?controller=AvocoConocimiento&action=index&dato=$resultArray');</script>");
		

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
	
	
	
	
	//funcion script para mosttrar Secretarios de acuerdo a la ciudad selecionada
	public function returnSecretariosbyciudad()
	{
	
		//CONSULTA DE USUARIOS POR SU ROL
		$idciudad=(int)$_POST["ciudad"];
		$usuarios=new UsuariosModel();
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios,ciudad,rol";
		$id="rol.id_rol";
	
		$where="rol.id_rol=usuarios.id_rol AND usuarios.id_ciudad=ciudad.id_ciudad
		AND rol.nombre_rol='SECRETARIO' AND ciudad.id_ciudad='$idciudad'";
	
		$resultado=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultado);
	}
	
	//funcion script para mosttrar Impulsores de acuerdo a su secretario
	public function returnImpulsoresxSecretario()
	{
	
		//consulta de impulsores
		$idSecretario=(int)$_POST["idSecretario"];
		$usuarios=new UsuariosModel();
		$columnas = "asignacion_secretarios_view.id_abogado,asignacion_secretarios_view.impulsores";
		$tablas="public.asignacion_secretarios_view";
		$id="asignacion_secretarios_view.impulsores";
	
		$where="asignacion_secretarios_view.id_secretario='$idSecretario'";
	
		$resultado=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultado);
	}
	
}
?>
