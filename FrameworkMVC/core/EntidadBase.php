<?php
class EntidadBase{
    private $table;
    private $db;
    private $conectar;
    
    
    public function __construct($table) {
        $this->table=(string) $table;
        
        require_once 'Conectar.php';
        $this->conectar=new Conectar();
        $this->db=$this->conectar->conexion();

        $this->fluent=$this->getConetar()->startFluent();
        $this->con=$this->getConetar()->conexion();
        
    }
    
    public function fluent(){
    	return $this->fluent;
    }
    
    public function con(){
    	return $this->con;
    }
    
    
    public function getConetar(){
        return $this->conectar;
    }
    
    public function db(){
        return $this->db;
    }
    
    
    
    public function getAll($id){
        
    	$query=pg_query($this->con, "SELECT * FROM $this->table ORDER BY $id ASC");
    	$resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    public function getContador($contador){
    
    	$query=pg_query($this->con, "SELECT $contador FROM $this->table ");
    	$resultSet = array();
    	 
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    	return $resultSet;
    }
    
    
    
    public function getById($id){
    	
    	$query=pg_query($this->con, "SELECT * FROM $this->table WHERE id=$id");
        $resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    public function getBy($where){
    	
    	$query=pg_query($this->con, "SELECT * FROM $this->table WHERE   $where ");
        $resultSet = array();
    	
           while ($row = pg_fetch_object($query)) {
             $resultSet[]=$row;
           }
        return $resultSet;
    }
    
    public function deleteById($id){
    	
        $query=pg_query($this->con,"DELETE FROM $this->table WHERE $id"); 
        return $query;
    }
    
    public function deleteBy($column,$value){

    	try 
    	{
    		$query=pg_query($this->con,"DELETE FROM $this->table WHERE $column='$value' ");
    	}
    	catch (Exeption $Ex)
    	{
    		
    		
    	} 
    	
        return $query;
    }
    

    public function getCondiciones($columnas ,$tablas , $where, $id){
    	
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
  
    public function getCondicionesPag($columnas ,$tablas , $where, $id, $limit){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC  $limit");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    public function UpdateBy($colval ,$tabla , $where){
    	try 
    	{ 
    	     $query=pg_query($this->con, "UPDATE $tabla SET  $colval   WHERE $where ");
    	     
    	}
    	catch (Exeption  $Ex)
    	{
    		
    		
    	}
    }
    
    
    
    public function getByPDF($columnas, $tabla , $where){
    
    	if ($tabla == "")
    	{
    		$query=pg_query($this->con, "SELECT $columnas FROM $this->table WHERE   $where ");
    	}
    	else
    	{
    		$query=pg_query($this->con, "SELECT $columnas FROM $tabla WHERE   $where ");
    	}
    	
    	return $query;
    }
    
    public function getCondicionesPDF($columnas ,$tablas , $where, $id){
    	 
    	$query=pg_query($this->con, "SELECT $columnas FROM $tablas WHERE $where ORDER BY $id  ASC");
    
    	return $query;
    }
    
    
    
    /*
     * Aqui podemos montarnos un monton de métodos que nos ayuden
     * a hacer operaciones con la base de datos de la entidad
     */
    
    public function encriptar($cadena){
    	$key='rominajasonrosabal';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    	$encrypted = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $cadena, MCRYPT_MODE_CBC, md5(md5($key))));
    	return $encrypted; //Devuelve el string encriptado
    
    }
    
    public function desencriptar($cadena){
    	$key='rominajasonrosabal';  // Una clave de codificacion, debe usarse la misma para encriptar y desencriptar
    	$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($cadena), MCRYPT_MODE_CBC, md5(md5($key))), "\0");
    	return $decrypted;  //Devuelve el string desencriptado
    }
    
    public function registrarSesion($id_usuario, $usuario_usuario, $id_rol, $nombre_usuario, $correo_usuario, $ip_usuario)
    {
    	session_start();
    	
    	$_SESSION["id_usuarios"]=$id_usuario;
    	$_SESSION["usuario_usuarios"]=$usuario_usuario;
    	$_SESSION["id_rol"]=$id_rol;
    	$_SESSION["nombre_usuarios"]=$nombre_usuario;
    	$_SESSION["correo_usuarios"]=$correo_usuario;
    	$_SESSION["ip_usuarios"]=$ip_usuario; 	

    	if (substr($ip_usuario, 0, 3) == "192" )
    	{
    		$_SESSION["tipo_usuario"]="usuario_local";
    	}
    	else   ///usuarios externo 
    	{
    		
    		$_SESSION["tipo_usuario"]="usuario_externo";
    	}
    		
    	
    }
    
    
    public function getPermisosVer($where){
    	 
    	$query=pg_query($this->con, "SELECT permisos_rol.ver_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  ver_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }

    
    public function getPermisosEditar($where){
    
    	$query=pg_query($this->con, "SELECT permisos_rol.editar_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  editar_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    

    public function getPermisosBorrar($where){
    
    	$query=pg_query($this->con, "SELECT permisos_rol.borrar_permisos_rol FROM public.controladores, public.permisos_rol WHERE  controladores.id_controladores = permisos_rol.id_controladores AND  borrar_permisos_rol = 'TRUE'   AND   $where ");
    	$resultSet = array();
    	while ($row = pg_fetch_object($query)) {
    		$resultSet[]=$row;
    	}
    
    	return $resultSet;
    }
    
    
    public  function  SendMail($para, $titulo, $listaCartones)
    {
    	// Varios destinatarios
    	$para  = 'x.villamar@digitalworld.ec' . ', '; // atención a la coma
    	$para .= 'manuel@masoft.net';
    	
    	
    	// título
    	$título = 'Cartones Registrados en el Sistema Coopseguros';
    	
    	// mensaje
    	$mensaje_cabeza = '
				<html>
				<head>
				  <title>Cartones Registrados en Coopseguros</title>
				</head>
				<body>
				  <p>Listado de Cartones Registrados!</p>
				  <table>
				    <tr>
				      <th>Número Carton</th>
				    </tr>';
    	
    	$mensaje_detalle = "";
    		for ($i=0;$i<count($listaCartones);$i++)
			
              {
	    		  $mensaje_detalle .=  '<tr> <td>'. $listaCartones[$i] .'   </td></tr>' ;
              }
				  
		$mensaje_pie =  '</table>
				</body>
				</html>
				';
    	$mensaje = $mensaje_cabeza . $mensaje_detalle . $mensaje_pie;
    	// Para enviar un corre=o HTML, debe establecerse la cabecera Content-type
    	$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    	$cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    	
    	// Cabeceras adicionales
    	$cabeceras .= 'To: Manuel <desarrollo@masoft.net>, Kelly <manuel@masoft.net>' . "\r\n";
    	$cabeceras .= 'From: aDocument <info@masoft.net>' . "\r\n";
    	
    	// Enviarlo
    	mail($para, $título, $mensaje, $cabeceras );
    	
    	
    	
    }
    
    function getRealIP() {
    	if (!empty($_SERVER['HTTP_CLIENT_IP']))
    		return $_SERVER['HTTP_CLIENT_IP'];
    	 
    	if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    		return $_SERVER['HTTP_X_FORWARDED_FOR'];
    	 
    	return $_SERVER['REMOTE_ADDR'];
    }
    
    
    public function AuditoriaControladores($_accion_trazas, $_parametros_trazas, $_nombre_controlador)
    {
    
    
    	$traza=new TrazasModel();
    		
    	$funcion = "ins_trazas";
    
    	$_id_usuarios=$_SESSION['id_usuarios'];
    
    	
    	$parametros = "'$_id_usuarios', '$_accion_trazas', '$_parametros_trazas', '$_nombre_controlador'  ";
    
    	$traza->setFuncion($funcion);
    		
    	$traza->setParametros($parametros);
    		
    	$resultadoT=$traza->Insert();
    
    }
    
    public function InsertaJuicio($id_entidades,$id_ciudad,$juicio_referido_titulo_credito,$id_usuarios,$id_titulo_credito,$id_clientes,$id_etapas_juicios,$id_tipo_juicios,$descipcion_auto_pago_juicios,$id_estados_procesales_juicios,$id_estados_auto_pago_juicios,$nombre_archivado_juicios)
    {
    	//ins_juicios->FUNCION
    	//_id_entidades , _id_ciudad , _juicio_referido_titulo_credito  , _id_usuarios , _id_titulo_credito , _id_clientes , _id_etapas_juicios , _id_tipo_juicios , _descipcion_auto_pago_juicios  , _id_estados_procesales_juicios , _id_estados_auto_pago_juicios , _nombre_archivado_juicios
    	
    	$juicio=new JuiciosModel();
    	$funcion="ins_juicios";
    	$parametros="'$id_entidades','$id_ciudad','$juicio_referido_titulo_credito','$id_usuarios','$id_titulo_credito','$id_clientes','$id_etapas_juicios','$id_tipo_juicios','$descipcion_auto_pago_juicios','$id_estados_procesales_juicios','$id_estados_auto_pago_juicios','$nombre_archivado_juicios'";
    	$juicio->setFuncion($funcion);
    	$juicio->setParametros($parametros);
    	$juicio->Insert();
    	
    	//actualizar los prefijos
    	$prefijos=new PrefijosModel();
    	$colval="consecutivo=consecutivo+1";
    	$tabla="prefijos";
    	$where="id_prefijos='1'";
    	
    	$resultado=$prefijos->UpdateBy($colval, $tabla, $where);
    }
    
 
  

    public function InsertaErroresImportacion( $_origen_errores_importacion , $_error_errores_importacion, $_detalle_errores_importacion)
    {
    
    	//ins_errores_importacion(_origen_errores_importacion , _error_errores_importacion , _detalle_errores_importacion , _id_usuarios)
    
    	$errores_importacion = new ErroresImportacionModel();
    	
    
    	$funcion = "ins_errores_importacion";
    
    	$_id_usuarios=$_SESSION['id_usuarios'];
    
    	 
    	$parametros = " '$_origen_errores_importacion' , '$_error_errores_importacion' , '$_detalle_errores_importacion' ,  '$_id_usuarios'  ";
    
    	$errores_importacion->setFuncion($funcion);
    
    	$errores_importacion->setParametros($parametros);
    
    	$resultadoT=$errores_importacion->Insert();
    
    }
    
    
    function myFunctionErrorHandler($errno, $errstr, $errfile, $errline)
    {
    	/* Según el típo de error, lo procesamos */
    	switch ($errno) {
    		case E_WARNING:
    			echo "Hay un WARNING.<br />\n";
    			echo "El warning es: ". $errstr ."<br />\n";
    			echo "El fichero donde se ha producido el warning es: ". $errfile ."<br />\n";
    			echo "La línea donde se ha producido el warning es: ". $errline ."<br />\n";
    			/* No ejecutar el gestor de errores interno de PHP, hacemos que lo pueda procesar un try catch */
    			return true;
    			break;
    
    		case E_NOTICE:
    			echo "Hay un NOTICE:<br />\n";
    			/* No ejecutar el gestor de errores interno de PHP, hacemos que lo pueda procesar un try catch */
    			return true;
    			break;
    
    		default:
    			/* Ejecuta el gestor de errores interno de PHP */
    			return false;
    			break;
    	}
    }
    
    function verNotificaciones(){
    	session_start();
    	$id_usuario=$_SESSION['id_usuarios'];
    	$notificaciones=new NotificacionesModel();
    	$where_notificacion = " id_usuarios = '$id_usuario' AND visto_notificaciones=0";
    	$result_notificaciones=$notificaciones->getBy($where_notificacion);
    	
    	return $result_notificaciones;
    }
    
      
}
?>
