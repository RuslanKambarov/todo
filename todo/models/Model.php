<?php

namespace models;

use PDO;

Class Model{

	public $connection;

	function __construct(){

		$this->connection = new PDO("mysql:host=localhost;dbname=todo", "root", "");

	}

	function getAllTasks(){
		$tasks = $this->connection->query("select * from tasks");
		$tasks = $this->makeArray($tasks);
		return $tasks;
	}

	function makeArray($tasks){
		$arr = [];
		foreach($tasks as $task){
			$arr[] = array($task['name'], $task['email'], $task['text'], $task['status']);
		}
		return $arr;
	}

	function save($post){
		if(!$this->validate($post)){
			return "Validation error";
		}
		$sql = "INSERT INTO tasks (name, email, `text`, status) VALUES (?,?,?, 0)";
		$query = $this->connection->prepare($sql);
		$result = $query->execute([$post['name'], $post['email'], $post['text']]);
		if($result){
			return "Task created";
		}else{
			return "Error";
		}
	}

	function validate($input){
		if(!$input['name']) return false;
		if(!$input['text']) return false;
		if(!$input['email']) return false;
		if(!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $input['email'])) return false;
		return true;
	}

}

?>