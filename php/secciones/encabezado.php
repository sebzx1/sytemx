<?php /* inicio de php invocando la base de datos */

session_start(); /* inicia la sesion*/
error_reporting(0); /*reporte de error*/

@$cerrar = $_POST['btnlogout']; /*boton de cerrar la sesion*/

if (isset($cerrar)) { /*si se le da cerrar cesion se cierra y se devuelve a index*/
  session_destroy();
  header('location:../index.php');
}
if (empty($_SESSION['usuario'])) { /*si cierra cesion y se devuelve a inicio*/
  header('location:inicio.php');
}
require "config/conexion.php"; /*invoca el archivo php conexion con la bd*/

/* fin de PHP */
?>

<!---------------------------------------------------------------------------------------------------------->

<!DOCTYPE html>
<html lang="es">

<head>

  <title>SystemX</title>
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

  <meta name="author" content="jhosimarsolipa, jhosimarsolipa@misena.edu.co"> <!--nombre del autor-->
  <meta name="copyright" content="© CEPRODENT-SENA-LORICA"> <!--a quien le pertenecen los derechos de autor-->

  <meta charset="utf-8">

  <meta name="viewport" content="width=device-width, initial-scale=1.0" &amp;gt>

  <link rel="stylesheet" href="css/style.css?v=<?php echo rand(); ?>">

  <link rel="stylesheet" href="css/all.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
    integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

  <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
    crossorigin="anonymous"></script>

  <link rel="stylesheet" href="css/media.css">
  <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/fixedheader/3.1.9/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js "></script>
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/fixedheader/3.1.9/css/fixedHeader.bootstrap.min.css">
  <link rel="stylesheet" type="text/css"
    href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">

  <script type="text/javascript" src="js/printThis.js"></script>

</head>

<!------------------------------------------------------------------------------------------------>

<body>

  <section class="contenido"> <!-- crea la seccion contenido -->

    <nav class="menu"> <!-- crea el menu navegacion -->

      <ul> <!-- crea la lista -->
      <div class="menuMobile"><i class="fas fa-bars"></i></div>
        <li class="logo"> <!-- li declara el elemento de la lista logo-->
          <a href="index.php"><img width="100%" src="img/logo.png" alt="logo"></a> <!-- invoca al logo -->
        </li>

        <li><a href="categorias.php">Categorias</a></li>
        <li><a href="subcategoria.php">Subcategorias</a></li>
        <li><a href="trabajadores.php">Trabajadores</a></li>
        <li><a href="clientes.php">Clientes</a></li>
        <li><a href="productos.php">Productos</a></li>
        <li><a href="inventario.php">Inventario</a></li>
        <li><a href="estadisticas.php">Estadisticas</a></li>
        <li><a href="realizarVentas.php" style="color:#00bcd4; background-color: rgba(255, 255, 255, 0.1);">Ventas</a></li>

      </ul> <!-- finaliza la lista -->

    </nav> <!-- finaliza el menu navegacion-->

    <section class="formularios"> <!-- seccion o esquema -->

      <header class="cabecera"> <!-- iniciar el encabezamiento-->

        <nav> <!-- inicia el menu navegacion del login a la derecha-->

          <h2>SystemX - Developer</h2>


          <div class="menuConfiguracion">

            <div class="nav-item dropdown">

              <a class="nav-link dropdown-toggle text-black" href="#" id="navbarDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="far fa-user-circle" style="color: #00bcd4;"></i>
                <b style="color: #00bcd4;"> Usuario: </b>
                <span class="usuario-nombre" style="color: white;"><?php echo $_SESSION['nombres']; ?></span>
                <br>
                <i class="far fa-address-card" style="color: #00bcd4;"></i>
                <b style="color: #00bcd4;"> Cargo: </b>
                <span class="cargo-nombre" style="color: white;"><?php echo $_SESSION['cargo']; ?></span>
              </a>

              <div class="dropdown-menu" aria-labelledby="navbarDropdown"> <!-- menu de cerrar sesion -->

                <form action="secciones/encabezado.php" method="post">
                  <button type="submit" name="btnlogout" class="dropdown-item">
                    <i class="fas fa-times"></i>

                    Salir

                  </button>
                </form>

              </div>

            </div>

          </div> <!-- fin del menu configuracion -->

        </nav> <!-- finaliza el menu navegacion-->
      </header> <!-- finalizar el encabezamiento-->