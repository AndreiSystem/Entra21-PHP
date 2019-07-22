<?php

	// ================================================
	//    Aula POO - Programação Orientada à Objetos
	// ================================================

	// Criando a classe (padrão de uma entidade)
	class Pessoa {
		
		public $nome;
		public $idade;
		protected $profissao;
		private $rg;

		public function exibir_dados_pessoa() {
			echo "Essa pessoa tem o nome " . $this->nome . " e idade de " . $this->idade . " anos. E atua como " . $this->profissao;
		}

		public function setRg($rg) {
			$this->rg = $rg;
		}

	}

	class Aluno extends Pessoa {

		public $turma;

		public function exibir_dados_aluno() {
			echo "Esse aluno tem o nome " . $this->nome . " e idade de " . $this->idade . " anos. E está na turma " . $this->turma;
		}

		public function setProfissao($profissao) {
			$this->profissao = $profissao;
		}

	}

	// Instanciando uma classe
	// $joao = new Pessoa();
	// $joao->nome = "João";
	// $joao->idade = 19;
	// $joao->profissao = "Programador";
	// $joao->exibir_dados_pessoa();

	$josefhino = new Aluno();
	$josefhino->nome = "Josefhino";
	$josefhino->idade = 19;
	$josefhino->turma = "PHP";
	$josefhino->setProfissao("Programador");
	$josefhino->setRg(123);

	echo '<br>';

	var_dump($josefhino);
	die();

?>