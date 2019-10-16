<?php

namespace controllers;

//use models;

Class TaskController{
	
	function __construct(){
		
	}

	function showTasks(){
		$db = new \models\Task;
		$tasks = $db->getAllTasks();
		require "views/showTasks.php";
	}

	function createTask(){
		require "views/createTask.php";
	}

	function saveTask(){
		$db = new \models\Task;
		$db->save($_POST);
		$tasks = $db->getAllTasks();
		header("Location: ?action=tasks");
	}
}