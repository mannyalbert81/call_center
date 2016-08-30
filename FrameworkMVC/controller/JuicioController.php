<?php

class JuicioController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$juicio = new JuiciosModel();
			//Notificaciones
			$juicio->MostrarNotificaciones($_SESSION['id_usuarios']); 
			
			$resultSet=array();
			
			$resultEdit = "";
			$resul = "";
			
			
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "Juicio";
			$id_rol= $_SESSION['id_rol'];
			
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				
					
					if(isset($_POST["buscar"])){
					
						$criterio_busqueda=$_POST["criterio_busqueda"];
						$contenido_busqueda=$_POST["contenido_busqueda"];
					
						$juicio = new JuiciosModel();
							
							
						$columnas = "   juicios.id_juicios, 
									  entidades.nombre_entidades, 
									  ciudad.nombre_ciudad, 
									  juicios.juicio_referido_titulo_credito, 
									  usuarios.nombre_usuarios, 
									  titulo_credito.id_titulo_credito, 
									  titulo_credito.total, 
									  clientes.nombres_clientes, 
									  etapas_juicios.nombre_etapas, 
									  tipo_juicios.nombre_tipo_juicios, 
									  juicios.descipcion_auto_pago_juicios, 
									  estados_procesales_juicios.nombre_estado_procesal_juicios, 
									  juicios.fecha_emision_juicios, 
									  estados_auto_pago_juicios.nombre_estados_auto_pago_juicios, 
									  juicios.nombre_archivado_juicios";
					
						$tablas   = "public.juicios, 
								  public.entidades, 
								  public.ciudad, 
								  public.usuarios, 
								  public.titulo_credito, 
								  public.clientes, 
								  public.etapas_juicios, 
								  public.tipo_juicios, 
								  public.estados_procesales_juicios, 
								  public.estados_auto_pago_juicios";
					
						$where    = "entidades.id_entidades = juicios.id_entidades AND
								  ciudad.id_ciudad = juicios.id_ciudad AND
								  usuarios.id_usuarios = juicios.id_usuarios AND
								  titulo_credito.id_titulo_credito = juicios.id_titulo_credito AND
								  clientes.id_clientes = juicios.id_clientes AND
								  etapas_juicios.id_etapas_juicios = juicios.id_etapas_juicios AND
								  tipo_juicios.id_tipo_juicios = juicios.id_tipo_juicios AND
								  estados_procesales_juicios.id_estados_procesales_juicios = juicios.id_estados_procesales_juicios AND
								  estados_auto_pago_juicios.id_estados_auto_pago_juicios = juicios.id_estados_auto_pago_juicios";
					
						$id       = "juicios.id_juicios";
							
					
						$where_1 = "";
						$where_2 = "";
					
						switch ($criterio_busqueda) {
							
							case 0:
								// identificacion de cliente
								$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
								break;
							case 1:
								//id_titulo de credito
								$where_2 = " AND  titulo_credito.id_titulo_credito = '$contenido_busqueda'  ";
								break;
							case 2:
									//id_titulo de credito
								$where_2 = " AND  juicios.juicio_referido_titulo_credito LIKE '$contenido_busqueda'  ";
								break;
					
						}
					
					
					
						$where_to  = $where . $where_1 . $where_2;
						
						//$this->view("Error",array(
									
							//	"resultado"=>"select \n".$columnas."\n From\n".$tablas."\n where\n".$where_to."\n order by\n".$id
					//	));
						//exit();
						
							
						$resultSet=$juicio->getCondiciones($columnas ,$tablas ,$where_to, $id);
					
							
					}
					
			
					$this->view("Juicio",array(
							
							 "resultEdit"=>$resultEdit, "resultSet"=>$resultSet
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Seguimiento de Juicios"
			
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
	 
	public function ActualizarAutoPago(){
		session_start();
		
		$resultado = null;
		$permisos_rol = new PermisosRolesModel();
		$aprobacion_auto_pago = new AutoPagosModel();
		$nombre_controladores = "AprobacionAutoPago";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			if(isset($_GET["id_auto_pagos"])){
				
			
				
				$estado=new EstadoModel();
				$resultEstado=$estado->getBy("nombre_estado='APROBADO'");
				
				$id_estado=$resultEstado[0]->id_estado;
				$colval="id_estado='$id_estado'";
				$id_auto_pago=$_GET["id_auto_pagos"];
				
				//para obtener id titulo credito
				$id_titulo_credito = $_GET["id_titulo_credito"];
				
				$tabla="auto_pagos";
				
				$where="id_auto_pagos='$id_auto_pago'";
				
				try {
					
					//$resultado=$aprobacion_auto_pago->UpdateBy($colval, $tabla, $where);
					
					//pra obtener id_ciudad
					
					$col_ciudad="titulo_credito.id_ciudad";
					$tbl_ciudad="public.titulo_credito,public.ciudad";
					$whre_ciudad="ciudad.id_ciudad = titulo_credito.id_ciudad AND
					titulo_credito.id_titulo_credito='$id_titulo_credito'";
					$resultCiudad=$aprobacion_auto_pago->getCondiciones($col_ciudad, $tbl_ciudad, $whre_ciudad, "titulo_credito.id_ciudad");
					
					$id_ciudad=$resultCiudad[0]->id_ciudad;
					
					//para obtener juicio referido
					$anio=date("Y");
					$col_prefijo=" prefijos.nombre_prefijos,prefijos.consecutivo";
					$tbl_prefijo="public.prefijos";
					$whre_prefijo="prefijos.id_ciudad='$id_ciudad'";
					$resultprefijo=$aprobacion_auto_pago->getCondiciones($col_prefijo, $tbl_prefijo, $whre_prefijo, "prefijos.id_prefijos");
					
					$juicio_referido_titulo_credito=$resultprefijo[0]->nombre_prefijos."-".$resultprefijo[0]->consecutivo."-".$anio;
					
					//para obtener usuario impulsor
					$col_impulsor="titulo_credito.id_usuarios,titulo_credito.id_clientes";
					$tbl_impulsor=" public.titulo_credito";
					$whre_impulsor="titulo_credito.id_titulo_credito='$id_titulo_credito'";
					$resultusuarioImpulsor=$aprobacion_auto_pago->getCondiciones($col_impulsor, $tbl_impulsor, $whre_impulsor, "titulo_credito.id_usuarios");
						
					$id_usuarios=$resultusuarioImpulsor[0]->id_usuarios;
					
					//para obtener cliente ya trae en la consulta de resultusuarioImpulsor
					$id_clientes=$resultusuarioImpulsor[0]->id_clientes;
					
					//para obtener etapas juicios
					$col_etapa_juicio="*";
					$tbl_etapa_juicio="etapas_juicios";
					$whre_etapa_juicio="etapas_juicios.nombre_etapas LIKE '%PRIMERA%'";
					$result_etapas_juicios=$aprobacion_auto_pago->getCondiciones($col_etapa_juicio, $tbl_etapa_juicio, $whre_etapa_juicio, "id_etapas_juicios");
					
					$id_etapas_juicios=$result_etapas_juicios[0]->id_etapas_juicios;
					
					//para obtener tipo_juicios
					$col_tipo_juicio="*";
					$tbl_etapa_juicio="tipo_juicios";
					$whre_etapa_juicio="tipo_juicios.nombre_tipo_juicios LIKE 'NINGUNA'";
					$result_tipo_juicios=$aprobacion_auto_pago->getCondiciones($col_etapa_juicio, $tbl_etapa_juicio, $whre_etapa_juicio, "id_tipo_juicios");
					
					$id_tipo_juicios=$result_tipo_juicios[0]->id_tipo_juicios;
					
					//pra descripcion auto pago juicio
					$descipcion_auto_pago_juicios="Prueba de insercion";
					
					//para estados procesales juicios "Auto de Pago"
					$col_est_procesales="*";
					$tbl_est_procesales="estados_procesales_juicios";
					$whre_est_procesales="nombre_estado_procesal_juicios LIKE 'Auto de Pago'";
					$result_est_procesales=$aprobacion_auto_pago->getCondiciones($col_est_procesales, $tbl_est_procesales, $whre_est_procesales, "id_estados_procesales_juicios");
					
					$id_estados_procesales_juicios=$result_est_procesales[0]->id_estados_procesales_juicios;
					
					//para estados auto pagos juicios
					$col_est_auto_pago_juicios="*";
					$tbl_est_auto_pago_juicios="estados_auto_pago_juicios";
					$whre_est_auto_pago_juicios="nombre_estados_auto_pago_juicios LIKE 'A'";
					$result_auto_pago_juicios=$aprobacion_auto_pago->getCondiciones($col_est_auto_pago_juicios, $tbl_est_auto_pago_juicios, $whre_est_auto_pago_juicios, "id_estados_auto_pago_juicios");
					
					$id_estados_auto_pago_juicios=$result_auto_pago_juicios[0]->id_estados_auto_pago_juicios;
					
					//para archivos
					$prefijo=CLIENTE;
					$nombre_archivado_juicios=$prefijo."-".$juicio_referido_titulo_credito;
					//para entidad
					$id_entidades=10;
					
					//$this->view("Error",array(
					//		"resultado"=>"entidad ".$id_entidades." ciud ".$id_ciudad." referido ".$juicio_referido_titulo_credito."usuario".$id_usuarios." tiulo credito ".$id_titulo_credito." id_cliente ".$id_clientes." Etapa juicio ".$id_etapas_juicios." tIpo JUicio ".$id_tipo_juicios." descripcion".$descipcion_auto_pago_juicios." estado procesal ".$id_estados_procesales_juicios."estado pago juicio".$id_estados_auto_pago_juicios."nombre archivado".$nombre_archivado_juicios
					//));
					
					//exit();
					
					//aqui va insertado de juicio

					$resultadojuicio=$aprobacion_auto_pago->InsertaJuicio($id_entidades, $id_ciudad, $juicio_referido_titulo_credito, $id_usuarios, $id_titulo_credito, $id_clientes, $id_etapas_juicios, $id_tipo_juicios, $descipcion_auto_pago_juicios, $id_estados_procesales_juicios, $id_estados_auto_pago_juicios, $nombre_archivado_juicios);
					
					
					
				} catch (Exception $e) {
					
					$this->view("Error",array(
							"resultado"=>"Eror al Aprobar Auto pago ->". $id_auto_pago
					));
					
				}
				
				
				
				
				
				
				
			}
			
			$this->redirect("Juicio", "index");
		
		}
		
	}
	
	public function InsertaJuicio(){

		session_start();
		
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
	
	
	
	
	
	
	public function devuelveAcciones()
	{
		$resultAcc = array();
	
		if(isset($_POST["id_controladores"]))
		{
	
			$id_controladores=(int)$_POST["id_controladores"];
	
			$acciones=new AccionesModel();
	
			$resultAcc = $acciones->getBy(" id_controladores = '$id_controladores'  ");
	
	
		}
	
		echo json_encode($resultAcc);
	
	}
	
	
	public function devuelveSubByAcciones()
	{
		$resultAcc = array();
	
		if(isset($_POST["id_acciones"]))
		{
	
			$id_acciones=(int)$_POST["id_acciones"];
	
			$acciones=new AccionesModel();
	
			$resultAcc = $acciones->getBy(" id_acciones = '$id_acciones'  ");
	
	
		}
	
		echo json_encode($resultAcc);
	
	}
	
 public function devuelveAllAcciones()
	{
		$resultAcc = array();
	
		$acciones=new AccionesModel();
	
		$resultAcc = $acciones->getAll(" id_controladores, nombre_acciones");
	
		echo json_encode($resultAcc);
	
	}
	
	public function returnImpulsorbyciudad()
	{
	
		//CONSULTA DE USUARIOS POR SU ROL
		$idciudad=(int)$_POST["ciudad"];
		$usuarios=new UsuariosModel();
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios,ciudad,rol";
		$id="rol.id_rol";
	
		$where="rol.id_rol=usuarios.id_rol AND usuarios.id_ciudad=ciudad.id_ciudad
		AND rol.nombre_rol='ABOGADO IMPULSOR' AND ciudad.id_ciudad='$idciudad'";
	
		$resultUsuarioImpulC=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultUsuarioImpulC);
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
	
	
	
	public function returnSecretarios()
	{
	
		
		//CONSULTA DE USUARIOS POR SU ROL
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
		$id="rol.id_rol";
			
		$usuarios=new UsuariosModel();
		
		$where="rol.nombre_rol='SECRETARIO'";
		$resultUsuarioSecretario=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultUsuarioSecretario);
	
	}
	
	public function returnImpulsores()
	{
	
		//CONSULTA DE USUARIOS POR SU ROL
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
		$id="rol.id_rol";
			
		$usuarios=new UsuariosModel();
	
		$where="rol.nombre_rol='ABOGADO IMPULSOR'";
		$resultUsuarioImpulsor=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultUsuarioImpulsor);
	
	}
	
	public function CompruebaImpulsores()
	{
		$resultado=0;
		//consulta para ver si hay impulsores en la tabla asignacio secretario
		$asignacionSecretarios=new AsignacionSecretariosModel();
			
		$_id_impulsor=$_POST['id_abgImpulsor'];
		$col="id_abogado_asignacion_secretarios";
		$tbl="asignacion_secretarios";
		$whre="id_abogado_asignacion_secretarios=".$_id_impulsor;
		$id="id_asignacion_secretarios";
			
		$ressultAsg=$asignacionSecretarios->getCondiciones($col, $tbl, $whre, $id);
		
		if(empty($ressultAsg)){
			
			$this->view("Error",array(
					"resultado"=>"No existen datos"
			
			));
			exit();
		}else{
			$this->view("Error",array(
					"resultado"=>"datos extraidos"
		
			));
			exit();
		}
			
		echo json_encode($ressultAsg);
	
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
	
		$juicios = new JuiciosModel();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Juicio";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $juicios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
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
  					asignacion_secretarios_view.impulsores,
  					asignacion_secretarios_view.secretarios,
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
					  public.asignacion_secretarios_view";
	
					$where="ciudad.id_ciudad = clientes.id_ciudad AND
					  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
					  juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
					  juicios.id_clientes = clientes.id_clientes AND
					  juicios.id_tipo_juicios = tipo_juicios.id_tipo_juicios AND
					  etapas_juicios.id_etapas_juicios = juicios.id_etapas_juicios AND
					  juicios.id_usuarios= asignacion_secretarios_view.id_abogado AND juicios.id_usuarios ='$_id_usuarios'";
	
					$id="juicios.id_juicios";
						
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
						
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
						
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
						
					if($titulo_credito!=""){$where_3=" AND juicios.id_titulo_credito='$titulo_credito'";}
						
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  juicios.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);
	        }
	
	            $this->view("ConsultaJuicios",array(
						"resultSet"=>$resultSet,"resultDatos"=>$resultDatos
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consulta Juicios"
	
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
	
	
	
	public function consulta_seguimiento_juicio(){
	
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
	
		$juicios = new JuicioModel();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Juicio";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $juicios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){
	 
				    //RESULT CITACIONES IMPULSORES
					$citaciones= new CitacionesModel();
					
					$columnas_citaciones = "citaciones.id_citaciones,
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
					
					$tablas_citaciones=" public.citaciones,
  					public.juicios,
  					public.ciudad,
  					public.tipo_citaciones,
  					public.usuarios,
  					public.clientes";
					
					$where_citaciones="juicios.id_juicios = citaciones.id_juicios AND
					ciudad.id_ciudad = citaciones.id_ciudad AND
					tipo_citaciones.id_tipo_citaciones = citaciones.id_tipo_citaciones AND
					usuarios.id_usuarios = citaciones.id_usuarios AND
					clientes.id_clientes = juicios.id_clientes";
					
					$id_citaciones="citaciones.id_citaciones";
					
					$result_citaciones=$citaciones->getCondiciones($columnas_citaciones ,$tablas_citaciones , $where_citaciones, $id_citaciones);
				
				
				   //CONSULTA DOCUMENTOS IMPULSORES
				
					$documentos_impulsores=new DocumentosModel();
					
					$columnas_documentos_impulsores = "documentos.id_documentos,
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
					
					$tablas_documentos_impulsores=" public.documentos,
					public.ciudad,
					public.juicios,
					public.usuarios,
					public.clientes,
					public.estados_procesales_juicios";
					
					$where_documentos_impulsores= "ciudad.id_ciudad = documentos.id_ciudad AND
					juicios.id_juicios = documentos.id_juicio AND
					usuarios.id_usuarios = documentos.id_usuario_registra_documentos AND
					clientes.id_clientes = juicios.id_clientes AND
					estados_procesales_juicios.id_estados_procesales_juicios = documentos.id_estados_procesales_juicios";
							
					$id_documentos_impulsores= "documentos.id_documentos";
				
				    $result_documentos_impulsores=$documentos_impulsores->getCondiciones($columnas_documentos_impulsores ,$tablas_documentos_impulsores , $where_documentos_impulsores, $id_documentos_impulsores);
						
				    
				    //CONSULTA OFICIOS IMPULSORES
				
				    $oficios= new OficiosModel();
				    	
				    $columnas_oficios = "oficios.id_oficios,
					oficios.creado,
					oficios.numero_oficios,
					juicios.id_juicios,
					juicios.juicio_referido_titulo_credito,
					juicios.id_titulo_credito,
					clientes.nombres_clientes,
					clientes.identificacion_clientes,
					entidades.id_entidades,
					entidades.nombre_entidades";
				    
				    $tablas_oficios="public.oficios,
					public.juicios,
					public.entidades,
					public.clientes,
					public.usuarios";
				    
				    $where_oficios="juicios.id_juicios = oficios.id_juicios AND
					entidades.id_entidades = oficios.id_entidades AND
					clientes.id_clientes = juicios.id_clientes AND usuarios.id_usuarios = oficios.id_usuario_registra_oficios";
				    
				    $id_oficios="oficios.id_oficios";
				    
				    $result_oficios=$oficios->getCondiciones($columnas_oficios ,$tablas_oficios , $where_oficios, $id_oficios);
				    
				    
				    //CONSULTA AVOCO CONOCIMIENTO IMPULSORES
				    
				    $avoco=new AvocoConocimientoModel();
				    
				    $columnas_avoco = "avoco_conocimiento.id_avoco_conocimiento,
					juicios.juicio_referido_titulo_credito,
					clientes.nombres_clientes,
					clientes.identificacion_clientes,
					ciudad.nombre_ciudad,
					asignacion_secretarios_view.secretarios,
					asignacion_secretarios_view.impulsores,
					usuarios.nombre_usuarios,
					avoco_conocimiento.creado";
				    
				    $tablas_avoco = " public.avoco_conocimiento,
					public.juicios,
					public.ciudad,
					public.asignacion_secretarios_view,
					public.clientes,
					public.usuarios";
				    
				    $where_avoco= "avoco_conocimiento.id_secretario = asignacion_secretarios_view.id_secretario AND
					avoco_conocimiento.id_impulsor = asignacion_secretarios_view.id_abogado AND
					avoco_conocimiento.secretario_reemplazo = usuarios.id_usuarios AND
					juicios.id_juicios = avoco_conocimiento.id_juicios AND
					ciudad.id_ciudad = avoco_conocimiento.id_ciudad AND
					clientes.id_clientes = juicios.id_clientes";
				    
				    $id_avoco="avoco_conocimiento.id_avoco_conocimiento";
				    
				    $result_avoco=$avoco->getCondiciones($columnas_avoco ,$tablas_avoco , $where_avoco, $id_avoco);
				 
				    //CONSULTA AUTOS DE PAGO
				    
				}
	
				$this->view("Juicio",array(
						"resultSet"=>$resultSet,"resultDatos"=>$resultDatos
							
				));
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Seguimiento Juicios"
	
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