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
  	<link rel="stylesheet" type="text/css" href="../../Diseño/css-almacen/diseño-movimiento.css"> 
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
<!-- Formulario -->
<div class="container">
<div class="panel-primary" id="pa">
	<div class="panel-heading">Mover producto</div>
	<div class="panel-body">
	<section>
		<article>
			<form action="../../Control/Con_almacen/con-movimiento.php" method="post" class="form-horizontal">
			
            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Código</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
            <input type="text" name="id_pro" id="id_pro" class="form-control">
            <span id="error4" class="incorrecto">Complete el campo con un código de producto. <strong>Ejemplo: 98970MO</strong></span>
            </div>
            </div>

				  
				    <?php 
				    	require("../../Control/conexion.php");
				    	$cons="SELECT *FROM sucursal";
						$res=$con->prepare($cons);
						$res->execute();
						echo "<div class='form-group'>";
						echo '<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Envío</label>';
						echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-8'>";
						echo "<select name='destino' class='form-control'>";
						while ($row=$res->fetch(PDO::FETCH_ASSOC)) {
							echo "<option value='$row[Ciudad]'> $row[Ciudad] </option>";
						}
						echo "</select>";
						echo "</div>";
						echo "</div>";

				     ?>

					  <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Cantidad</label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    <input type="text" name="cantidad" id="cantidad" class="form-control"> 
				    <span id="error7" class="incorrecto">Complete el campo con una cantidad. <strong>Ejemplo: 20</strong></span>   
				    </div>
				    </div>
				    
				    <div class="form-group">
				    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">MSJ</label>
				    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				    <textarea type="text" name="nota" id="nota" class="form-control"></textarea>
				    <span id="error9" class="incorrecto">Complete el campo con un mensaje. <strong>No menos de 5 palabras no más de 30 palabras</strong> </span>
				    </div>  
				    </div>   
		
				    <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
            <input type="submit" value="Mover" class="btn btn-success" id="envio" >
            <input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../../Control/Con_almacen/con-movimiento.php'"/>
            </div> 
            </div>

			</form>
		</article>
	</section>
	</div>
	<div class="panel-footer fondo-panel">Servicios y Llantas el pacífico <?php echo "Sucursal ".$sucu; ?></div>
</div>
</div>
<br>

<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/Validar-almacen/validar-movi.js"></script>
</body>
</html>