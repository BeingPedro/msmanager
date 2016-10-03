<html>	
		
		<?php
		
		require "credenciales.php";
		$resultado = $enlace->query("SELECT * FROM `medidas` ORDER BY `fecha` DESC LIMIT 50;") 
	or die(mysqli_error($enlace)); 
		
		echo "<div id= 'layer1'><table>";
	while ($fila= mysqli_fetch_row($resultado)){
		
		
		//TABLA DE LECTURAS
		
		
		
		echo "<tr>";
		
		echo "<td>" . $fila[1] . "</td>";
		echo "<td>" . $fila[2] . "</td>";
		echo "<td>" . $fila[3] . "</td>";
		
		echo "</tr>";
	
	
	}
	
	
	echo "</table></div>";
	
	//Valor mayor
	
	$resultado1 = $enlace->query("SELECT * FROM `medidas` ORDER BY `valor` DESC LIMIT 1;") 
	or die(mysqli_error($enlace));
	
	while($fila1 = mysqli_fetch_row($resultado1)){
	            echo "<br>";
	            echo "<h4>>La medición más alta ha sido: <hl>" .  $fila1[2] . " ºC " . "</hl> ocurrida el <hl>" . $fila1[3] . "</hl><br>";
	    }
	//Valor menor   
	$resultado2 = $enlace->query("SELECT * FROM `medidas` ORDER BY `valor` ASC LIMIT 1;") 
	or die(mysqli_error($enlace));
	
	while($fila2 = mysqli_fetch_row($resultado2)){
	
	echo ">La medición más baja ha sido: <hl>" . $fila2[2] . " ºC" . "</hl> ocurrida el <hl>" . $fila2[3] .  "</hl> <br></h4>";
	}
	//Valor promedio    
	$resultado3 = $enlace->query("SELECT `id` , AVG(`valor`) FROM `medidas` GROUP BY `id`;") 
	or die(mysqli_error($enlace));
	
	while($fila3 = mysqli_fetch_array($resultado3)){ 
	
	echo "<h4>El valor promedio del dispositivo <hl>" . $fila3['id'] . "</hl> ha sido: <hl>" . round($fila3['AVG(`valor`)'],2 ) . " ºC</hl></h4>";
	    
	            }
	mysqli_close($enlace);
	
	
	?>
	
	</html>	
