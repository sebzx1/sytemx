<?php /*inicio de php*/

	include "../config/conexion.php"; /*se llama a la bd*/

	$codigo = $_POST['codigo'];	    /*convierte el dato codigo a la variable codigo*/ 

	$sql = "DELETE FROM subcategoria WHERE codigo = $codigo"; /*muestra la las categorias que estan en la base de datos*/
	
	if($ejecutar = $conexion->query($sql)){
	    echo 1;
	}else{
	    echo 0;
	}

/*fin del php*/
?>