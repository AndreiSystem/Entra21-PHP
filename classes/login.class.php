<?php

	require_once "site.class.php";

	class Usuario extends Site {

		// public $conexao;


// ===================== PRIMEIRO MÉTODO DE LOGIN ===============================
		// public function login($login, $senha) {

		// 	if (empty($login) or empty($senha)) {
	 // 				$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
	 // 			} else {
	 // 				$sql = "SELECT * FROM alunos WHERE email = '$login' AND senha = '$senha'";
	 // 				$resultado = mysqli_query($this->conexao, $sql);
	 // 				if (mysqli_num_rows($resultado) > 0) {
	 // 					if (mysqli_num_rows($resultado) == 1) {
	 // 						$dados = mysqli_fetch_array($resultado);
	 // 						mysqli_close($con);
	 // 						$_SESSION['logado'] = true;
	 // 						$_SESSION['nome'] = $dados['nome'];
							
	 // 						 header('Location: listagem.php');
	 // 					} 
	 // 				} else {
	 // 					$alerta["tipo"] = "danger";
	 // 					$alerta["mensagem"] = "<strong>Alerta!</strong> email ou senha estão incorretas";					
	 // 				}
	 // 			}
	 // 	}	

//  ===================== SEGUNDO MÉTODO DE LOGIN ================================
		public function __construct() {
			$this->conexao = new Conexao();
		}

		// efetua login
		public function login($login, $senha) {

			$sql = "SELECT * FROM alunos WHERE email = '$login' AND senha = '$senha'";

			$executa = mysqli_query($this->conexao, $sql);

			if(mysqli_num_rows($executa) > 0) {
				return true;
			}else {
				return false;
			}
		}

		}

