<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="js/jquery-3.2.1.min.js" charset="utf-8"></script>
	<link  rel="icon"   href="images/Logo.png" type="image/png">
</head>
<body>
<br><br><br>
	<div class="login-box">
		<form method="post">
				<img src="images/SStec.png" class="avatar" alt="Avatar Image">
				<h1>Iniciar Sesión</h1>
				<br><br>

				<input type="text" class="campos" id="usuario" placeholder="Ingresa un Usuario o Correo">	
				<br><br>

				<input type="password" class="campos" id="password" placeholder="Ingresa una Contraseña">
				<br><br>

				<input type="button" id="entrarSistema" value="Entrar">
				<br>
				<center> <span id="result"></span> </center>
		</form>
	</div>
</body>
</html>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#entrarSistema').click(function()
		{
			if($('#usuario').val()=="")
			{
				$("#result").html("Ingresa tu usuario o correo");
				return false;
			}
			else if($('#password').val()=="")
			{
				$("#result").html("Ingresa la contraseña");
				return false;
			}

			cadena="usuario=" + $('#usuario').val() + "&password=" + $('#password').val();
			$.ajax(
			{
				type:"POST",
				url:"php/login.php",
				data:cadena,
				cache: "false",
				beforeSend: function()
				{
					$("#entrarSistema").val("Conectando...");
				},
				success:function(r)
				{
					$("#entrarSistema").val("Entrar");
					if(r==1)
					{
						location="inicio.php";
					}
					else
					{
						if(r==2)
						{
							$("#result").html("<strong>¡Error!</strong> contraseña incorrecta :(");
							return false;
						}
						else
						{   
							$("#result").html("<strong>¡Error!</strong> usuario y contraseña incorrectos :(");
							return false;
							
						}
					}
				}
			});
		});	
	});
</script>