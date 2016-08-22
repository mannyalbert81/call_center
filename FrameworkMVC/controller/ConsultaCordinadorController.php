<?php
class ConsultaCordinadorController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}


	public function consulta_cordinador(){

		session_start();

		//Creamos el objeto usuario
		$resultSet="";
		$documentos_impulsores=new DocumentosModel();
		
		$ciudad = new CiudadModel();
		$resultCiu = $ciudad->getBy("nombre_ciudad='QUITO' OR nombre_ciudad='GUAYAQUIL' ");
		


		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			//notificaciones
			$documentos_impulsores->MostrarNotificaciones($_SESSION['id_usuarios']);
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "ConsultaCordinador";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $documentos_impulsores->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );

			if (!empty($resultPer))
			{
					
				if(isset($_POST["buscar"])){

					
					$tipo_documento=$_POST['tipo_documento'];
					
					//buscar por citaciones
					if($tipo_documento == "citaciones")
					{
						
					
						$id_ciudad=$_POST['id_ciudad'];
						$id_secretario=$_POST['id_secretario'];
						$id_impulsor=$_POST['id_impulsor'];
						$identificacion=$_POST['identificacion'];
						$numero_juicio=$_POST['numero_juicio'];
						$estado_documento=$_POST['estado_documento'];
						$fechadesde=$_POST['fecha_desde'];
						$fechahasta=$_POST['fecha_hasta'];
						
					$citaciones= new CitacionesModel();


					$columnas = "citaciones.id_citaciones, 
								  juicios.id_juicios, 
								  juicios.juicio_referido_titulo_credito, 
								  clientes.identificacion_clientes, 
								  clientes.nombres_clientes, 
								  citaciones.fecha_citaciones, 
								  ciudad.nombre_ciudad, 
								  citaciones.nombre_persona_recibe_citaciones, 
								  citaciones.relacion_cliente_citaciones, 
								  usuarios.nombre_usuarios";

					$tablas=" public.citaciones, 
							  public.ciudad, 
							  public.clientes, 
							  public.juicios, 
							  public.usuarios";

					$where="ciudad.id_ciudad = juicios.id_ciudad AND
						  clientes.id_clientes = juicios.id_clientes AND
						  juicios.id_juicios = citaciones.id_juicios AND
						  usuarios.id_usuarios = citaciones.id_usuarios";

					$id="citaciones.id_citaciones";
						
						
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
						$where_5 = "";
						
						
						if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
							
						if($id_secretario!=0){$where_1=" AND usuarios.id_usuarios='$id_secretario'";}
						
						if($id_impulsor!=0){$where_2=" AND usuarios.id_usuarios='$id_impulsor'";}
						
						if($identificacion!=""){$where_3=" AND clientes.identificacion_clientes='$identificacion'";}
							
						if($numero_juicio!=""){$where_4=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
						
						if($fechadesde!="" && $fechahasta!=""){$where_5=" AND  citaciones.creado BETWEEN '$fechadesde' AND '$fechahasta'";}
						
						
						$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4 . $where_5;
						
						
						$resultSet=$citaciones->getCondiciones($columnas ,$tablas , $where_to, $id);
						
					}
					
					//buscar por providencias
					if($tipo_documento == "providencias")
					{
					
						$id_ciudad=$_POST['id_ciudad'];
						$id_secretario=$_POST['id_secretario'];
						$id_impulsor=$_POST['id_impulsor'];
						$identificacion=$_POST['identificacion'];
						$numero_juicio=$_POST['numero_juicio'];
						$estado_documento=$_POST['estado_documento'];
						$fechadesde=$_POST['fecha_desde'];
						$fechahasta=$_POST['fecha_hasta'];
						
						$documentos=new DocumentosModel();
						
						
						$columnas = "documentos.id_documentos,
						ciudad.nombre_ciudad,
						juicios.juicio_referido_titulo_credito,
						clientes.nombres_clientes,
						clientes.identificacion_clientes,
						documentos.nombre_documento,
						asignacion_secretarios_view.impulsores,
						asignacion_secretarios_view.secretarios,
						documentos.fecha_emision_documentos,
						documentos.hora_emision_documentos";
						
						$tablas=" public.ciudad, 
								  public.clientes, 
								  public.juicios, 
								  public.asignacion_secretarios_view, 
								  public.documentos";
														
						$where="clientes.id_clientes = juicios.id_clientes AND
							  juicios.id_juicios = documentos.id_juicio AND
							  asignacion_secretarios_view.id_abogado = documentos.id_usuario_registra_documentos AND
							  documentos.id_ciudad = ciudad.id_ciudad";
						
						$id="documentos.id_documentos";
						
						
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
						$where_4 = "";
						$where_5 = "";
						
						
						if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
							
						if($id_secretario!=0){$where_1=" AND asignacion_secretarios_view.id_secretario='$id_secretario'";}
						
						if($id_impulsor!=0){$where_2=" AND asignacion_secretarios_view.id_abogado='$id_impulsor'";}
						
						if($identificacion!=""){$where_3=" AND clientes.identificacion_clientes='$identificacion'";}
							
						if($numero_juicio!=""){$where_4=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
						
						if($fechadesde!="" && $fechahasta!=""){$where_5=" AND  documentos.fecha_emision_documentos BETWEEN '$fechadesde' AND '$fechahasta'";}
						
						
						$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4 . $where_5;
						
						
						$resultSet=$documentos->getCondiciones($columnas ,$tablas , $where_to, $id);
						
						
					}
					
					//buscar por oficios
					if($tipo_documento == "oficios")
					{
					
					
					}
					
					//buscar por avoco conocimiento
					if($tipo_documento == "avoco_conocimiento")
					{
					
					
					}
					
				
				
				}
				

				$this->view("ConsultaCordinador",array(
						"resultSet"=>$resultSet,"resultCiu"=>$resultCiu
							
				));

			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Consulta Cordinador"

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

	
	
	  public function abrirPdf()
	  {
		$documentos = new DocumentosModel();
	
		if(isset($_GET['id']))
		{
				
			$id_documento = $_GET ['id'];
				
			$resultDocumento = $documentos->getBy ( "id_documentos='$id_documento'" );
				
			if (! empty ( $resultDocumento )) {
	
				$nombrePdf = $resultDocumento [0]->nombre_documento;
	
				$nombrePdf .= ".pdf";
	
				$ruta = $resultDocumento [0]->ruta_documento;
	
				$directorio = $_SERVER ['DOCUMENT_ROOT'] . '/documentos/' . $ruta . '/' . $nombrePdf;
	
				header('Content-type: application/pdf');
				header('Content-Disposition: inline; filename="'.$directorio.'"');
				readfile($directorio);
			}
	
	
		}
		
	}
	
	public function Secrtetarios()
	{
	
		//CONSULTA DE USUARIOS POR SU ROL
		$idciudad=(int)$_POST["ciudad"];
		$usuarios=new UsuariosModel();
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios,ciudad,rol";
		$id="rol.id_rol";
	
		$where="rol.id_rol=usuarios.id_rol AND usuarios.id_ciudad=ciudad.id_ciudad
		AND rol.nombre_rol='SECRETARIO' AND ciudad.id_ciudad='$idciudad'";
	
		$resultSecretario=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultSecretario);
	}
	
	public function Impulsor()
	{
	
		//CONSULTA DE USUARIOS POR SU ROL
		$idusuarios=(int)$_POST["usuarios"];
		$usuarios=new UsuariosModel();
		$columnas = "asignacion_secretarios_view.id_abogado,
					  asignacion_secretarios_view.impulsores";
		$tablas="public.asignacion_secretarios_view";
		$id="asignacion_secretarios_view.id_abogado";
	
		$where="public.asignacion_secretarios_view.id_secretario = '$idusuarios'";
	
		$resultImpulsor=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
	
		echo json_encode($resultImpulsor);
	}
}
?> 