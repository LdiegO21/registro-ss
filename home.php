<?php
	session_start();
	require_once "php/conexion.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body
		{
			font-family: sans-serif;
		}
		table
		{
			
			width: 100%;
			font-size: 16px;
		}
		table tr td
		{
			border: 1px solid;
			padding: 5px;
		}
		table >.head
		{
			border: 1px solid;
			background-color: #0D47A1;
		}
	</style>
</head>
<body>
	<div style="margin: center;">
		<table>
			<tr style="background-color: #0D47A1">
				<td>ID</td>
				<td>Nombre</td>
				<td>Apellido Paterno</td>
				<td>Apellido Materno</td>
				
			</tr>
			<tr>
				<td><?php echo $_SESSION['id_admin'];?></td>
				<td><?php echo $_SESSION['nombre'];?></td>
				<td><?php echo $_SESSION['app'];?></td>
				<td><?php echo $_SESSION['apm'];?></td>
				
			</tr>
			<tr style="background-color: #0D47A1">
				<td>Usuario</td>
				<td>Correo</td>
				<td>Telefono</td>
				<td>Area</td>
			</tr>
			<tr>
				<td><?php echo $_SESSION['user'];?></td>
				<td><?php echo $_SESSION['email'];?></td>
				<td><?php echo $_SESSION['telefono'];?></td>
				<td><?php
					/*echo $_SESSION['id_area'];*/
					$area = $_SESSION['id_area'];
					$ar = mysqli_query($conn,"SELECT * FROM area WHERE id_area='$area'");
					while($row = mysqli_fetch_assoc($ar))
					{
						$_SESSION['nombre_area'] = $row['nombre_area'];
					}
					echo $_SESSION['nombre_area'];
				?></td>
			</tr>
		</table>
	</div>
</body>
</html>