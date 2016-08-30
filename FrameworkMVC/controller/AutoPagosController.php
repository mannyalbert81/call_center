<?php

class AutoPagosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
	
		session_start();
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$asignacion_titulo_credito = new AsignacionTitulosCreditoModel();
			
			//NOTIFICACIONES
			$asignacion_titulo_credito->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			//creacion ddl de secretarios o abogadpos
			$resultAsignacion=array(0=>'--Seleccione--',1=>'Secretario',2=>'Abg Impulsor');
	
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "AutoPagos";
			$id_rol= $_SESSION['id_rol'];
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
			
			$usuarios=new UsuariosModel();
			$resultUsu = $usuarios->getAll("nombre_usuarios");
			
			$estado=new EstadoModel();
			$resultEstado=$estado->getBy("nombre_estado='PENDIENTE'");
			
		
			
			$resultDatos="";
			
			
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				//NOTIFICACIONES
				$usuarios->MostrarNotificaciones($_SESSION['id_usuarios']);
				
					//CONSULTA DE USUARIOS POR SU ROL 
					$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
					$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
					$id="rol.id_rol";
					
					$usuarios=new UsuariosModel();
					
					$where="rol.nombre_rol='CIUDAD'";
					$resultCiudad=$ciudad->getCondiciones($columnas ,$tablas , $where, $id);
					
					$where="rol.nombre_rol='SECRETARIO'";
					$resultUsuarioSecretario=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
					
					$where="rol.nombre_rol='ABOGADO IMPULSOR'";
					$resultUsuarioImpulsor=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
					
					
					//roles
					$rol = new RolesModel();
					$resultRol=$rol->getAll("nombre_rol");
					
					$controladores=new ControladoresModel();
					$resultCon=$controladores->getAll("nombre_controladores");
			
			
					
					$resultEdit = "";
					$resul = "";
			
					if (isset ($_GET["id_asignacion_secretarios"])   )
					{
						$nombre_controladores = "AutoPagos";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar(" controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
							
							$resultEdit=$asignacionSecretario->getCondiciones($columnas, $tablas, $where, $id);
							
							
							$traza=new TrazasModel();
							$_nombre_controlador = "AutoPagos";
							$_accion_trazas  = "Editar";
							$_parametros_trazas = $_id_asignacion_secretarios;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Asignacion Secretarios"
						
									
							));
						
							exit();
						}
						
						
						
					}
					
					if(isset($_POST["buscar"])){
					
						$criterio_busqueda=$_POST["criterio_busqueda"];
						$contenido_busqueda=$_POST["contenido_busqueda"];
					
						$asignacion_titulo_credito = new AsignacionTitulosCreditoModel();
							
							
						$columnas = " clientes.id_clientes,
							  titulo_credito.id_titulo_credito,
							  clientes.identificacion_clientes,
							  clientes.nombres_clientes,
							  clientes.celular_clientes,
							  titulo_credito.total,
							  titulo_credito.fecha_corte,
							  titulo_credito.id_ciudad,
							  ciudad.nombre_ciudad";
					
						$tablas   = "public.titulo_credito,
							  public.clientes,
							  public.ciudad";
					
						$where    = "clientes.id_clientes = titulo_credito.id_clientes AND
	                         ciudad.id_ciudad = titulo_credito.id_ciudad AND titulo_credito.asignado_titulo_credito='TRUE'";
					
						$id       = "titulo_credito.id_titulo_credito";
							
					
					
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
					
						switch ($criterio_busqueda) {
							case 0:
								$where_0 = " ";
								break;
							case 1:
								// identificacion de cliente
								$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
								break;
							case 2:
								//id_titulo de credito
								$where_2 = " AND  titulo_credito.id_titulo_credito = '$contenido_busqueda'  ";
								break;
						}
					
					
					
						$where_to  = $where .  $where_0 . $where_1 . $where_2;
						
							
						$resultDatos=$asignacion_titulo_credito->getCondiciones($columnas ,$tablas ,$where_to, $id);
						
						/*$this->view("Error",array(
								"resultado"=>$columnas.$tablas .$where_to. $id
					
						));
						
						exit();*/
					
							
					}
					
					
			
					if (isset ($_POST["ddl_resultado"]) && isset($_POST["ddl_busqueda"]))
					{
					/*
						//busqueda  WHERE  B.id_secretario_asignacion_secretarios=28
							
					$columnas = "B.id_asignacion_secretarios AS id_asignacion_secretarios ,
								(SELECT A.nombre_usuarios FROM usuarios A WHERE A.id_usuarios=B.id_secretario_asignacion_secretarios) AS secretarios,
								(SELECT A.nombre_usuarios FROM usuarios A WHERE A.id_usuarios=B.id_abogado_asignacion_secretarios) AS impulsadores";
					$tablas   = "asignacion_secretarios B";
					//$where    = "B.id_asignacion_secretarios>0";
					$where="";
					$id       = "B.id_asignacion_secretarios";
							
					
						$criterio = $_POST["ddl_resultado"];
						$contenido = $_POST["ddl_busqueda"];
					
							
						//$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
					
						if ($contenido ==1)
						{
							$where="B.id_secretario_asignacion_secretarios=".$criterio;					
							
						}elseif ($contenido ==2)
						{
							$where="B.id_abogado_asignacion_secretarios=".$criterio;
						}
					
							//Conseguimos todos los usuarios con filtros
					$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
					*/
					
						}
					
					
					
					
					$this->view("AutoPagos",array(
							
							"resultCon"=>$resultCon, "resultEdit"=>$resultEdit, "resultRol"=>$resultRol,"resultUsuarioSecretario"=>$resultUsuarioSecretario,"resultUsuarioImpulsor"=>$resultUsuarioImpulsor,"resultAsignacion"=>$resultAsignacion, "resultCiu"=>$resultCiu, "resultUsu"=>$resultUsu, "resultDatos"=>$resultDatos,"resultEstado"=>$resultEstado
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Asignacion Secretarios"
			
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
	 
	
	public function InsertaAutoPagos(){

		session_start();
		
		$resultado = null;
		$titulo_credito= new TituloCreditoModel();
		$notificaciones = new NotificacionesModel();
		$tipo_notificacion = new TipoNotificacionModel();
		$permisos_rol=new PermisosRolesModel();
		$auto_pagos = new AutoPagosModel();
	    $nombre_controladores = "AutoPagos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $auto_pagos->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			

			if (isset ($_POST["Guardar"])   )
			{
				
				
				$_array_titulo_credito = $_POST["id_titulo_credito"];
				$_usuario_asigna = $_SESSION['id_usuarios'];
				$_id_ciudad = $_POST["id_ciudad"];
				
				$_id_usuario_agente = $_POST["id_usuarioAgente"];
				$_fecha_asignado=$_POST["fecha_asignacion"];
				$_estado =$_POST["id_estado"];
				
				foreach($_array_titulo_credito  as $id  )
				{
					
				if (!empty($id) )
					{
						//busco si existe este nuevo id
						try 
						{
							//capturar id de impulsor de titulo credito
							$_id_titulo_credito = $id;
							$resultImpulsor=$titulo_credito->getCondiciones("id_titulo_credito,id_usuarios", "asignacion_titulo_credito", "id_titulo_credito='$_id_titulo_credito'", "id_titulo_credito");
							$idImpulsor=$resultImpulsor[0]->id_usuarios;

							//$_id_usuario_impulsor = $_POST["id_usuarioImpulsor"];
							
							//parametros  _id_titulo_credito integer, _id_usuario_asigna integer, _id_usuario_impulsor integer, _id_usuario_agente integer, _id_estado integer, _fecha_asiganacion_auto_pagos date
							$funcion = "ins_auto_pagos";
							$parametros = "'$_id_titulo_credito','$_usuario_asigna', '$idImpulsor','$_id_usuario_agente','$_estado','$_fecha_asignado'";
							$auto_pagos->setFuncion($funcion);
							$auto_pagos->setParametros($parametros);
							$resultado=$auto_pagos->Insert();
							
							
							
							//inserta las notificacion
							
							$_nombre_tipo_notificacion="auto_pago";							
							$resul_tipo_notificacion=$tipo_notificacion->getBy("descripcion_notificacion='$_nombre_tipo_notificacion'");
							
							$id_tipo_notificacion=$resul_tipo_notificacion[0]->id_tipo_notificacion;
							$descripcion="AutoPago pendiente por";
							$numero_movimiento=0;
							$cantidad_cartones=$_id_titulo_credito;
							
							//dirigir notificacion
							$id_impulsor=$_SESSION['id_usuarios'];
							$asignacion_secreatario= new AsignacionSecretariosModel();
							$result_asg_secretario=$asignacion_secreatario->getBy("id_abogado_asignacion_secretarios='$id_impulsor'");
							
							if(!empty($result_asg_secretario))
							{
								$usuarioDestino=$result_asg_secretario[0]->id_secretario_asignacion_secretarios;
									
								$result_notificaciones=$notificaciones->CrearNotificacion($id_tipo_notificacion, $usuarioDestino, $descripcion, $numero_movimiento, $cantidad_cartones);
							
							}else 
							{
								
							}
							
										
						} catch (Exception $e) 
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Asignar ->". $id
							));
						}
							
					}
					 
				}
				$traza=new TrazasModel();
				$_nombre_controlador = "AutoPagos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_titulo_credito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
		
				
			   }
			

			$this->redirect("AutoPagos", "index");
				
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Editar Auto Pagos"
		
			));
		
		}
		
	}
	
	public function borrarId()
	{
		$permisos_rol = new PermisosRolesModel();

		session_start();
		
		$nombre_controladores = "AsignacionTituloCredito";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosBorrar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			if(isset($_GET["id_asignacion_secretarios"]))
			{
				$id_asigancionSecretarios=(int)$_GET["id_asignacion_secretarios"];
		
				$asignacionSecretario=new AsignacionSecretariosModel();
			
				$asignacionSecretario->deleteBy(" id_asignacion_secretarios",$id_asigancionSecretarios);
			
				$traza=new TrazasModel();
				$_nombre_controlador = "AsignacionTituloCredito";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_asigancionSecretarios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			
			$this->redirect("AsignacionTituloCredito", "index");
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Borrar Asignacion Titulo Credito"
		
			));
		
		
		}
		
	}
		
		
		public function returnAgentesbyciudad()
	{
		
		//CONSULTA DE USUARIOS POR SU ROL
		$idciudad=(int)$_POST["ciudad"];
		$usuarios=new UsuariosModel();
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios,ciudad,rol";
		$id="rol.id_rol";
		
		$where="rol.id_rol=usuarios.id_rol AND usuarios.id_ciudad=ciudad.id_ciudad
		AND rol.nombre_rol='AGENTE JUDICIAL' AND ciudad.id_ciudad='$idciudad'";
		
		$resultUsuarioAgenteC=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultUsuarioAgenteC);
	}
	
	
		
	  
	
	public function VisualizarAutoPago(){
	
		session_start();
	
		
		$documentos = new AutoPagosModel();
		$juicios = new JuiciosModel();
		$ciudad = new CiudadModel();
	
		$identificador="";
		$_estado="Visualizar";
		$dato=array();
		$arrayGet=array();
	
		if (isset($_POST["Visualizar"]))
		{
				
			//parametros
			$_juicio_referido_titulo_credito     = $_POST["juicio_referido_titulo_credito"];
			$_creado      = $_POST["creado"];
			$_nombres_clientes   = $_POST["nombres_clientes"];
			$_identificacion_clientes   = $_POST["identificacion_clientes"];
			$_total   = $_POST["total"];
			$_secretarios   = $_POST["secretarios"];
			$_liquidador   = $_POST["liquidador"];
			$_id_titulo_credito   = $_POST["id_titulo_credito"];
			$_nombre_garantes   = $_SESSION['nombre_garantes'];
			$_identificacion_garantes   = $_SESSION['identificacion_garantes'];
			
				
			//traer datos temporales para el reporte
			$resultCiudad = $ciudad->getBy("id_ciudad='$_id_ciudad'");
				
			//consulta datos de juicio
			$columnas="juicios.juicio_referido_titulo_credito,
			clientes.nombres_clientes";
				
			$tablas="public.juicios,public.clientes";
				
			$where="clientes.id_clientes = juicios.id_clientes AND  juicios.id_juicios='$_id_juicio'";
				
			$resultJuicio = $juicios->getCondiciones($columnas, $tablas, $where, "clientes.id_clientes");
				
				
			//cargar datos para el reporte
			
			$dato['juicio_referido']=$resultJuicio[0]->juicio_referido_titulo_credito;
			$dato['creado']=$resultCiudad[0]->nombre_ciudad;
			$dato['nombre_clientes']=$resultJuicio[0]->nombres_clientes;
			$dato['identificacion_clientes']=$_fecha_emision_documentos;
			$dato['nombre_garantes']=$_hora_emision_documentos;
			$dato['identificacion_garantes']=$avoco.$_avoco_vistos_documentos;
			$dato['total']=$_fecha_emision_documentos;
			$dato['impulsor']=$_hora_emision_documentos;
			$dato['secretario']=$avoco.$_avoco_vistos_documentos;
	
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
		setTimeout(window.open('http://$host$uri/view/ireports/ContAutoPagoJuridicoReport.php?estado=$_estado&dato=$result','Popup','height=700,width=800,scrollTo,resizable=1,scrollbars=1,location=0'), 5000);
		</script>";
	
		print("<script>window.location.replace('index.php?controller=Documentos&action=index&dato=$resultArray');</script>");
	
	
	}
	
	
}
?>      