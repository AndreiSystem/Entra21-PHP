<?php
	class Caneta {
		public $modelo;
		private $cor;
		private $ponta;
		private $tampada;


		// serve para construir o objeto já com padrões definidos dentro da função:
		 public function __construct($modelo, $cor, $ponta) {
		 	$this->modelo = $modelo;
		 	$this->cor = $cor;
		 	$this->ponta = $ponta;
		 	$this->tampar();
		 }

		 public function tampar() {
		 	$this->tampada = true;
		 }

		 // serve para MODIFICAR um valor do atributo privado da classe:
		public function __set($atributo, $valor) {
			// $this->modelo = $valor;
			$this->$atributo = $valor;
		}

		// serve para ACESSAR o valor do atributo privado e retorna-lo:
		public function __get($atributo) {
			return $this->$atributo;
		}


		// private function __get($ponta) {
		// 	return $this->$ponta;
		// }

		// public function __set($ponta, $valor) {
		// 	$this->ponta = $valor;
		// }

		// protected $carga;
		// protected $tampada;
		// public $cor;

		// public function rabiscar() {
		// 	if ($this->tampada == true) {
		// 		echo "<p>OPS...Destampe a Caneta primeiro!</p>";
		// 	} else {
		// 		echo "<p>Estou rabiscando.... HIHI</p>";				
		// 	}

		// }

		// public function tampar() {
		// 	$this->tampada = true;
		// }

		// public function destampar() {
		// 	$this->tampada= false;
		// }
	} 





?>