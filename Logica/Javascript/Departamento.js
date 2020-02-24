// JavaScript Document
function crear(){
	var url="/ProyectoBases2/Logica/Entidades/Departamento.php"
	var nombre_departamentoCrear= document.getElementById("nombreDepartamento");
	var nombre= nombre_departamentoCrear.value;
	var info="opcion=crear&name="+nombre_departamento;
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
	var url="/ProyectoBases2/Logica/Entidades/Departamento.php"
	var nombre_departamento= document.getElementById("nombre_departamento");
	var nuevo_departamento= document.getElementById("nuevoNombre");
	var nombre= nombre_departamento.value;
	var nuevoNombre= nuevo_departamento.value;
	var info="opcion=editar&name="+nombre_departamento+"&newName="+nuevoNombre;
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