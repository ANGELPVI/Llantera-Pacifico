<?php
$open=!empty($_REQUEST['open'])?$_REQUEST['open']:''; 
$c=!empty($_REQUEST['c'])?$_REQUEST['c']:'';
$can=!empty($_REQUEST['can'])?$_REQUEST['can']:'';

if ($open) {
 echo "
 <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.venta').slideDown('slow');
   });
   </script>
   ";
}elseif ($c) {
  header("location:../../Vista/Almacen/enmovimiento.php");
}elseif ($can) {
  echo "
 <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.ventaEliminar').slideDown('slow');
   });
   </script>
   ";
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
  <meta http-equiv="Last-Modified" content="0">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>En Movimiento</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
    <link rel="stylesheet" type="text/css" href="../../Diseño/css-almacen/diseño-enmovi.css">
</head>
<body>
<?php 
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
    $consul="SELECT Id_sucu,Nombre,Tipo,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $nom=$row['Nombre'];
     $sucu=$row['Ciudad'];
     $Idsu=$row['Id_sucu'];
     $tipo=$row['Tipo'];
    }
  }
 ?>
 
  
</style>
 <?php 
 if ($tipo=="Administrativo") {
  // Barra de navegación para el administrador en almacen
  echo "
  <header>
  <div class='titulo'>SERVICIOS Y LLANTAS EL PACÍFICO, S.A.</div>
    <div class='img'>
    <span class='icon-user'></span>
    <div class='globo'>
     $tipo
  </div>
    </div>
    <div class='usuario'>
      <strong>$nom</strong>
    </div>
</header>

<div class='encabezado'>
    <div class='wrapper'>
    <div class='logo'>Sucursal $sucu</div>
      <nav class='barra'>
        <a href='../../Vista/Admi/incio-admi.php'>Admistrador</a>
        <a href='../../Vista/Almacen/inicio_almacen.php'>Inicio</a>
        <a href='../../Control/cerrar.php'>Cerrar Sesión</a>
      </nav>
    </div>
</div>
  ";
 
 }else{
  // Barra de navegación para el usuario de almacén.
  echo "
  <header>
  <div class='titulo'>SERVICIOS Y LLANTAS EL PACÍFICO, S.A.</div>
    <div class='img'>
    <span class='icon-user'></span>
    <div class='globo'>
     $tipo
  </div>
    </div>
    <div class='usuario'>
      <strong>".$nom."</strong>
      
    </div>
</header>
<div class='encabezado'>
    <div class='wrapper'>
    <div class='logo'>Sucursal $sucu</div>
      <nav class='barra'>
        <a href='../../Vista/Almacen/inicio_almacen.php'>Inicio</a>
        <a href='../../Control/cerrar.php'>Cerrar Sesión</a>
      </nav>
    </div>
</div>
  ";
  

 }
  ?>
  <br>
<!-- Tabla de productos en movimientos -->
<div class="container">
<div class="table-responsive">
<table class="table">
	<tr class="bg-primary">
	<th>No.Movimiento</th>
	<th>Producto</th>
	<th>Salida</th>
	<th>Destino</th>
	<th>Cantidad</th>
	<th>Fecha de salida</th>
	<th>Nota</th>
	<th>Estado</th>
	<th>Finalizar</th>
  <th>Cancelar</th>
	</tr>


<?php 
require("../../Control/conexion.php");

$sel_pro_movi="SELECT Id_movimiento,Id_personal,Nombre,desde,destino,Cantidad,Fecha,Nota,Estado_mo FROM productos JOIN movi_pro ON movi_pro.Id_prod_2=productos.Id_pro JOIN movimientos
 on movimientos.Id_movimiento=movi_pro.Id_movi_1 WHERE Id_personal=$_SESSION[usuario] AND Estado_mo='En camino'";

		$pre_seleccion=$con->prepare($sel_pro_movi);
		$pre_seleccion->execute();

		while ($row=$pre_seleccion->fetch(PDO::FETCH_ASSOC)) {
     $cla=$row['Id_movimiento'];
     $codigo=password_hash($cla,PASSWORD_DEFAULT);
		echo "
		<tr>
			<td>$cla</td>
			<td>$row[Nombre]</td>
			<td>$row[desde]</td>
			<td>$row[destino]</td>
			<td>$row[Cantidad]</td>
			<td>$row[Fecha]</td>
			<td>$row[Nota]</td>
			<td>$row[Estado_mo]</td>
			<td><a href='../../Vista/Almacen/enmovimiento.php?open=o && clave=$codigo'><button class='btn btn-success'>Finalizar</button></a></td>
      <td><a href='../../Vista/Almacen/enmovimiento.php?can=can && clave=$codigo'><button class='btn btn-danger'>Cancelar</button></a></td>
			</tr>";
      
	}



 ?>
 </table>
 </div>
</div>


<div class="venta">
<div class="container">
<br>
  <div class="panel-primary">
    <div class="panel-heading ">
    Entrega de Producto
    </div>
    <div class="panel-body " > 
    <strong>¡Importante!</strong><br>
   Está a punto de finalizar el movimiento, al hacer click en el botón entregar, usted está confirmando que el producto ya fue entregado exitosamente a la sucursal que lo movió y el producto podrá ser agregado al almacén beneficiado.
    <br> 
    <br>
    <div class="col-xs-12 col-ms-12 col-md-8 col-lg-8 col-lg-offset-7">
    <?php 
      $clave=!empty($_REQUEST['clave'])?$_REQUEST['clave']:'';
      echo '<a href="../../Control/Con_almacen/finalizar_movi.php?a='.$clave.'"><button class="btn btn-success">Entregar</button></a> ';
       ?>
    <a href="../../Vista/Almacen/enmovimiento.php?c=c"><button  class="btn btn-danger">Cancelar</button></a>
       </div>
    </div>
  </div>
</div>
</div>


<!-- Ventana modal eliminar -->
<div class="ventaEliminar">
<div class="container">
<br>
<br>
  <div class="panel-danger">
    <div class="panel-heading">
      Cancelar Movimiento
    </div>
    <div class="panel-body" >
    <strong>¡Importante!</strong><br>
     Al cancelar el movimiento debe de estar seguro que el producto este en sus manos, ya que el sistema automáticamente se lo agregará a su Stock.
     <br>
     <br>
    <div class="col-xs-12 col-ms-12 col-md-8 col-lg-8 col-lg-offset-7">
      <?php 
        $clave=!empty($_REQUEST['clave'])?$_REQUEST['clave']:'';
        echo '<a href="../../Control/Con_almacen/finalizar_movi.php?e='.$clave.'"><button class="btn btn-success">Aceptar</button></a> ';
      
         ?>
      <a href="../../Vista/Almacen/enmovimiento.php?c=c"><button  class="btn btn-danger">Cancelar</button></a>
    </div>
    </div>
  </div>

</div>
</div>


<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js">
</script><script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/Validar-almacen/validar-enmovimiento.js"></script>
</body>
</html>

