<?php 

/*
SUB RUTINA DESTINADA PARA:
INTRODUCCION DE LOS DATOS ENVIADOS POR ARDUINO HACIA LA BBDD 
*/

	
require 'credenciales.php';         //Se requiere archivo de ingreso a la BBDD

date_default_timezone_set('America/Caracas');           //Se establece la zona horaria

$fecha = date('Y-m-d H:i:s A');         //Se fija un formato de fecha y hora

/*  Se genera la introducción de datos mediante una consulta GET donde se envian las 
    siguientes variables:
    valor: lectura de temperatura.
    id: número identificador del dispositivo.
    fecha: Fecha y hora de envío.   */
if($enlace->query("INSERT INTO `medidas` (`valor`,`id` , `fecha`) VALUES ('" . $_GET['valor'] . 
                   "','" . $_GET['id'] . "', '$fecha' )")){

            echo "Dato Enviado con Exito"; //Se imprime en caso de haber completado la consulta
}else{

            echo "Dato No enviado";         //Se imprime si no se completo la consulta
};

mysqli_close($enlace);          //Cierre de la conexíon

?>

