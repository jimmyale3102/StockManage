<?php
	$opcion=$_POST["opcion"];
	$mensaje="";

	switch ($opcion) {
		case 'crear':
			echo crear();
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
		case 'buscar':
			$mensaje= buscar();
			break;
		case 'buscarCi':
			$mensaje= buscarCi();
			break;
		case 'buscarBa':
			$mensaje= buscarBa();
			break;
	}
	echo $mensaje;
	

	function crear(){
		require("connect_DB.php");
		$nit=$_POST["nit"];
		$nombre=$_POST["nombre"];
		$tel=$_POST["tel"];
		$desc=$_POST["desc"];
		$bar=$_POST["bar"];
		$dirc=$_POST["dir"];

		$agregarUb= mysqli_query($link,"SELECT direccion from ubicacion where direccion='".$dirc."';");
		$check_ubi=mysqli_fetch_array($agregarUb);
		if($check_ubi['direccion']!=$dirc){
			mysqli_query($link,"insert into ubicacion (barrio_id, direccion) values (".$bar.",'".$dirc."');");
		}


		$query=mysqli_query($link,"SELECT nit from proveedor where nit=".$nit.";");
		$check_categoria=mysqli_fetch_array($query);
		if($check_categoria['nit']!= $nit){
			$consulta=mysqli_query($link,"select ubicacion_id from ubicacion where direccion like '".$dirc."';");
			$ubicacion=mysqli_fetch_array($consulta);
			mysqli_query($link,"insert into proveedor values(".$nit.",".$ubicacion['ubicacion_id'].",'".$nombre."',".$tel.",'".$desc."');");
			$respuesta="Proveedor agregado con éxito";
		}else{	
			$respuesta="El proveedor ya exite";
		}
		return $respuesta;
	}

	function editar(){
		require("connect_DB.php");
		$nit=$_POST["nit"];
		$nombre=$_POST["nombre"];
		$tel=$_POST["tel"];
		$desc=$_POST["desc"];
		$bar=$_POST["bar"];
		$dirc=$_POST["dir"];

		mysqli_query($link,"update proveedor set nombre='".$nombre."' where nit=".$nit.";");
		mysqli_query($link,"update proveedor set descripcion='".$desc."' where nit=".$nit.";");
		mysqli_query($link,"update proveedor set telefono='".$tel."' where nit=".$nit.";");

		$query=mysqli_query($link, "SELECT ubicacion_id from ubicacion where direccion='".$dirc."';");
		$queryProvee= mysqli_query($link, "SELECT ubicacion_id from proveedor where nit=".$nit.";");
		$flag= mysqli_fetch_array($query);
		$comparacion= mysqli_fetch_array($queryProvee);

		if($flag['ubicacion_id']==$comparacion['ubicacion_id']){
			mysqli_query($link,"update proveedor set ubicacion_id='".$comparacion['ubicacion_id']."' where nit=".$nit.";");	
		}else{
			if(mysqli_num_rows($query)==0){
				mysqli_query($link,"insert into ubicacion (barrio_id, direccion) values (".$bar.",'".$dirc."');");
				$consulta=mysqli_query($link,"select ubicacion_id from ubicacion where direccion like '".$dirc."';");
				$ubicacion=mysqli_fetch_array($consulta);
				mysqli_query($link,"update proveedor set ubicacion_id='".$ubicacion['ubicacion_id']."' where nit=".$nit.";");	
			}
		}
		
		
		return $mensaje;
	}

	function eliminar(){
		require("connect_DB.php");
		$idPro=$_POST["idPro"];
		$respuesta="";
		$query=mysqli_query($link,"SELECT * from proveedor where nit='".$idPro."';");
		$check_producto=mysqli_fetch_array($query);
		if($check_producto['nit']== $idPro){
			mysqli_query($link,"delete from proveedor where nit=".$idPro.";");
			$respuesta="Producto ".$check_producto['nombre']." eliminado con éxito";
		}else{	
			$respuesta="El produto con id ".$idPro." no existe";
		}
		return $respuesta;
	}
	
	function buscar(){
		require("connect_DB.php");
		$selectInfo=$_POST["selectInfo"];
		$respuesta="";
		$query= mysqli_query($link, "SELECT * from producto where producto_id='".$selectInfo."';");
		$check_producto=mysqli_fetch_array($query);
		$respuesta=$check_producto['nombre'].",".$check_producto['descripcion'].",".$check_producto['valor_unidad'];	
		return $respuesta;
	}


	function buscarCi(){
		require("connect_DB.php");
		$selectInfo=$_POST["depa"];
		$respuesta="";
		$query= mysqli_query($link, "select ciudad_id, nombre_ciudad from ciudad natural join departamento where departamento_id=".$selectInfo.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['ciudad_id'].",".$row['nombre_ciudad'];
		}
		return ltrim($respuesta,",");
	}




	function buscarBa(){
		require("connect_DB.php");
		$selectInfo=$_POST["ciu"];
		$respuesta="";
		$query= mysqli_query($link, "select barrio_id, nombre_barrio from barrio natural join ciudad where ciudad_id=".$selectInfo.";");
		while($row= mysqli_fetch_array($query)){
			$respuesta=$respuesta.",".$row['barrio_id'].",".$row['nombre_barrio'];
		}
		return ltrim($respuesta,",");
	}