<?php

	require_once "conexion.php";

	$salida= "";
	$query= "SELECT * FROM estudiante ORDER By matricula";

	if(isset($_POST['consulta']))
	{
		$q = $conn->real_escape_string($_POST['consulta']);
		$query= "SELECT * FROM estudiante WHERE matricula LIKE '%$q%' OR nombre LIKE '%$q%' OR app LIKE '%$q%' OR  apm LIKE '%$q%' OR tipo LIKE '%$q%' OR telefono LIKE '%$q%' OR id_area LIKE '%$q%'";
	}
	$resultado = $conn->query($query);

	if($resultado->num_rows>0)
	{
		$salida.="<table border='1' class='tabla_datos'>
					<thead>
						<tr>
							<td>Matricula</td>
							<td>Nombre</td>
							<td>Apellido Paterno</td>
							<td>Apellido Materno</td>
							<td>Tipo</td>
							<td>Telefono</td>
							<td>Area</td>
						</tr>
					</thead>
				<tbody>";
		while ($fila = $resultado->fetch_assoc())
		{
			$_POST['consulta'] = $fila['id_area'];
			$Area = $conn->real_escape_string($_POST['consulta']);
			$ar = "SELECT nombre_area FROM area WHERE id_area LIKE '$Area'";
			$a = $conn->query($ar);
			while($row = $a->fetch_assoc())
			{
				$_SESSION['nombre_area'] = $row['nombre_area'];
			}
			$salida.="<tr>
						<td>".$fila['matricula']."</td>
						<td>".$fila['nombre']."</td>
						<td>".$fila['app']."</td>
						<td>".$fila['apm']."</td>
						<td>".$fila['tipo']."</td>
						<td>".$fila['telefono']."</td>
						<td>".$fila = $_SESSION['nombre_area']."</td>
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