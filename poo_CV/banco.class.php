<?php


	class Banco {
		// Atributos
		public $numConta;
		protected $tipo;
		private $dono;
		private $saldo;
		private $status;
// =================================================================================
		// Métodos
		public function __construct() {
			$this->setStatus(false);
			$this->setSaldo(0);
			echo "<p>Conta criada com sucesso</p>";
		}
// =================================================================================
		public function abrirConta($tipo) {
			if ($this->status == true) {
				echo "Conta já está aberta<br>";
			} else {
				// $this->setDono($nome);
				$this->setStatus(true);
				$this->setTipo($tipo);

				if ($this->tipo == 'cp') {
					// echo "Você recebeu R$150,00 de bônus na sua conta poupança!";
					$this->setSaldo(150);
				} else {
					if ($this->tipo == 'cc') {
					// echo "Você recebeu R$50,00 de bônus na sua conta corrente!";
					$this->setSaldo(50);
				}
			}
		}
	}

// =================================================================================
		public function fecharConta() {
			if ($this->status == true) {
				if ($this->saldo < 0) {
					echo "Nao pode fechar a conta pois você está devendo!";
				} elseif ($this->saldo > 0) {
						echo "<p>Não pode fechar a conta pois você ainda tem dinheiro</p>";
					} else {
						echo "<p>Conta de ". $this->getDono() . " fechada com sucesso.</p>";
						$this->status = false;
					}
				} else {
				echo "Conta já foi fechada ou não está aberta.";
			}
		}
// =================================================================================
		public function depositar($valor) {
			if ($valor > 0 && $this->status == true) {
				$this->setSaldo ($this->getSaldo() + $valor);

				echo "<p>Depósito de R$$valor na conta de ". $this->getDono() . "</p>";			
			} else {
				echo "Abra sua conta primeiro!";
			}
		}
// =================================================================================
		public function sacar($valor) {
			if ($this->status == true && $this->saldo >= $valor) {
				$this->setSaldo($this->getSaldo() - $valor);
				echo "<p>Saque de R$$valor autorizado na conta de ".$this->getDono()."</p>";
			} else {
				echo "SALDO INSUFICIENTE - Tentativa de saque: $valor<br>";
				echo "Seu saldo: $this->saldo<br>";
			}
		}
// =================================================================================
		public function pagarMensal() {
				if ($this->getTipo() == 'cc') {
					$v = 12;
				} else{ 
					if ($this->getTipo() == 'cp') {
					 	$v = 20;
					}
				}
				
				if ($this->getStatus(true)) {
					$this->setSaldo($this->getSaldo() - $v);
					echo "<p>Mensalidade de R$$v debitada na conta de ". $this->getDono() ."</p>";
				} else {
					echo "Impossivel pagar, abra a conta!";
				}
			}


// ==================================================
			// Métodos Especiais
		public function setNumConta($conta) {
			$this->numConta = $conta;
		}

		public function getNumConta() {
			return $this->numConta;
		}
// ==================================================
		public function setTipo($tipo) {
			$this->tipo = $tipo;
		}

		public function getTipo() {
			return $this->tipo;
		}
// ==================================================
		public function setDono($dono) {
			$this->dono = $dono;
		}

		public function getDono() {
			return $this->dono;
		}
// ==================================================
		public function setSaldo($saldo) {
			$this->saldo = $saldo;
		}

		public function getSaldo() {
			return $this->saldo;
		}
// ==================================================
		public function setStatus($status) {
			$this->status = $status;
		}

		public function getstatus() {
			return $this->status;
		}
// ==================================================











	}
