<?php
	class Caneta {
		public $modelo;
		public $cor;
		private $ponta;
		protected $carga;
		protected $tampada;

		public function rabiscar() {
			if ($this->tampada == true) {
				echo "<p>OPS...Destampe a Caneta primeiro!</p>";
			} else {
				echo "<p>Estou rabiscando.... HIHI</p>";				
			}

		}

		public function tampar() {
			$this->tampada = true;
		}

		public function destampar() {
			$this->tampada= false;
		}
	} 





?>