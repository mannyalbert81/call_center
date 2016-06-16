<?php

class OficiosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$oficios= new OficiosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$oficios->getAll("id_oficios");
		
		$entidades = new EntidadesModel();
		$resultEnt = $entidades->getAll("nombre_entidades");
				
		$resultEdit = "";

		
		$oficios= new OficiosModel();
		
		
		$columnas = " clientes.id_clientes,
				juicios.id_juicios,
								  clientes.identificacion_clientes,
								  clientes.nombres_clientes,
								  juicios.juicio_referido_titulo_credito";
		
		$tablas   = " public.clientes,
                                  public.juicios";
		
		$where    = "juicios.id_clientes = clientes.id_clientes";
		
		$id       = "juicios.juicio_referido_titulo_credito";
		
		$resultDatos=$oficios->getCondiciones($columnas ,$tablas ,$where, $id);
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Oficios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $oficios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_GET["id_oficios"])   )
				{

					$nombre_controladores = "Oficios";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $oficios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_oficios = $_GET["id_oficios"];
						
						$columnas = " id_oficios, nombre_oficios";
						$tablas   = "oficios";
						$where    = "id_oficios = '$_id_oficios' "; 
						$id       = "nombre_oficios";
							
						$resultEdit = $oficios->getCondiciones($columnas ,$tablas ,$where, $id);

						$traza=new TrazasModel();
						$_nombre_controlador = "Oficios";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_oficios;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Tipos de Identificaciones"
					
						));
					
					
					}
					
				}
		
				if(isset($_POST["buscar"])){
						
					$criterio_busqueda=$_POST["criterio_busqueda"];
					$contenido_busqueda=$_POST["contenido_busqueda"];
						
					$oficios= new OficiosModel(); 
						
						
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
				
						
					$resultDatos=$oficios->getCondiciones($columnas ,$tablas ,$where_to, $id);
						
						
				}
				
				
				
				
				$this->view("Oficios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultDatos" =>$resultDatos, "resultEnt" =>$resultEnt
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a oficios"
				
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
	
	public function InsertaOficios(){
			
		session_start();

		
		$oficios=new OficiosModel();
		$nombre_controladores = "Oficios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $oficios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		$resultado = null;
			$oficios=new OficiosModel();
				
			if (isset ($_POST["Guardar"]) )
				
			{
			 $_array_juicios = $_POST["id_juicios"];
			 $_nombre_oficios = $_POST["nombre_oficios"];
			 $_id_entidades = $_POST["id_entidades"];
				
					foreach($_array_juicios  as $id  )
					{
						if (!empty($id) )
						{
							//busco si exties este nuevo id
							try
							{
								$_id_juicios = $id;
								
								$anio=date("Y");
								$col_prefijo="prefijos.id_prefijos,prefijos.nombre_prefijos,prefijos.consecutivo";
								$tbl_prefijo="public.prefijos";
								$whre_prefijo="prefijos.nombre_prefijos='OFI'";
								
								$resultprefijo=$oficios->getCondiciones($col_prefijo, $tbl_prefijo, $whre_prefijo, "prefijos.id_prefijos");
								
								$id_prefijo=$resultprefijo[0]->id_prefijos;
								
								$consecutivo_oficio=(int)$resultprefijo[0]->consecutivo;
								$consecutivo_oficio=$consecutivo_oficio+1;
								$numero_oficio=$consecutivo_oficio."-".$anio;
								
								
								$funcion = "ins_oficios";
								$parametros = "'$_nombre_oficios','$numero_oficio', '$_id_juicios', '$_id_entidades' ";
								$oficios->setFuncion($funcion);
		                        $oficios->setParametros($parametros);
					            $resultado=$oficios->Insert();
					            
					            $prefijos=new PrefijosModel();
					            $colval="consecutivo=consecutivo+1";
					            $tabla="prefijos";
					            $where="id_prefijos='$id_prefijo'";
					             
					            $resultado=$prefijos->UpdateBy($colval, $tabla, $where);
		                      
							} catch (Exception $e)
							{
								$this->view("Error",array(
										"resultado"=>"Eror al Asignar ->". $id
								));
							}
								
						}
					
					}
					
				$traza=new TrazasModel();
				$_nombre_controlador = "Oficios";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_oficios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			$this->redirect("Oficios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Oficios"
		
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
			if(isset($_GET["id_oficios"]))
			{
				$id_oficios=(int)$_GET["id_oficios"];
				
				$oficios=new OficiosModel();
				
				$oficios->deleteBy(" id_oficios",$id_oficios);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Oficios";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_oficios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("Oficios", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Oficios"
			
			));
		}
				
	}
	
	public function consulta(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getAll("nombre_ciudad");
	
		$oficios = new OficiosModel();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "Oficios";
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
	
	
	
	
				$this->view("ConsultaOficios",array(
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