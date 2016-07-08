<?php

class EstAutoPagoJuiciosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		$estdAutoP = new EstAutoPagoJuiciosModel(); //creamos objeto lotestitulocredito
		$resultSet=$estdAutoP->getAll("id_estados_auto_pago_juicios"); //obtenemos todos registros de lotes titulo credito
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			//Notificaciones
			$estdAutoP->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "EstAutoPagoJuicios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $estdAutoP->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				//codigo pa auditoria
			
				//termina codigo pa auditoria	
					
				
				
				if (isset ($_GET["id_estPagoj"])   )
				{

					$resultPEdit = $estdAutoP->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
					
					if (!empty($resultPEdit))
					{
					
						$_id_estPagojuicio = $_GET["id_estPagoj"];
						$columnas = " id_estados_auto_pago_juicios, nombre_estados_auto_pago_juicios";
						$tablas   = "estados_auto_pago_juicios";
						$where    = "id_estados_auto_pago_juicios = '$_id_estPagojuicio' "; 
						$id       = "id_estados_auto_pago_juicios";
							
						
						$resultEdit = $estdAutoP->getCondiciones($columnas ,$tablas ,$where, $id);
						
						$traza=new TrazasModel();
						$_nombre_controladores = "Estados Auto de Pago";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_estPagojuicio;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas,$nombre_controladores);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Lotes Titulo Credito"
					
						));
					
					
					}
					
				}
		
				
				$this->view("EstAutoPagoJuicios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Estado Auto Pago Juicio"
				
				));
				
				exit();	
			}
				
		}
		else 
		{
				$this->view("ErrorSesion",array(
						"resultSet"=>"Debe Iniciar Session"
			
				));
		
		}
	
	}
	
	public function InsertaEstAutoPagoJuicio(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();

		$estdAutoP = new EstAutoPagoJuiciosModel(); 


		$nombre_controladores = "EstAutoPagoJuicios";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			
		
			
			
			if (isset ($_POST["nombre_estPagoj"]) )
				
			{
				
				
				
				$_nombre_estAutoPago = $_POST["nombre_estPagoj"];
				
				
				if(isset($_POST["id_estPagoj"])) 
				{
					
					$_id_estAutoPago = $_POST["id_estPagoj"];
					
					$colval = " nombre_estados_auto_pago_juicios = '$_nombre_estAutoPago'   ";
					$tabla = "estados_auto_pago_juicios";
					$where = "id_estados_auto_pago_juicios = '$_id_estAutoPago'    ";
					
					$resultado=$estdAutoP->UpdateBy($colval, $tabla, $where);
			
					
				}else {
					
			
				
				$funcion = "ins_estados_auto_pago_juicios";
				
				$parametros = " '$_nombre_estAutoPago'  ";
					
				$estdAutoP->setFuncion($funcion);
		
				$estdAutoP->setParametros($parametros);
		
		
				$resultado=$estdAutoP->Insert();
				$traza=new TrazasModel();
				$_nombre_controladores = "Estados Auto de Pago";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_estAutoPago;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas,$nombre_controladores);
					
				}
			 
		
			}
			$this->redirect("EstAutoPagoJuicios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Estado Auto Pago Juicio"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "EstAutoPagoJuicios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_estPagoj"]))
			{
				$id_estAutoPago=(int)$_GET["id_estPagoj"];
			
				$estdAutoP = new EstAutoPagoJuiciosModel(); 
				$estdAutoP->deleteBy("id_estados_auto_pago_juicios",$id_estAutoPago);
				
				$traza=new TrazasModel();
				$_nombre_controladores = "Estados Auto de Pago";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_estAutoPago;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas,$nombre_controladores);
					
				
			}
			
			$this->redirect("EstAutoPagoJuicios", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Estado Auto Pago Juicio"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$roles=new RolesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("Roles",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>