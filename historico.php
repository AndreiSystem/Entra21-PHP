<?php

	// Capturando a informação do COOKIE
	if (isset($_COOKIE['historico'])) {
		$historico_cookie = unserialize($_COOKIE['historico']);
	} else {
		echo "UAU";
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Historico</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="bg-secondary">


	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-1">

					<h1 class="text-white my-4">Histórico de atualização</h1>

					<div class="card">
						<div class="card-body p-0">
							<a href="listagem.php" class="btn btn-primary m-3">Voltar</a>

							<table class="table table-striped table-hover">



								<tbody>


		<?php foreach($historico_cookie as $key => $value) { ?>

		<tr class="table-<?=$value['tipo']?> text-center">
			<td><?=$value['mensagem']?></td>
		</tr>

		<?php } ?>



								</tbody>



							</table>

						</div>

					</div>
					
					
				</div>				
			</div>
		</div>	
	</div>



	<!-- Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>