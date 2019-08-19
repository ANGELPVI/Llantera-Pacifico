<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Adminitrador</title>
	<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/css-admi/diseño-admi.css">
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


<!-- Menu de acciones en el sistema -->
<div class="container">
	<section class="row">
	<article class="col-lg-4">
		<a href="../../Vista/Almacen/inicio_almacen.php"><div>
			<h3>Almacén</h3>
			<span class="icon-home"></span>
		</div></a>
	</article>
	<article class="col-lg-4">
		<a href="../../Vista/Ventas/incio-ventas.php"><div>
			<h3>Ventas</h3>
			<span class=" icon-cart"></span>
		</div></a>
	</article>
	<article class="col-lg-4">
		<a href="../../Vista/Admi/provedores.php"><div>
			<h3>Proveedores</h3>
			<span class="icon-address-book"></span>
		</div></a>
	</article>
	</section>
	<hr>
	<section class="row">
	<article class="col-lg-4">
		<a href="../../Control/con-admi/cat_ali_usuarios.php"><div>
			<h3>Empleados</h3>
			<span class="icon-users"></span>
		</div></a>
	</article>
	<article class="col-lg-4">
		<a href="../../Control/con-admi/compras_produc.php"><div>
			<h3>Surtir</h3>
			<span class="icon-file-text2"></span>
		</div></a>
	</article>
	<article class="col-lg-4">
		<a href="../../Control/graficas.php"><div>
			<h3>Reportes</h3>
			<span class="icon-stats-dots"></span>
		</div></a>
	</article>

	</section>

</div>

<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js">
</script><script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
</body>
</html>
