<?php 
$idPro=!empty($_GET['idPro'])?$_GET['idPro']:'';
if ($idPro) {
 echo "
 <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-lista').slideDown('slow');
   });
   </script>
   ";
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Provedores</title>
	<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/css-admi/diseño-prove.css">
</head>
<body>
<?php 
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
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
 ?>
  <!--Titulos -->
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
        <a href="../../Vista/Admi/incio-admi.php">Inicio</a>
        <a href="../../Control/cerrar.php">Cerrar Sesión</a>
      </nav>
    </div>
</div>
 
<br>
<!-- Tabla de provedores -->
<div class="container">
  <div class="table-responsive">
  <table class="table ">
  <tr class="bg-primary">
    <th>Provedor</th>
    <th>RFC</th>
    <th>Tel</th>
    <th>Correo</th>
    <th>Ciudad</th>
    <th>Estado</th>
    <th>Col</th>
    <th>Calle</th>
    <th>Más</th>
  </tr>
  <?php
  require '../../Control/conexion.php'; 
  $sel_empleados="SELECT *FROM provedores";
  $pre_empeados=$con->prepare($sel_empleados);
  $pre_empeados->execute(array($Idsu));
   while ($row=$pre_empeados->fetch(PDO::FETCH_ASSOC)) {
      $idp=$row['Id_provedor'];
        echo "
	  <tr>
    <td>$row[Nombre_empresa]</td>
    <td>$row[RFC]</td>
    <td>$row[Telefono]</td>
    <td>$row[Correo]</td>
    <td>$row[Ciudad_prove]</td>
    <td>$row[Estado_pro]</td>
    <td>$row[Colonia_prove]</td>
    <td>$row[Calle_prove]</td>
    <td><a href='../../Vista/Admi/provedores.php?idPro=$idp'><button class='btn btn-success'><span class='icon-plus'></span></button></a></td>
  	</tr>	
     ";
    }
   ?>
</table>
  </div>
</div>

<!-- Ventana modal que muestra la lista de productos -->
<div class="modal-lista">
  <div class="container">
  <br>
    <div class='list-group'>
    <li class='list-group-item active'> 
    <span class="icon-cross" onClick="location.href='../../Vista/Admi/provedores.php'"></span><br>
    <span class="titulo-modal">Lista de Productos</span>
    </li>
    <?php
    require '../../Control/conexion.php';
    $idPro=!empty($_GET['idPro'])?$_GET['idPro']:''; 
    $productos="SELECT Nombre FROM productos JOIN provedores on provedores.Id_provedor=productos.id_prove_p WHERE id_prove_p=?";
    $prePro=$con->prepare($productos);
    $prePro->execute(array($idPro));
    while ($produ=$prePro->fetch(PDO::FETCH_ASSOC)) {
      echo " 
      <li class='list-group-item'>$produ[Nombre]</li>
       ";
    }
    
     ?>
    </div>
  </div>
</div>
<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js">
</script><script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>	
</body>
</html>

