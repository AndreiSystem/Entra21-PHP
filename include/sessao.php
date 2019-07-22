<?php
	// Sessão
	session_start();
	// Verificação
	if (!isset($_SESSION['logado'])) {
		header('Location: login.php?=logout');
	}


?>