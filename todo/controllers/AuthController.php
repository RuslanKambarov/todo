<?php

namespace controllers;

 Class AuthController{

 		function showAdminPanel(){
 			echo "AdminPanel";
 		}

 		function showLoginForm(){
 			require"views/loginForm.php";
 		}

 		function login(){
 			$user = new \models\User;
 			if($user->check()) {
 				$_SESSION['alert'][] = "Вы авторизованы";
 				$_SESSION['user'] = "admin";
 				header("Location: ?action=tasks");
 			}else{
				$_SESSION['alert'][] = "Неверно имя пользователя или пароль";
 				header("Location: ?action=login");
 			}
 		}

 		function logout(){
 			unset($_SESSION['user']);
 			header("Location: ?action=tasks");
 		}

 }
