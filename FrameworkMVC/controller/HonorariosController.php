<?php

class HonorariosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
		
		session_start();
			
		$resultEdit = "";
		
		$honorarios = new HonorariosModel();
		$columna="*";
		$tabla="public.honorarios,public.tipo_honorarios";
		$wheres="tipo_honorarios.id_tipo_honorarios = honorarios.id_tipo_honorarios";
		$id="honorarios.id_tipo_honorarios";
		
		$tipohonorarios=new TipoHonorariosModel();
		$rsTipoHonorario=$tipohonorarios->getAll("id_tipo_honorarios");
		
	
		$resultSet=$honorarios->getCondiciones($columna, $tabla, $wheres, $id);
		
		if (isset(  $_SESSION['usuario_usuarios']))
		{
			//Notificaciones
			$honorarios->MostrarNotificaciones($_SESSION['id_usuarios']);
            
			$nombre_controladores = "Honorarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $honorarios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
										
				$resultPEdit = $honorarios->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
				
				if (!empty($resultPEdit)  )
				{
					if (isset ($_GET["id_honorario"]) )
					{
					
						$_id_lotesTituloCredito = $_GET["id_ltcredito"];
						$columnas = " id_lotes_titulos_credito, nombre_lotes_titulos_credito";
						$tablas   = "lotes_titulos_credito";
						$where    = "id_lotes_titulos_credito = '$_id_lotesTituloCredito' "; 
						$id       = "id_lotes_titulos_credito";
							
						
						$resultEdit = $honorarios->getCondiciones($columnas ,$tablas ,$where, $id);
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Lotes Titulo Credito";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_lotesTituloCredito;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);;
						
					
					}
					
					
				}
				
				
				
				$this->view("Honorarios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"rsTipoHonorario"=>$rsTipoHonorario
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Honorarios"
				
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
	
	public function InsertaHonorarios(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();

		$honorarios=new HonorariosModel();


		$nombre_controladores = "Honorarios";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			
			
			if (isset ($_POST["Guardar"]) )
			{
				$_id_honorario = $_POST["id_honorario"];
				$id_tipoHonorario=$_POST["tipo_honorario"];
				$descripcion = $_POST["descripcion"];
				$desde=$_POST["desde_honorarios"];
				$hasta=$_POST["hasta_honorarios"];
				$x_base_baja["x_base_fija"];
				$x_exceso["x_exceso"];
				
				
				if(isset($_POST["id_honorario"])) 
				{
					
					$_id_honorario = $_POST["id_honorario"];
					
					$colval = " descripcion_honorarios = '$descripcion',id_tipo_honorarios = '$id_tipoHonorario', desde_honorarios = '$desde',hasta_honorarios = '$hasta',por_base_pocion_baja = '$x_base_baja',por_exceso_porcentaje = '$x_exceso'  ";
					$tabla = "honorarios";
					$where = "id_honorarios = '$_id_honorario' ";
					
					$resultado=$honorarios->UpdateBy($colval, $tabla, $where);
					
					$traza=new TrazasModel();
					$_nombre_controlador = "Honorarios";
					$_accion_trazas  = "Editar";
					$_parametros_trazas = $_nombre_ltCredito;
					$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					
					
				}else {
					
			
				//_id_tipo_honorarios integer, _descripcion_honorarios character varying, _desde_honorarios numeric, _hasta_honorarios numeric, _por_base_pocion_baja numeric, _por_exceso_porcentaje numeric
				
				$funcion = "ins_honorarios";
				
				$parametros = " '$id_tipoHonorario', '$descripcion', '$desde', '$hasta','$x_base_baja','$x_exceso' ";
					
				$ltCredito->setFuncion($funcion);
		
				$ltCredito->setParametros($parametros);
		
		
				$resultado=$honorarios->Insert();
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Honorarios";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_ltCredito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			 	}
		
			}
			
			$this->redirect("Honorarios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Honorarios"
		
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