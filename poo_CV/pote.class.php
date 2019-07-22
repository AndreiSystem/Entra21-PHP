<?php
	
	class Pote {
		private $material;
		private $conteudo;
		private $corTampa;

		public function __construct($material, $conteudo, $cor) {
			$this->material = $material;
			$this->conteudo = $conteudo;
			$this->corTampa = $cor;
		}

		public function __set($atributos, $valor) {
			$this->atributos = $valor;
		}

		public function __get($atributos) {
			return $this->atributos;
		}
	}
	




?>