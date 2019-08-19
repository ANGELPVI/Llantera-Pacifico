<?php 
$eliminar=!empty($_GET['eliminar'])?$_GET['eliminar']:'';
$c=!empty($_GET['c'])?$_GET['c']:'';
$agregar=!empty($_GET['agregar'])?$_GET['agregar']:'';

if ($eliminar) {
	 echo "
 <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-eleminar').slideDown('slow');
   });
   </script>
   ";
}elseif ($c) {
	 echo "
 <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-actul').slideDown('slow');
   });
   </script>
   ";
}else if ($agregar) {
  
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Empleados</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/css-admi/diseño_empeados.css">
   
  </style>
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
<div class="container">
  <a href="../../Vista/registro.php"><button class="btn btn-primary"><span class="icon-user-plus"> Nuevo</span></button></a>
</div>
<br>

<!-- Tabla de empleados -->
<div class="container">
  <div class="table-responsive">
  <table class="table ">
  <tr class="bg-primary">
    <th>No.Control</th>
    <th>Nombre</th>
    <th>Puesto</th>
    <th>Tel</th>
    <th>Cel</th>
    <th>Ciudad</th>
    <th>Colonia</th>
    <th>Calle</th>
    <th>Actualizar</th>
    <th>Eliminar</th>
  </tr>
  <?php
  require '../../Control/conexion.php'; 
  $sel_empleados="SELECT p.Id_persona,p.Nombre,p.Tipo,p.Tel,p.Celular,p.Ciudad_pe,p.Colonia_pe,p.Calle_pe FROM personal p JOIN sucursal s ON s.Id_sucu=p.Id_sucu_1 WHERE s.Id_sucu=? ORDER BY Nombre ";
  $pre_empeados=$con->prepare($sel_empleados);
  $pre_empeados->execute(array($Idsu));
   while ($row=$pre_empeados->fetch(PDO::FETCH_ASSOC)) {
     echo "
     <tr>
     <td>$row[Id_persona]</td>
     <td>$row[Nombre]</td>
     <td>$row[Tipo]</td>
     <td>$row[Tel]</td>
     <td>$row[Celular]</td>
     <td>$row[Ciudad_pe]</td>
     <td>$row[Colonia_pe]</td>
     <td>$row[Calle_pe]</td>
   <td><a href='../../Vista/Admi/empleados.php?c=$row[Id_persona]&&
   n=$row[Nombre]&&
   t=$row[Tel]&&
   cel=$row[Celular]&&
   ci=$row[Ciudad_pe]&&
   col=$row[Colonia_pe]&&
   calle=$row[Calle_pe]&&p=$row[Tipo]'><button class='btn btn-success'><span class='icon-loop2'></span></button></a></td>
   <td><a href='../../Vista/Admi/empleados.php?eliminar=$row[Id_persona]'><button class='btn btn-danger'><span class='icon-user-minus'></span></button></a></td>
     </tr>
     ";
    
    }
   ?>
</table>
    
  </div>
</div>

<!-- Ventana modal actualizar -->
<div class="modal-actul">
<div class="container">
<br>
<div class="panel-primary">
  <div class="panel-heading ">Actualizar Cuenta de empleado</div>
  <div class="panel-body">
  <section>
    <article>
      <form action="../../Control/con-admi/cat_ali_usuarios.php" method="post" class="form-horizontal formulario">                  
                  <div class="form-group">  
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">No.Control</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                   <?php
                    $c=!empty($_REQUEST['c'])?$_REQUEST['c']:'';
                   echo '<input type="text" name="clave" id="clave" class="form-control" value="'.$c.'" readonly="readonly">';
                   ?>
                    <span id="error1" class="incorrecto">Rellen el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Nombre</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <?php 
                      $n=!empty($_REQUEST['n'])?$_REQUEST['n']:''; 
                      echo'<input type="text" name="nombre" id="nombre" value="'.$n.'" class="form-control">';
                      ?>
                      <span id="error2" class="incorrecto">Rellen el campo correctamente</span> 
                    </div>
                    </div>

                    <div class="form-group">
          					<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Puesto</label>
          					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
          						<select class="form-control" id="cargo" name="tipo" placeholder="Cargo">
          							<?php
          							$p=!empty($_GET['p'])?$_GET['p']:''; 
          							echo "<option value='".$p."'>Puesto Actual ".$p."</option>";
          							 ?>
          							<option value="Gerente">Gerente</option>
          							<option value="Administrativo">Administrativo</option>
          							<option value="Secretaria">Secretaria</option>
          							<option value="Vendedor">Vendedor</option>
          							<option value="Almacenista">Almacenista</option>
          						</select>
          						</div>
          						</div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Tel</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <?php
                    $t=!empty($_REQUEST['t'])?$_REQUEST['t']:'';  
                    echo '<input type="text" name="tel" id="tel" value="'.$t.'" class="form-control">';
                    ?>
                    <span id="error3" class="incorrecto">Rellen el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Cel</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <?php
                    $cel=!empty($_REQUEST['cel'])?$_REQUEST['cel']:'';  
                    echo '<input type="text" name="cel" id="cel" value="'.$cel.'" class="form-control">';
                    ?>
                    <span id="error4" class="incorrecto">Rellen el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Ciudad</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <?php
                    $ci=!empty($_REQUEST['ci'])?$_REQUEST['ci']:'';  
                    echo '<input type="text" name="ciu" id="ciu" value="'.$ci.'" class="form-control">';
                    ?>
                    <span id="error5" class="incorrecto">Rellen el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Col</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <?php
                    $col=!empty($_REQUEST['col'])?$_REQUEST['col']:'';  
                    echo '<input type="text" name="col" id="col" value="'.$col.'" class="form-control">';
                    ?>
                    <span id="error6" class="incorrecto">Rellen el campo correctamente</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Calle</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <?php
                    $calle=!empty($_REQUEST['calle'])?$_REQUEST['calle']:'';  
                    echo '<input type="text" name="calle" id="calle" value="'.$calle.'" class="form-control">';
                    ?>
                    <span id="error7" class="incorrecto">Rellen el campo correctamente</span>
                    </div>
                    </div>
          
    		            <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
    		            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
    		            <input type="submit" value="Aceptar" class="btn btn-success " id="actualizar">  
                    <input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../../Vista/Admi/empleados.php'"/>
                    </div>
                    </div> 
      </form>
    </article>
  </section>
  </div>
  <div class="panel-footer fondo-panel">Llantera del Pacífico <?php echo "sucursal ".$sucu.""; ?></div>
</div>
</div>
    </div>
  </div>
</div>
</div>


<!-- Modal eliminar producto -->
<div class="modal-eleminar">
<br>
<div class="container">
   <div class="panel-danger panel-tamaño">
    <div class="panel-heading">Eliminar usuario</div>

     <div class="panel-body">
     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ">
      Está apunto de <strong> Eliminar</strong> una cuenta de empleado, lo cual causará que ya no tenga acceso al sistema.
     </div>
     <hr>
     <div class="form-group botones">
     <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-7">
      <?php
     $eliminar=!empty($_REQUEST['eliminar'])?$_REQUEST['eliminar']:'';  
     echo'<a href="../../Control/con-admi/cat_ali_usuarios.php?eliminar='.$eliminar.'"><button class="btn btn-danger">Eliminar</button></a>';
     ?>
     <button type"buton" onClick="location.href='../../Vista/Admi/empleados.php'" class="btn btn-success">Cancelar</button>
     </div>
     </div>
     </div>
     </div>
</div>
</div>
 <script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js">
</script><script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/validar-admi/validar-usuario.js"></script>
</body>
</html>