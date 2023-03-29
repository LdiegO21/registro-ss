<?php
	
	require_once "php/conexion.php"
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
		<h1>Registrar usuarios</h1>
		<input type="text" id="nombre" placeholder="Nombre(s)">
		<input type="text" id="apellidop" placeholder="Apellido Paterno" style="position: absolute;right: 30px;"><br>
		<input type="text" id="apellidom" placeholder="Apellido Materno">
		<input type="text" id="usuario" placeholder="Usuario" style="position: absolute;right: 30px;"><br>
		<input type="text" id="password" placeholder="Contraseña">
		<input type="text" id="email" placeholder="Correo Electronico" style="position: absolute;right: 30px;"><br>
		<input type="text" id="telefono" placeholder="Telefono">
		<div class="select_admin">
			<select name="area" id="area">
				<option selected disabled value="0">Selecciona el area:</option>
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
		</div>
				<br><br>
		<input type="button" id="Nuevo" value="Registrar">
	</form>
</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#Nuevo').click(function(){

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
			if ($('#usuario').val()=="")
			{
				alert("Debes agregar el Usuario");
				return false;
			}
			if($('#password').val()=="")
			{
				alert("Debes agregar una Contraseña");
				return false;
			}
			if($('#email').val()=="")
			{
				alert("Debes agregar el Correo");
				return false;
			}
			if($('#telefono').val()=="")
			{
				alert("Debes agregar un Telefono");
				return false;
			}
			if($('#area').val()==0)
			{
				alert("Debes seleccionar un area");
				return false;
			}

			cadena="nombre="     + $('#nombre').val() + 
				   "&apellidop=" + $('#apellidop').val() + 
				   "&apellidom=" + $('#apellidom').val() + 
				   "&usuario="   + $('#usuario').val() +
				   "&password="  + $('#password').val() +
				   "&email="     + $('#email').val() +
				   "&telefono="  + $('#telefono').val()+
				   "&area="      + $('#area').val();

					$.ajax(
					{
						type:"POST",
						url:"php/registro_admin.php",
						data:cadena,
						success:function(r){

							if(r==2)
							{
								alert("Este usuario ya existe, prueba con otro :)");
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