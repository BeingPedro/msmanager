<?php 

/*SUB RUTINA DESTINADA PARA:
REALIZAR LA CONEXION A LA BASE DE DATOS*/ 

//Se hace la conexión a la BBDD ingresando: Host, Usuario, Contraseña, Nombre BBDD
		
$enlace = mysqli_connect("localhost", "****", "******", "temp") ;

if (mysqli_connect_errno()){ 	//En caso de generarse algún error se impreme BBDD OFF 
	
		
		echo "<h5>BBDD:<hy> OFF</hy></h5>";

	exit();
	
}
	
?>
