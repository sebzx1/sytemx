<?php 
require "secciones/encabezado.php" //invoca el encabezado php
?>

<!--------------------------------------------------------------------------------------->

	<article class="contenidoFormularios"> <!-- formulario -->

		<h4 class="text-left">Inventario de articulos o Servicios</h4> <!-- nombre de la categoria -->

		<hr> <!-- liena que atraviesa el form -->

		<div class="consulta">

		<table class="table"> <!-- se crea la tabla -->

	      <thead> <!-- se crea bloque de filas para mostrar-->
	        <tr>  <!-- representa a la sección de encabezado de una tabla -->           
	          <th>Barras</th><!-- celdas de encabezado -->
	          <th>Sku</th>
	          <th>Categoria</th> 
	          <th>Producto</th>
	          <th>Marca</th>
	          <th>Imagen</th>
	          <th>Cantidad</th>	 
	          <th>Valor</th> 
	          <th>Iva</th>
	          <th>Dias Restantes</th> 
	        </tr>
	      </thead>

	      <tbody> <!-- contiene a un bloque de filas que representaa a la sección del cuerpo -->

	      	<!-- CONSULTAR -->

<!--------------------------------------------------------------------------------------->
	
	         <?php //inicio del php para el boton editar y borar
	         	date_default_timezone_set("America/Bogota");

	         	function dias_pasados($fecha_inicial,$fecha_final){
					$dias = (strtotime($fecha_inicial)-strtotime($fecha_final))/86400;
					$dias = $dias; 
					$dias = floor($dias);
					return $dias;
				}
				error_reporting(E_ALL); /*reporte de error*/

				//selecciona las tablas categorias, subcategorias, producto.
				$sql = "SELECT s.nombreProducto,c.nombre categoria,p.productoServicio,p.imagen,SUM(p.cantidad) cantidad,p.valor,p.descripcion,p.marca,p.fechaVencimiento,p.barras,p.sku,p.iva,p.marca
					 FROM productos p
                     INNER JOIN categorias c ON c.codigo = p.categoria
					 INNER JOIN subcategoria s ON p.nombre = s.codigo
                     GROUP BY p.nombre";

				$ejecutar = $conexion->query($sql); //ejecuta la conexion

				while ($row = mysqli_fetch_object($ejecutar)){ //mientras se ejecute
					$actual  = date('Y-m-d');
					$dias =  dias_pasados($row->fechaVencimiento,$actual);
					$cantidad =  $row->cantidad;
					if($cantidad <= 0){
						$cantidad = '<td style="background:red; color:white;font-weight:bold">'.$cantidad.'</td>';
					}else{
						$cantidad = '<td>'.$cantidad.'</td>';
					}

					if($dias <0){
						$diasRestantes = '<td style="background:red; color:white;font-weight:bold">Vencido por '.abs($dias).' días</td>';
					}else{
						$diasRestantes = '<td>'.$dias.' días</td>';
					}
				    echo '<tr>
				    		<td>'.$row->barras.'</td>
				    		<td>'.$row->sku.'</td>
				    		<td>'.$row->categoria.'</td>
				    		<td>'.$row->nombreProducto.'</td>
				    		<td>'.$row->marca.'</td>
				    		<td><img src="img/productos/small/'.$row->imagen.'"></td>
				    		'.$cantidad.'	
				    		<td>'.$row->valor.'</td>					    		

				    		<td>'.$row->iva.'</td>		
				    		'.$diasRestantes.'	
				    	  </tr>';		    	  
				}//fin del while
			?>
			<!-- FIN CONSULTAR del boton editar y borar -->
	      </tbody>
    	</table>
    </div>			 
	</article>

<!--------------------------------------------------------------------------------------->

<?php 
	require "secciones/footer.php"; //invoca el footer php
	require "config/desconexion.php"; //invoca desconexion db 
?>

<!--------------------------------------------------------------------------------------->

<script src="js/table.js"></script>

<!-- invoca el java de las tablas para el mensaje al final de la tabla mostrande registros y los botones de anterior y siguiente -->

<!--------------------------------------------------------------------------------------->