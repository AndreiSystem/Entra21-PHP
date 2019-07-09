<?php
session_start();
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
	// Buscar as informações dos cursos e cursos do aluno
$sqlCursos = "SELECT * FROM cursos";
$queryCursos = mysqli_query($con, $sqlCursos);
	// Verificando a ação de salvar
if (isset($_POST["btnSalvar"])) {
		// Recebendo as informações para salvar
	$nome = $_POST['nome_aluno'];
	$email = $_POST['email_aluno'];
	$senha = $_POST['senha_aluno'];
	$descricao = $_POST['descricao_aluno'];
	$periodo = $_POST['periodo_aluno'];
	$cursos = $_POST['cursos'];
	$ativo = $_POST['ativo_aluno'];
		// Emite o histórico
	$historico = unserialize($_COOKIE['historico']);
		// Verificar se a ação é ATUALIZAR ou INSERIR
	if ($id_aluno != "novo") {
			// UPDATE  do Aluno
		$sql = "UPDATE alunos SET nome = '$nome', email = '$email', senha = '$senha', descricao = '$descricao', periodo = '$periodo', ativo = '$ativo_aluno' WHERE id = $id_aluno;";
			// historico de novo aluno
		$historico[] = [
			'tipo' => 'success',
			'mensagem' => "Você fez alteração do aluno <strong>$nome</strong> com o id <strong>$id_aluno</strong> às <strong>" . date('d/m/Y H:i:s')
		];
			// DELETE dos Cursos
		$sqlDeleteCursos = "DELETE FROM aluno_cursos WHERE fk_aluno = $id_aluno";
		if (mysqli_query($con, $sqlDeleteCursos)) {
					// INSERT dos Curso
			foreach ($cursos as $idcurso) {
				$sqlInsertCursos = "INSERT INTO aluno_cursos VALUES (DEFAULT, $id_aluno, $idcurso)";
				mysqli_query($con, $sqlInsertCursos);
			}				
		} 
		$historico = serialize($historico);
		setcookie('historico', $historico, time() + 3600 * 24);
		header("Location: listagem.php?alerta=$alerta");
	} else {
			// INSERT
		$sql = "INSERT INTO alunos VALUES (DEFAULT, '$nome', '$email', '$senha', '$descricao', '$periodo', '$ativo_aluno');";
			// historico de inserção
		$historico[] = [
			'tipo' => 'warning',
			'mensagem' => "Você adicionou um novo aluno <strong>$nome</strong> com o id <strong>$id_aluno</strong> às <strong>" . date('d/m/Y H:i:s')
		];
		$ultimo_id = mysqli_insert_id($con);
		foreach ($cursos as $idcurso) {
				// REINSERT dos CURSOS
			$sqlInsertCursos = "INSERT INTO aluno_cursos VALUES (DEFAULT, $ultimo_id, $idcurso)";
			mysqli_query($con, $sqlInsertCursos);
		}
		$historico = serialize($historico);
		setcookie('historico', $historico, time() + 3600 * 24);
		header("Location: listagem.php?alerta=$alerta");
	}
		// Executando a ação, seja ela UPDATE ou INSERT
	if (mysqli_query($con, $sql)) {
		$alerta["tipo"] = "success";
		$alerta["mensagem"] = "Salvo com sucesso!";
		// $alerta = json_encode($alerta);
		setcookie('alerta', serialize($alerta), time() + 20);
		header("Location: listagem.php?alerta=$alerta");
	} else {
		die("Erro ao salvar!");			
	}
}
	// Verificando a ação de excluir
if (isset($_POST["btnExcluir"])) {
	$sql = "DELETE FROM alunos WHERE id = $id_aluno";
	if (mysqli_query($con, $sql)) {
			// $tipo_alerta = "success";
			// $mensagem_alerta = "Excluido com sucesso!";
			// header("Location: listagem.php?tipo_alerta=$tipo_alerta&mensagem_alerta=$mensagem_alerta");
		$alerta["tipo"] = "danger";
		$alerta["mensagem"] = "Excluido com sucesso!";
		setcookie('alerta', serialize($alerta), time() + 20);
		header("Location: listagem.php?alerta=$alerta");
			// historico de deletar
		$nome = $_POST['nome_aluno'];
		$historico[] = [
			'tipo' => 'danger',
			'mensagem' => "Você deletou os dados do aluno <strong>$nome</strong> do id <strong>$id_aluno</strong> às <strong>" . date('d/m/Y H:i:s') ."</strong>"
		];
		$historico = serialize($historico);
		setcookie('historico', $historico, time() + 3600 * 24);
		header("Location: listagem.php?alerta=$alerta");
	} else {
		die("Erro ao excluir!");
	}
	// 	session_start();
	// if (isset($_SESSION['logado']) && $_SESSION['logado'] == true) {
	// 	echo "Bem vindo ao sistema. Você está logado.";
	// } else {
	// 	echo "Página restrita. Faça login para continuar.";
	// }
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



	<!-- NAVEGAÇÃO -->

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



	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-1">

					<h1 class="text-white my-4">Edição de Aluno</h1>
					
					<div class="card">
						<div class="card-body">

							<!-- ID -->
							<form method="post" action="" name="formEdicao">
								<div class="form-group">
									<label for="cod_aluno">Cod. do Aluno</label>
									<input type="number" name="cod_aluno" id="cod_aluno"
									placeholder="Ex: 1" class="form-control" disabled value="<?=$resultado['id']?>">
									<small class="form-text text-muted">O código do aluno é gerado automaticamente pelo stistema :)</small>
								</div>
								<!-- NOME -->
								<div class="form-group">
									<label for="nome_aluno">Nome do aluno</label>
									<input type="text" name="nome_aluno" id="nome_aluno"
									placeholder="Ex: Fulano Ciclano" class="form-control" value="<?=$resultado['nome']?>" required=>
								</div>

								<!-- E-MAIL -->
								<div class="form-group">
									<label for="email_aluno">E-mail</label>
									<input type="email" name="email_aluno" id="email_aluno" value="<?=$resultado['email']?>" placeholder="Ex: fulano@provedor.com" class="form-control" required=>
								</div>

								<!-- SENHA -->
								<div class="form-group">
									<label for="senha_aluno">Senha do Aluno</label>
									<input type="password" name="senha_aluno" id="senha_aluno" placeholder="Ex: *********" class="form-control" value="<?=$resultado['senha']?>" required=>
								</div>

								<!-- DESCRIÇÃO -->
								<div class="form-group">
									<label for="descricao_aluno">Descrição do Aluno</label>
									<textarea name="descricao_aluno" id="descricao_aluno" class="form-control" placeholder="Ex: Esse aluno é TOP."><?=$resultado['descricao']?>
								</textarea> 
							</div>

							<!-- PERIODO -->
							<div class="form-group">
								<label for="periodo_aluno">Periodo do Aluno</label>
								<select name="periodo_aluno" id="periodo_aluno" class="custom-select">
									<option value="Matutino" <?= ($resultado['periodo'] == "Matutino") ? 'selected' : '' ?>=>Matutino</option>
									<option value="Vespertino" <?= ($resultado['periodo'] == "Vespertino") ? 'selected' : '' ?>>Vespertino</option>
									<option value="Noturno" <?= ($resultado['periodo'] == "Noturno") ? 'selected' : '' ?>>Noturno</option>
								</select>
							</div>

							<!-- CURSOS -->
							<label>Cursos</label>
							<?php while($curso = mysqli_fetch_array($queryCursos)) { 
								
								// Buscando se o curso atual existe para o Aluno
								if (isset($id_aluno)) {
									$sqlCursosAluno = "SELECT * FROM aluno_cursos WHERE fk_aluno = $id_aluno AND fk_curso = " . $curso['id'] . " LIMIT 1";
									$queryCursosAluno = mysqli_query($con, $sqlCursosAluno);
									$checked = mysqli_fetch_array($queryCursosAluno);
									if (!is_null($checked)) {
										$check = "checked";
									} else {
										$check = "";
									}
								}
								?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="cursos[]" id="curso_<?=$curso['id']?>" value="<?=$curso['id']?>" class="custom-control-input" <?=$check?>>
									<label class="custom-control-label" for="curso_<?=$curso['id']?>"><?=$curso['nome']?></label>
								</div>
							<?php } ?>

							<!-- ATIVO -->
							<label class="mt-3">Atividade</label>
							<div class="custom-control custom-radio">
								<input type="radio" name="ativo_aluno" id="ativo_aluno" class="custom-control-input" value="1" <?= ($resultado['ativo'] == 1) ? 'checked' : '' ?>>
								<label class="custom-control-label" for="ativo_aluno">Ativo</label>
							</div>

							<div class="custom-control custom-radio mb-3">
								<input type="radio" name="ativo_aluno" id="inativo_aluno" class="custom-control-input" value="0" <?= ($resultado['ativo'] == 0) ? 'checked' : '' ?>>
								<label for="inativo_aluno" class="custom-control-label">Inativo</label>
							</div>

							<!-- BOTÕES -->
							<input type="submit" name="btnSalvar" value="Salvar"class="btn btn-primary">

							<a href="listagem.php" class="btn btn-success">Voltar</a>

							<!-- PHP -->	
							<?php if ($id_aluno != "novo") : ?>
								<input type="submit" name="btnExcluir" value="Excluir"class="btn btn-danger mx-3" onclick="return confirm('Tem certeza que deseja excluir?')">
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
