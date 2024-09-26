<?php /*inicio de php*/

include "../config/conexion.php"; /*se llama a la bd*/

$data = array();
$producto = $_POST['producto']; /*convierte el dato producto a la variable producto*/   

$sql = "SELECT SUM(cantidad) cantidad,valor FROM productos WHERE codigo =$producto GROUP BY nombre";
/*muestra los productos que estan en la base de datos*/

$ejecutar = $conexion->query($sql);

while ($row = mysqli_fetch_object($ejecutar)){
    $data[]=$row;
}
echo json_encode($data);

/*fin del php*/	
?>