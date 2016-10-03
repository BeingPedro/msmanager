<!--Página donde se muestran los valores leidos a través de tabla y gráfica-->
<!--EN DESARROLLO-->
<?php

session_start();				//Inicio de Sesion según usuarios de la BBDD
require("credenciales.php");	//Archivo requerido para conexion de la BBDD
if(isset($_SESSION["user"])){	//Condición para pasar a la pagina principal "Panel"

?>


<!DOCTYPE html>


<html lang="es-VE">
<head>


<title>Medicion de Temperatura Remota</title>


<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--Enlance con Estilos CSS  -->
<link rel="stylesheet" href="estilos.css">

<!--Responsive BOOTSTRAP-->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!--SCRIPT PARA ACTUALIZAR TABLA-->

<script>

$(document).ready(function(){ 	//Permite visualizar el contenido de la tabla al cargar el navegador
setTimeout(loadTabla,0);
});

$(document).ready(function(){	//Refresca el contenido de la tabla cada x segundos
setInterval(loadTabla,15000);
});
function loadTabla(){
$("#actualizar").load("actualizar.php");
}

</script>

<!--SCRIPT PARA ACTUALIZAR GRÁFICA-->

<script>

$(document).ready(function(){	//Permite visualizar el contenido de la tabla al cargar el navegador
setTimeout(loadGrafica,0);
});

$(document).ready(function(){	//Refresca el contenido de la gráfica cada x segundos
setInterval(loadGrafica,15000);
});
function loadGrafica(){
$("#linea").load("actualizar2.php");
}

</script>

</head>

<body>


<header>

<div class="container-fluid">

<br>
<br>

<center><h1>Sistema de Medición de Temperatura</h1></center>

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


<!--FORMULARIO DE CONSULTA DE MEDIDAS POR FECHA-->
<center>

<form action= "formulario_busqueda.php" method="get">

<label class="label">Consultar Fecha: <input type= "text" name="buscar" size="11" maxlength="11">
</label>

<input class="button" type="submit" name="enviando" value="Buscar">

</form>

</center>

</div>

</header>

<div class="container-fluid">

<!--TABLA CON LAS LECTURAS DE TEMPERATURA-->
<center>
<?php

	/*$resultado = $enlace->query("SELECT * FROM `medidas` ORDER BY `fecha` DESC LIMIT 50;")
	or die(mysqli_error($enlace)); */


		echo "<div id='layer3'><table id=cbz>";

		echo "<thead><tr><th> ID </th>";
		echo "<th> Lectura (ºC) </th>";
		echo "<th> Fecha/Hora </th></tr></thead>";



		echo "</table><div id='actualizar'>";

		/*Contenido de la tabla en archivo Actualizar*/

		echo "</div></div>";
?>


<!--GRÁFICA CON LAS LECTURAS DE TEMPERATURA-->

<div> <?php include "graficador.php";  ?> </div>

</center>

</div>

</body>

</html>

<?php

}else {		//En caso de no haber iniciado sesión, regresa a la página de login

	echo "<script> window.location='index.php';</script>";

}
?>
