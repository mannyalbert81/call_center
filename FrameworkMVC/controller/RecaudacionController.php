<?php

class RecaudacionController extends ControladorBase{

	public function __construct() {
		parent::__construct();
	}



	public function index(){
	
		//Creamos el objeto usuario
     	$recaudacion_cabeza = new RecaudacionCabezaModel(); 
		$recaudacion_institucion = new RecaudacionInstitucionModel();
		
		$columnas = "recaudacion_cabeza.id_recaudacion_cabeza, recaudacion_cabeza.id_recaudacion_institucion, recaudacion_institucion.nombre_recaudacion_institucion, recaudacion_cabeza.fecha_creacion_recaudacion_cabeza, recaudacion_cabeza.hora_creacion_recaudacion_cabeza,  recaudacion_cabeza.cantidad_registros_recaudacion_cabeza, recaudacion_cabeza.valor_total_dolares_recaudacion_cabeza,  recaudacion_cabeza.creado";
		$tablas   = "public.recaudacion_institucion, public.recaudacion_cabeza";
		$where    = "recaudacion_cabeza.id_recaudacion_institucion = recaudacion_institucion.id_recaudacion_institucion";
		$id = "fecha_creacion_recaudacion_cabeza , hora_creacion_recaudacion_cabeza";
	    $id_dos = "nombre_recaudacion_institucion";
     	
	    $resultSet=$recaudacion_cabeza->getCondiciones($columnas, $tablas, $where, $id);
		$resultInsRec = $recaudacion_institucion->getAll($id_dos);
		
		
		
		$resultEdit = "";	
		
		
		session_start();

	
		if (isset(  $_SESSION['usuario_usuarios']) )
		{


			$nombre_controladores = "Recaudacion";
			$id_rol= $_SESSION['id_rol'];
			$resultPer = $recaudacion_cabeza->getPermisosVer("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
			
			if (!empty($resultPer))
			{
				if (isset ($_POST["procesar"]) )
				{
					$directorio = $_SERVER['DOCUMENT_ROOT'].'/recaudacion/';
						
					$nombre = $_FILES['archivo']['name'];
					$tipo = $_FILES['archivo']['type'];
					$tamano = $_FILES['archivo']['size'];
						
					// temporal al directorio definitivo
							
					move_uploaded_file($_FILES['archivo']['tmp_name'],$directorio.$nombre);
						
					$file = fopen($directorio.$nombre, "r") or exit("Unable to open file!");
					
					$contador = 0;
					$contador_linea = 0;
					
					$encabezado_linea = "";
					$contenido_linea = "";
					$pie_linea = "";
					
					$lectura_linea = "";
					
					while(!feof($file))
					{
					    $contador_linea = $contador_linea + 1;
					    
					}
					
					while(!feof($file))
					{
						$contador = $contador + 1;
						$line =  $line . fgets($file) ;
						
						if ($contador == 1) 
						{
							$encabezado_linea = $line;
							
						} 
						elseif ($contador == $contador_linea ) 
						{
							$pie_linea = $line;
						} 
						else 
						{
							$pie_linea = $line;
						}
						
						
						
					}
		
					
					
					
					fclose($file);
					
					
					
					//$data = file_get_contents($directorio.$nombre);
						
					//$imagen_firmas_digitales = pg_escape_bytea($data);
					
					
					
				}
				
				
				
				
				
				
				
				$this->view("Recaudacion",array(
						"resultSet"=>$resultSet, "resultEdit" =>$resultEdit, "resultInsRec" =>$resultInsRec
							
				));
			}
			else
			{
				$this->view("Error",array(
						"resultado"=>"No tiene Permisos de Acceso a Controladores"
				
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
	
		
	public function InsertaFirmasDigitales(){
			
		session_start();
		

		$nombre_controladores = "FirmasDigitales";

		
		$firmas_digitales = new FirmasDigitalesModel(); 
		
		$id_rol= $_SESSION['id_rol'];
		
		$resultPer = $firmas_digitales->getPermisosEditar("   controladores.nombre_controladores = '$nombre_controladores' AND permisos_rol.id_rol = '$id_rol' " );
		
		
		if (!empty($resultPer))
		{
		
		
		
			$resultado = null;
			$firmas_digitales = new FirmasDigitalesModel(); 
		
			//_nombre_controladores
			
			if (isset ($_POST["abogados"]) )
				
			{
				$usuarios=new UsuariosModel();
				$_id_usuarios =  $_POST["abogados"] ;
				
				$firmas_digitales = new FirmasDigitalesModel();
				$directorio = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
					
				$nombre = $_FILES['imagen_firmas_digitales']['name'];
				$tipo = $_FILES['imagen_firmas_digitales']['type'];
				$tamano = $_FILES['imagen_firmas_digitales']['size'];
					
				// temporal al directorio definitivo
					
				move_uploaded_file($_FILES['imagen_firmas_digitales']['tmp_name'],$directorio.$nombre);
					
				$data = file_get_contents($directorio.$nombre);
					
				$imagen_firmas_digitales = pg_escape_bytea($data);
					
					
					
			    $funcion = "ins_firmas_digitales";
				
				
				$parametros = " '$_id_usuarios' ,'{$imagen_firmas_digitales}' ";
				$firmas_digitales->setFuncion($funcion);	
				$firmas_digitales->setParametros($parametros);
			   
				
				try {
				
					$resultado=$firmas_digitales->Insert();
					
					
				} catch (Exception $e) {
					
					$this->view("Error",array(
							"resultado"=>$e
					));
					
					
				}
				
					
				}
				//pasante
				
				$this->redirect("FirmasDigitales", "index");
		}
		else
		{
			$this->view("Error",array(
					
					"resultado"=>"No tiene Permisos de Insertar Firmas Digitales"
		
			));
		
		
		}
		
	}
	
	public function borrarId()
	{
				
	}
	
	
	
}
?>