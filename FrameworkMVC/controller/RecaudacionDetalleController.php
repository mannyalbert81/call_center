<?php
class RecaudacionDetalleController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}

	public function index(){
		
		session_start();
		//al hacer load page
		
		$recaudacion_cabeza = new RecaudacionCabezaModel();
		if(isset($_GET["id_recaudacion_cabeza"]))
		{
		//Creamos el objeto de cabecera
		$id_cabecera=$_GET["id_recaudacion_cabeza"];
	
		}else
		{
			$id_cabecera=$_POST["id_cabecera"];
		}
		
		$columnas = "recaudacion_cabeza.id_recaudacion_cabeza, recaudacion_cabeza.id_recaudacion_institucion, recaudacion_institucion.nombre_recaudacion_institucion, recaudacion_cabeza.fecha_creacion_recaudacion_cabeza, recaudacion_cabeza.hora_creacion_recaudacion_cabeza,  recaudacion_cabeza.cantidad_registros_recaudacion_cabeza, recaudacion_cabeza.valor_total_dolares_recaudacion_cabeza,  recaudacion_cabeza.creado";
		$tablas   = "public.recaudacion_institucion, public.recaudacion_cabeza";
		$where    = "recaudacion_cabeza.id_recaudacion_institucion = recaudacion_institucion.id_recaudacion_institucion AND recaudacion_cabeza.id_recaudacion_cabeza='$id_cabecera'";
		$id = "fecha_creacion_recaudacion_cabeza , hora_creacion_recaudacion_cabeza";
		
		//creamos array con la consulta de registros
		$resultSet=$recaudacion_cabeza->getCondiciones($columnas, $tablas, $where, $id);
			$resultEdit = "";

		
	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			$recaudacion_cabeza = new RecaudacionCabezaModel();
			//Notificaciones
			$recaudacion_cabeza->MostrarNotificaciones($_SESSION['id_usuarios']);

			$nombre_controladores = "RecaudacionDetalle";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $recaudacion_cabeza->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				$detalleRecaudacion=new RecaudacionDetalleModel();
				
				if(isset($_GET["id_recaudacion_cabeza"]))
				{
				//Buscar Detalles de la recaudacion	
				$coldetalle="*";
				$tblDetalle="recaudacion_detalle";
				$whereDetalle="id_recaudacion_cabeza='$id_cabecera'";
				//$resultDetalle=$detalleRecaudacion->getCondiciones();
				$resultDetalle=$detalleRecaudacion->getBy($whereDetalle);
				}
				else{
					
				$resultDetalle=array();
					
				}
				
				
				
				if(isset($_POST["buscar"]))
				{
					
					$cabecera_id=$_POST["id_cabecera"];
					$contenido=$_POST["contenido_busqueda"];
					$criterio=$_POST["criterio_busqueda"];
					
					
					
					$whereDetalle="id_recaudacion_cabeza='$cabecera_id'";
					
					
					
					if ($contenido !="")
					{
							
						$where_0 = "";
						$where_1 = "";
						$where_2 = "";
						$where_3 = "";
							
						switch ($criterio) {
							case 0:
								$where_0 = "";
								break;
							case 1:
								//Ruc Cliente/Proveedor
								$where_1 = " AND  nombre_tercero_recaudacion_detalle LIKE '$contenido'  ";
								break;
							case 2:
								//Nombre Cliente/Proveedor
								$where_2 = " AND nuc_tercero_recaudacion_detalle LIKE '$contenido'  ";
								break;
							case 3:
								//Número Carton
								$where_3 = " AND valor_movimiento_recaudacion_detalle = '$contenido' ";
								break;
							
						}
							
							
							
						$where_to  = $whereDetalle .  $where_0 . $where_1 . $where_2 . $where_3;
						
						
				}else
				{
					$where_to  = $whereDetalle;
					
				
				}
				
				//$resultDetalle=$detalleRecaudacion->getCondiciones();
				$resultDetalle=$detalleRecaudacion->getBy($where_to);
			}
			
		
				
				$this->view("RecaudacionDetalle",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"resultDetalle"=>$resultDetalle,"id_cabecera"=>$id_cabecera
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Detalle Recaudacion"
				
				));
				
				exit();	
			}
				
		}
		else 
		{
				$this->view("ErrorSesion",array(
						"resultSet"=>"Debe Iniciar Session"
			
				));
		
		}
	
	}
	
	public function InsertaRecaudacionDetalle(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();

		$ltCredito = new LotesTituloCreditoModel();


		$nombre_controladores = "LotesTituloCredito";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			
		
			
			
			if (isset ($_POST["nombre_ltcredito"]) )
				
			{
				
				
				
				$_nombre_ltCredito = $_POST["nombre_ltcredito"];
				
				
				if(isset($_POST["id_ltcredito"])) 
				{
					
					$_id_ltCredito = $_POST["id_ltcredito"];
					
					$colval = " nombre_lotes_titulos_credito = '$_nombre_ltCredito'   ";
					$tabla = "lotes_titulos_credito";
					$where = "id_lotes_titulos_credito = '$_id_ltCredito'    ";
					
					$resultado=$ltCredito->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			
				
				$funcion = "ins_lotes_titulo_credito";
				
				$parametros = " '$_nombre_ltCredito'  ";
					
				$ltCredito->setFuncion($funcion);
		
				$ltCredito->setParametros($parametros);
		
		
				$resultado=$ltCredito->Insert();
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Lotes Titulo Credito";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_ltCredito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			 }
		
			}
			$this->redirect("LotesTituloCredito", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Lotes Titulo Credito"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{

		session_start();
		
		$permisos_rol=new PermisosRolesModel();
		$nombre_controladores = "LotesTituloCredito";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
		if (!empty($resultPer))
		{
			if(isset($_GET["id_ltcredito"]))
			{
				$id_ltCredito=(int)$_GET["id_ltcredito"];
			
				$ltCredito = new LotesTituloCreditoModel();
				$ltCredito->deleteBy("id_lotes_titulos_credito",$id_ltCredito);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Lotes Titulo Credito";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_ltCredito;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
			}
			
			$this->redirect("LotesTituloCredito", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Lotes Titulo Credito"
			
			));
		}
				
	}
	
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$roles=new RolesModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("Roles",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>