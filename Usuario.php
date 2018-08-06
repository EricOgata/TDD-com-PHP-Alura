<?php 
	/**
	* 
	*/
	class Usuario {

		private $id;
		private $nome;

		function __construct($nome, $id = null)
		{
			$this->nome = $nome;
			$this->id 	= $id;
		}
		
	}
?>