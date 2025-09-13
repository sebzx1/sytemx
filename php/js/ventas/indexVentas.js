jQuery(function($) {
    $(document).on('click', '.clickVentas',function (e) {
        $('.negocio').hide();
        $('.usuario').hide();
        $('.categorias').hide();
        $('.ingredientes').hide();
        $('.productos').hide();
        $('.ventas').show();
        $('.compras').hide();
        $('.pedidos').hide();
        $('.inventario').hide();
        $('.subCategorias').hide();
        $('.consultarVentasElectronicas').hide();
    });
    $('#loading').css("display","none");


    // $(".newCompras").click(function() {
    //     $('.containerCompras').show();
    //     $('.tableCompras').hide();
    //     $.ajax({
    //         type: "POST",
    //         url: "./services/categorias/selectCategorias.php",
    //         success: function(data) {
    //             $('#cateCod').html('');
    //             var json = JSON.parse(data);
    //             $('#cateCod').append('<option value="-1">Seleccionar</option>')
    //             for (var i = 0; i < json.length; i++) {
    //                 $('#cateCod').append('<option value='+json[i].cateCod +'>'+json[i].cateNom + '</option>')
    //             }
    //         }
    //     })
    // });

    $("#cateCod").change(function() {
        var cateCod = $('#cateCod').val();
        console.log(cateCod);
        var data = "cateCod=" + cateCod + "&selectSubCategoriasxcategorias=";
        $.ajax({
            type: "POST",
            url: "./services/subCategorias/selectSubCategoriasxcategorias.php",
            data:data,
            success: function(data) {
                $('#cateSubCate').html('');
                var json = JSON.parse(data);
                console.log(json);
                $('#cateSubCate').append('<option value="-1">Seleccionar</option>')
                for (var i = 0; i < json.length; i++) {
                    $('#cateSubCate').append('<option value='+json[i].subCod +'>'+json[i].subNom + '</option>')
                }
            }
        })
    });

    $(".cancelCompras").click(function() {
        $('.containerCompras').hide();
        $('.tableCompras').show();
    });

    $("#comValorUnidad").keyup(function() {
        var cantidad = $('#comCant').val();
        var comValorUnidad = $('#comValorUnidad').val();
        $('#comValorTotal').val(parseInt(cantidad) * parseInt(comValorUnidad));
    });

    $("#comCant").keyup(function() {
        var cantidad = $('#comCant').val();
        var comValorUnidad = $('#comValorUnidad').val();
        $('#comValorTotal').val(parseInt(cantidad) * parseInt(comValorUnidad));
    });
});
