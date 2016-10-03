<?php 
/*
SUB RUTINA DESTINADA PARA:
COMPROBACION DE LOS DATOS DEL LOGIN
REVISADA Y FUNCIONAL NO TOCAR
*/

session_start();	//Inicio de Sesion según usuarios de la BBDD

?>

<!DOCTYPE html>

<html lang="es-VE">


<head>

<title>Medicion de Temperatura Remota</title>

</head>

<body>

<?php 

require("credenciales.php");	//Conexión a la BBDD

//Si se presiona el botón enviar, llamado LOGIN, se procede a hacer una consulta con la BBDD 
// "usuarios" para verificar usuario y contraseña almacenados. En este ambos con valor "admin"
if(isset($_POST['enviar'])){
	$usuario = $_POST['user'];
	$pw = $_POST['password'];
	
		//Consulta a la BBDD según valores tomados de los campos usuario y pw 
		$log=$enlace->query("SELECT * FROM `usuarios` WHERE usuarios='$usuario' AND pw='$pw'");
		
		//Verifica el número de fila que devuelve la consulta
		if(mysqli_num_rows($log)>0){
		
		$row =mysqli_fetch_array($log);	//Devuelve los valores de la consulta y los almacena
		$_SESSION["user"]= $row['usuarios'];	//Asgina el valor de "usuarios" a "user"
		
		echo "Iniciando sesion . . . " . $_SESSION["user"];
		
		//Redirecciona hacia "panel.php"
		echo "<script> window.location='panel.php';</script>";
		
		}else{	//En caso de no coincidir con ningún valor en la BBDD muestra el siguiente mensaje
		
		echo "<script> alert('Usuario o contraseña incorrectos');</script>";
		
		//Mantiene la página del login redireccionando a "index.php"
		echo "<script> window.location='index.php';</script>";
		
		
		}
	
}

?>

</body>

</html>