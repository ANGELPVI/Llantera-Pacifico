<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Compras</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/css-admi/diseño-compras.css">
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
  <!-- Elegir provedor -->
   <div class="container">
      <article>
       <div class="row">
     <form action="../../Vista/Admi/compras.php" method="post">
       <?php 
       require("../../Control/conexion.php");
       $cons="SELECT *FROM provedores";
       $res=$con->prepare($cons);
       $res->execute();
       echo "<div class='form-group'>";
       echo "<div class='col-xs-12 col-sm-12 col-md-4 col-lg-4 col-lg-offset-2'>";
       echo "<select name='provedor' id='prove' class='form-control'>";
       echo "<option value=''>Elige un proveedor </option>";
       while ($row=$res->fetch(PDO::FETCH_ASSOC)) {
           echo "<option value='$row[Id_provedor]'> $row[Nombre_empresa] </option>";
         }
             echo "</select>";
             echo "<span id='error1' class='incorrecto'>Elige un proveedor</span>";
             echo "</div>";
             echo "</div>";
       ?>
          <div class="form-group">
          <div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
         <input type="submit" value="Buscar" class="btn btn-success" id="sel_provedor">
         </div>
         </div> 
     </form>
       </div>
     </article>
   </div>
<br>
<!-- Formulario de entradas -->
<div class="container">
  <div class="panel-primary">
    <div class="panel-heading ">
    Compra de productos
    </div>
    <div class="panel-body">
    <section>

      <article>
        <form action="../../Control/con-admi/compras_produc.php" method="post" class="form-horizontal formulario"> 
                <?php 
            require("../../Control/conexion.php");
            $cons="SELECT Nombre_empresa,Nombre,Id_pro,id_prove_p FROM productos JOIN provedores on provedores.Id_provedor=productos.id_prove_p WHERE id_prove_p=?";
            $provedor=filter_var(!empty($_POST['provedor'])?$_POST['provedor']:'',FILTER_SANITIZE_STRING);
            $res=$con->prepare($cons);
            $res->execute(array($provedor));
  
            echo "<div class='form-group'>";
            echo "<label class='control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1'>Producto</label>";
            echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-8 '>";
            echo "<select name='id_pro' id='producto' class='form-control'>";
            echo "<option value=''>Elige un un producto </option>";
            while ($row=$res->fetch(PDO::FETCH_ASSOC)) {
            echo "<option value='$row[Id_pro]'> $row[Nombre] </option>";
          }
              echo "</select>";
            echo "<span id='error2' class='incorrecto'>Seleccione un proveedor, para que pueda ver su <strong>lista de productos</strong></span>";
               echo "</div>";
              echo "</div>";
  
             
          ?>                 
                    <div class="form-group">
                      <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Nombre</label>
                      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                      <input type="text" name="nombre" id="nombre"  class="form-control">
                      <span id="error3" class="incorrecto">Rellene el campo con un nombre real. <strong>Ejemplo: Juan Peréz Lozano</strong></span>
                      </div>
                      </div>
  
                      <div class="form-group">
                      <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Cantidad</label>
                      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                      <input type="text" name="cantidad" id="cantidad"  class="form-control">
                      <span id="error4" class="incorrecto">Rellene el campo con valores validos. <strong>Ejemplo: 10</strong></span>
                      </div>
                      </div>
  
                      <div class="form-group">
                      <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Total</label>
                      <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                      <input type="text" name="total" id="total" class="form-control">
                      <span id="error5" class="incorrecto">Rellene el campo con valores validos. <strong>Ejemplo: 1000</strong></span>
                      </div>
                      </div>
            
                  <div class="form-group">
                  <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
                  <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                  <input type="submit" value="Comprar" class="btn btn-success" id="compra">  
                  </div> 
                  </div>
  
        </form>
      </article>
    </section>
    </div>
    <div class="panel-footer fondo-panel">Llatera del Pacífico <?php echo "Sucursal ".$sucu; ?></div>
  </div>
</div>
<br>
<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js">
</script><script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/validar-admi/validar-compras.js"></script>	
</body>
</html>