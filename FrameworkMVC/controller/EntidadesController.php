<?php

class EntidadesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$entidades=new EntidadesModel();
					//Conseguimos todos los usuarios
		$resultSet=$entidades->getAll("id_entidades");
				
		$resultEdit = "";

		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			$nombre_controladores = "Entidades";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $entidades->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_entidades"])   )
				{

					$nombre_controladores = "Entidades";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $entidades->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_entidades = $_GET["id_entidades"];
						$columnas = " id_entidades, nombre_entidades ";
						$tablas   = "entidades";
						$where    = "id_entidades = '$_id_rol' "; 
						$id       = "nombre_entidades";
							
						$resultEdit = $entidades->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar entidades"
					
						));
					
					
					}
					
				}
		
				
				$this->view("Entidades",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Entidades"
				
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
	
	public function InsertaEntidades(){
			
		session_start();
		$entidades=new EntidadesModel();
		

		$nombre_controladores = "Entidades";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $entidades->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$entidades=new EntidadesModel();
		
			//_nombre_categorias character varying, _path_categorias character varying
			if (isset ($_POST["nombre_entidades"])   )
				
			{
				
				
				$_nombre_entidades = $_POST["nombre_entidades"];
				
				
				$funcion = "ins_entidades";
				$parametros = " '$_nombre_entidades'  ";
					
				$entidades->setFuncion($funcion);
		
				$entidades->setParametros($parametros);
		
		
				$resultado=$entidades->Insert();
		
		
			}
			$this->redirect("Entidades", "index");

		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Insertar Entidades"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$nombre_entidades = "Entidades";
		$id_entidades= $_SESSION['id_entidades'];
		$resultPer = $entidades->getPermisosEditar("   entidades.nombre_entidades = '$nombre_entidades' AND id_entidades.id_entidades = '$id_entidades' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_entidades"]))
			{
				$id_entidades=(int)$_GET["id_entidades"];
		
				$entidades=new EntidadesModel();
				
				$entidades->deleteBy(" id_entidades",$id_rol);
				
				
			}
			
			$this->redirect("Entidades", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Entidades"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$entidades=new EntidadesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_entidades, nombre_entidades", " nombre_entidades != '' ");
			$this->report("Entidades",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>