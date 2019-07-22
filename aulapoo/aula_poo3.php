<?php


	// ====================== 
	//   	Aula POO - 3
	// ======================

	class Carro {

		protected $cor;
		protected $qnt_rodas;
		protected $qnt_portas;

		// Método mágico de construtor
		public function __construct() {
			echo "vRUMAMmMMmMMmM!";
			echo "<bro>";
			echo "b0ra4 QUE a Gas0l1n4 t@ c4r4.";

			// Definindo Campos default
			$this->cor = "Azul";
			$this->qnt_rodas = 4;
			$this->qnt_portas = 4;
		}


		// Método mágico de destrutor
		public function __destruct() {
			echo "Quebrou :(";
			echo "<br>";
			echo "Traz a fita isolante que resolve.";
		}


		// Método mágico de set
		public function __set($atributo, $valor) {
			$this->$atributo = $valor;
		}


		// Método mágico de get
		public function __get($atributo) {
			return $this->$atributo;
		}
	}
	$fusca = new Carro();
	$fusca->cor = "Vermelho";
	echo $fusca->cor;

	echo "<pre>";
	var_dump($fusca);
	echo "</pre>";



?>