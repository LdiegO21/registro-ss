<?php
	session_start();
	require_once "conexion.php";

	$usuario = $_POST["usuario"];
	$password = sha1($_POST["password"]);


	$query = mysqli_query($conn,"SELECT * FROM administrador WHERE (user = '$usuario' OR email = '$usuario') and password = '$password'");
	$nr = mysqli_num_rows($query);
	if($nr > 0){
		while($rows = mysqli_fetch_assoc($query))
		{
			$_SESSION['id_admin'] = $rows['id_admin'];
			$_SESSION['nombre'] = $rows['nombre'];
			$_SESSION['app'] = $rows['app'];
			$_SESSION['apm'] = $rows['apm'];
			$_SESSION['user'] = $rows['user'];
			$_SESSION['email'] = $rows['email'];
			$_SESSION['telefono'] = $rows['telefono'];
			$_SESSION['id_area'] = $rows['id_area'];			
		}
	}
	if($nr == 1)
	{
		echo 1;
	}
	else
	{
		$c_user = mysqli_query($conn,"SELECT * FROM administrador WHERE (user='$usuario' OR email='$usuario')");
		$c_passs = mysqli_query($conn,"SELECT * FROM administrador WHERE password ='$password");
		
		$consulta_usuario = mysqli_num_rows($c_user);
		$consulta_password = mysqli_num_rows($c_passs);

		if ($consulta_usuario == 1)
		{
			if ($consulta_password == 0)
			{
				echo 2;
			}
		}
		else
		{
			echo 0;
		}
	}

?>