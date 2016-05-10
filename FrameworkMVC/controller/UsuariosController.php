<?php
class UsuariosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
				//Creamos el objeto usuario
			$rol=new RolesModel();
			$resultRol = $rol->getAll("nombre_rol");
			
			
			$estado = new EstadoModel();
			$resultEst = $estado->getAll("nombre_estado");
			
	
			$usuarios = new UsuariosModel();

			$nombre_controladores = "Usuarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
			
					$columnas = " usuarios.id_usuarios,  usuarios.nombre_usuarios, usuarios.usuario_usuarios ,  usuarios.telefono_usuarios, usuarios.celular_usuarios, usuarios.correo_usuarios, rol.nombre_rol, estado.nombre_estado, rol.id_rol, estado.id_estado ";
					$tablas   = "public.rol,  public.usuarios, public.estado";
					$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado";
					$id       = "usuarios.nombre_usuarios"; 
			
					
					//Conseguimos todos los usuarios
					$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
					
					
					$resultEdit = "";
			
					if (isset ($_GET["id_usuarios"])   )
					{
						$_id_usuario = $_GET["id_usuarios"];
						$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND usuarios.id_usuarios = '$_id_usuario' "; 
						$resultEdit = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id); 
					}
			
					
					$this->view("Usuarios",array(
							"resultSet"=>$resultSet, "resultRol"=>$resultRol, "resultEdit" =>$resultEdit, "resultEst"=>$resultEst
				
					));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Usuarios"
			
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
	
	public function InsertaUsuarios(){
			
		$resultado = null;
		$usuarios=new UsuariosModel();
	
	
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["usuario_usuarios"]) && isset ($_POST["nombre_usuarios"]) && isset ($_POST["clave_usuarios"]) && isset($_POST["id_rol"])  )
		{

			
			$_nombre_usuario     = $_POST["nombre_usuarios"];
			
			$_clave_usuario      = $_POST["clave_usuarios"];
			
			$_telefono_usuario   = $_POST["telefono_usuarios"];
			$_celular_usuario    = $_POST["celular_usuarios"];
			$_correo_usuario     = $_POST["correo_usuarios"];
		    $_id_rol             = $_POST["id_rol"];
		    $_id_estado          = $_POST["id_estado"];
		    $_usuario_usuario     = $_POST["usuario_usuarios"];
	
	
			$funcion = "ins_usuarios";
			
			$parametros = " '$_nombre_usuarios' ,'$_clave_usuarios' , '$_telefono_usuarios', '$_celular_usuarios', '$_correo_usuarios' , '$_id_rol', '$_id_estado' , '$_usuario_usuarios'";
			$usuarios->setFuncion($funcion);
	
			$usuarios->setParametros($parametros);
	
	
			$resultado=$usuarios->Insert();
	
			/*
			 $this->view("Categorias",array(
			 "resultado"=>$resultado
			 ));
	
			*/
	
		}
		$this->redirect("Usuarios", "index");
			
	}
	
	public function borrarId()
	{
		if(isset($_GET["id_usuarios"]))
		{
			$id_usuario=(int)$_GET["id_usuarios"];
	
			$usuarios=new UsuariosModel();
				
			$usuarios->deleteBy(" id_usuarios",$id_usuario);
				
				
		}
	
		$this->redirect("Usuarios", "index");
	}
	
    
    
    public function Login(){
    
    	//Creamos el objeto usuario
    	$usuarios=new UsuariosModel();
    
    	//Conseguimos todos los usuarios
    	$allusers=$usuarios->getLogin();
    	 
    	//Cargamos la vista index y l e pasamos valores
    	$this->view("Login",array(
    			"allusers"=>$allusers
    	));
    }
    public function Bienvenida(){
    
    	//Creamos el objeto usuario
    	$usuarios=new UsuariosModel();
    	
    	//Conseguimos todos los usuarios
    	$allusers=$usuarios->getLogin();
    	
    	//Cargamos la vista index y l e pasamos valores
    	$this->view("Bienvenida",array(
    			"allusers"=>$allusers
    	));
    }
    
    
    
    
    public function Loguear(){
    	if (isset ($_POST["usuarios"]) && ($_POST["clave"] ) )
    	
    	{
    		$usuarios=new UsuariosModel();
    		$_usuario = $_POST["usuario"];
    		$_clave =   $_POST["clave"];
    		 
    		
    		$where = "  usuario_usuarios = '$_usuario' AND  clave_usuarios ='$_clave' ";
    	
    		$result=$usuarios->getBy($where);

    		$usuario_usuarios = "";
    		$id_rol  = "";
    		$nombre_usuarios = "";
    		$correo_usuarios = "";
    		$ip_usuario = "";
    		
    		if ( !empty($result) )
    		{ 
    			foreach($result as $res) 
    			{
    				$id_usuario  = $res->id_usuario;
    				$usuario_usuario  = $res->usuario_usuario;
	    			$id_rol           = $res->id_rol;
	    			$nombre_usuario   = $res->nombre_usuario;
	    			$correo_usuario   = $res->correo_usuario;
	    			
    			}	
    			//obtengo ip
    			$ip_usuario = $usuarios->getRealIP();
    			
    			
    			///registro sesion
    			$usuarios->registrarSesion($id_usuario, $usuario_usuario, $id_rol, $nombre_usuario, $correo_usuario, $ip_usuario);
    			
    			//inserto en la tabla
    			$_id_usuario = $_SESSION['id_usuario'];
    			$_ip_usuario = $_SESSION['ip_usuario'];
    			
    			$sesiones = new SesionesModel();

    			$funcion = "ins_sesiones";
    			
    			$parametros = " '$_id_usuarios' ,'$_ip_usuario' ";
    			$sesiones->setFuncion($funcion);
    			
    			$sesiones->setParametros($parametros);
    			
    			
    			$resultado=$sesiones->Insert();
    			
    		    $this->view("Bienvenida",array(
    				"allusers"=>$_usuario
	    		));
    		}
    		else
    		{
    			
	    		$this->view("Login",array(
	    				"allusers"=>""
	    		));
    		}
    		
    	} 
    	else
    	{
    		$this->view("Login",array(
    				"allusers"=>""
    		));
    		
    	}
    	
    }
    
	public function  cerrar_sesion ()
	{
		session_start();
		session_destroy();
		$this->redirect("Usuarios", "Loguear");
	}
	
	
	public function Actualiza ()
	{
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//Creamos el objeto usuario
			$usuarios = new UsuariosModel();
		
						
					
				$resultEdit = "";
					
				$_id_usuario = $_SESSION['id_usuarios'];
				$where    = " usuarios.id_usuarios = '$_id_usuario' ";
				$resultEdit = $usuarios->getBy($where);
				

				if ( isset($_POST["guardar"]) )
				{

					$_nombre_usuario     = $_POST["nombre_usuarios"];
					$_clave_usuario      = $_POST["clave_usuarios"];
					$_telefono_usuario   = $_POST["telefono_usuarios"];
					$_celular_usuario    = $_POST["celular_usuarios"];
					$_correo_usuario     = $_POST["correo_usuarios"];
					$_usuario_usuario     = $_POST["usuario_usuarios"];
					
					$colval   = " nombre_usuarios = '$_nombre_usuarios' , clave_usuarios = '$_clave_usuarios'   , telefono_usuarios = '$_telefono_usuarios' ,  celular_usuarios = '$_celular_usuarios' , correo_usuarios = '$_correo_usuarios' , usuario_usuarios = '$_usuario_usuarios'    ";
					$tabla    = "usuarios";
					$where    = " id_usuarios = '$_id_usuarios' ";
					
					$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
					
					
					$this->view("Login",array(
							"allusers"=>""
					));
					
					
				}
				else
				{
					$this->view("ActualizarUsuario",array(
							"resultEdit" =>$resultEdit
								
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
