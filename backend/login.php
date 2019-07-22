<?php

	// ============================== 
	// BACKEND - Sistema de Login
	// ==============================
	// Arquivos de configuração do projeto
	require_once "include/configuracao.php";
	
	// conexao
	require_once "include/conexao.php";

// Sessão
	session_start();


// Botão enviar
	if (isset($_POST['btn-entrar'])) {
		$erros = array ();
		$login = mysqli_escape_string($con, $_POST['email']);
		$senha = mysqli_escape_string($con, $_POST['senha']);
		if (empty($login) or empty($senha)) {
				$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
			} else {
				$sql = "SELECT * FROM alunos WHERE email = '$login' AND senha = '$senha'";
				$resultado = mysqli_query($con, $sql);
				if (mysqli_num_rows($resultado) > 0) {
					if (mysqli_num_rows($resultado) == 1) {
						$dados = mysqli_fetch_array($resultado);
						mysqli_close($con);
						$_SESSION['logado'] = true;
						$_SESSION['nome'] = $dados['nome'];
							
						 header('Location: listagem.php');
					} 
					// observar:
					// else {
					// 	$erros[] = "<li> Usuário ou senha não confere</li>";
					// }
				} else {
					$alerta["tipo"] = "danger";
					$alerta["mensagem"] = "<strong>Alerta!</strong> email ou senha estão incorretas";					
				}
			}	
	}
// Checkbox lembrar a senha
	if(isset($_POST["lembrar_senha"])){
	$senha=$_POST["senha"];
	$tempo_expiracao= 3600; //uma hora
	 setcookie("lembrar", $senha, $tempo_expiracao);
	}



?>