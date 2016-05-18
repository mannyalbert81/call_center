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
			
			$tipo_persona = new TipoPersonaModel();
			$resultTipoPer =$tipo_persona->getAll("nombre_tipo_persona");
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
	
			
			$clientes = new ClientesModel();

			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$columnas = " clientes.id_clientes, tipo_identificacion.nombre_tipo_identificacion,tipo_identificacion.id_tipo_identificacion, clientes.identificacion_clientes, clientes.nombres_clientes, clientes.telefono_clientes, clientes.celular_clientes, clientes.direccion_clientes, ciudad.nombre_ciudad, ciudad.id_ciudad, tipo_persona.nombre_tipo_persona, tipo_persona.id_tipo_persona";
					$tablas   = "public.clientes, public.ciudad, public.tipo_persona, public.tipo_identificacion";
					$where    = "clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND clientes.id_ciudad = ciudad.id_ciudad AND clientes.id_tipo_persona = tipo_persona.id_tipo_persona";
					$id       = "clientes.identificacion_clientes"; 
			
				
					$resultSet=$clientes->getCondiciones($columnas ,$tablas ,$where, $id);
					
					
					$resultEdit = "";
			
					if (isset ($_GET["id_clientes"])   )
					{
						$_id_clientes = $_GET["id_clientes"];
					    $where    = " clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND clientes.id_ciudad = ciudad.id_ciudad AND clientes.id_tipo_persona = tipo_persona.id_tipo_persona AND clientes.id_clientes = '$_id_clientes' "; 
						$resultEdit = $clientes->getCondiciones($columnas ,$tablas ,$where, $id); 
					
						$traza=new TrazasModel();
						$_nombre_controlador = "Clientes";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_clientes;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
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
				
					$columnas = " clientes.id_clientes, tipo_identificacion.nombre_tipo_identificacion, clientes.identificacion_clientes, clientes.nombres_clientes, clientes.telefono_clientes, clientes.celular_clientes, clientes.direccion_clientes, ciudad.nombre_ciudad, tipo_persona.nombre_tipo_persona";
					$tablas   = "public.clientes, public.ciudad, public.tipo_persona, public.tipo_identificacion";
					$where    = "clientes.id_tipo_identificacion = tipo_identificacion.id_tipo_identificacion AND clientes.id_ciudad = ciudad.id_ciudad AND clientes.id_tipo_persona = tipo_persona.id_tipo_persona";
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
								$where_0 = "OR  clientes.nombres_clientes LIKE '$contenido'   OR clientes.identificacion_clientes LIKE '$contenido'";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  clientes.nombres_clientes LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND clientes.identificacion_clientes LIKE '$contenido'  ";
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
					"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultMenu"=>$resultMenu, "resultTipoIdent"=> $resultTipoIdent, "resultTipoPer"=> $resultTipoPer, "resultCiu"=>$resultCiu
			
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
			$_telefono_clientes   = $_POST["telefono_clientes"];
			$_celular_clientes   = $_POST["celular_clientes"];
			$_direccion_clientes   = $_POST["direccion_clientes"];
			$_id_ciudad   = $_POST["id_ciudad"];
			$_id_tipo_persona   = $_POST["id_tipo_persona"];
			
			if(isset($_POST["id_clientes"]))
			{
	
				$_id_clientes = $_POST["id_clientes"];
					
				$colval = " id_tipo_identificacion = '$_id_tipo_identificacion',  identificacion_clientes = '$_identificacion_clientes', nombres_clientes = '$_nombres_clientes', telefono_clientes = '$_telefono_clientes', celular_clientes = '$_celular_clientes', direccion_clientes = '$_direccion_clientes', id_ciudad = '$_id_ciudad', id_tipo_persona = '$_id_tipo_persona'  ";
				$tabla = "clientes";
				$where = "id_clientes = '$_id_clientes'    ";
					
				$resultado=$clientes->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				$funcion = "ins_clientes";
					
				$parametros = " '$_id_tipo_identificacion' ,'$_identificacion_clientes' , '$_nombres_clientes' , '$_telefono_clientes' , '$_celular_clientes' , '$_direccion_clientes' , '$_id_ciudad' , '$_id_tipo_persona'";
				$clientes->setFuncion($funcion);
				
				$clientes->setParametros($parametros);
				
				
				$resultado=$clientes->Insert();
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Clientes";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombres_clientes;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
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
		
			$traza=new TrazasModel();
			$_nombre_controlador = "Clientes";
			$_accion_trazas  = "Borrar";
			$_parametros_trazas = $id_clientes;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
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
    
   
	
	
	public function ImportacionClientes(){
	
	
	
		//Creamos el objeto usuario
		//$recaudacion_cabeza = new RecaudacionCabezaModel();
		//$recaudacion_institucion = new RecaudacionInstitucionModel();
	
		$clientes = new ClientesModel();
	
	
		//$columnas = "recaudacion_cabeza.id_recaudacion_cabeza, recaudacion_cabeza.id_recaudacion_institucion, recaudacion_institucion.nombre_recaudacion_institucion, recaudacion_cabeza.fecha_creacion_recaudacion_cabeza, recaudacion_cabeza.hora_creacion_recaudacion_cabeza,  recaudacion_cabeza.cantidad_registros_recaudacion_cabeza, recaudacion_cabeza.valor_total_dolares_recaudacion_cabeza,  recaudacion_cabeza.creado";
		//$tablas   = "public.recaudacion_institucion, public.recaudacion_cabeza";
		//$where    = "recaudacion_cabeza.id_recaudacion_institucion = recaudacion_institucion.id_recaudacion_institucion";
		//$id = "fecha_creacion_recaudacion_cabeza , hora_creacion_recaudacion_cabeza";
		//$id_dos = "nombre_recaudacion_institucion";
	
	//	$resultSet=$recaudacion_cabeza->getCondiciones($columnas, $tablas, $where, $id);
		//$resultInsRec = $recaudacion_institucion->getAll($id_dos);
	
	
	
		$resultEdit = "";
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
	
	
			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			$mensaje = "";
			$fecha_proceso_anterior = "";
			$_id_tipo_identificacion = 0;
			
			if (!empty($resultPer))
			{
				if (isset ($_POST["procesar"]) )
				{
					$clientes = new ClientesModel();
					$tipo_identificacion = new TipoIdentificacionModel();
					$directorio = $_SERVER['DOCUMENT_ROOT'].'/cartera/';
	
					$nombre = $_FILES['archivo']['name'];
					$tipo = $_FILES['archivo']['type'];
					$tamano = $_FILES['archivo']['size'];
					move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
				
					
					$contador = 0;
					$contador_linea = 0;
						
					//$encabezado_linea = "";
					$contenido_linea = "";
						
					$lectura_linea = "";
					
					$file = fopen($directorio.$nombre, "r") or exit("Unable to open file!");
						
					while(!feof($file))
					{
						$contador = $contador + 1;
						
						if ($contador > 0) ///INSERTO EL ENCABEZADO
						{
							
							$lectura_linea =  fgets($file) ;
							//$encabezado_linea = fgets($file) ;
							
							
							
							$funcion = "ins_clientes";
	
							$_identificacion =substr($lectura_linea,0,1);
							if ($_identificacion == "R")
							{
								$_nombre_tipo_identificacion = "RUC";
								
							}
							if ($_identificacion == "C")
							{
								$_nombre_tipo_identificacion = "CEDULA";
							
							}
							if ($_identificacion == "P")
							{
								$_nombre_tipo_identificacion = "PASAPORT";
									
							}
							$where = "nombre_tipo_identificacion = '$_nombre_tipo_identificacion' ";
							
							$resultIdent = $tipo_identificacion->getBy($where);

							foreach($resultIdent as $res) 
							{
								
								$_id_tipo_identificacion =   $res->id_tipo_identificacion; 
							}
								        		
									    
							if ($_id_tipo_identificacion > 0)
							{
							
							$_identificacion_clientes = substr($lectura_linea,1,13);
							$_nombres_clientes = substr($lectura_linea,14,100);
							$_telefono_clientes = substr($lectura_linea,114,124);
							$_celular_clientes = substr($lectura_linea,124,134);
							$_direccion_clientes = substr($lectura_linea,134,200);
							$_id_ciudad = substr($lectura_linea,234,5);
							$_id_tipo_persona = substr($lectura_linea,239,1);
								
							$parametros = " '$_id_tipo_identificacion' ,'$_identificacion_clientes' , '$_nombres_clientes' , '$_telefono_clientes' , '$_celular_clientes', '$_direccion_clientes', '$_id_ciudad' , '$_id_tipo_persona' ";
							$clientes->setFuncion($funcion);
							$clientes->setParametros($parametros);
								
						
							
								try {
	
									$resultado=$clientes->Insert();
	
	
								} catch (Exception $e) {
	
									$this->view("Error",array(
											"resultado"=>$e
									));
	
	
								
							  }
							}	
								
						}
	
						
	
					}
						
					fclose ($file);
						
						
				}
					
					
				$this->view("ImportacionClientes",array(
						"resultEdit" =>$resultEdit, "mensaje"=>$mensaje
							
				));
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Importar Clientes"
	
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
	
		
	
}
?>
