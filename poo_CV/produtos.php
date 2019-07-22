<!DOCTYPE html>
<html>
<head>
	<title>Produtos</title>
</head>
<body>
<pre>
	<?php
		require_once "caneta.class.php";

		$c1 = new Caneta("Bic", "Azul", 0.5);
		$c2 = new Caneta("Faber", "Verde", 1.0);
		print_r($c1);
		echo "<br>";
		print_r($c2);

		require_once "pote.class.php";

		$p1 = new Pote ("Vidro", "Bolacha", "Branca");
		print_r($p1);
		$p2 = new Pote ("Plástico", "Arroz", "Preta");
		print_r($p2);



		// $c1->modelo = "Bic";
		// $c1->ponta = 0.5;

		// echo 'Eu tenho uma caneta ' .$c1->modelo. ' de ponta ' .$c1->ponta;








		// $c1->modelo = "BIC cristal";
		// $c1->cor = "Azul";
		// print_r($c1);
		// $c1->rabiscar();
		






		// $c1->cor = "Vermelho";
		// $c1->ponta = 0.5;
		// $c1->tampar();
		// $c1->rabiscar();
		// print_r($c1);
		// // var_dump($c1);

		// echo "<br>";

		// $c2 = new Caneta;
		// $c2->cor = "Azul";
		// $c2->carga = 50;
		// $c2->tampar();
		// print_r($c2);

	// require_once "pote.class.php";

	// $pote1 = new Pote;
	// $pote1->tampa = true;
	// $pote1->material = "Vidro";
	// $pote1->conteudo = false;
	// $pote1->guardar();
	// $pote1->tampar();

	// print_r($pote1);

	?>
</pre>

</body>
</html>