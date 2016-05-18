<?php
class RecaudacionDetalleModel extends ModeloBase{
	
	private $table;
	private $where;
	private $funcion;
	private $parametros;
	
	public function getWhere() {
		return $this->where;
	}
	
	public function setWhere($where) {
		$this->where = $where;
	}
	
	public function getFuncion() {
		return $this->funcion;
	}
	
	
	public function setFuncion($funcion) {
		$this->funcion = $funcion;
	}
	
	
	
	public function getParametros() {
		return $this->parametros;
	}
	
	
	public function setParametros($parametros) {
		$this->parametros = $parametros;
	}
	
	
	
	
	public function __construct(){
		$this->table="recaudacion_detalle";
		
		parent::__construct($this->table);
	}
	

	public function Insert(){
		$resultado = "";
		$query = "SELECT ".$this->funcion."(".$this->parametros.")";
		
		try {
			$resultado=$this->enviarFuncion($query);
			
		} catch (Exception $e) 
		{
			$resultado = "Error al Insertar ->".$e;
		}
		
			
			
		return  $resultado;
	}
	
	
	
}
?>