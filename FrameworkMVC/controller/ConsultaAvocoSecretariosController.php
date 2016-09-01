<?php
class ConsultaAvocoSecretariosController extends ControladorBase{
	
	public function __construct() {
		parent::__construct();
	}

	
	public function consulta_secretarios_avoco(){

		session_start();

		//Creamos el objeto usuario
		$resultSet="";
		$avoco_secretarios=new AvocoConocimientoModel();
		$usuarios = new UsuariosModel();
		// saber la ciudad del usuario
		$_id_usuarios= $_SESSION["id_usuarios"]; 
		
		$columnas = " usuarios.id_ciudad, 
					  ciudad.nombre_ciudad, 
					  usuarios.nombre_usuarios";
			
		$tablas   = "public.usuarios, 
                     public.ciudad";
			
		$where    = "ciudad.id_ciudad = usuarios.id_ciudad AND usuarios.id_usuarios = '$_id_usuarios'";
			
		$id       = "usuarios.id_ciudad";
		$resultDatos=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
		// saber los impulsores del secretario
		$_id_usuarios= $_SESSION["id_usuarios"];
		
		$columnas = " asignacion_secretarios_view.id_abogado,
					  asignacion_secretarios_view.impulsores";
			
		$tablas   = "public.asignacion_secretarios_view";
			
		$where    = "public.asignacion_secretarios_view.id_secretario = '$_id_usuarios'";
			
		$id       = "asignacion_secretarios_view.id_abogado";
		$resultImpul=$avoco_secretarios->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
		
		
		$usuarios = new UsuariosModel();
		$resultUsu = $usuarios->getAll("nombre_usuarios");
		

		$avoco_secretarios=new AvocoConocimientoModel();


		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//notificaciones
			$avoco_secretarios->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ConsultaAvocoSecretarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $avoco_secretarios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){

					$id_ciudad=$_POST['id_ciudad'];
					$id_usuarios=$_POST['id_usuarios'];
					$identificacion=$_POST['identificacion'];
					$numero_juicio=$_POST['numero_juicio'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];

					$avoco_secretarios=new AvocoConocimientoModel();


					$columnas = "avoco_conocimiento.id_avoco_conocimiento, 
							  juicios.juicio_referido_titulo_credito, 
							  clientes.nombres_clientes, 
							  clientes.identificacion_clientes, 
							  ciudad.nombre_ciudad, 
							  asignacion_secretarios_view.secretarios, 
							  asignacion_secretarios_view.impulsores, 
							  usuarios.nombre_usuarios, 
							  avoco_conocimiento.creado";

					$tablas=" public.avoco_conocimiento, 
							  public.juicios, 
							  public.ciudad, 
							  public.asignacion_secretarios_view, 
							  public.clientes, 
							  public.usuarios";

					$where="avoco_conocimiento.id_secretario = asignacion_secretarios_view.id_secretario AND
						  avoco_conocimiento.id_impulsor = asignacion_secretarios_view.id_abogado AND
						  avoco_conocimiento.secretario_reemplazo = usuarios.id_usuarios AND
						  juicios.id_juicios = avoco_conocimiento.id_juicios AND
						  ciudad.id_ciudad = avoco_conocimiento.id_ciudad AND
						  clientes.id_clientes = juicios.id_clientes AND 
						  avoco_conocimiento.firma_impulsor='TRUE' AND avoco_conocimiento.firma_secretario='FALSE'";

					$id="avoco_conocimiento.id_avoco_conocimiento";
						
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";


					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
					
					if($id_usuarios!=0){$where_1=" AND avoco_conocimiento.id_impulsor='$id_usuarios'";}
						
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
						
					if($numero_juicio!=""){$where_3=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
					
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  avoco_conocimiento.creado BETWEEN '$fechadesde' AND '$fechahasta'";}

                    $where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
                    
                    $resultSet=$avoco_secretarios->getCondiciones($columnas ,$tablas , $where_to, $id);


				}
				
				if(isset($_POST['firmar']))
				{
					
				
				
				/*
					$firmas= new FirmasDigitalesModel();
					$avoco=new AvocoConocimientoModel();
					$tipo_notificacion = new TipoNotificacionModel();
					$asignacion_secreatario= new AsignacionSecretariosModel();
					
					$ruta="Avoco";
					$nombrePdf="";
					
					$destino = $_SERVER['DOCUMENT_ROOT'].'/documentos/';
					
					$array_documento=$_POST['file_firmar'];
					
					$permisosFirmar=$permisos_rol->getPermisosFirmarPdfs($_id_usuarios);
					
					//para las notificaciones 
					$_nombre_tipo_notificacion="avoco";					
					$resul_tipo_notificacion=$tipo_notificacion->getBy("descripcion_notificacion='$_nombre_tipo_notificacion'");						
					$id_tipo_notificacion=$resul_tipo_notificacion[0]->id_tipo_notificacion;					
					$descripcion="Avoco Firmado por";
					$numero_movimiento=0;
					$id_impulsor="";
					
					if($permisosFirmar['estado'])
					{
						
						$id_firma = $permisosFirmar['valor'];
						
						
						foreach ($array_documento as $id )
						{
														
							if(!empty($id))
							{
								
								$id_documento = $id;
								
								$resultDocumento=$avoco->getBy("id_avoco_conocimiento='$id'");
								
								$nombrePdf=$resultDocumento[0]->nombre_documento;
								
								$nombrePdf=$nombrePdf.".pdf";
								
								$ruta=$resultDocumento[0]->ruta_documento;
				
								$id_rol=$_SESSION['id_rol'];
								
								$destino.=$ruta.'/';
								
								
								try {
									
									$res=$firmas->FirmarPDFs( $destino, $nombrePdf, $id_firma,$id_rol);
									
									$firmas->UpdateBy("firma_secretario='TRUE'", "avoco_conocimiento", "id_avoco_conocimiento='$id_documento'");
									
									$this->notificacionImpulsor($nombrePdf);	
									
									
																		
								} catch (Exception $e) {
									
									echo $e->getMessage();
								}
								
							}
						}
					}*/
					
					
				}




				$this->view("ConsultaAvocoSecretarios",array(
						"resultSet"=>$resultSet,"resultCiu"=>$resultCiu, "resultUsu"=>$resultUsu, "resultDatos"=>$resultDatos, "resultImpul"=>$resultImpul
							
				));



			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Firmar Avoco Secretarios"

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


	public function avoco_secretarios(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
		
		$avoco_secretarios=new AvocoConocimientoModel();
		
		$usuarios = new UsuariosModel();
		
	
		$_id_usuarios= $_SESSION["id_usuarios"];
	
		
		$resultDatos=$usuarios->getCondiciones("usuarios.id_ciudad,
					  							ciudad.nombre_ciudad,
					 							usuarios.nombre_usuarios" ,
												"public.usuarios,public.ciudad",
												"ciudad.id_ciudad = usuarios.id_ciudad AND
												usuarios.id_usuarios = '$_id_usuarios'",
												"usuarios.id_ciudad");
		
	
		$resultImpul=$avoco_secretarios->getCondiciones("asignacion_secretarios_view.id_abogado,
					  									asignacion_secretarios_view.impulsores" ,
														"public.asignacion_secretarios_view" ,
														"public.asignacion_secretarios_view.id_secretario = '$_id_usuarios'",
														"asignacion_secretarios_view.id_abogado");
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//notificaciones
			$avoco_secretarios->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "ConsultaAvocoSecretarios";
			$id_rol= $_SESSION['id_rol'];
			
			$resultPer = $avoco_secretarios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
				
					$columnas = "DISTINCT  avoco_conocimiento.id_avoco_conocimiento,
							  juicios.juicio_referido_titulo_credito,
							  clientes.nombres_clientes,
							  clientes.identificacion_clientes,
							  ciudad.nombre_ciudad,
							  asignacion_secretarios_view.secretarios,
							  asignacion_secretarios_view.impulsores,
							  usuarios.nombre_usuarios,
							  avoco_conocimiento.creado";
	
					$tablas=" public.avoco_conocimiento,
							  public.juicios,
							  public.ciudad,
							  public.asignacion_secretarios_view,
							  public.clientes,
							  public.usuarios,
							  public.notificaciones";
	
					$where="avoco_conocimiento.id_secretario = asignacion_secretarios_view.id_secretario AND
							avoco_conocimiento.id_secretario = usuarios.id_usuarios AND
							juicios.id_juicios = avoco_conocimiento.id_juicios AND
							ciudad.id_ciudad = avoco_conocimiento.id_ciudad AND
							clientes.id_clientes = juicios.id_clientes AND
							avoco_conocimiento.firma_secretario='FALSE' AND
							notificaciones.visto_notificaciones ='FALSE' AND
							notificaciones.usuario_destino_notificaciones='$_id_usuarios'";
	
					$id="avoco_conocimiento.id_avoco_conocimiento";
	
	
					
	
					$resultSet=$avoco_secretarios->getCondiciones($columnas ,$tablas , $where, $id);
	
	
			
	
				$this->view("ConsultaAvocoSecretarios",array(
						"resultSet"=>$resultSet,"resultDatos"=>$resultDatos, "resultImpul"=>$resultImpul
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Firmar Avoco Secretarios"
	
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
	
	public function consulta_secretarios_avoco_firmados(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
		$avoco_secretarios=new AvocoConocimientoModel();
		$usuarios = new UsuariosModel();
		// saber la ciudad del usuario
		$_id_usuarios= $_SESSION["id_usuarios"];
	
		$columnas = " usuarios.id_ciudad,
					  ciudad.nombre_ciudad,
					  usuarios.nombre_usuarios";
			
		$tablas   = "public.usuarios,
                     public.ciudad";
			
		$where    = "ciudad.id_ciudad = usuarios.id_ciudad AND usuarios.id_usuarios = '$_id_usuarios'";
			
		$id       = "usuarios.id_ciudad";
		$resultDatos=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
	
	
		// saber los impulsores del secretario
		$_id_usuarios= $_SESSION["id_usuarios"];
	
		$columnas = " asignacion_secretarios_view.id_abogado,
					  asignacion_secretarios_view.impulsores";
			
		$tablas   = "public.asignacion_secretarios_view";
			
		$where    = "public.asignacion_secretarios_view.id_secretario = '$_id_usuarios'";
			
		$id       = "asignacion_secretarios_view.id_abogado";
		$resultImpul=$avoco_secretarios->getCondiciones($columnas ,$tablas ,$where, $id);
	
	
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
	
	
		$usuarios = new UsuariosModel();
		$resultUsu = $usuarios->getAll("nombre_usuarios");
	
	
	    $avoco_secretarios=new AvocoConocimientoModel();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ConsultaAvocoSecretarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $avoco_secretarios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){
	
					$id_ciudad=$_POST['id_ciudad'];
					$id_usuarios=$_POST['id_usuarios'];
					$identificacion=$_POST['identificacion'];
					$numero_juicio=$_POST['numero_juicio'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
	
					 $avoco_secretarios=new AvocoConocimientoModel();
	
	
					$columnas = "avoco_conocimiento.id_avoco_conocimiento, 
							juicios.id_juicios,
							  juicios.juicio_referido_titulo_credito, 
							  clientes.nombres_clientes, 
							  clientes.identificacion_clientes, 
							  ciudad.nombre_ciudad, 
							  asignacion_secretarios_view.secretarios, 
							  asignacion_secretarios_view.impulsores, 
							  usuarios.nombre_usuarios, 
							  avoco_conocimiento.creado";
	
					$tablas=" public.avoco_conocimiento, 
							  public.juicios, 
							  public.ciudad, 
							  public.asignacion_secretarios_view, 
							  public.clientes, 
							  public.usuarios";
	
					$where="avoco_conocimiento.id_secretario = asignacion_secretarios_view.id_secretario AND
						  avoco_conocimiento.id_impulsor = asignacion_secretarios_view.id_abogado AND
						  avoco_conocimiento.secretario_reemplazo = usuarios.id_usuarios AND
						  juicios.id_juicios = avoco_conocimiento.id_juicios AND
						  ciudad.id_ciudad = avoco_conocimiento.id_ciudad AND
						  clientes.id_clientes = juicios.id_clientes
						AND avoco_conocimiento.firma_impulsor='TRUE' AND avoco_conocimiento.firma_secretario ='TRUE'";
	
					$id="avoco_conocimiento.id_avoco_conocimiento";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
						
					if($id_usuarios!=0){$where_1=" AND avoco_conocimiento.id_impulsor='$id_usuarios'";}
	
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
	
					if($numero_juicio!=""){$where_3=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
						
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  avoco_conocimiento.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$avoco_secretarios->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	         }
	
				$this->view("ConsultaAvocoSecretariosFirmados",array(
						"resultSet"=>$resultSet,"resultCiu"=>$resultCiu, "resultUsu"=>$resultUsu, "resultDatos"=>$resultDatos, "resultImpul"=>$resultImpul
							
				));
	
	         }
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consulta Avoco Secretarios Firmados"
	
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

	public function abrirPdf()
	{
		$avoco = new AvocoConocimientoModel();
		
		if(isset($_GET['id']))
		{
			
			$id_documento = $_GET ['id'];
			
			$resultDocumento = $avoco->getBy ( "id_avoco_conocimiento='$id_documento'" );
			
			if (! empty ( $resultDocumento )) {
				
				$nombrePdf = $resultDocumento [0]->nombre_documento;
				
				$nombrePdf .= ".pdf";
				
				$ruta = $resultDocumento [0]->ruta_documento;
				
				$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/' . $ruta . '/' . $nombrePdf;
				
				header('Content-type: application/pdf');
				header('Content-Disposition: inline; filename="'.$directorio.'"');
				readfile($directorio);
			}
		
		
		}
		
	
		
	}
	
	public function rechazarPdf()
	{
		session_start();
		
		$avoco = new AvocoConocimientoModel();

		$firmas= new FirmasDigitalesModel();
	
		$tipo_notificacion = new TipoNotificacionModel();
		$asignacion_secreatario= new AsignacionSecretariosModel();
	
			
		//para las notificaciones
		$_nombre_tipo_notificacion="rechazado";
		$resul_tipo_notificacion=$tipo_notificacion->getBy("descripcion_notificacion='$_nombre_tipo_notificacion'");
		$id_tipo_notificacion=$resul_tipo_notificacion[0]->id_tipo_notificacion;
		$descripcion="Avoco Rechazo por";
		$numero_movimiento=0;
		$id_impulsor="";
	
		if(isset($_GET['id']))
		{
	
			$id_avoco = $_GET ['id'];
			$resultAvoco = $avoco->getBy ( "id_avoco_conocimiento='$id_avoco'" );
				
				
			if (! empty ( $resultAvoco )) {
	
				$nombrePdf = $resultAvoco [0]->nombre_documento;
	
				$nombrePdf .= ".pdf";
	
				$ruta = $resultAvoco [0]->ruta_documento;
	
				$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/' . $ruta . '/' . $nombrePdf;
	
	
				try {
						
					$eliminado=unlink($directorio);
					$resultDocumento=$avoco->deleteById("id_avoco_conocimiento='$id_avoco'");
					
					
					//dirigir notificacion
					$usuarioDestino=$resultAvoco[0]->id_usuario_registra_avoco;
						
					$result_notificaciones=$firmas->CrearNotificacion($id_tipo_notificacion, $usuarioDestino, $descripcion, $numero_movimiento, $nombrePdf);
										
					//$this->view("Error", array("resultado"=>"no se elimino el archivo <br>".print_r($result_notificaciones)));
					$this->redirect("ConsultaAvocoSecretarios","consulta_secretarios_avoco");
					
				} catch (Exception $e)
				{
					$this->view("Error", array("resultado"=>"no se elimino el archivo <br>".$e->getMessage()));
				}
					
			}
	
	
		}
	
	
	}

	public function notificacionImpulsor($documento=null)
	{
		$tipo_notificacion= new TipoNotificacionModel();
		$usuario = new UsuariosModel();
		
		$res_tipo_notificacion=array();
		
		$res_liquidador=$usuario->getCondiciones("usuarios.id_usuarios",
											  "public.usuarios,public.rol", 
											  "rol.id_rol = usuarios.id_rol AND rol.nombre_rol = 'LIQUIDADOR'",
											  "usuarios.id_usuarios"
												);
		$destino=$res_liquidador[0]->id_usuarios;
		
		$archivoPdf=$documento;
		
		$_nombre_tipo_notificacion="avoco_impulsor";
		
		$res_tipo_notificacion=$tipo_notificacion->getBy("descripcion_notificacion='$_nombre_tipo_notificacion'");
		
		$id_tipo_notificacion=$res_tipo_notificacion[0]->id_tipo_notificacion;
		
		$descripcion="Avoco Conocimiento";
		
		$numero_movimiento=0;
		
		$tipo_notificacion->CrearNotificacion($id_tipo_notificacion, $destino, $descripcion, $numero_movimiento, $archivoPdf);
		
	}
	
	public  function EnviarApplet()
	{
		//pasar parametros 
		
		session_start();
		
		$consulta = array();
		
		$resultUsuario="";
		$resultnombreFiles="";
		$ruta="";
		$resultIds="";
		
		$avoco=new AvocoConocimientoModel();
		
		if(isset($_POST['file_firmar']))
		{
			$resultUsuario=$_SESSION['id_usuarios'];
			
			$arrayFilesAfirmar=$_POST['file_firmar'];
			$cadenaFiles="";
			$cadenaId="";
			$ruta="Avoco";
			
				
				foreach ($arrayFilesAfirmar as $res)
				{
					$cadenaId.=$res.",";
				}
				
			//$cadenaFiles = substr($cadenaFiles, 0, -1);
			//$cadenaId = substr($cadenaId, 0, -1);
			
			$resultIds = trim($cadenaId,",");
			
			$consulta=$avoco->getBy("id_avoco_conocimiento in ('$resultIds')");
			
			if (!empty($consulta)) {  foreach($consulta as $res) {
						
						$cadenaFiles.=$res->nombre_documento;
					}
				}
			
			$resultnombreFiles = trim($cadenaFiles,",");
			
			
			
			$this->view("FirmarPdf",array(
						
					"resultUsuario"=>$resultUsuario,"resultnombreFiles"=>$resultnombreFiles,"ruta"=>$ruta,"resultIds"=>$resultIds
			
			));
			
			/*
			 * 
			$this->view("Error",array(
						
					"resultado"=>$resultUsuario." df ".$resultnombreFiles." df ".$ruta." df ".$resultIds
			
			));
			
			 */
			
		}else {
			
			$this->view("Error",array(
			
					"resultado"=>"no hay archivos"
						
			));
		}
		
	}


}
?>