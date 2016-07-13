<?php

class AsignacionSecretariosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//MAYCOL

	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$asignacionSecretario=new AsignacionSecretariosModel();
			//NOTIFICACIONES
			$asignacionSecretario->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			//creacion ddl de secretarios o abogadpos
			$resultAsignacion=array(0=>'--Seleccione--',1=>'Secretario',2=>'Abg Impulsor');
	
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "PermisosRoles";
			$id_rol= $_SESSION['id_rol'];
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
			
			$usuarios=new UsuariosModel();
			$resultUsu = $usuarios->getAll("nombre_usuarios");
			
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
						$nombre_controladores = "AsignacionSecretarios";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
							$asignacionSecretario=new AsignacionSecretariosModel();
							$_id_asignacion_secretarios = $_GET["id_asignacion_secretarios"];
							
							$columnas = "B.id_asignacion_secretarios AS id_asignacion_secretarios ,B.id_secretario_asignacion_secretarios AS id_secretario,B.id_abogado_asignacion_secretarios AS id_abogado,
								(SELECT A.nombre_usuarios FROM usuarios A WHERE A.id_usuarios=B.id_secretario_asignacion_secretarios) AS secretarios,
								(SELECT A.nombre_usuarios FROM usuarios A WHERE A.id_usuarios=B.id_abogado_asignacion_secretarios) AS impulsadores";
							$tablas   = "asignacion_secretarios B";
							$where    = "B.id_asignacion_secretarios='$_id_asignacion_secretarios'";
							$id       = "B.id_asignacion_secretarios";
							
							$resultEdit=$asignacionSecretario->getCondiciones($columnas, $tablas, $where, $id);
							
							
							$_id_impulsor=$resultEdit[0]->id_abogado;
							
							$columnasC="ciudad.id_ciudad, 
									  ciudad.nombre_ciudad, 
									  usuarios.id_usuarios";
							$tablasC=" public.ciudad, 
  									   public.usuarios";
							$whereC="ciudad.id_ciudad = usuarios.id_ciudad AND usuarios.id_usuarios='$_id_impulsor'";
							
							$resultCiu=$ciudad->getCondiciones($columnasC, $tablasC, $whereC, " usuarios.id_usuarios");
							
							$traza=new TrazasModel();
							$_nombre_controlador = "Asignacion Secretarios";
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
					
					$columnas = "B.id_asignacion_secretarios AS id_asignacion_secretarios ,B.id_secretario_asignacion_secretarios AS id_secreatrio,B.id_abogado_asignacion_secretarios AS id_abogado,
								(SELECT A.nombre_usuarios FROM usuarios A WHERE A.id_usuarios=B.id_secretario_asignacion_secretarios) AS secretarios,
								(SELECT A.nombre_usuarios FROM usuarios A WHERE A.id_usuarios=B.id_abogado_asignacion_secretarios) AS impulsadores";
					$tablas   = "asignacion_secretarios B";
					$where    = "B.id_asignacion_secretarios>0";
					$id       = "B.id_asignacion_secretarios";
						
						
					$asignacionSecretarios = new AsignacionSecretariosModel();
					//$resultSet=$asignacionSecretarios->getAll("id_asignacion_secretarios");
					$resultSet=$asignacionSecretarios->getCondiciones($columnas, $tablas, $where, $id);
					
						
						
			
					if (isset ($_POST["ddl_resultado"]) && isset($_POST["ddl_busqueda"]))
					{
					
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
					
						}
					
					
					//cambio linea 86
					//"resultCon"=>$resultCon, "resultAcc"=>$resultAcc, "resultSet"=>$resultSet,  "resultEdit"=>$resultEdit, "resultRol"=>$resultRol
					
			  		$this->view("AsignacionSecretarios",array(
							
							"resultCon"=>$resultCon,"resultSet"=>$resultSet,  "resultEdit"=>$resultEdit, "resultRol"=>$resultRol,"resultUsuarioSecretario"=>$resultUsuarioSecretario,"resultUsuarioImpulsor"=>$resultUsuarioImpulsor,"resultAsignacion"=>$resultAsignacion, "resultCiu"=>$resultCiu, "resultUsu"=>$resultUsu
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
	 
	
	public function InsertaAsignacionSecretarios(){

		session_start();
		
		$resultado = null;
		$permisos_rol=new PermisosRolesModel();
		$usuarios= new UsuariosModel();
		$tipo_notificacion = new TipoNotificacionModel();
	
		
		$nombre_controladores = "AsignacionSecretarios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["id_usuarioSecretario"]) && isset ($_POST["id_usuarioImpulsor"]) )
				
			{
				
				
				
				$asignacionSecretarios=new AsignacionSecretariosModel();
				$_id_secretario = $_POST["id_usuarioSecretario"];
				$_id_impulsor = $_POST["id_usuarioImpulsor"];
					
				//consultar si hay en la tabla asignacion secretario el codigo de usuario
				
				$col="id_abogado_asignacion_secretarios";
				$tbl="asignacion_secretarios";
				$whre="id_abogado_asignacion_secretarios=".$_id_impulsor;
				$id="id_asignacion_secretarios";
				
				$ressultAsg=$asignacionSecretarios->getCondiciones($col, $tbl, $whre, $id);
				
				
			
					if(empty($ressultAsg))
					{
						//asigno impulsor a secretario
						
						$funcion = "ins_asignacion_secretarios";
							
						$parametros = "'$_id_secretario' ,'$_id_impulsor'";
						
						try {
						
							$asignacionSecretarios->setFuncion($funcion);
							$asignacionSecretarios->setParametros($parametros);
							$resultado=$asignacionSecretarios->Insert();
							
							//inserta las notificacion de impulsor
							
							$_nombre_tipo_notificacion="asignacion";
							$resul_tipo_notificacion=$tipo_notificacion->getBy("descripcion_notificacion='$_nombre_tipo_notificacion'");
							
							$resultSecreatrio=$usuarios->getBy("id_usuarios='$_id_secretario'");
							$nombre_secretario=$resultSecreatrio[0]->nombre_usuarios;
							
							$id_tipo_notificacion=$resul_tipo_notificacion[0]->id_tipo_notificacion;
							$descripcion="Secretario asignado por";
							$numero_movimiento=0;
							$cantidad_cartones=$nombre_secretario;
							
							
							if(!empty($resultSecreatrio))
							{
								$usuarioDestino=$_id_impulsor;
									
								$result_notificaciones=$usuarios->CrearNotificacion($id_tipo_notificacion, $usuarioDestino, $descripcion, $numero_movimiento, $cantidad_cartones);
									
							
							}else
							{
									
							}
							
							//inserta las notificacion de secretario
							
							$resultimpulsor=$usuarios->getBy("id_usuarios='$_id_impulsor'");
							$nombre_impulsor=$resultimpulsor[0]->nombre_usuarios;
							
							$descripcion="Impulsor asignado por";
							$numero_movimiento=0;
							$cantidad_cartones=$nombre_impulsor;
								
								
							if(!empty($resultimpulsor))
							{
								$usuarioDestino=$_id_secretario;
									
								$result_notificaciones=$usuarios->CrearNotificacion($id_tipo_notificacion, $usuarioDestino, $descripcion, $numero_movimiento, $cantidad_cartones);
								
								
							}else
							{
									
							}
							
							
							$traza=new TrazasModel();
							$_nombre_controlador = "Asignacion Secretarios";
							$_accion_trazas  = "Guardar";
							$_parametros_trazas = $_id_secretario;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
						
							$this->redirect("AsignacionSecretarios", "index");
								
							}
							catch (Exeption $Ex)
							{
								$this->view("Error",array(
										"resultado"=>$Ex
								));
							
							
							}
							
					}else if(isset ($_POST["id_asignacion_secretarios_hidden"]))
						
						{
							$_id_asig_secretario = $_POST["id_asignacion_secretarios_hidden"];
							$_id_impulsor = $_POST["id_usuarioImpulsor"];
							$_id_secretario = $_POST["id_usuarioSecretario"];
							
							$colval = " id_secretario_asignacion_secretarios = '$_id_secretario'   ";
							$tabla = "asignacion_secretarios";
							$where = "id_asignacion_secretarios = '$_id_asig_secretario'";
								
							$resultado=$asignacionSecretarios->UpdateBy($colval, $tabla, $where);
							$this->redirect("AsignacionSecretarios", "index");
							
							
							
						}else{
							//$RsptaAbogado="ABOGADO IMPULSOR YA SE ENCUENTRA ASIGNADO";
							$this->redirect("AsignacionSecretarios", "index");
						}
		
			}//termina if de validar ddl 
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos Para Asignar Secretarios"
		
			));
		
		
		}
		
		
		
	}
	
	public function borrarId()
	{
		$permisos_rol = new PermisosRolesModel();

		session_start();
		
		$nombre_controladores = "AsignacionSecretarios";
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
				$_nombre_controlador = "Asignacion Secretarios";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_asigancionSecretarios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			
			$this->redirect("AsignacionSecretarios", "index");
			
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Borrar la Asignacion Secretarios"
		
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
		
		$resultUsuarioSecretarioC=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultUsuarioSecretarioC);
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
	
	public function VerAsignacion()
	{
		
		$this->view("Bienvenida", array());
	}
	
	

	
}
?>      