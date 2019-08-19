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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factura de compra</title>
	<style type="text/css">
		.datosFactura{
			position: absolute;
			width: 200px;
			height: 80px;
			top: 158px;
			left: 75%;
			text-align: center;
			padding-top: 50px;
		}
		.encabesado-fac{
			border: 2px solid black;
		}
		.fecha{
			position: absolute;
			border: 2px black;
			top: 10px;
			left: 80%;
			text-align: center;
			font-family: cursive;
		}
		.encabesado-fac h2{
			text-align: center;
		}
		
	</style>
</head>
<body>
	<head>
		<div class="encabesado-fac">
		<h2>Factura</h2>
  <h3>Llantera del pacífico S.A DE C.V.</h3>
	  <?php 
	  require("../../Control/conexion.php"); 
	  $datos_sucu="SELECT *FROM sucursal WHERE Id_sucu=?";
	  $pre_sucu=$con->prepare($datos_sucu);
	  $pre_sucu->execute(array($Idsu));
	  while ($datos=$pre_sucu->fetch(PDO::FETCH_ASSOC)) {
	    echo "$datos[Ciudad]"."<br>";
	    echo "Dirección: ".$datos['Colonia'].", ".$datos['Calle']."<br>";
	    echo "Correo: ".$datos['Correo']."<br>";
	    echo "Teléfono: ".$datos['Tel']."<br>";
	    echo "RFC: ".$datos['RfC']."<br>";
	    echo "CP: ".$datos['CP']."<br>";
    
  	}
  	echo "<div class='fecha'>Fecha ".date('d-m-Y')."</div>";
 ?>
 	

	<div class="datosFactura">
	<strong>N° 1763</strong>
	</div>
	</div>
		
	</head>
</body>
</html>



<?php
use Dompdf\Dompdf;
// require_once('dompdf/autoload.inc.php');
require_once('../../Control/dompdf/autoload.inc.php');
$dompdf=new DOMPDF();
$dompdf->load_html(ob_get_clean());
$dompdf->render();
$filename=$nombre.' '.$p.' '.$m.'.pdf';
$dompdf->stream($filename,array("Attachment"=>0));
 ?>


