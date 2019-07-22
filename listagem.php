<?php
 	// Fazendo requisição do backend da página de listagem
	// require_once "backend/listagem.php";

	// Inicializando o Site
	require_once "classes/aluno.class.php";
	
	$listagem = new Aluno();
	$listagem = $listagem->select_listagem();


?>

<!DOCTYPE html>
<html>
<head>
	<title>Listagem</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body class="bg-secondary">

	<!-- NAVEGAÇÃO -->
	<?php require_once "include/navbar.php"; ?>

	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-1">

					<h1 class="text-white my-4 float-none">Listagem de Alunos</h1>


					
					<div class="card">
						<div class="card-body">
							<!-- PHP -->							
							<?php require_once "include/alerta.php"; ?>
							
							<!-- Fim do PHP -->
							<a href="edicao.php?id=novo" class="btn btn-success mb-3">Novo Aluno</a>
							<a href="historico.php" class="btn btn-dark mb-3 float-right">Histórico de dados</a>

							<table class="table table-striped table-hover">
								<thead>
									<tr>
										<th>Cod.</th>
										<th>Aluno</th>
										<th></th>
									</tr>
								</thead>
								<body>
									<!-- PHP -->
									<?php foreach ($listagem as $chave => $valor) { ?>			
										<tr>
											<td><?=$valor["id"]?></td>
											<td><?=$valor["nome"]?></td>
											<td class="text-center">
												<a href="edicao.php?id=<?=$valor["id"]?>" class="btn btn-primary btn-sm">
													Editar
												</a>
											</td>
										</tr>
									<?php } ?>
									<!-- Fim do PHP -->

								</body>
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