<?php

	// ==========================
	// 	  Classe de Veículos
	// ==========================

	// Classe principal com padrões de veículos
	class Veiculos {
		// Atributo
		public $cor;
		public $marca;
		public $motor;
		public $combustivel;
		public $direcao;		

		// Função 1
		public function aumentarVelocidade() {

		}

		// Função 2
		public function diminuirVelocidade() {

		}

		// Função 3
		public function abastecer () {

		}

		// Função 4
		public function ligar () {

		}

		// Função 5
		public function desligar () {

		}

		// Função 6
		public function virarDireita () {

		}

		// Função 7
		public function virarEsquerda () {

		}
	}

	// Subclasses de tipos diferentes de veículos
	class Moto extends Veiculos {
		// Atributo
		public $rodas;
		public $retrovisor;
		public $placa;
		public $banco;
		public $guidao;

		// Função 1
		public function empinar() {

		}

		// Função 2
		public function derrapar() {

		}

		// Função 3
		public function frenar() {

		}

		// Função 4
		public function estacionar() {

		}
	}

	class Aereo extends Veiculos {
		// Atributo
		public $carcaca;
		public $turbinas;
		public $blindagem;
		public $banco;
		public $vidro;

		// Função 1
		public function voar() {

		}

		// Função 2
		public function quebrar() {

		}

		// Função 3
		public function pousar() {

		}


		// Função 4
		public function transportar() {

		}
	}

	class Carro extends Veiculos {
		// Atributos
		public $qnt_portas;
		public $modelo_trava;
		public $velocidade_maxima;
		public $modelo_trava;
		public $suspensao_ar;

		// Função 1
		public function transportar() {

		}
		
		// Função 2
		public function estacionar() {

		}
		
		// Função 3
		public function transportarBagagem() {

		}

		// Função 4
		public function abrirPorta() {

		}

	}

	class Navio extends Veiculos {
		// Atributos
		public $carcaca;
		public $material;
		public $vidro;
		public $entrada;
		public $helice;

		// Função 1
		public function navegar() {

		}

		// Função 2
		public function transportarPessoas() {

		}

		// Função 3
		public function transportarCargas() {

		}

		// Função 4
		public function embarcar() {

		}

	}
?>                                                                                                                                                                                                                  