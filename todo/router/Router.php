<?php

namespace router;

Class Router{
	
	protected $action;
	protected $method;
	protected $routes =  [

		"POST" => [
			"login" 	=> "AuthController@login",
			"admin"		=> "AuthController@showLoginForm",
			"create"	=> "TaskController@saveTask",
			"edit"		=> "AdminController@edit",
		],

		"GET"  => [
			"login" 	=> "AuthController@showLoginForm",
			"logout"	=> "AuthController@logout",
			"admin"		=> "AuthController@showAdminPanel",
			"tasks"		=> "TaskController@showTasks",
			"create"	=> "TaskController@createTask",
			"approve"	=> "AdminController@approve",
			"edit"		=> "AdminController@showEditForm",
		]
	];

	function __construct(){

		if(isset($_GET['action'])){
			$this->action = $_GET['action'];
		}else{
			$this->action = "tasks";
		}

		$this->method = $_SERVER['REQUEST_METHOD'];
		
	}

	function parse(){
		if(!array_key_exists($this->action, $this->routes[$this->method])){
			die("Запрашиваемый ресурс не найден");
		}
		
		$array = explode('@', $this->routes[$this->method][$this->action]);

		
		$class = "\controllers\\".$array[0];
		$controller = new $class;
		$method = $array[1];
		$controller->$method();
	}

}