<?php 

	class Site {
		
		// Dados de acesso ao MySQL
		CONST HOST = "127.0.0.1";
		CONST USER = "root";
		CONST PASS = "";
		CONST DB   = "crud";

		// Atributos da classe
		public $conexao;

		// Método construtor
		public function __construct() {
			$this->Conexao();
		}

		// Função que inicia uma conexão com o banco de dados
		public function Conexao() {

			// Criando conexão
			$this->conexao = mysqli_connect(self::HOST, self::USER, self::PASS, self::DB);

			// Verificando se foi efetuada com sucesso
			if (!$this->conexao) {
				die("ERRO: Não foi possível conectar => " . mysqli_connect_error());
			}

		}

		// public function getCon() {
		// 	return $this->con;
		// } 

		public function Session() {
			// Inicia a sessão
			session_start();
			
			// Verificação
			if (!isset($_SESSION['logado'])) {
				header('Location: login.php?=logout');
			}
		}
	}

?>