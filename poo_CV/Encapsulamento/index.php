<!DOCTYPE html>
<html>
<head>
	<title>Controle Remoto</title>
</head>
<body>
	<h1>Projeto Controle Remoto</h1>
<pre>
	<?php
		require_once "controlador.class.php";
		$c = new ControleRemoto();
		$c->ligar();
		$c->play();
		$c->maisVolume();
		$c->maisVolume();
		$c->desligarMudo();
		$c->pause();
		$c->desligar();
		$c->ligar();






		$c->abrirMenu();
	




	?>
</pre>
</body>
</html>