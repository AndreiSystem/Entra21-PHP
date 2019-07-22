<?php
<<<<<<< HEAD
 	// Fazendo requisição do backend da página de listagem
	// require_once "backend/listagem.php";

	// Inicializando o Site
	require_once "classes/aluno.class.php";
	
	$listagem = new Aluno();
	$listagem = $listagem->select_listagem();


=======
	error_reporting(0);
	// conexão com banco de dados
	CONST HOST = "127.0.0.1";
	CONST USER = "root";
	CONST PASS = "";
	CONST DB =   "crud";
	$con = mysqli_connect(HOST, USER, PASS, DB);
	if (!$con) {
	    die("ERRO: Não foi possível conectar =>" . mysqli_connect_error());
	}
	
	// Sessão
	session_start();
	// Verificação
	if (!isset($_SESSION['logado'])) {
		header('Location: login.php?=logout');
	}
	// Consulta no banco de dados
	$id = $_SESSION['id_usuario'];
	$sqlAlunos = "SELECT * FROM alunos";
	$queryAlunos = mysqli_query($con, $sqlAlunos);	
	mysqli_close($con);

	// Verificação se existe alerta
	// if (isset($_GET['tipo_alerta']) && isset($_GET['mensagem_alerta'])) {
	// 	$alerta = true;
	// 	$tipo_alerta = $_GET['tipo_alerta'];
	// 	$mensagem_alerta = $_GET['mensagem_alerta'];
	// } else {
	// 	$alerta = false;
	// }
	// Verificação se existe alerta com JSON
	// if (isset($_GET['alerta'])) {
	// 	$alerta = true;
	// 	$array_alerta = (array) json_decode($_GET['alerta']);
	// 	$tipo_alerta = $array_alerta["tipo"];
	// 	$mensagem_alerta = $array_alerta["mensagem"];
	// } else {
	// 	$alerta = false;
	// }
	// Verificar se existe algum alerta via COOKIE
	if (isset($_COOKIE['alerta']) && !is_null($_COOKIE['alerta'])) {
		$alerta = unserialize($_COOKIE['alerta']);
		setcookie('alerta');
	}
	
	// 	session_start();
	// if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
	// 	echo "Bem vindo ao sistema. Você está logado.";
	// } else {
	// 	echo "Página restrita. Faça login para continuar.";
	// }
>>>>>>> 6483730859575de51c0afa324c828484ce8d4f22
?>

<!DOCTYPE html>
<html>
<head>
	<title>Listagem</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="bg-secondary">

	<!-- NAVEGAÇÃO -->
<<<<<<< HEAD
	<?php require_once "include/navbar.php"; ?>
=======

	<nav class="navbar navbar-dark bg-primary">
		
		<!-- Buscar Nome do Usuário -->


		<h1 class="text-white"><strong>Bem-vindo</strong></h1>


		<nav class="navbar navbar-expand-lg navbar-primary bg-primary">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">

				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse left-right" id="navbarText">
				
				<ul class="navbar-nav ">
					<li class="nav-item">
					<a class="nav-link text-white breadcrumb-item active" href="#"><strong><?php echo $_SESSION['nome']; ?></strong></a>


					</li>
					<li class="nav-item active">
						<a class="nav-link" href="listagem.php">Listagem</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Notas </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Turmas </a>
					</li>
				</ul>
				<ul href="login.php" class="nav navbar-nav navbar-right">
					<li>
						<a class="btn btn-primary" href="logout.php" role="button">Sair</a>
						<!-- <a href="logout.php" class="text-white">Sair</a> -->
					</li>
				</ul>

			</div>
		</nav>	
	</nav>
>>>>>>> 6483730859575de51c0afa324c828484ce8d4f22

	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-1">

					<h1 class="text-white my-4 float-none">Listagem de Alunos</h1>


					
					<div class="card">
						<div class="card-body">
							<!-- PHP -->							
							<?php require_once "include/alerta.php"; ?>
							
							<!-- Fim do PHP -->
							<a href="edicao.php?id=novo" class="btn btn-success mb-3">Novo Aluno</a>
							<a href="historico.php" class="btn btn-dark mb-3 float-right">Histórico de dados</a>

							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Cod.</th>
										<th>Aluno</th>
										<th></th>
									</tr>
								</thead>
								<body>
									<!-- PHP -->
									<?php foreach ($listagem as $chave => $valor) { ?>			
										<tr>
											<td><?=$valor["id"]?></td>
											<td><?=$valor["nome"]?></td>
											<td class="text-center">
												<a href="edicao.php?id=<?=$valor["id"]?>" class="btn btn-primary btn-sm">
													Editar
												</a>
											</td>
										</tr>
									<?php } ?>
									<!-- Fim do PHP -->

								</body>
							</table>
							
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
