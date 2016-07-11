<?php

class LotesTituloCreditoController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		
		$ltCredito = new LotesTituloCreditoModel(); //creamos objeto lotestitulocredito
		$resultSet=$ltCredito->getAll("id_lotes_titulos_credito"); //obtenemos todos registros de lotes titulo credito
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
		
			$ltCredito = new LotesTituloCreditoModel();
			//Notificaciones
			$ltCredito->MostrarNotificaciones($_SESSION['id_usuarios']); 
			
				
			
			
			
		
			$nombre_controladores = "LotesTituloCredito";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $ltCredito->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
					
					
				
				
				if (isset ($_GET["id_ltcredito"])   )
				{

					$resultPEdit = $ltCredito->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
					
					if (!empty($resultPEdit))
					{
					
						$_id_lotesTituloCredito = $_GET["id_ltcredito"];
						$columnas = " id_lotes_titulos_credito, nombre_lotes_titulos_credito";
						$tablas   = "lotes_titulos_credito";
						$where    = "id_lotes_titulos_credito = '$_id_lotesTituloCredito' "; 
						$id       = "id_lotes_titulos_credito";
							
						
						$resultEdit = $ltCredito->getCondiciones($columnas ,$tablas ,$where, $id);
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Lotes Titulo Credito";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_lotesTituloCredito;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);;
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Lotes Titulo Credito"
					
						));
					
					
					}
					
				}
		
				
				$this->view("LotesTituloCredito",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Lotes Titulo Credito"
				
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
	
	public function InsertaLotestituloCredito(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();

		$ltCredito = new LotesTituloCreditoModel();


		$nombre_controladores = "LotesTituloCredito";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			
		
			
			
			if (isset ($_POST["nombre_ltcredito"]) )
				
			{
				
				
				
				$_nombre_ltCredito = $_POST["nombre_ltcredito"];
				
				
				if(isset($_POST["id_ltcredito"])) 
				{
					
					$_id_ltCredito = $_POST["id_ltcredito"];
					
					$colval = " nombre_lotes_titulos_credito = '$_nombre_ltCredito'   ";
					$tabla = "lotes_titulos_credito";
					$where = "id_lotes_titulos_credito = '$_id_ltCredito'    ";
					
					$resultado=$ltCredito->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			
				
				$funcion = "ins_lotes_titulo_credito";
				
				$parametros = " '$_nombre_ltCredito'  ";
					
				$ltCredito->setFuncion($funcion);
		
				$ltCredito->setParametros($parametros);
		
		
				$resultado=$ltCredito->Insert();
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Lotes Titulo Credito";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_ltCredito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			 }
		
			}
			$this->redirect("LotesTituloCredito", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Lotes Titulo Credito"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "LotesTituloCredito";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_ltcredito"]))
			{
				$id_ltCredito=(int)$_GET["id_ltcredito"];
			
				$ltCredito = new LotesTituloCreditoModel();
				$ltCredito->deleteBy("id_lotes_titulos_credito",$id_ltCredito);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Lotes Titulo Credito";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_ltCredito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("LotesTituloCredito", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Lotes Titulo Credito"
			
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