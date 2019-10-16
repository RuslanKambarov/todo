<?php

namespace controllers;

Class AdminController{
	
	function approve(){
		\models\Task::approve($_GET['task']);
		header("location: ?action=tasks");
	}

	function showEditForm(){
		require "views/showEditForm.php";
	}

	function edit(){
		\models\Task::edit($_GET['task'], $_POST['text']);
		header("location: ?action=tasks");	
	}

}