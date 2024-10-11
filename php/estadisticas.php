<?php
require "secciones/encabezado.php" //invoca el encabezado php
	?>

<!--------------------------------------------------------------------------------------->

<article class="contenidoFormularios"> <!-- formulario -->

	<h4 class="text-left">Estadisticas de Ventas</h4> <!-- nombre de la categoria -->

	<hr> <!-- liena que atraviesa el form -->

	<div class="consulta">
		<?php
		@$venta = $_GET['venta'];
		?>
		<h4>Detalle Venta <?php echo $venta; ?></h4>

		<table class="table"> <!-- se crea la tabla -->
			<thead> <!-- se crea bloque de filas para mostrar-->
				<tr> <!-- representa a la sección de encabezado de una tabla -->
					<th>Producto</th> <!-- celdas de encabezado -->
					<th>Cantidad</th>
					<th>Valor</th>
				</tr>
			</thead>

			<tbody> <!-- contiene a un bloque de filas que representaa a la sección del cuerpo -->

				<!-- CONSULTAR -->

				<!--------------------------------------------------------------------------------------->

				<?php
				// Asegúrate de que $conexion esté definida y sea una conexión válida a la base de datos
// Asegúrate de que $venta esté definida y sea un valor válido
				
				// Usar consulta preparada para prevenir inyección SQL
				$sql = "SELECT s.nombreProducto AS producto, d.subCant AS cantidad, 
               d.subCant * (p.valor + ((p.valor * p.iva)/100)) AS valor
        FROM detalleVentas d
        INNER JOIN subcategoria s ON s.codigo = d.subCod
        INNER JOIN productos p ON p.nombre = s.codigo
        WHERE d.ventCod = ?
        GROUP BY p.nombre";

				$stmt = $conexion->prepare($sql);
				if ($stmt === false) {
					die("Error al preparar la consulta: " . $conexion->error);
				}

				$stmt->bind_param("i", $venta);
				$stmt->execute();
				$resultado = $stmt->get_result();

				if ($resultado === false) {
					die("Error al ejecutar la consulta: " . $conexion->error);
				}

				while ($row = $resultado->fetch_object()) {
					echo '<tr>
            <td>' . htmlspecialchars($row->producto) . '</td>
            <td>' . htmlspecialchars($row->cantidad) . '</td>
            <td>' . number_format($row->valor, 2, ',', '.') . '</td>
          </tr>';
				}

				$stmt->close();
				?>
			</tbody>
		</table> <!-- fin de la tabla -->
	</div>

	<div class="consulta">

		<h4>Ventas Realizadas</h4>

		<table class="table"> <!-- se crea la tabla -->
			<thead> <!-- se crea bloque de filas para mostrar-->
				<tr> <!-- representa a la sección de encabezado de una tabla -->
					<th>#Venta</th> <!-- celdas de encabezado -->
					<th>Usuario</th>
					<th>Cliente</th>
					<th>Subtotal</th>
					<th>Iva</th>
					<th>Total</th>
					<th>Fecha Venta</th>
				</tr>
			</thead>

			<tbody> <!-- contiene a un bloque de filas que representaa a la sección del cuerpo -->

				<!-- CONSULTAR -->

				<!--------------------------------------------------------------------------------------->

				<?php //inicio del php para el boton editar y borar 
				
				//selecciona la tabla usuario, cliente, producto, ventas
				$sql = "SELECT v.codigo,CONCAT(UPPER(t.nombres),' ', UPPER(t.apellidos)) usuario,CONCAT(UPPER(c.nombres),' ', UPPER(c.apellidos)) cliente,v.cantidad,v.valor,v.iva,v.subtotal,v.total, v.fechaVenta
	                FROM ventas v
	                INNER JOIN clientes c ON v.cliente = c.codigo
	                INNER JOIN trabajadores t ON v.trabajador = t.codigo";

				$ejecutar = $conexion->query($sql); //ejecuta la conexion
				
				while ($row = mysqli_fetch_object($ejecutar)) { //mientras se ejecute
					echo '<tr>
				    		<td><a href="estadisticas.php?venta=' . $row->codigo . '">' . $row->codigo . '</td>
				    		<td>' . $row->usuario . '</td>
				    		<td>' . $row->cliente . '</td>				    		
				    		<td>' . $row->subtotal . '</td>
				    		<td>' . $row->iva . '</td>
				    		<td>' . $row->total . '</td>
				    		<td>' . $row->fechaVenta . '</td>
				    	  </tr>';
				}
				?>
			</tbody>
		</table> <!-- fin de la tabla -->
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