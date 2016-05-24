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
						$encabezado_linea = fgets($file) ;
						
						if ($contador > 1) ///inserto
						{
							$funcion = "ins_operaciones";
						/*	
							//
							$_id_clientes integer, 
							
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