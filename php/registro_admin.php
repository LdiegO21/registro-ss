<?php

	require_once "conexion.php";
    
	$nombre = $_POST['nombre'];
	$app = $_POST['apellidop'];
	$apm = $_POST['apellidom'];
	$usuario = $_POST['usuario'];
	$password = sha1($_POST['password']);
	$email = $_POST['email'];
	$telefono = $_POST['telefono'];
	$id_area = $_POST['area'];

	$query="INSERT INTO administrador(nombre,app,apm,user,password,email,telefono,id_area) 
			VALUES ('$nombre','$app','$apm','$usuario','$password','$email','$telefono','$id_area')";
	
	$consulta = mysqli_query($conn, "SELECT * FROM administrador WHERE user = '$usuario'");
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