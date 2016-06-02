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
				
		$resultEdit = "";

		
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
		
				
				$this->view("Oficios",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit
			
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
				
			if (isset ($_POST["nombre_oficios"]) )
				
			{
				
				
				
				$_nombre_oficios = $_POST["nombre_oficios"];
				
				if(isset($_POST["id_oficios"])) 
				{
					
					$_id_oficios = $_POST["id_oficios"];
					$colval = " nombre_oficios = '$_nombre_oficios'   ";
					$tabla = "oficios";
					$where = "id_oficios = '$_id_oficios'    ";
					
					$resultado=$oficios->UpdateBy($colval, $tabla, $where);
					
				}else {
					
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
				
				$parametros = " '$_nombre_oficios','$numero_oficio' ";
					
				$oficios->setFuncion($funcion);
		
				$oficios->setParametros($parametros);
					
		
				$resultado=$oficios->Insert();
				
				
				if(!empty($resultado)){
					
					$colval="consecutivo=consecutivo+1";
					$tabla="prefijos";
					$where="id_prefijos='$id_prefijo'";
					 
					$resultado=$oficios->UpdateBy($colval, $tabla, $where);
				}
			 
				$traza=new TrazasModel();
				$_nombre_controlador = "Oficios";
				$_accion_trazas  = "Guardar";
				$_parametros_trazas = $_nombre_oficios;
				$resultado = $traza->AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador);
				
				}
			 
			 
		
			}
			$this->redirect("oficios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Oficios"
		
			));
		
		
		}
	

		$oficios=new OficiosModel();

		$nombre_controladores = "Oficios";
		$id_rol= $_SESSION['id_rol'];
		$resultPer = $oficios->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$oficios =new OficiosModel();
			if (isset ($_POST["nombre_oficios"]) )
				
			{
				$_nombre_oficios= $_POST["nombre_oficios"];
				
				if(isset($_POST["id_oficios"]))
				{
				$_id_oficios = $_POST["id_oficios"];
				$colval = " nombre_oficios= '$_nombre_oficios'   ";
				$tabla = "oficios";
				$where = "id_oficios = '$_id_oficios'    ";
					
				$resultado=$oficios->UpdateBy($colval, $tabla, $where);
					
				}else {
				
			
				$funcion = "ins_oficios";
				
				$parametros = " '$_nombre_oficios'  ";
					
				$oficios->setFuncion($funcion);
		
				$oficios->setParametros($parametros);
		
		
				$resultado=$oficios->Insert();
			 }
		
			}
			$this->redirect("Oficios", "index");

		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar oficios"
		
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
	
	
	
	
	
	
}
?>