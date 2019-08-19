<?php 
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
    $consul="SELECT Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $nom=$row['Nombre'];
     $sucu=$row['Ciudad'];
    }
  }
 
$agre=!empty($_REQUEST['agre'])?$_REQUEST['agre']:'';//encriptado
$cantidad=!empty($_REQUEST['cantidad'])?$_REQUEST['cantidad']:'';
$co=!empty($_REQUEST['co'])?$_REQUEST['co']:'';//encriptado
$sucur=!empty($_REQUEST['sucur'])?$_REQUEST['sucur']:'';

if ($agre&&$cantidad&&$co) {
	require("../conexion.php");
	$consul="SELECT Id_persona,Id_sucu_1 FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $id_sucursal=$row['Id_sucu_1'];
    }
    // Comprobar si el producto exite
    $verificar="SELECT Id_pro,Nombre,Stock,Ciudad,Id_sucu FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro 
			   JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 WHERE Id_sucu=? AND Codigo_pro=?";
	$sel=$con->prepare($verificar);
	$sel->execute(array($id_sucursal,$co));

   if ($sel->rowCount()===1) {
   	 // Agregar el producto hacia la sucursal que se envio
    $agregar_pro="UPDATE productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro
				 JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3
				 set Stock=Stock+? WHERE Id_sucu=? AND Codigo_pro=?";
	$PreAgregar=$con->prepare($agregar_pro);
	if ($PreAgregar->execute(array($cantidad,$id_sucursal,$co))) {
		// Actualizar estado de la tabla movimiento
		$act_movi="UPDATE movimientos SET Estado_mo='Concretado' WHERE Id_movimiento=?";
		$preAct=$con->prepare($act_movi);
		if ($preAct->execute(array($agre))) {
			header("location:../../Vista/Almacen/llegada.php?agregado=agregado");
		}

	}else{
		echo "algo salio mal actualizar el esto";
	}

   }else {
  // Activar modal.
   header("location:../../Vista/Almacen/llegada.php?no=$agre && codi=$co && s=$sucur && ca=$cantidad");
   
   }		

}




 ?>