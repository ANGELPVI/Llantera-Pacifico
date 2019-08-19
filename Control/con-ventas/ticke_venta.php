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
    font-size: 10px;
    font-family: arial;
    }
    section{
      font-size: 10px;
      font-family: arial;
    }
    footer{
      font-size: 10px;
      font-family: arial;

    }
    .tabla{
      text-align: center;
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
    echo "Sucursal $datos[Ciudad]"."<br>";
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
  <th>Precio</th>
  
</tr>
<?php
$su=0;
$iva=0.16;
$suma=0;
require("../../Control/conexion.php"); 
$datos_compra="SELECT cli.Celular_cli_p,cli.Telefono_cli_p,cli.Nom_cliete_p,v.Descuento,v.Numero_ven,v.Fecha,v.Cantidad_v,p.Nombre AS Pro,p.Precio_ven,v.Total,s.Ciudad,pe.Nombre FROM ventas v JOIN productos p  ON p.Id_pro=v.Id_produc_v
JOIN sucursal s ON s.Id_sucu=v.Id_sucu_v
JOIN personal pe ON pe.Id_persona=v.Id_persona_v JOIN clientes_p cli ON cli.Id_cliente=v.Id_cliete_v  WHERE Numero_ven=? AND Id_sucu=?";

$pre_datos=$con->prepare($datos_compra);
$pre_datos->execute(array($venta,$Idsu));

while ($row=$pre_datos->fetch(PDO::FETCH_ASSOC)) {
  $num_venta=$row['Numero_ven'];
  $trabajador=$row['Nombre'];
  $des=$row['Descuento'];
  $cli=$row['Nom_cliete_p'];
  $tel=$row['Telefono_cli_p'];
  $cel=$row['Celular_cli_p'];
  echo "
  <tr>
  <td>$row[Cantidad_v]</td>
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

 ?>
 </table>
<?php 
if ($_SESSION["des"]==0) {
  $resultado=$pagar-$su;
 echo "
 <strong class='total'>Iva: 16%</strong><br>
 <strong class='total'>Total iva: $". number_format($su)."</strong><br>
<strong class='total'>Descuento: ". number_format(0,2)."%</strong><br>
<strong class='total'>Total Descuento: $". number_format($su)."</strong><b>
<strong class='total'>Paga: ".$p." $". number_format($pagar)."</strong><br>
<strong class='total'>Cambio: $". number_format($resultado)."</strong>
 ";
}else{
  $resultado=$pagar-$_SESSION["des"];
echo "
 <strong >Íva: 16%</strong><br>
 <strong >Total íva: $". number_format($su)."</strong><br>
<strong >Descuento: ". number_format($des)."%</strong><br>
<strong >Total Descuento: $". number_format($_SESSION["des"])."</strong><b><br>
<strong >Paga ".$p.": $". number_format($pagar)."</strong><br>
<strong >Cambio: $". number_format($resultado)."</strong>
 ";
}


 ?>

</article>
</section>
<!-- <img src="C:\xampp\htdocs\Llantera Pacifico\Control\dompdf\src\Image\alerta.png" width="100" alt="100"> -->
<hr>
<footer>
<strong>Cliente</strong> <?php echo $cli; ?><br>
<strong>Teléfono</strong>  <?php echo $tel; ?><br>
<strong>Celular</strong>  <?php echo  $cel; ?><br><br>
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