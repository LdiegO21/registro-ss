<?php
	require_once "php/conexion.php";
?>
<script type="text/javascript">
		function startTime()
		{
			//-----------Reloj---------//
			var today = new Date();
			var hr = today.getHours();
			var min = today.getMinutes();
			var sec = today.getSeconds();
			ap = (hr  <  12) ? "<span>AM</span>":"<span>PM</span>";
			hr = (hr  ==  0) ? 12 : hr;
			hr = (hr  >  12) ? hr - 12 : hr;
			hr = checkTime(hr);
			min = checkTime(min);
			sec = checkTime(sec);
			document.getElementById("clock").innerHTML = hr+":"+min+":"+sec+" "+ap;
			//---------calendario---------//
			var months = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
			var days = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
			var curWeekDay = days[today.getDay()];
			var curDay = today.getDate();
			var curMonth = months[today.getMonth()];
			var curYear = today.getFullYear();
			var date = curWeekDay+","+curDay+" "+curMonth+" "+curYear;
			document.getElementById("date").innerHTML = date;

			var time = setTimeout(function(){ startTime(); },500);

		}
		function checkTime(i)
		{
			if (i<10)
			{
				i = "0"+i;
			}
			return i;
		}
</script>
<!DOCTYPE html>
<html>
<meta charset="utf-8">
<head>
	<title>Bitácora de llegada</title>
	<script src="js/jquery-3.2.1.min.js" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="css/clock.css">
	<link rel="stylesheet" type="text/css" href="css/bitacora.css">
</head>
<body onload="startTime()">
	<div class="registro">
		<div id="clockdate">
			<div class="clockdate-wraper">
				<?php
					$wallet = "<span id='clock'></span>";
					echo $wallet;
				?>
				<?php
					$calendar = "<span id='date'></span>";
					echo $calendar;
				?>
			</div>
		</div>
		<br><br><br>
		<form method="POST" id="frmRegistro">
			<input type="text" id="matricula" placeholder="Matricula"><br>
			<input type="button" id="registrar" name="" value="Registrar">
		</form>
	</div>
	<div class="tabla">
		<center>
			<br><br><br>
			<table>
				<tr class="head">
					<td>
						<h3>Fecha</h3>
					</td>
					<td>
						<h3>Matricula</h3>
					</td>
					<td>
						<h3>Hora de entrada</h3>
					</td>
					<td>
						<h3>Hora de salida</h3>
					</td>
					<td>
						<h3>Tiempo</h3>
					</td>
				</tr>
					<?php
					 $fecha0= new DateTime("now", new DateTimeZone('America/Mexico_City'));
		             $fecha = $fecha0->format('Y-m-d');
					$query= "SELECT * FROM registro_alumno where fecha='$fecha'";
					$result = mysqli_query($conn,$query);
					while($row = mysqli_fetch_array($result))
					{
						echo "<tr>";
						echo "<td>" . $row['fecha'] . "</td>";
					    echo "<td>" . $row['matricula'] . "</td>";
					    echo "<td>" . $row['hora_entrada'] . "</td>";
					    echo "<td>" . $row['hora_salida'] . "</td>";
					    echo "<td>" . $row['horas'] . "</td>";
					    echo "</tr>";
					}?>
			</table>
		</center>
	</div>	
</body>
</html>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#registrar').click(function()
		{
			if($('#matricula').val()=="")
			{
				alert("Ingresa tu Matricula");
				return false;
			}
			cadena="matricula=" + $('#matricula').val();
			$.ajax(
			{
				type:"POST",
				url:"php/registro.php",
				data:cadena,
				success:function(r)
				{

					if(r==3)
					{
						alert("Alumno no registrado :(");
					}
					else
					{
						if (r==1)
						{
							$('#frmRegistro')[0].reset();
							alert("Se registro su llegada :)");
							location.reload();
						}
						else
						{
							if(r==2)
							{
								$('#frmRegistro')[0].reset();
								alert("Se registro su salida, que descanse :)");
								location.reload();
							}
							else
							{
								alert("Fallo al registrar");
							}
						}
					}
				}
			});
		});
	});
</script>