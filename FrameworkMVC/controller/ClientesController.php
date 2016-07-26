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

			//NOTIFICACIONES
			$clientes->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $clientes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
			
					$columnas = " clientes.id_clientes, tipo_identificacion.nombre_tipo_identificacion,tipo_identificacion.id_tipo_identificacion, clientes.identificacion_clientes, clientes.nombres_clientes, clientes.telefono_clientes, clientes.celular_clientes, clientes.direccion_clientes, ciudad.nombre_ciudad, ciudad.id_ciudad, tipo_persona.nombre_tipo_persona, tipo_persona.id_tipo_persona, clientes.nombre_garantes, clientes.identificacion_garantes";
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
			
			
			$resultPerVer= $clientes->getPermisosVer("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPerVer))
			{
				if (isset ($_POST["criterio"])  && isset ($_POST["contenido"])  )
				{
				
					$columnas = " clientes.id_clientes, 
							tipo_identificacion.nombre_tipo_identificacion, 
							clientes.identificacion_clientes, 
							clientes.nombres_clientes, 
							clientes.telefono_clientes, 
							clientes.celular_clientes, 
							clientes.direccion_clientes, 
							ciudad.nombre_ciudad, 
							tipo_persona.nombre_tipo_persona, 
							clientes.nombre_garantes, 
							clientes.identificacion_garantes";
					
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
		
		session_start();
		$clientes=new ClientesModel();

		$nombre_controladores = "Clientes";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $clientes->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			$clientes=new ClientesModel();
			$resultado = null;
		
		
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
			$_nombre_garantes   = $_POST["nombre_garantes"];
			$_identificacion_garantes   = $_POST["identificacion_garantes"];
			
			if(isset($_POST["id_clientes"]))
			{
	
				$_id_clientes = $_POST["id_clientes"];
					
				$colval = " id_tipo_identificacion = '$_id_tipo_identificacion',  identificacion_clientes = '$_identificacion_clientes', nombres_clientes = '$_nombres_clientes', telefono_clientes = '$_telefono_clientes', celular_clientes = '$_celular_clientes', direccion_clientes = '$_direccion_clientes', id_ciudad = '$_id_ciudad', id_tipo_persona = '$_id_tipo_persona', nombre_garantes = '$_nombre_garantes', identificacion_garantes = '$_identificacion_garantes'  ";
				$tabla = "clientes";
				$where = "id_clientes = '$_id_clientes'    ";
					
				$resultado=$clientes->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				$funcion = "ins_clientes";
					
				$parametros = " '$_id_tipo_identificacion' ,'$_identificacion_clientes' , '$_nombres_clientes' , '$_telefono_clientes' , '$_celular_clientes' , '$_direccion_clientes' , '$_id_ciudad' , '$_id_tipo_persona' , '$_nombre_garantes' , '$_identificacion_garantes'";
				$clientes->setFuncion($funcion);
				
				$clientes->setParametros($parametros);
				$resultado=$clientes->Insert();
			    
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Clientes";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombres_clientes;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				}
				
				
			}
			$this->redirect("Clientes", "index");
			
		}
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Clientes"
	
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
	
	    $clientes = new ClientesModel();
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
					$ciudad = new CiudadModel();
					$tipo_identificacion = new TipoIdentificacionModel();
					$tipo_persona= new TipoPersonaModel();
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
	
							$_id_tipo_identificacion =substr($lectura_linea,0,1);
							
							if ($_id_tipo_identificacion == "C")
							{
								$_nombre_tipo_identificacion = "CEDULA";
								
							}
							if ($_id_tipo_identificacion == "R")
							{
								$_nombre_tipo_identificacion = "RUC";
							
							}
							if ($_id_tipo_identificacion == "P")
							{
								$_nombre_tipo_identificacion = "PASAPORTE";
									
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
							$_nombres_clientes = trim(substr($lectura_linea,14,100));
							$_telefono_clientes = substr($lectura_linea,114,10);
							$_celular_clientes = substr($lectura_linea,124,10);
							$_direccion_clientes = trim(substr($lectura_linea,134,200));
							
							
							$_id_ciudad =substr($lectura_linea,334,5);
							
							
								
							$where = "codigo_ciudad = '$_id_ciudad' ";
								
								
							$resultCiu = $ciudad->getBy($where);
							
							foreach($resultCiu as $res)
							{
							
								$_id_ciudad =   $res->id_ciudad;
							}
							
							
							
							$_id_tipo_persona = substr($lectura_linea,339,1);
							
							if ($_id_tipo_persona == "N")
							{
								$_nombre_tipo_persona = "NATURAL";
									
							}
							if ($_id_tipo_persona == "J")
							{
								$_nombre_tipo_persona = "JURIDICA";
									
							}
								
							
							$where = "nombre_tipo_persona = '$_nombre_tipo_persona' ";
							
							
							$resultTipoPer = $tipo_persona->getBy($where);
								
							foreach($resultTipoPer as $res)
							{
									
								$_id_tipo_persona =   $res->id_tipo_persona;
							}
							
							
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
	
	
	public function ReporteClientes(){
	
		session_start();
		
		//$id_clientes=$_GET['id_clientes'];
		//echo "<a href='/FrameworkMVC/view/ireports/ContClientesSubReport.php?id_clientes=".$id_clientes."' target='/FrameworkMVC/view/ireports/ContClientesSubReport.php' onclick=\"window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false;\">Reporte</a>";
		    //echo "<a href='tuArchivo.php?variablePorURL=".$variablePorURL."' target='tuArchivo' onclick=\"window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false;\"> Contrato </a>";
		
		//$this->ireport("ContClientes");
		
	
	}
	
	public function consulta(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
	
		$citaciones = new CitacionesModel();
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Clientes";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $citaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){
	
					$id_ciudad=$_POST['id_ciudad'];
					$identificacion=$_POST['identificacion'];
					$numero_juicio=$_POST['numero_juicio'];
					$titulo_credito=$_POST['numero_titulo'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
	
					$citaciones= new CitacionesModel();
	
	
					$columnas = "juicios.id_juicios,
					clientes.id_clientes,
  					clientes.nombres_clientes,
  					clientes.identificacion_clientes,
  					ciudad.nombre_ciudad,
  					tipo_persona.nombre_tipo_persona,
  					juicios.juicio_referido_titulo_credito,
  					usuarios.nombre_usuarios,
  					titulo_credito.id_titulo_credito,
  					etapas_juicios.nombre_etapas,
  					tipo_juicios.nombre_tipo_juicios,
  					juicios.creado,
  					titulo_credito.total";
	
					$tablas="public.clientes,
					  public.ciudad,
					  public.tipo_persona,
					  public.juicios,
					  public.titulo_credito,
					  public.etapas_juicios,
					  public.tipo_juicios,
					  public.usuarios";
	
					$where="ciudad.id_ciudad = clientes.id_ciudad AND
					  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
					  juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
					  juicios.id_clientes = clientes.id_clientes AND
					  juicios.id_tipo_juicios = tipo_juicios.id_tipo_juicios AND
					  etapas_juicios.id_etapas_juicios = juicios.id_etapas_juicios AND
					  usuarios.id_usuarios=juicios.id_usuarios";
	
					$id="juicios.id_juicios";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
	
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
	
					if($identificacion!=""){$where_2=" AND clientes.identificacion='$identificacion'";}
	
					if($titulo_credito!=""){$where_3=" AND juicios.id_titulo_credito='$titulo_credito'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  juicios.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
				}
	                    $this->view("ConsultaClientes",array(
						"resultSet"=>$resultSet,"resultCiu"=>$resultCiu
							
				));
	
	         }
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Citaciones"
	
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
