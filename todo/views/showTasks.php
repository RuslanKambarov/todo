<?php
	include 'header.php';	
	echo "<a href='?action=create'><button class = 'btn btn-success'>Create Task</button></a>";
	if(isset($_SESSION['user'])){
		echo "<a href='?action=logout'><button class = 'btn btn-success'>Logout</button></a>";
	}else{
		echo "<a href='?action=login'><button class = 'btn btn-success'>Login</button></a>";
	}
	echo "<a href='".$tasks['link']."&order=name'><button class = 'btn btn-success'>Order by Name</button></a>";
	echo "<a href='".$tasks['link']."&order=email'><button class = 'btn btn-success'>Order by Rmail</button></a>";
	echo "<a href='".$tasks['link']."&order=text'><button class = 'btn btn-success'>Order by Text</button></a>";
	echo "<a href='".$tasks['link']."&order=name&desc=true'><button class = 'btn btn-success'>Order by Name desc</button></a>";
	echo "<a href='".$tasks['link']."&order=email&desc=true'><button class = 'btn btn-success'>Order by Email desc</button></a>";
	echo "<a href='".$tasks['link']."&order=text&desc=true'><button class = 'btn btn-success'>Order by Text desc</button></a>";
	if(isset($_SESSION['alert'])){
		foreach($_SESSION['alert'] as $alert){
			echo	"<div class='alert alert-primary' role='alert'>".$alert."</div>";
		}
	}
	echo "<table class = 'table'>";
	echo "<tr><th>Username</th><th>email</th><th>Задача</th><th>Статус</th><th>Отредактировано</th><th>Действия</th></tr>";
	foreach($tasks['tasks'] as $task){
		echo "<tr><td>".$task["name"]."</td><td>".$task["email"]."</td><td>".htmlspecialchars($task["text"])."</td><td>".done($task["status"])."</td><td>".edited($task["edited"]) ."</td>"; if(isset($_SESSION['user'])) { echo "<td><a href = '?action=approve&task=".$task['id']."'>Завершено</a><br><a href = '?action=edit&task=".$task['id']."'>Редактировать</a></td>"; } echo "</tr>";
	}
	echo "</table>";

	if($tasks['pages'] > 1){
		echo "<table class = 'table'><tr>";
			for($i = 1; $i <= $tasks['pages']; $i++){
				echo "<td><a href='".$tasks['link']."&page=".$i."'>".$i."</a></td>";
			}
		echo "</tr></table>";	
	}
	
	$_SESSION['alert'] = array("");
?>