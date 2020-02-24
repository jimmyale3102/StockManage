function crear() {
	var url="/ProyectoBases2/Logica/Entidades/Empleado.php"
	var cargo = document.getElementById("nombreCargo").value;
	var nombre = document.getElementById("nombre").value;
	var apellido = document.getElementById("apellido").value;
	var telefono = document.getElementById("telefono").value;
	alert(cargo);
	var info="opcion=crear&cargo=" + cargo + "&nombre=" + nombre + "&apellido=" + apellido + "&telefono=" + telefono;
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

function editarEmpleado(){
	var url="/ProyectoBases2/Logica/Entidades/Empleado.php"
	var oldEmpleado= document.getElementById("empleado").value;
	var nombreCargo= document.getElementById("nombreCargo").value;
	var nombre = document.getElementById("nombre").value;
	var apellido = document.getElementById("apellido").value;
	var telefono = document.getElementById("telefono").value;
	var info="opcion=editar&oldEmpleado=" + oldEmpleado + "&nombreCargo=" + nombreCargo + "&nombre=" + nombre + "&apellido=" + apellido + "&telefono=" + telefono;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
			//Limpia los valores de entrada
			document.getElementById("nombre").value = "";
			document.getElementById("apellido").value = "";
			document.getElementById("telefono").value = "";
		}
	};
	xhr.send(info);
}

function eliminar(){
	var url="/ProyectoBases2/Logica/Entidades/Empleado.php"
	var idEmpleado=document.getElementById("idEmpleado").value;
	var info="opcion=eliminar&idEmpleado="+idEmpleado;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
			document.getElementById("idEmpleado").value = "";
		}
	};
	xhr.send(info);
}

function getInfo(){
	var url="/ProyectoBases2/Logica/Entidades/Empleado.php"
	var idEmpleado = document.getElementById("empleado").value;
	var info="opcion=info&idEmpleado="+idEmpleado;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			var information = xhr.responseText;
			var splitInf = information.split("-");
			document.getElementById("nombre").value = splitInf[0];
			document.getElementById("apellido").value = splitInf[1];
			document.getElementById("telefono").value = splitInf[2];
		}
	};
	xhr.send(info);
}

