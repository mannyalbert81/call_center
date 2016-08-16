<?php
ini_set('memory_limit','128M');
ini_set('display_errors',1);
ini_set('display_startup_erros',1);


//include_once('class/phpjasperxml/class/tcpdf/tcpdf.php');
//include_once("class/phpjasperxml/class/PHPJasperXML.inc.php");

//include_once ('class/phpjasperxml/setting.php');



//include_once('setting.php');//no se puede enviar nada mas que el reporte, NINGUN espacio o caracter previo al repote

class UsuariosController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$usuarios=new UsuariosModel();
			//Notificaciones
			$usuarios->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			//creacion menu busqueda
			//$resultMenu=array("1"=>Nombre,"2"=>Usuario,"3"=>Correo,"4"=>Rol);
			$resultMenu=array(0=>'--Seleccione--',1=>'Nombre', 2=>'Usuario', 3=>'Correo', 4=>'Rol', 5=>'Ciudad');
			
			
				//Creamos el objeto usuario
			$rol=new RolesModel();
			$resultRol = $rol->getAll("nombre_rol");
			
			
			$estado = new EstadoModel();
			$resultEst = $estado->getAll("nombre_estado");
			
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
			
	
			$usuarios = new UsuariosModel();

			$nombre_controladores = "Usuarios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $usuarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			     	$columnas = " usuarios.id_usuarios,  usuarios.nombre_usuarios, usuarios.usuario_usuarios ,  usuarios.telefono_usuarios, usuarios.celular_usuarios, usuarios.correo_usuarios, rol.nombre_rol, estado.nombre_estado, rol.id_rol, estado.id_estado, usuarios.cedula_usuarios, ciudad.id_ciudad, ciudad.nombre_ciudad";
					$tablas   = "public.rol,  public.usuarios, public.estado, public.ciudad";
					$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND ciudad.id_ciudad = usuarios.id_ciudad";
					$id       = "usuarios.nombre_usuarios"; 
			
					
					//Conseguimos todos los usuarios
					$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
					
					$resultEdit = "";
			
					if (isset ($_GET["id_usuarios"])   )
					{
						$_id_usuario = $_GET["id_usuarios"];
						$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND ciudad.id_ciudad = usuarios.id_ciudad AND usuarios.id_usuarios = '$_id_usuario' "; 
						$resultEdit = $usuarios->getCondiciones($columnas ,$tablas ,$where, $id); 
				
					
						$traza=new TrazasModel();
						$_nombre_controlador = "Usuarios";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_usuario;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					
					
					}
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Usuarios"
			
				));
				exit();
			
			
			}
			
			
			///si tiene permiso de ver
			//$resultPerVer = $usuarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			$resultPerVer= $usuarios->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPerVer))
			{
				if (isset ($_POST["criterio"])  && isset ($_POST["contenido"])  )
				{
						
					
					/*	
					$columnas = "documentos_legal.id_documentos_legal,  documentos_legal.fecha_documentos_legal, categorias.nombre_categorias, subcategorias.nombre_subcategorias, tipo_documentos.nombre_tipo_documentos, cliente_proveedor.nombre_cliente_proveedor, carton_documentos.numero_carton_documentos, documentos_legal.paginas_documentos_legal, documentos_legal.fecha_desde_documentos_legal, documentos_legal.fecha_hasta_documentos_legal, documentos_legal.ramo_documentos_legal, documentos_legal.numero_poliza_documentos_legal, documentos_legal.ciudad_emision_documentos_legal, soat.cierre_ventas_soat,   documentos_legal.creado  ";
					$tablas   = "public.documentos_legal, public.categorias, public.subcategorias, public.tipo_documentos, public.carton_documentos, public.cliente_proveedor, public.soat";
					$where    = "categorias.id_categorias = subcategorias.id_categorias AND subcategorias.id_subcategorias = documentos_legal.id_subcategorias AND tipo_documentos.id_tipo_documentos = documentos_legal.id_tipo_documentos AND carton_documentos.id_carton_documentos = documentos_legal.id_carton_documentos AND cliente_proveedor.id_cliente_proveedor = documentos_legal.id_cliente_proveedor   AND documentos_legal.id_soat = soat.id_soat ";
					$id       = "documentos_legal.fecha_documentos_legal, carton_documentos.numero_carton_documentos";
					*/	
					
					
					
					$columnas = " usuarios.id_usuarios,  usuarios.nombre_usuarios, usuarios.usuario_usuarios ,  usuarios.telefono_usuarios, usuarios.celular_usuarios, usuarios.correo_usuarios, rol.nombre_rol, estado.nombre_estado, rol.id_rol, estado.id_estado, usuarios.cedula_usuarios, ciudad.id_ciudad, ciudad.nombre_ciudad";
					$tablas   = "public.rol,  public.usuarios, public.estado, public.ciudad";
					$where    = "rol.id_rol = usuarios.id_rol AND estado.id_estado = usuarios.id_estado AND ciudad.id_ciudad = usuarios.id_ciudad";
					$id       = "usuarios.nombre_usuarios";
					

					$criterio = $_POST["criterio"];
					$contenido = $_POST["contenido"];
						
					
					//$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
						
					if ($contenido !="")
					{
							
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
						$where_5 = "";
							
						switch ($criterio) {
							case 0:
								$where_0 = "OR  usuarios.nombre_usuarios LIKE '$contenido'   OR usuarios.usuario_usuarios LIKE '$contenido'  OR  usuarios.correo_usuarios LIKE '$contenido'  OR rol.nombre_rol LIKE '$contenido' OR ciudad.nombre_ciudad LIKE '$contenido'";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  usuarios.nombre_usuarios LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND usuarios.usuario_usuarios LIKE '$contenido'  ";
								break;
							case 3:
								//Número Carton
								$where_3 = " AND usuarios.correo_usuarios LIKE '$contenido' ";
								break;
							case 4:
								//Número Poliza
								$where_4 = " AND rol.nombre_rol LIKE '$contenido' ";
								break;
							case 5:
									//Número Poliza
									$where_5 = " AND ciudad.nombre_ciudad LIKE '$contenido' ";
									break;
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2 . $where_3 . $where_4 . $where_5;
							
							
						$resul = $where_to;
						
						//Conseguimos todos los usuarios con filtros
						$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where_to, $id);
							
							
							
							
					}
				}
				
				if (isset ($_POST["Imprimir"])   )
     			{
     					
     				 
     				
     				//ContUsuariosReport.php
				   $this->ireport("ContUsuarios", "");
				   
				   exit();
				   
					
				}	
				
			}
			
			
			$this->view("Usuarios",array(
					"resultSet"=>$resultSet, "resultRol"=>$resultRol, "resultEdit" =>$resultEdit, "resultEst"=>$resultEst,"resultMenu"=>$resultMenu, "resultCiu"=>$resultCiu
			
			));
			
			
			
			
			
			
		
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
			$_clave_usuario      = $usuarios->encriptar($_POST["clave_usuarios"]);
			$_telefono_usuario   = $_POST["telefono_usuarios"];
			$_celular_usuario    = $_POST["celular_usuarios"];
			$_correo_usuario     = $_POST["correo_usuarios"];
		    $_id_rol             = $_POST["id_rol"];
		    $_id_estado          = $_POST["estados"];
		    $_usuario_usuario     = $_POST["usuario_usuarios"];
		    $_cedula_usuarios    = $_POST["cedula_usuarios"];
		    $_id_ciudad          = $_POST["id_ciudad"];
	
		    
		    if ($_FILES['imagen_usuarios']['tmp_name']!="")
		    {
		    
		    	//para la foto
		    	 
		    	$directorio = $_SERVER['DOCUMENT_ROOT'].'/fotos/';
		    	 
		    	$nombre = $_FILES['imagen_usuarios']['name'];
		    	$tipo = $_FILES['imagen_usuarios']['type'];
		    	$tamano = $_FILES['imagen_usuarios']['size'];
		    	 
		    	// temporal al directorio definitivo
		    	 
		    	move_uploaded_file($_FILES['imagen_usuarios']['tmp_name'],$directorio.$nombre);
		    	 
		    	$data = file_get_contents($directorio.$nombre);
		    	 
		    	$imagen_usuarios = pg_escape_bytea($data);
		    
		    
	
			$funcion = "ins_usuarios";
			
			$parametros = " '$_nombre_usuario' ,'$_clave_usuario' , '$_telefono_usuario', '$_celular_usuario', '$_correo_usuario' , '$_id_rol', '$_id_estado' , '$_usuario_usuario', '$_cedula_usuarios', '$_id_ciudad', '$imagen_usuarios'";
			$usuarios->setFuncion($funcion);
	
			$usuarios->setParametros($parametros);
	
	
			$resultado=$usuarios->Insert();
		    
		    }
			
		    else
		    {
		    
		    	$colval = " nombre_usuarios = '$_nombre_usuario',  clave_usuarios = '$_clave_usuario', telefono_usuarios = '$_telefono_usuario', celular_usuarios = '$_celular_usuario', correo_usuarios = '$_correo_usuario', id_rol = '$_id_rol', id_estado = '$_id_estado', usuario_usuarios = '$_usuario_usuario', id_ciudad = '$_id_ciudad'  ";
		    	$tabla = "usuarios";
		    	$where = "cedula_usuarios = '$_cedula_usuarios'    ";
		    
		    	$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
		    	 
		    }
			
	
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
				
			$traza=new TrazasModel();
			$_nombre_controlador = "Usuarios";
			$_accion_trazas  = "Borrar";
			$_parametros_trazas = $id_usuario;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
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
    		$_usuario = $_POST["usuarios"];
    		$_clave =   $usuarios->encriptar($_POST["clave"]);
    		 
    		
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
    				$id_usuario  = $res->id_usuarios;
    				$usuario_usuario  = $res->usuario_usuarios;
	    			$id_rol           = $res->id_rol;
	    			$nombre_usuario   = $res->nombre_usuarios;
	    			$correo_usuario   = $res->correo_usuarios;
	    			
    			}	
    			//obtengo ip
    			$ip_usuario = $usuarios->getRealIP();
    			
    			
    			///registro sesion
    			$usuarios->registrarSesion($id_usuario, $usuario_usuario, $id_rol, $nombre_usuario, $correo_usuario, $ip_usuario);
    			
    			//inserto en la tabla
    			$_id_usuario = $_SESSION['id_usuarios'];
    			$_ip_usuario = $_SESSION['ip_usuarios'];
    			
    			//NOTIFICACIONES
    			$usuarios->MostrarNotificaciones($_id_usuario);
    			
    			$_id_rol=$_SESSION['id_rol'];
    			$usuarios->MenuDinamico($_id_rol);
    			
    			$sesiones = new SesionesModel();

    			$funcion = "ins_sesiones";
    			
    			$parametros = " '$_id_usuario' ,'$_ip_usuario' ";
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
			$ciudad = new CiudadModel();
		
						
					
				$resultEdit = "";
					
				$_id_usuario = $_SESSION['id_usuarios'];
				$where    = " usuarios.id_usuarios = '$_id_usuario' ";
				$resultEdit = $usuarios->getBy($where);
				
				$resultCiu = $ciudad->getAll("nombre_ciudad");
				

				if ( isset($_POST["Guardar"]) )
				{

					$_nombre_usuario    = $_POST["nombre_usuarios"];
					$_clave_usuario      =$usuarios->encriptar( $_POST["clave_usuarios"]);
					$_telefono_usuario  = $_POST["telefono_usuarios"];
					$_celular_usuario    = $_POST["celular_usuarios"];
					$_correo_usuario     = $_POST["correo_usuarios"];
					$_usuario_usuario     = $_POST["usuario_usuarios"];
					$_cedula_usuarios     = $_POST["cedula_usuarios"];
					$_id_ciudad           = $_POST["id_ciudad"];
				
					
					
					
					if ($_FILES['imagen_usuarios']['tmp_name']!="")
					{
					
						//para la foto
					
						$directorio = $_SERVER['DOCUMENT_ROOT'].'/fotos/';
					
						$nombre = $_FILES['imagen_usuarios']['name'];
						$tipo = $_FILES['imagen_usuarios']['type'];
						$tamano = $_FILES['imagen_usuarios']['size'];
					
						// temporal al directorio definitivo
					
						move_uploaded_file($_FILES['imagen_usuarios']['tmp_name'],$directorio.$nombre);
					
						$data = file_get_contents($directorio.$nombre);
					
						$imagen_usuarios = pg_escape_bytea($data);
					
					
					
				    $colval   = " nombre_usuarios = '$_nombre_usuario' , clave_usuarios = '$_clave_usuario'   , telefono_usuarios = '$_telefono_usuario' ,  celular_usuarios = '$_celular_usuario' , correo_usuarios = '$_correo_usuario' , usuario_usuarios = '$_usuario_usuario', cedula_usuarios = '$_cedula_usuarios', id_ciudad = '$_id_ciudad', imagen_usuarios = '$imagen_usuarios'  ";
					$tabla    = "usuarios";
					$where    = " id_usuarios = '$_id_usuario' ";
					
					$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
					}
						
					else
					{
					
						 $colval   = " nombre_usuarios = '$_nombre_usuario' , clave_usuarios = '$_clave_usuario'   , telefono_usuarios = '$_telefono_usuario' ,  celular_usuarios = '$_celular_usuario' , correo_usuarios = '$_correo_usuario' , usuario_usuarios = '$_usuario_usuario', cedula_usuarios = '$_cedula_usuarios', id_ciudad = '$_id_ciudad' ";
					$tabla    = "usuarios";
					$where    = " id_usuarios = '$_id_usuario' ";
					
					$resultado=$usuarios->UpdateBy($colval, $tabla, $where);
				
					
					}
					
					
					
					$this->view("Login",array(
							"allusers"=>""
					));
					
					
				}
				else
				{
					$this->view("ActualizarUsuario",array(
							"resultEdit" =>$resultEdit,
							"resultCiu" =>$resultCiu
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
