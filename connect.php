<?php

	define("DBHOST", "localhost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DBNAME", "virtual_learning");

	$conn = mysqli_connect(DBHOST, DBUSER, DBPASS);

	if ($conn) {
		mysqli_select_db($conn,DBNAME) or die(mysqli_error($conn));
	}else {
		mysqli_error($conn);
	}

	// mysqli_connect('localhost', 'root', '') or die(mysqli_error());
	// mysqli_select_db('') or die(mysqli_error());
	

?>