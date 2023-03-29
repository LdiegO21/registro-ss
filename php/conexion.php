<?php

	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "servicio";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if(!$conn)
	{
		die("Se produjo un error al conectar: ".mysql_connect_error());
	}
	
?>