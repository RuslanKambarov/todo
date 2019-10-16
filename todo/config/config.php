<?php

error_reporting(E_ALL);

session_start();

define('HOST', "www.zzz.com.ua");
define('BASE', "junior_soprano");
define('USER', "dsfadsfdasfasdf");
define('PASS', "wwwggg1Q");


function done($i){
	return	$i ?	"Выполнено" : "Не выполнено";
}

function edited($i){
	return $i ? "Отредактировано администратором" : "";
}
?>