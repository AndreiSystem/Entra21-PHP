<?php
	
	class Pote {
		public $tampa;
		public $material;
		public $conteudo;
		public $tampada;



		function guardar() {
			if ($this->conteudo == true) {
				echo "<p>Hum...Pote com bolacha ;P</p>";
			} else {
				echo "<p>Af acabou a bolacha</p>";
			}
		}
		function tampar() {
			$this->tampada = true;
		}

		function destampar() {
			$this->tampada = false;
		}



	}




?>