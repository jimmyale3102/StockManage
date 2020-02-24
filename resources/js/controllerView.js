var url="/ProyectoBases2/Logica/Entidades/Factura.php"
var factura_id;
var paramstr = window.location.search.substr(1);
var paramarr = paramstr.split ("&");
var params = {};

for ( var i = 0; i < paramarr.length; i++) {
       var tmparr = paramarr[i].split("=");
       params[tmparr[0]] = tmparr[1];
}

if (params['factura_id']) {
       var factu = document.getElementById('codigoFactura');
       factu.value = params['factura_id'];
       factura_id = params['factura_id'];
       productos();
       factura(factura_id);
} else {
}


function productos(){
	

	var info="opcion=buscarProductos&factura_id="+factura_id;
	var arrayCadena = "";
	var newRow="rfghj";
	var atr;
	var xhr = new XMLHttpRequest()
		xhr.open("POST",url,false);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4 && xhr.status == 200){
				arrayCadena = xhr.responseText.split('--');
			}
		};
		xhr.send(info)
		
		for(var i = 0; i<(arrayCadena.length-1); i++){
			atr = arrayCadena[i].split('-');
			newRow ='<td><div class="row_dataId_producto" edit_type="click" value="'+atr[0]+'"col_name="fid">'+atr[0]+'</div></td>';
			newRow +='<td><div class="row_dataName" edit_type="click" col_name="fname">'+atr[1]+'</div></td>';
			newRow +='<td><div class="row_dataQuatity" edit_type="click" type="number" required="true" col_name="fquantity">'+atr[2]+'</div></td>';
			newRow +='<td><div class="row_dataValUn" edit_type="click" col_name="fvalU">'+atr[3]+'</div></td>';
			newRow +='<td><div class="row_dataCost" edit_type="click" col_name="fcosto">'+atr[4]+'</div></td>';
			newRow +='<td><div class="delete" edit_type="click" col_name="faction">'+
			'<a class="delete" style="color: #ffc107"onmousemove="underline(this)" onmouseout="blankunderline(this)" disabled>'+
			'eliminar</a></div></td>';
			var btn = document.createElement("tr");
		   	btn.innerHTML=newRow;
		    document.getElementById("tabla_productos").appendChild(btn);
		}
		
		
		
		
		

	
}

function factura(factura_id){

	var txtCliente="";
	var txtProveedor="";
	var txtNit="";
	var txtEmpleado="";
	var txtFechaFac="";
	var txtFechaVen="";
	var inputSaldo = document.getElementById('saldo');
	var inputSubtotal = document.getElementById('subtotal');
	var inputTotal = document.getElementById('total');

	var info="opcion=buscar&factura="+factura_id;
		
	var xhr = new XMLHttpRequest()
		xhr.open("POST",url,false);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		
		xhr.onreadystatechange = function(){
			if(xhr.readyState == 4 && xhr.status == 200){
				var cadena= xhr.responseText.split(",");
				txtCliente = cadena[0];
				txtProveedor=cadena[1];
				txtEmpleado=cadena[2];
				txtFechaFac=cadena[3];
				txtFechaVen=cadena[4];
				inputSaldo.value = cadena[5];
				inputSubtotal.value = cadena[6];
				inputTotal.value = cadena[7];
			}
		};
		xhr.send(info)
	
	if(txtProveedor == "--"){
		//Esconde el div de proveedor 
		var divProveedor = document.getElementById("proveedor");
		divProveedor.style.display = 'none';

		//Trae los valores del cliente
		var cadenaCliente = txtCliente.split("--");
		var selectCliente = document.getElementById("nameCliente");
		selectCliente.value = cadenaCliente[0];
		selectCliente.innerHtml()  = cadenaCliente[1];
		
	}else{
		//Esconde el div del cliente
		var divCliente = document.getElementById("cliente");
		divCliente.style.display = 'none';

		//Trae los valores del proveedor
		var cadenaProveedor = txtProveedor.split("--");
		var selectProveedor = document.getElementById("nameProveedor");
		selectProveedor.value = cadenaProveedor[0];
		selectProveedor.innerHtml()  = cadenaProveedor[1];

	}

	var selectEmpleado = document.getElementById('nameEmpleado');
	var cadenaEmpleado = txtEmpleado.split("--");
	selectEmpleado.value = cadenaEmpleado[0];
	selectEmpleado.innerHtml() = cadenaEmpleado[1];

	
	inputSaldo.value = txtSaldo;

	var inputSubtotal = document.getElementById('subtotal');
	inputSubtotal.value = txtSubtotal;

	var inputTotal = document.getElementById('total');
	inputTotal.value = txtTotal;

}
function editarFact(){

	var selectEmp = document.getElementById('nameEmpleado');
	var selectCli = document.getElementById("nameCliente");
	var selectPro = document.getElementById("nameProveedor");
	var divProd = document.getElementById("product");
	divProd.style.display = 'flex';

	var selectProduct = document.getElementById('producto');

	selectEmp.disabled =false;
	selectCli.disabled =false;
	selectPro.disabled =false;
	selectProduct.disabled =false;
}