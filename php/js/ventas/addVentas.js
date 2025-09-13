jQuery(function($) {
    $(".saveComprass").click(function() {
        var cateCod = $('#cateCod').val();
        var comCant = $('#comCant').val();
        var cateSubCate = $('#cateSubCate').val();
        var comValorVenta = $('#comValorVenta').val();        
        var comValorUnidad = $('#comValorUnidad').val();
        console.log(comValorVenta);
        var comValorTotal = $('#comValorTotal').val();
        var data = "cateCod=" + cateCod + "&comCant=" + comCant + "&subCod=" + cateSubCate + "&comValorVenta=" + comValorVenta + "&comValorUnidad=" + comValorUnidad + "&comValorTotal=" + comValorTotal + "&addCompras=";
        $.ajax({
            type: "POST",
            url: "./services/compras/addCompras.php",
            data: data,
            success: function(data) {   
            console.log(data);             
                $('.mensajes').html('');
                if (data == '1') {
                    Swal.fire({
                        position: 'center',
                        type: 'success',
                        title: 'Guardado Correctamente',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    $('.containerCompras').hide();
                    $('.tableCompras').show();
                    selectCompras();
                    selectInventario();
                } else {
                    $('.mensajes').append('<h5>Error</h5>');
                }
            }
        })
    });
});