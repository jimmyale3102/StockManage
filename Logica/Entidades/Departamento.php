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
		case 'listar':
			$mensaje= lista();
			break;
		case 'ver':
			$mensaje= ver();
			break;
	}
	

	function crear(){
		require("connect_DB.php");
		$name=$_POST["name"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT nombre_departamento from departamento where nombre_departamento='".$name."';");
		$check_departamento=mysqli_fetch_array($query);
		if($check_departamento['nombre_departamento']!= $name){
			mysqli_query($link,"insert into producto (nombre_departamento) values('".$name."');");
			$respuesta="Departamento creado con éxito";
		}else{	
			$respuesta="El departamento ya exite";
		}
		return $respuesta;
	}

	function editar(){
		require("connect_DB.php");
		$name=$_POST["name"];
		$newName=$_POST["newName"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT nombre_departamento from departamento where nombre='".$name."';");
		$check_categoria=mysqli_fetch_array($query);
		if($check_departamento['nombre_departamento']== $name){
			mysqli_query($link,"update producto set nombre_departamento='".$newName."' where nombre='".$name."';");
			$respuesta="Departamento modificado con éxito";
		}else{	
			$respuesta="El Deparatmento ".$name." no existe";
		}
		return $respuesta;
	}

	function lista(){
		$respuesta="";

		return $respuesta;
	}

	function ver(){
		$respuesta="";

		return $respuesta;
	}



	echo $mensaje;