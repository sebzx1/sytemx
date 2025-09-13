function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;
    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

    return amount_parts.join('.');
}

var valorProducto = 0;  
    var boxTotal = 0;
    var boxMostrar = 0;
    var producto;
    var total = 0;
    var bebida = 0;
    var dataIngredientesCarrito = [];   
    var dataCarritoSaved = [];  
    var productoCod;
    var ventCod = 0;
    var contador = 0;
    var productosEnviar = [];   
$(document).on('keyup', '#Search',function (e) {
    var data = "item=" + $(this).val() + "&selectSubCategoriasxcategorias=";    
    $.ajax({
        type: "POST",
        url: "./services/ventas/SelectProductosVentas.php",
        data:data,
        success: function(data) {
            $('.tbodyVentas').html('');            
            var json = JSON.parse(data);            
            if(json.length>0){
                for (var i = 0; i < json.length; i++) {
                    var valor = (parseInt(json[i].valor) +parseInt(((json[i].valor * json[i].iva)/ 100)));
                    $('.tbodyVentas').append('<tr class="AgregaralCarrito AgregaralCarrito'+json[i].codigo+'" data-codProducto ="'+json[i].codProducto+'" data-id="'+ json[i].codigo +'" data-name="'+ json[i].nombreProducto +'" data-valor="'+ valor +'"><td>'+json[i].codProducto+'</td><td>' + json[i].nombre + '</td><td>' + json[i].nombreProducto + '</td><td>' + json[i].cantidad + '</td><td>'+json[i].valor+'</td><td>'+json[i].iva+'%</td><td>$' + number_format(valor,0)  +'</td></tr>')
                }    
                }else{
                    $('.tbodyVentas').append('<tr><td class="text-center" colspan="4">No hay productos Disponibles</td></tr>')
            }
            
        }
    })
});


 $(document).on('click', '.btnImprimir',function (e) {
    $('.carrito2').printThis({
        importCSS: true
    })
 });
$(document).on('keyup', '#SearchClientes',function (e) {
    var data = "item=" + $(this).val();    
    $.ajax({
        type: "POST",
        url: "./services/ventas/selectClientes.php",
        data:data,
        success: function(data) {
            $('.tbodyClientes').html('');            
            var json = JSON.parse(data);            
            if(json.length>0){
                for (var i = 0; i < json.length; i++) {
                    $('.tbodyClientes').append('<tr class="AgregarCliente" data-codigo="'+json[i].codigo+'" data-nombres="'+json[i].nombres+'"><td>'+json[i].identificacion+'</td><td>'+json[i].nombres+'</td></tr>')
                }    
                }else{
                    $('.tbodyClientes').append('<tr><td class="text-center" colspan="4">No hay cliente</td></tr>')
            }
            
        }
    })
});


$(document).on('click', '.AgregaralCarrito', function(e) {  
        var prodCod = $(this).data('id');  
        var prodNom = $(this).data('name');     
        var prodValor = $(this).data('valor');    
        var codProducto = $(this).data('codproducto');  
        total = parseInt(total) + parseInt(prodValor);           
        var item = $('.itemCarrito'+prodCod).data('id');  
        $('.carritoVacio').hide();
        if(item>0){  
            valorItem = parseInt($('.itemValor'+prodCod).attr('data-value')) + prodValor;             
            $('.itemValor'+prodCod).html('');
            $('.itemValor'+prodCod).attr("data-value",valorItem);
            $('.itemValor'+prodCod).append('$'+number_format(valorItem));   
            boxTotal = $('.itemCantidad'+prodCod).attr('data-value');            
            boxMostrar = parseInt(boxTotal) + 1;
            $('.itemCantidad'+prodCod).attr("data-value",boxMostrar);    
            $('.itemCantidad'+prodCod).html('');
            $('.itemCantidad'+prodCod).append(boxMostrar);
            $('.btnDeleteItem'+prodCod).attr("data-cantidad",boxMostrar); 
            for (var i = 0; i < productosEnviar.length; i++) {
                if(productosEnviar[i].subCod == prodCod){
                    productosEnviar[i].subCant = boxMostrar;
                }
            }
        }else{
            productosEnviar.push({subCod:prodCod,subCant:1,codProducto:codProducto});
            $('.productosCarritoComidas').append('<div class="itemCarrito itemCarrito'+prodCod+'" data-id="'+ prodCod +'"><div class="itemCantidad itemCantidad'+prodCod+'" data-id="1">1</div> <div class="itemNombre">'+prodNom+'</div><div class="itemValor itemValor'+prodCod+'" data-id="'+ prodCod +'">$'+ number_format(prodValor) +'</div><div class="itemDelete itemDelete'+prodCod+'"><button class="btn btn-danger btnDeleteItem btnDeleteItem'+prodCod+'" data-id='+prodCod+' data-cantidad="1" data-valor='+prodValor+'><i class="fas fa-trash"></i></button></div></div>');        
            $('.itemCantidad'+prodCod).attr("data-value",1); 
            $('.itemValor'+prodCod).attr("data-value",prodValor);  
        }      
        $('.btnGrisTerminar').addClass('btnRojoTerminar')
        $('.valorTotalTotal').html('');
        $('.valorTotalTotal').append('$'+number_format(total));         
    });


$(document).on('click', '.AgregarCliente', function(e) {  
        $('#cliente').val($(this).data('codigo'));  
        $('.cliente').text($(this).data('nombres'));
        $('.tbodyClientes').html(''); 
        $('#SearchClientes').val('');
    });


    $(document).on('click', '.btnDeleteItem', function(e) {
        var id = $(this).data('id');  
        var valor = $(this).data('valor');   
        var cantidad = $(this).data('cantidad');   
        for (var i = 0; i < productosEnviar.length; i++) {
            if(productosEnviar[i].subCod == id){
                productosEnviar.splice(i, 1);
            }
        }
        
        valor = cantidad * valor;               
        $('.itemCarrito'+id).remove();                  
        total = total - valor;   
        $('.valorTotalTotal').html('');      
        $('.valorTotalTotal').append('$'+number_format(total));        
        if(total == 0){
            $('.btnGrisTerminar').removeClass('btnRojoTerminar')
        }
    });


    $(document).on('click', '.btnRojoTerminar', function(e) {   

            Swal.fire({
            title: 'Realizar Compra?',            
            type: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si!'
        }).then((result) => {
            if (result.value) {                
                var cliente = $('#cliente').val();
                var trabajador = $('#trabajador').val();
                var data = "ventSubtotal=" + total + "&cliente="+cliente+"&trabajador="+trabajador+"&addVentas=";             
                $.ajax({
                    type: "POST",
                    url: "./services/ventas/addVentas.php",
                    data:data,
                    success: function(data) { 
                        $('.carrito2').printThis();                        
                        total = 0;                    
                        ventCod = data;
                        var exito = 0;
                        for (var l = 0; l < productosEnviar.length; l++) {
                            var data = "codProducto=" + productosEnviar[l].codProducto + "&ventCod=" + ventCod + "&subCant=" + productosEnviar[l].subCant + "&subCod=" + productosEnviar[l].subCod + "&addDetalleVentas=";
                            $.ajax({
                                type: "POST",
                                url: "./services/ventas/addDetalleVentas.php",
                                data:data,
                                success: function(data) {  
                                    if (data == '1') {
                                        Swal.fire({
                                            position: 'center',
                                            type: 'success',
                                            title: 'Guardado Correctamente',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })                            
                                    } else {
                                        Swal.fire({
                                            position: 'center',
                                            type: 'error',
                                            title: 'Error intenta nuevamente',
                                            showConfirmButton: false,
                                            timer: 1500
                                        })                            
                                    }
                                }
                            })
                        }                        
                        productosEnviar = [];
                          setTimeout(function(){ 
                            $('.productosCarritoComidas').html('');  
                            $('.valorTotalTotal').html('');  
                            $('.tbodyVentas').html('');            
                            $('.btnGrisTerminar').removeClass('btnRojoTerminar');
                        }, 3000);
                        
                    }
                })


            }
        })
    });