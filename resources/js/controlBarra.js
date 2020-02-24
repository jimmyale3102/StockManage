var btn_collapse =document.getElementById("sidebarCollapse");
var sidebar =document.getElementById("sidebar");
var nombrePequenho= document.getElementById("sm");
var link= document.getElementById("linkSm");
var navbar= document.getElementById("sidebar");
btn_collapse.addEventListener("click", recoger);
nombrePequenho.addEventListener("click", recoger);

function recoger() {
	if(window.matchMedia("(min-width: 481px) and (max-width: 980px)").matches){
		if(navbar.classList==""){
			sidebar.classList.toggle('active');	
			link.setAttribute("href","#bienvenida");
		}
	}else{
		sidebar.classList.toggle('active');
	}	
}
