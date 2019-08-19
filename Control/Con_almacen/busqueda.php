<?php  date_default_timezone_set('America/Monterrey');


if ($_POST) {
	require("../conexion.php");
	session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
    $consul="SELECT Id_sucu,Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $IdSucu=$row['Id_sucu'];
    }
  }
	$buscar=filter_var($_POST['buscar'], FILTER_SANITIZE_STRING);
	$hoy=date("Y-m-d");//para comparar las fechas
	$bus="SELECT Id_pro,Codigo_pro,Nombre,Tama,Modelo,Descripcion,Stock,Precio_com,precio_ven,fecha_entrada,Fecha_caducidad,Estado,Nombre_empresa 			FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p WHERE Id_sucu=? AND Codigo_pro LIKE '%$buscar%'";
	$pre_bus=$con->prepare($bus);

	if ($pre_bus->execute(array($IdSucu))) {
		echo "
		<table class='table '>
		<tr class='bg-primary'>
		<th>Código</th>
		<th>Producto</th>
		<th>Tamaño</th>
		<th>Modelo</th>
		<th>Descripción</th>
		<th>Stock</th>
		<th>Venta</th>
		<th>FechaAlta</th>
    	<th>Caducidad</th>
    	<th>Estado</th>
    	<th>Proveedor</th>
    	<th>Actualizar</th>
    	<th>Eliminar</th>
		</tr>


		
		";
		while ($row=$pre_bus->fetch(PDO::FETCH_ASSOC)) {			 
			if ($row['Stock']<=5) {
			echo "
		    <tr class='poco_pro'>
			<td>$row[Codigo_pro]</td>
			<td>$row[Nombre]</td>
			<td>$row[Tama]</td>
			<td>$row[Modelo]</td>
			<td>$row[Descripcion]</td>
			<td>$row[Stock]</td>
			<td>$row[precio_ven]</td>
			<td>$row[fecha_entrada]</td>
			<td>$row[Fecha_caducidad]</td>
			<td>$row[Estado]</td>
			<td>$row[Nombre_empresa]</td>
			<td><a href='../../Vista/Almacen/inventario.php?
			open=open
			&&c=$row[Codigo_pro]
			&&n=$row[Nombre]
			&&t=$row[Tama]
			&&m=$row[Modelo]
			&&d=$row[Descripcion]
			&&s=$row[Stock]
			&&v=$row[precio_ven]
			&&fe=$row[fecha_entrada]
			&&fc=$row[Fecha_caducidad]
			&&esta=$row[Estado]'>
			<button class='btn btn-success'><span class='icon-loop2'></span></button>
			</a></td>

			<td><a href='../../Vista/Almacen/inventario.php?eliminar=eliminar&&elico=$row[Id_pro]'>
			<button class='btn btn-danger'><span class='icon-bin'></span></button></a></td>
			</tr>";
		}else if($row['Fecha_caducidad']<=$hoy){
			echo "
		    <tr class='pro_cadu'>
			<td>$row[Codigo_pro]</td>
			<td>$row[Nombre]</td>
			<td>$row[Tama]</td>
			<td>$row[Modelo]</td>
			<td>$row[Descripcion]</td>
			<td>$row[Stock]</td>
			<td>$row[precio_ven]</td>
			<td>$row[fecha_entrada]</td>
			<td>$row[Fecha_caducidad]</td>
			<td>$row[Estado]</td>
			<td>$row[Nombre_empresa]</td>
			<td><a href='../../Vista/Almacen/inventario.php?
			open=open
			&&c=$row[Codigo_pro]
			&&n=$row[Nombre]
			&&t=$row[Tama]
			&&m=$row[Modelo]
			&&d=$row[Descripcion]
			&&s=$row[Stock]
			&&v=$row[precio_ven]
			&&fe=$row[fecha_entrada]
			&&fc=$row[Fecha_caducidad]
			&&esta=$row[Estado]'>
			<button class='btn btn-success'><span class='icon-loop2'></span></button>
			</a></td>

			<td><a href='../../Vista/Almacen/inventario.php?eliminar=eliminar&&elico=$row[Id_pro]'>
			<button class='btn btn-danger'><span class='icon-bin'></span></button></a></td>
			</tr>";
		}else {
				echo "
		    <tr>
			<td>$row[Codigo_pro]</td>
			<td>$row[Nombre]</td>
			<td>$row[Tama]</td>
			<td>$row[Modelo]</td>
			<td>$row[Descripcion]</td>
			<td>$row[Stock]</td>
			<td>$row[precio_ven]</td>
			<td>$row[fecha_entrada]</td>
			<td>$row[Fecha_caducidad]</td>
			<td>$row[Estado]</td>
			<td>$row[Nombre_empresa]</td>
			<td><a href='../../Vista/Almacen/inventario.php?
			open=open
			&&c=$row[Codigo_pro]
			&&n=$row[Nombre]
			&&t=$row[Tama]
			&&m=$row[Modelo]
			&&d=$row[Descripcion]
			&&s=$row[Stock]
			&&v=$row[precio_ven]
			&&fe=$row[fecha_entrada]
			&&fc=$row[Fecha_caducidad]
			&&esta=$row[Estado]'>
			<button class='btn btn-success'><span class='icon-loop2'></span></button>
			</a></td>

			<td><a href='../../Vista/Almacen/inventario.php?eliminar=eliminar&&elico=$row[Id_pro]'>
			<button class='btn btn-danger'><span class='icon-bin'></span></button></a></td>
			</tr>";
			
		}
		
	}

	echo "</table>";

	}else {
		echo "no se esta executando";
	}		
}
 ?>