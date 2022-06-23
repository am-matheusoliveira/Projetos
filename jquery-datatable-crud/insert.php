<?php
	include('database connection.php');
	include('function.php');

	if(isset($_POST["operation"])){
		if($_POST["operation"] == "Salvar"){
			$statement = $connection->prepare("INSERT INTO course (course, students) VALUES (:course, :students)");
			$result = $statement->execute(
				array(
					  ':course'   => $_POST["course"],
					  ':students' => $_POST["students"]
				)
			);
		}

		if($_POST["operation"] == "Adicionar"){
			$statement = $connection->prepare("UPDATE course SET course = :course, students = :students WHERE id = :id");
			$result = $statement->execute(
				array(
					':course'   => $_POST["course"],
					':students' => $_POST["students"],
					':id'       => $_POST["course_id"]
				)
			);
		}
	}
?>