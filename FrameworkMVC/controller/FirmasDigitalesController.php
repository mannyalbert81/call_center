<?php

class FirmasDigitalesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$firmas_digitales = new FirmasDigitalesModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$firmas_digitales->getAll("id_firmas_digitales");
				
		$resultEdit = "";
		
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
		$id="rol.id_rol";
		
		$usuarios=new UsuariosModel();
		$where="rol.nombre_rol='SECRETARIO' OR rol.nombre_rol='ABOGADO IMPULSOR' OR rol.nombre_rol='LIQUIDADOR'";
		$resultUsuarioSecretario=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
		
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{


			$nombre_controladores = "FirmasDigitales";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $firmas_digitales->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				
				
				if (isset ($_GET["id_firmas_digitales"])   )
				{

					$nombre_controladores = "FirmasDigitales";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $firmas_digitales->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_firmas_digitales = $_GET["id_firmas_digitales"];
						$columnas = " id_firmas_digitales, id_usuarios, imagen_firmas_digitales";
						$tablas   = "firmas_digitales";
						$where    = "firmas_digitales.id_usuarios = usuarios.id_usuarios AND firmas_digitales.id_firmas_digitales = '$_id_firmas_digitales' "; 
						$id       = "id_usuarios";
							
						$resultEdit = $firmas_digitales->getCondiciones($columnas ,$tablas ,$where, $id);

					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Firmas Digitales"
					
						));
					
					
					}
					
				}
		
				
				$this->view("FirmasDigitales",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultUsuarioSecretario" =>$resultUsuarioSecretario
			
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
	
		
	public function InsertaFirmasDigitales(){
			
		session_start();
		

		$nombre_controladores = "FirmasDigitales";

		
		$firmas_digitales = new FirmasDigitalesModel(); 
		
		$id_rol= $_SESSION['id_rol'];
		
		$resultPer = $firmas_digitales->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$firmas_digitales = new FirmasDigitalesModel(); 
		
			//_nombre_controladores
			
			if (isset ($_POST["id_usuarios"]) )
				
			{
				$usuarios=new UsuariosModel();
				$_id_usuarios =  $_POST["id_usuarios"] ;
				
				$firmas_digitales = new FirmasDigitalesModel();
				$directorio = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
					
				$nombre = $_FILES['imagen_firmas_digitales']['name'];
				$tipo = $_FILES['imagen_firmas_digitales']['type'];
				$tamano = $_FILES['imagen_firmas_digitales']['size'];
					
				// temporal al directorio definitivo
					
				move_uploaded_file($_FILES['imagen_firmas_digitales']['tmp_name'],$directorio.$nombre);
					
				$data = file_get_contents($directorio.$nombre);
					
				$imagen_firmas_digitales = pg_escape_bytea($data);
					
				
					
					
					
				$funcion = "ins_firmas_digitales";
				
				
				$parametros = " '$_id_usuarios' ,'{$_imagen_firmas_digitales}' ";
				$firmas_digitales->setFuncion($funcion);	
				$firmas_digitales->setParametros($parametros);
			   
				$resultado=$firmas_digitales->Insert();
				
				//$this->view("Error",array(
				//"resultado"=>"entro"
				//));
					
				}
				
				
				$this->redirect("FirmasDigitales", "index");
		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Firmas Digitales"
		
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
			if(isset($_GET["id_controladores"]))
			{
				$id_controladores=(int)$_GET["id_controladores"];
				
				$controladores=new ControladoresModel();
				
				$controladores->deleteBy(" id_controladores",$id_controladores);
				
				
			}
			
			$this->redirect("Controladores", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Controladores"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$roles=new RolesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("Roles",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>