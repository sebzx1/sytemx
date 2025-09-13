/*JAVA QUE PERMITE IMPRIMIR LOS VALORES DE LAS TABLAS*/

	var table = $('.table').DataTable({
		dom: 'Bfrtip',
        buttons: [
            'copy', 'excel','print'
        ],
        responsive: true,
		"order": [[ 0, "desc" ]],
		language: {
			"decimal":        "",
			"emptyTable":     "No hay registros",
			"info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",
			"infoEmpty":      "Monstrando 0 a 0 de 0 registros",
			"infoFiltered":   "(Filtrado de _MAX_ total registros)",
			"infoPostFix":    "",
			"thousands":      ",",
			"lengthMenu":     "Mostrando _MENU_ registros",
			"loadingRecords": "Cargando...",
			"processing":     "Procesando...",
			"search":         "Buscar:",
			"zeroRecords":    "No hay Registros",
			"paginate": {
				"first":      "Primero",
				"last":       "Ultimo",
				"next":       "Siguiente",
				"previous":   "Anterior"
			},
			"aria": {
				"sortAscending":  ": activate to sort column ascending",
				"sortDescending": ": activate to sort column descending"
			}
		}
		
	}); 
	new $.fn.dataTable.FixedHeader( table );