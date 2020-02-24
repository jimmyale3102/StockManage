var usuario= document.getElementById("user");
var contrasenia= document.getElementById("password");
var login= document.getElementById("login");
var url=window.location;
login.addEventListener("click", entrar);

function entrar() {
	var u= usuario.value;
	var c= contrasenia.value;
    var url="/ProyectoBases2/Logica/Entidades/Login.php"
    var info="user="+u+"&pass="+c;
    var xhr = new XMLHttpRequest();
    xhr.open("POST",url,true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200){
            var respuesta=parseInt(xhr.responseText);

            switch(respuesta){
                case -1:
                    alert("El usuario no existe");
                break;
                case 0:
                    alert("Contraseña equivocada");
                break;
                case 1:
                    window.location="/ProyectoBases2/administrador.html";
                break;
                case 2:
                    window.location="/ProyectoBases2/vendedor.html";
                break;
                default:
                    alert("Vaya, parece que no tienes acceso al sistema");
                break
            }
        }
    };
    xhr.send(info);
	
}