<?php
	$opcion=$_POST["opcion"];
	$mensaje="";

	switch ($opcion) {
		case 'crear':
			$mensaje= crear();
			break;
		case 'editar':
			$mensaje= editar();
			break;
		case 'info':
			$mensaje= info();
			break;
		case 'eliminar':
			$mensaje= eliminar();
			break;
	}
	

	function crear(){
		require("connect_DB.php");
		$cargo=$_POST["cargo"];
		$nombre=$_POST["nombre"];
		$apellido=$_POST["apellido"];
		$telefono=$_POST["telefono"];
		$respuesta="";
		//Trae el nombre de los empleados
		$queryName=mysqli_query($link,"SELECT nombre from empleado where nombre='".$nombre."';");
		$check_name=mysqli_fetch_array($queryName);
		//Trae el apellido de los empleados
		$querySurname=mysqli_query($link,"SELECT apellido from empleado where apellido='".$apellido."';");
		$check_surname=mysqli_fetch_array($querySurname);
		//Valida que no exista el empleado
		if($check_name['nombre']!= $nombre || $check_surname['apellido']!= $apellido){
			//Trae el Id del cargo
			mysqli_query($link,"insert into empleado(cargo_id, nombre, apellido, telefono) values(".$cargo.", '".$nombre."', '" .$apellido. "', " .$telefono. ");");
			$respuesta="Empleado creado con éxito";
		}else{	
			$respuesta="El Empleado ya exite";
		}
		return $respuesta;
	}

	function editar(){
		require("connect_DB.php");
		$oldEmpleado=$_POST["oldEmpleado"];
		$nombreCargo=$_POST["nombreCargo"];
		$nombre=$_POST["nombre"];
		$apellido=$_POST["apellido"];
		$telefono=$_POST["telefono"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT empleado_id from empleado where empleado_id=".$oldEmpleado.";");
		$check_empleado=mysqli_fetch_array($query);
		if( $check_empleado['empleado_id'] == $oldEmpleado ){
			mysqli_query($link,"update empleado set cargo_id='".$nombreCargo."' where empleado_id=".$oldEmpleado.";");
			if(strlen($nombre) > 0){
				mysqli_query($link,"update empleado set nombre='".$nombre."' where empleado_id=".$oldEmpleado.";");
			}
			if(strlen($apellido) > 0){
				mysqli_query($link,"update empleado set apellido='".$apellido."' where empleado_id=".$oldEmpleado.";");
			}
			if(strlen($telefono) > 0){
				mysqli_query($link,"update empleado set telefono='".$telefono."' where empleado_id=".$oldEmpleado.";");
			}
			$respuesta="Empleado modificado con éxito";
		}else{	
			$respuesta="El empleado ".$nombre." no existe";
		}
		return $respuesta;
	}

	function info(){
		require("connect_DB.php");
		$idEmpleado=$_POST["idEmpleado"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from empleado where empleado_id=".$idEmpleado.";");
		$check=mysqli_fetch_array($query);
		$respuesta=$check['nombre']."-".$check['apellido']."-".$check['telefono'];
		return $respuesta;
	}

	function eliminar(){
		require("connect_DB.php");
		$idEmpleado=$_POST["idEmpleado"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from empleado where empleado_id=".$idEmpleado.";");
		$check=mysqli_fetch_array($query);
		if($check['empleado_id']== $idEmpleado){
			mysqli_query($link,"delete from empleado where empleado_id=".$idEmpleado.";");
			$respuesta="Empleado eliminado con éxito";
		}else{	
			$respuesta="El empleado no existe";
		}
		return $respuesta;
	}



	echo $mensaje;