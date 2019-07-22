<?php

	// ============================== 
	// BACKEND - Sistema de Historico
	// ==============================

	// Arquivos de configuração do projeto
	require_once "include/configuracao.php";
	
	// Verificação de sessão
require_once "include/sessao.php";

	// Capturando a informação do COOKIE
	if (isset($_COOKIE['historico'])) {
		$historico_cookie = unserialize($_COOKIE['historico']);
		$historico = array_reverse(unserialize($_COOKIE['historico']));
	} else {
		$historico[] = [
			'tipo' => 'info',
			'mensagem' => '<center>Você não tem histórico.</center>'
		];
	}



?>