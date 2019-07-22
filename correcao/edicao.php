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
	if (isset($_GET['id']) && $_GET['id']!="") {
		$id_aluno = $_GET['id'];
	}

	// Buscar as informações do aluno atual selecionado
	if (isset($id_aluno) && $id_aluno!="novo") {
		$sql = "SELECT * FROM alunos WHERE id = $id_aluno";
		$query = mysqli_query($con, $sql);
		$resultado = mysqli_fetch_array($query);

		// Verificando se o aluno existe no banco de dados
		if (is_null($resultado)) {
			die("Aluno não encontrado.");
		}
	} else {
		$resultado = null;
		// Quando não existe parametro do ID do aluno, não exibe a página
		if ($id_aluno!="novo") {
			die("Página não encontrada.");
		}
	}

	// Verificando ação de salvar
	if (isset($_POST['btnSalvar'])) {
		// Recendo as informações para salvar
		$nome = $_POST['nome_aluno'];	

		if (is_null($nome) || empty($nome) || $nome=="") {
			$alerta["tipo"] = "danger";
			$alerta["mensagem"] = "Não é possível salvar nome nulo.";

			$alerta = json_encode($alerta);

			header("Location: listagem.php?alerta=$alerta");
		}

		// Verificar se a ação é ATUALIZAR ou INSERIR
		if ($id_aluno!="novo") {
			// UPDATE
			$sql = "UPDATE alunos SET nome = '$nome' WHERE id = $id_aluno;";
		} else {
			// INSERT
			$sql = "INSERT INTO alunos VALUES (DEFAULT, '$nome');";
		}

		// Executando a ação, seja ela UPDATE ou INSERT
		if (mysqli_query($con, $sql)) {
			// $tipo_alerta = "success";
			// $mensagem_alerta = "Salvo com sucesso!";

			// header("Location: listagem.php?tipo_alerta=$tipo_alerta&mensagem_alerta=$mensagem_alerta");

			// $alerta["tipo"] = "success";
			// $alerta["mensagem"] = "Salvo com sucesso!";

			// $alerta = json_encode($alerta);

			// header("Location: listagem.php?alerta=$alerta");



			// Emite o alerta
			$alerta['tipo'] = 'success';
			$alerta['mensagem'] = 'Salvo com sucesso!';

			setcookie('alerta', serialize($alerta), time() + 10);

			// Emite o historico
			$historico = unserialize($_COOKIE['historico']);

			if ($id_aluno != "novo") {
				// Historico de edição de aluno
				$historico[] = [
					'tipo' => 'warning',
					'mensagem' => "Você alterou o aluno de ID $id_aluno para o nome $nome às " . date('d/m/Y H:i:s')
				];
			} else {
				// Historico de novo aluno
				$historico[] = [
					'tipo' => 'success',
					'mensagem' => "Você criou um novo aluno com o nome $nome às " . date('d/m/Y H:i:s')
				];
			}

			$historico = serialize($historico);

			setcookie('historico', $historico, time() + 3600 * 24);

			// Volta para listagem após procedimentos
			header('Location: listagem.php');

		} else {
			die("Erro ao salvar.");
		}
	}

	// Verificando ação de excluir
	if (isset($_POST['btnExcluir'])) {
		
		$sql = "DELETE FROM alunos WHERE id = $id_aluno";

		if (mysqli_query($con, $sql)) {
			die("Excluido com sucesso!");
		} else {
			die("Erro ao excluir!");
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Edição</title>
	
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body class="bg-secondary">

	<div class="container-fluid">
		<div class="container">

			<div class="row">
				<div class="col-12 mt-1">

					<h1 class="text-white my-4">Edição de Aluno</h1>

					<div class="card">
						<div class="card-body">

							<form method="post" action="" name="formEdicao">

								<div class="form-group">
									<label for="cod_aluno">Cod. do Aluno</label>
									<input type="number" name="cod_aluno" id="cod_aluno" placeholder="Ex: 1" class="form-control" disabled value="<?=$resultado["id"]?>">
									<small class="form-text text-muted">O código do aluno é gerado automaticamente pelo sistema :)</small>
								</div>

								<div class="form-group">
									<label for="nome_aluno">Nome do aluno</label>
									<input type="text" name="nome_aluno" id="nome_aluno" placeholder="Ex: Fulano Ciclano" class="form-control" value="<?=$resultado["nome"]?>" required="">
								</div>

								<a href="listagem.php" class="btn btn-secondary">Voltar</a>
								<input type="submit" name="btnSalvar" value="Salvar" class="btn btn-primary">

								<?php if($id_aluno!="novo") : ?>
	<input type="submit" name="btnExcluir" value="Excluir" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
								<?php endif; ?>

							</form>							

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