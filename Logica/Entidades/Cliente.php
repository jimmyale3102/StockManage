<?php
	$opcion=$_POST["opcion"];
	$mensaje="";

	switch ($opcion) {
		case 'crear':
			$mensaje= crear();
			break;
		case 'getCities':
			$mensaje= getCities();
			break;
		case 'getBarrio':
			$mensaje= getBarrio();
			break;
		case 'getAddress':
			$mensaje= getAddress();
			break;
		case 'eliminar':
			$mensaje= eliminar();
			break;
		case 'editar':
			$mensaje= editar();
			break;
		case 'info':
			$mensaje= info();
			break;
		case 'getAdr':
			$mensaje= getAdr();
			break;
		case 'getBr':
			$mensaje= getBr();
			break;
		case 'getCd':
			$mensaje= getCd();
			break;
		case 'getDp':
			$mensaje= getDp();
			break;			
	}
	

	function crear(){
		require("connect_DB.php");
		$nombre=$_POST["nombre"];
		$apellido=$_POST["apellido"];
		$telefono=$_POST["telefono"];
		$ubicacion=$_POST["ubicacion"];
		$respuesta="";
		//Trae el nombre de los clientes
		$queryName=mysqli_query($link,"SELECT nombre from cliente where nombre='".$nombre."';");
		$check_name=mysqli_fetch_array($queryName);
		//Trae el apellido de los clientes
		$querySurname=mysqli_query($link,"SELECT apellido from cliente where apellido='".$apellido."';");
		$check_surname=mysqli_fetch_array($querySurname);
		//Valida que no exista el empleado
		if($check_name['nombre']!= $nombre || $check_surname['apellido']!= $apellido){
			//Inserta El cliente
			mysqli_query($link,"insert into cliente(ubicacion_id, nombre, apellido, telefono) values(".$ubicacion.", '".$nombre."', '" .$apellido. "', " .$telefono. ");");
			$respuesta="Cliente creado con éxito";
		}else{	
			$respuesta="El cliente ya exites";
		}
		return $respuesta;
	}

	function getCities(){
		require("connect_DB.php");
		$departamento=$_POST["departamento"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT ciudad_id, nombre_ciudad from ciudad where departamento_id=".$departamento.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['ciudad_id'].",".$row['nombre_ciudad'];
		}
		return ltrim($respuesta,",");
	}

	function getBarrio(){
		require("connect_DB.php");
		$ciudad=$_POST["ciudad"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT barrio_id, nombre_barrio from barrio where ciudad_id=".$ciudad.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['barrio_id'].",".$row['nombre_barrio'];
		}
		return ltrim($respuesta,",");
	}

	function getAddress(){
		require("connect_DB.php");
		$barrio=$_POST["barrio"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT ubicacion_id, direccion from ubicacion where barrio_id=".$barrio.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['ubicacion_id'].",".$row['direccion'];
		}
		return ltrim($respuesta,",");
	}

	function eliminar(){
		require("connect_DB.php");
		$idCliente=$_POST["idCliente"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from cliente where cliente_id=".$idCliente.";");
		$check=mysqli_fetch_array($query);
		if($check['cliente_id']== $idCliente){
			mysqli_query($link,"delete from cliente where cliente_id=".$idCliente.";");
			$respuesta="Cliente eliminado con éxito";
		}else{	
			$respuesta="El cliente no existe";
		}
		return $respuesta;
	}

	//Metodos para la edición de cliente


	function editar(){
		require("connect_DB.php");
		$oldCliente=$_POST["oldCliente"];
		$nombre=$_POST["nombre"];
		$apellido=$_POST["apellido"];
		$telefono=$_POST["telefono"];
		$ubicacion=$_POST["ubicacion"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT cliente_id from cliente where cliente_id=".$oldCliente.";");
		$check_empleado=mysqli_fetch_array($query);
		if( $check_empleado['cliente_id'] == $oldCliente ){
			mysqli_query($link,"update cliente set ubicacion_id=".$ubicacion." where cliente_id=".$oldCliente.";");
			if(strlen($nombre) > 0){
				mysqli_query($link,"update cliente set nombre='".$nombre."' where cliente_id=".$oldCliente.";");
			}
			if(strlen($apellido) > 0){
				mysqli_query($link,"update cliente set apellido='".$apellido."' where cliente_id=".$oldCliente.";");
			}
			if(strlen($telefono) > 0){
				mysqli_query($link,"update cliente set telefono='".$telefono."' where cliente_id=".$oldCliente.";");
			}
			$respuesta="Cliente modificado con éxito";
		}else{	
			$respuesta="El cliente ".$nombre." no existe";
		}
		return $respuesta;
	}

	function info(){
		require("connect_DB.php");
		$oldCliente=$_POST["oldCliente"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from cliente where cliente_id=".$oldCliente.";");
		$check=mysqli_fetch_array($query);
		$respuesta=$check['cliente_id']."-".$check['ubicacion_id']."-".$check['nombre']."-".$check['apellido']."-".$check['telefono'];
		return $respuesta;
	}

	function getAdr(){
		require("connect_DB.php");
		$ubicacion=$_POST["ubicacion"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT ubicacion_id, direccion, barrio_id from ubicacion where ubicacion_id=".$ubicacion.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['ubicacion_id'].",".$row['direccion'].",".$row['barrio_id'];
		}
		return ltrim($respuesta,",");
	}

	function getBr(){
		require("connect_DB.php");
		$barrio=$_POST["barrio"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from barrio where barrio_id=".$barrio.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['barrio_id'].",".$row['nombre_barrio'].",".$row['ciudad_id'];
		}
		return ltrim($respuesta,",");
	}

	function getCd(){
		require("connect_DB.php");
		$ciudad=$_POST["ciudad"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from ciudad where ciudad_id=".$ciudad.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['ciudad_id'].",".$row['nombre_ciudad'].",".$row['departamento_id'];
		}
		return ltrim($respuesta,",");
	}

	function getDp(){
		require("connect_DB.php");
		$departamento=$_POST["departamento"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from departamento where departamento_id=".$departamento.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['departamento_id'].",".$row['nombre_departamento'];
		}
		return ltrim($respuesta,",");
	}

	echo $mensaje;