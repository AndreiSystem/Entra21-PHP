<?php

// ============================
//  Conexão com banco de dados
// ============================

// Dados de acesso
CONST HOST = "127.0.0.1";
CONST USER = "root";
CONST PASS = "";
CONST DB =   "crud";
$con = mysqli_connect(HOST, USER, PASS, DB);

// Verificando se foi efetuada a conexão
if (!$con) {
	die("ERRO: Não foi possível conectar =>" . mysqli_connect_error());
}

?>