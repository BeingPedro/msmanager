<!DOCTYPE html>

<!--
SUB RUTINA DESTINADA PARA:
ACTUALIZACION DE LOS VALORES DE LA GRÁFICA MEDIANTE JAVASCRIPT
REVISADA Y FUNCIONAL NO TOCAR
-->


<html lang="es-VE">

<head>

<script type="text/javascript">
		
		
		
$(function () {
    $('#container').highcharts({
        title: {
            text: 'Gráfica de Lecturas',
			fontSize: '20px',
            x: -20 //center
        },
        subtitle: {
            text: 'Fuente: Tabla de Medidas ',
            x: -20
        },
        xAxis: {
            categories: [
		<?php 
	
			require 'credenciales.php'; 	//Se toma la consulta global del numero de datos almacenados en la BBDD
			$resultado = $enlace->query("SELECT * FROM `medidas` ORDER BY `i_d`;") 
			or die(mysqli_error($enlace));
			
			
			$num = mysqli_num_rows($resultado);	//Cantidad de datos almacenados en la BBDD
			$limit = $num-10;					//Se fija un limite de 10 valores para mostrar
			
			//Se genera la consulta de los valores almacenados tomando solo los ultimos 10 datos
			
			$consulta = $enlace->query("SELECT * FROM `medidas`WHERE `i_d` > '$limit' ORDER BY `i_d` ASC LIMIT 10;") 
			or die(mysqli_error($enlace));
		
			while ($fila= mysqli_fetch_row($consulta)){
			
			?>
		
		
			['<?php echo $fila[3]; ?>'],	//Impresión de la fecha
			
			<?php
			}
			mysqli_close($enlace);			//Cierre de la conexión
			?>
			]
        },
        yAxis: {
            title: {
                text: 'Temperatura (°C)'
            },
            plotOptions: {
                
                width: 8,
				Color: '#3f01ff'			
            }
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: <?php 		//Identificación del número de dispositivo conectado a la BBDD
			require 'credenciales.php';
			$resultado = $enlace->query("SELECT * FROM `medidas` ORDER BY `i_d` DESC LIMIT 10;") 
			or die(mysqli_error($enlace));
			
			$fila= mysqli_fetch_row($resultado);
			
			?>
			
			'<?php echo "Disp." . $fila[1]; 	//Impresión del número del dispositivo
			
			mysqli_close($enlace);
			?>',
			
			
            data: [
			<?php 
			
			require 'credenciales.php'; //Se toma la consulta global del numero de datos almacenados en la BBDD
			$resultado = $enlace->query("SELECT * FROM `medidas` ORDER BY `i_d`;") 
			or die(mysqli_error($enlace));
			
			
			$num = mysqli_num_rows($resultado);		//Cantidad de datos almacenados en la BBDD
			$limit = $num-10;						//Se fija un limite de 10 valores para mostrar
			
			
			//Se genera la consulta de los valores almacenados tomando solo los ultimos 10 datos
			
			$consulta = $enlace->query("SELECT * FROM `medidas` WHERE `i_d` > '$limit' ORDER BY `i_d` ASC LIMIT 10;") 
			or die(mysqli_error($enlace));
		
			while ($fila= mysqli_fetch_row($consulta)){
				
			echo $fila[2];		//Impresión de la temperatura
			
			?>, <?php
			
			}
			
			mysqli_close($enlace); //Cierre de la conexión 
			
			?> 
			],
			
			color: '#00979c' 

		}]
    });
});
		</script>

</head>

<body>


</body>


</html>