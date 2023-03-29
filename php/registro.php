<?php

	require_once "conexion.php";


	date_default_timezone_get("America/Mexico_City");

	$matricula =$_POST['matricula'];
	
	if(alumno($matricula,$conn)==1)
	{
        $fecha0= new DateTime("now", new DateTimeZone('America/Mexico_City'));
		$fecha = $fecha0->format('Y-m-d');
        $hora=new DateTime("now", new DateTimeZone('America/Mexico_City'));
	   
		
        $query2= "SELECT * FROM registro_alumno where matricula='$matricula' and hora_salida='00:00:00'";
        $nr2 = mysqli_query($conn,$query2);
        if(mysqli_num_rows($nr2)==0){
        	   
        	   $hora1=$hora->format('H:i:s');
        	   $fecha1= new DateTime($hora1);
              $query = "INSERT INTO registro_alumno(matricula,fecha,hora_entrada,hora_salida,horas) VALUES('$matricula','$fecha','$hora1','','')";
              $nr = mysqli_query($conn, $query);
		if(!$nr)
		{
			echo 0;
		}
		else
		{
			echo 1;
		}
		mysqli_close($conn);
	      
        }else{  
        	
        	$hora2=$hora->format('H:i:s');
		   $c_hs = mysqli_query($conn, "SELECT hora_entrada FROM registro_alumno where matricula='$matricula' && fecha='$fecha'");
		    $numr = mysqli_num_rows($c_hs);
		    if($numr > 0){
	   	while($rows = mysqli_fetch_assoc($c_hs)){
		$_SESSION['hora_entrada'] = $rows['hora_entrada'];				
	     
	     }  
	 }
	    
	      $hora_entrada = $_SESSION['hora_entrada'];

           $datetime1 = new DateTime($hora_entrada);
           $datetime2 = new DateTime($hora2);
           $interval = $datetime1->diff($datetime2);
		   $formato= $interval->format('%H:%i:%s');
           $query= "UPDATE registro_alumno SET hora_salida='$hora2', horas='$formato' where matricula='$matricula' and hora_salida='00:00:00'";
            $nr = mysqli_query($conn, $query);
		if(!$nr)
		{
			echo 0;
		}
		else
		{
			echo 2;
		}
		mysqli_close($conn);
        	
        }
	
	}
	else
	{
		echo 3;
	}

	function alumno($matricula,$conn)
	{
		$alumno = "SELECT * FROM estudiante WHERE matricula='$matricula'";
		$consulta = mysqli_query($conn, $alumno);
		if (mysqli_num_rows($consulta)==1)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

?>