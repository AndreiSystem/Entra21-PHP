
	<!-- NAVEGAÇÃO -->

	<nav class="navbar navbar-dark bg-primary">
		
		<!-- Buscar Nome do Usuário -->


		<h1 class="text-white"><strong>Bem-vindo</strong></h1>


		<nav class="navbar navbar-expand-lg navbar-primary bg-primary">

			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">

				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse left-right" id="navbarText">
				
				<ul class="navbar-nav ">
					<li class="nav-item">
					<a class="nav-link text-white breadcrumb-item active rounded mr-4" style="background-color: #3d79d9" href="#"><strong><?php echo $_SESSION['nome']; ?></strong></a>


					</li>
					<li class="nav-item active">
						<a class="nav-link" href="listagem.php">Listagem</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Notas </a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Turmas </a>
					</li>
				</ul>
				<ul href="login.php" class="nav navbar-nav navbar-right">
					<li>
						<a class="btn btn-primary" href="backend/logout.php" role="button">Sair</a>
						<!-- <a href="logout.php" class="text-white">Sair</a> -->
					</li>
				</ul>

			</div>
		</nav>	
	</nav>