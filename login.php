<?php 

	session_start();

	$login = $_POST['login'];
	$senha = $_POST['senha'];
	$entrar = $_POST['entrar'];

	// $connect = mysql_connect('nome_do_servidor','nome_de_usuario','senha');
	// $db = mysql_select_db('nome_do_banco_de_dados');


	if (!isset($_SESSION) || $_SESSION['logado']==false) {
		if ($login == "joao" && $senha == "123") {
			$_SESSION['logado'] = true;
			header('Location: listagem.php');
		} else {
			$_SESSION['logado'] = false;
			echo "Credencias inválidas.";
		}
	} else {
		header('Location: aula_session2.php');
	}




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
				<div class="col-12">
					<h1 class="text-white my-4">Logar-se</h1>
					<div class="card m-4">
						<div class="container">
							<form class="form-signin m-5">
								<label for="entrarEmail" class="sr-only">Email</label>
								<input type="email" id="entrarEmail" class="form-control" placeholder="Email" required="" autofocus="">
								<label for="entrarSenha" class="sr-only">Senha</label>						
								<input type="password" id="entrarSenha" class="form-control" placeholder="Password" required="" autofocus="">						
								<div class="checkbox mb-3">
									<label>
										<input type="checkbox" value="registrar-me"> Registrar-me
									</label>
									<button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
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