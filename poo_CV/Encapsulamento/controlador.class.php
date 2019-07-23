<?php
	require_once "controlador.interface.php";

	class ControleRemoto implements Controlador {
		// Atributos
		private $volume;
		private $ligado;
		private $tocando;
		private $vol_backup;

		// Métodos especiais
		public function __construct() {
			$this->volume = 50;
			$this->ligado = false;
			$this->tocando = false;
		}

		private function getVolume() {
			return $this->volume;
		}

		private function getLigado() {
			return $this->ligado;
		}

		private function getTocando() {
			return $this->tocando;
		}

		private function getVol_backup() {
			return $this->$vol_backup;
		}

		private function setVolume($volume) {
			$this->volume = $volume;
		}

		private function setLigado($ligado) {
			$this->ligado = $ligado;
		}

		private function setTocando($tocando) {
			$this->tocando = $tocando;
		}

		private function setVol_backup($vol_backup) {
			$this->vol_backup = $vol_backup;
		}

		public function ligar() {
			$this->setLigado(true);

		}

		public function desligar() {
			$this->setLigado(false);
		}

		public function abrirMenu() {
			if ($this->getLigado()) {
			echo "<p>---------- MENU ----------</p>";
			echo "<br>Está ligado? : " . ($this->getLigado()?"SIM" : "NÃO");
			echo "<br>Está tocando? : " . ($this->getTocando()?"SIM" : "NÃO");
			echo "<br>Volume: " . $this->getVolume();

			for ($i=0; $i<= $this->getVolume(); $i+=10) { 
				echo "|";
			}
			echo "<br>";				
			} else {
				echo "<p>Tv desligada.</p>";
			}

		}

		public function fecharMenu() {
			echo "<br>Fechando Menu...";
		}

		public function maisVolume() {
			if ($this->getLigado()) {
				$this->setVolume($this->getVolume() + 5);
				$this->setVol_backup($this->getVolume());
			} else {
				echo "<p>ERRO! Não posso aumentar o volume</p>";
			}
		}	

		public function menosVolume() {
			if ($this->getLigado() && $this->getVolume() > 0) {
				$this->setVolume($this->getVolume() - 5);
				$this->setVol_backup($this->getVolume());
			}else {
				echo "<p>ERRO! Não posso diminuir o volume</p>";
			}
		}

		public function ligarMudo() {
			if ($this->getLigado() && $this->getVolume() > 0) {
				$this->setVolume(0);
			}
		}

		public function desligarMudo() {
			if ($this->getLigado() && $this->getVolume() == 0) {
				$this->setVolume($this->vol_backup);
			}	
		}
		public function play() {
			if ($this->getLigado() && !($this->getTocando())) {
				$this->setTocando(true);
			}
		}

		public function pause() {
			if ($this->getLigado() && $this->getTocando()) {
				$this->setTocando(false);
			}
		}







	}