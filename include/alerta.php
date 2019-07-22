<?php
	if (isset($_COOKIE['alerta']) && !is_null($_COOKIE['alerta'])) {
		$alerta = unserialize($_COOKIE['alerta']);
		setcookie('alerta');
	}


?>




<?php if (isset($alerta)) : ?>
	<div class="alert alert-<?=$alerta['tipo']?>">
		<?=$alerta['mensagem']?>
	</div>
<?php endif; ?>