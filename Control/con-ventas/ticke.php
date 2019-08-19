<?php
require("../../Control/conexion.php"); 
	session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    $consul="SELECT Id_sucu,Id_persona,Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $Idsu=$row['Id_sucu'];
     $Id_pe=$row['Id_persona'];
    }

  }
 ?>

 <?php ob_start();
$venta=$_GET['venta'];
// $cam=$_GET['cam'];
$pagar=$_GET['pagar'];
$p=$_GET['p'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  
	<title>Ticke</title>
  <style type="text/css">
   header{
    font-size: 12px;
    font-family: arial;
    }
    section{
      font-size: 12px;
      font-family: arial;
    }
    footer{
      font-size: 12px;
      font-family: arial;

    }
    .tabla{
      text-align: center;
      font-size: 10px;
    }
  </style>
  
</head>
<body>
<header>

 <span><strong>Servicios y Llantas el Pacífico, S.A.</strong></span><br>
  <?php 
  require("../../Control/conexion.php"); 
  $datos_sucu="SELECT *FROM sucursal WHERE Id_sucu=?";
  $pre_sucu=$con->prepare($datos_sucu);
  $pre_sucu->execute(array($Idsu));
  while ($datos=$pre_sucu->fetch(PDO::FETCH_ASSOC)) {
    echo "Sucursal: $datos[Ciudad]"."<br>";
    echo "Dirección: ".$datos['Colonia'].", ".$datos['Calle']."<br>";
    echo "Correo: ".$datos['Correo']."<br>";
    echo "Teléfono: ".$datos['Tel']."<br>";
    echo "RFC: ".$datos['RfC']."<br>";
    echo "CP: ".$datos['CP']."<br>";
    
  }
 ?>
</header>
<hr>
<section>
<article>
<strong>Detalle de compra</strong>
<table class="tabla">
<tr>
  <th>Cantidad</th>
  <th></th>
  <th>Producto</th>
  <th></th>
  <th>Precio Neto</th>
  <th></th>
  <th>Total</th>
  
</tr>
<?php
$su=0;
$iva=0.16;
$suma=0;
require("../../Control/conexion.php"); 
$datos_compra="SELECT v.Numero_venta_no,v.Fecha,v.Cantidad,p.Nombre AS Pro,p.Precio_ven,v.Total,s.Ciudad,pe.Nombre FROM ventas_normal v JOIN productos p  ON p.Id_pro=v.Id_pro_nor
JOIN sucursal s ON s.Id_sucu=v.Id_sucu_no
JOIN personal pe ON pe.Id_persona=v.Id_perso_no WHERE Numero_venta_no=? AND Id_sucu=?";
$pre_datos=$con->prepare($datos_compra);
$pre_datos->execute(array($venta,$Idsu));
while ($row=$pre_datos->fetch(PDO::FETCH_ASSOC)) {
  $num_venta=$row['Numero_venta_no'];
  $trabajador=$row['Nombre'];
  echo "
  <tr>
  <td>$row[Cantidad]</td>
  <td></td>
  <td>$row[Pro]</td>
  <td></td>
  <td>$row[Precio_ven]</td>
  <td></td>
  <td>$".number_format($row['Total'])."</td>
  
</tr>
  ";
  $suma+=$row['Total'];
  $i=$suma*$iva;
  $su=$suma+$i;
}

$cam=$pagar-$su;
 ?>
 </table>
 <br>
 <strong>Íva: 16%</strong><br>
 <strong >Total Íva: <?php echo "$".number_format($su); ?></strong><br>
  <strong >Paga <?php echo $p.": $".number_format($pagar);?></strong><br>
  <strong >Cambio: <?php echo "$".number_format($cam); ?></strong>
</article>
</section>

<hr>
<footer>
<strong>Número de venta</strong>  <?php echo $num_venta; ?><br>
  <strong>Fecha de compra</strong>   <?php echo date("d-m-Y"); ?><br>
   <strong>Atendio</strong>   <?php  echo $trabajador;?><br><br>
  <strong>¡Importate!</strong><br>
Conserve el ticket  por causas de garantía.  

</footer>
</body>
</html>



<?php
use Dompdf\Dompdf;
// require_once('dompdf/autoload.inc.php');
require_once('../../Control/dompdf/autoload.inc.php');
$dompdf=new DOMPDF();
$paper_size = array(0,0,280,400);
$dompdf->set_paper($paper_size);
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$filename=$nombre.' '.$p.' '.$m.'.pdf';
$dompdf->stream($filename,array("Attachment"=>0));
 ?>
