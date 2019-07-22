<!DOCTYPE html>
<html>
<head>
	<title>BancoTOP</title>
</head>
<body>
<?php
	echo "<pre>";
	require_once "banco.class.php";

	echo "Bem Vindo ao nosso banco! <br>";

	$p1 = new Banco(); // Jubileu
	$p1->abrirConta('cc');
	$p1->setNumConta(1111);
	$p1->setDono("Jubileu");
	$p1->depositar(300);
	$p1->pagarMensal();

	$p2 = new Banco(); // Creusa
	$p2->abrirConta('cp');
	$p2->setNumConta(2222);
	$p2->setDono("Creusa");
	$p2->depositar(500);
	$p2->pagarMensal();
	$p2->sacar(1000);

	$p1->sacar(338);
	$p2->sacar(630);
	$p1->fecharConta();
	$p2->fecharConta();

	print_r($p1);

	print_r($p2);

	echo "</pre>";






?>
</body>
</html>




