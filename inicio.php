<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Inicio</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/inicio.css">
	<link rel="stylesheet" type="text/css" href="css/icons.css">
	<link  rel="icon"   href="images/Logo.png" type="image/png">
	<script src="js/jquery-3.2.1.min.js" charset="utf-8"></script>
	<script src="js/jquery-latest.js"></script>
	<script src="js/jquery-rotate.js"></script>
	<script src="js/main.js"></script>
</head>

<body>
	<header>
		<div class="menu_bar">
			<label>
				Bienvenido(a): <?php echo $_SESSION['nombre'];?>
				<a class="log" href="php/salir.php"><img src="images/logout.png" class="logout"></a>
			</label>
		</div>
		<nav>
			<ul>
				<li id="home"><div><span class="house"><img src="images/home.png"></span>Inicio</div></li>
				<li class="submenu1">
					<div>
						<span class="register">
							<img src="images/register.png">
						</span>
						Registrar
						<span class="caret arrow">
							<img id="arrow1" src="images/arrow.png">
						</span>
					</div>
					<ul class="children">
						<li id="r_admin"><div>Administrador <span class="icon-dot"></span></div></li>
						<li id="r_alum"><div>Alumno <span class="icon-dot"></span></div></li>
					</ul>
				</li>
				<li class="submenu2">
					<div>
						<span class="consult">
							<img src="images/consult.png">
						</span>
						Consultas
						<span class="caret arrow">
							<img id="arrow2" src="images/arrow.png">
						</span>
					</div>
					<ul class="children">
						<li id="c_admin"><div>Administrador <span class="icon-dot"></span></div></li>
						<li id="c_alum"><div>Alumno <span class="icon-dot"></span></div></li>
						<li id="b_alum"><div>Bitacora Alumno <span class="icon-dot"></span></div></li>
					</ul>
				</li>
			</ul>
		</nav>
	</header>
	<div class="apartados" id="result"></div>
</body>
</html>

 <script type="text/javascript">
 	$(document).ready(function()
	{
		var home      = "<iframe src='home.php' frameborder='0'></iframe>";
		var r_admin   = "<iframe src='registro_admin.php' frameborder='0'></iframe>";
		var r_alum    = "<iframe src='registro_alum.php' frameborder='0'></iframe>"; 
		var c_admin   = "<iframe src='consulta_admin.php' frameborder='0'></iframe>";
		var c_alum    = "<iframe src='consulta_alum.php' frameborder='0'></iframe>"
		var b_alum    = "<iframe src='bitacora_alumno.php' frameborder='0'></iframe>"

		var bandera = 1;
		if (bandera== 1)
		{
			$("#result").html(home);
			bandera=0;
		}

		$('#home').click(function()
		{
			$("#result").html(home);
		});

		$('#r_admin').click(function()
		{
			$("#result").html(r_admin);
		});

		$('#r_alum').click(function()
		{
			$("#result").html(r_alum);
		});

		$('#c_admin').click(function()
		{
			$("#result").html(c_admin);	
		});
		$('#c_alum').click(function()
		{
			$("#result").html(c_alum);	
		});
		$('#b_alum').click(function()
		{
			$("#result").html(b_alum);	
		});
	});
 </script>