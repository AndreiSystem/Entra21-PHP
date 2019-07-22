<?php
 	// Fazendo requisição do backend da página de edição
	require_once "backend/edicao.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edição</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<meta charset="utf-8">
</head>
<body class="bg-secondary">


	<!-- NAVEGAÇÃO -->
	<?php require_once "include/navbar.php"; ?>

	<div class="container-fluid">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-1">

					<h1 class="text-white my-4">Edição de Aluno</h1>
					
					<div class="card">
						<div class="card-body">

							<!-- ID -->
							<form method="post" action="" name="formEdicao">
								<div class="form-group">
									<label for="cod_aluno">Cod. do Aluno</label>
									<input type="number" name="cod_aluno" id="cod_aluno"
									placeholder="Ex: 1" class="form-control" disabled value="<?=$resultado['id']?>">
									<small class="form-text text-muted">O código do aluno é gerado automaticamente pelo stistema :)</small>
								</div>
								<!-- NOME -->
								<div class="form-group">
									<label for="nome_aluno">Nome do aluno</label>
									<input type="text" name="nome_aluno" id="nome_aluno"
									placeholder="Ex: Fulano Ciclano" class="form-control" value="<?=$resultado['nome']?>" required=>
								</div>

								<!-- E-MAIL -->
								<div class="form-group">
									<label for="email_aluno">E-mail</label>
									<input type="email" name="email_aluno" id="email_aluno" value="<?=$resultado['email']?>" placeholder="Ex: fulano@provedor.com" class="form-control" required=>
								</div>

								<!-- SENHA -->
								<div class="form-group">
									<label for="senha_aluno">Senha do Aluno</label>
									<input type="password" name="senha_aluno" id="senha_aluno" placeholder="Ex: *********" class="form-control" value="<?=$resultado['senha']?>" required=>
								</div>

								<!-- DESCRIÇÃO -->
								<div class="form-group">
									<label for="descricao_aluno">Descrição do Aluno</label>
									<textarea name="descricao_aluno" id="descricao_aluno" class="form-control" placeholder="Ex: Esse aluno é TOP."><?=$resultado['descricao']?>
								</textarea> 
							</div>

							<!-- PERIODO -->
							<div class="form-group">
								<label for="periodo_aluno">Periodo do Aluno</label>
								<select name="periodo_aluno" id="periodo_aluno" class="custom-select">
									<option value="Matutino" <?= ($resultado['periodo'] == "Matutino") ? 'selected' : '' ?>=>Matutino</option>
									<option value="Vespertino" <?= ($resultado['periodo'] == "Vespertino") ? 'selected' : '' ?>>Vespertino</option>
									<option value="Noturno" <?= ($resultado['periodo'] == "Noturno") ? 'selected' : '' ?>>Noturno</option>
								</select>
							</div>

							<!-- CURSOS -->
							<label>Cursos</label>
							<?php while($curso = mysqli_fetch_array($queryCursos)) { 
								
								// Buscando se o curso atual existe para o Aluno
								if (isset($id_aluno)) {
									$sqlCursosAluno = "SELECT * FROM aluno_cursos WHERE fk_aluno = $id_aluno AND fk_curso = " . $curso['id'] . " LIMIT 1";
									$queryCursosAluno = mysqli_query($con, $sqlCursosAluno);
									$checked = mysqli_fetch_array($queryCursosAluno);
									if (!is_null($checked)) {
										$check = "checked";
									} else {
										$check = "";
									}
								}
								?>
								<div class="custom-control custom-checkbox">
									<input type="checkbox" name="cursos[]" id="curso_<?=$curso['id']?>" value="<?=$curso['id']?>" class="custom-control-input" <?=$check?>>
									<label class="custom-control-label" for="curso_<?=$curso['id']?>"><?=$curso['nome']?></label>
								</div>
							<?php } ?>

							<!-- ATIVO -->
							<label class="mt-3">Atividade</label>
							<div class="custom-control custom-radio">
								<input type="radio" name="ativo_aluno" id="ativo_aluno" class="custom-control-input" value="1" <?= ($resultado['ativo'] == 1) ? 'checked' : '' ?>>
								<label class="custom-control-label" for="ativo_aluno">Ativo</label>
							</div>

							<div class="custom-control custom-radio mb-3">
								<input type="radio" name="ativo_aluno" id="inativo_aluno" class="custom-control-input" value="0" <?= ($resultado['ativo'] == 0) ? 'checked' : '' ?>>
								<label for="inativo_aluno" class="custom-control-label">Inativo</label>
							</div>

							<!-- BOTÕES -->
							<input type="submit" name="btnSalvar" value="Salvar"class="btn btn-primary">

							<a href="listagem.php" class="btn btn-success">Voltar</a>

							<!-- PHP -->	
							<?php if ($id_aluno != "novo") : ?>
								<input type="submit" name="btnExcluir" value="Excluir"class="btn btn-danger mx-3" onclick="return confirm('Tem certeza que deseja excluir?')">
							<?php endif;?>
							<!-- Fim do PHP -->
						</form>		
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