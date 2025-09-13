<?php //inico de PHP
	require "secciones/encabezado.php"; //invoca el encabezado php
?>

<?php // GUARDAR

error_reporting(0); /*reporte de error*/

//invoca y almacena en la variable el valor
	$identificacion = $_POST['identificacion'];
	$nombres = $_POST['nombres'];
	$apellidos = $_POST['apellidos'];
	$telefono = $_POST['telefono'];
	$correo = $_POST['correo'];
	$celular = $_POST['celular'];
	$direccion = $_POST['direccion'];
	$ciudad = $_POST['ciudad'];
	$btnGuardar = $_POST['btnGuardar'];

	if(isset($btnGuardar)){ //si se presiona el boton guardar

		$sql = "SELECT identificacion
				FROM clientes
				WHERE identificacion = $identificacion";
				$ejecutar = $conexion->query($sql); //ejecuta la conexion
				$row = mysqli_fetch_object($ejecutar);
				$identi = $row->identificacion;

		if($identi>0){
			$mensaje = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>El usuario ya se encuentra registrado</strong>.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>';

		}else{
		//insertar en cliente los datos de las variables	
			$sql="INSERT INTO clientes(identificacion,nombres,apellidos,telefono,correo,celular,direccion,ciudad) VALUES('$identificacion','$nombres','$apellidos','$telefono','$correo','$celular','$direccion','$ciudad')";

			if($ejecutar=$conexion->query($sql)){ //ejecuta la conexion con el sql

				$mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
							  <strong>Guardado Correctamente</strong>.

							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>

							  </button>
							</div>';
			}else{
				$mensaje = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
							  <strong>Error con la base de datos al guardar</strong>.

							  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  
							  </button>
							</div>';
			}
		}
	} //fin del si

		//FIN GUARDAR

////////////////////////////////////////////////////////////////////////////////////////////

		// EDITAR
	$codigo = $_POST['codigo']; //invoca y almacena en la variable el valor codigo
	$btnEditar = $_POST['btnEditar']; //invoca y almacena en la variable el boton editar

	if(isset($btnEditar)){ //si se presiona el boton editar
		
		//actualiza la bd
		$sql="UPDATE clientes SET identificacion = '$identificacion',nombres = '$nombres',apellidos = '$apellidos',telefono = '$telefono',celular = '$celular',correo = '$correo',direccion = '$direccion',ciudad = '$ciudad' WHERE codigo = $codigo";

		if($ejecutar=$conexion->query($sql)){ //si se ejecuta la conexion entonces muestra el mensaje

			$mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
						  <strong>Editado Correctamente</strong>.

						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>

						  </button>
						</div>';
		}else{
			$mensaje = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>Error al editar</strong>.

						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>

						  </button>
						</div>';
		}
	} //fin del si
	//FIN EDITAR
?> <!-- fin php -->

<!--------------------------------------------------------------------------------------->

	<article class="contenidoFormularios"> <!-- formulario -->

		<h4 class="text-left">Registro o Edicion de Clientes</h4> <!-- nombre de la categoria -->

		<hr> <!-- liena que atraviesa el form -->

		<form action="" method="POST"> <!-- accion en el formualio -->

		  <div class="form-row"> <!-- se crea la columna -->

		  	<div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="identificacion">Identificacion</label> 
		      <input type="number" class="form-control form-control-sm"  name="identificacion" id="identificacion" required="">
		    </div>	<!-- fin de la fila -->	 

		    <div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="nombres">Nombres</label>
		      <input type="text" class="form-control form-control-sm"  name="nombres" id="nombres" required="">
		    </div>	<!-- fin de la fila -->		 

		    <div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="apellidos">Apellidos</label>
		      <input type="text" class="form-control form-control-sm"  name="apellidos" id="apellidos" required="">
		    </div>	<!-- fin de la fila -->	

		    <div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="telefono">Télefono</label>
		      <input type="text" class="form-control form-control-sm"  name="telefono" id="telefono">
		    </div>	<!-- fin de la fila -->	

		    <div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="celular">Celular</label>
		      <input type="text" class="form-control form-control-sm"  name="celular"  id="celular"required="">
		    </div>	<!-- fin de la fila -->	

		    <div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="correo">Correo</label>
		      <input type="text" class="form-control form-control-sm"   name="correo" id="correo" required="">
		    </div> <!-- fin de la fila -->	

		     <div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="ciudad">Ciudad Residencia</label>
		      <select name="ciudad" class="form-control form-control-sm">
		      	 <option value="-1">Seleccione la Ciudad</option> <!-- crea una lista con bd -->

	                <?php // invoca la base de dato y trae los datos de categorias -->
	                	$sql = "SELECT id,nombre FROM municipios ORDER BY nombre ASC";
						$ejecutar = $conexion->query($sql);
						while($rs = $ejecutar->fetch_object()){
							echo '<option value="'.$rs->id.'">'.$rs->nombre.'</option>';
						}
                 	?> <!-- fin de php -->
		      </select>
		    </div> <!-- fin de la fila -->		

		     <div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="direccion">Dirección</label>
		      <input type="text" class="form-control form-control-sm"   name="direccion" id="direccion" required="">
		    </div> <!-- fin de la fila -->		    		 

			<div class="col-sm-12 text-right">	<!-- se crea la fila -->
			 	<button type="button" class="btn btn-sm btn-secondary btnCancelar">Cancelar</button>
			 	<!-- los botes cuando se edite la informacion -->
		    	<button type="submit" name="btnEditar" class="btn btn-sm btn-success btnEditar">Editar Información</button>
		      <button type="submit" name="btnGuardar" class="btn btn-sm btn-success btnGuardar">Guardar</button>
		    </div>	<!-- fin de la fila -->	

			</div>	<!-- fin de la columna -->

			<input type="hidden" id="codigo" name="codigo">		

		</form> <!-- fin del form -->

		<?php echo $mensaje; ?> <!-- mensaje cuando se guarda o borra -->

<!--------------------------------------------------------------------------------------->

		<hr> <!-- liena que atraviesa el form -->

		<div class="consulta">

		<table class="table"> <!-- se crea la tabla -->

	      <thead> <!-- se crea bloque de filas para mostrar-->
	        <tr> <!-- representa a la sección de encabezado de una tabla -->
	          <th>Identificación</th> <!-- celdas de encabezado -->
	          <th>Nombres</th>
	          <th>Apellidos</th> 
	          <th>Télefono</th> 
	          <th>Correo</th> 
	          <th>Celular</th> 
	          <th>Dirección</th> 
	          <th>Ciudad</th> 
	          <th>Opciones</th>          
	        </tr>
	      </thead>

	      <tbody> <!-- contiene a un bloque de filas que representaa a la sección del cuerpo -->
	      	
	      	<!-- CONSULTAR -->

<!--------------------------------------------------------------------------------------->	  

	        <?php //inicio del php para el boton editar y borar

				$sql = "SELECT c.identificacion,c.nombres,c.apellidos,c.telefono,c.correo,c.celular,m.nombre ciudad,c.direccion,c.codigo,c.ciudad codigoCiudad
						 FROM clientes c
						 INNER JOIN municipios m ON m.id = c.ciudad"; //selecciona la tabla categorias

				$ejecutar = $conexion->query($sql); //ejecuta la conexion

				while ($row = mysqli_fetch_object($ejecutar)){ //mientras se ejecute

				    echo '<tr>
				    		<td>'.$row->identificacion.'</td>
				    		<td>'.$row->nombres.'</td>
				    		<td>'.$row->apellidos.'</td>
				    		<td>'.$row->telefono.'</td>
				    		<td>'.$row->correo.'</td>
				    		<td>'.$row->celular.'</td>
				    		<td>'.$row->direccion.'</td>
				    		<td>'.$row->ciudad.'</td>
				    		<td>

				    			<button data-codigo="'.$row->codigo.'" data-ciudad="'.$row->codigoCiudad.'" data-direccion="'.$row->direccion.'"  data-identificacion="'.$row->identificacion.'" data-nombres="'.$row->nombres.'" data-apellidos="'.$row->apellidos.'" data-telefono="'.$row->telefono.'" data-correo="'.$row->correo.'" data-celular="'.$row->celular.'"  type="submit" class="btn btn-sm btn-info editar"><i class="fas fa-edit"></i></button>

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

<script src="js/table.js"></script>
<!-- invoca el java de las tablas para el mensaje al final de la tabla mostrande registros y los botones de anterior y siguiente -->

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
					url: "secciones/eliminarClientes.php",
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
	})	// FIN ELIMINAR 

	// SELECCIONAR EDITAR
	var codigo = 0;
	$(document).on('click', '.editar', function(e) {
		$('#codigo').val($(this).data('codigo'));
		$('#identificacion').val($(this).data('identificacion'));
		$('#nombres').val($(this).data('nombres'));
		$('#apellidos').val($(this).data('apellidos'));
		$('#telefono').val($(this).data('telefono'));
		$('#celular').val($(this).data('celular'));
		$('#correo').val($(this).data('correo'));
		$('#ciudad').val($(this).data('ciudad'));
		console.log($(this).data('ciudad'));
		$('#direccion').val($(this).data('direccion'));
		$('.btnGuardar').hide();
		$('.btnCancelar').show();
		$('.btnEditar').show();
	})
	//FIN SELECCIONAR EDITAR

	// CANCELAR
	$(document).on('click', '.btnCancelar', function(e) {
		$('#identificacion').val('');
		$('#nombres').val('');	
		$('#apellidos').val('');	
		$('#telefono').val('');	
		$('#celular').val('');	
		$('#correo').val('');	
		$('#ciudad').val('');	
		$('#direccion').val('');	
		$('.btnEditar').hide();
		$('.btnCancelar').hide();
		$('.btnGuardar').show();    		
	});
	// FIN CANCELAR

</script>