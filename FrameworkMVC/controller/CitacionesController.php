<?php

class CitacionesController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$citaciones= new CitacionesModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$citaciones->getAll("id_citaciones");
		
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
		
		$tipo_citaciones = new TipoCitacionesModel();
		$resultTipoCit =$tipo_citaciones->getAll("nombre_tipo_citaciones");
		
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
		$id="rol.id_rol";
		
		$usuarios = new UsuariosModel();
		
		$where="rol.nombre_rol='CITADOR JUDICIAL'";
		$resultUsuarios=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
		
		
		$resultEdit = "";

		
		$citaciones= new CitacionesModel();
		
		
		$columnas = " clientes.id_clientes,
				juicios.id_juicios,
								  clientes.identificacion_clientes,
								  clientes.nombres_clientes,
								  juicios.juicio_referido_titulo_credito";
		
		$tablas   = " public.clientes,
                                  public.juicios";
		
		$where    = "juicios.id_clientes = clientes.id_clientes";
		
		$id       = "juicios.juicio_referido_titulo_credito";
		
		$resultDatos=$citaciones->getCondiciones($columnas ,$tablas ,$where, $id);
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Citaciones";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $citaciones->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_citaciones"])   )
				{

					$nombre_controladores = "Citaciones";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $citaciones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_citaciones = $_GET["id_citaciones"];
						
						$columnas = " id_citaciones";
						$tablas   = "citaciones";
						$where    = "id_citaciones = '$_id_citaciones' "; 
						$id       = "nombre_citaciones";
							
						$resultEdit = $citaciones->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Citaciones";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_citaciones;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Citaciones"
					
						));
					
					
					}
					
				}
		
				if(isset($_POST["buscar"])){
						
					$criterio_busqueda=$_POST["criterio_busqueda"];
					$contenido_busqueda=$_POST["contenido_busqueda"];
						
					$citaciones= new CitacionesModel(); 
						
						
					$columnas = " clientes.id_clientes,
							juicios.id_juicios,
								  clientes.identificacion_clientes, 
								  clientes.nombres_clientes, 
								  juicios.juicio_referido_titulo_credito";
						
					$tablas   = " public.clientes, 
                                  public.juicios";
						
					$where    = "juicios.id_clientes = clientes.id_clientes";
						
					$id       = "juicios.juicio_referido_titulo_credito";
						
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					
						
					switch ($criterio_busqueda) {
							
						case 0:
							// identificacion de cliente
							$where_0 = " ";
							break;
						case 1:
							// identificacion de cliente
							$where_1 = " AND  clientes.identificacion_clientes LIKE '$contenido_busqueda'  ";
							break;
						case 2:
							//id_titulo de credito
							$where_2 = " AND  juicios.juicio_referido_titulo_credito = '$contenido_busqueda'  ";
							break;
				
						
								
					}
						
						
						
					$where_to  = $where . $where_0 . $where_1 . $where_2 ;
				
						
					$resultDatos=$citaciones->getCondiciones($columnas ,$tablas ,$where_to, $id);
						
						
				}
				
				
				
				
				$this->view("Citaciones",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultDatos" =>$resultDatos, "resultTipoCit"=> $resultTipoCit, "resultCiu"=>$resultCiu, "resultUsuarios"=>$resultUsuarios
			
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
	
	public function InsertaCitaciones(){
			
		session_start();

		
		$citaciones=new CitacionesModel();
		$nombre_controladores = "Citaciones";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $citaciones->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		$resultado = null;
			$citaciones=new CitacionesModel();
				
			if (isset ($_POST["Guardar"]) )
				
			{
			 $_array_juicios = $_POST["id_juicios"];
			 $_fecha_citaciones = $_POST["fecha_citaciones"];
			 $_id_ciudad = $_POST["id_ciudad"];
			 $_id_tipo_citaciones = $_POST["id_tipo_citaciones"];
			 $_nombre_persona_recibe_citaciones = $_POST["nombre_persona_recibe_citaciones"];
			 $_relacion_cliente_citaciones = $_POST["relacion_cliente_citaciones"];
			 $_id_usuarios = $_POST["id_usuarios"];
			
			
			 
			 
					foreach($_array_juicios  as $id  )
					{
						if (!empty($id) )
						{
							//busco si exties este nuevo id
							try
							{
								$_id_juicios = $id;
								
								
								
								$funcion = "ins_citaciones";
								$parametros = "'$_id_juicios', '$_fecha_citaciones', '$_id_ciudad', '$_id_tipo_citaciones', '$_nombre_persona_recibe_citaciones', '$_relacion_cliente_citaciones', '$_id_usuarios' ";
								$citaciones->setFuncion($funcion);
		                        $citaciones->setParametros($parametros);
					            $resultado=$citaciones->Insert();
					         
		                       
		                        
							} catch (Exception $e)
							{
								$this->view("Error",array(
										"resultado"=>"Eror al Asignar ->". $id
								));
							}
								
						}
					
					}
					
				$traza=new TrazasModel();
				$_nombre_controlador = "Citaciones";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_id_juicios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			$this->redirect("Citaciones", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Citaciones"
		
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
			if(isset($_GET["id_citaciones"]))
			{
				$id_citaciones=(int)$_GET["id_citaciones"];
				
				$citaciones=new OficiosModel();
				
				$citaciones->deleteBy(" id_citaciones",$id_citaciones);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Citaciones";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_citaciones;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("Citaciones", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Citaciones"
			
			));
		}
				
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
			$nombre_controladores = "Citaciones";
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
	
	
					$columnas = "citaciones.id_citaciones,
					juicios.id_juicios,
  					juicios.juicio_referido_titulo_credito, 
 					clientes.nombres_clientes, 
  					clientes.identificacion_clientes, 
  					citaciones.fecha_citaciones, 
  					ciudad.nombre_ciudad, 
  					ciudad.id_ciudad, 
  					tipo_citaciones.id_tipo_citaciones, 
  					tipo_citaciones.nombre_tipo_citaciones, 
  					citaciones.nombre_persona_recibe_citaciones, 
  					citaciones.relacion_cliente_citaciones, 
  					usuarios.nombre_usuarios";
		
					$tablas=" public.citaciones, 
  					public.juicios, 
  					public.ciudad, 
  					public.tipo_citaciones, 
  					public.usuarios, 
  					public.clientes";
		
					$where="juicios.id_juicios = citaciones.id_juicios AND
  					ciudad.id_ciudad = citaciones.id_ciudad AND
  					tipo_citaciones.id_tipo_citaciones = citaciones.id_tipo_citaciones AND
  					usuarios.id_usuarios = citaciones.id_usuarios AND
  					clientes.id_clientes = juicios.id_clientes";
		
					$id="citaciones.id_citaciones";
			
					
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
						
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
					
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
					
					if($identificacion!=""){$where_2=" AND clientes.identificacion='$identificacion'";}
					
					if($titulo_credito!=""){$where_3=" AND juicios.id_titulo_credito='$titulo_credito'";}
					
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  distribucion_gastos.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
				}
	
	
	
	
				$this->view("ConsultaCitaciones",array(
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