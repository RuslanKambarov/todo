<?php

namespace models;

Class User{
	
	public $login = "admin";
	public $password = "123";

	function __construct(){

	}

	function check(){
		if(($_POST['login'] == $this->login) && ($_POST['password'] == $this->password)){
			return true;
		}
		return false;
	}


}