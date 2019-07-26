<?php

	require_once "site.class.php";

	class Usuario extends Site {

		public $conexao;

		public function __construct() {
			$this->conexao = new Conexao();
		}

		// efetua login
		public function login($login, $senha) {

			$sql = "SELECT * FROM alunos WHERE email = '$login' AND senha = '$senha'";

			$executa = mysqli_query($this->conexao->getCon(), $sql);

			if(mysqli_num_rows($executa) > 0) {
				return true;
			}else {
				return false;
			}
		}

			// if (isset($this->_POST['btn-entrar'])) {
			// $this->erros = array ();
			// $this->login = mysqli_escape_string($con, $_POST['email']);
			// $this->senha = mysqli_escape_string($con, $_POST['senha']);
			// if (empty($this->login) or empty($this->senha)) {
			// 		$this->erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
			// 	}else {
			// 		$sql = "SELECT * FROM alunos WHERE email = '$login' AND senha = '$senha'";
			// 		$resultado = mysqli_query($this->conexao, $sql);
			// 		if (mysqli_num_rows($resultado) > 0) {
			// 			if (mysqli_num_rows($resultado) == 1) {
			// 				$dados = mysqli_fetch_array($this->resultado);
			// 				mysqli_close($con);
			// 				$_SESSION['logado'] = true;
			// 				$_SESSION['nome'] = $dados['nome'];
								
			// 				 header('Location: listagem.php');
			// 			} 
			// 		} else {
			// 			$this->alerta["tipo"] = "danger";
			// 			$this->alerta["mensagem"] = "<strong>Alerta!</strong> email ou senha estão incorretas";					
			// 		}
			// 	}	
			// }	

		}

