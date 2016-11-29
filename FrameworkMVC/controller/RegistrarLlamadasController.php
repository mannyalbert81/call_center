<?php
class RegistrarLlamadasController extends ControladorBase{
    
    public function __construct() {
        parent::__construct();
    }
    //maycol
public function index(){
	
		session_start();
		$resultSet="";
		
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			$tipo_identificacion = new TipoIdentificacionModel();
			$resultTipoIdent = $tipo_identificacion->getAll("nombre_tipo_identificacion");
			
			$tipo_persona = new TipoPersonaModel();
			$resultTipoPer =$tipo_persona->getAll("nombre_tipo_persona");
			
			$ciudad = new CiudadModel();
			$resultCiu = $ciudad->getAll("nombre_ciudad");
	        
			$clientes = new ClientesModel();
            $registrar_llamadas = new RegistrarLLamadasModel();	
             //NOTIFICACIONES
			$registrar_llamadas->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$estados_procesales = new EstadosProcesalesModel();
			$resultEstPro=$estados_procesales->getAll("id_estados_procesales_juicios");
			
			//para los Abogados
			$resultAbogados = array();
			
			$nombre_controladores = "RegistrarLlamadas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $registrar_llamadas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
				
			if (!empty($resultPer))
			{
				
				$resultEdit="";
				
				if (isset ($_GET["id_clientes"])   )
				{
					   $_id_clientes = $_GET["id_clientes"];
					   

					   $columnas_edit="
					   clientes.nombres_clientes,
					   clientes.telefono_clientes,
					   clientes.celular_clientes,
					   clientes.direccion_clientes,
					   ciudad.nombre_ciudad,
					   ciudad.id_ciudad,
					   clientes.id_clientes,
					   juicios.juicio_referido_titulo_credito,
					   estados_procesales_juicios.id_estados_procesales_juicios,
					   estados_procesales_juicios.nombre_estados_procesales_juicios,
					   asignacion_secretarios.id_abogado_asignacion_secretarios,
					   asignacion_secretarios.id_secretario_asignacion_secretarios,
					   titulo_credito.numero_titulo_credito,
					   titulo_credito.total_saldo_capital_titulo_credito,
					   titulo_credito.total_total_titulo_credito,
					   clientes.identificacion_clientes,
					   clientes.id_tipo_identificacion,
					   tipo_persona.id_tipo_persona, 
                       tipo_persona.nombre_tipo_persona,
					   clientes.nombre_garantes, 
					  clientes.identificacion_garantes, 
					  clientes.telefono_garantes, 
					  clientes.celular_garantes,
					   clientes.nombre_garantes_1, 
					  clientes.identificacion_garantes_1, 
					  clientes.telefono_garantes_1, 
					  clientes.celular_garantes_1";
					   $tablas_edit="
					   public.asignacion_secretarios,
					   public.juicios,
					   public.clientes,
					   public.estados_procesales_juicios,
					   public.titulo_credito,
					   public.ciudad,
					   public.tipo_persona";
					   $where_edit="
					   asignacion_secretarios.id_abogado_asignacion_secretarios = juicios.id_usuarios AND
					   clientes.id_clientes = juicios.id_clientes AND
					   estados_procesales_juicios.id_estados_procesales_juicios = juicios.id_estados_procesales_juicios AND
					   titulo_credito.id_titulo_credito = juicios.id_titulo_credito AND
					   ciudad.id_ciudad = clientes.id_ciudad AND
					   tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
					   clientes.id_clientes='$_id_clientes'";
					   
					   $id_edit="juicios.id_juicios";
					
					$resultEdit = $clientes->getCondiciones($columnas_edit ,$tablas_edit ,$where_edit, $id_edit);
					
					if(!empty($resultEdit))
					{
					$impulsor=$resultEdit[0]->id_abogado_asignacion_secretarios;
					$secretario=$resultEdit[0]->id_secretario_asignacion_secretarios;
					
					$usuarios = new UsuariosModel();
					
					$resultAbogados = $usuarios->getBy("id_usuarios in ('$impulsor','$secretario')");
					}
				
					
				}
			
				if(isset($_POST["buscar"]))
				{
				
					
					$identificacion=$_POST['identificacion'];
					$numero_titulo_credito=$_POST['numero_titulo_credito'];
					
					
					if($identificacion=="" && $numero_titulo_credito=="")
					{
						
					}
					else{
						
				    $columnas = "clientes.id_clientes, 
							  tipo_identificacion.nombre_tipo_identificacion, 
							  clientes.identificacion_clientes, 
							  clientes.nombres_clientes, 
							  clientes.telefono_clientes, 
							  clientes.celular_clientes, 
							  clientes.direccion_clientes, 
							  ciudad.nombre_ciudad, 
							  tipo_persona.nombre_tipo_persona, 
							  clientes.nombre_garantes, 
							  clientes.identificacion_garantes, 
							  clientes.telefono_garantes, 
							  clientes.celular_garantes, 
							  titulo_credito.numero_titulo_credito, 
							  titulo_credito.total_total_titulo_credito, 
							  juicios.juicio_referido_titulo_credito, 
							  usuarios.nombre_usuarios,
				    		  ciudad.id_ciudad, 
							  tipo_persona.id_tipo_persona, 
							  tipo_identificacion.id_tipo_identificacion";
				
					$tablas=" public.clientes, 
							  public.ciudad, 
							  public.tipo_persona, 
							  public.tipo_identificacion, 
							  public.titulo_credito, 
							  public.juicios, 
							  public.usuarios";
				
					$where="clientes.id_ciudad = ciudad.id_ciudad AND
						  clientes.id_tipo_persona = tipo_persona.id_tipo_persona AND
						  clientes.id_clientes = titulo_credito.id_clientes AND
						  tipo_identificacion.id_tipo_identificacion = clientes.id_tipo_identificacion AND
						  titulo_credito.id_titulo_credito = juicios.id_titulo_credito AND
						  usuarios.id_usuarios = juicios.id_usuarios";
				
					$id="clientes.id_clientes";
				
				
					$where_0 = "";
					$where_1 = "";
				
					if($identificacion!=""){$where_0=" AND clientes.identificacion_clientes='$identificacion'";}
					if($numero_titulo_credito!=""){$where_1=" AND titulo_credito.numero_titulo_credito='$numero_titulo_credito'";}
				
					
					$where_to  = $where . $where_0 . $where_1;
					
					$resultSet = $clientes->getCondiciones($columnas, $tablas, $where_to, $id);
					
					
					}
				
				}
				
				$this->view("RegistrarLlamadas",array(
					"resultSet"=>$resultSet, "resultEdit"=>$resultEdit, "resultTipoIdent"=> $resultTipoIdent,
					"resultTipoPer"=> $resultTipoPer, "resultCiu"=>$resultCiu ,"resultAbogados"=>$resultAbogados,
					"resultEstPro"=>$resultEstPro
						
			));
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Registrar Llamadas"
			
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
	
	public function InsertaRegistrarLlamadas(){
		
		session_start();
		$registrar_llamadas = new RegistrarLLamadasModel();	

		$nombre_controladores = "RegistrarLlamadas";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $registrar_llamadas->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
			$registrar_llamadas = new RegistrarLLamadasModel();
			$resultado = null;
		
		
		if (isset ($_POST["Guardar"]) )
		{

			$_id_clientes     = $_POST["id_clientes"];
			$_id_usuario_registra_llamada      = $_SESSION['id_usuarios'];
			$_fecha_registrar_llamadas   = $_POST["fecha_registrar_llamadas"];
			$_hora_registrar_llamadas   = $_POST["hora_registrar_llamadas"];
			$_recibio_registrar_llamadas   = $_POST["recibio_registrar_llamadas"];
			$_persona_contesta_llamada   = $_POST["persona_contesta_llamada"];
			$_observaciones_registra_llamadas   = $_POST["observaciones_registra_llamadas"];
			$_id_parentesco_clientes   = $_POST["parentesco_clientes"];
			
			$funcion = "ins_registrar_llamadas";
			$parametros = " '$_id_clientes' ,'$_id_usuario_registra_llamada' , '$_fecha_registrar_llamadas' , '$_hora_registrar_llamadas' , '$_recibio_registrar_llamadas' , '$_persona_contesta_llamada' , '$_observaciones_registra_llamadas', '$_id_parentesco_clientes'  ";
			$registrar_llamadas->setFuncion($funcion);
			$registrar_llamadas->setParametros($parametros);
			$resultado=$registrar_llamadas->Insert();
			 
			
			$traza=new TrazasModel();
			$_nombre_controlador = "Clientes";
			$_accion_trazas  = "Guardar";
			$_parametros_trazas = $_nombres_clientes;
			$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			
		}
			
			if(isset($_POST["id_clientes"]))
			{
	
				$_id_clientes = $_POST["id_clientes"];
				$_id_tipo_identificacion     = $_POST["id_tipo_identificacion"];
				$_nombres_clientes   = $_POST["nombres_clientes"];
				$_telefono_clientes   = $_POST["telefono_clientes"];
				$_celular_clientes   = $_POST["celular_clientes"];
				$_direccion_clientes   = $_POST["direccion_clientes"];
				$_id_ciudad   = $_POST["id_ciudad"];
				$_id_tipo_persona   = $_POST["id_tipo_persona"];
				
				$colval = " id_tipo_identificacion = '$_id_tipo_identificacion', nombres_clientes = '$_nombres_clientes', telefono_clientes = '$_telefono_clientes', celular_clientes = '$_celular_clientes', direccion_clientes = '$_direccion_clientes', id_ciudad = '$_id_ciudad', id_tipo_persona = '$_id_tipo_persona' ";
				$tabla = "clientes";
				$where = "id_clientes = '$_id_clientes'    ";
					
				$resultado=$registrar_llamadas->UpdateBy($colval, $tabla, $where);
	
			}
			else{
			
				
			}
			$this->redirect("RegistrarLlamadas", "index");
			
		}
			
				else
			{
				$this->view("Error",array(
					
				"resultado"=>"No tiene Permisos de Insertar Registrar Llamadas"
	
		));
	
	
	}

	}
	
	
	
	public function consulta_registra_llamadas(){
	
		session_start();
	
		//Creamos el objeto usuario
		$resultSet="";
	
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getBy("nombre_ciudad='QUITO' OR nombre_ciudad='GUAYAQUIL'");
	
		$usuarios= new UsuariosModel();
		$resultUsu = $usuarios->getAll("nombre_usuarios");
		
		$registrar_llamadas = new RegistrarLLamadasModel();
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "RegistrarLlamadas";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $registrar_llamadas->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
	
			if (!empty($resultPer))
			{	 
				if(isset($_POST["buscar"])){
	
	           $llamada_recibida=$_POST['recibio_registrar_llamadas'];
	
	           if($llamada_recibida=='si'){
	
					$id_ciudad=$_POST['id_ciudad'];
					$nombre_usuarios=$_POST['id_usuarios'];
					$identificacion=$_POST['identificacion_clientes'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
	
					$registrar_llamadas = new RegistrarLLamadasModel();
	
	
					$columnas = "clientes.id_clientes, 
							registrar_llamadas.id_registrar_llamadas,
							  tipo_identificacion.nombre_tipo_identificacion, 
							  clientes.identificacion_clientes, 
							  clientes.nombres_clientes, 
							  clientes.telefono_clientes, 
							  clientes.celular_clientes, 
							  clientes.direccion_clientes, 
							  ciudad.nombre_ciudad, 
							  ciudad.id_ciudad,
							  tipo_persona.nombre_tipo_persona, 
							  usuarios.nombre_usuarios, 
							  registrar_llamadas.fecha_registrar_llamadas, 
							  registrar_llamadas.hora_registrar_llamadas, 
							  registrar_llamadas.recibio_registrar_llamadas, 
							  registrar_llamadas.persona_contesta_llamada, 
							  registrar_llamadas.observaciones_registra_llamadas, 
							  registrar_llamadas.parentesco_clientes,
							  ciudad.id_ciudad, 
							  tipo_persona.id_tipo_persona, 
							  tipo_identificacion.id_tipo_identificacion,
							  registrar_llamadas.creado";
	
					$tablas="public.ciudad, 
							  public.clientes, 
							  public.registrar_llamadas, 
							  public.tipo_persona, 
							  public.tipo_identificacion, 
							  public.usuarios";
	
					$where=" ciudad.id_ciudad = clientes.id_ciudad AND
						  clientes.id_clientes = registrar_llamadas.id_clientes AND
						  registrar_llamadas.id_usuario_registra_llamada = usuarios.id_usuarios AND
						  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
						  tipo_identificacion.id_tipo_identificacion = clientes.id_tipo_identificacion AND registrar_llamadas.recibio_registrar_llamadas='TRUE'";
	
					$id="clientes.id_clientes";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
						
					if($nombre_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$nombre_usuarios'";}
					
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
						
					if($fechadesde!="" && $fechahasta!=""){$where_3=" AND  registrar_llamadas.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 ;
	
	
					$resultSet=$registrar_llamadas->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	                 }
					 
					

                     
                    elseif($llamada_recibida=="no"){
	
					$id_ciudad=$_POST['id_ciudad'];
					$nombre_usuarios=$_POST['id_usuarios'];
					$identificacion=$_POST['identificacion_clientes'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
	
					$registrar_llamadas = new RegistrarLLamadasModel();
	
	
					$columnas = "clientes.id_clientes, 
							registrar_llamadas.id_registrar_llamadas,
							  tipo_identificacion.nombre_tipo_identificacion, 
							  clientes.identificacion_clientes, 
							  clientes.nombres_clientes, 
							  clientes.telefono_clientes, 
							  clientes.celular_clientes, 
							  clientes.direccion_clientes, 
							  ciudad.nombre_ciudad, 
							  tipo_persona.nombre_tipo_persona, 
							  usuarios.nombre_usuarios, 
							  registrar_llamadas.fecha_registrar_llamadas, 
							  registrar_llamadas.hora_registrar_llamadas, 
							  registrar_llamadas.recibio_registrar_llamadas, 
							  registrar_llamadas.persona_contesta_llamada, 
							  registrar_llamadas.observaciones_registra_llamadas, 
							  registrar_llamadas.parentesco_clientes, 
							  registrar_llamadas.creado";
	
					$tablas="public.ciudad, 
							  public.clientes, 
							  public.registrar_llamadas, 
							  public.tipo_persona, 
							  public.tipo_identificacion, 
							  public.usuarios";
	
					$where=" ciudad.id_ciudad = clientes.id_ciudad AND
						  clientes.id_clientes = registrar_llamadas.id_clientes AND
						  registrar_llamadas.id_usuario_registra_llamada = usuarios.id_usuarios AND
						  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
						  tipo_identificacion.id_tipo_identificacion = clientes.id_tipo_identificacion AND registrar_llamadas.recibio_registrar_llamadas='FALSE'";
	
					$id="clientes.id_clientes";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
						
					if($nombre_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$nombre_usuarios'";}
					
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
						
					
	
					if($fechadesde!="" && $fechahasta!=""){$where_3=" AND  registrar_llamadas.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 ;
	
	
					$resultSet=$registrar_llamadas->getCondiciones($columnas ,$tablas , $where_to, $id);
	
	                 }

                    else
                    {
                    $id_ciudad=$_POST['id_ciudad'];
					$nombre_usuarios=$_POST['id_usuarios'];
					$identificacion=$_POST['identificacion_clientes'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
	
					$registrar_llamadas = new RegistrarLLamadasModel();
	
	
					$columnas = "clientes.id_clientes, 
							registrar_llamadas.id_registrar_llamadas,
							  tipo_identificacion.nombre_tipo_identificacion, 
							  clientes.identificacion_clientes, 
							  clientes.nombres_clientes, 
							  clientes.telefono_clientes, 
							  clientes.celular_clientes, 
							  clientes.direccion_clientes, 
							  ciudad.nombre_ciudad, 
							  tipo_persona.nombre_tipo_persona, 
							  usuarios.nombre_usuarios, 
							  registrar_llamadas.fecha_registrar_llamadas, 
							  registrar_llamadas.hora_registrar_llamadas, 
							  registrar_llamadas.recibio_registrar_llamadas, 
							  registrar_llamadas.persona_contesta_llamada, 
							  registrar_llamadas.observaciones_registra_llamadas, 
							  registrar_llamadas.parentesco_clientes, 
							  registrar_llamadas.creado";
	
					$tablas="public.ciudad, 
							  public.clientes, 
							  public.registrar_llamadas, 
							  public.tipo_persona, 
							  public.tipo_identificacion, 
							  public.usuarios";
	
					$where=" ciudad.id_ciudad = clientes.id_ciudad AND
						  clientes.id_clientes = registrar_llamadas.id_clientes AND
						  registrar_llamadas.id_usuario_registra_llamada = usuarios.id_usuarios AND
						  tipo_persona.id_tipo_persona = clientes.id_tipo_persona AND
						  tipo_identificacion.id_tipo_identificacion = clientes.id_tipo_identificacion";
	
					$id="clientes.id_clientes";
	
	
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";
	
	
					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
						
					if($nombre_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$nombre_usuarios'";}
					
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
						
					
	
					if($fechadesde!="" && $fechahasta!=""){$where_3=" AND  registrar_llamadas.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
	
	
					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 ;
	
	
					$resultSet=$registrar_llamadas->getCondiciones($columnas ,$tablas , $where_to, $id);
				
					 }
				}
				$this->view("ConsultaRegistraLlamadas",array(
						"resultSet"=>$resultSet, "resultCiu"=>$resultCiu, "resultUsu"=>$resultUsu
							
				));
	
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Consultar Registro LLamadas"
	
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
