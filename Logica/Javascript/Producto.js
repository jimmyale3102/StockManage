function crear() {
	var url="/ProyectoBases2/Logica/Entidades/Producto.php"
	var nombre_Producto= document.getElementById("nombreProducto");
	var descripcion= document.getElementById("desc");
	var valorUn= document.getElementById("valor");
	var stock= document.getElementById("stock");
	var cat= document.getElementById("optionCat");
	var nombre= nombre_Producto.value;
	var des= descripcion.value;
	var valUnitario= valorUn.value;
	var cantidad= stock.value;
	var categoria= cat.value;
	var info="opcion=crear&name="+nombre+"&desc="+des+"&unidad="+valUnitario+"&cantidad="+cantidad+"&categoria="+categoria;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
		}
	};
	xhr.send(info);
}

function editar(){
	var url="/ProyectoBases2/Logica/Entidades/Producto.php"
	var txtProducto= document.getElementById("nameProducto");
	var txtNombre= document.getElementById("newName");						
	var txtDesc= document.getElementById("newDesc");			
	var txtValor= document.getElementById("newValor");					
	var txtCantidad= document.getElementById("newStock");	
	var cat= document.getElementById("optionCat");

	var producto= txtProducto.value;
	var nombre= txtNombre.value;
	var des= txtDesc.value;
	var valUnitario= txtValor.value;
	var cantidad= txtCantidad.value;
	var categoria= cat.value;
	var info="opcion=editar&producto="+producto+"&nombre="+nombre+"&desc="+des+"&valUnitario="+valUnitario+"&cantidad="+cantidad+"&categoria="+categoria;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
		}
	};
	xhr.send(info);
}


function eliminar(){
	var idPro=document.getElementById("idPro");
	var url="/ProyectoBases2/Logica/Entidades/Producto.php"
	var text_idPro= idPro.value;
	var info="opcion=eliminar&idPro="+text_idPro;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
		}
	};
	xhr.send(info);
}


function buscar(){
	var txtNombre= document.getElementById("newName");						
	var txtDesc= document.getElementById("newDesc");			
	var txtValor= document.getElementById("newValor");					


	var selectInfo=document.getElementById("nameProducto");
	var url="/ProyectoBases2/Logica/Entidades/Producto.php"
	var infoProducto= selectInfo.value;
	var info="opcion=buscar&selectInfo="+infoProducto;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			var cadena= xhr.responseText.split(",");
			txtNombre.value=cadena[0];
			txtDesc.value=cadena[1];
			txtValor.value=cadena[2];
		}
	};
	xhr.send(info);
}