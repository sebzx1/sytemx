<?php 
	require "secciones/encabezado.php"; //invoca el encabezado php
?>

<?php 
	
	error_reporting(0); /*reporte de error*/

	$categoria = $_POST['categoria']; //invoca y almacena en la variable el valor
	$subcategoria = $_POST['subcategoria']; //invoca y almacena en la variable el valor
	$detalle = $_POST['detalle']; //invoca y almacena en la variable el valor detalle
	$btnGuardar = $_POST['btnGuardar']; //invoca y almacena en la variable el valor

	if(isset($btnGuardar)){ //si se presiona el boton guardar

//insertar en subcategoria nombreproducto
		$sql="INSERT INTO subcategoria(categoria,nombreProducto,detalle) VALUES('$categoria','$subcategoria','$detalle')";

		if($ejecutar=$conexion->query($sql)){ //ejecuta la conexion con el sql

			$mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>Guardado Correctamente</strong>.

						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  
						  </button>
						</div>';
		}else{
			$mensaje = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Error al guardar en la base de datos</strong>.

						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>

						  </button>
						</div>';

		}//fin del si
	} //FIN GUARDAR

////////////////////////////////////////////////////////////////////////////////////////////

	// EDITAR
	$codigo = $_POST['codigo']; //invoca y almacena en la variable el valor codigo
	$btnEditar = $_POST['btnEditar']; //invoca y almacena en la variable el boton editar

	if(isset($btnEditar)){ //si se presiona el boton editar

		$sql="UPDATE subcategoria SET categoria = '$categoria', nombreProducto='$subcategoria',detalle = '$detalle' WHERE codigo = $codigo"; //actualiza la bd

		if($ejecutar=$conexion->query($sql)){ //si se ejecuta la conexion entonces muestra el mensaje

			$mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>Editado Correctamente</strong>.

						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>';
		}else{
			$mensaje = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Error al guardar en la base de datos</strong>.

						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>';
		}//fin del si
	} //FIN EDITAR
?>

<!--------------------------------------------------------------------------------------->

	<article class="contenidoFormularios"> <!-- formulario -->

		<h4 class="text-left">Registro o Edicion de Subcategorias para los Productos</h4> <!-- nombre de la categoria -->

		<hr> <!-- liena que atraviesa el form -->

		<form action="subcategoria.php" method="post"> <!-- accion en el formualio -->

		  <div class="form-row"> <!-- se crea la columna -->

		  	 <div class="form-group col-md-6"> <!-- se crea la fila -->

		      <label for="categoria">Nombre Categoria General</label> <!-- nombre categoria -->

			       <select name="categoria" id="categoria" class="form-control form-control-sm" required>
	               
	                <option value="-1">Seleccione la categoria</option> <!-- crea una lista con bd -->

	                <?php // invoca la base de dato y trae los datos de categorias -->
	                	$sql = "SELECT codigo,nombre FROM categorias ORDER BY nombre ASC";
						$ejecutar = $conexion->query($sql);
						while($rs = $ejecutar->fetch_object()){
							echo '<option value="'.$rs->codigo.'">'.$rs->nombre.'</option>';
						}
                 	?> <!-- fin de php -->

	              </select> <!-- fin del formulario que muestra la categoria -->

		    </div> <!-- fin de la fila -->	

		    		    <div class="form-group col-md-6"> <!-- se crea la fila -->
		    
		      <label for="detalle">Detalles</label> <!-- detalle subcategoria -->
		     
		      <input type="text" class="form-control form-control-sm" id="detalle" name="detalle">
		    
		    </div> <!-- fin de la fila -->	 	  	

		     <div class="form-group col-md-6"> <!-- se crea la fila -->	

		      <label for="subcategoria">Nombre del Producto o Subcategoria</label> <!-- nombre subcategoria -->

			       <input type="text" class="form-control form-control-sm"  name="subcategoria" id="subcategoria" required>

		    </div>	<!-- fin de la fila -->

			 <div class="col-sm-12 text-right">	<!-- se crea la fila -->

			 	<button type="button" class="btn btn-sm btn-secondary btnCancelar">Cancelar</button>
				
				<!-- los botes cuando se edite la informacio-->
		    	<button type="submit" name="btnEditar" class="btn btn-sm btn-success btnEditar">Editar Información</button>

		      <button type="submit" name="btnGuardar" class="btn btn-sm btn-success btnGuardar">Guardar</button>
		    
		    </div>	<!-- fin de la fila -->		
	
			</div>	 <!-- fin de la columna -->

			<input type="hidden" id="codigo" name ="codigo">

		</form> </form> <!-- fin del form -->

		<?php echo $mensaje; ?>  <!-- mensaje cuando se guarda o borra -->

<!--------------------------------------------------------------------------------------->

		<hr> <!-- liena que atraviesa el form -->

		<div class="consulta">
		<table class="table"> <!-- se crea la tabla -->

	      <thead>  <!-- se crea bloque de filas para mostrar-->
	        <tr> <!-- representa a la sección de encabezado de una tabla -->
	          <th>Codigo</th> <!-- celdas de encabezado -->
	          <th>Categoria</th>
	          <th>Nombre Producto</th>
	          <th>Detalle</th>
	          <th>Fecha Creación</th> 
	          <th>Opciones</th>          
	        </tr>
	      </thead> 

	      <tbody> <!-- contiene a un bloque de filas que representaa a la sección del cuerpo -->

	      	<!-- CONSULTAR -->

<!--------------------------------------------------------------------------------------->

	      	<?php //inicio del php para el boton editar y borar

	      	//selecciona la tabla subcategorias
				$sql = "SELECT s.codigo,c.codigo codCategoria,c.nombre categoria,s.nombreProducto,s.fechaRegistro,s.detalle
				 FROM subcategoria s
				 INNER JOIN categorias c ON c.codigo = s.categoria";

				$ejecutar = $conexion->query($sql); //ejecuta la conexion

				while ($row = mysqli_fetch_object($ejecutar)){ //mientras se ejecute
				    echo '<tr>
				    		<td>'.$row->codigo.'</td>
				    		<td>'.$row->categoria.'</td>
				    		<td>'.$row->nombreProducto.'</td>
				    		<td>'.$row->detalle.'</td>
				    		<td>'.$row->fechaRegistro.'</td>
				    		<td>
				    			<button type="button" data-detalle="'.$row->detalle.'" data-codigo="'.$row->codigo.'" data-subcategoria="'.$row->nombreProducto.'" data-categoria="'.$row->codCategoria.'" class="btn btn-sm btn-info editar"><i class="fas fa-edit"></i></button>

				    			<button type="submit" data-codigo="'.$row->codigo.'" class="btn btn-sm btn-danger delete"><i class="fas fa-trash-alt"></i></button>
				    		</td>
				    	  </tr>';
				} //fin del while
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
<!-- invoca el java de las tablas para el mensaje al final de la tabla mostrande registros y los botones de anterior y siguiente -->

<script src="js/table.js"></script>

<script>
	$('.btnEditar').hide(); //invoca el boton editar
	$('.btnCancelar').hide(); //invoca el boton cancelar

	// BOTON ELIMINAR 
	$(document).on('click', '.delete', function(e) {		
		var codigo = $(this).data('codigo');	
		console.log(codigo);				
		var data = {
			'codigo':codigo			
		}
		Swal.fire({
			title: '¿Realmente deseas eliminar?',
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#28a745',
			cancelButtonColor: '#6c757d',
			confirmButtonText: 'Si',
			cancelButtonText: 'No'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					type: "POST",
					url: "secciones/eliminarSubcategoria.php",
					data: data,
					success: function(data) {
						if(data > 0){
							Swal.fire(
								'Exito!',
								'Eliminado correctamente.',
								'success'
								)												
							setTimeout(function(){ 
									location.reload();
							}, 1000);
						}else{
							Swal.fire(
								'Error!',
								'Intenta nuevamente.',
								'error'
								)
						}		
					}
				})
			}
		})
	})	
	// FIN ELIMINAR 

	// SELECCIONAR EDITAR

	var codigo = 0;
	$(document).on('click', '.editar', function(e) {
		$('#codigo').val($(this).data('codigo'));
		$('#categoria').val($(this).data('categoria'));
		$('#subcategoria').val($(this).data('subcategoria'));
		$('#detalle').val($(this).data('detalle'));	
		$('.btnGuardar').hide();
		$('.btnCancelar').show();
		$('.btnEditar').show();
	})
	//FIN SELECCIONAR EDITAR

	// CANCELAR
	$(document).on('click', '.btnCancelar', function(e) {
		$('#categoria').val('-1');
		$('#subcategoria').val('');	
		$('#detalle').val('');
		$('.btnEditar').hide();
		$('.btnCancelar').hide();
		$('.btnGuardar').show();    		
	});
	// FIN CANCELAR
</script>