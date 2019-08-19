<?php date_default_timezone_set('America/Monterrey');
session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../Control/iniciar.php");
  }else {
    include("../Control/conexion.php");
    $consul="SELECT Id_sucu,Nombre,Ciudad,Tipo FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $nom=$row['Nombre'];
     $sucu=$row['Ciudad'];
     $Idsu=$row['Id_sucu'];
     $tipo=$row['Tipo'];
    }
  }

if ($_POST) {
require '../Control/conexion.php';
$fecha=!empty($_POST['fecha'])?$_POST['fecha']:'';
$lista=array();
$dens=array();
$i=0;
$selPro="SELECT Id_venta,Fecha,sum(Total) AS Total FROM ventas WHERE Fecha=? AND Id_sucu_v=?";
$pre_pro=$con->prepare($selPro);
$pre_pro->execute(array($fecha,$Idsu));

if ($pre_pro->rowCount()===1) {
  while ($row=$pre_pro->fetch(PDO::FETCH_ASSOC)) {
  $produc=$row['Fecha'];
  $stock=$row['Total'];
  $idv=$row['Id_venta'];
  $lista[$i]=$produc;
  $dens[$i]=$stock;
  $cor[$i]=$idv;
  $i= $i+1;
}

}else{
  echo "no hay vetas de esa fecha";
}

}else{
 $hoy=date('Y-m-d');
require '../Control/conexion.php';
$lista=array();
$dens=array();
$i=0;
$selPro="SELECT Id_venta,Fecha,sum(Total) AS Total FROM ventas WHERE Fecha=? AND Id_sucu_v=?";
$pre_pro=$con->prepare($selPro);
$pre_pro->execute(array($hoy,$Idsu));
while ($row=$pre_pro->fetch(PDO::FETCH_ASSOC)) {
  $produc=$row['Fecha'];
  $stock=$row['Total'];
  $idv=$row['Id_venta'];
  $lista[$i]=$produc;
  $dens[$i]=$stock;
  $cor[$i]=$idv;
  $i= $i+1;
}
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Grafíca</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../Diseño/css-admi/diseño-grafica.css">
</head>
<body>
 <header>
  <div class="titulo">SERVICIOS Y LLANTAS EL PACÍFICO, S.A.</div>
    <div class="img">
    <span class="icon-user"></span>
    <div class="globo">
    <?php echo $tipo; ?>
  </div>
    </div>
    <div class="usuario">
      <?php echo "<strong>".$nom."</strong>";?>
      
    </div>
</header>
<!-- Barra de navegación -->
<div class="encabezado">
    <div class="wrapper">
    <div class="logo"><?php echo "Sucursal ".$sucu; ?></div>
      <nav class="barra">
        <a href="../Vista/Admi/incio-admi.php">Inicio</a>
        <a href="../Control/cerrar.php">Cerrar Sesión</a>
      </nav>
    </div>
</div>
 <br>
<section>
<article class="row">
  <form action="../Control/graficas.php" method="post">
  <div class="form-gruop">
  <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-4"></label>
  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">  
  <input type="date" name="fecha" class="form-control">
  </div>
  </div>
  <div class="form-gruop">
  <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
  <input type="submit" value="ver ventas" class="btn btn-success">
  </div>
  </div>
</form>
</article>
</section>

<!-- Grafíca  de ventas-->

  
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
      <script type="text/javascript">
        google.charts.load("current", {packages:['corechart']});
        google.charts.setOnLoadCallback(drawChart);
        function drawChart() {
          var data = google.visualization.arrayToDataTable([
            ["Element", "Total", { role: "style" } ],
            <?php 
            $k=$i;
            for ($i = 0; $i < $k; $i++) {
             ?>
             ['<?php echo $lista[$i] ?>',<?php echo $dens[$i] ?>, '<?php echo $cor[$i] ?>'],
            <?php  }?>
          ]);
    
          var view = new google.visualization.DataView(data);
          view.setColumns([0, 1,
                           { calc: "stringify",
                             sourceColumn: 1,
                             type: "string",
                             role: "annotation" },
                           2]);
    
          var options = {
            title: "Ventas",
            width: 700,
            height: 500,
            bar: {groupWidth: "95%"},
            legend: { position: "none" },
          };
          var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
          chart.draw(view, options);
      }
      </script>
        <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
      
<script type="text/javascript" src="../Diseño/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../Diseño/js/bootstrap.min.js"></script>
</body>
</html>