<?php

	class Pessoa {

		protected $nome;
		protected $idade;

		public function setNome($nome) {
			$this->nome = $nome;
		}

		public function getNome() {
			return $this->nome;
		}

		public function setIdade($idade) {
			$this->idade = $idade;
		}

		public function getIdade() {
			return $this->idade;
		}

	}

	class Colaborador extends Pessoa {

		private $salario;

		public function calcula_reajuste() {
			// ADICIONANDO SALARIO MANUAL
			$this->salario = 1000;

			if ($this->idade < 30) {
				if ($this->salario < 2000) {
					// Reajuste de teto máximo 2000
					$salario_antigo = $this->salario;
					$this->salario = $this->salario + ($this->idade/100 * $this->salario);

					return [
						'salario_antigo' => $salario_antigo,
						'novo_salario' => $this->salario
					];
				} else {
					return false;
				}
			} else {
				if ($this->salario < 3000) {
					// Reajuste de teto máximo 3000
					$salario_antigo = $this->salario;
					$this->salario = $this->salario + ($this->idade/100 * $this->salario);

					return [
						'salario_antigo' => $salario_antigo,
						'novo_salario' => $this->salario
					];
				} else {
					return false;
				}
			}
		}
	}

	$pessoa = new Colaborador();
	$pessoa->setNome("João");
	$pessoa->setIdade(19);
	$resultado = $pessoa->calcula_reajuste();

	var_dump($resultado);


	// menor 30 anos - 2000
	// maior 30 anos - 5000

?>