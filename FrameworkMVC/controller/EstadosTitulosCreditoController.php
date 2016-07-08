<?php
class EstadosTitulosCreditoController extends ControladorBase{
	public function __construct() {
		parent::__construct();
	}
	public function index(){
	
		//Creamos el objeto usuario
     	$estados_titulos_credito= new EstadosTitulosCreditoModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$estados_titulos_credito->getAll("id_estados_titulos_credito");
				
		$resultEdit = "";
		
		session_start();
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			//Notificaciones
			$estados_titulos_credito->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "EstadosTitulosCredito";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $estados_titulos_credito->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_estados_titulos_credito"])   )
				{
					$nombre_controladores = "EstadosTitulosCredito";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $estados_titulos_credito->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_estados_titulos_credito = $_GET["id_estados_titulos_credito"];
						$columnas = " id_estados_titulos_credito, nombre_estados_titulos_credito";
						$tablas   = "estados_titulos_credito";
						$where    = "id_estados_titulos_credito = '$_id_estados_titulos_credito' "; 
						$id       = "nombre_estados_titulos_credito";
							
				   $resultEdit = $estados_titulos_credito->getCondiciones($columnas ,$tablas ,$where, $id);
				   
				   $traza=new TrazasModel();
				   $_nombre_controlador = "Estados Titulos Credito";
				   $_accion_trazas  = "Editar";
				   $_parametros_trazas = $_id_estados_titulos_credito;
				   $resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				   
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Estados Titulos de Credito"
					
						));
					
					
					}
					
				}
		
				
				$this->view("EstadosTitulosCredito",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
			
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Estados Titulos de Credito"
				
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
	
	public function InsertaEstadosTitulosCredito(){
			
		session_start();
		
		$estados_titulos_credito=new EstadosTitulosCreditoModel();
		$nombre_controladores = "EstadosTitulosCredito";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $estados_titulos_credito->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$estados_titulos_credito=new EstadosTitulosCreditoModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_estados_titulos_credito"]) )
				
			{
				
				
				
				$_nombre_estados_titulos_credito = $_POST["nombre_estados_titulos_credito"];
				
				if(isset($_POST["id_estados_titulos_credito"])) 
				{
					
					$_id_estados_titulos_credito = $_POST["id_estados_titulos_credito"];
					$colval = " nombre_estados_titulos_credito = '$_nombre_estados_titulos_credito'   ";
					$tabla = "estados_titulos_credito";
					$where = "id_estados_titulos_credito = '$_id_estados_titulos_credito'    ";
					
					$resultado=$estados_titulos_credito->UpdateBy($colval, $tabla, $where);
					
				}else {
					
				$funcion = "ins_estados_titulos_credito";
				
				$parametros = " '$_nombre_estados_titulos_credito'  ";
					
				$estados_titulos_credito->setFuncion($funcion);
		
				$estados_titulos_credito->setParametros($parametros);
		
		
				$resultado=$estados_titulos_credito->Insert();
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Estados Titulos Credito";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_estados_titulos_credito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			 }
		
			}
			$this->redirect("EstadosTitulosCredito", "index");
		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de Estados de Titulos de Credito"
		
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
			if(isset($_GET["id_estados_titulos_credito"]))
			{
				$id_estados_titulos_credito=(int)$_GET["id_estados_titulos_credito"];
				
				$estados_titulos_credito=new EstadosTitulosCreditoModel();
				
				$estados_titulos_credito->deleteBy(" id_estados_titulos_credito",$id_estados_titulos_credito);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "EstadosTitulosCredito";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_estados_titulos_credito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("EstadosTitulosCredito", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Estados de Titulos de Credito"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$estados_titulos_credito=new EstadosTitulosCreditoModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("EstadosTitulosCredito",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>