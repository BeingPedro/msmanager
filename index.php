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

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>

<title>MSManager</title>

<!-- LIBRERIAS: -->

<!-- jQuery library --><!--
<script src="jquery-3.1.1.min.js"></script>

Latest compiled JavaScript --><!--
<script src="js/bootstrap.min.js"></script>

Enlance con Estilos CSS  --><!--
<link rel="stylesheet" href="login.css">

Responsive BOOTSTRAP--> <!--
<meta name="viewport" content="width=device-width, initial-scale=1">
 -->
<!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
 <link rel="stylesheet" href="public/app.css">
  
</head>

<body>
	<div class="main-container">
		<div class="container">
			<div class="row">
				<div class="col s10 push-s1">
					<div class="title">
						<h1>MSManager</h1>
					</div>
 					<div class="divider"></div>
 					<div class="row">
 						<div class="col m5">
 							<img class="imagen" src="public/temperatura-arduino.png">
 						</div>
 						<div class="col s12 m7">
 							<div class="row">
 								<div class="signup-box">
	 								<form class="signup-form" action="compruebalogin.php" method="post" >
	 									<h3 class="subtitle">Introduce tus datos</h3>
										<div class="row">
											
												<input class="text" name="user" placeholder="Usuario" required></input>
												<input type="password" name="password" placeholder="Contraseña" required></input>
											
										</div>
										<div class="row">
											<div class="col s12 m12">
												<button class="btn waves-effect waves-light" type="submit" name="enviar">Entrar
									
												</button>
												<button class="btn waves-effect waves-light" type="reset" name="RESET">RESET
												</button>
											</div>
										</div>
									</form>
								</div>
 							</div>
 							<div class="row">
 								<div class="login-box center-align">
 									¿Te gustaría tener un sistema de medición? <a href="#!">Contáctar</a>
 								</div>
 							</div>
 						</div>
 					</div>
				</div>				
			</div>
		</div>
	</div>
	 <footer class="site-footer">
          <div class="container right-align">
            	© 2016 Copyright apLOOP
          </div>
    </footer>
            



	<!--jQuery y Materialize -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
 	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
</body>
</html>

