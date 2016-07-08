<?php

class ReasignarTituloController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
		
		session_start();
			
		$resultEdit = "";
		
		$resultSet=array();
		
		$reasignar_titulo = new ReasignarTituloModel();
		
		//CONSULTA DE USUARIOS POR SU ROL
		$columnas = "usuarios.id_usuarios,usuarios.nombre_usuarios";
		$tablas="usuarios inner join rol on(usuarios.id_rol=rol.id_rol)";
		$id="rol.id_rol";
			
		$usuarios=new UsuariosModel();
		
		$where="rol.nombre_rol='ABOGADO IMPULSOR'";
		$resultUsuarioImpulsor=$usuarios->getCondiciones($columnas ,$tablas , $where, $id);
		
		if (isset(  $_SESSION['usuario_usuarios']))
		{
			
			
			
			$reasignar_titulo = new ReasignarTituloModel();
			//Notificaciones
			$reasignar_titulo->MostrarNotificaciones($_SESSION['id_usuarios']);
			
			
			$nombre_controladores = "ReasignarTitulo";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $reasignar_titulo->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
										
				$resultPEdit = $reasignar_titulo->getPermisosEditar("controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
					
				
				if (!empty($resultPEdit)  )
				{
					if (isset ($_POST["buscar"]) )
					{
						
						$id_usuario=$_POST["abogado_asignado"];
					
						$columnaTitulo="
						 asignacion_titulo_credito.id_asignacion_titulo_credito, 
						  titulo_credito.id_titulo_credito, 
						  clientes.identificacion_clientes, 
						  clientes.nombres_clientes, 
						  titulo_credito.total, 
						  titulo_credito.fecha_corte";
						$tblTitulo=" 
							  public.asignacion_titulo_credito, 
							  public.titulo_credito, 
							  public.clientes";
											
						$whereTitulo="
						titulo_credito.id_titulo_credito = asignacion_titulo_credito.id_titulo_credito AND
  						clientes.id_clientes = titulo_credito.id_clientes AND asignacion_titulo_credito.id_usuarios='$id_usuario'";
						
						$idTitulo="titulo_credito.id_titulo_credito";
						
						$resultSet=$reasignar_titulo->getCondiciones($columnaTitulo, $tblTitulo, $whereTitulo, $idTitulo);
						
					
					}
					
					
					if (isset ($_POST["reasignar"]) )
					{
						
							
						if (isset ($_POST["id_titulo_credito"])   )
						{
							
							$_array_titulo_credito = $_POST["id_titulo_credito"];
							
							$_id_abogado = $_POST["abogado_reasignar"];
							
							
							foreach($_array_titulo_credito  as $id_titulo  )
							{

								
									
								
								if (!empty($id_titulo) )
								{
									
									
									//busco si exties este nuevo id
									try
									{
										$_id_titulo_credito = $id_titulo;
										
										$colval="id_usuarios='$_id_abogado'";
										$tabla="asignacion_titulo_credito";
										$where="id_titulo_credito='$_id_titulo_credito'";
										
										
										$resultado=$reasignar_titulo->UpdateBy($colval, $tabla, $where);
										
						
									} catch (Exception $e)
									{
										$this->view("Error",array(
												"resultado"=>"Eror al Asignar ->". $id_titulo
										));
									}
										
								}
						
							}
							
							$traza=new TrazasModel();
							$_nombre_controlador = "Reasignar Titulos";
							$_accion_trazas  = "Reasignar";
							$_parametros_trazas = "";
							$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
						
						
						}
						
						
					}
					
					
					
				}
				
				
				
				$this->view("ReasignarTitulo",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit,"resultUsuarioImpulsor"=>$resultUsuarioImpulsor
			
				));
		
				
				
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Reasignacion Lotes Credito"
				
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
	
	public function InsertaRasignacionTitulo(){
			
		session_start();

		$permisos_rol=new PermisosRolesModel();

		$reasignarTitulo=new ReasignarTituloModel();
		
		$nombre_controladores = "ReasignarTitulo";
		$id_rol= $_SESSION['id_rol'];

		
		$resultPer = $permisos_rol->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		if (!empty($resultPer))
		{
		
			$resultado = null;
			
			
			if (isset ($_POST["reasignar"]) )
			{
				$_id_titulo_credito=0;
				$_id_usuario = $_POST["Abogado_reasignar"];
				//$_id_titulo_credito=$_POST["id_titulo_credito"];
				
				$colval="id_usuarios='$_id_usuario'";
				$tabla="asignacion_titulo_credito";
				$where="id_titulo_credito='$_id_titulo_credito'";
				/*
				$this->view("Error",array(
							
						"resultado"=>$_id_titulo_credito."hola"
				
				));
				exit();*/
				
				//$resultado=$reasignarTitulo->UpdateBy($colval, $tabla, $where);
				
			}
			
			$this->redirect("ReasignarTitulo", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Honorarios"
		
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