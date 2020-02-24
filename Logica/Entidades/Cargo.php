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
		$name=$_POST["name"];
		$salario=$_POST["salario"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT nombre from cargo where nombre='".$name."';");
		$check_categoria=mysqli_fetch_array($query);
		if($check_categoria['nombre']!= $name){
			mysqli_query($link,"insert into cargo(nombre, salario) values('".$name."', ".$salario.");");
			$respuesta="Cargo creado con éxito";
		}else{	
			$respuesta="El cargo ya exite";
		}
		return $respuesta;
	}

	function editar(){
		require("connect_DB.php");
		$name=$_POST["name"];
		$newName=$_POST["newNombre"];
		$salario=$_POST["salario"];
		$respuesta="";
		$id = explode("-", $name);
		//Se obtiene el Id del cargo
		$query=mysqli_query($link,"SELECT cargo_id from cargo where cargo_id=".$id[0].";");
		$check_cargo=mysqli_fetch_array($query);
		//Se obtiene un nombre si ya existe
		$queryNombre=mysqli_query($link,"SELECT nombre from cargo where nombre='".$newName."';");
		$check_nombre=mysqli_fetch_array($queryNombre);
		if( ($check_cargo['cargo_id'] == $id[0]) && ($check_nombre['nombre'] != $id[1]) ){
			if(strlen($newName) > 0){
				mysqli_query($link,"update cargo set nombre='".$newName."' where cargo_id=".$id[0].";");
			}
			if(strlen($salario) > 0){
				mysqli_query($link,"update cargo set salario=".$salario." where cargo_id=".$id[0].";");
			}
			$respuesta="Cargo modificado con éxito";
		}else{	
			$respuesta="El cargo ".$name." no existe";
		}
		return $respuesta;
	}

	function info(){
		require("connect_DB.php");
		$nombreCargo=$_POST["nombreCargo"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from cargo where cargo_id=".$nombreCargo.";");
		$check=mysqli_fetch_array($query);
		$respuesta=$check['nombre']."-".$check['salario'];
		return $respuesta;
	}

	function eliminar(){
		require("connect_DB.php");
		$cargo=$_POST['cargo'];
		$respuesta="";
		$query=mysqli_query($link,"select * from empleado where cargo_id =".$cargo.";");
		$check = mysqli_fetch_array($query);
		if($check['cargo_id'] != $cargo){
			mysqli_query($link,"delete from cargo where cargo_id=".$cargo.";");
			$respuesta="El cargo se ha eliminado correctamente";
		} else {
			$respuesta="El cargo es utilizado por un empleado y no se puede eliminar";
		}
		return $respuesta;
	}



	echo $mensaje;