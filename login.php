<?php 
// Conexão
	CONST HOST = "127.0.0.1";
	CONST USER = "root";
	CONST PASS = "";
	CONST DB = "crud";

	$con = mysqli_connect(HOST, USER, PASS, DB);

	if (!$con) {
	    die("ERRO: Não foi possível conectar =>" . mysqli_connect_error());
	}


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
				$sql = "SELECT email FROM alunos WHERE email = '$login' AND senha = '$senha'";
				$resultado = mysqli_query($con, $sql);

				if (mysqli_num_rows($resultado) > 0) {
					$slq = "SELECT * FROM alunos WHERE email = '$login' AND senha = '$senha'";
					$resultado = mysqli_query($con, $sql);

					if (mysqli_num_rows($resultado) == 1) {
						$dados = mysqli_fetch_array($resultado);
						mysqli_close($con);
						$_SESSION['logado'] = true;
						$_SESSION['id_usuario'] = $dados['id'];

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


?>

<!DOCTYPE html>
<html>
<head>
	<title>index</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-secondary text-center">

	<div class="container-fluid">
		<div class="container mt-5">
			<div class="row">
				<div class="col-12">
					<h1 class="text-white my-4">Logar-se</h1>
					<?php 
						if (!empty($erros)) {
							foreach ($erros as $erro) {
								echo $erro;
							}
						}


					?>
					<div class="card m-4">
						<div class="container">

							<!-- LOGIN -->
							<form name="formLogin" id="formlogin" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-signin m-5">
								<!-- EMAIL -->

								<label for="email" class="sr-only">Email</label>
								<input type="email" id="email" name="email" class="form-control" placeholder="Email" required="" autofocus="">

								<!-- SENHA -->

								<label for="senha" class="sr-only">Senha</label>	
								<input type="password" id="senha" name="senha" class="form-control" placeholder="Password" required="" autofocus="">						
								<div class="checkbox mb-3">
									<label>
										<input type="checkbox" value="registrar-me"> Lembrar minha senha
									</label>
									<?php if (isset($alerta)) :?>
									<div class="alert alert-<?=$alerta['tipo']?>">
										<?=$alerta['mensagem']?>
									</div>
									<?php endif;?>
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