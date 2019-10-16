<?php

namespace models;

use PDO;

Class Task{

	public $connection;

	function __construct(){

		$this->connection = new PDO("mysql:host=".HOST.";dbname=".BASE, USER, PASS);

	}

	function getAllTasks(){
		$rows = $this->connection->query("select count(*) as count from tasks");
		foreach($rows as $row){
			$rows = $row['count'];
		}
		$query_mod = "";
		$base_link = "?action=tasks";
		if(isset($_GET['order'])){
			$query_mod .= " order by ".$_GET['order'];
			$base_link .= "&order=".$_GET['order'];
			if(isset($_GET['desc']) && ($_GET['desc'] === "true")){
				$query_mod .= " desc";
				$base_link .= "&desc=true";	
			}	
		}
		if((isset($_GET['page'])) && ($_GET['page'] > 1)){
			$start_row = ($_GET['page']-1)*3;
			$end_row = $start_row+3;
			$query_mod .= " limit ".$start_row." , ".$end_row;
		}else{
			$query_mod .= " limit 3";
		}
		$result = $this->connection->query("select * from tasks".$query_mod);

		$tasks['tasks'] = $this->makeArray($result);
		$tasks['link'] = $base_link;
		$tasks['pages'] = ceil($rows/3);
		return $tasks;
	}

	function makeArray($tasks){
		$arr = [];
		foreach($tasks as $task){
			$arr[] = array("id" => $task['id'], "name" => $task['name'], "email" => $task['email'], "text" => $task['text'], "status" => $task['status'], "edited" => $task['edited']);
		}
		return $arr;
	}

	function save($post){
		if($this->validate($post)){
			$_SESSION['alert'] = $this->validate($post);
			return false;
		}
		$sql = "INSERT INTO tasks (name, email, `text`, status, edited) VALUES (?,?,?, 0, 0)";
		$query = $this->connection->prepare($sql);
		$result = $query->execute([$post['name'], $post['email'], $post['text']]);
		if($result){
			$_SESSION['alert'] = array("Задача создана");
		}else{
			$_SESSION['alert'] = array("Ошибка");
		}
	}

	function validate($input){
		$alerts = [];
		if(!$input['name']) $alerts[] = "Не заполнено имя";
		if(!$input['text']) $alerts[] = "Не заполнен текст";
		if(!$input['email']) $alerts[] = "Не заполнена почта";
		if(!preg_match("/^([a-z0-9_\.-]+)@([a-z0-9_\.-]+)\.([a-z\.]{2,6})$/", $input['email'])) $alerts[] = "Email не валиден";

		return $alerts;
	}

	public static function approve($id){
		if(isset($_SESSION['user'])){
			$connection =  new PDO("mysql:host=".HOST.";dbname=".BASE, USER, PASS);
			$sql = "UPDATE tasks SET status = 1 WHERE id = ?";
			$query = $connection->prepare($sql);
			$result = $query->execute([$id]);
		}else{
			die("У вас нет прав");
		}	
	}

	public static function edit($id, $text){
		if(isset($_SESSION['user'])){
			$connection =  new PDO("mysql:host=".HOST.";dbname=".BASE, USER, PASS);
			$sql = "UPDATE tasks SET `text` = ?, edited = 1 WHERE id = ?";
			$query = $connection->prepare($sql);
			$result = $query->execute([$text, $id]);
		}else{
			die("У вас нет прав");
		}	
	}

}

?>