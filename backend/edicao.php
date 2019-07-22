<?php

	// ============================== 
	// BACKEND - Sistema de Edição
	// ==============================
	session_start();

	// Arquivos de configuração do projeto
	require_once "include/configuracao.php";

	// conexão com banco de dados
require_once "include/conexao.php";

	// Verificação de sessão
require_once "include/sessao.php";

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