function crear() {
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var nombre = document.getElementById("nombre").value;
	var apellido = document.getElementById("apellido").value;
	var telefono = document.getElementById("telefono").value;
	var ubicacion = document.getElementById("ubicacion").value;
	var info="opcion=crear&nombre=" + nombre + "&apellido=" + apellido + "&telefono=" + telefono + "&ubicacion=" + ubicacion;
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
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var idCliente=document.getElementById("idCliente").value;
	var info="opcion=eliminar&idCliente="+idCliente;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
			document.getElementById("idCliente").value = "";
		}
	};
	xhr.send(info);
}

function editar(){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var oldCliente = document.getElementById("oldCliente").value;
	var nombre = document.getElementById("nombre").value;
	var apellido = document.getElementById("apellido").value;
	var telefono = document.getElementById("telefono").value;
	var ubicacion = document.getElementById("ubicacion").value;
	var info="opcion=editar&oldCliente="+oldCliente+"&nombre=" + nombre + "&apellido=" + apellido + "&telefono=" + telefono + "&ubicacion=" + ubicacion;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			alert(xhr.responseText);
			document.getElementById("nombre").value = "";
			document.getElementById("apellido").value = "";
			document.getElementById("telefono").value = "";
		}
	};
	xhr.send(info);
}

function getCities(){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var departamento = document.getElementById("departamento").value;
	var info="opcion=getCities&departamento=" + departamento;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xhr.onreadystatechange = function(){		
		if(xhr.readyState == 4 && xhr.status == 200){
			var cities = xhr.responseText.split(",");
			var city = document.getElementById("ciudad");
			var opcion="<option>---------------</option>";
			for(var i=0; i<cities.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+cities[i]+"'>"+cities[i+1]+"</option>";
				}
			}
			city.innerHTML=opcion;
			city.setAttribute("onchange","getBarrio()");
		}
	};
	xhr.send(info);
}

function getBarrio(){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var ciudad = document.getElementById("ciudad").value;
	var info="opcion=getBarrio&ciudad=" + ciudad;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xhr.onreadystatechange = function(){		
		if(xhr.readyState == 4 && xhr.status == 200){
			var barrios = xhr.responseText.split(",");
			var barrio = document.getElementById("barrio");
			var opcion="<option>---------------</option>";
			for(var i=0; i<barrios.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+barrios[i]+"'>"+ barrios[i+1]+"</option>";
				}
			}
			barrio.innerHTML=opcion;
			barrio.setAttribute("onchange","getAddress()");
		}
	};
	xhr.send(info);
}

function getAddress(){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var barrio = document.getElementById("barrio").value;
	var info="opcion=getAddress&barrio=" + barrio;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xhr.onreadystatechange = function(){		
		if(xhr.readyState == 4 && xhr.status == 200){
			var address = xhr.responseText.split(",");
			var adr = document.getElementById("ubicacion");
			var opcion="<option>---------------</option>";
			for(var i=0; i<address.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+address[i]+"'>"+ address[i+1]+"</option>";
				}
			}
			adr.innerHTML=opcion;
		}
	};
	xhr.send(info);	
}

function getInf(){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var oldCliente = document.getElementById("oldCliente").value;
	var info="opcion=info&oldCliente="+oldCliente;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			var information = xhr.responseText;
			var splitInf = information.split("-");
			document.getElementById("nombre").value = splitInf[2];
			document.getElementById("apellido").value = splitInf[3];
			document.getElementById("telefono").value = splitInf[4];
			fillAddress(splitInf[1]);
		}
	};
	xhr.send(info);
}

function fillDeptartment(idDepartamento){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var info="opcion=getDp&departamento=" + idDepartamento;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xhr.onreadystatechange = function(){		
		if(xhr.readyState == 4 && xhr.status == 200){
			var departments = xhr.responseText.split(",");
			var department = document.getElementById("departamento");
			var opcion = "";
			for(var i=0; i<departments.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+departments[i]+"'>"+ departments[i+1]+"</option>";
				}
			}
			department.innerHTML=opcion;
		}
	};
	xhr.send(info);	
}

function fillCity(idCiudad){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var info="opcion=getCd&ciudad=" + idCiudad;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xhr.onreadystatechange = function(){		
		if(xhr.readyState == 4 && xhr.status == 200){
			var cities = xhr.responseText.split(",");
			var city = document.getElementById("ciudad");
			var opcion = "";
			for(var i=0; i<cities.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+cities[i]+"'>"+ cities[i+1]+"</option>";
				}
			}
			city.innerHTML=opcion;	
			fillDeptartment(cities[2]);
		}
	};
	xhr.send(info);	
}

function fillBarrio(idBarrio){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var info="opcion=getBr&barrio=" + idBarrio;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xhr.onreadystatechange = function(){		
		if(xhr.readyState == 4 && xhr.status == 200){
			var barrios = xhr.responseText.split(",");
			var br = document.getElementById("barrio");
			var opcion = "";
			for(var i=0; i<barrios.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+barrios[i]+"'>"+ barrios[i+1]+"</option>";
				}
			}
			br.innerHTML=opcion;	
			fillCity(barrios[2]);
		}
	};
	xhr.send(info);	
}

function fillAddress(idAddress){
	var url="/ProyectoBases2/Logica/Entidades/Cliente.php"
	var info="opcion=getAdr&ubicacion=" + idAddress;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");	
	xhr.onreadystatechange = function(){		
		if(xhr.readyState == 4 && xhr.status == 200){
			var address = xhr.responseText.split(",");
			var adr = document.getElementById("ubicacion");
			var opcion = "";
			for(var i=0; i<address.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+address[i]+"'>"+ address[i+1]+"</option>";
				}
			}
			adr.innerHTML=opcion;
			fillBarrio(address[2]);
		}
	};
	xhr.send(info);	
}