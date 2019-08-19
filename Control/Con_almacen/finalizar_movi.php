<?php 
// include ("../../Vista/Almacen/enmovimiento.php");

//Inicio de sesión.
session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
    $consul="SELECT Id_sucu,Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $nom=$row['Nombre'];
     $sucu=$row['Ciudad'];
     $IdSu=$row['Id_sucu'];
    }
  }

//Ejecutar la emtrega de movimiento.
$a=!empty($_REQUEST['a'])?$_REQUEST['a']:'';//biene cifrado
$e=!empty($_REQUEST['e'])?$_REQUEST['e']:'';//biene cifrado
if ($a) {
	require "../conexion.php";
	$sele_movi="SELECT Id_movimiento,Id_personal,Nombre,desde,destino,Cantidad,Fecha,Nota,Estado_mo FROM productos JOIN movi_pro ON movi_pro.Id_prod_2=productos.Id_pro JOIN movimientos
 		 on movimientos.Id_movimiento=movi_pro.Id_movi_1 WHERE Id_personal=$_SESSION[usuario]";
	$pre_sel_movi=$con->prepare($sele_movi);
	$pre_sel_movi->execute();
	while ($row=$pre_sel_movi->fetch(PDO::FETCH_ASSOC)) {
		$idMovi=$row['Id_movimiento'];
		if (password_verify($row['Id_movimiento'],$a)) {
			$act_estado="UPDATE movimientos SET Estado_mo='Entregado' WHERE Id_movimiento=?";
		 	$pre_atulizacion=$con->prepare($act_estado);
		 	if ($pre_atulizacion->execute(array($idMovi))) {
		 		header("location:../../Vista/Almacen/enmovimiento.php");
		 	}else {
		 		echo "algo fallo";
		 	}
		}
	}

}elseif ($e) {
	require "../conexion.php";
	$sele_m="SELECT Id_movimiento,Codigo_pro,Id_personal,Nombre,desde,destino,Cantidad,Fecha,Nota,Estado_mo FROM productos JOIN movi_pro ON movi_pro.Id_prod_2=productos.Id_pro JOIN movimientos
 		 on movimientos.Id_movimiento=movi_pro.Id_movi_1 WHERE Id_personal=$_SESSION[usuario]";
 		 $pre=$con->prepare($sele_m);
 		 $pre->execute();
 		 while ($r=$pre->fetch(PDO::FETCH_ASSOC)) {
 		 	$IdMovi=$r['Id_movimiento'];
 		 	$IdPro=$r['Codigo_pro'];
 		 	$Cantidad=$r['Cantidad'];

 		 	if (password_verify($r['Id_movimiento'],$e)) {
 		 		$eliminaMovi="DELETE From movimientos WHERE Id_movimiento=?";
 		 		$preEliminar=$con->prepare($eliminaMovi);
 		 		if ($preEliminar->execute(array($IdMovi))) {
 		 			$regresoPro="UPDATE productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro
				 JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3
				 set Stock=Stock+? WHERE Id_sucu=? AND Codigo_pro=?";
 		 			$preRegreso=$con->prepare($regresoPro);
 		 			if ($preRegreso->execute(array($Cantidad,$IdSu,$IdPro))) {
 		 				header("location:../../Vista/Almacen/enmovimiento.php");
 		 			}else {
 		 				echo "error de actualizacion";
 		 			}
 		 		}else {
 		 			echo "error de eliminacion";
 		 		}
 		 		

 		 	}
 		 }

	}


 ?>