<?php 

if ($_POST) {
	require('../../Control/conexion.php');
	$su=0;
	$iva=0.16;
	$suma=0;
	$cantidad=1;
	session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    $consul="SELECT Id_sucu,Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $Idsu=$row['Id_sucu'];
    }

  }

  $descu=filter_var(!empty($_REQUEST['descu'])?$_REQUEST['descu']:'',FILTER_SANITIZE_STRING);
  $_SESSION["porcentaje"]=$descu;
  $producto=filter_var(!empty($_REQUEST['codigo'])?$_REQUEST['codigo']:'',FILTER_SANITIZE_STRING);

	 $bus="SELECT Id_pro,Codigo_pro,Nombre,Tama,Modelo,Descripcion,Stock,Precio_com,precio_ven,fecha_entrada,Fecha_caducidad,Estado,Nombre_empresa 			FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p WHERE Id_sucu=? AND Codigo_pro=?";
			$pre_bus=$con->prepare($bus);
			$pre_bus->execute(array($Idsu,$producto));

				if ($pre_bus->rowCount()===1) {
				// Sacar el producto a vender
				while ($row=$pre_bus->fetch(PDO::FETCH_ASSOC)) {
					$IdPro=$row['Id_pro'];
					 $co=$row['Codigo_pro'];
					 $nombre=$row['Nombre'];
					 $costo=$row['precio_ven'];
					 $stock=$row['Stock'];
				}
				// verificar la cantidad de stock
				if ($stock>$cantidad && $stock!=0) {
					//aumentar la cantidad si el producto se esta repitiendo
					$sele_pro="SELECT *FROM venta_morelia WHERE Codi_pro_ve=? AND Id_sucu_veta=?";
					$pre_sel=$con->prepare($sele_pro);
					$pre_sel->execute(array($producto,$Idsu));
					while ($re=$pre_sel->fetch(PDO::FETCH_ASSOC)) {
						$c=$re['Codi_pro_ve'];
						
					}
					//Actualizar datos de compra
					$c=!empty($c)?$c:'';
					if ($producto==$c) {
						$actu_can="UPDATE venta_morelia SET Cantidad=Cantidad+?, Costo=Costo+? WHERE Codi_pro_ve=? AND Id_sucu_veta=?";
						$pre_act=$con->prepare($actu_can);
						if ($pre_act->execute(array($cantidad,$costo,$producto,$Idsu))) {
						//Mostrar productos comprados
						$mostrar="SELECT *FROM venta_morelia WHERE Id_sucu_veta=?";
						$pre_most=$con->prepare($mostrar);
						$pre_most->execute(array($Idsu));
						echo "   
						<table class='table table-conde'>
						<tr>
						<th>Cantidad</th>
						<th>Producto</th>
						<th>Precio</th>
						<th></th>
						</tr>

						 ";

						while ($r=$pre_most->fetch(PDO::FETCH_ASSOC)) {
							$eliminar=$r['Id_pro_vet'];
							echo "
							<tr>
							<td>$r[Cantidad]</td>
							<td>$r[Nombre_ve_pro]</td>
							<td>$r[Costo]</td>
							<td><a href='../../Control/con-ventas/cancelar_compra.php?codigo_pro=$eliminar'><button class='btn btn-danger'><span class='icon-minus'></span></button></td>
							</tr>

							  ";
								$suma+=$r['Costo'];
					            $i=$suma*$iva;
					            $su=$suma+$i;
						}
						echo "</table>";
						echo "<strong> Total"." ".number_format($su,2)."</strong>";

							
						}else{
							echo "no se actualizo";
						}
						
					}else{
					//insertar en la tabla temporal de venta
					$to=$cantidad*$costo;
					$inse="INSERT INTO venta_morelia(Id_pro_vet,Codi_pro_ve,Cantidad,Nombre_ve_pro,Costo,Id_sucu_veta)VALUES(?,?,?,?,?,?)";
					$pre_inser=$con->prepare($inse);

					if ($pre_inser->execute(array($IdPro,$co,$cantidad,$nombre,$to,$Idsu))) {

					//Mostrar productos comprados
					$mostrar="SELECT *FROM venta_morelia WHERE Id_sucu_veta=?";
					$pre_most=$con->prepare($mostrar);
					$pre_most->execute(array($Idsu));
					echo "   
					<table class='table table-conde'>
					<tr>
					<th>Cantidad</th>
					<th>Producto</th>
					<th>Precio</th>
					<th></th>
					</tr>

					 ";

					while ($r=$pre_most->fetch(PDO::FETCH_ASSOC)) {
						$eliminar=$r['Id_pro_vet'];
						echo "
						<tr>
						<td>$r[Cantidad]</td>
						<td>$r[Nombre_ve_pro]</td>
						<td>$r[Costo]</td>
						<td><a href='../../Control/con-ventas/cancelar_compra.php?codigo_pro=$eliminar'><button class='btn btn-danger'><span class='icon-minus'></span></button></td>
						</tr>

						  ";
						  $suma+=$r['Costo'];
					      $i=$suma*$iva;
					      $su=$suma+$i;

					}
					echo "</table>";
					echo "<strong> Total"." ".number_format($su,2)."</strong>";

				}else{
					echo "no insertado";
				}

					}

				}else{
					//Aviso de poco stock
				$mostrar="SELECT *FROM venta_morelia WHERE Id_sucu_veta=?";
					$pre_most=$con->prepare($mostrar);
					$pre_most->execute(array($Idsu));
					echo "   
					<table class='table table-conde'>
					<tr>
					<th>Cantidad</th>
					<th>Producto</th>
					<th>Precio</th>
					<th></th>
					</tr>

					 ";

					 while ($r=$pre_most->fetch(PDO::FETCH_ASSOC)) {
					 	$eliminar=$r['Id_pro_vet'];
						echo "
						<tr>
						<td>$r[Cantidad]</td>
						<td>$r[Nombre_ve_pro]</td>
						<td>$r[Costo]</td>
						<td><a href='../../Control/con-ventas/cancelar_compra.php?codigo_pro=$eliminar'><button class='btn btn-danger'><span class='icon-minus'></span></button></td>
						</tr>

						  ";
						  $suma+=$r['Costo'];
					      $i=$suma*$iva;
					      $su=$suma+$i;
					}
					echo "</table>";
					echo "<strong> Total"." ".number_format($su,2)."</strong>"."<br>";
					echo "<div class='alert alert-danger' role='alert'>No <strong>Cuenta con suficiente</strong> Stock</div>";
					
				}
				
			 }else{
			 	//cunado el producto no exite
				$mostrar="SELECT *FROM venta_morelia WHERE Id_sucu_veta=?";
					$pre_most=$con->prepare($mostrar);
					$pre_most->execute(array($Idsu));
					echo "   
					<table class='table table-conde'>
					<tr>
					<th>Cantidad</th>
					<th>Producto</th>
					<th>Precio</th>
					<th></th>
					</tr>

					 ";

					 while ($r=$pre_most->fetch(PDO::FETCH_ASSOC)) {
					 	$eliminar=$r['Codi_pro_ve'];
						echo "
						<tr>
						<td>$r[Cantidad]</td>
						<td>$r[Nombre_ve_pro]</td>
						<td>$r[Costo]</td>
						<td><a href='../../Control/con-ventas/cancelar_compra.php?codigo_pro=$eliminar'><button class='btn btn-danger'><span class='icon-minus'></span></button></td>
						</tr>

						  ";
						  $suma+=$r['Costo'];
					      $i=$suma*$iva;
					      $su=$suma+$i;
					}
					echo "</table>";
					echo "<strong> Total"." ".number_format($su,2)."</strong>"."<br>";
					// echo "<div class='alert alert-danger' role='alert'>No se <strong>encontro</strong> el producto</div>";
			 }

	
if ($descu) {
	$de=$descu/100*$su;
	$_SESSION["des"]=$su-$de;

	if ($_SESSION["des"]>=1 || $_SESSION["des"]==0) {
	echo "<strong>Total Descuento"." ".number_format($_SESSION["des"],2)."</strong>";
		
	}elseif ($_SESSION["des"]<0) {
		$_SESSION["des"]=0;
		echo "ingrese numeros validos";
	}
}

}
 ?>