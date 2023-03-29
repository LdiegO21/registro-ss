<?php

	require_once "conexion.php";

	$salida= "";
	$query= "SELECT * FROM administrador ORDER By id_admin";

	if(isset($_POST['consulta']))
	{
		$q = $conn->real_escape_string($_POST['consulta']);
		$query= "SELECT * FROM administrador WHERE id_admin LIKE '%$q%' OR nombre LIKE '%$q%' OR app LIKE '%$q%' OR  apm LIKE '%$q%' OR user LIKE '%$q%' OR email LIKE '%$q%' OR telefono LIKE '%$q%' OR id_area LIKE '%$q%'";
	}
	$resultado = $conn->query($query);

	if($resultado->num_rows>0)
	{
		$salida.="<table border='1' class='tabla_datos'>
					<thead>
						<tr>
							<td>Id</td>
							<td>Nombre</td>
							<td>Apellido Paterno</td>
							<td>Apellido Materno</td>
							<td>Usuario</td>
							<td>Correo</td>
							<td>Telefono</td>
							<td>Area</td>
						</tr>
					</thead>
				<tbody>";
		while ($fila = $resultado->fetch_assoc())
		{
			$Area = $fila['id_area'];
			$ar = mysqli_query($conn,"SELECT * FROM area WHERE id_area='$Area'");
			while($row = mysqli_fetch_assoc($ar))
			{
				$_SESSION['nombre_area'] = $row['nombre_area'];
			}
			$salida.="<tr>
						<td>".$fila['id_admin']."</td>
						<td>".$fila['nombre']."</td>
						<td>".$fila['app']."</td>
						<td>".$fila['apm']."</td>
						<td>".$fila['user']."</td>
						<td>".$fila['email']."</td>
						<td>".$fila['telefono']."</td>
						<td>".$fila=$_SESSION['nombre_area']."</td>
					   </tr>";
		}
		$salida.="</tbody></table>";
	}
	else
	{
		$salida.="No hay datos :(";
	}
	echo $salida;
	$conn->close();
?>