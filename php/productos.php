<?php //inico de PHP
	require "secciones/encabezado.php"; //invoca el encabezado php
	require "plugins/modifiedimage.php"; //invoca el plugins para modificar imagen
?>

<?php // GUARDAR
error_reporting(0); /*reporte de error*/
	error_reporting(0); /*reporte de error*/
//error_reporting(E_ALL);

	//invoca y almacena en la variable el valor
	$barras = $_POST['barras'];
	$sku = $_POST['sku'];
	$nombre = $_POST['nombre'];
	$categoria = $_POST['categoria'];
	$marca = $_POST['marca'];
	$productoServicio = $_POST['productoServicio'];
	$imagen = $_POST['imagen'];
	$cantidad = $_POST['cantidad'];
	$valor = $_POST['valor'];
	$descripcion = $_POST['descripcion'];
	$fechaVencimiento = $_POST['fechaVencimiento'];
	$iva = $_POST['iva'];
	$btnGuardar = $_POST['btnGuardar'];

	if(isset($btnGuardar)){ //si se presiona el boton guardar
		$sql = "SELECT barras,sku
				FROM productos
				WHERE barras = '$barras' or sku = '$sku'";
				$ejecutar = $conexion->query($sql); //ejecuta la conexion
				$row = mysqli_fetch_object($ejecutar);
				$barrasVeri = $row->barras;
				$skuVeri = $row->sku;
		if($barrasVeri !='' || $skuVeri !=''  ){
			$mensaje = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
						  <strong>El Producto ya se encuentra registrado</strong>.
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>';
		}else{
			if(!empty($_FILES['imagen']['name'])){ //si se presiona el boton agregar imagen

				//invoca y permite las extensiones y abrir arhcivos desde un explorador
				$extensiones = array("","JPEG","JPG","GIF","PNG","jpg","gif","png","jpeg");
				$date = str_replace('.','',microtime(true));
				$extension = explode(".",$_FILES['imagen']['name']);

				$sql = "SELECT max(codigo) max FROM productos"; //seleccionar bd productos

				$ejecutar = $conexion->query($sql); //ejecuta la conexion con el sql

			    $row = mysqli_fetch_object($ejecutar); //devolverá conjunto de resultados como un objeto

			    $codigo = 0;
			    $codigo = $row->max + 1; //ejecuta conexion, devuelve el valor y agrega al proximo

				$_FILES['imagen']['name'] = $codigo.".".$extension[1]; //invoca el explorador de imagen
				$existe = array_search($extension[1],$extensiones); //invoca la funcion buscar con extensiones
				$image = new ModifiedImage($_FILES['imagen']['tmp_name']); //modifica los atributos de la imagen

	//si la imagen tiene un tamaño mayo o igual a 800 entonces la guarada en caso que no la convierte a un tamaño igual o menor para comprimirla y bajar su peso y asi porder almacenar muchas sin afectar el tamaño de la aplicacion

				if($image->getWidth() >= 800){
					$image->resizeToWidth(800); //redimenciona la imagen
					$w800 = 'img/productos/'.$_FILES['imagen']['name']; //almacena la imagen en la carpeta productos
					$image->save($w800);

					$image->resizeToWidth(300);
					$w300 = 'img/productos/medium/'.$_FILES['imagen']['name'];
					$image->save($w300);

					$image->resizeToWidth(100);
					$w100 = 'img/productos/small/'.$_FILES['imagen']['name'];
					$image->save($w100);
				}else{
					$w800 = 'img/productos/'. $_FILES['imagen']['name'];
					$image->save($w800);

					$image->resizeToWidth(300);
					$w300 = 'img/productos/medium/'. $_FILES['imagen']['name'];
					$image->save($w300);

					$image->resizeToWidth(100);
					$w100 = 'img/productos/small/'. $_FILES['imagen']['name'];
					$image->save($w100);
				}

				//insertar en productos categoria 
				$sql="INSERT INTO productos(barras,sku,nombre,categoria,marca,productoServicio,imagen,cantidad,valor,descripcion,fechaVencimiento,iva) VALUES('$barras','$sku','$nombre','$categoria','$marca','$productoServicio','".$_FILES['imagen']['name']."','$cantidad','$valor','$descripcion','$fechaVencimiento',$iva)";
				echo $sql;
				if($ejecutar=$conexion->query($sql)){ //ejecuta la conexion con el sql

					$mensaje = '<div class="alert alert-success alert-dismissible fade show" role="alert">
								  <strong>Guardado Correctamente</strong>.

								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>

								  </button>
								</div>';
				}else{
					$mensaje = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
								  <strong>Error de conexion al Guardar en BD</strong>.

								  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
								    <span aria-hidden="true">&times;</span>

								  </button>
								</div>';
				}
			}//si se presiona el boton agregar imagen
			else{
				echo 'Error al agregar imagen';
			}
		}
	} //si se presiona el boton guardar linea 20
//FIN GUARDAR


////////////////////////////////////////////////////////////////////////////////////////////

	// EDITAR
	$codigo = $_POST['codigo']; //invoca y almacena en la variable el valor codigo
	$btnEditar = $_POST['btnEditar']; //invoca y almacena en la variable el boton editar

	if(isset($btnEditar)){ //si se presiona el boton editar
		
		//actualiza la bd
		$sql="UPDATE productos SET barras = '$barras',sku = '$sku',nombre = '$nombre',categoria = '$categoria',productoServicio = '$productoServicio',cantidad = '$cantidad',valor = '$valor',descripcion = '$descripcion',marca = '$marca',fechaVencimiento='$fechaVencimiento',iva = $iva WHERE codigo = $codigo";

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

		<h4 class="text-left">Registro o Edicion de Productos</h4> <!-- nombre de productos -->

		<hr> <!-- liena que atraviesa el form -->
		
		<!-- accion en el formualio permite seleccionar archivos -->
		<form autocomplete="off" action="productos.php" method="post" enctype="multipart/form-data">

		  <div class="form-row"> <!-- se crea la columna -->

		  	<div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="barras">Codigo de Barras</label>
			  <input id="barras" name="barras" class="form-control form-control-sm" type="text">
		    </div> <!-- se cierra la fila -->

		    <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="sku">Codigo SKU</label>
			  <input id="sku" name="sku" class="form-control form-control-sm" type="text">
		    </div> <!-- se cierra la fila -->

		    <div class="form-group col-md-6"> <!-- se crea la fila -->

		      <label for="categoria">Categoria General</label> <!-- nombre categoria -->
		      <!-- invoca metodo de seleccion -->
			       <select name="categoria" id="categoria" class="form-control form-control-sm" required>
	                <option value="-1">Seleccione la categoria</option> 	                
	                
	                <?php
	                	$sql = "SELECT codigo,nombre FROM categorias order by nombre ASC"; //selecciona la tabla categorias
						$ejecutar = $conexion->query($sql); //ejecuta la conexion
						while($rs = $ejecutar->fetch_object()){ //mientras se ejecute
							echo '<option value="'.$rs->codigo.'">'.$rs->nombre.'</option>';
						} //fin del while
						//fin de la consulta
                 	?>

	              </select>
		    </div> <!-- se cierra la fila -->

		    <div class="form-group col-md-6"> <!-- se crea la fila -->
		      <label for="nombre">Subcategoria / Productos</label>
			       <select name="nombre" id="nombre" class="form-control form-control-sm" required>	               
	              </select>
		    </div> <!-- se cierra la fila -->	 

		    <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="marca">Marca</label>
			  <input id="marca" name="marca" class="form-control form-control-sm" type="text">
		    </div> <!-- se cierra la fila -->

		     <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="productoServicio">Producto/Servicio</label>
			       <select name="productoServicio" id="productoServicio" class="form-control form-control-sm" required>
	                <option value="-1">Seleccione</option> 	 
	                <option value="Producto">Producto</option> 	 
	                <option value="Servicio">Servicio</option> 	                
	              </select>
		    </div> <!-- se cierra la fila -->

		     <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="imagen">Imagen</label>
			  <input id="imagen" name="imagen" class="form-control form-control-sm" type="file" accept="image/*">
		    </div> <!-- se cierra la fila -->	

		    <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="cantidad">Cantidad #</label>
		      <input type="number" class="form-control form-control-sm" id="cantidad"  name="cantidad" required>
		    </div> <!-- se cierra la fila -->

		    <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="valor">Valor / Precio</label>
		      <input type="number" class="form-control form-control-sm" id="valor"  name="valor" required>
		    </div>	<!-- se cierra la fila -->

		    <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="descripción">Descripción o Detalles</label>
		      <input type="text" class="form-control form-control-sm" id="descripcion"  name="descripcion" required>
		    </div>	<!-- se cierra la fila -->


		    <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="fechaVencimiento">Fecha Vencimiento</label>
		      <input type="date" class="form-control form-control-sm" id="fechaVencimiento"  name="fechaVencimiento" required>
		    </div>	<!-- se cierra la fila -->

		    <div class="form-group col-md-6"> <!-- se crea la fila -->	
		      <label for="iva">Iva</label>
		      <input type="number" class="form-control form-control-sm" id="iva"  name="iva" required>
		    </div>	<!-- se cierra la fila -->

			 <div class="col-sm-12 text-right">	<!-- se crea la fila -->
			 	<button type="button" class="btn btn-sm btn-secondary btnCancelar">Cancelar</button>
			 	<!-- los botes cuando se edite la informacion -->
		    	<button type="submit" name="btnEditar" class="btn btn-sm btn-success btnEditar">Editar Información</button>
		      <button type="submit" name="btnGuardar" class="btn btn-sm btn-success btnGuardar">Guardar</button>
		    </div>	<!-- fin de la fila -->	

			</div>	
			<input type="hidden" id="codigo" name="codigo">	

		</form>  <!-- fin del form -->
		
		<hr> <!-- liena que atraviesa el form -->

		<?php echo $mensaje; ?> <!-- mensaje cuando se guarda o borra -->

<!--------------------------------------------------------------------------------------->

		<div class="consulta">

		<table class="table"> <!-- se crea la tabla -->

	      <thead> <!-- se crea bloque de filas para mostrar-->
	        <tr> <!-- representa a la sección de encabezado de una tabla -->
	          <th>Barras</th> 
	          <th>SKU</th> 	
	          <th>Nombre</th> <!-- celdas de encabezado -->
	          <th>Categoria</th>
	          <th>Marca</th> 
	          <th>Producto/Servicio</th>
	          <th>Imagen</th>
	          <th>Cantidad</th>
	          <th>Valor</th> 
	          <th>Descripción</th> 
	          <th>Fecha Vencimiento</th>
	          <th>Iva</th>
	          <th>Opciones</th>          
	        </tr>
	      </thead>
		<tbody> <!-- contiene a un bloque de filas que representaa a la sección del cuerpo -->

	      	<!-- CONSULTAR -->

<!--------------------------------------------------------------------------------------->

	        <?php //inicio del php para el boton editar y borar

	        //selecciona la tabla categorias, productos, subcategorias
				$sql = "SELECT p.barras,p.sku,s.codigo codigoSubcategoria, s.nombreProducto,p.categoria codCategoria,c.nombre categoria,p.marca,p.productoServicio,p.imagen,p.cantidad,p.valor,p.descripcion,p.marca,p.codigo,p.fechaVencimiento,p.iva
					 FROM productos p
                     INNER JOIN categorias c ON c.codigo = p.categoria
					 INNER JOIN subcategoria s ON p.nombre = s.codigo";

				$ejecutar = $conexion->query($sql); //ejecuta la conexion

				while ($row = mysqli_fetch_object($ejecutar)){ //mientras se ejecute
				    echo '<tr>
				    		<td>'.$row->barras.'</td>
				    		<td>'.$row->sku.'</td>
				    		<td>'.$row->nombreProducto.'</td>
				    		<td>'.$row->categoria.'</td>
				    		<td>'.$row->marca.'</td>
				    		<td>'.$row->productoServicio.'</td>
				    		<td><img src="img/productos/small/'.$row->imagen.'"></td>
				    		<td>'.$row->cantidad.'</td>
				    		<td>'.$row->valor.'</td>
				    		<td>'.$row->descripcion.'</td>
				    		<td>'.$row->fechaVencimiento.'</td>
				    		<td>'.$row->iva.' %</td>
				    		<td>
				    			<button data-codigo="'.$row->codigo.'" data-iva="'.$row->iva.'" data-fechavencimiento="'.$row->fechaVencimiento.'" data-barras="'.$row->barras.'" data-sku="' .$row->sku.'" data-codigosubcategoria="'.$row->codigoSubcategoria.'" data-categoria="'.$row->codCategoria.'" data-marca="'.$row->marca.'" data-productoServicio="'.$row->productoServicio.'" data-cantidad="'.$row->cantidad.'" data-valor="'.$row->valor.'" data-descripcion="'.$row->descripcion.'" type="submit" class="btn btn-sm btn-info editar"><i class="fas fa-edit"></i></button>

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

<!--------------------------------------------------------------------------------------->

<script>
	$('.btnEditar').hide(); //invoca el boton editar
	$('.btnCancelar').hide(); //invoca el boton cancelar
	// SELECCIONAR EDITAR

	var codigo = 0;
	$(document).on('click', '.editar', function(e) {
		var data = {
			'categoria':$(this).data('categoria')			
		}
		$.ajax({
			type: "POST",
			url: "secciones/subcategorias.php",
			data: data,
			success: function(data) {
				console.log(data);				
				$(".validar").empty();		
				var json = JSON.parse(data); 		
				$('#nombre').html('');
				$('#nombre').append('<option value="-1">Seleccione</option>');
				if(json.length>0){
					$(".validar").empty();
					for (var i = 0; i < json.length; i++) {
						var selected = "";
						if($(this).data('codigosubcategoria') == json[i].codigo){
							selected = "selected";
						}
						$('#nombre').append('<option selected value="'+json[i].codigo+'">'+json[i].nombreProducto+'</option>');						
					}
				}else{
					$(".validar").empty();		
					$("#nombre").after("<span class='validar'>No hay Productos registrados</span>");
				}			
			}
		})	

		$('#codigo').val($(this).data('codigo'));
		$('#barras').val($(this).data('barras'));
		$('#sku').val($(this).data('sku'));
		$('#categoria').val($(this).data('categoria'));
		$('#marca').val($(this).data('marca'));
		$('#cantidad').val($(this).data('cantidad'));
		$('#descripcion').val($(this).data('descripcion'));
		$('#productoServicio').val($(this).data('productoservicio'));
		$('#valor').val($(this).data('valor'));
		$('#fechaVencimiento').val($(this).data('fechavencimiento'));
		$('#iva').val($(this).data('iva'));
		// $('#direccion').val($(this).data('direccion'));
		$('.btnGuardar').hide();
		$('.btnCancelar').show();
		$('.btnEditar').show();
	})
	//FIN SELECCIONAR EDITAR


	$('.btnEditar').hide(); //invoca el boton editar

	$(document).on('change', '#categoria', function(e) {		
		var categoria = $(this).val();	
						
		var data = {
			'categoria':categoria			
		}
		$.ajax({
			type: "POST",
			url: "secciones/subcategorias.php",
			data: data,
			success: function(data) {
				console.log(data);				
				$(".validar").empty();		
				var json = JSON.parse(data); 		
				$('#nombre').html('');
				$('#nombre').append('<option value="-1">Seleccione</option>');
				if(json.length>0){
					$(".validar").empty();
					for (var i = 0; i < json.length; i++) {
						$('#nombre').append('<option value="'+json[i].codigo+'">'+json[i].nombreProducto+'</option>');						
					}
				}else{
					$(".validar").empty();		
					$("#nombre").after("<span class='validar'>No hay Productos registrados</span>");
				}			
			}
		})		
	})	

	// ELIMINAR 
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
					url: "secciones/eliminarProductos.php",
					data: data,
					success: function(data) {
						console.log(data);
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
</script>