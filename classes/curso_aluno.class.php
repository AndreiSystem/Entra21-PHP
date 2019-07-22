<?php

	require_once "site.class.php";



	class CursoAluno extends Site {
		
		public $id;
		public $fk_aluno;
		public $fk_curso;

// $sqlCursos = "SELECT * FROM cursos";
// $queryCursos = mysqli_query($con, $sqlCursos);


		// Verificando se o ID é válido
		public function verifica_id_valido($id) {
			if (is_null($id) || $id < 0 || !is_int($id)) 
				return 0;
			else
			return 1;		
		}


		public function buscar_cursos_por_id_aluno($id = null) {
			if (!$this->verifica_id_valido($id))
				return 0;

			$sql = "SELECT * FROM aluno_cursos WHERE fk_aluno = $id";
			$query = mysqli_query($this->conexao, $sql);

			if ($query)
				return mysqli_fetch_all($query, MYSQLI_ASSOC);
			else
				return 0;

		}

		public function delete_cursos_por_id_aluno($id = null) {
			if (!$this->verifica_id_valido($id))
				return 0;

			$sql = "DELETE FROM aluno_cursos WHERE fk_aluno = $id";			
			if (mysqli_query($this->conexao, $sql)) 
				return 1;
			else
				return 0;
		}
			 
		

		public function  insert_cursos_por_id_aluno ($cursos = null, $id = null) {
			if (!$this->verifica_id_valido($id))
				return 0;

			if (is_array($cursos)) {
				foreach ($cursos as $idcurso) {
			
				$sql = "INSERT INTO aluno_cursos VALUES (DEFAULT, $id, $idcurso)";
				mysqli_query($this->conexao, $sql);
				}
				return 1;
			} else {
				return 0;
			}
		}
	}

	// $CursoAluno = new CursoAluno();
	// $resultado = $CursoAluno->insert_cursos_por_id_aluno([1,3], 14);
	// $resultado2 = $CursoAluno->delete_cursos_por_id_aluno(14);
	// $resultado3 = $CursoAluno->buscar_cursos_por_id_aluno(14);
	// var_dump($resultado);
	// var_dump($resultado2);
	// var_dump($resultado3);
?>