<?php 
$open=!empty($_REQUEST['open'])?$_REQUEST['open']:'';
$eliminar=!empty($_REQUEST['eliminar'])?$_REQUEST['eliminar']:'';
$cer=!empty($_REQUEST['cer'])?$_REQUEST['cer']:'';
if ($open) {
   echo "
 <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-actul').slideDown('slow');
   });
   </script>
   ";
}else if($eliminar){
  echo "
 <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-eleminar').slideDown('slow');
   });
   </script>
   ";
}else if ($cer) {
 header("location:../../Vista/Almacen/inventario.php");
}

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inventario</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
    <link rel="stylesheet" type="text/css" href="../../Diseño/css-almacen/diseño-modal-actua-pro.css">
    
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
<!-- Tabla de inventario -->
<div class="container-fluitd"> 
<div class="table-responsive">
<div class="panel">

<!-- Barra de busqueda -->
<section class="row">
<article class="col-xs-12 col-sm-8 col-md-2 col-lg-2">
<div class="form-group ">
<input type="text" name="buscar" id="buscar" placeholder="Buscar..." class="form-control">
</div>
</article>
<aside class="col-xs-12 col-sm-12 col-md-8 col-lg-7">
 
</aside>
<aside class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
<div class="poco-stock">
poco Stock
</div>
</aside>
<aside class="col-xs-12 col-sm-12 col-md-1 col-lg-1">
<div class="caducado">
Caducado
</div>
</aside>
</section>
  <div id="datos">
  </div>
</div>
</div>


<!-- Ventana modal actualizar -->
<div class="modal-actul">
<br>
<div class="container">
<div class="panel-primary">
  <div class="panel-heading ">
  Actualizar Producto
  </div>
  <div class="panel-body">
  <section>
    <article>
      <form action="../../Control/Con_almacen/actul_eliminar.php" method="post" class="form-horizontal formulario">                  
                  <div class="form-group">  
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Código</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                   <?php
                    $c=!empty($_REQUEST['c'])?$_REQUEST['c']:'';
                   echo '<input type="text" name="clave_pro" id="clave_pro" class="form-control" value="'.$c.'" readonly="readonly">';
                   ?>
                    <span id="error1" class="incorrecto">Este campo no es modificable, por favor deje de jugar con el sistema </span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Producto</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <?php 
                      $n=!empty($_REQUEST['n'])?$_REQUEST['n']:''; 
                      echo'<input type="text" name="nombre" id="nombre" value="'.$n.'" class="form-control">';
                      ?>
                      <span id="error2" class="incorrecto">Complete el campo con un nombre de producto. <strong>Ejemplo:Llanta Delanteras</strong></span> 
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Tamaño</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <?php
                    $t=!empty($_REQUEST['t'])?$_REQUEST['t']:'';   
                    echo'<input type="text" name="tamaño" id="tamaño" value="'.$t.'" class="form-control">';
                    ?>
                    <span id="error3" class="incorrecto">Complete el campo con un tamaño de producto. <strong>Ejemplo:255/75R15</strong></span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Modelo</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <?php
                    $m=!empty($_REQUEST['m'])?$_REQUEST['m']:'';  
                    echo '<input type="text" name="modelo" id="modelo" value="'.$m.'" class="form-control">';
                    ?>
                    <span id="error4" class="incorrecto">Complete el campo con un modelo de producto <strong>Ejemplo:2016-2018</strong></span>
                    </div>
                    </div>

             <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Descripción</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8"">
            <?php 
            $d=!empty($_REQUEST['d'])?$_REQUEST['d']:''; 
            echo '<textarea type="text" name="descrip" id="descrip" class="form-control">'.$d.'</textarea>';
            ?>
            <span id="error5" class="incorrecto">Complete el campo con una descripción <strong>Ejemplo:Llanta para camioneta doble rodado</strong></span>
            </div>
            </div>
          
            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Stock</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php 
            $s=!empty($_REQUEST['s'])?$_REQUEST['s']:''; 
            echo'<input type="text" name="stock" id="stock" value="'.$s.'" class="form-control">';
            ?>
            <span id="error6" class="incorrecto">Complete el campo con una cantidad. <strong>Ejemplo:100</strong></span>
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Venta</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php 
            $v=!empty($_REQUEST['v'])?$_REQUEST['v']:''; 
            echo'<input type="text" name="precio_venta" id="precio_venta" value="'.$v.'" class="form-control">';
            ?>
            <span id="error8" class="incorrecto">Complete el campo con una cantidad. <strong>Ejemplo:$4500</strong></span>
            </div>
            </div>
            
            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Entrada</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php 
            $fe=!empty($_REQUEST['fe'])?$_REQUEST['fe']:''; 
            echo '<input type="date" name="fecha_entra" id="fechae" value="'.$fe.'" class="form-control">';
            ?>
            <span id="error9" class="incorrecto">Complete el campo con una fecha de entrada de producto</span>
            </div>  
            </div>
            
            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Caducidad</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php 
            $fc=!empty($_REQUEST['fc'])?$_REQUEST['fc']:''; 
            echo'<input type="date" name="fecha_ca" id="fecha" value="'.$fc.'" class="form-control">';
            ?>
            <span id="error10" class="incorrecto">Complete el campo con una fecha de Caducidad del producto</span>
            </div>  
            </div>

             <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Puesto</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <select class="form-control" id="cargo" name="estado" placeholder="Cargo">
                        <?php
                        $esta=!empty($_GET['esta'])?$_GET['esta']:''; 
                        echo "<option value='".$esta."'>Estado Actual ".$esta."</option>";
                         ?>
                        <option value="Activo">Activo</option>
                        <option value="Caducado">Caducado</option>
                        <option value="Suspendido">Suspendido</option>
                      </select>
                      <span id="error11" class="incorrecto">Elija un estado para el producto</span>
                      </div>
                      </div>


            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <input type="submit" value="Aceptar" class="btn btn-success" id="formu">
            <input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../../Vista/Almacen/inventario.php'"/>  
            </div> 
            </div>

      </form>

    </article>
  </section>
  </div>
  <div class="panel-footer fondo-panel"><h4><span>Servicios y Llantas el Pacífico <?php echo "Sucursal ".$sucu; ?></span></h4></div>
</div>
<br>
</div>
    </div>
  </div>
</div>
</div>

<!-- Modal eliminar producto -->
<div class="modal-eleminar">
<br>
<div class="container">
  <div class="panel-danger">
    <div class="panel-heading">Eliminar Producto</div>
    <div class="panel-body" >   
    <span>Está apunto de eliminar un producto de su almacén, esto causará que toda la información referente al producto desaparezca de sus almacén.</span><br><br>

    <div class="form-group">
    <label class="label-control col-xs-1 col-ms-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
      <div class="col-xs-12 col-ms-12 col-md-8 col-lg-8 col-lg-offset-7">
        <?php
    $elico=!empty($_REQUEST['elico'])?$_REQUEST['elico']:'';  
    echo'<a href="../../Control/Con_almacen/actul_eliminar.php?codi='.$elico.'"><button class="btn btn-success">Eliminar</button></a>';
    ?>
    <input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../../Vista/Almacen/inventario.php'"/>
      </div>
    </div>
    </div>
  </div>
</div>
</div>

<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>	
<script type="text/javascript" src="../../Diseño/Validar-almacen/buscar.js"></script>
</body>
</html>

