<?php

	// ============================== 
	// BACKEND - Sistema de Listagem
	// ==============================
	// Conexão com banco de dados
	// Arquivos de configuração do projeto
	require_once "include/configuracao.php";
	
	require_once "include/conexao.php";

	// Verificação de sessão 
require_once "include/sessao.php";
	// Consulta no banco de dados
	// $id = $_SESSION['id_usuario'];
	$sqlAlunos = "SELECT * FROM alunos";
	$queryAlunos = mysqli_query($con, $sqlAlunos);	
	mysqli_close($con);

	// Verificar se existe algum alerta via COOKIE
	if (isset($_COOKIE['alerta']) && !is_null($_COOKIE['alerta'])) {
		$alerta = unserialize($_COOKIE['alerta']);
		setcookie('alerta');
	}
	

?>