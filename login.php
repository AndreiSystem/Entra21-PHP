<?php 

	if($_POST) {
		require_once "classes/login.class.php";

		$usuario = new Usuario();

		$login = addcslashes($_POST['email']);
		$senha = addcslashes($_POST['senha']);

		$user = $usuario->login($login, $senha);

		if ($user == true) {
			session_start();
			$_SESSION['login'] = $login;
			$_SESSION['senha'] = $senha;

			header('Location: listagem.php');
		} else {
			$alerta["tipo"] = "danger";
 			$alerta["mensagem"] = "<strong>Alerta!</strong> email ou senha estão incorretas";					
		}
	}




// // Botão enviar
// 	if (isset($_POST['btn-entrar'])) {
// 		$erros = array ();
// 		$login = mysqli_escape_string($con, $_POST['email']);
// 		$senha = mysqli_escape_string($con, $_POST['senha']);
// 		if (empty($login) or empty($senha)) {
// 				$erros[] = "<li> O campo login/senha precisa ser preenchido </li>";
// 			} else {
// 				$sql = "SELECT * FROM alunos WHERE email = '$login' AND senha = '$senha'";
// 				$resultado = mysqli_query($con, $sql);
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


?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-secondary text-center">


	<div class="container-fluid">
		<div class="container mt-5">
			<div class="row">
				<div class="col-6 offset-3">
					<h1 class="text-white my-4">Logar</h1>
					
					<div class="card m-4">
						<div class="container">

							<!-- LOGIN -->
							<form name="formLogin" id="formlogin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin m-5">
								<!-- EMAIL -->

								<label for="email" class="sr-only">Email</label>
								<input type="email" id="email" name="email" class="form-control mb-1" placeholder="Email" required="" autofocus="">

								<!-- SENHA -->

								<label for="senha" class="sr-only">Senha</label>	
								<input type="password" id="senha" name="senha" class="form-control" placeholder="Password" required="" autofocus="">						
								<div class="checkbox mb-3">
									
										<div class="custom-control custom-checkbox my-2">
											<input type="checkbox" class="custom-control-input" id="lembrar_senha" value="lembrar_senha">
											<label class="custom-control-label" for="lembrar_senha">Lembrar minha senha</label>
										</div>
									
<?php require_once "include/alerta.php"; ?>
									<button class="btn btn-lg btn-primary btn-block" type="submit" name="btn-entrar">Entrar</button>
									<p class="mt-5 mb-3 text-muted">Entra21-2019</p>
								</form>
							</div>
						</div>

					</div>

				</div>



			</div>
		</div>





















		<!-- Bootstrap JS -->
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	</body>
	</html>
