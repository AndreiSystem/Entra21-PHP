<?php

	session_start();

	// conexão com banco de dados
	CONST HOST = "127.0.0.1";
	CONST USER = "root";
	CONST PASS = "";
	CONST DB = "crud";

	$con = mysqli_connect(HOST, USER, PASS, DB);

	if (!$con) {
	    die("ERRO: Não foi possível conectar =>" . mysqli_connect_error());
	}

// receber as variaveis por POST
	$login = $_POST['email'];
	$senha = $_POST['senha'];

// verificando as variaveis $login e $senha na tabela de alunos
	 $sql = "SELECT * FROM alunos WHERE email = '$login' AND senha = '$senha'";
	 $resultado = mysqli_query($con, $sql);
	 $linha = mysql_affected_rows($con);

// bloco IF ELSE

	 if ($linha > 0) {
		$num = rand(100000, 900000);
		setcookie("numLogin", $num);
		header('Location: listagem.php?num1=$num');	
	 } else {
		header('Location: login.php');
	 }
?>