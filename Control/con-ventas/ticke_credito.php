 <?php date_default_timezone_set('America/Monterrey');
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
$cli=!empty($_GET['cli'])?$_GET['cli']:'';


$hoy=date('Y-m-d');
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
    table{
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
<strong>Historial de Crédito</strong>
<table>
<tr>
 <th>Producto</th>
 <th>Descuento</th>
 <th>Total</th>
 <th>Abono</th>
 <th>Debe</th>
 <th>Fecha de compra</th>
 <th>Fecha de abono</th>
 <th></th>
</tr>
 <?php
        require '../../Control/conexion.php';
        $cli=filter_var(!empty($_REQUEST['cli'])?$_REQUEST['cli']:'',FILTER_SANITIZE_STRING); 
        $sel_cre="SELECT Id_credito,Id_cliente,Nom_cliete_p,Nombre,Des_cre,Deuda,Abonos,Total_cuenta,Fecha_compra,Fecha_abono,Id_sucu FROM credito JOIN productos ON productos.Id_pro=credito.Id_produc_cre JOIN sucursal ON sucursal.Id_sucu=credito.Id_sucursal_cre JOIN clientes_p ON clientes_p.Id_cliente=credito.Id_cliente_cre_p
          WHERE  Id_cliente=? AND Id_sucu=?";
          $pre_abono=$con->prepare($sel_cre);
          $pre_abono->execute(array($cli,$Idsu));
          while ($ro=$pre_abono->fetch(PDO::FETCH_ASSOC)) {
            $clientes=$ro['Id_cliente'];
            echo "
              <tr>
              <td>$ro[Nombre]</td>
              <td>$ro[Des_cre]%</td>
              <td>$ro[Deuda]</td>
              <td>$ro[Abonos]</td>
              <td>$ro[Total_cuenta]</td>
              <td>$ro[Fecha_compra]</td>
              <td>$ro[Fecha_abono]</td>
              ";
          }

           $clientes=!empty($clientes)? $clientes:'';
		  $total_abo="SELECT SUM(Abonos) AS abonos FROM credito WHERE Fecha_abono=? AND Id_cliente_cre_p=? AND Id_sucursal_cre=?";
		  $pre_abo=$con->prepare($total_abo);
		  $pre_abo->execute(array($hoy,$clientes,$Idsu));
		  while ($total=$pre_abo->fetch(PDO::FETCH_ASSOC)) {
		  	$to_abono=$total['abonos'];
		    }
		  
         ?>

 </table>
 <?php
 $re=$_GET['re'];
 if ($re) {
  $to_abono=!empty($to_abono)?$to_abono:''; 
  $cambio=$re-$to_abono;
      echo "Total Abono: $".$to_abono."<br>";
      echo "Paga: $".$re."<br>";
      echo "Cambio: $".$cambio;
   
 }else{
  
     
 }
 

  ?>
</article>
</section>

<hr>
<footer>

</footer>
</body>
</html>

<?php
use Dompdf\Dompdf;
// require_once('dompdf/autoload.inc.php');
require_once('../../Control/dompdf/autoload.inc.php');
$dompdf=new DOMPDF();
$paper_size = array(0,0,280,600);
$dompdf->set_paper($paper_size,"landscape");
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$filename=$nombre.' '.$p.' '.$m.'.pdf';
$dompdf->stream($filename,array("Attachment"=>0));
 ?>


