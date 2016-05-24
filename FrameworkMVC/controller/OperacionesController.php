<?php

class OperacionesController extends ControladorBase{

	
	public function __construct() {
		parent::__construct();
	}



	public function index(){
	

		$operaciones = new OperacionesModel();
		$clientes = new ClientesModel();
		$ciudad = new CiudadModel();
		
		$resultEdit = "";	
		$resultSet = "";
		session_start();

		if (isset(  $_SESSION['usuario_usuarios']) )
		{
            $nombre_controladores = "Operaciones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $operaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			$mensaje = "";
			$fecha_proceso_anterior = "";
			if (!empty($resultPer))
			{
				if (isset ($_POST["procesar"]) )
				{
					$_id_recaudacion_institucion = $_POST["recaudacion_institucion"];
					
					$directorio = $_SERVER['DOCUMENT_ROOT'].'/cartera/';
						
					$nombre = $_FILES['archivo']['name'];
					$tipo = $_FILES['archivo']['type'];
					$tamano = $_FILES['archivo']['size'];
					// temporal al directorio definitivo
					move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
					$file = fopen($directorio.$nombre, "r") or exit("Unable to open file!");
		
					$contador = 0;
					$contador_linea = 0;
					
					$encabezado_linea = "";
					$contenido_linea = "";
					$pie_linea = "";
					
					$lectura_linea = "";
					
					while(!feof($file))
					{
						if ($linea = fgets($file)){
							$contador_linea ++;
						}    
				}
					fclose ($file);
					
					$file = fopen($directorio.$nombre, "r") or exit("Unable to open file!");
					
					while(!feof($file))
					{
						$contador = $contador + 1;
						$lectura_linea =  fgets($file) ;
						
							$funcion = "ins_operaciones";
							
							//
							///buscamos el cliente
							$_tipo_identificacion_cliente =  substr($lectura_linea,0,1);
							$_identificacion_cliente =  substr($lectura_linea,1,13);
							$_id_clientes = 0;
							
							$columnas = "clientes.id_clientes";
						    $tablas   = "public.clientes, public.tipo_identificacion";
						    $where    = "tipo_identificacion.id_tipo_identificacion = clientes.id_tipo_identificacion 
  										 AND substr(tipo_identificacion.nombre_tipo_identificacion,1,1) = '$_tipo_identificacion_cliente' 
  										 AND clientes.identificacion_clientes = '$_identificacion_cliente'";
						    $id		 = "clientes.id_clientes";	
							
							$resultCli = $operaciones->getCondiciones($columnas, $tablas, $where, $id);
							foreach($resultCli as $res)
							{
								$_id_clientes  = $res->id_clientes;
									
							}
							if ($_id_clientes > 0)   //encontro el cliente
							{
								
								$_numero_operaciones           			= substr($lectura_linea,14,20);
								$_descripcion_operaciones      			= substr($lectura_linea,24,124);
								$_fecha_inicio_operaciones     			= substr($lectura_linea,128,4) .".". substr($lectura_linea,132,2) .".". substr($lectura_linea,134,2);
								$_fecha_finalizacion_operaciones 		= substr($lectura_linea,136,4) .".". substr($lectura_linea,140,2) .".". substr($lectura_linea,142,2); 
								$_fecha_vencimiento_operaciones  		= substr($lectura_linea,144,4) .".". substr($lectura_linea,148,2) .".". substr($lectura_linea,150,2); 
								$_fecha_liquidacion_operaciones  		= substr($lectura_linea,152,4) .".". substr($lectura_linea,156,2) .".". substr($lectura_linea,158,2);
								$_valor_capital_operaciones      		= floatval(substr($lectura_linea,160,13). "." . substr($lectura_linea,173,2));
								$_valor_interes_ordinario_operaciones  	= floatval(substr($lectura_linea,175,13). "." . substr($lectura_linea,188,2));
								$_valor_interes_mora_operaciones       	= floatval(substr($lectura_linea,190,13). "." . substr($lectura_linea,203,2));
								$_valor_comision_operaciones           	= floatval(substr($lectura_linea,205,13). "." . substr($lectura_linea,218,2));
								$_valor_total_operaciones              	= floatval(substr($lectura_linea,220,13). "." . substr($lectura_linea,233,2));;
								
								$_codigo_ciudad                        	= substr($lectura_linea,235,5);
								$_id_ciudad    = 0;
								
								$resultCiu = $ciudad->getBy($whereCiu);
								
								foreach($resultCli as $res)
								{
									$_id_clientes  = $res->id_clientes;
										
								}
								
							}
								
							else /// no encontro el cliente notificar
							{
								$_origen_errores_importacion   = 'IMPORTACION DE OPERACIONES' ; 
								$_error_errores_importacion    = 'No fue Posible encontrar un cliente' ;
								$_detalle_errores_importacion  = 'Tipo Identificacion-> '.$_tipo_identificacion_cliente . ' Identificacion->'.$_tipo_identificacion_cliente ;
								$operaciones->InsertaErroresImportacion($_origen_errores_importacion, $_error_errores_importacion, $_detalle_errores_importacion);
								
							}
							
							//$_id_clientes integer, 
						
							/*
							$_numero_operaciones character varying, 
							$_descripcion_operaciones character varying, 
							$_fecha_inicio_operaciones date, 
							$_fecha_finalizacion_operaciones date, 
							$_fecha_vencimiento_operaciones date, 
							$_fecha_liquidacion_operaciones date, 
							$_valor_capital_operaciones numeric, 
							$_valor_interes_ordinario_operaciones numeric, 
							$_valor_interes_mora_operaciones numeric, 
							$_valor_comision_operaciones numeric, 
							$_valor_total_operaciones numeric, 
							$_id_ciudad integer)
							
							//$_id_recaudacion_institucion; 
							$_tipo_linea_recaudacion_cabeza = substr($lectura_linea,0,3);
							$_tipo_nuc_recaudacion_cabeza   = substr($lectura_linea,3,1);
							$_numero_nuc_recaudacion_cabeza = substr($lectura_linea,4,14);
							//$my_date = date('m/d/y', strtotime($date));
							$_fecha_creacion_recaudacion_cabeza = substr($lectura_linea,18,4) .".". substr($lectura_linea,22,2) .".". substr($lectura_linea,24,2);
							$_hora_creacion_recaudacion_cabeza =  substr($lectura_linea,26,2) . ":". substr($lectura_linea,28,2) . ":". substr($lectura_linea,30,2);
							$_cantidad_registros_recaudacion_cabeza =  intval(substr($lectura_linea,32,6));
							$_valor_total_sucres_recaudacion_cabeza =  floatval(substr($lectura_linea,38,13). "." . substr($lectura_linea,51,2));
							$_valor_total_dolares_recaudacion_cabeza =  floatval(substr($lectura_linea,53,13) . ":".substr($lectura_linea,66,2));
							
							
							$parametros = " '$_id_recaudacion_institucion' ,'$_tipo_linea_recaudacion_cabeza' , '$_tipo_nuc_recaudacion_cabeza' , '$_numero_nuc_recaudacion_cabeza' , '$_fecha_creacion_recaudacion_cabeza', '$_hora_creacion_recaudacion_cabeza', '$_cantidad_registros_recaudacion_cabeza' , '$_valor_total_sucres_recaudacion_cabeza' , '$_valor_total_dolares_recaudacion_cabeza' ";
							$recaudacion_cabeza->setFuncion($funcion);
							$recaudacion_cabeza->setParametros($parametros);
						
							*/
						
					}
								
					fclose ($file);
					
				}
					
				$this->view("Operaciones",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "mensaje"=>$mensaje			
				));
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Controladores"
				
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
	
	
	public function InsertaEncabezadoLinea($lectura_linea, $_id_recaudacion_institucion)
	{
		
	}
	
	
	
	
	
	
		
	public function InsertaFirmasDigitales(){
			
		
				$this->redirect("FirmasDigitales", "index");
		
		
	}
	
	public function borrarId()
	{
				
	}
	
	
	
}
?>