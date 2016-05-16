<?php
class ClientesController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//creacion menu busqueda
			//$resultMenu=array("1"=>Nombre,"2"=>Usuario,"3"=>Correo,"4"=>Rol);
			$resultMenu=array(0=>'--Seleccione--',1=>'Nombre', 2=>'Identificación');
			
			
				//Creamos el objeto usuario
			
			$tipo_identificacion = new TipoIdentificacionModel();
			$resultTipoIdent = $tipo_identificacion->getAll("nombre_tipo_identificacion");
			
	
			$clientes = new ClientesModel();

			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$columnas = " clientes.id_clientes, clientes.id_tipo_identificacion, clientes.identificacion_clientes, clientes.nombres_clientes";
					$tablas   = "public.clientes,  public.tipo_identificacion";
					$where    = "clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion";
					$id       = "clientes.identificacion_clientes"; 
			
				
					$resultSet=$clientes->getCondiciones($columnas ,$tablas ,$where, $id);
					
					
					$resultEdit = "";
			
					if (isset ($_GET["id_clientes"])   )
					{
						$_id_clientes = $_GET["id_clientes"];
					    $where    = " clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND clientes.id_clientes = '$_id_clientes' "; 
						$resultEdit = $clientes->getCondiciones($columnas ,$tablas ,$where, $id); 
					
						
					}
			
					
					
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Clientes"
			
				));
			
			
			}
			
			
			///si tiene permiso de ver
			//$resultPerVer = $usuarios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			$resultPerVer= $clientes->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
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
					
					
					
					$columnas = " clientes.id_clientes, clientes.id_tipo_identificacion, clientes.identificacion_clientes, clientes.nombres_clientes";
					$tablas   = "public.clientes,  public.tipo_identificacion";
					$where    = "clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion";
					$id       = "clientes.identificacion_clientes"; 

					$criterio = $_POST["criterio"];
					$contenido = $_POST["contenido"];
						
					
					//$resultSet=$usuarios->getCondiciones($columnas ,$tablas ,$where, $id);
						
					if ($contenido !="")
					{
							
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						
							
						switch ($criterio) {
							case 0:
								$where_0 = "OR  clientes.nombres_clientes LIKE '$contenido'   OR clientes.identifiacion_clientes LIKE '$contenido'";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  clientes.nombres_clientes LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND clientes.identifiacion_clientes LIKE '$contenido'  ";
								break;
							
						}
							
							
							
						$where_to  = $where .  $where_0 . $where_1 . $where_2;
							
							
						$resul = $where_to;
						
						//Conseguimos todos los usuarios con filtros
						$resultSet=$clientes->getCondiciones($columnas ,$tablas ,$where_to, $id);
							
							
							
							
					}
				}
			}
			
			//"resultMenu"=>$resultMenu
			
			$this->view("Clientes",array(
					"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultMenu"=>$resultMenu, "resultTipoIdent"=> $resultTipoIdent
			
			));
			
			
			
			
			
			
		
		}
		else 
		{
			$this->view("ErrorSesion",array(
					"resultSet"=>""
		
			));
			
			
			
		}
		
	}
	
	public function InsertaClientes(){
		
		$resultado = null;
		$clientes=new ClientesModel();
	
	
		
		//_nombre_categorias character varying, _path_categorias character varying
		if (isset ($_POST["identificacion_clientes"]) )
		{

			$_id_tipo_identificacion     = $_POST["id_tipo_identificacion"];
			$_identificacion_clientes      = $_POST["identificacion_clientes"];
			$_nombres_clientes   = $_POST["nombres_clientes"];
			
			if(isset($_POST["id_clientes"]))
			{
	
				$_id_clientes = $_POST["id_clientes"];
					
				$colval = " id_tipo_identificacion = '$_id_tipo_identificacion',  identificacion_clientes = '$_identificacion_clientes', nombres_clientes = '$_nombres_clientes'  ";
				$tabla = "clientes";
				$where = "id_clientes = '$_id_clientes'    ";
					
				$resultado=$clientes->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				$funcion = "ins_clientes";
					
				$parametros = " '$_id_tipo_identificacion' ,'$_identificacion_clientes' , '$_nombres_clientes'";
				$clientes->setFuncion($funcion);
				
				$clientes->setParametros($parametros);
				
				
				$resultado=$clientes->Insert();
				}
				
				$this->redirect("Clientes", "index");
	
			}
				
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Controladores"
	
		));
	
	
	}

	}
	
	public function borrarId()
	{
		
		session_start();
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "Clientes";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
		
		if(isset($_GET["id_clientes"]))
		{
			$id_clientes=(int)$_GET["id_clientes"];
	
			$clientes=new ClientesModel();
				
			$clientes->deleteBy(" id_clientes",$id_clientes);
				
				
		}
	
		$this->redirect("Clientes", "index");
	}
	else
	{
		$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Clientes"
		
		));
	}
	
	}
    
   
	
		
	
}
?>
