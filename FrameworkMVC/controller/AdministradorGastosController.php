<?php

class AdministradorGastosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


//maycol
	public function index(){
	
		//Creamos el objeto usuario
     	$administrador_gastos=new AdministradorGastosModel();
					//Conseguimos todos los usuarios
		$resultSet=$administrador_gastos->getAll("id_administrador_gastos");
				
		$resultEdit = "";
		$tipo_gastos = new TipoGastosModel();
		$resultTipoGastos=$tipo_gastos->getAll("nombre_tipo_gastos");
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			//NOTIFICACIONES
			$administrador_gastos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$nombre_controladores = "AdministradorGastos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $administrador_gastos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_administrador_gastos"])   )
				{

					$nombre_controladores = "AdministradorGastos";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $administrador_gastos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						
						
						
						$_id_administrador_gastos = $_GET["id_administrador_gastos"];
						
						
						
						$resultEdit = $administrador_gastos->getBy("id_administrador_gastos='$_id_administrador_gastos'");
						
						$traza=new TrazasModel();
						$_nombre_controlador = "AdministradorGastos";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_administrador_gastos;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Administrador Gastos"
					
						));
					
					
					}
					
				}
		
				
				$this->view("AdministradorGastos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"resultTipoGastos"=>$resultTipoGastos
						
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Administrador Gastos"
				
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
	
	public function InsertaAdministradorGastos(){
			
		session_start();
		$administrador_gastos=new AdministradorGastosModel();
		

		$nombre_controladores = "AdministradorGastos";
	
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $administrador_gastos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$administrador_gastos=new AdministradorGastosModel();
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["id_tipo_gastos"])   )
				
			{
				
		
				$_id_tipo_gastos = $_POST["id_tipo_gastos"];
				
				$_nombre_administrador_gastos = $_POST["nombre_administrador_gastos"];
				$_estado = $_POST["estado"];
				
				$funcion = "ins_administrador_gastos";
				$parametros = "'$_id_tipo_gastos', '$_nombre_administrador_gastos', '$_estado'";
					
				$administrador_gastos->setFuncion($funcion);
		
				$administrador_gastos->setParametros($parametros);
		
		
				$resultado=$administrador_gastos->Insert();
		
				$traza=new TrazasModel();
				$_nombre_controlador = "AdministradorGastos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_administrador_gastos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);

				//$this->view("Error",array(
				//"resultado"=>"entro"
				///));				
				
			}
			$this->redirect("AdministradorGastos", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Administrador Gastos"
		
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
			if(isset($_GET["id_administrador_gastos"]))
			{
				$id_administrador_gastos=(int)$_GET["id_administrador_gastos"];
		
				$administrador_gastos=new AdministradorGastosModel();
				
				$administrador_gastos->deleteBy(" id_administrador_gastos",$id_administrador_gastos);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "AdministradorGastos";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_administrador_gastos;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("AdministradorGastos", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Administrador Gastos"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$administrador_gastos=new AdministradorGastosModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_administrador_gastos, nombre_administrador_gastos", " nombre_administrador_gastos != '' ");
			$this->report("AdministradorGastos",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>
