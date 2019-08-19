<?php 
require '../../Vista/Almacen/inventario.php';
$codi=!empty($_REQUEST['codi'])?$_REQUEST['codi']:'';
if ($_POST) {
	require("../conexion.php");
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
    $consul="SELECT Id_sucu,Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $Idsu=$row['Id_sucu'];
    }
  }

	$clave_pro=filter_var($_POST['clave_pro'],FILTER_SANITIZE_STRING);
	$nombre=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
	$tamaño=filter_var($_POST['tamaño'],FILTER_SANITIZE_STRING);
	$modelo=filter_var($_POST['modelo'],FILTER_SANITIZE_STRING);
	$descrip=filter_var($_POST['descrip'],FILTER_SANITIZE_STRING);
	$stock=filter_var($_POST['stock'],FILTER_SANITIZE_STRING);
	$precio_venta=filter_var($_POST['precio_venta'],FILTER_SANITIZE_STRING);
	$fecha_entra=filter_var($_POST['fecha_entra'],FILTER_SANITIZE_STRING);
	$fecha_ca=filter_var($_POST['fecha_ca'],FILTER_SANITIZE_STRING);
	$estado=filter_var($_POST['estado'],FILTER_SANITIZE_STRING);
	// $id_pro=filter_var($_POST['id_pro'],FILTER_SANITIZE_STRING);

	$actaulizar_pro="UPDATE productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro 
                 JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 set 
                 Nombre=?,
                 Tama=?,
                 Modelo=?,
                 Descripcion=?,
                 Stock=?,
                 Precio_ven=?,
                 fecha_entrada=?,
                 Fecha_caducidad=?,
                 Estado=?
                 WHERE Id_sucu=? AND Codigo_pro=?";
    $pre_act=$con->prepare($actaulizar_pro);
    if ($pre_act->execute(array($nombre,$tamaño,$modelo,$descrip,$stock,$precio_venta,$fecha_entra,$fecha_ca,$estado,$Idsu,$clave_pro))) {
    	echo "
        <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
         <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
            <script type='text/javascript'>
                $(document).ready(function(){       
                swal({
                  title: 'Actualización exitosa!',
                  text: 'La actualizacion se realizó con exito, los cambios se veran en 5 segundos.',
                  timer: 5000,
                  showConfirmButton: false
                });
                });
            </script>
            <meta http-equiv='Refresh' content='5;url=http://localhost:8080/Llantera Pacifico/Vista/Almacen/inventario.php'>
          ";
     
    	
    }else {
    	echo "paso algo";
    }
}else if ($codi) {
        require("../../Control/conexion.php");
        $eliminar="DELETE FROM productos WHERE Id_pro=?";
        $pre_eliminar=$con->prepare($eliminar);
        if ($pre_eliminar->execute(array($codi))) {
            echo "
        <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
         <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
            <script type='text/javascript'>
                $(document).ready(function(){       
                swal({
                  title: 'Eliminación exitosa!',
                  text: 'Se elimino el producto exitosamente, los cambios se veran en 5 segundos.',
                  timer: 5000,
                  showConfirmButton: false
                });
                });
            </script>
            <meta http-equiv='Refresh' content='5;url=http://localhost:8080/Llantera Pacifico/Vista/Almacen/inventario.php'>
          ";
         }else {
             echo "no se elimino";
         } 

}else {
   
}



 ?>