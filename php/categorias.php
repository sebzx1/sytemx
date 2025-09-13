<?php //inico de PHP
	require "secciones/encabezado.php"; //invoca el encabezado php
?>

<?php // GUARDAR

error_reporting(0); /*reporte de error*/

	$nombre = $_POST['nombre']; //invoca y almacena en la variable el valor nombre
	$detalle = $_POST['detalle']; //invoca y almacena en la variable el valor detalle
	$btnGuardar = $_POST['btnGuardar']; //invoca y almacena en la variable el boton guardar

	if(isset($btnGuardar)){//si se presiona el boton guardar

//insertar en categoria nombre
		$sql="INSERT INTO categorias(nombre,detalle) VALUES('$nombre','$detalle')"; 

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
		}
	} //fin del si

	//FIN GUARDAR

////////////////////////////////////////////////////////////////////////////////////////////
	
	// EDITAR
	$codigo = $_POST['codigo']; //invoca y almacena en la variable el valor codigo
	$btnEditar = $_POST['btnEditar']; //invoca y almacena en la variable el boton editar

	if(isset($btnEditar)){ //si se presiona el boton editar

		$sql="UPDATE categorias SET nombre = '$nombre',detalle = '$detalle' WHERE codigo = $codigo"; //actualiza la bd

		if($ejecutar=$conexion->query($sql)){ //si se ejecuta la conexion entonces muestra el mensaje

			$mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>Editado Correctamente</strong>.

						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  
						  </button>
						</div>';
		}else{
			$mensaje = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Error al editar en la base de datos</strong>.

						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  
						  </button>
						</div>';
		}
	}//fin del si
	//FIN EDITAR
?> <!-- fin php -->

<!--------------------------------------------------------------------------------------->

	<article class="contenidoFormularios"> <!-- formulario -->

		<h4 class="text-left">Registro o Edicion de Categorias para los Productos</h4> <!-- nombre de la categoria -->
		
		<hr> <!-- liena que atraviesa el form -->
		
		<form action="categorias.php" method="post"> <!-- accion en el formualio -->
		  
		  <div class="form-row"> <!-- se crea la columna -->
		  	
		  	<div class="form-group col-md-6"> <!-- se crea la fila -->
		    
		      <label for="nombre">Nombre De La Categoria</label> <!-- nombre categoria -->
		     
		      <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" required>
		    
		    </div> <!-- fin de la fila -->	 

		    <div class="form-group col-md-6"> <!-- se crea la fila -->
		    
		      <label for="detalle">Detalles</label> <!-- detalle categoria -->
		     
		      <input type="text" class="form-control form-control-sm" id="detalle" name="detalle">
		    
		    </div> <!-- fin de la fila -->	 	  

			 <div class="col-sm-12 text-right"> <!-- se crea la fila -->		    	
			 	
			 	<button type="submit" name="btnGuardar" class="btn btn-sm btn-success btnGuardar">Guardar</button>
				
				<!-- los botes cuando se edite la informacion -->	
			 	<button type="button" class="btn btn-sm btn-secondary btnCancelar">Cancelar</button>
		    	
		    	<button type="submit" name="btnEditar" class="btn btn-sm btn-success btnEditar">Editar Información</button>
		      
		    </div> <!-- fin de la fila -->		

			</div> <!-- fin de la columna -->

			<input type="hidden" id="codigo" name ="codigo">

		</form> <!-- fin del form -->

		<?php echo $mensaje; ?> <!-- mensaje cuando se guarda o borra -->

<!--------------------------------------------------------------------------------------->

		<hr> <!-- liena que atraviesa el form -->

		<div class="consulta">

		<table class="table"> <!-- se crea la tabla -->

	    <thead> <!-- se crea bloque de filas para mostrar-->
	        <tr> <!-- representa a la sección de encabezado de una tabla -->
	          <th>Codigo</th><!-- celdas de encabezado -->
	          <th>Nombre</th>
	          <th>Detalle</th>
	          <th>Fecha De Creación</th> 
	          <th>Opciones</th>         
	        </tr>
	      </thead>

	      <tbody> <!-- contiene a un bloque de filas que representaa a la sección del cuerpo -->
	      	
	      	<!-- CONSULTAR -->

<!--------------------------------------------------------------------------------------->
	      	
	      	<?php //inicio del php para el boton editar y borar

				$sql = "SELECT * FROM categorias"; //selecciona la tabla categorias

				$ejecutar = $conexion->query($sql); //ejecuta la conexion
				
				while ($row = mysqli_fetch_object($ejecutar)){ //mientras se ejecute
				    
				    echo '<tr>
				    		<td>'.$row->codigo.'</td>
				    		<td>'.$row->nombre.'</td>
				    		<td>'.$row->detalle.'</td>
				    		<td>'.$row->fechaRegistro.'</td>
				    		<td>
				    			<button type="submit" data-detalle="'.$row->detalle.'" data-categoria="'.$row->nombre.'" data-codigo="'.$row->codigo.'" class="btn btn-sm btn-info editar"><i class="fas fa-edit"></i></button>

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

<script src="js/table.js"></script> <!-- invoca el java de las tablas para el mensaje al final de la tabla mostrande registros y los botones de anterior y siguiente -->

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
					url: "secciones/eliminarCategoria.php",
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
	})	// FIN BOTON ELIMINAR 
	
	// SELECCIONAR EDITAR

	var codigo = 0;
	$(document).on('click', '.editar', function(e) {
		$('#codigo').val($(this).data('codigo'));
		$('#nombre').val($(this).data('categoria'));	
		$('#detalle').val($(this).data('detalle'));	
		$('.btnGuardar').hide();
		$('.btnCancelar').show();
		$('.btnEditar').show();
	})
	//FIN SELECCIONAR EDITAR
	
	// CANCELAR
	$(document).on('click', '.btnCancelar', function(e) {
		$('#nombre').val('');	
		$('#detalle').val('');
		$('.btnEditar').hide();
		$('.btnCancelar').hide();
		$('.btnGuardar').show();    		
	});
	// FIN CANCELAR

</script>