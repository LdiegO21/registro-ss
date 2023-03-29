<?php

	require_once "conexion.php";

	$salida= "";
	

	if(isset($_POST['consulta']))
	{
		$q = $conn->real_escape_string($_POST['consulta']);
		$query= "SELECT * FROM estudiante WHERE matricula LIKE '%$q%'";
		$query2 ="SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(horas))) AS  hours FROM registro_alumno where matricula = '$q'";
	    $resultado2 = $conn->query($query2);
	    $resultado = $conn->query($query);
	    if($resultado2->num_rows > 0)
	    {
		   	while($rows = mysqli_fetch_assoc($resultado2))
		   	{
				$_SESSION['hours'] = $rows['hours'];				
		     
		    }  
    	}
        $hours = $_SESSION['hours'];
       	if($resultado->num_rows>0)
		{
			$salida.="<table>
						<tr class='head'>
							<td>Nombre</td>
							<td>Apellido Paterno</td>
							<td>Apellido Materno</td>
							<td>Area</td>
							<td>Tiempo Acumulado</td>
						</tr>
						<tbody>";

			while ($fila = $resultado->fetch_assoc())
			{
				$salida.="<tr>
							<td>".$fila['nombre']."</td>
							<td>".$fila['app']."</td>
							<td>".$fila['apm']."</td>
							<td>".$fila['id_area']."</td>
							<td>".$hours."</td>

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
	}
?>