var url="/ProyectoBases2/Logica/Entidades/Factura.php"
function crearVenta(){
	var date= new Date();
	var dateVenc= new Date();
	dateVenc.setDate(dateVenc.getDate()+30)

	var empleado_id = document.getElementById("empleado_id").value;
	var cliente_id = document.getElementById("cliente").value;
	var nit = null;
	var fecha_factura = date.getFullYear()+"-"+addZero(date.getMonth()+1)+"-"+addZero(date.getDate());
	var fecha_vencimiento = dateVenc.getFullYear()+"-"+addZero(dateVenc.getMonth()+1)+"-"+addZero(dateVenc.getDate());
	var saldo = document.getElementById("saldo").value;
	var subtotal = document.getElementById("subtotal").value;
	var total = document.getElementById("total").value;
	alert(empleado_id);
	var info="opcion=crear&empleado="+empleado_id+"&cliente="+cliente_id+
	"&nitE="+nit+"&fecha="+fecha_factura+"&fechavenc="+fecha_vencimiento+
	"&sal="+saldo+"&subt="+subtotal+"&t="+total;
	var xhr = new XMLHttpRequest()
	xhr.open("POST",url,false);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
		}
	};
	xhr.send(info)

	guardarProductos();
	
}

function crearCompra(){ 
	alert("Buenas");
	var date= new Date();
	var dateVenc= new Date();
	dateVenc.setDate(dateVenc.getDate()+30)

	var empleado_id = document.getElementById("empleado_id").value;
	var cliente_id = null;
	var nit = document.getElementById("proveedor").value;
	var fecha_factura = date.getFullYear()+"-"+addZero(date.getMonth()+1)+"-"+addZero(date.getDate());
	var fecha_vencimiento = dateVenc.getFullYear()+"-"+addZero(dateVenc.getMonth()+1)+"-"+addZero(dateVenc.getDate());
	var saldo = document.getElementById("saldo").value;
	var subtotal = document.getElementById("subtotal").value;
	var total = document.getElementById("total").value;
	alert(empleado_id);
	var info="opcion=crear&empleado="+empleado_id+"&cliente="+cliente_id+
	"&nitE="+nit+"&fecha="+fecha_factura+"&fechavenc="+fecha_vencimiento+
	"&sal="+saldo+"&subt="+subtotal+"&t="+total;
	var xhr = new XMLHttpRequest()
	xhr.open("POST",url,false);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
		}
	};
	xhr.send(info)

	guardarProductos();
	
}

var guardarProductos = function(){
	var contador=0;
	var producto = null;
	var nombre_Prod;
	var cantidad;
	var costo;
	$('#tabla_productos ').find('tr').each(function () {
    	$(this).find('td').each(function () {

    		switch (contador){
    			case 0:
    			producto = $(this).text();
    				contador++;
    			break;
    		
    			case 1:
    				contador++;
    			break;

    			case 2:
    			cantidad = $(this).text();
    				contador++;
    			break;

    			case 3:
    				contador++;
    			break;

    			case 4:
    			costo = $(this).text();
    				contador++;
    			break;
    			case 5:
    				contador=0;
    			break;

    		}    
        })
    	 if(producto != null){
	        var info="opcion=crearDetalle&producto="+producto+
	        "&cantidad="+cantidad+"&costo="+costo;
		
			var xhr = new XMLHttpRequest()
			xhr.open("POST",url,false);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
					//alert(xhr.responseText);
				}
			};
			xhr.send(info)
		}
       
    })

    
}

function actualizarFactu(){

	var codFac = document.getElementById('codigoFactura').value;
	var nuevoEmp = document.getElementById('nameEmpleado').value;
	var nuevoCli = document.getElementById("nameCliente").value;
	var nuevoPro = document.getElementById("nameProveedor").value;
	var nuevoSaldo = document.getElementById('saldo').value;
	var nuevoSubtotal = document.getElementById('subtotal').value;
	var nuevoTotal = document.getElementById('total').value;

	var info="opcion=editar&factura_id="+codFac+"&newClient="+nuevoCli+
	"&newNit="+nuevoPro+"&newEmpleado_id="+nuevoEmp+"&newSaldo="+nuevoSaldo+
	"&newSubtotal="+nuevoSubtotal+"&newTotal="+nuevoTotal;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,false);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
		}
	};
	xhr.send(info);

	actualizarDetalle(codFac);

}

function actualizarDetalle(factura_id){

	var contador=0;
	var producto = null;
	var nombre_Prod;
	var cantidad;
	var costo;
	$('#tabla_productos ').find('tr').each(function () {
    	$(this).find('td').each(function () {

    		switch (contador){
    			case 0:
    			producto = $(this).text();
    				contador++;
    			break;
    		
    			case 1:
    				contador++;
    			break;

    			case 2:
    			cantidad = $(this).text();
    				contador++;
    			break;

    			case 3:
    				contador++;
    			break;

    			case 4:
    			costo = $(this).text();
    				contador++;
    			break;
    			case 5:
    				contador=0;
    			break;

    		}    
        })
    	 if(producto != null){
	        var info="opcion=editarDetalle&factura_id="+factura_id+"&producto="+producto+
	        "&cantidad="+cantidad+"&costo="+costo;
		
			var xhr = new XMLHttpRequest()
			xhr.open("POST",url,false);
			xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			
			xhr.onreadystatechange = function(){
				if(xhr.readyState == 4 && xhr.status == 200){
					//alert(xhr.responseText);
				}
			};
			xhr.send(info)
		}
       
    })



}
function eliminarFactura(factura){
	var factura_id=factura;
	var info="opcion=eliminar&factura="+factura_id;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,false);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
		}
	};
	xhr.send(info);
}


function addZero(i) {
    if (i < 10) {
        i = '0' + i;
    }
    return i;
}