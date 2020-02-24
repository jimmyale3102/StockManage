$(".factura").click(function(e) {
        e.preventDefault();
        var data = $(this).closest('td');
        var factura_id = data.html();
        window.location="/ProyectoBases2/paginas/factura/View.php?factura_id="+factura_id;
});

$(document).on('click', '.delete', function (event) {
    event.preventDefault();
    var row = $(this).closest('tr');
    eliminarFactura(row.find('.factura').text());
    row.remove();
});