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
			//NOTIFICACIONES
			$vehiculos_embargados->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ConvenioPagoSolicitud";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $vehiculos_embargados->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			
			
			if (!empty($resultPer))
			{
				
				$resultAmortizacion=array();
				$resultDatos=array();
				$resultRubros=array();
				
				if (isset($_POST['generar_cuotas'])   )
				{

					
					$interes=0;
					$total=$_POST['total'];
					$porcentaje_capital=$_POST['por_capital'];
					$total_capital=$total-($total*($porcentaje_capital/100));
					$fecha_corte=$_POST['fecha_corte'];
					$fecha_emision=$_POST['fecha_emision'];
					
					
					array_push($resultDatos,array('total'=> $total,'porcentaje_capital'=>$porcentaje_capital,'total_capital'=>$total_capital));
					
					//pruebas tabla amortizacion
					
					$saldo_capital=$total-($total*($porcentaje_capital/100));
					$tasa_interes=8.86;
					$numero_cuotas=$_POST['numero_cuotas'];
					
					$saldo_honorarios=0;
					
					$resultAmortizacion=$this->tablaAmortizacion($saldo_capital, $numero_cuotas, $fecha_corte);
					
					$interes=0.812;
					
					$dias_mora=$this->diasMora($fecha_corte, $fecha_emision);
					
					$resultRubros=$this->tablaRubros($total, $interes, $dias_mora);
					
					
					
				}
		
				
				$this->view("ConvenioPagoSolicitud",array(
						"resultSet"=>$resultSet,"id_clientes"=>$id_clientes,'resultDatos'=>$resultDatos,'resultAmortizacion'=>$resultAmortizacion,'resultRubros'=>$resultRubros
			
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
			
			if (isset ($_POST['aceptar']))
				
			{
				
				
			
			 
		
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
	
	public function tablaAmortizacion($saldo_capital,$numero_cuotas,$fecha_corte)
	{
		//array donde guardar tabla amortizacion
		$resultAmortizacion=array();
		
		
		$tasa_interes=8.86;
	
		$saldo_honorarios=0;
		$otros=0;
		$total_Capital=0;
		$total_Honorarios=0;
		$total_Convenio=0;
		$total_Interes=0;	
		
		
		$plazo=$numero_cuotas;
		
		$honoraExon = $saldo_honorarios / ($plazo);
		
		$porcent = ($tasa_interes / 12)/100;
		 
		$capinteres = $saldo_capital * (($porcent * (pow((1 + $porcent), ((int)($plazo))))) / (pow((1 + $porcent), ((int)($plazo))) - 1));
		
		
		$inter = 1*$saldo_capital*$porcent;
		
		$abono = $capinteres-$inter;
		 
		$saldocap = $saldo_capital;
		
		$cuota = round($capinteres,2)+round($honoraExon,2)+round($otros,2);
		 
		 
		 
		
		for( $i = 1; $i <= $plazo; $i++) {
			 
			 
			$inter = 1*$saldocap*$porcent;
			$abono = $capinteres-$inter;
			$saldocap = $saldocap-$abono;
			 
			$total_Interes = $total_Interes + $inter;
			 
			$total_Capital = $total_Capital + $abono;
			 
			$total_Honorarios = $total_Honorarios + $honoraExon;
			 
			$total_Convenio = $total_Convenio + $cuota;
			 
			$fecha=strtotime('+1 month',strtotime($fecha_corte));
		
			$fecha=date('Y-m-d',$fecha);
			 
			$fecha_corte=$fecha;
			
			
			$resultAmortizacion['tabla'][]=array(
			            array('periodo'=> $i,
						'fecha_vencimiento'=>$fecha,
						'abono_capital'=>$abono,
						'interes'=>$inter,
						'capital_interes'=>$capinteres,
						'saldo_capital'=>$saldocap,
						'saldo_honorarios'=>$honoraExon,
						'otros'=>$otros,
						'cuota'=>$cuota
						)
						);			
		}
		
		$resultAmortizacion['totales']=array(
				 array('total_capital'=> $total_Capital,
						'total_interes'=>$total_Interes,
						'total_honorarios'=>$total_Honorarios,
						'total_otros'=>$otros,
						'total_convenio'=>$total_Convenio
						
						));
		
		return $resultAmortizacion;
		
		
	}
	
	
	public function tablaRubros($saldo_capital,$interes,$dias_mora)
	{
		//****rubros
		//Interés Normal:	Interés Mora:	Costos Operativos (Gastos Cobranza: $0.00):	Capital:
		//Cuantía:	Mora Coactiva:	Emisión Título C.	Costas Procesales:	Honorarios:	Deuda Total:
		//****cabeceras
		//Rubros 	Deuda 	Interes Rebaja	% Rebaja de Intereses	Cuota Inicial 	Saldos
		
		$resultRubros=array();
		$deuda=0;
		$interes_rebaja=0;
		$porc_rebaja=0;
		$cuota_inicial=0;
		$saldos=0;
		
		$mora=($saldo_capital*$interes*12*$dias_mora)/3600;
		$fila=array('rubros'=>'','deuda'=>$deuda,'interes_rebaja'=>$interes_rebaja,'porc_rebaja'=>$porc_rebaja,'cuota_inicial'=>$cuota_inicial,'saldos'=>$saldos);
		
		
		$rubros=array('interes_normal'=>'Interés Normal:','interes_mora'=>'Interés Mora:','costos_operativos'=>'Costos Operativos(Gastos Cobranza: $0.00):','capital'=>	'Capital:',	
		'cuantia'=>'Cuantía:','mora_coactiva'=>	'Mora Coactiva:','emision_titulo'=>'Emisión Título C:','costos_procesales'=>'Costos Procesales:','honorarios'=>'Honorarios:',
		'deudatotal'=>'Deuda Total:');
		
		$fila['rubros']=$rubros['interes_normal'];
		$resultRubros['interes_normal']=$fila;
		
		$fila['rubros']=$rubros['interes_mora'];
		$resultRubros['interes_mora']=$fila;
		
		$fila['rubros']=$rubros['costos_operativos'];
		$resultRubros['costos_operativos']=$fila;
		
		$fila['rubros']=$rubros['capital'];
		$fila['deuda']=$saldo_capital;
		$fila['saldos']=$saldo_capital;
		$resultRubros['capital']=$fila;
		
		$fila['rubros']=$rubros['cuantia'];
		$fila['deuda']=0;
		$fila['saldos']=0;
		$resultRubros['cuantia']=$fila;
		
		$fila['rubros']=$rubros['mora_coactiva'];
		$fila['deuda']=round($mora,2);
		$fila['saldos']=round($mora,2);
		$resultRubros['mora_coactiva']=$fila;
		
		$fila=array('rubros'=>'','deuda'=>$deuda,'interes_rebaja'=>$interes_rebaja,'porc_rebaja'=>$porc_rebaja,'cuota_inicial'=>$cuota_inicial,'saldos'=>$saldos);
		$fila['rubros']=$rubros['emision_titulo'];
		$resultRubros['emision_titulo']=$fila;
		
		$fila['rubros']=$rubros['costos_procesales'];
		$resultRubros['costos_procesales']=$fila;
		
		$fila['rubros']=$rubros['honorarios'];
		$resultRubros['honorarios']=$fila;
		
		$fila['rubros']=$rubros['deudatotal'];
		$resultRubros['deudatotal']=$fila;
		
		
		return $resultRubros;
	}
	
	public function diasMora($fecha_corte,$fecha_emision)
	{
		
		$_fecha_corte=date_create($fecha_corte);
		
		$_fecha_emision=date_create($fecha_emision);
		
		$dias_mora=date_diff($_fecha_emision, $_fecha_corte); 
		
		$dias_mora=$dias_mora->format('%a');;
		
		return  $dias_mora;
	}
	
	
}
?>