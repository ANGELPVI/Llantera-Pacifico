<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ingresar nuevo producto</title>
	<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  	<link rel="stylesheet" type="text/css" href="../../Diseño/css-almacen/diseño-ingre-pro.css">
	
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




<!-- Formulario -->
<br>
<div class="container">
<div class="panel-primary">
	<div class="panel-heading">Nuevo producto</div>
	<div class="panel-body color-panel">
	<section>
		<article>
			<form action="../../Control/Con_almacen/con-ingrealmacen.php" method="post" class="form-horizontal formulario">
			<div class="form-group">
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Código</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="text" name="clave_pro" id="clave_pro" class="form-control" autofocus>
                    <span id="error1" class="incorrecto">Complete el campo con un código de producto. <strong>Ejemplo: 9897022AB</strong></span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Producto</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <input type="text" name="nombre" id="nombre"  class="form-control">
                      <span id="error2" class="incorrecto">Complete el campo con un nombre de producto. <strong>Ejemplo:Llanta Delanteras</strong></span> 
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Tamaño</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="text" name="tamaño" id="tamaño" class="form-control">
                    <span id="error3" class="incorrecto">Complete el campo con un tamaño de producto. <strong>Ejemplo:255/75R15</strong></span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Modelo</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <input type="text" name="modelo" id="modelo"  class="form-control">
                    <span id="error4" class="incorrecto">Complete el campo con un modelo de producto <strong>Ejemplo:2016-2018</strong></span>
                    </div>
                    </div>

				    <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Descripción</label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    <textarea type="text" name="descrip" id="descrip"  class="form-control"></textarea>
				    <span id="error5" class="incorrecto">Complete el campo con una descripción <strong>Ejemplo:Llanta para camioneta doble rodado</strong></span>
				    </div>
				    </div>
				  
				    <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Stock</label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    <input type="text" name="stock" id="stock"  class="form-control">
				    <span id="error6" class="incorrecto">Complete el campo con una cantidad. <strong>Ejemplo:100</strong></span>
				    </div>
				    </div>

					<div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Compra</label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    <input type="text" name="precio_compra" id="p_c"  class="form-control"> 
				    <span id="error7" class="incorrecto">Complete el campo con una cantidad. <strong>Ejemplo:$3500</strong></span>   
				    </div>
				    </div>

				    <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Venta</label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    <input type="text" name="precio_venta" id="precio_venta"  class="form-control">
				    <span id="error8" class="incorrecto">Complete el campo con una cantidad. <strong>Ejemplo:$4500</strong></span>
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Entrada</label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    <input type="date" name="fecha_entra" id="fechae"  class="form-control">
				    <span id="error9" class="incorrecto">Complete el campo con una fecha de entrada de producto</span>
				    </div>  
				    </div>
				    
				    <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">caducidad</label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    <input type="date" name="fecha_ca" id="fecha"  class="form-control">
				    <span id="error10" class="incorrecto">Complete el campo con una fecha de Caducidad del producto</span>
				    </div>  
				    </div>

				    <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Estado</label>
				    	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    		<select name="estado" id="estado" class="form-control">
				    			<option value="">Elige un estado</option>
				    			<option value="Activo">Activo</option>
				    			<option value="Suspedido">Suspendido</option>
				    			<option value="Caducado">Caducado</option>
				    		</select>
				    		<span id="error11" class="incorrecto">Elija un estado para el producto</span>
				    	</div>
				    </div>

				    <?php 
				    	require("../../Control/conexion.php");
				    	$cons="SELECT *FROM provedores";
						$res=$con->prepare($cons);
						$res->execute();
						echo "<div class='form-group'>";
						echo '<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Proveedor</label>';
						echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-8'>";
						echo "<select name='id_pro' class='form-control'>";
						while ($row=$res->fetch(PDO::FETCH_ASSOC)) {
							echo "<option value='$row[Id_provedor]'> $row[Nombre_empresa] </option>";
						}
						echo "</select>";
						echo "</div>";
						echo "</div>";

				     ?>
		
				    <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
				    <input type="submit" value="Aceptar" class="btn btn-success" id="formu" >
				    <input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../../Control/Con_almacen/con-ingrealmacen.php'"/>
				    </div> 
				    </div>
			</form>
		</article>
	</section>
	</div>
	<div class="panel-footer fondo-panel"><h4><span>Servicios y Llantas el Pacífico <?php echo "Sucursal ".$sucu.""; ?></span></h4></div>
</div>
</div>
<br>
<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/Validar-almacen/validacion-ingresoalma.js"></script>
</body>
</html>