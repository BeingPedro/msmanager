<?php 

/*
SUB RUTINA DESTINADA PARA:
CERRA SESION DEL LOGIN
REVISADA Y FUNCIONAL NO TOCAR
*/

session_start();	//Debe estar la sesión iniciada
session_destroy(); 	//Destruye la sesión iniciada
echo "Cerrando Sesion...";
echo "<script> window.location='index.php';</script>";
	

?>
