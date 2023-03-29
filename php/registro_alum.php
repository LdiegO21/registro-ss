<?php

	require_once "conexion.php";
   
	$matricula = $_POST['matricula'];
	$nombre = $_POST['nombre'];
	$app = $_POST['apellidop'];
	$apm = $_POST['apellidom'];
	$tipo = $_POST['tipo'];
	$telefono = $_POST['telefono'];
	$email = $_POST['email'];
	$id_area = $_POST['area'];
	

	$query="INSERT INTO estudiante(matricula,nombre,app,apm,tipo,telefono,email,id_area) 
			VALUES('$matricula','$nombre','$app','$apm','$tipo','$telefono','$email','$id_area')";
	
	$consulta = mysqli_query($conn, "SELECT * FROM estudiante WHERE matricula = '$matricula'");
	if (mysqli_num_rows($consulta)>0)
	{
		echo 2;
		exit;
	}

	$nr = mysqli_query($conn, $query);
	if(!$nr)
	{
		echo 0;
	}
	else
	{
		echo 1;
	}
	mysqli_close($conn);

?>