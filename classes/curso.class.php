<?php

	require_once "site.class.php";



	class Curso extends Site {

		public $id;
		public $nome;

		

	}

	$curso = new Curso();

	var_dump($curso);

?>