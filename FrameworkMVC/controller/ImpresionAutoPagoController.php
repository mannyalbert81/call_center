<?php

class ImpresionAutoPagoController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$resultDatos=array();
			
			//creacion ddl de secretarios o abogadpos
			$resultAsignacion=array(0=>'--Seleccione--',1=>'Secretario',2=>'Abg Impulsor');
	
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "ImpresionAutoPago";
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
						$nombre_controladores = "ImpresionAutoPago";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
							
							
							$resultEdit=$asignacionSecretario->getCondiciones($columnas, $tablas, $where, $id);
							
							
							$traza=new TrazasModel();
							$_nombre_controlador = "ImpresionAutoPagos";
							$_accion_trazas  = "Editar";
							$_parametros_trazas = $_id_asignacion_secretarios;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Impresion Auto de Pago"
						
									
							));
						
							exit();
						}
						
						
						
					}
					
					if(isset($_POST["buscar"])){
					
						$criterio_busqueda=$_POST["criterio_busqueda"];
						$contenido_busqueda=$_POST["contenido_busqueda"];
					
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
								  clientes.id_clientes = titulo_credito.id_clientes";
					
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
					
					
			
					
				
					
					$this->view("ImpresionAutoPago",array(
							
							 "resultEdit"=>$resultEdit,"resultRol"=>$resultRol, "resultDatos"=>$resultDatos
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Impresion Auto Pago"
			
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
		$nombre_controladores = "ImpresionAutoPago";
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
				
				$tabla="auto_pagos";
				
				$where="id_auto_pagos='$id_auto_pago'";
				
				try {
					
					$resultado=$aprobacion_auto_pago->UpdateBy($colval, $tabla, $where);
					
					//juicio-referido
					$anio=date("Y"); 
					
					//aqui va insertado de juicio

					$id_entidades="";
					$id_ciudad="";
					$juicio_referido_titulo_credito="";
					$id_usuarios="";
					$id_titulo_credito="";
					$id_clientes="";
					$id_etapas_juicios="";
					$id_tipo_juicios="";
					$descipcion_auto_pago_juicios="";
					$id_estados_procesales_juicios="";
					$id_estados_auto_pago_juicios="";
					$nombre_archivado_juicios="";
					$id_ciudad="";
					
					$resultadojuicio=$aprobacion_auto_pago->InsertaJuicio($id_entidades, $id_ciudad, $juicio_referido_titulo_credito, $id_usuarios, $id_titulo_credito, $id_clientes, $id_etapas_juicios, $id_tipo_juicios, $descipcion_auto_pago_juicios, $id_estados_procesales_juicios, $id_estados_auto_pago_juicios, $nombre_archivado_juicios, $id_ciudad);
					
					
					
				} catch (Exception $e) {
					
					$this->view("Error",array(
							"resultado"=>"Eror al Aprobar Auto pago ->". $id_auto_pago
					));
					
				}
				
				
				
				
				
				
				
			}
			
			$this->redirect("ImpresionAutoPago", "index");
		
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