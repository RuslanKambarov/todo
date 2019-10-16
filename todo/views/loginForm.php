<?php
	include 'header.php';
	foreach($_SESSION['alert'] as $alert){
		echo $alert;
	}
	$_SESSION['alert'] = array("");
?>
<form method = "post" action="?action=login" class="form-group">
	<div class="form-group">
	<label for="password" class = "">Login</label>
	<input type="text" name = "login" class="form-control">
	<label for="password" class = "">Password</label>
	<input type="password" name = "password" class = "form-control">
	<input type="submit" class="form-control">	
	</div>
</form>
</div>