<?php

class AprobacionAutoPagoController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	//maycol454

	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$aprobacion_auto_pago = new AutoPagosModel();
			//NOTIFICACIONES
			$aprobacion_auto_pago->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$resultDatos=array();
			
			//creacion ddl de secretarios o abogadpos
			$resultAsignacion=array(0=>'--Seleccione--',1=>'Secretario',2=>'Abg Impulsor');
	
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "AprobacionAutoPago";
			$id_rol= $_SESSION['id_rol'];
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
			
			$usuarios=new UsuariosModel();
			$resultUsu = $usuarios->getAll("nombre_usuarios");
			
			$estado=new EstadoModel();
			$resultEstado=$estado->getBy("nombre_estado='PENDIENTE'");
			
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
				
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
						$nombre_controladores = "AprobacionAutoPago";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
							
							
							$resultEdit=$asignacionSecretario->getCondiciones($columnas, $tablas, $where, $id);
							
							
							$traza=new TrazasModel();
							$_nombre_controlador = "AprobacionAutoPagos";
							$_accion_trazas  = "Editar";
							$_parametros_trazas = $_id_asignacion_secretarios;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Aprobacion Auto de Pago"
						
									
							));
						
							exit();
						}
						
						
						
					}
					
					if(isset($_POST["buscar"])){
					
						$criterio_busqueda=$_POST["criterio_busqueda"];
						$contenido_busqueda=$_POST["contenido_busqueda"];
						$id_estado=$resultEstado[0]->id_estado;
					
						$aprobacion_auto_pago = new AutoPagosModel();
							
							
						$columnas = " auto_pagos.id_auto_pagos, 
						  auto_pagos.id_titulo_credito, 
						  clientes.identificacion_clientes, 
						  clientes.nombres_clientes, 
						  usuarios.nombre_usuarios, 
						  auto_pagos.fecha_asiganacion_auto_pagos, 
						  estado.nombre_estado";
					
						$tablas   = "public.auto_pagos, 
								  public.usuarios, 
								  public.titulo_credito, 
								  public.estado, 
								  public.clientes";
					
						$where    = "usuarios.id_usuarios = auto_pagos.id_usuario_impulsor AND
								  titulo_credito.id_titulo_credito = auto_pagos.id_titulo_credito AND
								  estado.id_estado = auto_pagos.id_estado AND
								  clientes.id_clientes = titulo_credito.id_clientes AND
								   estado.id_estado ='$id_estado'";
					
						$id       = "titulo_credito.id_titulo_credito";
							
					
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
					
						}
					
					
					
						$where_to  = $where . $where_1 . $where_2;
						
							
						$resultDatos=$aprobacion_auto_pago->getCondiciones($columnas ,$tablas ,$where_to, $id);
					
							
					}
					
					
			
					
				
					
					$this->view("AprobacionAutoPago",array(
							
							 "resultEdit"=>$resultEdit,"resultRol"=>$resultRol, "resultDatos"=>$resultDatos
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
	 
	public function ActualizarAutoPago(){
		session_start();
		
		//para generar el archivo pdf
		
		$identificador="";
		$_estado = "Guardar";
		$dato=array();
		
		
		$resultado = null;
		$permisos_rol = new PermisosRolesModel();
		$aprobacion_auto_pago = new AutoPagosModel();
		$nombre_controladores = "AprobacionAutoPago";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			
			if(isset($_GET["id_auto_pagos"]))
			{
				
			
				$consecutivo= new ConsecutivosModel();
				$resultConsecutivo= $consecutivo->getBy("documento_consecutivos='AUTOPAGOS'");
				$identificador=$resultConsecutivo[0]->real_consecutivos;
				
				$repositorio_documento="AutoPagos";
				
				$nombre_documento=$repositorio_documento.$identificador;
				
				$estado=new EstadoModel();
				$resultEstado=$estado->getBy("nombre_estado='APROBADO'");
				
				$id_estado=$resultEstado[0]->id_estado;
				
				//para obtener el id auto de pago
				$id_auto_pago=$_GET["id_auto_pagos"];
				
				//para obtener id titulo credito
				$id_titulo_credito = $_GET["id_titulo_credito"];
				
				
				try {
					
					$resultado=$aprobacion_auto_pago->UpdateBy("id_estado='$id_estado',nombre_auto_pagos='$nombre_documento',identificador='$identificador',ruta_auto_pagos='$repositorio_documento'", "auto_pagos", "id_auto_pagos='$id_auto_pago'");
					
					
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
					
					//aqui va insertado de juicio

					$resultadojuicio=$aprobacion_auto_pago->InsertaJuicio($id_entidades, $id_ciudad, $juicio_referido_titulo_credito, $id_usuarios, $id_titulo_credito, $id_clientes, $id_etapas_juicios, $id_tipo_juicios, $descipcion_auto_pago_juicios, $id_estados_procesales_juicios, $id_estados_auto_pago_juicios, $nombre_archivado_juicios);
					
					$consecutivo->UpdateBy("real_consecutivos=real_consecutivos+1", "consecutivos", "documento_consecutivos='AUTOPAGOS'");
					
					
					
				} catch (Exception $e) {
					
					$this->view("Error",array(
							"resultado"=>"Eror al Aprobar Auto pago ->". $id_auto_pago
					));
					
				}
				
				$host  = $_SERVER['HTTP_HOST'];
				$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
				
				//$this->view("Error", array("resultado"=>$host.$uri));
				
				
				 print "<script language='JavaScript'>
				 setTimeout(window.open('http://$host$uri/view/ireports/ContAutoPagoJuridicoReport.php?identificador=$identificador&estado=$_estado&nombre=$nombre_documento','Popup','height=300,width=400,scrollTo,resizable=1,scrollbars=1,location=0'), 5000);
				 </script>";
				 	
				 print("<script>window.location.replace('index.php?controller=AprobacionAutoPago&action=index');</script>");
				 
				
			}
			
			//$this->redirect("AprobacionAutoPago", "index");
		
		}else{
			
			$this->view("Error", array("resultado"=>"No tiene Acceso a aprobacion de Auto Pagos"));
			
			}
		
	}
	
	public function InsertaAutoPagos(){

		session_start();
		
		$resultado = null;
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
				$_id_usuario_impulsor = $_POST["id_usuarioImpulsor"];
				$_id_usuario_agente = $_POST["id_usuarioAgente"];
				$_fecha_asignado=$_POST["fecha_asignacion"];
				$_estado =$_POST["id_estado"];
				
				foreach($_array_titulo_credito  as $id  )
				{
						if (!empty($id) )
					{
						//busco si exties este nuevo id
						try 
						{
							$_id_titulo_credito = $id;
							//parametros  _id_titulo_credito integer, _id_usuario_asigna integer, _id_usuario_impulsor integer, _id_usuario_agente integer, _id_estado integer, _fecha_asiganacion_auto_pagos date
							$funcion = "ins_auto_pagos";
							$parametros = "'$_id_titulo_credito','$_usuario_asigna', '$_id_usuario_impulsor','$_id_usuario_agente','$_estado','$_fecha_asignado'";
							$auto_pagos->setFuncion($funcion);
							$auto_pagos->setParametros($parametros);
							$resultado=$auto_pagos->Insert();
										
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
					"resultado"=>"No tiene Permisos de Asignacion Titulo Credito"
		
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
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$subcategorias=new SubCategoriasModel();
		//Conseguimos todos los usuarios
	
	
		$columnas = " subcategorias.id_subcategorias, categorias.nombre_categorias, subcategorias.nombre_subcategorias, subcategorias.path_subcategorias";
		$tablas   = "public.subcategorias, public.categorias";
		$where    = "subcategorias.id_categorias = categorias.id_categorias";
		$id       = "categorias.nombre_categorias,subcategorias.nombre_subcategorias";
		
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $subcategorias->getCondicionesPDF($columnas, $tablas, $where, $id);
			
			$this->report("SubCategorias",array(	"resultRep"=>$resultRep));
	
		}
			
	
	}
	

	
}
?>      