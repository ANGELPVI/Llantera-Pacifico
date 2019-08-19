<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Registro</title>
	<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../Diseño/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../Diseño/iconos/fonts/style.css">
	<link rel="stylesheet" type="text/css" href="../Diseño/css/errores.css">
</head>
<body>
<?php 
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
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
				<a href="#">Sucursales</a>
				<a href="../Vista/Admi/incio-admi.php">Inicio</a>
				<a href="../Control/cerrar.php">Cerrar Sesión</a>
			</nav>
		</div>
</div>

<br>
<!-- Formulario de registro de empeado -->
<div class="container">
	<div class="panel panel-primary">
		<div class="panel-heading">Nuevo empleado</div>
		<div class="panel-body">
	<form action="../Control/registro.php" method="post" name="formulario" id="formulario" class="form-horizontal">
	<div class="form-group">
	<label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">No.control</label> 
	 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">	
	<input type="text" id="id_p"  name="id_p"  autofocus class="form-control" />
    <span id="señal" class="vacios ">Complete el campo con No.control de empleado. <strong>Ejemplo: 15090708</strong></span>
	</div>
 	</div>

	
	<div class="form-group ">
	<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Nombre</label>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<input class="form-control" type="text"  id="nombre" name="nombre"  autofocus />
	<span id="señal1" class="vacios ">Complete el campo con un nombre. <strong>Ejemplo: Migel Ángel LAGUNA JUAREZ</strong></span>
	
	</div>
	</div>

	<div class="form-group ">
	<label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1" id="ver">Contraseña</label>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
	<input class="form-control" type="password" id="cont" name="contraseña" autofocus />
	<span id="señal2" class="vacios ">Complete el campo con una contraseña <strong>8 máximo</strong></span> 
	</div>
	</div>
	
	<div class="form-group">
		<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Cargo</label>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
			<select class="form-control" id="cargo" name="tipo" placeholder="Cargo">
				<option value="Administrativo">Administrativo</option>
				<option value="Secretaria">Secretaria</option>
				<option value="Vendedor">Vendedor</option>
				<option value="Almacenista">Almacenista</option>
			</select>
		</div>
	</div>

	<div class="form-group">
	<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Teléfono</label>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<input class="form-control" type="text" name="telefono" id="telefono" autofocus>
	<span id="señal4" class="vacios ">Complete el campo con un teléfono. <strong>Ejemplo: 7585382451</strong></span>
	</div>
	</div>

	<div class="form-group">
	<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Celular</label>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<input class="form-control" type="text" id="celular" name="celular"  autofocus>
	<span id="señal5" class="vacios ">Complete el campo con un celular. <strong>Ejemplo: 7551302134</strong></span>
	</div>
	</div>

	<div class="form-group">
	<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Ciudad</label>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<input class="form-control" type="text" id="ciudad" name="ciudad"  autofocus>
	<span id="señal6" class="vacios ">Complete el campo con un nombre de ciudad <strong>Ejemplo: Morelia</strong></span>
	</div>
	</div>

	<div class="form-group">
	<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Colonia</label>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<input class="form-control" type="text" id="colonia" name="colonia"  autofocus>
	<span id="señal7" class="vacios ">Complete el campo con un nombre de colonia <strong>Ejemplo: Col.Juarez</strong></span>
	</div>
	</div>

	<div class="form-group">
	<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Calle</label>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<input class="form-control" type="text" id="calle" name="calle" autofocus>
	<span id="señal8" class="vacios ">Complete el campo con un nobre de calle <strong>Ejemplo: Calle.Tamarindos</strong></span>
	</div>
	</div>

	<div class="form-group">
	<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">RFC</label>
	<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
	<input type="text" id="rfc" name="rfc"  autofocus class="form-control">
	<span id="señal9" class="vacios ">Complete el campo con el RFC de la empresa</span>
	</div>
	</div>

	<?php 
	require("../Control/conexion.php");
	
	$cons="SELECT *FROM sucursal";
	
	$res=$con->prepare($cons);
	$res->execute();
	echo "<div class='form-group'>";
	echo '<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Sucursal</label>';
	echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-8'>";
	echo "<select name='id_sucu' class='form-control'>";
	while ($row=$res->fetch(PDO::FETCH_ASSOC)) {
		echo "<option value='$row[Id_sucu]'> $row[Ciudad] </option>";
	}
	echo "</select>";
	echo "</div>";
	echo "</div>";
	
	 ?>
	 <div class="form-group">
	 <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
	 <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
	<input type="submit" value="Registrar" id="btn" class="btn btn-success"/>
	<input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../Control/con-admi/cat_ali_usuarios.php'"/>
	</div>
	</div>

	</form>
	</article>
	</section>
			
		</div>
		<div class="panel-footer">Llantera del pacífico sucursal <?php echo "".$sucu.""; ?></div>
	</div>
</div>
	

	<script type="text/javascript" src="../Diseño/js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="../Diseño/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../Diseño/js/validar_registro.js"></script>
	
</body>
</html>