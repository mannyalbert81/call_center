<?php

class RecaudacionController extends ControladorBase{

	
	public function __construct() {
		parent::__construct();
	}

	

	public function index(){
	

		
		//Creamos el objeto usuario
     	$recaudacion_cabeza = new RecaudacionCabezaModel(); 
     	$recaudacion_institucion = new RecaudacionInstitucionModel();

     	
     	
     	
		$columnas = "recaudacion_cabeza.id_recaudacion_cabeza, recaudacion_cabeza.id_recaudacion_institucion, recaudacion_institucion.nombre_recaudacion_institucion, recaudacion_cabeza.fecha_creacion_recaudacion_cabeza, recaudacion_cabeza.hora_creacion_recaudacion_cabeza,  recaudacion_cabeza.cantidad_registros_recaudacion_cabeza, recaudacion_cabeza.valor_total_dolares_recaudacion_cabeza,  recaudacion_cabeza.creado";
		$tablas   = "public.recaudacion_institucion, public.recaudacion_cabeza";
		$where    = "recaudacion_cabeza.id_recaudacion_institucion = recaudacion_institucion.id_recaudacion_institucion";
		$id = "fecha_creacion_recaudacion_cabeza , hora_creacion_recaudacion_cabeza";
	    $id_dos = "nombre_recaudacion_institucion";
     	
	    $resultSet=$recaudacion_cabeza->getCondiciones($columnas, $tablas, $where, $id);
		$resultInsRec = $recaudacion_institucion->getAll($id_dos);
		
		
		
		$resultEdit = "";	
		
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			
			$recaudacion_cabeza = new RecaudacionCabezaModel();
			//Notificaciones
			$marca_vehiculos->MostrarNotificaciones($_SESSION['id_usuarios']);

			$nombre_controladores = "Recaudacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $recaudacion_cabeza->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			$mensaje = "";
			$fecha_proceso_anterior = "";
			if (!empty($resultPer))
			{
				if (isset ($_POST["procesar"]) )
				{
					$recaudacion_cabeza = new RecaudacionCabezaModel();
					$recaudacion_detalle = new RecaudacionDetalleModel();
					$_id_recaudacion_institucion = $_POST["recaudacion_institucion"];
					$_id_recaudacion_cabeza = 0;
					$directorio = $_SERVER['DOCUMENT_ROOT'].'/recaudacion/';
						
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
							//acumulo una en la variable número de líneas
							$contador_linea ++;
							
						}    
						
					}
					fclose ($file);
					
					$file = fopen($directorio.$nombre, "r") or exit("Unable to open file!");
					
					while(!feof($file))
					{
						$contador = $contador + 1;
						$lectura_linea =  fgets($file) ;
						$encabezado_linea = fgets($file) ;
						
						if ($contador == 1) ///INSERTO EL ENCABEZADO
						{
							$funcion = "ins_recaudacion_cabeza";
		
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
							
							/////primero busco si esta prov=cesado
							$columnas  = "id_recaudacion_cabeza, creado";
							$tablas    = "recaudacion_cabeza";
							$where     = " fecha_creacion_recaudacion_cabeza = '$_fecha_creacion_recaudacion_cabeza' AND hora_creacion_recaudacion_cabeza = '$_hora_creacion_recaudacion_cabeza' AND cantidad_registros_recaudacion_cabeza =  '$_cantidad_registros_recaudacion_cabeza' AND valor_total_sucres_recaudacion_cabeza = '$_valor_total_sucres_recaudacion_cabeza' ";
							$id   = "id_recaudacion_cabeza";
							
							$resulCabeza = $recaudacion_cabeza->getCondiciones($columnas, $tablas, $where, $id);
								
							foreach($resulCabeza as $res)
							{
								$_id_recaudacion_cabeza = $res->id_recaudacion_cabeza;
								$fecha_proceso_anterior = 	$res->creado;
							}
							if (  $_id_recaudacion_cabeza > 0) ///ya fue procesado
							{
								$mensaje = "Este Archivo ya fue Procesado el ->" . $fecha_proceso_anterior;	
							}
							else
							{
								try {
										
									$resultado=$recaudacion_cabeza->Insert();
										
										
								} catch (Exception $e) {
										
									$this->view("Error",array(
											"resultado"=>$e
									));
										
										
								}	
							}
							
													
							///obtengo el id del insertado
							$columnas  = "id_recaudacion_cabeza";
							$tablas    = "recaudacion_cabeza"; 
							$where     = " fecha_creacion_recaudacion_cabeza = '$_fecha_creacion_recaudacion_cabeza' AND hora_creacion_recaudacion_cabeza = '$_hora_creacion_recaudacion_cabeza' AND cantidad_registros_recaudacion_cabeza =  '$_cantidad_registros_recaudacion_cabeza' AND valor_total_sucres_recaudacion_cabeza = '$_valor_total_sucres_recaudacion_cabeza' ";
							$id   = "id_recaudacion_cabeza"; 
						
							$resulCabeza = $recaudacion_cabeza->getCondiciones($columnas, $tablas, $where, $id);
							
							foreach($resulCabeza as $res) 
							{
								$_id_recaudacion_cabeza = $res->id_recaudacion_cabeza;
							
							}
							
												
						} 
						
						if ($contador == $contador_linea)
						{
							
							
						}
						elseif ($contador > 1)
						{
						
						
							//ins_recaudacion_detalle()
							$funcion = "ins_recaudacion_detalle";
						
						
							try {
						
								$_orden_empresa_recaudacion_detalle     = intval(substr($lectura_linea,0,6));
								$_numero_movimiento_recaudacion_detalle = intval(substr($lectura_linea,6,6));
								$_numero_orden_procesada_recaudacion_detalle = intval(substr($lectura_linea,12,6));
								$_forma_movimiento_recaudacion_detalle       = substr($lectura_linea,18,2);
								$_fecha_movimiento_recaudacion_detalle       = substr($lectura_linea,20,4) .".".substr($lectura_linea,24,2).".".substr($lectura_linea,26,2);
								$_moneda_operacion_recaudacion_detalle       = substr($lectura_linea,28,3);
								$_valor_movimiento_recaudacion_detalle       = floatval(substr($lectura_linea,31,13). "." . substr($lectura_linea,44,2));
								$_localidad_movimiento_recaudacion_detalle   = substr($lectura_linea,46,2);
								$_agencia_movimiento_recaudacion_detalle     = substr($lectura_linea,48,2);
								$_codigo_estado_pago_recaudacion_detalle     = substr($lectura_linea,50,1);
								$_codigo_pais_recaudacion_detalle            = substr($lectura_linea,51,3);
								$_codigo_banco_recaudacion_detalle           = substr($lectura_linea,54,2);
								$_tipo_cuenta_recaudacion_detalle            = substr($lectura_linea,56,2);
								$_numero_cuenta_recaudacion_detalle          = substr($lectura_linea,58,20);
								$_codigo_tercero_recaudacion_detalle         = substr($lectura_linea,78,20);
								$_descripcion_estado_movimiento_recaudacion_detalle  = substr($lectura_linea,98,150);
								$_secuencia_error_recaudacion_detalle           = substr($lectura_linea,248,3);
								$_referencia_estado_cuenta_recaudacion_detalle  = substr($lectura_linea,251,40);
								$_codigo_servicio_bancario_recaudacion_detalle  = substr($lectura_linea,291,3);
								$_orden_banco_recaudacion_detalle               = substr($lectura_linea,294,7);
								$_nuc_tercero_recaudacion_detalle               = substr($lectura_linea,301,14);
								$_nombre_tercero_recaudacion_detalle            = substr($lectura_linea,315,40);
								$_rubro_uno_recaudacion_detalle                 = floatval(substr($lectura_linea,355,13). "." . substr($lectura_linea,360,2));
								$_rubro_dos_recaudacion_detalle                 = floatval(substr($lectura_linea,368,13). "." . substr($lectura_linea,375,2));
						
						
							} catch (Exception $e) {
						
								$this->view("Error",array(
										"resultado"=>"Error al obtener detalle de archivo".$e
								));
								exit();
									
							}
						
							$parametros = " '$_id_recaudacion_cabeza' , '$_orden_empresa_recaudacion_detalle', '$_numero_movimiento_recaudacion_detalle' , '$_numero_orden_procesada_recaudacion_detalle' , '$_forma_movimiento_recaudacion_detalle' , '$_fecha_movimiento_recaudacion_detalle' , '$_moneda_operacion_recaudacion_detalle' , '$_valor_movimiento_recaudacion_detalle' ,'$_localidad_movimiento_recaudacion_detalle' , '$_agencia_movimiento_recaudacion_detalle' , '$_codigo_estado_pago_recaudacion_detalle' , '$_codigo_pais_recaudacion_detalle' , '$_codigo_banco_recaudacion_detalle' , '$_tipo_cuenta_recaudacion_detalle' , '$_numero_cuenta_recaudacion_detalle' , '$_codigo_tercero_recaudacion_detalle' , '$_descripcion_estado_movimiento_recaudacion_detalle'  , '$_secuencia_error_recaudacion_detalle' , '$_referencia_estado_cuenta_recaudacion_detalle', '$_codigo_servicio_bancario_recaudacion_detalle' , '$_orden_banco_recaudacion_detalle' , '$_nuc_tercero_recaudacion_detalle' , '$_nombre_tercero_recaudacion_detalle' , '$_rubro_uno_recaudacion_detalle' , '$_rubro_dos_recaudacion_detalle' ";
							$recaudacion_detalle->setFuncion($funcion);
							$recaudacion_detalle->setParametros($parametros);
						
						
						
							try {
								$resultado=$recaudacion_detalle->Insert();
								
								
							} catch (Exception $e) {
									
								$this->view("Error",array(
										"resultado"=>"Error al Insertar Detalle->".$e->getMessage()
										
								));
									
									
							}
						
						}
						
					}
					
					fclose ($file);
					
					
				}
				
				if(isset($_POST["Buscar"])){
					
					$desde=$_POST["fecha_desde"];
					$hasta=$_POST["fecha_hasta"];
					
					$where="";
						
					$columnas = "recaudacion_cabeza.id_recaudacion_cabeza, 
						recaudacion_cabeza.id_recaudacion_institucion, 
						recaudacion_institucion.nombre_recaudacion_institucion, 
						recaudacion_cabeza.fecha_creacion_recaudacion_cabeza, 
						recaudacion_cabeza.hora_creacion_recaudacion_cabeza,  
						recaudacion_cabeza.cantidad_registros_recaudacion_cabeza, 
						recaudacion_cabeza.valor_total_dolares_recaudacion_cabeza,  
						recaudacion_cabeza.creado";
					$tablas="public.recaudacion_institucion, public.recaudacion_cabeza";
					
					$id="fecha_creacion_recaudacion_cabeza , hora_creacion_recaudacion_cabeza";
						
					if($desde==null && $hasta==null){
						$where="recaudacion_cabeza.id_recaudacion_institucion = recaudacion_institucion.id_recaudacion_institucion";
					}else{
						$where="recaudacion_cabeza.id_recaudacion_institucion = recaudacion_institucion.id_recaudacion_institucion
						AND
						recaudacion_cabeza.fecha_creacion_recaudacion_cabeza BETWEEN '$desde' AND '$hasta' ";
					}
					
					$asd=$desde."  ".$hasta;
					/*
					$this->view("Error",array(
							"resultado"=>$where
					));
					exit();*/
					
						
					$resultSet=$recaudacion_cabeza->getCondiciones($columnas ,$tablas , $where, $id);
					
				}
					
					
				$this->view("Recaudacion",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultInsRec" =>$resultInsRec, "mensaje"=>$mensaje
							
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