<?php

class AsignacionTituloCreditoController extends ControladorBase{

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
			
			$nombre_controladores = "PermisosRoles";
			$id_rol= $_SESSION['id_rol'];
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
			
			$usuarios=new UsuariosModel();
			$resultUsu = $usuarios->getAll("nombre_usuarios");
			
			$resultDatos=array();
			
			
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					$resultEdit = "";
					$resul = "";
			
					    $rol = new RolesModel();
					    $resultRol=$rol->getAll("nombre_rol");
					    
					    $controladores = new ControladoresModel();
					    $resultCon=$controladores->getAll("nombre_controladores");
					    
						$nombre_controladores = "AsignacionTituloCredito";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
							$traza=new TrazasModel();
							$_nombre_controlador = "AsignacionTituloCredito";
							$_accion_trazas  = "Editar";
							$_parametros_trazas ="";
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Asignacion Titutlo de Credito"
						     ));
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
	                         ciudad.id_ciudad = titulo_credito.id_ciudad";
					
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
					}
					
					$this->view("AsignacionTituloCredito",array(
							
							 "resultEdit"=>$resultEdit, "resultRol"=>$resultRol, "resultCiu"=>$resultCiu, "resultUsu"=>$resultUsu, "resultDatos"=>$resultDatos
					));
			
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Asignacion Titulo de Credito"
			
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
	 
	
	public function InsertaAsignacionTituloCredito(){

		session_start();
		
		$resultado = null;
		$permisos_rol=new PermisosRolesModel();
		$asignacion_titulo_credito = new AsignacionTitulosCreditoModel();
	    $nombre_controladores = "AsignacionTituloCredito";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $asignacion_titulo_credito->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			$resultado = null;
			$asignacion_titulo_credito = new AsignacionTitulosCreditoModel();

			if (isset ($_POST["id_titulo_credito"])   )
			{
				
				$_array_titulo_credito = $_POST["id_titulo_credito"];
				$_id_ciudad = $_POST["id_ciudad"];
				$_id_usuarios = $_POST["id_usuarioImpulsor"];
				
				foreach($_array_titulo_credito  as $id  )
				{
						if (!empty($id) )
					{
						//busco si exties este nuevo id
						try 
						{
							$_id_titulo_credito = $id;
							
							$funcion = "ins_asignacion_titulo_credito";
							$parametros = "'$_id_titulo_credito', '$_id_ciudad', '$_id_usuarios'";
							$asignacion_titulo_credito->setFuncion($funcion);
							$asignacion_titulo_credito->setParametros($parametros);
							$resultado=$asignacion_titulo_credito->Insert();
										
						} catch (Exception $e) 
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Asignar ->". $id
							));
						}
							
					}
					 
				}
				$traza=new TrazasModel();
				$_nombre_controlador = "Entidades";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_titulo_credito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
		
				
			}

			$this->redirect("AsignacionTituloCredito", "index");
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
	
}
?>      