<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Invetario General</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/css-almacen/diseño-inv-general.css">
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
  // Barra de navegación para el usuario de almacén
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
<!-- Tabla de todos los productos en la sucursal -->
<div class="container">
<div class="row">
<section>
<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
<form action="../../Vista/Almacen/inventario_general.php" method="post" class="form-inline">
  <div class="form-group">
  <div class="form-input">
  <select name="sucursal" class="form-control">
    <option value="1">Zihuatanejo</option>
    <option value="2">Huruapan</option>
    <option value="3">Morelia</option>
    <option value="4">Lazaro</option>
  </select>
  </div>
  </div>

  <div class="form-group">
  <div class="form-input">
  <input type="text" name="pro" placeholder="Código del producto" class="form-control">
  </div>
  </div>

  <div class="form-group">
  <button type="submit" class="btn btn-success"><span class="icon-filter"> Filtrar</span></button>
  </div>
</form>
</article>

  </section>
</div>
<hr>

<!-- Tabla de iventario general -->
<div class="table-responsive">
  <div class="panel-primary">
    <div class="panel-heading">Inventario General</div>
    <div class="panel-body">
    <div class="row">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
   <?php
    $valor="tamarindo";
    $cifrado=password_hash($valor,PASSWORD_DEFAULT);
    echo "<a href='../../Vista/Almacen/inventario_general.php?inventario=".$cifrado."'><button class='btn btn-primary'>Ver todo</button></a>";
      ?>
  </article>
  </div>
  <br>
    <table class="table">
    <tr>
      <th>Código</th>
      <th>Producto</th>
      <th>Tamaño</th>
      <th>Modelo</th>
      <th>Descripción</th>
      <th>Precio Neto</th>
      <th>Stock</th>
      <th>Estado</th>
      <th>Sucursal</th>
    </tr>
    <?php
    require '../../Control/conexion.php';
    $sucursal=filter_var(!empty($_POST['sucursal'])?$_POST['sucursal']:'',FILTER_SANITIZE_STRING);
    $pro=filter_var(!empty($_POST['pro'])?$_POST['pro']:'',FILTER_SANITIZE_STRING);
    $inventario=filter_var(!empty($_GET['inventario'])?$_GET['inventario']:'',FILTER_SANITIZE_STRING);

    if ($sucursal && $pro) {
      $produ="SELECT Id_pro,Codigo_pro,Nombre,Tama,Modelo,Descripcion,Stock,Precio_com,precio_ven,fecha_entrada,Fecha_caducidad,Estado,Nombre_empresa,Ciudad FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p WHERE Id_sucu=? AND Codigo_pro=?";
    $pre_poductos=$con->prepare($produ);
    $pre_poductos->execute(array($sucursal,$pro));
    
    if ($pre_poductos->rowCount()>0) {
       while ($row=$pre_poductos->fetch(PDO::FETCH_ASSOC)) {
       echo " 
      <tr>
      <td>$row[Codigo_pro]</td>
      <td>$row[Nombre]</td>
      <td>$row[Tama]</td>
      <td>$row[Modelo]</td>
      <td>$row[Descripcion]</td>
      <td>$$row[precio_ven]</td>
      <td>$row[Stock]</td>
      <td>$row[Estado]</td>
      <td><strong>$row[Ciudad]</strong></td>
      </tr>
        ";
      
     }
    }else{
      echo "<div class='alert alert-danger' role='alert'>El producto no <strong>exite</strong></div>";
    }
       
  }else if ($sucursal) {
    $produ="SELECT Id_pro,Codigo_pro,Nombre,Tama,Modelo,Descripcion,Stock,Precio_com,precio_ven,fecha_entrada,Fecha_caducidad,Estado,Nombre_empresa,Ciudad FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p WHERE Id_sucu=? ";
    $pre_poductos=$con->prepare($produ);
    $pre_poductos->execute(array($sucursal));
      
      if ($pre_poductos->rowCount()>0) {
      
       while ($row=$pre_poductos->fetch(PDO::FETCH_ASSOC)) {
       echo " 
      <tr>
      <td>$row[Codigo_pro]</td>
      <td>$row[Nombre]</td>
      <td>$row[Tama]</td>
      <td>$row[Modelo]</td>
      <td>$row[Descripcion]</td>
      <td>$$row[precio_ven]</td>
      <td>$row[Stock]</td>
      <td>$row[Estado]</td>
      <td><strong>$row[Ciudad]</strong></td>
      </tr>
        ";
      
     }
     }else{
     echo "<div class='alert alert-danger' role='alert'>El producto no <strong>exite</strong></div>";
     }
    
  }else if ($inventario) {
    $va="tamarindo";
   if (password_verify($va,$inventario)) {
    $produ="SELECT Id_pro,Codigo_pro,Nombre,Tama,Modelo,Descripcion,Stock,Precio_com,precio_ven,fecha_entrada,Fecha_caducidad,Estado,Nombre_empresa,Ciudad FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p";
    $pre_poductos=$con->prepare($produ);
    $pre_poductos->execute();
    if ($pre_poductos->rowCount()>0) {
      
       while ($row=$pre_poductos->fetch(PDO::FETCH_ASSOC)) {
       echo " 
      <tr>
      <td>$row[Codigo_pro]</td>
      <td>$row[Nombre]</td>
      <td>$row[Tama]</td>
      <td>$row[Modelo]</td>
      <td>$row[Descripcion]</td>
      <td>$$row[precio_ven]</td>
      <td>$row[Stock]</td>
      <td>$row[Estado]</td>
      <td><strong>$row[Ciudad]</strong></td>
      </tr>
        ";
      
     }
     }else{
      echo "<div class='alert alert-danger' role='alert'>El producto no <strong>exite</strong></div>";
     }
     
   }else{
    echo "<div class='alert alert-warning' role='alert'>Error, no realizé acciones que no debe dentro del sistema</div>";
   }

  }elseif (empty($sucursal) && empty($pro) && empty($inventario)) {
    $produ="SELECT Id_pro,Codigo_pro,Nombre,Tama,Modelo,Descripcion,Stock,Precio_com,precio_ven,fecha_entrada,Fecha_caducidad,Estado,Nombre_empresa,Ciudad FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p";
    $pre_poductos=$con->prepare($produ);
    $pre_poductos->execute();
    if ($pre_poductos->rowCount()>0) {
      
       while ($row=$pre_poductos->fetch(PDO::FETCH_ASSOC)) {
       echo " 
      <tr>
      <td>$row[Codigo_pro]</td>
      <td>$row[Nombre]</td>
      <td>$row[Tama]</td>
      <td>$row[Modelo]</td>
      <td>$row[Descripcion]</td>
      <td>$$row[precio_ven]</td>
      <td>$row[Stock]</td>
      <td>$row[Estado]</td>
      <td><strong>$row[Ciudad]</strong></td>
      </tr>
        ";
      
     }
     }else{
      echo "<div class='alert alert-danger' role='alert'>El producto no exite</div>";
     }
  }


     ?>
     </table>  
    </div>
  </div>
  </div>
</div>

<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js">
</script><script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
</body>
</html>