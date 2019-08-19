<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Provedores</title>
	<link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  	<link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  	<link rel="stylesheet" type="text/css" href="../../Diseño/css-admi/diseño-provedor.css">
</head>
<body>
<?php 
  session_start();
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
    $consul="SELECT Id_sucu,Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $nom=$row['Nombre'];
     $sucu=$row['Ciudad'];
     $Idsu=$row['Id_sucu'];
    }
  }
 ?>
 <!-- Barra de navegación -->
 <div class="usua">
  <?php echo "<span>".$nom."</span>"; ?>
 </div>
<header>
  <div class="conte-menu">
  <h2>Llantera Del Pacífico</h2>
     <img src="../../Diseño/imagenes/logo.jpg" alt="80px" width="150px">
    <nav class="menu">
      <ul>
        <li><a href="../../Control/cerrar.php"><span class="icon-exit"> Cerrar sesion</span></a></li>
        <li><a href="../../Vista/Admi/incio-admi.php"><span class="icon-home"> Inicio</span></a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- Fromulario de agrgar provedor -->
<div class="modal-actul">
<div class="container">
<br>
<div class="panel-primary">
  <div class="panel-heading ">Formulario de Registro de Proveedores</div>
  <div class="panel-body">
  <section>
    <article>
      <form action="../../Control/con-admi/insertar_provedor.php" method="post" class="form-horizontal formulario">                  
                  <div class="form-group">  
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Proveedor</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                   <input type="text" name="provedor" id="provedor" class="form-control">
                    <span id="error1" class="incorrecto">Rellene el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Correo</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <input type="text" name="correo" id="correo" class="form-control">
                      <span id="error2" class="incorrecto">Rellene el campo correctamente</span> 
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Teléfono</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <input type="text" name="tele" id="tele" class="form-control">
                    <span id="error3" class="incorrecto">Rellene el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Ciudad</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <input type="text" name="ciu" id="ciu" class="form-control">
                    <span id="error4" class="incorrecto">Rellene el campo correctamente</span>
                    </div>
                    </div>


                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Estado</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <input type="text" name="estado" id="es" class="form-control">
                    <span id="error5" class="incorrecto">Rellene el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Colonia</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <input type="text" name="col" id="colonia"  class="form-control">
                    <span id="error6" class="incorrecto">Rellene el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Calle</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <input type="text" name="calle" id="calle" class="form-control">
                    <span id="error7" class="incorrecto">Rellene el campo correctamente</span>
                    </div>
                    </div>

                     <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">RFC</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <input type="text" name="rfc" id="rpro" class="form-control">
                    <span id="error8" class="incorrecto">Rellene el campo correctamente</span>
                    </div>
                    </div>
          
    		        <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
    		        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
    		        <input type="submit" value="Aceptar" class="btn btn-success " id="inser">  
                    <input type="button" class="btn btn-danger " value="Cancelar"/>
                    </div>
                    </div> 
      </form>
    </article>
  </section>
  </div>
  <div class="panel-footer fondo-panel"><strong>Llantera del Pacífico <?php echo "Sucursal ".$sucu.""; ?></strong></div>
</div>
</div>
    </div>
  </div>
</div>
</div>
<br>

<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js">
</script><script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/validar-admi/validar-prove.js"></script>	
</body>
</html>