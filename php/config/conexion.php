<?php     

    header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");		

	$host = "localhost"; /*conexion con mysql*/
	$user = "root";	 /*validacion del usuario mysql*/
	$password = ""; /*validacion de la contraseña mysql*/
	$bd = "ultraventas"; /*nombre de la base de datos en mysql*/
	
	$conexion = new mysqli($host,$user,$password,$bd); /* verificar conexion con mysql */
	mysqli_set_charset($conexion,"utf8mb4"); /* caracteres predeterminado cuando se envían datos desde y hacia bd */
	
 ?>