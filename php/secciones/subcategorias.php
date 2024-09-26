<?php /*inicio de php*/

include "../config/conexion.php"; /*se llama a la bd*/

$data = array(); /*almacena los datos en un vectos*/
$categoria = $_POST['categoria']; /*convierte el dato categoria a la variable categoria*/

$sql = "SELECT * FROM subcategoria WHERE categoria =$categoria ORDER BY nombreProducto ASC"; /*muestra la las categorias que estan en la base de datos*/
$ejecutar = $conexion->query($sql); /*hace la conexion con el sql*/

while ($row = mysqli_fetch_object($ejecutar)){ /* Devuelve la fila actual de un conjunto de resultados como un objeto*/
    $data[]=$row;
}

echo json_encode($data); /*traduce los datos a una matriz para mostrar la tabla*/

/*fin del php*/
?>