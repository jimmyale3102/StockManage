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
		case 'eliminar':
			$mensaje= eliminar();
			break;
		case 'ver':
			$mensaje= ver();
			break;
	}
	echo $mensaje;

	function crear(){
		require("connect_DB.php");
		$name=$_POST["name"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT nombre from categoria where nombre='".$name."';");
		$check_categoria=mysqli_fetch_array($query);
		if($check_categoria['nombre']!= $name){
			mysqli_query($link,"insert into categoria (nombre) values('".$name."');");
			$respuesta="Categoría creada con éxito";
		}else{	
			$respuesta="La categoría ya exite";
		}
		return $respuesta;
	}

	function editar(){
		require("connect_DB.php");
		$name=$_POST["name"];
		$newName=$_POST["newName"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT nombre from categoria where nombre='".$name."';");
		$check_categoria=mysqli_fetch_array($query);
		if($check_categoria['nombre']== $name){
			mysqli_query($link,"update categoria set nombre='".$newName."' where nombre='".$name."';");
			$respuesta="Categoría modificada con éxito";
		}else{	
			$respuesta="La categoria ".$name." no existe";
		}
		return $respuesta;
	}

	function eliminar(){
		require("connect_DB.php");
		$idCat=$_POST["idCat"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from categoria where tipo_id='".$idCat."';");
		$check_categoria=mysqli_fetch_array($query);
		if($check_categoria['tipo_id']== $idCat){
			mysqli_query($link,"delete from categoria where tipo_id=".$idCat.";");
			$respuesta="Categoría ".$check_categoria['nombre']." eliminada con éxito";
		}else{	
			$respuesta="La categoria con id ".$idCat." no existe";
		}
		return $respuesta;
	}