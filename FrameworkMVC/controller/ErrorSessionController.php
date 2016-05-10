<?php

class SubCategoriasController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

//pasante

	public function index(){
	
	
		
		$this->view("ErrorSesion",array(
				"resultSet"=>""
	
		));
	}
	
		
	
}
?>