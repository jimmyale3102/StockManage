<?php
	$opcion=$_POST["opcion"];
	$mensaje="";

	switch ($opcion) {
		case 'crear':
			echo crear();
			break;
		case 'crearDetalle':
			$mensaje= crearDetalle();
			break;
		case 'editar':
			$mensaje= editar();
			break;
		case 'editarDetalle':
			$mensaje= editarDetalle();
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
		case 'buscarProductos':
			$mensaje= buscarProductos();
			break;
	}
	echo $mensaje;
	

	function crear(){
		require("connect_DB.php");
		$empleado_id=$_POST["empleado"];
		$cliente_id=$_POST["cliente"];
		$nit=$_POST["nitE"];
		$fecha_factura=$_POST["fecha"];
		$fecha_vencimiento=$_POST["fechavenc"];
		$saldo=$_POST["sal"];
		$subtotal=$_POST["subt"];
		$total=$_POST["t"];

		$respuesta="";
		if($nit != null){
		mysqli_query($link,"INSERT into factura (cliente_id, empleado_id, fecha_factura, fecha_vencimiento, saldo, subtotal, total) values ('".$cliente_id."','".$empleado_id."','".$fecha_factura."','".$fecha_vencimiento."','".$saldo."','".$subtotal."','".$total."');");
		}else{
			mysqli_query($link,"INSERT into factura (cliente_id, nit, fecha_factura, fecha_vencimiento, saldo, subtotal, total) values ('".$cliente_id."','".$nit."','".$fecha_factura."','".$fecha_vencimiento."','".$saldo."','".$subtotal."','".$total."');");
		}
		$respuesta="Factura creada con éxito";
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
		$newCliente=$_POST['newClient'];
		$newNit=$_POST['newNit'];
		$newEmpleado_id=$_POST['newEmpleado_id'];
		$newSaldo=$_POST['newSaldo'];
		$newSubtotal=$_POST['newSubtotal'];
		$newTotal=$_POST['newTotal'];
		
		$respuesta="";

		$query=mysqli_query($link,"SELECT factura_id from factura where factura_id='".$factura_id."';");
		$check_categoria=mysqli_fetch_array($query);
		if($check_categoria['factura_id']== $factura_id){
			if($newNit != null){

				mysqli_query($link,"UPDATE factura set cliente_id='".$newCliente."' where factura_id='".$factura_id."';");
			}else{
				mysqli_query($link,"UPDATE factura set nit='".$newNit."' where factura_id='".$factura_id."';");
			}
			mysqli_query($link,"UPDATE factura set empleado_id='".$newEmpleado_id."' where factura_id='".$factura_id."';");
			mysqli_query($link,"UPDATE factura set saldo='".$newSaldo."' where factura_id='".$factura_id."';");
			mysqli_query($link,"UPDATE factura set subtotal='".$newSubtotal."' where factura_id='".$factura_id."';");
			mysqli_query($link,"UPDATE factura set total='".$newTotal."' where factura_id='".$factura_id."';");
			$respuesta="Factura modificada con éxito";
		}else{	
			$respuesta="La Factura ".$factura_id." no existe";
		}

		return $respuesta;
	}
	function editarDetalle(){
		require("connect_DB.php");
		$factura_id=$_POST["factura"];
		$producto_id=$_POST["producto_id"];
		$cantidad=$_POST["cantidad"];
		$costo=$_POST["costo"];

		$respuesta = "";

		mysqli_query($link,"DELETE from detalle_factura where factura_id='".$factura_id."';");
		
		mysqli_query($link,"INSERT INTO detalle_factura (factura_id,producto_id,cantidad,costo) VALUES('".$factura_id."','".$producto_id."','".$cantidad."','".$costo."');");

		$respuesta="Detalle_factura modificada con éxito";

		
		return $respuesta;

	}

	function eliminar(){
		
		require("connect_DB.php");
		$respuesta="";
		$factura_id=$_POST["factura"];
		mysqli_query($link,"DELETE FROM  detalle_factura WHERE factura_id='".$factura_id."';");
		mysqli_query($link,"DELETE FROM  factura WHERE factura_id='".$factura_id."';");
		$respuesta="Factura eliminada correctamente";

		return $respuesta;
	}
	
	function buscar(){
		require("connect_DB.php");
		$factuId=$_POST["factura"];
		$respuesta="";
		$query= mysqli_query($link, "SELECT * from factura where factura_id='".$factuId."';");
		$check_producto=mysqli_fetch_array($query);

		$nit=$check_producto['nit'];
		$cliente=$check_producto['cliente_id'];
		$namecliente="";
		$nameProveedor="";
		$nameEmpleado="";

		if(is_null($nit)){
			$queryCliente=mysqli_query($link, "SELECT CONCAT(nombre,' ',apellido) AS nombre from cliente where cliente_id='".$check_producto['cliente_id']."';");
			$check_cliente=mysqli_fetch_array($queryCliente);
			$namecliente=$check_cliente['nombre'];

		}else{
			$queryProvedor=mysqli_query($link, "SELECT nombre from proveedor where nit='".$check_producto['nit']."';");
			$check_proveedor=mysqli_fetch_array($queryProveedor);
			$nameProveedor=$check_proveedor['nombre'];
		}

		$queryEmpleado=mysqli_query($link, "SELECT CONCAT(nombre,' ',apellido) AS nombre from empleado where empleado_id='".$check_producto['empleado_id']."';");
		$check_empleado=mysqli_fetch_array($queryEmpleado);
			$nameEmpleado=$check_empleado['nombre'];

		$respuesta=$check_producto['cliente_id']."--".$namecliente.",".$check_producto['nit']."--".$nameProveedor.",".$check_producto['empleado_id']."--".$nameEmpleado.",".$check_producto['fecha_factura'].",".$check_producto['fecha_vencimiento'].",".$check_producto['saldo'].",".$check_producto['subtotal'].",".$check_producto['total'];	

		return $respuesta;
	}

	function buscarProductos(){

		require("connect_DB.php");
		$factura_id=$_POST["factura_id"];
		$respuesta ="";
		
		$query = mysqli_query($link, "SELECT producto_id, cantidad, costo FROM detalle_factura where factura_id='".$factura_id."';");
		$row_cnt = mysqli_num_rows($query);

		$i=0;
		while ($i<$row_cnt){

			$fila = mysqli_fetch_array($query);
			$nameProducto = mysqli_query($link, "SELECT nombre FROM producto where producto_id='".$fila['producto_id']."';");
			$check_producto = mysqli_fetch_array($nameProducto);

			$queryValU = mysqli_query($link, "SELECT valor_unidad FROM producto where producto_id='".$fila['producto_id']."';");
			$valorUnitario = mysqli_fetch_array($queryValU);

			$respuesta = $respuesta.$fila['producto_id']."-".$check_producto['nombre']."-".$fila['cantidad']."-".$valorUnitario['valor_unidad']."-".$fila['costo']."--";

			$i++;

		}
			
		
		return $respuesta;

	}