<?php 

if ($_POST) {
	require("../conexion.php");

	 session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
    $consul="SELECT Id_sucu,Id_persona FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
    }
  }
    
	$id=rand(1,1000000);
	$movi=filter_var($_POST['movi'],FILTER_SANITIZE_STRING);

	$clave_pro=filter_var($_POST['clave_pro'],FILTER_SANITIZE_STRING);
	$nombre=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
	$tamaño=filter_var($_POST['tamaño'],FILTER_SANITIZE_STRING);
	$modelo=filter_var($_POST['modelo'],FILTER_SANITIZE_STRING);
	$descrip=filter_var($_POST['descrip'],FILTER_SANITIZE_STRING);
	$stock=filter_var($_POST['stock'],FILTER_SANITIZE_STRING);
	$precio_compra=filter_var($_POST['precio_compra'],FILTER_SANITIZE_STRING);
	$precio_venta=filter_var($_POST['precio_venta'],FILTER_SANITIZE_STRING);
	$fecha_entra=filter_var($_POST['fecha_entra'],FILTER_SANITIZE_STRING);
	$fecha_ca=filter_var($_POST['fecha_ca'],FILTER_SANITIZE_STRING);
	$estado=filter_var($_POST['estado'],FILTER_SANITIZE_STRING);
	$id_pro=filter_var($_POST['id_pro'],FILTER_SANITIZE_STRING);

	
	$inser="CALL ins_productos(?,?,?,?,?,?,?,?,?,?,?,?,?)";
	$in=$con->prepare($inser);
	if ($in->execute(array($id,$clave_pro,$nombre,$tamaño,$modelo,$descrip,$stock,$precio_compra,$precio_venta,$fecha_entra,$fecha_ca,$estado,$id_pro))) {
		$usua=$_SESSION['usuario'];
		$sele="SELECT  *FROM personal WHERE Id_persona=?";
		$res=$con->prepare($sele);
		$res->execute(array($usua));
		while ($row=$res->fetch(PDO::FETCH_ASSOC)) {
	 	$clave_sucu=$row['Id_sucu_1']; 
	}

	$ins_sucu_produ="INSERT INTO sucu_pro(Id_sucu_3,Id_pro_1) VALUES (?,?)";
	$preparar=$con->prepare($ins_sucu_produ);
	if ($preparar->execute(array($clave_sucu,$id))) {
		// Actualizar el estado
		$actEstado="UPDATE movimientos SET Estado_mo='Concretado' WHERE Id_movimiento=?";
		$pre_act=$con->prepare($actEstado);
		if ($pre_act->execute(array($movi))) {
			header("location:../../Vista/Almacen/llegada.php?exito=exito");
		}else {
			echo "
			<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
        	<script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 			<script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
			$(document).ready(function(){		
			sweetAlert('Error', 'No se actualizó el estado', 'error');
			});
			</script>";
		}
				

	}else{
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'Revise que la clave del producto no se este repitiendo o que tenga conexión a internet', 'error');
				});
			</script>

		  ";
	}
		
	}else {
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'Revise que la clave del producto no se este repitiendo o que tenga conexión a internet', 'error');
				});
			</script>

		  ";
	}
}


 ?>

