<?php
	$opcion=$_POST["opcion"];
	$mensaje="";

	switch ($opcion) {
		case 'crear':
			$mensaje= crear();
			break;
		case 'crearDetalle':
			$mensaje= crearDetalle();
			break;
		case 'editar':
			$mensaje= editar();
			break;
		case 'listar':
			$mensaje= lista();
			break;
		case 'eliminar':
			$mensaje= eliminar();
			break;
		case 'ver':
			$mensaje= ver();
			break;
	}
	

	function crear(){
		require("connect_DB.php");

		/*$empleado_id=$_POST["empleado"];
		$cliente_id=$_POST["cliente"];
		$nit=$_POST["nitE"];
		$fecha_factura=$_POST["fecha"];
		$fecha_vencimiento=$_POST["fechavenc"];
		$saldo=$_POST["sal"];
		$subtotal=$_POST["subt"];
		$total=$_POST["t"];*/

		$empleado_id= '1';
		$cliente_id='2';
		$nit=null;
		$fecha_factura='2019-03-24';
		$fecha_vencimiento='2019-04-22';
		$saldo='230000';
		$subtotal='2400000';
		$total='30000000';

		$respuesta = "";
		mysqli_query($link,"INSERT INTO factura (cliente_id,  nit, empleado_id, fecha_factura, fecha_vencimiento, saldo, subtotal, total) VALUES ('".$cliente_id."','".$nit."','".$empleado_id."','".$fecha_factura."','".$fecha_vencimiento."','".$saldo."','".$subtotal."','".$total."');");
		mysqli_query($link,"INSERT into factura (cliente_id, nit, empleado_id, fecha_factura, fecha_vencimiento, saldo, subtotal, total) values ('2', null, '1', '2019-03-19', '2019-04-19', '120000','120000','122280');");
		$respuesta = $nit;
		
		return $respuesta;
	}

	function crearDetalle(){
		require("connect_DB.php");
		$query = mysqli_query($link,"SELECT max(factura_id) AS factura_id FROM factura;");
		$factura_id=mysqli_fetch_array($query);
		$producto_id=$_POST["producto"];
		$cantidad=$_POST["cantidad"];
		$costo=$_POST["costo"];

		$respuesta = "";
		mysqli_query($link,"INSERT INTO detalle_factura (factura_id,producto_id,cantidad,costo) VALUES('".$factura_id['factura_id']."','".$producto_id."','".$cantidad."','".$costo."');");

		$respuesta = " ";

		
		return $respuesta;
	}

	function editar(){
		require("connect_DB.php");
		$factura_id=$_POST["factura_id"];
		$newCliente=$_POST["newCliente"];
		$newNit=$_POST["newNit"];
		$newEmpleado_id=$_POST["newEmpleado_id"];
		$newFecha_factura=$_POST["newFecha_factura"];
		$newFecha_vencimiento=$_POST["newFecha_vencimiento"];
		$newSaldo=$_POST["newSaldo"];
		$newSubtotal=$_POST["newSubtotal"];
		$newTotal=$_POST["newTotal"];
		
		$respuesta="";

		$query=mysqli_query($link,"SELECT factura_id from factura where nombre='".$factura_id."';");
		$check_categoria=mysqli_fetch_array($query);
		if($check_categoria['factura_id']== $factura_id){
			mysqli_query($link,"update factura set cliente_id='".$newCliente."' where factura_id='".$factura_id."';");
			mysqli_query($link,"update factura set nit='".$newNit."' where factura_id='".$factura_id."';");
			mysqli_query($link,"update factura set empleado_id='".$newEmpleado_id."' where factura_id='".$factura_id."';");
			mysqli_query($link,"update factura set fecha_factura='".$newFecha_factura."' where factura_id='".$factura_id."';");
			mysqli_query($link,"update factura set fecha_vencimiento='".$newFecha_vencimiento."' where factura_id='".$factura_id."';");
			mysqli_query($link,"update factura set saldo='".$newSaldo."' where factura_id='".$factura_id."';");
			mysqli_query($link,"update factura set subtotal='".$newSubtotal."' where factura_id='".$factura_id."';");
			mysqli_query($link,"update factura set total='".$newTotal."' where factura_id='".$factura_id."';");
			$respuesta="Factura modificada con éxito";
		}else{	
			$respuesta="La Factura ".$factura_id." no existe";
		}

		return $respuesta;
	}

	function lista(){
		$respuesta="";

		return $respuesta;
	}

	function eliminar(){

		require("connect_DB.php");
		$respuesta="";
		$factura_id=$_POST["factura"];
		mysqli_query($link,"DELETE FROM  detalle_factura WHERE factura_id='".$factura_id."';");
		mysqli_query($link,"DELETE FROM  factura WHERE factura_id='".$factura_id."';");
		$respuesta="Eliminado";

		return $respuesta;
	}

	function ver(){
		$respuesta="";

		return $respuesta;
	}

	echo($mensaje);
