<?php

class ConvenioPagoSolicitudController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function index(){
		
		session_start();
	
		//Creamos el objeto usuario
     
     	$clientes = new ClientesModel();
     	
     	
	   //Conseguimos todos los usuarios
		   $columnas = "juicios.juicio_referido_titulo_credito,
					  clientes.identificacion_clientes,
					  clientes.nombres_clientes,
					  titulo_credito.id_titulo_credito,
		   				titulo_credito.total,
		   		      titulo_credito.fecha_corte";
		   
		   $tablas   = "public.clientes,
					  public.juicios,
					  public.titulo_credito";
		   
		   $where    = " clientes.id_clientes = titulo_credito.id_clientes AND
		   juicios.id_clientes = clientes.id_clientes AND
		   juicios.id_titulo_credito = titulo_credito.id_titulo_credito ";
		   
		   $id = "juicios.juicio_referido_titulo_credito";
		   
		   //creamos array con la consulta de registros
		   $resultSet=$clientes->getCondiciones($columnas, $tablas, $where, $id);
	
		   $vehiculos_embargados= new VehiculosEmbargadosModel();
		
		$resultEdit = "";
		
		$id_clientes = "";
		$id_titulo_credito = "";
		
	
		
		if(isset($_GET["id_clientes"]) && isset($_GET["id_titulo_credito"]))
		{
		   $id_clientes = $_GET["id_clientes"];
		   $id_titulo_credito = $_GET["id_titulo_credito"];
		   
		   $where    = " clientes.id_clientes = titulo_credito.id_clientes AND
		   juicios.id_clientes = clientes.id_clientes AND
		   juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND titulo_credito.id_titulo_credito='$id_titulo_credito'";
		   
		   //creamos array con la consulta de registros
		   $resultSet=$clientes->getCondiciones($columnas, $tablas, $where, $id);
		   	
		}
		else
		{
			
		
		}
	    
	   
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ConvenioPagoSolicitud";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $vehiculos_embargados->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			
			
			if (!empty($resultPer))
			{
				
				$resultAmortizacion=array();
				$resultDatos=array();
				
				if (isset($_POST['generar_cuotas'])   )
				{

					
					$interes=0;
					$total=$_POST['total'];
					$porcentaje_capital=$_POST['por_capital'];
					$total_capital=$total-($total*($porcentaje_capital/100));
					$fecha_corte=$_POST['fecha_corte'];
					
					array_push($resultDatos,array('total'=> $total,'porcentaje_capital'=>$porcentaje_capital,'total_capital'=>$total_capital));
					
					//pruebas tabla amortizacion
					
					$saldo_capital=$total-($total*($porcentaje_capital/100));
					$tasa_interes=8.86;
					$numero_cuotas=$_POST['numero_cuotas'];
					
					$saldo_honorarios=0;
					
					array_push($resultAmortizacion,array('saldo_capital'=> $saldo_capital,'tasa_interes'=>$tasa_interes,'numero_cuotas'=>$numero_cuotas,'saldo_honorarios'=>$saldo_honorarios,'fecha_corte'=>$fecha_corte));
					
					
				}
		
				
				$this->view("ConvenioPagoSolicitud",array(
						"resultSet"=>$resultSet,"id_clientes"=>$id_clientes,'resultDatos'=>$resultDatos,'resultAmortizacion'=>$resultAmortizacion
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Convenio Pago Solicitud"
				
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
	
	public function InsertaConvenioPagoSolicitud(){
			
		session_start();

		
		$vehiculos_embargados=new VehiculosEmbargadosModel();
		$nombre_controladores = "VehiculosEmbargados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $vehiculos_embargados->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$vehiculos_embargados=new VehiculosEmbargadosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["Guardar"]) )
				
			{
				$_id_tipo_vehiculos = $_POST["id_tipo_vehiculos"];
				$_id_marca_vehiculos = $_POST["id_marca_vehiculos"];
				$_placa_vehiculos_embargados  = $_POST["placa_vehiculos_embargados"];
				$_modelo_vehiculos_embargados = $_POST["modelo_vehiculos_embargados"];
				$_observaciones_vehiculos_embargados= $_POST["observacion_vehiculos_embargados"];
				$_fecha_ingreso_vehiculos_embargados= $_POST["fecha_ingreso_vehiculos_embargados"];
				$_id_clientes= $_POST["id_clientes"];
				
				if(isset($_POST["id_vehiculos_embargados"])) 
				{
					
					$_id_vehiculos_embargados = $_POST["id_vehiculos_embargados"];
					$colval = " observaciones_vehiculos_embargados= '$_observaciones_vehiculos_embargados'";
					$tabla = "vehiculos_embargados";
					$where = "id_vehiculos_embargados= '$_id_vehiculos_embargados'    ";
					
					$resultado=$vehiculos_embargados->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_vehiculos_embargados";
				//ins_vehiculos_embargados(_placa_vehiculos_embargados character varying, _modelo_vehiculos_embargados character varying, _observacion_vehiculos_embargados character varying, _fecha_ingreso_vehiculos_embargados date, _id_clientes integer, _id_tipo_vehiculos integer, _id_marca_vehiculos integer)
				
				$parametros = " '$_placa_vehiculos_embargados','$_modelo_vehiculos_embargados','$_observaciones_vehiculos_embargados','$_fecha_ingreso_vehiculos_embargados ','$_id_clientes','$_id_tipo_vehiculos ','$_id_marca_vehiculos' ";
				
				//$this->view("Error",array(
							
					//"resultado"=>$parametros
				
				//));
				//exit();
				
				$vehiculos_embargados->setFuncion($funcion);
		
				$vehiculos_embargados->setParametros($parametros);
		
		
				$resultado=$vehiculos_embargados->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "VehiculosEmbargados";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_observaciones_vehiculos_embargados;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("ConvenioPagoSolicitud", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Convenio Pago Solicitud"
		
			));
		
		
		}
	

		$vehiculos_embargados=new VehiculosEmbargadosModel();

		$nombre_controladores = "VehiculosEmbargados";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$vehiculos_embargados=new VehiculosEmbargadosModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["observaciones_vehiculos_embargados"]) )
				
			{
				$_observaciones_vehiculos_embargados= $_POST["observaciones_vehiculos_embargados"];
				
				if(isset($_POST["id_vehiculos_embargados"]))
				{
				$_id_vehiculos_embargados= $_POST["id_vehiculos_embargados"];
				$colval = " observaciones_vehiculos_embargados= '$_observaciones_vehiculos_embargados'   ";
				$tabla = "vehiculos_embargados";
				$where = "id_vehiculos_embargados= '$_id_vehiculos_embargados'    ";
					
				$resultado=$vehiculos_embargados->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_vehiculos_embargados";
				
				$parametros = " '$_observaciones_vehiculos_embargados'  ";
					
				$vehiculos_embargados->setFuncion($funcion);
		
				$vehiculos_embargados->setParametros($parametros);
		
		
				$resultado=$vehiculos_embargados->Insert();
			 }
		
			}
			$this->redirect("ConvenioPagoSolicitud", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Convenio Pago Solicitud"
		
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
			if(isset($_GET["id_vehiculos_embargados"]))
			{
				$id_vehiculos_embargados=(int)$_GET["id_vehiculos_embargados"];
				
				$tipo_vehiculos_embargados=new VehiculosEmbargadosModel();
				
				$tipo_vehiculos_embargados->deleteBy(" id_vehiculos_embargados",$id_vehiculos_embargados);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Vehiculos Embargados";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_vehiculos_embargados;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("ConvenioPagoSolicitud", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Convenio Pago Solicitud"
			
			));
		}
				
	}
	
	
	
	
	
}
?>