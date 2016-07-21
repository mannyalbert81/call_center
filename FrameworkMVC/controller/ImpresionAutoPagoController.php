<?php

class ImpresionAutoPagoController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
		
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$impresion_auto_pago = new AutoPagosModel();
			
			//Notificaciones
			$impresion_auto_pago->MostrarNotificaciones($_SESSION['id_usuarios']);
			
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
							$_nombre_controlador = "ImpresionAutoPago";
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
					
						$impresion_auto_pago = new AutoPagosModel();
							
							
						$columnas = " auto_pagos.id_auto_pagos,
									  titulo_credito.id_titulo_credito, 
									  juicios.juicio_referido_titulo_credito, 
									  clientes.identificacion_clientes, 
									  clientes.nombres_clientes, 
									  titulo_credito.total, 
									  titulo_credito.fecha_corte, 
									  titulo_credito.fecha_emision, 
									  titulo_credito.fecha_juicio_titulo_credito, 
									  estado.nombre_estado, 
									  auto_pagos.id_usuario_asigna, 
									  usuarios.nombre_usuarios";
					
						$tablas   = " public.clientes, 
									  public.titulo_credito, 
									  public.juicios, 
									  public.auto_pagos, 
									  public.estado, 
									  public.usuarios";
					
						$where    = "clientes.id_clientes = titulo_credito.id_clientes AND
									  titulo_credito.id_titulo_credito = juicios.id_titulo_credito AND
									  auto_pagos.id_titulo_credito = titulo_credito.id_titulo_credito AND
									  auto_pagos.id_estado = estado.id_estado AND estado.nombre_estado = 'APROBADO' AND
									  usuarios.id_usuarios = auto_pagos.id_usuario_asigna";
					
						$id       = "titulo_credito.id_titulo_credito";
							
					
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
					
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
									$where_3 = " AND  juicios.juicio_referido_titulo_credito = '$contenido_busqueda'  ";
									break;
					
						}
					
					
					
						$where_to  = $where . $where_1 . $where_2 . $where_3;
						
							
						$resultDatos=$impresion_auto_pago->getCondiciones($columnas ,$tablas ,$where_to, $id);
					
							
					}
					
					
			
					
				
					
					$this->view("ImpresionAutoPago",array(
							
							 "resultEdit"=>$resultEdit,"resultRol"=>$resultRol, "resultDatos"=>$resultDatos
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Registro Vehiculos Embargados"
			
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
	 
	public function ReporteImpresionAutoPago(){
		
		session_start();
		
		
		$cliente = new ClientesModel();
			
			
		$columnas = "  clientes.identificacion_clientes, 
						  titulo_credito.total, 
						  juicios.juicio_referido_titulo_credito, 
						  clientes.nombres_clientes,
				          ciudad.nombre_ciudad,
				          juicios.creado";
			
		$tablas   = "  public.clientes, 
					  public.titulo_credito, 
					  public.juicios,
				      public.ciudad,
					  public.auto_pagos";
			
		$where    = "titulo_credito.id_clientes = clientes.id_clientes AND
  						titulo_credito.id_titulo_credito = juicios.id_titulo_credito AND
				         ciudad.id_ciudad = clientes.id_ciudad AND auto_pagos.id_titulo_credito=titulo_credito.id_titulo_credito";
			
		$id       = "clientes.id_tipo_identificacion";
		
		$resultCliente=$cliente->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
		$usuario= new UsuariosModel();
	
		$colusuario="auto_pagos.id_usuario_impulsor,
					usuarios.nombre_usuarios";
		$tblusuario="public.auto_pagos,
					public.juicios,
					public.titulo_credito,
					public.usuarios";
		$whereusuario="auto_pagos.id_titulo_credito = juicios.id_titulo_credito AND
					auto_pagos.id_usuario_impulsor = usuarios.id_usuarios AND
					juicios.id_titulo_credito = titulo_credito.id_titulo_credito";
		$idusuario="auto_pagos.id_usuario_impulsor";
		
		$resultUsuario=$usuario->getCondiciones($colusuario, $tblusuario, $whereusuario, $idusuario);
		
		$id_impulsor=$resultUsuario[0]->id_usuario_impulsor;
		
		
		$columnas_secretario="B.id_asignacion_secretarios AS id_asignacion_secretarios ,B.id_secretario_asignacion_secretarios AS id_secretario,B.id_abogado_asignacion_secretarios AS id_abogado,
		(SELECT A.nombre_usuarios FROM usuarios A WHERE A.id_usuarios=B.id_secretario_asignacion_secretarios) AS secretarios,
		(SELECT A.nombre_usuarios FROM usuarios A WHERE A.id_usuarios=B.id_abogado_asignacion_secretarios) AS impulsadores";
		$tbl_secretario="asignacion_secretarios B";
		$where_secretario="B.id_abogado_asignacion_secretarios='$id_impulsor'";
		$id_secretario="B.id_asignacion_secretarios";
			
		$resultSecretario=$usuario->getCondiciones($columnas_secretario, $tbl_secretario, $where_secretario, $id_secretario);
		
		$id_abogado=$resultSecretario[0]->id_abogado;
		$id_secretario=$resultSecretario[0]->id_secretario;
	
		$firmas = new FirmasDigitalesModel();
		
		$columna_firmas_abogado="firmas_digitales.id_firmas_digitales,
		firmas_digitales.imagen_firmas_digitales";
		$tbla_firmas_abogado="public.firmas_digitales";
		$where_firmas_abogado="firmas_digitales.id_usuarios='$id_abogado'";
		$id_firmas_abogado="id_firmas_digitales";
		
		$resultFirma_abogado=$firmas->getCondiciones($columna_firmas_abogado, $tbla_firmas_abogado, $where_firmas_abogado, $id_firmas_abogado);
		
		
		$columna_firmas_secretario="firmas_digitales.id_firmas_digitales,
		firmas_digitales.imagen_firmas_digitales";
		$tbla_firmas_secretario="public.firmas_digitales";
		$where_firmas_secretario="firmas_digitales.id_usuarios='$id_secretario'";
		$id_firmas_secretario="id_firmas_digitales";
		
		$resultFirma_secretario=$firmas->getCondiciones($columna_firmas_secretario, $tbla_firmas_secretario, $where_firmas_secretario, $id_firmas_secretario);
		
		$liquidador= new UsuariosModel();
		
		$columnas = " usuarios.id_usuarios, 
					  firmas_digitales.id_firmas_digitales, 
					  usuarios.nombre_usuarios, 
					  firmas_digitales.imagen_firmas_digitales, 
					  rol.nombre_rol";
			
		$tablas   = " public.usuarios, 
					  public.firmas_digitales, 
					  public.rol ";
			
		$where    = "firmas_digitales.id_usuarios = usuarios.id_usuarios AND
  					rol.id_rol = usuarios.id_rol AND nombre_rol='LIQUIDADOR'";
			
		$id       = "usuarios.nombre_usuarios";
		
		$resultLiquidador=$liquidador->getCondiciones($columnas ,$tablas ,$where, $id);
		
		
		$this->report("ImpresionAutoPago",array( "resultCliente"=>$resultCliente,"resultSecretario"=>$resultSecretario,"resultFirma_abogado"=>$resultFirma_abogado,"resultFirma_secretario"=>$resultFirma_secretario, "resultLiquidador"=> $resultLiquidador
		
		
		));
		
		
	
	}
	
	
	
	
	

	
}
?>      