<?php
class ConsultaDocumentosImpulsoresController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function consulta_impulsores(){

		session_start();

		//Creamos el objeto usuario
		$resultSet="";
		$documentos_impulsores=new DocumentosModel();
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
		
		
		
		
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
		
		
		$usuarios = new UsuariosModel();
		$resultUsu = $usuarios->getAll("nombre_usuarios");
		

		$documentos_impulsores=new DocumentosModel();


		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ConsultaDocumentosImpulsores";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos_impulsores->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){

					$id_ciudad=$_POST['id_ciudad'];
					$id_usuarios=$_POST['id_usuarios'];
					$identificacion=$_POST['identificacion'];
					$numero_juicio=$_POST['numero_juicio'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];

					$documentos_impulsores=new DocumentosModel();


					$columnas = "documentos.id_documentos, 
								  ciudad.nombre_ciudad, 
								  juicios.juicio_referido_titulo_credito, 
								  clientes.nombres_clientes, 
								  clientes.identificacion_clientes, 
								  estados_procesales_juicios.nombre_estado_procesal_juicios, 
								  documentos.fecha_emision_documentos, 
								  documentos.hora_emision_documentos, 
								  documentos.detalle_documentos, 
								  documentos.observacion_documentos, 
								  documentos.avoco_vistos_documentos,
								  documentos.ruta_documento,
								  documentos.nombre_documento,
								  usuarios.id_usuarios,
							      usuarios.nombre_usuarios, 
								  usuarios.imagen_usuarios";

					$tablas=" public.documentos, 
							  public.ciudad, 
							  public.juicios, 
							  public.usuarios, 
							  public.clientes, 
							  public.estados_procesales_juicios";

					$where="ciudad.id_ciudad = documentos.id_ciudad AND
						  juicios.id_juicios = documentos.id_juicio AND
						  usuarios.id_usuarios = documentos.id_usuario_registra_documentos AND
						  clientes.id_clientes = juicios.id_clientes AND
						  estados_procesales_juicios.id_estados_procesales_juicios = documentos.id_estados_procesales_juicios
							AND documentos.firma_impulsor ='FALSE'";

					$id="documentos.id_documentos";
						
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";


					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
					
					if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
						
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
					
					if($numero_juicio!=""){$where_3=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
						
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  documentos.fecha_emision_documentos BETWEEN '$fechadesde' AND '$fechahasta'";}


					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;


					$resultSet=$documentos_impulsores->getCondiciones($columnas ,$tablas , $where_to, $id);
					
									


				}
				
				if(isset($_POST['firmar']))
				{
					$firmas= new FirmasDigitalesModel();
					$documentos = new DocumentosModel();
					$tipo_notificacion = new TipoNotificacionModel();
					$asignacion_secreatario= new AsignacionSecretariosModel();
					
					$ruta="Providencias";
					$nombrePdf="";
						
					$destino = $_SERVER['DOCUMENT_ROOT'].'/documentos/'.$ruta.'/';
						
					$array_documento=$_POST['file_firmar'];
					
				
					$permisosFirmar=$permisos_rol->getPermisosFirmarPdfs($_id_usuarios);
					
					//para las notificaciones
					$_nombre_tipo_notificacion="documentos";
					$resul_tipo_notificacion=$tipo_notificacion->getBy("descripcion_notificacion='$_nombre_tipo_notificacion'");
					$id_tipo_notificacion=$resul_tipo_notificacion[0]->id_tipo_notificacion;
					$descripcion="Documento Firmado por";
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
								
								$resultDocumento=$documentos->getBy("id_documentos='$id'");
								
								$nombrePdf=$resultDocumento[0]->nombre_documento;
								
								$nombrePdf=$nombrePdf.".pdf";
				
								$id_rol=$_SESSION['id_rol'];
				
								try {
										$res=$firmas->FirmarPDFs( $destino, $nombrePdf, $id_firma,$id_rol);
					
										$firmas->UpdateBy("firma_impulsor='TRUE'", "documentos", "id_documentos='$id_documento'");
										

										//dirigir notificacion
										
											$id_impulsor=$_SESSION['id_usuarios'];
											
											$result_asg_secretario=$asignacion_secreatario->getBy("id_abogado_asignacion_secretarios='$id_impulsor'");
												
											if(!empty($result_asg_secretario))
											{
												$usuarioDestino=$result_asg_secretario[0]->id_secretario_asignacion_secretarios;
												$result_notificaciones=$firmas->CrearNotificacion($id_tipo_notificacion, $usuarioDestino, $descripcion, $numero_movimiento, $nombrePdf);
												
											}
											
											
										
									}catch(Exception $e)
									{
										echo $e->getMessage();
									}
								
				
							}
						}
					}
					
				}




				$this->view("ConsultaDocumentosImpulsores",array(
						"resultSet"=>$resultSet,"resultCiu"=>$resultCiu, "resultUsu"=>$resultUsu, "resultDatos"=>$resultDatos
							
				));



			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consulta Documentos Impulsores"

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