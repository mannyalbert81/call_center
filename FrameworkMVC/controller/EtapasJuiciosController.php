<?php

class EtapasJuiciosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$etapas_juicios = new EtapasJuiciosModel(); 
		
	   //Conseguimos todos los usuarios
		$resultSet=$etapas_juicios->getAll("id_etapas_juicios");
				
		$resultEdit = "";

		
		session_start();
		

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{

			//Notificaciones
			$etapas_juicios->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$nombre_controladores = "EtapasJuicios";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $etapas_juicios->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				
				
				if (isset ($_GET["id_etapas_juicios"])   )
				{
					
					$nombre_controladores = "EtapasJuicios";
					$id_rol= $_SESSION['id_rol'];
					$resultPer = $etapas_juicios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
						
					if (!empty($resultPer))
					{
					
						$_id_etapas_juicios = $_GET["id_etapas_juicios"];
						$columnas = " id_etapas_juicios, nombre_etapas";
						$tablas   = "etapas_juicios";
						$where    = "id_etapas_juicios = '$_id_etapas_juicios' "; 
						$id       = "nombre_etapas";
							
						
						$resultEdit = $etapas_juicios->getCondiciones($columnas ,$tablas ,$where, $id);
						
						
						$traza=new TrazasModel();
						$_nombre_controlador = "Etapas Juicios";
						$_accion_trazas  = "Editar";
						$_parametros_trazas = $_id_etapas_juicios;
						$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
					
					}
					else
					{
						$this->view("Error",array(
								"resultado"=>"No tiene Permisos de Editar Etapas Juicios"
					
						));
					
					
					}
					
				}
		
				
				$this->view("EtapasJuicios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Etapas Juicios"
				
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
	
	public function InsertaEtapasJuicios(){
			
		session_start();
        $permisos_rol=new PermisosRolesModel();
        $etapas_juicios = new EtapasJuiciosModel(); 
        $permisos_rol=new PermisosRolesModel();

		$nombre_controladores = "EtapasJuicios";
		$id_rol= $_SESSION['id_rol'];
         $resultPer = $etapas_juicios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			
			$etapas_juicios = new EtapasJuiciosModel(); 
		
			//_nombre_controladores
			
			if (isset ($_POST["nombre_etapas"]) )
				
			{
				
				
				
				$_nombre_etapas = $_POST["nombre_etapas"];
				
				
				if(isset($_POST["id_etapas_juicios"])) 
				{
					
					$_id_etapas_juicios = $_POST["id_etapas_juicios"];
					
					$colval = " nombre_etapas = '$_nombre_etapas'   ";
					$tabla = "etapas_juicios";
					$where = "id_etapas_juicios = '$_id_etapas_juicios'    ";
					
					$resultado=$etapas_juicios->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			
				
				$funcion = "ins_etapas_juicios";
				
				$parametros = " '$_nombre_etapas'  ";
					
				$etapas_juicios->setFuncion($funcion);
		
				$etapas_juicios->setParametros($parametros);
		
		
				$resultado=$etapas_juicios->Insert();
			
				$traza=new TrazasModel();
				$_nombre_controlador = "Etapas Juicios";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_etapas;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			 }
		
			}
			$this->redirect("EtapasJuicios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Etapas Juicios"
		
			));
		
		
		}
		
	}
	
	
	public function ActualizarEtapasJuicios(){
	
		session_start();
	
		$resultado = null;
		$notificaciones = new NotificacionesModel();
		$tipo_notificacion = new TipoNotificacionModel();
		$permisos_rol=new PermisosRolesModel();
		$etapas_juicios = new EtapasJuiciosModel(); 
		$nombre_controladores = "EtapasJuicios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $etapas_juicios->getPermisosEditar("   nombre_controladores = '$nombre_controladores' AND id_rol = '$id_rol' " );
	
		if (!empty($resultPer))
		{
				
	
			if (isset ($_POST["actualizar"])   )
			{
	
	
				$_array_juicios = $_POST["id_juicios"];
				$_id_etapas_juicios = $_POST["id_etapas_juicios"];
				$_usuario_registra = $_SESSION['id_usuarios'];
				
	
				foreach($_array_juicios  as $id  )
				{
						
					if (!empty($id) )
					{
						//busco si existe este nuevo id
						try
						{
							//capturar id de impulsor de titulo credito
							$_id_juicios = $id;
						
							$funcion = "ins_actualizar_etapas_juicios";
							$parametros = "'$_id_juicios','$_id_etapas_juicios', '$_usuario_registra'";
							$etapas_juicios->setFuncion($funcion);
							$etapas_juicios->setParametros($parametros);
							$resultado=$etapas_juicios->Insert();
							
							
							$traza=new TrazasModel();
							$_nombre_controlador = "EtapasJuicios";
							$_accion_trazas  = "Guardar";
							$_parametros_trazas = $_id_juicios;
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
							
							
							
							$res=$etapas_juicios->UpdateBy("id_etapas_juicios='$_id_etapas_juicios'", "juicios", "id_juicios='$_id_juicios'");
							
							
						} catch (Exception $e)
						{
							$this->view("Error",array(
									"resultado"=>"Eror al Asignar ->". $id
							));
						}
						
					
							
					}
	
				}
				
	
	
			}
				
	
			$this->redirect("EtapasJuicios", "consulta_juicios");
	
				
		}
		else
		{
			$this->view("Error",array(
					"resultado"=>"No tiene Permisos para Actualizar Etapas Juicios"
	
			));
	
		}
	
	}
	
	
	
	public function consulta_juicios(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
		
		$etapa_juicios = new EtapasJuiciosModel();
		$resultEtapas =$etapa_juicios->getAll("nombre_etapas");
		
		
		
		$ciudad = new CiudadModel();
	
	
		$_id_usuarios= $_SESSION["id_usuarios"];
	
		$columnas = " usuarios.id_ciudad,
					  ciudad.nombre_ciudad,
					  usuarios.nombre_usuarios";
			
		$tablas   = "public.usuarios,
                     public.ciudad";
			
		$where    = "ciudad.id_ciudad = usuarios.id_ciudad AND usuarios.id_usuarios = '$_id_usuarios'";
			
		$id       = "usuarios.id_ciudad";
	
			
		$resultDatos=$ciudad->getCondiciones($columnas ,$tablas ,$where, $id);
	
		$citaciones = new CitacionesModel();
	
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "EtapasJuicios";
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
  					asignacion_secretarios_view.impulsores,
  					asignacion_secretarios_view.secretarios,
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
					  public.asignacion_secretarios_view";
	
					$where="ciudad.id_ciudad = clientes.id_ciudad AND
					tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
					juicios.id_titulo_credito = titulo_credito.id_titulo_credito AND
					juicios.id_clientes = clientes.id_clientes AND
					juicios.id_tipo_juicios = tipo_juicios.id_tipo_juicios AND
					etapas_juicios.id_etapas_juicios = juicios.id_etapas_juicios AND
					juicios.id_usuarios= asignacion_secretarios_view.id_abogado AND juicios.id_usuarios ='$_id_usuarios'";
	
					$id="juicios.id_juicios";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
	
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
	
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
	
					if($titulo_credito!=""){$where_3=" AND juicios.id_titulo_credito='$titulo_credito'";}
	
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  juicios.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;
	
	
					$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	
				}
				
				if(isset($_POST["actualizar"])){
				
					$id_ciudad=$_POST['id_etapas_juicios'];
				  
				}
	
	
	
	
				$this->view("ActualizaEtapasJuicios",array(
						"resultSet"=>$resultSet,"resultDatos"=>$resultDatos, "resultEtapas"=>$resultEtapas
							
				));
	
	
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Actualizar Etapas Juicios"
	
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
	
	
	
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "EtapasJuicios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_etapas_juicios"]))
			{
				$id_etapas_juicios=(int)$_GET["id_etapas_juicios"];
				
				$etapas_juicios = new EtapasJuiciosModel(); 
				
				$etapas_juicios->deleteBy(" id_etapas_juicios", $id_etapas_juicios);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Etapas Juicios";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_etapas_juicios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("EtapasJuicios", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Etapas Juicios"
			
			));
		}
				
	}
	
	
	
	
	
	
}
?>