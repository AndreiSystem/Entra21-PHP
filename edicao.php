<?php
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

	// Consulta no banco de dados
	if (isset($_GET["id"]) && !empty($_GET["id"])) {
		$id_aluno = $_GET["id"];
	}



	// Buscar as informações do aluno atual selecionado
	if (isset($id_aluno) && $id_aluno != "novo") {
		
		$sql = "SELECT * FROM alunos WHERE id = $id_aluno";
		$query = mysqli_query($con, $sql);
		$resultado = mysqli_fetch_array($query);

		// Verificando se o aluno existe no banco de dados
		if (is_null($resultado)) {
			die("Aluno não econtrado.");
		}
	 
	 } else {
		// Quando não existe parametro  do ID do aluno, não exibe a página
		if ($id_aluno != "novo") {
			die("Página não encontrada");
		}
	}

	// Verificando a ação de salvar
	if (isset($_POST["btnSalvar"])) {
		// Recebendo as informações para salvar
		$nome = $_POST['nome_aluno'];

				
				// emitir o histórico
			$historico = unserialize($_COOKIE['historico']);		

		// Verificar se a ação é ATUALIZAR ou INSERIR
		if ($id_aluno != "novo") {
			// UPDATE 
			$sql = "UPDATE alunos SET nome = '$nome' WHERE id = $id_aluno;";


				// historico de atualização
			$historico[] = [
				'tipo' => "warning",
				'mensagem' => "Foi atualizado o Aluno do id <strong>$id_aluno</strong> para o nome $nome às " . date('d/m/Y H:i:s') 
			];
		} else {
			// INSERT
			$sql = "INSERT INTO alunos VALUES (DEFAULT, '$nome');";

				// histórico de adição
			$historico[] = [
				'tipo' => "succes",
				'mensagem' => "Foi adicionado um novo Aluno com o nome $nome às " . date('d/m/Y H:i:s')
			];
		}

		$historico = serialize($historico);

		setcookie('historico', $historico, time() + 3600 * 24);


		// Executando a ação, seja ela UPDATE ou INSERT
		if (mysqli_query($con, $sql)) {
			
			// $tipo_alerta = "success";
			// $mensagem_alerta = "Salvo com sucesso!";

			// header("Location: listagem.php?tipo_alerta=$tipo_alerta&mensagem_alerta=$mensagem_alerta");

			$alerta["tipo"] = "success";
			$alerta["mensagem"] = "Salvo com sucesso!";

			$alerta = json_encode($alerta);

			header("Location: listagem.php?alerta=$alerta");
		} else {
			die("Erro ao salvar!");			

		}
	}

	// Verificando a ação de excluir
	if (isset($_POST["btnExcluir"])) {
		
		$sql = "DELETE FROM alunos WHERE id = $id_aluno";

				// histórico de adição
			$historico[] = [
				'tipo' => "danger",
				'mensagem' => "Foi feito o delete do Aluno com o nome $nome do id $id_aluno às " . date('d/m/Y H:i:s')
			];
		if (mysqli_query($con, $sql)) {
			// $tipo_alerta = "success";
			// $mensagem_alerta = "Excluido com sucesso!";

			// header("Location: listagem.php?tipo_alerta=$tipo_alerta&mensagem_alerta=$mensagem_alerta");



			$alerta["tipo"] = "success";
			$alerta["mensagem"] = "Excluido com sucesso!";

			$alerta = json_encode($alerta);

			header("Location: listagem.php?alerta=$alerta");
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
	<meta charset="utf-8">
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
									<input type="number" name="cod_aluno" id="cod_aluno"
									placeholder="Ex: 1" class="form-control" disabled value="<?=$resultado['id']?>">
									<small class="form-text text-muted">O código do aluno é gerado automaticamente pelo stistema :)</small>
								</div>
							
								<div class="form-group">
									<label for="nome_aluno">Nome do aluno</label>
									<input type="text" name="nome_aluno" id="nome_aluno"
									placeholder="Ex: Fulano Ciclano" class="form-control" value="<?=$resultado['nome']?>" required=>
								</div>

								<input type="submit" name="btnSalvar" value="Salvar"class="btn btn-primary">

								<a href="listagem.php" class="btn btn-success">Voltar</a>
									<!-- PHP -->	
								<?php if ($id_aluno != "novo") : ?>
									<input type="submit" name="btnExcluir" value="Excluir"class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">
								<?php endif;?>
									<!-- Fim do PHP -->
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