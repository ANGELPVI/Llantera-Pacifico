<?php 
include("../../Vista/Almacen/ingresar-produtos.php");


if ($_POST) {
	require("../conexion.php");
	// Seleccionar sucursal
	 $consul="SELECT Id_sucu_1 FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
    	$IdSucu=$row['Id_sucu_1'];
    }

	$clave_pro=filter_var($_POST['clave_pro'],FILTER_SANITIZE_STRING);
	// Selecionar productos
   $sele="SELECT Codigo_pro FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p WHERE Id_sucu=? AND Codigo_pro=? ";
   $pre_s=$con->prepare($sele);
   $pre_s->execute(array($IdSucu,$clave_pro));
	
	if ($pre_s->rowCount()!=0) {
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'El código de producto que esta ingresando ya exite en su almacén', 'error');
				});
			</script>

		  ";
	}else {
	$id=rand(1,1000000);
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

	$inser="INSERT INTO productos(Id_pro,Codigo_pro,Nombre,Tama,Modelo,Descripcion,Stock,Precio_com,Precio_ven,fecha_entrada,Fecha_caducidad,Estado,id_prove_p) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
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
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Exito', 'El producto se guardo correctamente', 'success');
				});
			</script>

		  ";

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
		
}


 ?>



