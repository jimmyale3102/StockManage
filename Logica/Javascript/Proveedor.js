function crear() {
	var url="/ProyectoBases2/Logica/Entidades/Proveedor.php"
	var txt_nit= document.getElementById("nit");
	var txt_nombreProveedor= document.getElementById("nombreProveedor");
	var txt_tel= document.getElementById("tel");
	var txt_desc= document.getElementById("desc");
	var txt_optionBa= document.getElementById("optionBa");
	var txt_direct= document.getElementById("direct");

	var nit= txt_nit.value;
	alert(nit);
	var nombreProveedor= txt_nombreProveedor.value;
	var tel= txt_tel.value;
	var desc= txt_desc.value;
	var optionBa= txt_optionBa.value;
	var direc= txt_direct.value;

	var info="opcion=crear&nit="+nit+"&nombre="+nombreProveedor+"&tel="+tel+"&desc="+desc+"&bar="+optionBa+"&dir="+direc;
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
	var url="/ProyectoBases2/Logica/Entidades/Proveedor.php"
	var txt_Proveedor= document.getElementById("nameProveedor");
	var txt_newName= document.getElementById("newName");
	var txt_tel= document.getElementById("newTel");
	var txt_desc= document.getElementById("newDesc");
	var txt_optionBa= document.getElementById("optionBa");
	var txt_direct= document.getElementById("direct");

	var proveedor= txt_Proveedor.value;
	var newName= txt_newName.value;
	var tel= txt_tel.value;
	var desc= txt_desc.value;
	var optionBa= txt_optionBa.value;
	var direc= txt_direct.value;

	var info="opcion=editar&nit="+proveedor+"&nombre="+newName+"&tel="+tel+"&desc="+desc+"&bar="+optionBa+"&dir="+direc;
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
	var url="/ProyectoBases2/Logica/Entidades/Proveedor.php"
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


function buscarCi(){
	var txtNombre= document.getElementById("optionDep");	
	var municipio=document.getElementById("optionCi");
	var url="/ProyectoBases2/Logica/Entidades/Proveedor.php"
	var infoDep= txtNombre.value;
	var info="opcion=buscarCi&depa="+infoDep;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			var opcion="<option>----------------</option>";
			var cadena= xhr.responseText.split(",");
			for(var i=0; i<cadena.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+cadena[i]+"'>"+cadena[i+1]+"</option>";
				}
			}
			municipio.innerHTML=opcion;
			municipio.setAttribute("onchange","buscarBa()");
		}
	};
	xhr.send(info);
}


function buscarBa(){
	var txtNombre= document.getElementById("optionCi");	
	var barrio=document.getElementById("optionBa");
	var url="/ProyectoBases2/Logica/Entidades/Proveedor.php"
	var infoCi= txtNombre.value;
	var info="opcion=buscarBa&ciu="+infoCi;
	var xhr = new XMLHttpRequest();
	xhr.open("POST",url,true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.onreadystatechange = function(){
		if(xhr.readyState == 4 && xhr.status == 200){
			var opcion="<option>----------------</option>";
			var cadena= xhr.responseText.split(",");
			for(var i=0; i<cadena.length; i++){
				if(i%2==0){
					opcion=opcion+"<option value='"+cadena[i]+"'>"+cadena[i+1]+"</option>";
				}
			}
			barrio.innerHTML=opcion;
		}
	};
	xhr.send(info);
}