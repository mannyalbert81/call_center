<?php


class CertificadosElectronicosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$firmas_digitales = new FirmasDigitalesModel(); 
		
     	$resultSet="";
     	$resultEdit="";
     	$resultCertificado=array();
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{


			$nombre_controladores = "Certificados";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $firmas_digitales->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				
				
				
				if(isset($_POST['registrar'])){
					
					
					
					$comando='start "" /b "C:\CertificadosDigitales\registrar\RegistrarCertificado.exe" ';
						
					$comando_esc = escapeshellcmd($comando);
						
					exec($comando_esc,$resultadoSalida,$ejecucion);
						
					//echo "valor estatus de la aplicacion en C# ".$ejecucion."<br>(0=> la aplicacion se ejecuto exitosamente)<br> (1=>la aplicacion no se ejecuto correctamente ocurrio algun error)<br>";
						
					if(count($resultadoSalida)>0)
					{
						$resultCertificado=$resultadoSalida;
					
					}else{
							
					}
					
				}
		
				
				$this->view("CertificadosElectronicos",array(
						"resultSet"=>$resultSet,"resultEdit"=>$resultEdit,"resultCertificado"=>$resultCertificado
			
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
	
		
	public function InsertaFirmas(){
			
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
			
			
			
			if(!empty($resultFirmas)){
				
			$id_firma=$resultFirmas[0]->id_firmas_digitales;
			$alias=$_POST['alias'];
			$numero_serie=$_POST['numero_serie'];
			$emitido_por=$_POST['emitido_por'];
			$emitido_para=$_POST['emitido_para'];
			$fecha_expira=$_POST['fecha_expira'];
			$macaddress=$this->verMacAddress();
			
			
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
	
	public function verMacAddress(){
		
		ob_start();
		
		system('ipconfig /all');
		
		$mycomsys=ob_get_contents();
		
		ob_clean();
		 
		
		 
		$macaddress="";
		$find_mac = "Direcci";
		
		$pmac = strpos($mycomsys, $find_mac);
		 
		if ($pmac === false) {
		
		} else {
			$find_mac = "Fhysical";
			$macaddress=substr($mycomsys,($pmac+36),17);
		
		}
		 
		 
		$macaddress=substr($mycomsys,($pmac+43),23);
		
		return $macaddress;
	}


	
	
	
}
?>