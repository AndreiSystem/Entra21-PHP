<?php

	require_once "site.class.php";

	class Aluno extends Site {

		public $id;
		public $nome;
		public $email;
		public $senha;
		public $descricao;
		public $periodo;
		public $cursos;
		public $ativo;

		public function __construct() {
			$this->Session();
			parent::__construct();
		}


		// Função que recebe o formulario
		public function recebe_formulario() {
			$this->id = $_POST['id'];			
			$this->nome = $_POST['nome_aluno'];
			$this->email = $_POST['email_aluno'];
			$this->senha = $_POST['senha_aluno'];
			$this->descricao = $_POST['descricao_aluno'];
			$this->periodo = $_POST['periodo_aluno'];
			$this->cursos = $_POST['cursos'];
			$this->ativo_aluno = $_POST['ativo_aluno'];
		}

		// Função que busca aluno por ID
		public function select_aluno($id) {
			$sql = 'SELECT * FROM alunos WHERE id = ' . $id;
			$query = mysqli_query($this->conexao, $sql);
			return mysqli_fetch_object($query, "Aluno");
		}

		// Função que busca todos os alunos por ID
		public function select_listagem() {
			$sql = "SELECT * FROM alunos";
			$query = mysqli_query($this->conexao, $sql);
			if ($query)
				return mysqli_fetch_all($query, MYSQLI_ASSOC);
			else
				return 0;
		}
	}





?>