<?php

	$mysqlhost = "*url*"; 
	$user = "*user*";
	$passwd = "*password*";
	
	
	$mysqli = new mysqli($mysqlhost, $user, $passwd);
	if (!$mysqli) {
		die('Could not connect: ' . mysqli_error);
	}

	$mysqli->select_db('winkel1234');
?>