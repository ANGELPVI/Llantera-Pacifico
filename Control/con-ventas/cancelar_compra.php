<?php
if ($_GET) {
  $restar_pro=1;
require("../../Control/conexion.php");
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

  $codigo_pro=filter_var($_GET['codigo_pro'],FILTER_SANITIZE_STRING);
  // Sacar el precio
   $sel_precio="SELECT *FROM productos WHERE Id_pro=?";
   $pre_precio=$con->prepare($sel_precio);
   $pre_precio->execute(array($codigo_pro));
   while ($r=$pre_precio->fetch(PDO::FETCH_ASSOC)) {
     $precio=$r['Precio_ven'];
   }


$eliminar="UPDATE venta_morelia SET Cantidad=Cantidad-?, Costo=Costo-? WHERE Id_pro_vet=? AND Id_sucu_veta=? ";
$pre_eliminar=$con->prepare($eliminar);
if ($pre_eliminar->execute(array($restar_pro,$precio,$codigo_pro,$Idsu))) {
    $eliminar="DELETE FROM venta_morelia WHERE Cantidad<=0";
    $pre_eliminar=$con->prepare($eliminar);
    $pre_eliminar->execute();
  header("location:../../Vista/Ventas/incio-ventas.php");
}else{
  echo "error";

}

}

 ?>
