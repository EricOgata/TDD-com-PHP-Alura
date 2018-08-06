<?php 
	/**
	* 
	*/
	class Lance {
		private $usuario;
		private $valor;
		
		function __construct(Usuario $usuario, $valor)
		{
			$this->usuario = $usuario;
			$this->valor = $valor;
		}

		public function getUsuario()
		{
		    return $this->usuario;
		}
		 
		public function setUsuario($usuario)
		{
		    $this->usuario = $usuario;
		    return $this;
		}

		public function getValor()
		{
		    return $this->valor;
		}
		 
		public function setValor($valor)
		{
		    $this->valor = $valor;
		    return $this;
		}
	}
?>