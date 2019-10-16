<?php
include 'header.php';
?>	
<form method = 'post' action='?action=create'>
		<div class="form-group">
		<label for="name" class = "">Name</label>
		<input type="text" name ="name" class = "form-control">
		<label for="email" class = "">Email</label>
		<input type="text" name ="email" class = "form-control">
		<label for="text" class = "">TEXT</label>
		<input type="text" name ="text" class = "form-control">
		<input type="submit" class = "form-control">
		</div>
</form>
