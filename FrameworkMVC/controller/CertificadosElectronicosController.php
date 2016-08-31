<?php

class CertificadosElectronicosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//sadsad

	public function index(){
	
		//Creamos el objeto usuario
     
		
     	$resultSet="";
     	$resultEdit="";
     	$resultCertificado=array();
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$firmas_digitales = new FirmasDigitalesModel();
			$certificado = new CertificadosModel();
			//NOTIFICACIONES
			$firmas_digitales->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$nombre_controladores = "Certificados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $firmas_digitales->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				$resultUsuario=$_SESSION['id_usuarios'];
				
				$resultCertificado=$certificado->getBy("id_usuarios_certificado_digital='$resultUsuario'");
				
				
				if(isset($_POST['aceptar']))
				{
					$this->InsertaCertificado();
				}
				
				
				
				$this->view("RegistrarCertificado",array(
						"resultSet"=>$resultSet,"resultUsuario"=>$resultUsuario,"resultCertificado"=>$resultCertificado
			
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
	
		
	public function InsertaCertificado(){
			
		session_start();
		
		$id_usuario=$_SESSION['id_usuarios'];

		$nombre_controladores = "Certificados";
		
		$firmas = new FirmasDigitalesModel();
		$resultFirmas=$firmas->getBy("id_usuarios='$id_usuario'");

		$resultSet="";
		$resultEdit="";
		$firmas_digitales = new FirmasDigitalesModel(); 
		$certificados = new CertificadosModel();
		
		$id_rol= $_SESSION['id_rol'];
		
		$resultPer = $firmas_digitales->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
			if(!empty($resultFirmas))
			
			{
				
			$id_firma=$resultFirmas[0]->id_firmas_digitales;
			$alias=$_POST['alias'];
			$numero_serie=$_POST['numero_serie'];
			$emitido_por=$_POST['emitido_por'];
			$emitido_para=$_POST['emitido_para'];
			$fecha_expira=$_POST['fecha_expira'];
			
			$macaddress=$certificados->verMacAddress();
			
			$funcion = "ins_certificado_digital";
			
			// character varying,  character varying,  character varying,  integer _mac_certificado_digital character varying, _id_usuarios integer)
			
			$parametros = " '$numero_serie' ,'$emitido_por' , '$emitido_para' , '$id_firma' , '$macaddress' , '$id_usuario','$fecha_expira','$alias'";
			$certificados->setFuncion($funcion);
			
			$certificados->setParametros($parametros);
			
			
			$resultado=$certificados->Insert();
			
			$traza=new TrazasModel();
			$_nombre_controlador = "Certificados";
			$_accion_trazas  = "Guardar";
			$_parametros_trazas = $macaddress;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
			$this->redirect("CertificadosElectronicos","index");
			
			}else {
				$this->view("Error",array(
							
						"resultado"=>"usted no tiene una firma para a relacionar"
				
				));
			}
		
		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Firmas Digitales"
		
			));
		
		
		}
		
	}
	
	public function registrar_certificado()
	{
		$certificado = new CertificadosModel();
		$consulta=array();
		
		if(isset($_POST['certificado'])&&isset($_POST['mac'])&&isset($_POST['id_usuario']))
		{
			$array_certificado = array();
			
			$dato_certificado=$_POST['certificado'];
			$dato_mac=$_POST['mac'];
			$dato_usuario=$_POST['id_usuario'];
			
			$array_certificado=$this->datosCertificado($dato_certificado);
			
			$para=$array_certificado['emitidoPara'];
			$por=$array_certificado['emitidoPor'];
			
			$funcion="ins_certificado_electronico";
			$parametros="'$dato_usuario','$dato_mac','$dato_certificado','$para','$por'";
			
			$certificado->setFuncion($funcion);
			$certificado->setParametros($parametros);
			
			$resultado=$certificado->Insert();
			
			$consulta=$certificado->getBy("id_usuarios_certificado_digital='$dato_usuario'");
			
			if (!empty($consulta)){
				
				echo "Datos Ingresados correctamente";
				
			}else {
				echo "Datos Ingresados correctamente";
			}
			
		}else{
			echo "Error al enviar sus datos ";
		}
		
	}
	
	public function datosCertificado($cadenacertificado)
	{
		$arrayCertificado=array();
		
		if ($cadenacertificado!=null || $cadenacertificado!="")
		{
			$arraydatosCertificado = explode(",", $cadenacertificado, 5);
			
			$arrayEmitidoPara=explode(" ", $arraydatosCertificado[0], 2);
				
			$emitidopara=substr($arrayEmitidoPara[1],strpos($arrayEmitidoPara[1],"=")+1);
			$emitidopor=substr($arraydatosCertificado[3],strpos($arraydatosCertificado[3],"=")+1);
			
			$arrayCertificado=array('emitidoPara'=>$emitidopara,'emitidoPor'=>$emitidopor);
			
		}
		
		return $arrayCertificado;
		
	}
	
}
?>