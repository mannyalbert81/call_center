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
		
		
		
		$usuarios = new UsuariosModel();
		$resultImpulsores=$usuarios->getCondiciones("usuarios.id_usuarios, 
													  usuarios.nombre_usuarios, 
													  rol.nombre_rol",
													"public.rol, public.usuarios",
				"rol.id_rol = usuarios.id_rol AND rol.nombre_rol='ABOGADO IMPULSOR'",
				"usuarios.nombre_usuarios");
		
		$resultSecretarios=$usuarios->getCondiciones("usuarios.id_usuarios,
													  usuarios.nombre_usuarios,
													  rol.nombre_rol",
				"public.rol, public.usuarios",
				"rol.id_rol = usuarios.id_rol AND rol.nombre_rol='SECRETARIO'",
				"usuarios.nombre_usuarios");
		
        $documentos_impulsores=new DocumentosModel();

        
        
         
         
        

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

				
					
					$id_ciudad=$_POST['id_ciudad'];
					$id_usuarios=$_POST['id_usuarios'];
					$identificacion=$_POST['identificacion'];
					$numero_juicio=$_POST['numero_juicio'];
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];

					$documentos_impulsores=new DocumentosModel();


					$columnas = "documentos.id_documentos, 
								  ciudad.nombre_ciudad, 
								  juicios.juicio_referido_titulo_credito, 
								  clientes.nombres_clientes, 
								  clientes.identificacion_clientes, 
								  estados_procesales_juicios.nombre_estado_procesal_juicios, 
								  documentos.fecha_emision_documentos, 
								  documentos.hora_emision_documentos, 
								  documentos.detalle_documentos, 
								  documentos.observacion_documentos, 
								  documentos.avoco_vistos_documentos,
								  documentos.ruta_documento,
								  documentos.nombre_documento,
								  usuarios.id_usuarios,
							      usuarios.nombre_usuarios, 
								  usuarios.imagen_usuarios";

					$tablas=" public.documentos, 
							  public.ciudad, 
							  public.juicios, 
							  public.usuarios, 
							  public.clientes, 
							  public.estados_procesales_juicios";

					$where="ciudad.id_ciudad = documentos.id_ciudad AND
						  juicios.id_juicios = documentos.id_juicio AND
						  usuarios.id_usuarios = documentos.id_usuario_registra_documentos AND
						  clientes.id_clientes = juicios.id_clientes AND
						  estados_procesales_juicios.id_estados_procesales_juicios = documentos.id_estados_procesales_juicios";

					$id="documentos.id_documentos";
						
						
					$where_0 = "";
					$where_1 = "";
					$where_2 = "";
					$where_3 = "";
					$where_4 = "";


					if($id_ciudad!=0){$where_0=" AND ciudad.id_ciudad='$id_ciudad'";}
					
					if($id_usuarios!=0){$where_1=" AND usuarios.id_usuarios='$id_usuarios'";}
						
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
					
					if($numero_juicio!=""){$where_3=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
						
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND  documentos.fecha_emision_documentos BETWEEN '$fechadesde' AND '$fechahasta'";}


					$where_to  = $where . $where_0 . $where_1 . $where_2. $where_3 . $where_4;


					$resultSet=$documentos_impulsores->getCondiciones($columnas ,$tablas , $where_to, $id);
				
				}
				

				$this->view("ConsultaCordinador",array(
						"resultSet"=>$resultSet,"resultCiu"=>$resultCiu, "resultImpulsores"=>$resultImpulsores, "resultSecretarios"=>$resultSecretarios
							
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