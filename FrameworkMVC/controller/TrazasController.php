<?php

class TrazasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function AuditoriaControladores(){
		
		     
				$traza=new TrazasModel();
					
				$funcion = "ins_trazas";
				
				$_id_usuarios=$_SESSION['id_usuarios'];
				
			$parametros = "'$_id_usuarios', '$_accion_trazas', '$_parametros_trazas', '$_nombre_controladores'";
				
				$traza->setFuncion($funcion);
					
				$traza->setParametros($parametros);
					
				$resultadoT=$traza->Insert();
		
	}
	
	
	
	
	
}
?>