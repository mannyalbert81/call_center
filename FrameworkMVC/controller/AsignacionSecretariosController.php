<?php

class AsignacionSecretariosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
	
			$permisos_rol = new PermisosRolesModel();
			
			$nombre_controladores = "PermisosRoles";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $permisos_rol->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
					
					//CONSULTA DE USUARIOS POR SU ROL 
					$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
					$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
					$id="rol.id_rol";
					
					$usuarios=new UsuariosModel();
					//$where="id_rol=5";
					//$resultUsuarioSecretario=$usuarios->getBy($where);
					//$where="id_rol=3";
					//$resultUsuarioImpulsor=$usuarios->getBy($where);
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
			
					if (isset ($_GET["id_permisos_rol"])   )
					{
						$nombre_controladores = "PermisosRoles";
						$id_rol= $_SESSION['id_rol'];
						$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
						if (!empty($resultPer))
						{
						
							$_id_permisos_rol = $_GET["id_permisos_rol"];
							$resultEdit = $permisos_rol->getBy("id_permisos_rol = '$_id_permisos_rol' ");
							
						}
						else
						{
							$this->view("Error",array(
									"resultado"=>"No tiene Permisos de Editar Asignacion Secretarios"
						
									
							));
						
							exit();
						}
						
						
						
					}
			
					
					/*$columnas = "permisos_rol.id_permisos_rol, rol.nombre_rol, permisos_rol.nombre_permisos_rol, controladores.nombre_controladores, permisos_rol.ver_permisos_rol, permisos_rol.editar_permisos_rol, permisos_rol.borrar_permisos_rol  ";
					$tablas   = "public.controladores,  public.permisos_rol, public.rol";
					$where    = " controladores.id_controladores = permisos_rol.id_controladores AND permisos_rol.id_rol = rol.id_rol";
					$id       = " permisos_rol.nombre_permisos_rol, controladores.nombre_controladores";
						
					$permisos_rol = new PermisosRolesModel();
					$resultSet=$permisos_rol->getCondiciones($columnas ,$tablas ,$where, $id);*/
					
					$columnas = "permisos_rol.id_permisos_rol, rol.nombre_rol, permisos_rol.nombre_permisos_rol, controladores.nombre_controladores, permisos_rol.ver_permisos_rol, permisos_rol.editar_permisos_rol, permisos_rol.borrar_permisos_rol  ";
					$tablas   = "public.controladores,  public.permisos_rol, public.rol";
					$where    = " controladores.id_controladores = permisos_rol.id_controladores AND permisos_rol.id_rol = rol.id_rol";
					$id       = " permisos_rol.nombre_permisos_rol, controladores.nombre_controladores";
					
					
					$asignacionSecretarios = new AsignacionSecretariosModel();
					$resultSet=$asignacionSecretarios->getAll("id_asignacion_secretarios");
					//$resultSet=$asignacionSecretarios->getCondiciones($columnas, $tablas, $where, $id);
					
					//cambio linea 86
					//"resultCon"=>$resultCon, "resultAcc"=>$resultAcc, "resultSet"=>$resultSet,  "resultEdit"=>$resultEdit, "resultRol"=>$resultRol
					
					$this->view("AsignacionSecretarios",array(
							
							"resultCon"=>$resultCon,"resultSet"=>$resultSet,  "resultEdit"=>$resultEdit, "resultRol"=>$resultRol,"resultUsuarioSecretario"=>$resultUsuarioSecretario,"resultUsuarioImpulsor"=>$resultUsuarioImpulsor
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
			
			 
			$funcion = "ins_asignacion_secretarios";
			
			$parametros = "'$_id_secretario' ,'$_id_impulsor'";

			try {
				
				$asignacionSecretarios->setFuncion($funcion);
				$asignacionSecretarios->setParametros($parametros);
				$resultado=$asignacionSecretarios->Insert();
				

			$this->redirect("AsignacionSecretarios", "index");
			
			}
			catch (Exeption $Ex)
			{
				$this->view("Error",array(
						"resultado"=>$Ex
				));
				
				
			}
			
	
		}
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