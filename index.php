<!-- Página principal donde se muestra el login para inicio de sesión de los 
	usuarios registrados en la BBDD "usuarios"-->

<?php 

session_start();   				//Inicio de Sesion según usuarios de la BBDD
require("credenciales.php");	//Archivo requerido para conexion de la BBDD
if(isset($_SESSION["user"])){	//Condición para pasar a la pagina principal "Panel"
	
	echo "<script> window.location='panel.php';</script>"; 	//Acceso a "panel.php"
	
}

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
<link rel="stylesheet" href="login.css">

<!--Responsive BOOTSTRAP-->
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<header>


<center><h2>Sistema de Medición de Temperatura</h2></center>



</header>


<body>

<!-- Formulario para el ingreso de los datos del usuario -->
<!--Se verifica en el archivo "compruebalogin.php"-->
<form action="compruebalogin.php" method="post" > 	
<table >

<tr>
<td colspan="2"><h3>Inicio de Sesión</h3></td>
</tr>

<tr>
<td class="izq">Usuario:</td>	<!-- Usuario, campo requerido -->
<td class="der"><input type="text" name="user" required ></td> 
</tr>

<tr> 
<td class="izq">Contraseña:</td>	<!-- Contraseña, campo requerido -->
<td class="der"><input type="password" name="password" required ></td>
</tr>

<!-- Botones de LOGIN para entrar y RESET para limpiar los campos -->
<tr> 
<td><input class="login" type="submit" name="enviar" value="LOGIN"></td>
<td><input class="reset" type="reset" value="RESET"></td>
</tr>

</table>
</form>
</body>
</html>
