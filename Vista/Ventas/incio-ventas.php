<?php 
$agregar=!empty($_REQUEST['agregar'])?$_REQUEST['agregar']:'';
$exito=!empty($_REQUEST['exito'])?$_REQUEST['exito']:'';
$error=!empty($_REQUEST['error'])?$_REQUEST['error']:'';
$abo=!empty($_REQUEST['abo'])?$_REQUEST['abo']:'';
$a=!empty($_REQUEST['a'])?$_REQUEST['a']:'';
$b=!empty($_REQUEST['b'])?$_REQUEST['b']:'';
$c=!empty($_REQUEST['c'])?$_REQUEST['c']:'';


if ($agregar) {
   echo "
<script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-insertar').slideDown('slow');
   });
   </script>
  ";

 }else if ($exito) {
   echo "
    <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
     <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
        $(document).ready(function(){   
        sweetAlert('Exito', 'El Cliente se registro correctamente', 'success');
        });
      </script>

      ";
 }elseif ($error) {
   echo "
    <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
     <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
        $(document).ready(function(){   
        sweetAlert('Error', 'A ocurrido un error al registrar el cliete', 'error');
        });
      </script>

      ";
 }elseif($abo){
     echo "
<script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-abonos').slideDown('slow');
   });
   </script>
  ";
 }else if ($a) {
  echo "
    <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
     <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
        $(document).ready(function(){   
        sweetAlert('Error', 'Verifique que esté realizando bien el cobro', 'error');
        });
      </script>

      ";
   
 }elseif ($b) {
   echo "
    <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
     <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
        $(document).ready(function(){   
        sweetAlert('Error', 'No se encontro el cliente, favor de verificar su IFE', 'error');
        });
      </script>

      ";
 }elseif ($c) {
  echo "
    <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
     <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
        $(document).ready(function(){   
        sweetAlert('Error', 'El cliente no cuenta con un credito para poder realizar una compra de este tipo', 'error');
        });
      </script>

      ";
 }


 ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Inicio</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/css-ventas/diseño-ventas.css">
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
  // Barra de navegación para el administrador en ventas
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
        <a href='../../Vista/Ventas/incio-ventas.php?agregar=registro'>Nuevo Cliente</a>
        <a href='../../Vista/Ventas/clientes.php'>Clientes</a>
        <a href='../../Vista/Admi/incio-admi.php'>Admistrador</a>
        <a href='../../Vista/Ventas/incio-ventas.php'>Inicio</a>
        <a href='../../Control/cerrar.php'>Cerrar Sesión</a>
      </nav>
    </div>
</div>
  ";
  
 }else{
  // Barra de navegación para el usuario de ventas
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
        <a href='../../Vista/Ventas/incio-ventas.php?agregar=registro'>Nuevo Cliente</a>
        <a href='../../Control/con-ventas/abonos.php'>Clientes</a>
        <a href='../../Vista/Ventas/incio-ventas.php'>Inicio</a>
        <a href='../../Control/cerrar.php'>Cerrar Sesión</a>
      </nav>
    </div>
</div>
  ";
 
 }
  ?>
<br>
<!-- Div de ventas -->
<div class="container">
	<section class="main row">
	<!-- Panel vista de productos a vender -->
		<article class="col-lg-8">
			<div class="panel-primary borde-panel">
				<div class="panel-heading">Productos</div>
				<div class="panel-body">
				
				<div id="datos">
        <?php 
         //Mostrar productos a vender
         $su=0;
         $iva=0.16;
         $suma=0;
        $mostrar="SELECT *FROM venta_morelia WHERE Id_sucu_veta=?";
          $pre_most=$con->prepare($mostrar);
          $pre_most->execute(array($Idsu));
          echo "   
          <table class='table '>
          <tr>
          <th>Cantidad</th>
          <th>Producto</th>
          <th>Precio</th>
          <th></th>
          </tr>

           ";

           while ($r=$pre_most->fetch(PDO::FETCH_ASSOC)) {
            $eliminar=$r['Id_pro_vet'];
            echo "
            <tr>
            <td>$r[Cantidad]</td>
            <td>$r[Nombre_ve_pro]</td>
            <td>$r[Costo]</td>
            <td><a href='../../Control/con-ventas/cancelar_compra.php?codigo_pro=$eliminar'><button class='btn btn-danger'><span class='icon-minus'></span></button></td>
            </tr>

              ";
              $suma+=$r['Costo'];
              $i=$suma*$iva;
              $su=$suma+$i;
          }
          echo "</table>";
          echo "<strong> Total"." ".number_format($su,2)."</strong>"."<br>";           
         ?>
          
        </div>
				</div>
			</div>
		</article>

	<!-- panel de control de ventas -->
	<article class="col-lg-4">
			<div class="panel-primary borde-panel">
				<div class="panel-heading">Control de ventas</div>
				<div class="panel-body">
        <form id="formulario">
					<div class="form-group">
					<input type="text" name="codigo" id="codigo" placeholder="Código" class="form-control">
          <span id="error0" class="error-venta">Complete el campo con un código de producto <strong>Ejemplo: 9897022ASx</strong></span>
					</div>
          <div class="form-group">
            <input type="submit" value="Agregar" class="btn btn-primary btn-block form-control" id="agregar">
          </div>
          </form>
					<hr>
          
          <div class="form-group">
          <input type="text" name="descu" id="des" placeholder="Descuento (%)" class="form-control">
          <span id="error" class="error-venta">Si el cliente no cuenta con un descuento rellene el campo con <strong>N/P</strong></span>
          </div>

          <form action="../../Control/con-ventas/finalizar_venta.php" method="post">
          <div class="form-group">
          <input type="text" name="cliente" id="cliente" placeholder="Cliente" class="form-control">
          </div>

          
          <div class="form-group">
          <select name="tipocompra" class="form-control" id="forma_pago">
            <option value="decontado">Contado</option>
            <option value="credito">Credito</option>
          </select>
          </div>

          <div class="form-group">
          <label class="radio-inline"><input type="radio" name="forma" value="efectivo" >Efectivo</label>
          <label class="radio-inline"><input type="radio" name="forma" value="targeta" >Tarjeta</label><br>
          <span id="error200" class="error-venta">Selecciones una forma de pago</span>
          </div>

          <div class="form-group">
          <input type="text" name="pagar" id="pagar" placeholder="Cobro" class="form-control" >
          <span id="error300" class="error-venta">Introdusca un valor valido</span>
          </div>

          <div class="form-group">
            <input type="submit" value="Vender" class="btn btn-success btn-block form-control" id="veder">
          </div>

          </form>
				</div>
				<div class="penel-footer"></div>
			</div>
	</article>
	</section>
</div>

<!-- Ventana modal inserccion de cliente -->
<div class="modal-insertar">
<br>
  <div class="container">
<div class="panel-primary">
  <div class="panel-heading ">Registro de cliente</div>
  <div class="panel-body">
  <section>
    <article>
      <form action="../../Control/con-ventas/registro-cliente.php" method="post" class="form-horizontal formulario">
                  <div class="form-group">  
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">IFE/RFC</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="text" name="ife" id="ife" placeholder="" class="form-control" autofocus>
                    <span id="error1000" class="incorrecto">Complete el campo con un IFE o RFC</span>
                    </div>
                    </div>

                  <div class="form-group">  
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Nombre</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="text" name="nombre" id="nombre" placeholder="" class="form-control" autofocus>
                    <span id="error1" class="incorrecto">Complete el campo con un nombre valido. <strong>Ejemplo: Juan Peréz Mora</strong></span>
                    </div>
                    </div>

                  <div class="form-group">  
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Teléfono</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                   <input type="text" name="tel" id="tel" placeholder="" class="form-control" autofocus >
                    <span id="error2" class="incorrecto">Complete el campo con un número valido. <strong>Ejemplo: 7585382174</strong></span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Celular</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                      <input type="text" name="cel" id="cel" placeholder="" class="form-control">
                      <span id="error3" class="incorrecto">Complete el campo con un número valido. <strong>Ejemplo: 7581009564</strong></span> 
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Correo</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="text" name="correo" id="correo" placeholder="" class="form-control">
                    <span id="error4" class="incorrecto">Complete el campo con un correo valido</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Dirección</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <textarea type="text" name="dire" id="dire" placeholder="" class="form-control"></textarea>
                    <span id="error5" class="incorrecto">Complete el campo con una dirección valida</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">RFC</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="text" name="rfc" id="rfc" placeholder="" class="form-control">
                    <span id="error6" class="incorrecto">Comple el campo con un RFC, en caso de que no exita ponga <strong>N/P</strong></span>
                    </div>
                    </div>

                    <?php 
                    require("../../Control/conexion.php");
                    
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
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <input type="submit" value="Registrar" id="btn" class="btn btn-success"/>
                     <input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../../Vista/Ventas/incio-ventas.php'"/>
                    </div>
                    </div> 
                      </form>
                    </article>
                  </section>
                  </div>
        <div class="panel-footer fondo-panel"><h4><span>Servicios y Llantas el pacífico <?php echo "Sucursal ". $sucu; ?></span></h4></div>
      </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<br>

<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/Validar-ventas/venta.js"></script>
<script type="text/javascript" src="../../Diseño/Validar-ventas/descuento.js"></script>
</body>
</html>








 

