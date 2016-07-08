 <?php

class OperacionesController extends ControladorBase{

	
	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		$errores = new ErroresImportacionModel(); 
		$operaciones = new OperacionesModel();
		$clientes = new ClientesModel();
		$ciudad = new CiudadModel();
		
		$resultEdit = "";	
		$resultSet = "";
		session_start();

		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$operaciones = new OperacionesModel();
			//Notificaciones
			$operaciones->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
            $nombre_controladores = "Operaciones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $operaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			$mensaje = "";
			$fecha_proceso_anterior = "";
			if (!empty($resultPer))
			{
				if (isset ($_POST["procesar"]) )
				{
					
			//variables para insertar titulos credito
					$id_entidades_titulo=0;
					$id_clientes_titulo=0;
					$id_ciudad_titulo=0;
					$id_tipo_identificacion_titulo=0;
					$id_usuario_titulo=0;
					$numero_sorteo_titulo=0;
					$fecha_corte_titulo="";
					$fecha_emision_titulo="";
					$id_estado_titulo=0;
					$id_lotes_titulo=0;
					$total_valor_emision_titulo=8.00;
					$total_estado_costo_emision_titulo="G";
					$total_mora_coactiva_titulo=0;
					$total_saldo_capital_titulo=0;
					$total_aprobacion_contador_titulo=0;
					$total_aprobacion_liquidador_titulo=0;
					$id_operacion_contable_titulo=0;
					$id_operacion_contable_honorario_titulo=0;
					$taza_interes_titulo=0;
					
					$entidades=new EntidadesModel();
					$resultEntidades=$entidades->getBy("nombre_entidades LIKE '%FOMENTO'");
					
					$tipo_identificacion= new TipoIdentificacionModel();
					
					$estadoTitulo=new EstadosTitulosCreditoModel();
					$resultEstadosTitulo=$estadoTitulo->getBy("nombre_estados_titulos_credito='GENERADO'");
					
					$lotes_titulo= new LotesTituloCreditoModel();
					$resultLotes= $lotes_titulo->getBy("nombre_lotes_titulos_credito='UNO'");
			//termina asignacion variables titulos creditos
					
					
					//$_id_recaudacion_institucion = $_POST["recaudacion_institucion"];
					
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
								$_descripcion_operaciones      			= substr($lectura_linea,34,100);
								$_fecha_inicio_operaciones     			= substr($lectura_linea,134,4) .".". substr($lectura_linea,138,2) .".". substr($lectura_linea,140,2);
								$_fecha_finalizacion_operaciones 		= substr($lectura_linea,142,4) .".". substr($lectura_linea,146,2) .".". substr($lectura_linea,148,2); 
								$_fecha_vencimiento_operaciones  		= substr($lectura_linea,150,4) .".". substr($lectura_linea,154,2) .".". substr($lectura_linea,156,2); 
								$_fecha_liquidacion_operaciones  		= substr($lectura_linea,158,4) .".". substr($lectura_linea,162,2) .".". substr($lectura_linea,164,2);
								$_valor_capital_operaciones      		= floatval(substr($lectura_linea,166,13). "." . substr($lectura_linea,179,2));
								$_valor_interes_ordinario_operaciones  	= floatval(substr($lectura_linea,181,13). "." . substr($lectura_linea,194,2));
								$_valor_interes_mora_operaciones       	= floatval(substr($lectura_linea,196,13). "." . substr($lectura_linea,209,2));
								$_valor_comision_operaciones           	= floatval(substr($lectura_linea,211,13). "." . substr($lectura_linea,224,2));
								$_valor_total_operaciones              	= floatval(substr($lectura_linea,226,13). "." . substr($lectura_linea,239,2));;
								//$_id_ciudad                             = substr($lectura_linea,235,5);
								$_codigo_ciudad                        	= substr($lectura_linea,241,5);
								
								$_id_ciudad    = 0;
							
								$whereCiu = "codigo_ciudad = '$_codigo_ciudad' ";
								$resultCiu = $ciudad->getBy($whereCiu);
								
								
								
								if (!empty($resultCiu))   //encontro el cliente  -.. $_id_ciudad > 0
								{
									
								
								foreach($resultCiu as $res)
								{
										
									$_id_ciudad =   $res->id_ciudad;
								}
											//_id_clientes integer, _numero_operaciones character varying, _descripcion_operaciones character varying, _fecha_inicio_operaciones date, _fecha_finalizacion_operaciones date, _fecha_vencimiento_operaciones date, _fecha_liquidacion_operaciones date, _valor_capital_operaciones numeric, _valor_interes_ordinario_operaciones numeric, _valor_interes_mora_operaciones numeric, _valor_comision_operaciones numeric, _valor_total_operaciones numeric, _id_ciudad integer
								$parametros = " '$_id_clientes', '$_numero_operaciones' , '$_descripcion_operaciones' , '$_fecha_inicio_operaciones',  '$_fecha_finalizacion_operaciones', '$_fecha_vencimiento_operaciones', '$_fecha_liquidacion_operaciones' , '$_valor_capital_operaciones', '$_valor_interes_ordinario_operaciones', '$_valor_interes_mora_operaciones', '$_valor_comision_operaciones', '$_valor_total_operaciones', '$_id_ciudad' ";
								//$parametros = " '$_id_clientes' ,'$_identificacion_cliente' , '$_numero_operaciones' , '$_descripcion_operaciones' , '$_fecha_inicio_operaciones',  '$_fecha_finalizacion_operaciones', '$_fecha_vencimiento_operaciones', '$_fecha_liquidacion_operaciones' , '$_valor_capital_operaciones', '$_valor_interes_ordinario_operaciones', '$_valor_interes_mora_operaciones', '$_valor_comision_operaciones', '$_valor_total_operaciones', '$_id_ciudad' ";
								$operaciones->setFuncion($funcion);
								$operaciones->setParametros($parametros);
								
								$resultado=$operaciones->Insert();
								
							//comienza insertado de titulo
								
								$resultTipoIdentificacion=$tipo_identificacion->getBy("substr(nombre_tipo_identificacion,1,1) = '$_tipo_identificacion_cliente'");
								
								$id_clientes_titulo= $_id_clientes;
								$id_entidades_titulo=$resultEntidades[0]->id_entidades;
								$id_ciudad_titulo=$_id_ciudad;
								$id_tipo_identificacion_titulo=$resultTipoIdentificacion[0]->id_tipo_identificacion;
								$id_usuario_titulo=$_SESSION['id_usuarios'];
								$numero_sorteo_titulo=0;
								$fecha_corte_titulo=$_fecha_liquidacion_operaciones;
								$fecha_emision_titulo=date('Y-m-d');
								$id_estado_titulo=$resultEstadosTitulo[0]->id_estados_titulos_credito;
								$id_lotes_titulo=$resultLotes[0]->id_lotes_titulos_credito;
								$total_valor_emision_titulo=8.00;
								$total_estado_costo_emision_titulo="G";
								$total_mora_coactiva_titulo=$_valor_interes_mora_operaciones;
								$total_saldo_capital_titulo=$_valor_capital_operaciones;
								$total_aprobacion_contador_titulo=74;
								$total_aprobacion_liquidador_titulo=75;
								$id_operacion_contable_titulo=0;
								$id_operacion_contable_honorario_titulo=0;
								$taza_interes_titulo=0.812; //cambiar tassa_interes
								
								$titulo=new TituloCreditoModel();
								//parametros
								
								$parametros_titulo="'$id_clientes_titulo','$id_entidades_titulo','$id_ciudad_titulo','$id_tipo_identificacion_titulo','$id_usuario_titulo','$numero_sorteo_titulo','$fecha_corte_titulo','$fecha_emision_titulo','$id_estado_titulo','$id_lotes_titulo','$total_valor_emision_titulo','$total_estado_costo_emision_titulo','$total_mora_coactiva_titulo','$total_saldo_capital_titulo','$total_aprobacion_contador_titulo','$total_aprobacion_liquidador_titulo','$id_operacion_contable_titulo','$id_operacion_contable_honorario_titulo','$taza_interes_titulo'";
								$funcion_titulo="ins_titulo_credito";
								$titulo->setFuncion($funcion_titulo);
								$titulo->setParametros($parametros_titulo);
								
								$resultado=$titulo->Insert();
							//termina insertado de titulo
								
								
								}else {
									
									$errores_importacion = new ErroresImportacionModel();
									$_origen_errores_importacion   = 'IMPORTACION DE OPERACIONES' ;
									$_error_errores_importacion    = 'No fue Posible encontrar una ciudad' ;
									$_detalle_errores_importacion  = 'Ciudad-> '.$_id_ciudad . ' Identificacion->'.$_tipo_identificacion_cliente ;
									$resultado = $errores_importacion->InsertaErroresImportacion($_origen_errores_importacion, $_error_errores_importacion, $_detalle_errores_importacion);
									
									
								}
								
							
								
							}
								
							else /// no encontro el cliente notificar
							{
								$errores_importacion = new ErroresImportacionModel();
								$_origen_errores_importacion   = 'IMPORTACION DE OPERACIONES' ; 
								$_error_errores_importacion    = 'No fue Posible encontrar un cliente' ;
								$_detalle_errores_importacion  = 'Tipo Identificacion-> '.$_tipo_identificacion_cliente . ' Identificacion->'.$_identificacion_cliente ;
								$resultado = $errores_importacion->InsertaErroresImportacion($_origen_errores_importacion, $_error_errores_importacion, $_detalle_errores_importacion);
								
							}
							
							
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
						"resultado"=>"No tiene Permisos de Acceso a Operaciones"
				
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
	
	
		
	public function InsertaFirmasDigitales()
	{
		$this->redirect("FirmasDigitales", "index");
		
	}
	
	public function borrarId()
	{
				
	}
	
	
	
}
?>