<?php
class CitacionesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){

		//Creamos el objeto usuario
		$citaciones= new CitacionesModel();

		//Conseguimos todos los usuarios
		$resultSet=$citaciones->getAll("id_citaciones");

		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");

		$tipo_citaciones = new TipoCitacionesModel();
		$resultTipoCit =$tipo_citaciones->getAll("nombre_tipo_citaciones");

		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
		$id="rol.id_rol";

		$usuarios = new UsuariosModel();

		$where="rol.nombre_rol='CITADOR JUDICIAL'";
		$resultUsuarios=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);


		$resultEdit = "";


		$citaciones= new CitacionesModel();


		

		$resultDatos="";

		session_start();


		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			//NOTIFICACIONES
			$citaciones->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Citaciones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $citaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_citaciones"])   )
				{

					$nombre_controladores = "Citaciones";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $citaciones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

					if (!empty($resultPer))
					{
							
						$_id_citaciones = $_GET["id_citaciones"];

						$columnas = " id_citaciones";
						$tablas   = "citaciones";
						$where    = "id_citaciones = '$_id_citaciones' ";
						$id       = "nombre_citaciones";
							
						$resultEdit = $citaciones->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Citaciones";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_citaciones;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Citaciones"
			
						));
							
							
					}
						
				}

				if(isset($_POST["buscar"])){

					$criterio_busqueda=$_POST["criterio_busqueda"];
					$contenido_busqueda=$_POST["contenido_busqueda"];

					$citaciones= new CitacionesModel();


					$columnas = " clientes.id_clientes,
							juicios.id_juicios,
								  clientes.identificacion_clientes,
								  clientes.nombres_clientes,
								  juicios.juicio_referido_titulo_credito";

					$tablas   = " public.clientes,
                                  public.juicios";

					$where    = "juicios.id_clientes = clientes.id_clientes";

					$id       = "juicios.juicio_referido_titulo_credito";


					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
						

					switch ($criterio_busqueda) {
							
						case 0:
							// identificacion de cliente
							$where_0 = " ";
							break;
						case 1:
							// identificacion de cliente
							$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
							break;
						case 2:
							//id_titulo de credito
							$where_2 = " AND  juicios.juicio_referido_titulo_credito = '$contenido_busqueda'  ";
							break;



					}



					$where_to  = $where . $where_0 . $where_1 . $where_2 ;


					$resultDatos=$citaciones->getCondiciones($columnas ,$tablas ,$where_to, $id);


				}




				$this->view("Citaciones",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultDatos" =>$resultDatos, "resultTipoCit"=> $resultTipoCit, "resultCiu"=>$resultCiu, "resultUsuarios"=>$resultUsuarios
							
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

	public function InsertaCitaciones(){
			
		session_start();


		$citaciones=new CitacionesModel();
		$nombre_controladores = "Citaciones";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $citaciones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );


		if (!empty($resultPer))
		{
			$resultado = null;
			$citaciones=new CitacionesModel();

			if (isset ($_POST["Guardar"]) )
			{
				
				
				 $_estado="Guardar";
				 
				 $consecutivo= new ConsecutivosModel();
				 $resultConsecutivo= $consecutivo->getBy("documento_consecutivos='CITACIONES'");
				 $identificador=$resultConsecutivo[0]->real_consecutivos;
				 
				 $repositorio_documento="Citaciones";
				 
				 $_nombre_citacion=$repositorio_documento.$identificador;
					
				 $_array_juicios = $_POST["id_juicios"];
				 $_fecha_citaciones = $_POST["fecha_citaciones"];
				 $_id_ciudad = $_POST["id_ciudad"];
				 $_id_tipo_citaciones = $_POST["id_tipo_citaciones"];
				 $_nombre_persona_recibe_citaciones = $_POST["nombre_persona_recibe_citaciones"];
				 $_relacion_cliente_citaciones = $_POST["relacion_cliente_citaciones"];
				 $_id_usuarios = $_POST["id_usuarioCitador"];
			 	
			 	
			 foreach($_array_juicios  as $id  )
			 {
			 	
			 	
			 	if (!empty($id) )
			 	{
			 		
			 		//busco si exties este nuevo id
			 		try
			 		{
			 			
			 			
			 			$_id_juicios = $id;

			 			$funcion = "ins_citaciones";
			 						 			
			 			$parametros = "'$_id_juicios', '$_fecha_citaciones', '$_id_ciudad', '$_id_tipo_citaciones', '$_nombre_persona_recibe_citaciones', '$_relacion_cliente_citaciones', '$_id_usuarios','$_nombre_citacion','$repositorio_documento','$identificador' ";
			 			
			 			$citaciones->setFuncion($funcion);
			 			$citaciones->setParametros($parametros);
			 			
			 			$resultado=$citaciones->Insert();
			 			
			 			$res=$consecutivo->UpdateBy("real_consecutivos=real_consecutivos+1", "consecutivos", "documento_consecutivos='CITACIONES'");
			 						 			
			 			

			 			
			 		} catch (Exception $e)
			 		{
			 			$this->view("Error",array(
			 					"resultado"=>"Eror al Asignar ->". $id 
			 			));
			 		}
			 		
			 		$host  = $_SERVER['HTTP_HOST'];
			 		$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
			 		
			 		

			 	}
			 		
			 }
			 	
				$traza=new TrazasModel();
				$_nombre_controlador = "Citaciones";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_juicios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				//para generar el pdf
				print "<script language='JavaScript'>
				setTimeout(window.open('http://$host$uri/view/ireports/ContCitacionesGuardarReport.php?identificador=$identificador&estado=$_estado&nombre=$_nombre_citacion','Popup','height=300,width=400,scrollTo,resizable=1,scrollbars=1,location=0'), 5000);
				</script>";
				 
				print("<script>window.location.replace('index.php?controller=Citaciones&action=index');</script>");
				

			}

			//$this->redirect("Citaciones", "index");

		}
		else
		{
			$this->view("Error",array(
						
					"resultado"=>"No tiene Permisos de Insertar Citaciones"

			));


		}




	}




	public function borrarId()
	{

		session_start();

		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Roles";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_citaciones"]))
			{
				$id_citaciones=(int)$_GET["id_citaciones"];

				$citaciones=new OficiosModel();

				$citaciones->deleteBy(" id_citaciones",$id_citaciones);

				$traza=new TrazasModel();
				$_nombre_controlador = "Citaciones";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_citaciones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
				
			$this->redirect("Citaciones", "index");
				
				
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Borrar Citaciones"
		
			));
		}

	}


	public function consulta(){

		session_start();

		//Creamos el objeto usuario
		$resultSet="";

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
		
		$citaciones = new CitacionesModel();


		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Citaciones";
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


					$columnas = "citaciones.id_citaciones,
					juicios.id_juicios,
  					juicios.juicio_referido_titulo_credito,
 					clientes.nombres_clientes,
  					clientes.identificacion_clientes,
  					citaciones.fecha_citaciones,
  					ciudad.nombre_ciudad,
  					ciudad.id_ciudad,
  					tipo_citaciones.id_tipo_citaciones,
  					tipo_citaciones.nombre_tipo_citaciones,
  					citaciones.nombre_persona_recibe_citaciones,
  					citaciones.relacion_cliente_citaciones,
  					usuarios.nombre_usuarios";

					$tablas=" public.citaciones,
  					public.juicios,
  					public.ciudad,
  					public.tipo_citaciones,
  					public.usuarios,
  					public.clientes";

					$where="juicios.id_juicios = citaciones.id_juicios AND
  					ciudad.id_ciudad = citaciones.id_ciudad AND
  					tipo_citaciones.id_tipo_citaciones = citaciones.id_tipo_citaciones AND
  					usuarios.id_usuarios = citaciones.id_usuarios AND
  					clientes.id_clientes = juicios.id_clientes AND citaciones.id_usuarios ='$_id_usuarios' AND citaciones.firma_citador='TRUE'";

					$id="citaciones.id_citaciones";
						
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";


					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
						
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
						
					if($identificacion!=""){$where_2=" AND clientes.identificacion='$identificacion'";}
						
					if($titulo_credito!=""){$where_3=" AND juicios.id_titulo_credito='$titulo_credito'";}
						
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  citaciones.creado BETWEEN '$fechadesde' AND '$fechahasta'";}


					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;


					$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);


				}




				$this->view("ConsultaCitaciones",array(
						"resultSet"=>$resultSet, "resultDatos"=>$resultDatos
							
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


	

	public function consulta_firmar(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
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
	
		$citaciones = new CitacionesModel();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Citaciones";
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
	
	
					$columnas = "citaciones.id_citaciones,
					juicios.id_juicios,
  					juicios.juicio_referido_titulo_credito,
 					clientes.nombres_clientes,
  					clientes.identificacion_clientes,
  					citaciones.fecha_citaciones,
  					ciudad.nombre_ciudad,
  					ciudad.id_ciudad,
  					tipo_citaciones.id_tipo_citaciones,
  					tipo_citaciones.nombre_tipo_citaciones,
  					citaciones.nombre_persona_recibe_citaciones,
  					citaciones.relacion_cliente_citaciones,
  					usuarios.nombre_usuarios";
	
					$tablas=" public.citaciones,
  					public.juicios,
  					public.ciudad,
  					public.tipo_citaciones,
  					public.usuarios,
  					public.clientes";
	
					$where="juicios.id_juicios = citaciones.id_juicios AND
					ciudad.id_ciudad = citaciones.id_ciudad AND
					tipo_citaciones.id_tipo_citaciones = citaciones.id_tipo_citaciones AND
					usuarios.id_usuarios = citaciones.id_usuarios AND
					clientes.id_clientes = juicios.id_clientes AND citaciones.id_usuarios ='$_id_usuarios' AND citaciones.firma_citador='FALSE'";
	
					$id="citaciones.id_citaciones";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
	
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
	
					if($identificacion!=""){$where_2=" AND clientes.identificacion='$identificacion'";}
	
					if($titulo_credito!=""){$where_3=" AND juicios.id_titulo_credito='$titulo_credito'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  citaciones.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
				}
				
				
			if(isset($_POST['firmar']))
				{
					$firmas= new FirmasDigitalesModel();
					$citaciones=new CitacionesModel();
					$oficios = new OficiosModel();
					$tipo_notificacion = new TipoNotificacionModel();
					$asignacion_secreatario= new AsignacionSecretariosModel();
					
					$ruta="";
					$nombrePdf="";
					
					$destino = $_SERVER['DOCUMENT_ROOT'].'/documentos/';
					
					$array_documento=$_POST['file_firmar'];
					
										
					$permisosFirmar=$permisos_rol->getPermisosFirmarPdfs($_SESSION['id_usuarios']);
					
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
								
								
								$id_citaciones=$id;
								
								$resultCitaciones=$citaciones->getBy("id_citaciones='$id_citaciones'");
																						
								$nombrePdf=$resultCitaciones[0]->nombre_citacion;
								
								$nombrePdf.=".pdf";
								
								$ruta=$resultCitaciones[0]->ruta_citacion;
				
								$id_rol=$_SESSION['id_rol'];
								
								$destino.=$ruta.'/';
								
								
								try {
									
									$res=$citaciones->FirmarPDFs( $destino, $nombrePdf, $id_firma,$id_rol);
									
									$citaciones->UpdateBy("firma_citador='TRUE'", "citaciones", "id_citaciones='$id_citaciones'");
									
									//dirigir notificacion
									//$usuarioDestino=$resultCitaciones[0]->id_usuario_registra_oficios;
									
									//$result_notificaciones=$firmas->CrearNotificacion($id_tipo_notificacion, $usuarioDestino, $descripcion, $numero_movimiento, $nombrePdf);
																		
								} catch (Exception $e) {
									
									echo $e->getMessage();
								}
								
							}
						}
					}else{
						//para cuando no puede firmar
						
						$this->view("Error", array("resultado"=>"Error <br>".$permisosFirmar['error']));
						exit();
						
					} 
				}
	
	
	
	
				$this->view("ConsultaCitacionesFirmar",array(
						"resultSet"=>$resultSet, "resultDatos"=>$resultDatos
							
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
	
	public function abrirPdf()
	{
		$citaciones = new CitacionesModel();
	
		if(isset($_GET['id']))
		{
	
			$id_oficios = $_GET ['id'];
	
			$resultCitaciones = $citaciones->getBy ( "id_citaciones='$id_oficios'" );
	
			if (! empty ( $resultCitaciones )) {
	
				$nombrePdf = $resultCitaciones [0]->nombre_citacion;
	
				$nombrePdf .= ".pdf";
	
				$ruta = $resultCitaciones [0]->ruta_citacion;
	
				$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/' . $ruta . '/' . $nombrePdf;
	
				header('Content-type: application/pdf');
				header('Content-Disposition: inline; filename="'.$directorio.'"');
				readfile($directorio);
			}
	
	
		}
	
	}
	
	public function returnCitadorbyciudad()
	{
	
		//CONSULTA DE USUARIOS POR SU ROL
		$idciudad=(int)$_POST["ciudad"];
		$usuarios=new UsuariosModel();
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios,ciudad,rol";
		$id="rol.id_rol";
	
		$where="rol.id_rol=usuarios.id_rol AND usuarios.id_ciudad=ciudad.id_ciudad
		AND rol.nombre_rol='CITADOR JUDICIAL' AND ciudad.id_ciudad='$idciudad'";
	
		$resultUsuarioCitador=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultUsuarioCitador);
	}

}
?>