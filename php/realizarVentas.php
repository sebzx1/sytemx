<?php //inico de PHP
    require "secciones/encabezado.php"; //invoca el encabezado php
?>

<main class="page-content">

    <div class="ventas sombra">
    
        <div class="pedidosUsuarios">

            <div id="accordion" class="productosPedidos">
                  
             <h4 class="text-center">VENTAS PRODUCTOS / SERVICIOS </h4> <!-- nombre de productos -->
               
                <div class="row justify-content-center">
                    
                    <div class="col-12 col-md-12 col-lg-12">
                      
                        <form class="card card-sm">
                            <div class="card-body row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-search h4 text-body"></i>
                                </div>

  <!--//////////////////////////////////////////////////////////////////////////////////////-->
                                <!--end of col-->
                                <div class="col">
                                 <!--   <label for="trabajador">Trabajador / Empleado:</label>  nombre trabajador -->
                                    <select name="trabajador" id="trabajador" class="form-control form-control-sm" required>
                                    <option value="-1">Seleccione Trabajador / Empleado</option> <!-- crea una lista con bd -->

                                    <?php // invoca la base de dato y trae los datos de trabajadors -->
                                        $sql = "SELECT codigo,CONCAT(identificacion,' ',nombres,' ',apellidos,' ',celular) nombre FROM trabajadores ORDER BY identificacion,nombres,apellidos,celular ASC";
                                        $ejecutar = $conexion->query($sql);
                                        while($rs = $ejecutar->fetch_object()){
                                            echo '<option value="'.$rs->codigo.'">'.$rs->nombre.'</option>';
                                        }
                                    ?> <!-- fin de php -->

                                  </select> <!-- fin del formulario que muestra la Cliente -->

                                </div>

                                <!--end of col-->
                                <!--end of col-->
                            </div>
                        </form>
                    </div>
  <!--//////////////////////////////////////////////////////////////////////////////////////-->
                     <!--Buscador de clientes-->
                     <div class="col-12 col-md-12 col-lg-12">
                        
                        <form class="card card-sm">                

                            <div class="card-body row no-gutters align-items-center">

                                <div class="col-auto">
                                    <i class="fas fa-search h4 text-body"></i>
                                </div>
                                <!--end of col-->
                                <div class="col">

                            <!--    <label for="cliente">Cliente:</label> -->

                                    <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Buscar Cliente" id="SearchClientes">
                                </div>
   <!--//////////////////////////////////////////////////////////////////////////////////////-->                               
                                <!--end of col-->
                                <!--end of col-->
                            </div>
                        </form>

                         <div class="row">
                            <div class="col-md-12">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Identificacion</th>
                                            <th scope="col">Nombres</th>
                                            <th scope="col">Celular</th>
                                            <th scope="col">Ciudad</th>                    
                                        </tr>
                                    </thead>
                                    <tbody class='tbodyClientes'>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
        
                    <!--end of col-->
  <!--//////////////////////////////////////////////////////////////////////////////////////-->
               
                </div>





            </div>

            <div class="carrito2 sombra">
                <h5 class='text-center'>Carrito De Compras</h5>
                <h6><span>Cliente:  </span><span class="cliente"></span></h6>
                <div class="carritoVacio">
                    <h6 class='text-center carritoVacio'>Tu carrito está vacío</h6>
                    
                    <h6 class='text-center addProductosTexto'>Agrega productos</h6>
                </div>
                <div class="productosCarritoComidas">

                </div>
                <div class="productosCarritoBebidas">

                </div>
                <hr>

                <div class="totalPedido">

                    <div class="labelTotal">
                        Total: 
                    </div>
                    <div class="valorTotalTotal">

                    </div>
                </div>

                <div class="btnImprimir">Imprimir Factura</div><br>
                <div class="btnGrisTerminar">Realizar Venta</div>

            </div>
            
        </div>  

 



 <!--//////////////////////////////////////////////////////////////////////////////////////-->

            <div class="col-12 col-md-12 col-lg-12">
                       
                        <form class="card card-sm">
                            <div class="card-body row no-gutters align-items-center">
                                <div class="col-auto">
                                    <i class="fas fa-search h4 text-body"></i>
                                </div>
                                <!--end of col-->
                                <div class="col">
                                     <!--   <label for="productos">Productos / Servicios:</label>-->
                                    <input class="form-control form-control-lg form-control-borderless" type="search" placeholder="Buscar Productos / Servicios" id="Search">
                                </div>
                                <!--end of col-->
                                <!--end of col-->
                            </div>
                        </form>

                    </div>
  <!--//////////////////////////////////////////////////////////////////////////////////////-->

     <div class="row">

                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Categoria</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Marca</th>
                                        <th scope="col">Detalle</th>
                                        <th scope="col">Disponible</th>
                                        <th scope="col">Valor</th>
                                        <th scope="col">Iva</th>
                                        <th scope="col">Total</th>
                                    </tr>
                                </thead>
                                <tbody class='tbodyVentas'>
                                </tbody>
                            </table>
                        </div>
                    </div>







  <!--//////////////////////////////////////////////////////////////////////////////////////-->
        <input type="hidden" id="cliente">
    </div>
</div>

</main>
  <!--//////////////////////////////////////////////////////////////////////////////////////-->
<script src="js/ventas/addVentas.js"></script>
<script src="js/ventas/indexVentas.js"></script>
<script src="js/ventas/selectVentas.js"></script>

<?php 
    require "secciones/footer.php"; //invoca el footer php
    require "config/desconexion.php"; //invoca desconexion db 
?> 
