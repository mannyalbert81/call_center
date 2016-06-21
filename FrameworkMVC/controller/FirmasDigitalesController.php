<?php

class FirmasDigitalesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$firmas_digitales = new FirmasDigitalesModel(); 
		
	   //Conseguimos todos los usuarios
     	$columnas  = "firmas_digitales.id_usuarios, usuarios.nombre_usuarios, firmas_digitales.imagen_firmas_digitales, firmas_digitales.id_firmas_digitales";
     	$tablas    = "public.firmas_digitales, public.usuarios";
     	$where     = "usuarios.id_usuarios = firmas_digitales.id_usuarios";
     	$id        = "usuarios.nombre_usuarios";
     	
		$resultSet=$firmas_digitales->getCondiciones($columnas, $tablas, $where, $id);
				
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
						$columnas  = "usuarios.id_usuarios, usuarios.nombre_usuarios, firmas_digitales.imagen_firmas_digitales, firmas_digitales.id_firmas_digitales";
						$tablas    = "public.firmas_digitales, public.usuarios";
						$where     = "usuarios.id_usuarios = firmas_digitales.id_usuarios AND firmas_digitales.id_firmas_digitales = '$_id_firmas_digitales'";
						$id        = "usuarios.nombre_usuarios";
						
							
						$resultEdit = $firmas_digitales->getCondiciones($columnas ,$tablas ,$where, $id);
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Firmas Digitales";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_firmas_digitales;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);

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
			
			if (isset ($_POST["abogados"]) )
				
			{
				$usuarios=new UsuariosModel();
				$_id_usuarios =  $_POST["abogados"] ;
				
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
				
				
				$parametros = " '$_id_usuarios' ,'{$imagen_firmas_digitales}' ";
				$firmas_digitales->setFuncion($funcion);	
				$firmas_digitales->setParametros($parametros);
			   
				
				try {
				
					$resultado=$firmas_digitales->Insert();
					
					$traza=new TrazasModel();
					$_nombre_controlador = "Firmas Digitales";
					$_accion_trazas  = "Guardar";
					$_parametros_trazas = $_id_usuarios;
					$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					
					
				} catch (Exception $e) {
					
					$this->view("Error",array(
							"resultado"=>$e
					));
					
					
				}
				
					
				}
				//pasante
				
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
		$nombre_controladores = "FirmasDigitales";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
			if(isset($_GET["id_firmas_digitales"]))
			{
				$id_firmas_digitales=(int)$_GET["id_firmas_digitales"];
		
				$firmas_digitales = new FirmasDigitalesModel();
		
				$firmas_digitales->deleteBy(" id_firmas_digitales",$id_firmas_digitales);
		
				$traza=new TrazasModel();
				$_nombre_controlador = "Firmas Digitales";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_firmas_digitales;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
		
			}
		
			$this->redirect("FirmasDigitales", "index");
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos de Borrar Clientes"
		
			));
		}
		
		
		
	}
	
	public function firmarDocumento() 
	{
		session_start();
		
		if (isset( $_SESSION['usuario_usuarios']) )
		{
			
				$permisos_rol=new PermisosRolesModel();
				$nombre_controladores = "FirmasDigitales";
				$id_rol= $_SESSION['id_rol'];
				$resultPer = $permisos_rol->getPermisosEditar(" controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
				if (!empty($resultPer))
				{
						$id_usuario=$_SESSION['id_usuarios'];
						
						$firmas = new FirmasDigitalesModel();
						
						
						$resultSet= array();
						$resultEdit= null;
						$resultUsuarioSecretario=null;
						
						if(isset($_POST['guardar']))
							{
						
								$directorio = $_SERVER['DOCUMENT_ROOT'].'/documentos/';
									
								$nombre = $_FILES['imagen_firmas_digitales']['name'];
								$tipo = $_FILES['imagen_firmas_digitales']['type'];
								$tamano = $_FILES['imagen_firmas_digitales']['size'];
								
								move_uploaded_file($_FILES['imagen_firmas_digitales']['tmp_name'],$directorio.$nombre);
								
								$resultado=$firmas->getPermisosFirmar();
										
										if ($resultado == "") 
										{
											$resultFirmas = $firmas->getBy ( "id_usuarios='$id_usuario'" );
											$id_firma = $resultFirmas [0]->id_firmas_digitales;
											
											$firmas->FirmarDocumentos( $directorio, $nombre, $id_firma );
											
										} else {
											
											$this->view ( "Error", array (
													"resultado" => $resultado
											)
											 );
											
											exit ();
										}
								
								$this->redirect("FirmasDigitales","firmarDocumento");
							
							}
					
					
					$this->view("FirmarDocumentos",array(
							"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
					
					));
				
				}
				else
				{
					$this->view("Error",array(
							"resultado"=>"No tiene Permisos para Firmar Documentos comuquese con el Administrador"
				
					));
				}
		
		}
		else
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
			));
		
		}
		
	}
	
	
}
?>