<!-- GRÁFICA DE BUSQUEDAS, PROBADA Y FUNCIONAL 
	********NO TOCAR********-->
<!DOCTYPE html>
<html lang="es-VE">
	<head>
		<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
		<title>Gráfica de Lecturas</title>
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
			require 'credenciales.php';		//Se realiza la conexión a la BBDD
			
			//Consulta a la BBDD filtrando por el formulario de búsqueda por fecha
			$resultado = $enlace->query("SELECT * FROM `medidas` WHERE `fecha` LIKE '%$busqueda%'LIMIT 20;") 
			or die(mysqli_error($enlace));
			
			while ($fila= mysqli_fetch_row($resultado)){
			
			?>
		
		
			['<?php echo $fila[3]; ?>'],		//Impresión de la fecha
			
			<?php
			}
			mysqli_close($enlace);				//Cierre de la conexión
			?>
			]
        },
        yAxis: {
            title: {
                text: 'Temperatura (°C)'
            },
            plotOptions: {
                
                width: 10,
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
            name: <?php 
			require 'credenciales.php';		//Se realiza la conexión a la BBDD
			
			//Consulta a la BBDD filtrando por el formulario de búsqueda por fecha
			$resultado = $enlace->query("SELECT * FROM `medidas` WHERE `fecha` LIKE '%$busqueda%'
			LIMIT 20;") 
			or die(mysqli_error($enlace));
			
			$fila= mysqli_fetch_row($resultado);
			
			?>
			
			'<?php echo "Dispositivo " . $fila[1]; 	//Impresión del número del dispositivo
			
			mysqli_close($enlace);	//Cierre de la conexión
			?>',
			
			
            data: [
			<?php 
			require 'credenciales.php';		//Se realiza la conexión a la BBDD
			
			//Consulta a la BBDD filtrando por el formulario de búsqueda por fecha
			$resultado = $enlace->query("SELECT * FROM `medidas` WHERE `fecha` LIKE '%$busqueda%' 
			LIMIT 20;") 
			or die(mysqli_error($enlace));
			
			while ($fila= mysqli_fetch_row($resultado)){
			echo $fila[2];			//Impresión de la temperatura
			?>, <?php
			
			}
			mysqli_close($enlace);	//Cierre de la conexión
			?>
			],
			color: '#00979c'
		}]
    });
});
		</script>
		
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--Responsive BOOTSTRAP-->
<meta name="viewport" content="width=device-width, initial-scale=1">
		
	</head>
	
	<body>
	
	<!-- Librerías de la herramienta graficadora Highcharts -->
	<script src="https://code.highcharts.com/highcharts.js"></script>
	<script src="https://code.highcharts.com/modules/exporting.js"></script>
	<div id="container" style="min-width: 310px; height: 340px; margin: 0 auto"></div>

	</body>
	
	
	
</html>
