<!--Página donde se muestran los valores leidos a través de tabla y gráfica
	filtrados por fecha de búsqueda-->
<?php 

session_start();				//Inicio de Sesion según usuarios de la BBDD
require("credenciales.php");	//Archivo requerido para conexion de la BBDD
if(isset($_SESSION["user"])){	//Condición para pasar a la pagina principal "Panel"
	
?>


<!DOCTYPE html>

<html lang="es-VE">
<head>


<title>Medicion de Temperatura Remota</title>

<!-- LIBRERIAS: -->

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--Enlance con Estilos CSS  -->
<link rel="stylesheet" href="estilos.css">

<!--Responsive BOOTSTRAP-->
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>


<header>

<div class="container-fluid">

<br>

<center><h2>Sistema de Medición de Temperatura</h2></center>

<center>
<?php	//INDICADOR DE CORRECTA CONEXIÓN A LA BBDD
	
	require("credenciales.php");	//Archivo requerido para conexion de la BBDD
	
	if ($enlace){					//Indica que estamos conectados correctamente a la BBDD
		
		echo "<he>BBDD:<hx> ON</hx></he>";
		echo "<br>";
		echo "<div id ='user'>Bienvenido: " . $_SESSION['user'] . "</div>";
	
	}else {
		
		echo "<h5>BBDD:<hy> OFF</hy></h5>";
	}
?>
</center>

<!--BOTÓN DE SALIR PARA CERRAR SESIÓN-->
<center>
<form action= "logout.php" method="get">
<input type ="submit" name = "salir" class="salir" value="Salir">
</form>
</center>

<!--BOTÓN PARA REGRESAR A LA PÁGINA PRINCIPAL-->
<form action= "panel.php" method="get">
<button class="regresar" type ="submit" name = "enviando" value="Regresar">Regresar</button>
</form>

</div>
</header>


<body>

<div class="container-fluid">

<!--TABLA CON LAS LECTURAS DE TEMPERATURA-->
<center>
<?php 
	
	require("credenciales.php");	//Conexión a la BBDD
	
	$busqueda= $_GET["buscar"];		//Toma de los valores introducidos en el campo buscar
	
	//Consulta a la BBDD filtrando por el formulario de búsqueda por fecha
	$resultado = $enlace->query("SELECT * FROM `medidas` WHERE `fecha` LIKE '%$busqueda%';") 
	or die(mysqli_error($enlace)); 
	
		echo "<div id='layer3'><div id='layer5'><table>";
		
		echo "<thead><tr><th> ID </th>";
		echo "<th> Lectura (ºC) </th>";
		echo "<th> Fecha/Hora </th></tr></thead>";
		
		echo "</div></table>";
		echo "<div id= 'layer1'><table>";
	
	while ($fila= mysqli_fetch_row($resultado)){
		
		//TABLA DE LECTURAS
		
		echo "<tr>";
		
		echo "<td>" . $fila[1] . "</td>";
		echo "<td>" . $fila[2] . "</td>";
		echo "<td>" . $fila[3] . "</td>";
		
		echo "</tr>";
	
	}
	echo "</table></div></div>";
	
	
	mysqli_close($enlace); 		//Cierre de la conexión
?>

<!--GRÁFICA CON LAS LECTURAS DE TEMPERATURA FILTRADA POR FECHA-->
<div id ="layer4"> <?php include 'graficador2.php'; ?>   </div>

</center>

</div>

</body>

</html>

<?php

}else {		//En caso de no haber iniciado sesión, regresa a la página de login 
	
	echo "<script> window.location='index.php';</script>";
	
}
?>