<?php

class SecretariosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
		
		session_start();
		
		$ciudad=new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
	
		$secretarios=new UsuariosModel();
		$resultSecre = $secretarios->getAll("nombre_usuarios");
		
		$impulsores=new UsuariosModel();
		$resultImp = $impulsores->getAll("nombre_usuarios");
	
	
		$this->view("Contacto",array(
				"resultSet"=>"", "resultCiu"=>$resultCiu, "resultUsu"=>$resultUsu
		));
	}
	
	
	
	public function devuelveSecretarios()
	{
		session_start();
		$resultSub = array();
	
		if(isset($_POST["id_ciudad"]))
		{
	
			$id_ciudad=(int)$_POST["id_ciudad"];
	
		    $secretarios=new UsuariosModel();
	
			$resultSecre = $secretarios->getBy(" id_ciudad = '$id_ciudad'  ");
	
		}
	
		echo json_encode($resultSecre);

	}
	
	public function devuelveImpulsores()
	{
		session_start();
		$resultSub = array();
	
		if(isset($_POST["id_ciudad"]))
		{
	
			$id_ciudad=(int)$_POST["id_ciudad"];
	
			$impulsores=new UsuariosModel();
	
			$resultImp = $impulsores->getBy(" id_ciudad = '$id_ciudad'  ");
	
		}
	
		echo json_encode($resultImp);
	
	}
	
	public function returnSecretariosbyciudad()
	{
	
		//CONSULTA DE USUARIOS POR SU ROL
		$idciudad=(int)$_POST["id_ciudad"];
		$usuarios=new UsuariosModel();
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios,ciudad,rol";
		$id="rol.id_rol";
	
		$where="rol.id_rol=usuarios.id_rol AND usuarios.id_ciudad=ciudad.id_ciudad
		AND rol.nombre_rol='SECRETARIO' AND ciudad.id_ciudad='$idciudad'";
	
		$resultUsuarioSecretarioC=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultUsuarioSecretarioC);
	}
	
	public function returnImpulsoresbyciudad()
	{
	
		//CONSULTA DE USUARIOS POR SU ROL
		$idciudad=(int)$_POST["id_ciudad"];
		$usuarios=new UsuariosModel();
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios,ciudad,rol";
		$id="rol.id_rol";
	
		$where="rol.id_rol=usuarios.id_rol AND usuarios.id_ciudad=ciudad.id_ciudad
		AND rol.nombre_rol='ABOGADO IMPULSOR' AND ciudad.id_ciudad='$idciudad'";
	
		$resultUsuarioImpulsor=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultUsuarioImpulsor);
	}
	
	
	
	
}
?>