
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inicio</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/css-almacen/diseño-almacen.css">
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
<!--Menú iconos-->
<div class="container" >
  <section class="main row">
  <article class="col-lg-4">
  <br>
    <a href="../../Control/Con_almacen/con-ingrealmacen.php"><div class="panel luz-espera">
      <div class="panel-body">
         <span class="icon-box-add iespera"></span>
       </div>
       <div class="panel-footer">Nuevo Producto</div>
    </div></a>
  </article>

  <article class="col-lg-4">
  <br>
    <a href="../../Control/Con_almacen/con-movimiento.php"><div class="panel luz-espera">
    <div class="panel-body">
      <span class="icon-truck iespera" ></span>
    </div>
    <div class="panel-footer">Mover Productos</div>
    </div></a>
    </article>

    <article class="col-lg-4">
  <br>
    <a href="../../Vista/Almacen/enmovimiento.php"><div class="panel luz-espera">
    <div class="panel-body">
      <span class="icon-road iespera" ></span>
    </div>
    <div class="panel-footer">Productos  Movidos</div>
    </div></a>
    </article>
  </section>

<hr>
  <section class="row">

  <article class="col-lg-4">
    <a href="../../Vista/Almacen/llegada.php"><div class="panel luz-espera">
    <div class="panel-body">
      <span class="icon-hour-glass iespera" ></span>
    </div>
    <div class="panel-footer">En espera</div>
    </div></a>
    </article>

  <article class="col-lg-4">
    <a href="../../Control/Con_almacen/actul_eliminar.php"><div class="panel luz-espera">
      <div class="panel-body">
        <span class="icon-table iespera"></span>
      </div>
      <div class="panel-footer">Inventario </div>
    </div></a>
  </article>


  <article class="col-lg-4">
    <a href="../../Vista/Almacen/inventario_general.php"><div class="panel luz-espera">
      <div class="panel-body">
        <span class="icon-file-text iespera"></span>
      </div>
      <div class="panel-footer">Inventario general</div>
    </div></a>
  </article>  
  </section>


  <!-- no modificar provedor -->
<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js">
</script><script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/push.js-master/bin/push.min.js"></script>

</body>
</html>
<?php  date_default_timezone_set('America/Monterrey');

require("../../Control/conexion.php");
$hoy=date("Y-m-d");//para comparar las fechas
$bus="SELECT Codigo_pro, Stock, Fecha_caducidad FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p WHERE Id_sucu=?";

$pre=$con->prepare($bus);

if ($pre->execute(array($Idsu))) {
  while ($row=$pre->fetch(PDO::FETCH_ASSOC)) {
     $co_pro=$row['Codigo_pro'];
    
    if ($row['Fecha_caducidad']<=$hoy) {

       $act_estado="UPDATE productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 JOIN  provedores ON provedores.Id_provedor=productos.id_prove_p set Estado='Caducado' WHERE Id_sucu=? AND Codigo_pro=?";

       $pre_actu=$con->prepare($act_estado);
       if ($pre_actu->execute(array($Idsu,$co_pro))) {
         echo "

          <script type='text/javascript'>
          $(document).ready(function() {
          Push.create('Producto caducado',{
          body:'El producto con código ".$co_pro." a caducado',
          icon:'../../Diseño/imagenes/alerta.png'
        });
      });
          </script>

        ";
        
       }else{
        echo "error al actualizar el estado";
       }
    }elseif ($row['Stock']<=5) {
       echo "

          <script type='text/javascript'>
          $(document).ready(function() {
          Push.create('Poco Stock',{
          body:'El producto con código ".$co_pro." tiene poco Stock',
          icon:'../../Diseño/imagenes/alerta.png'
        });
      });
          </script>

        ";
    }

  }


}else{
  echo "error no se ejecuto";
}




 ?>

