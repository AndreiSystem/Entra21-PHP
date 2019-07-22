<?php

	// Remoção dos alertas
	error_reporting(0);

	// Conexão com o banco de dados
	CONST HOST = "127.0.0.1";
	CONST USER = "root";
	CONST PASS = "";
	CONST DB   = "crud";

	$con = mysqli_connect(HOST, USER, PASS, DB);

	if (!$con) {
		die("ERRO: Não foi possível conectar => " . mysqli_connect_error());
	}

	// Consulta no banco de dados
	$sqlAlunos = "SELECT * FROM alunos";
	$queryAlunos = mysqli_query($con, $sqlAlunos);

	// // Verificação se existe alerta
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

	// 	$tipo_alerta = $array_alerta['tipo'];
	// 	$mensagem_alerta = $array_alerta['mensagem'];
	// } else {
	// 	$alerta = false;
	// }

	// Verificar se existe algum alerta via COOKIE
	if (isset($_COOKIE['alerta']) && !is_null($_COOKIE['alerta'])) {
		$alerta = unserialize($_COOKIE['alerta']);
		setcookie('alerta');
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Listagem</title>

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-secondary">

	<div class="container-fluid">
		<div class="container">

			<div class="row">
				<div class="col-12 mt-1">

					<h1 class="text-white my-4">Listagem de Alunos</h1>

					<div class="card">
						<div class="card-body">

							<?php if (isset($alerta)) : ?>
							<div class="alert alert-<?=$alerta['tipo']?>">
								<?=$alerta['mensagem']?>
							</div>
							<?php endif; ?>

							<a href="edicao.php?id=novo" class="btn btn-success mb-3">Novo Aluno</a>
							<a href="historico.php" class="btn btn-secondary mb-3">Meu histórico de alterações</a>

							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Cod.</th>
										<th>Aluno</th>
										<th></th>
									</tr>
								</thead>
								<tbody>

									<?php while ($resultado = mysqli_fetch_array($queryAlunos)) { ?>
									<tr>
										<td><?=$resultado["id"]?></td>
										<td><?=$resultado["nome"]?></td>
										<td class="text-center">
											<a href="edicao.php?id=<?=$resultado["id"]?>" class="btn btn-primary btn-sm">
												Editar
											</a>
										</td>
									</tr>
									<?php } ?>

								</tbody>
							</table>

						</div>
					</div>

				</div>
			</div>

		</div>
	</div>

	<!-- Boostrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>