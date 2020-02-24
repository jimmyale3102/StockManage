for ( var i = 0; i < paramarr.length; i++) {
       var tmparr = paramarr[i].split("=");
       params[tmparr[0]] = tmparr[1];
}

if (params['factura_id']) {
       var factu = document.getElementById('codigoFactura');
       factu.value = params['factura_id'];
       factura_id = params['factura_id'];
       //factura(factura_id);
       //productos();
} else {
}

