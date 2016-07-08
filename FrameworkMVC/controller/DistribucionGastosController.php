<?php

class DistribucionGastosController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
		
		session_start();
	
		//Creamos los objetos a utilizar
     	$distribucion_gastos= new DistribucionGastosModel(); 
     	$entidad= new EntidadesModel();
     	$tipo_gasto= new TipoGastosModel();
     	
		$resultSet="";				
		$resultEdit = "";
		

		if (isset(  $_SESSION['usuario_usuarios']) )
		{
			
			//NOTIFICACIONES
			$distribucion_gastos->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			$permisos_rol = new PermisosRolesModel();
			$nombre_controladores = "DistribucionGastos";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $distribucion_gastos->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				$resultEntidad=$entidad->getAll("nombre_entidades");
				$result_tipo_gasto=$tipo_gasto->getAll("id_tipo_gastos");
				
				
				
				if (isset($_POST["Buscar"])){
					
					$id_entidad=$_POST['id_entidad'];
					$numero_juicio=$_POST['numero_juicio'];
					$identificacion=$_POST['identificacion']; 
					$fechadesde=$_POST['fecha_desde'];
					$fechahasta=$_POST['fecha_hasta'];
					
					$columas="oficios.id_oficios, 
							  oficios.numero_oficios, 
							  juicios.id_juicios, 
							  juicios.juicio_referido_titulo_credito, 
							  clientes.nombres_clientes, 
							  entidades.nombre_entidades, 
							  juicios.fecha_emision_juicios";
					$tablas="  public.oficios, 
							  public.juicios, 
							  public.clientes, 
							  public.entidades";
					$where="  juicios.id_juicios = oficios.id_juicios AND
							  clientes.id_clientes = juicios.id_clientes AND
							  entidades.id_entidades = juicios.id_entidades";
					
					$where_0="";
					$where_1="";
					$where_2="";
					$where_3="";
					$where_4="";
					
					if($id_entidad!=0){$where_0=" AND entidades.id_entidades='$id_entidad'";}
					
					if($numero_juicio!=""){$where_1=" AND juicios.juicio_referido_titulo_credito='$numero_juicio'";}
					
					if($identificacion!=""){$where_2=" AND clientes.identificacion_clientes='$identificacion'";}
					
					if($fechadesde!="" && $fechahasta!=""){$where_4=" AND juicios.fecha_emision_juicios BETWEEN '$fechadesde' AND '$fechahasta'";}
					
					
					$where_to=$where.$where_0.$where_1.$where_2.$where_3.$where_4;
					
					
					
					$resultSet=$distribucion_gastos->getCondiciones($columas, $tablas, $where_to, "oficios.id_oficios");
							
				}
		
				
				$this->view("DistribucionGastos",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"resultEntidad"=>$resultEntidad,"result_tipo_gasto"=>$result_tipo_gasto
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Tipos de Distribucion Gastos "
				
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
	
	public function InsertaDistribucionGastos (){
			
		session_start();

		
		$distribucion_gastos=new DistribucionGastosModel();
		$nombre_controladores = "TipoIdentificacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_identificacion=new TipoIdentificacionModel();
		
			
			if (isset ($_POST["nombre_tipo_identificacion"]) )
			{
				
				$_nombre_tipo_identificacion = $_POST["nombre_tipo_identificacion"];
				
				if(isset($_POST["id_tipo_identificacion"])) 
				{
					
					$_id_tipo_identificacion = $_POST["id_tipo_identificacion"];
					$colval = " nombre_tipo_identificacion = '$_nombre_tipo_identificacion'   ";
					$tabla = "tipo_identificacion";
					$where = "id_tipo_identificacion = '$_id_tipo_identificacion'    ";
					
					$resultado=$tipo_identificacion->UpdateBy($colval, $tabla, $where);
					
				}else {
					
			

				
				$funcion = "ins_tipo_identificacion";
				
				$parametros = " '$_nombre_tipo_identificacion'  ";
					
				$tipo_identificacion->setFuncion($funcion);
		
				$tipo_identificacion->setParametros($parametros);
		
		
				$resultado=$tipo_identificacion->Insert();
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Identificacion";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_tipo_identificacion;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("tipo_identificacion", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de identificacion"
		
			));
		
		
		}
	

		$tipo_identificacion=new TipoIdentificacionModel();

		$nombre_controladores = "TipoIdentificacion";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $tipo_identificacion->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$tipo_identificacion=new TipoIdentificacionModel();
		
			//_nombre_tipo_identificacion
			
			if (isset ($_POST["nombre_tipo_identificacion"]) )
				
			{
				$_nombre_tipo_identificacion = $_POST["nombre_tipo_identificacion"];
				
				if(isset($_POST["id_tipo_identificacion"]))
				{
				$_id_tipo_identificacion = $_POST["id_tipo_identificacion"];
				$colval = " nombre_tipo_identificacion = '$_nombre_tipo_identificacion'   ";
				$tabla = "tipo_identificacion";
				$where = "id_tipo_identificacion = '$_id_tipo_identificacion'    ";
					
				$resultado=$tipo_identificacion->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_tipo_identificacion";
				
				$parametros = " '$_nombre_tipo_identificacion'  ";
					
				$tipo_identificacion->setFuncion($funcion);
		
				$tipo_identificacion->setParametros($parametros);
		
		
				$resultado=$tipo_identificacion->Insert();
			 }
		
			}
			$this->redirect("TipoIdentificacion", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar tipos de identificacion"
		
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
			if(isset($_GET["id_tipo_identificacion"]))
			{
				$id_tipo_identificacion=(int)$_GET["id_tipo_identificacion"];
				
				$tipo_identificacion=new TipoIdentificacionModel();
				
				$tipo_identificacion->deleteBy(" id_tipo_identificacion",$id_tipo_identificacion);
				
				$traza=new TrazasModel();
				$_nombre_controlador = "Tipo Identificacion";
				$_accion_trazas  = "Borrar";
				$_parametros_trazas = $id_tipo_identificacion;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
			}
			
			$this->redirect("TipoIdentificacion", "index");
			
			
		}
		else
		{
			$this->view("Error",array(
				"resultado"=>"No tiene Permisos de Borrar Tipos de Identificacion"
			
			));
		}
				
	}
	
	public  function devuelveTipoGasto(){
		
		$id_tipo_gasto=(int)$_POST['id_tipo_gasto'];
		
		$tipo_gasto=new TipoGastosModel();
		
		$where="id_tipo_gastos='$id_tipo_gasto'";
		
		$resultTipo_gasto=$tipo_gasto->getBy($where);
		
		echo json_encode($resultTipo_gasto);
	
	}
	
	public  function AsignarDistribucionGasto(){
		
	session_start();
		$distribucion_gastos=new DistribucionGastosModel();
		$estado = new EstadoModel();
		
		$nombre_controladores = "DistribucionGastos";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $distribucion_gastos->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{

		
			
		$resultado = null;
			$oficios=new OficiosModel();
				
			if (isset ($_POST["Asignar"]) )
				
			{
			 $id_estado="";
			 $_array_oficios = $_POST["id_oficios"];
			 $id_tipo_gasto=$_POST['tipo_gasto'];
			 $descripcion_gasto=$_POST['descripcion_diligencia'];
			 $documento=$_POST['tipo_documento'];
			 $numero_documento=$_POST['numero_documento'];
			 $a_favor_de=$_POST['a_favor_de'];
			 
			 $resultEstado = $estado->getBy("nombre_estado='PENDIENTE'");
			 $id_estado=$resultEstado[0]->id_estado;
			
			 
				
					foreach($_array_oficios  as $id  )
					{
						if (!empty($id) )
						{
							
							//busco si exties este nuevo id
							try
							{
								
								$id_oficio = $id;
							
								$funcion = "ins_distribucion_gastos";
								$parametros = "'$id_tipo_gasto','$id_oficio', '$descripcion_gasto' ,'$documento','$numero_documento','$a_favor_de','$id_estado'";
								$distribucion_gastos->setFuncion($funcion);
		                        $distribucion_gastos->setParametros($parametros);
		                        
		                        $resultado=$distribucion_gastos->Insert();
		                       	                       
					            
		                      
							} catch (Exception $e)
							{
								$this->view("Error",array(
										"resultado"=>"Eror al Asignar ->". $id
								));
							}
								
						}
					
					}
					
				$traza=new TrazasModel();
				$_nombre_controlador = "Distribucion Gastos";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $descripcion_gasto;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			$this->redirect("DistribucionGastos", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Distribucion Gastos"
		
			));
		
		
		}
	
		
	}
	
	public function Reporte(){
	
		//Creamos el objeto usuario
		$tipo_identificacion=new TipoIdentificacionModel();
		//Conseguimos todos los usuarios
		
	
	
		session_start();
	
	
		if (isset(  $_SESSION['usuario']) )
		{
			$resultRep = $roles->getByPDF("id_rol, nombre_rol", " nombre_rol != '' ");
			$this->report("TipoIdentificacion",array(	"resultRep"=>$resultRep));
	
		}
					
	
	}
	
	
	
}
?>