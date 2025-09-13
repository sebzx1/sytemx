<?php /*inicio de php*/

	include "../config/conexion.php"; /*se llama a la bd*/

	$codigo = $_POST['codigo'];	 /*convierte el dato codigo a la variable codigo*/   

	$sql = "DELETE FROM clientes WHERE codigo = $codigo"; /*muestra los clientes que estan en la base de datos*/
	
	if($ejecutar = $conexion->query($sql)){
	    echo 1;
	}else{
	    echo 0;
	}

/*fin del php*/
?>