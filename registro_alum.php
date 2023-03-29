<?php 

	require_once "php/conexion.php";

 ?>
<!DOCTYPE html>
<html>
<head>
	<title>Registro</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/registros.css">
	<script src="js/jquery-3.2.1.min.js" charset="utf-8"></script>
</head>
<body style="background-color: gray">
<br><br><br>
<div class="registro">
	<form method="POST" id="frmRegistro">
		<h1>Registro de estudiantes</h1>
		<input type="text" id="matricula" placeholder="Matricula">
		<input type="text" id="nombre"    placeholder="Nombre(s)" style="position: absolute;right: 30px;"><br>
		<input type="text" id="apellidop" placeholder="Apellido Paterno">
		<input type="text" id="apellidom" placeholder="Apellido Materno" style="position: absolute;right: 30px;"><br>

		<fieldset>
			<legend>Tipo:</legend>
			<label><input type="radio" id="tipo" name="tipo" value="interno"> Interno</label>
			<label style="float: right;"><input type="radio" id="tipo" name="tipo" value="externo"> Externo</label>
		</fieldset>
		<br>
		<input type="text" id="telefono" placeholder="Telefono" style="position: absolute; top: 52.5%;right: 30px;">
		<input type="text" id="email"    placeholder="Correo Electronico">
		<dir class="select_alum">
			<select class="input-sm" name="area" id="area">
				<option value="0">Selecciona el area:</option>
				<?php
					$area = "SELECT * FROM area";
					$resultado = mysqli_query($conn, $area);
					while ($lista = mysqli_fetch_array($resultado))
					{?>
					<option value="<?php echo $lista['id_area']; ?> ">
						<?php echo $lista['nombre_area']; ?>
					</option>
					<?php
					}
				?>
			</select>
		</dir>
		<br><br>
		<input type="button" id="registrarNuevo" class="btn btn-registrar" value="Registrar">
	</form>
</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function(){
		$('#registrarNuevo').click(function()
		{
			if ($('#matricula').val()=="")
			{
				alert("Debes agregar la Matricula");
				return false;
			}
			if($('#nombre').val()=="")
			{
				alert("Debes agregar el Nombre");
				return false;
			}
			if($('#apellidop').val()=="")
			{
				alert("Debes agregar el Apellido Paterno");
				return false;
			}
			if ($('#apellidom').val()=="")
			{
				alert("Debes agregar el Apellido Materno");
				return false;
			}
			if(!document.querySelector('input[name="tipo"]:checked'))
			{
				alert("Selecciona un tipo");
				return false;
			}
			if($('#telefono').val()=="")
			{
				alert("Debes agregar el Telefono");
				return false;
			}
			if($('#email').val()=="")
			{
				alert("Debes agregar un correo");
				return false;
			}
			if($('#area').val()==0)
			{
				alert("Debes seleccionar un area");
				return false;
			}

			cadena="matricula="  + $('#matricula').val() +
				   "&nombre="    + $('#nombre').val() + 
				   "&apellidop=" + $('#apellidop').val() + 
				   "&apellidom=" + $('#apellidom').val() + 
				   "&tipo="      + $('input[name="tipo"]:checked').val() + 
				   "&telefono="  + $('#telefono').val()+
				   "&email="     + $('#email').val()+ 
				   "&area="      + $('#area').val();

					$.ajax(
					{
						type:"POST",
						url:"php/registro_alum.php",
						data:cadena,
						success:function(r){

							if(r==2)
							{
								alert("Ya se registro un estudiante con esta matricula, prueba con otra :)");
							}
							else if(r==1)
							{
								$('#frmRegistro')[0].reset();
								alert("Agregado con exito");
							}
							else
							{
								alert("Fallo al agregar");
							}
						}
					});
		});
	});
</script>