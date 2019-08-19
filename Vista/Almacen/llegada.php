<?php 
 $no=!empty($_REQUEST['no'])?$_REQUEST['no']:'';
$exito=!empty($_REQUEST['exito'])?$_REQUEST['exito']:'';
$agregado=!empty($_REQUEST['agregado'])?$_REQUEST['agregado']:''; 
if ($no) {
   echo "
<script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-ingresarPro').slideDown('slow');
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
        sweetAlert('Exito','El producto se agrago correctamente', 'success');
        });
      </script>

      ";
}else if($agregado){
    echo "
        <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
     <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
        $(document).ready(function(){   
        sweetAlert('Exito','El movimiento se realizó exitosamente', 'success');
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
	<title>Productos en espera</title>
  <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../../Diseño/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/iconos/fonts/style.css">
  <link rel="stylesheet" type="text/css" href="../../Diseño/css-almacen/diseño-llegada.css">
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
<!-- Tabla De productos en espera -->
<div class="container">
<div class="table-responsive ">
	<table class="table ">
    <tr class="bg-primary">
		<th >No.Movimiento</th>
    <th>Codigo producto</th>
		<th>Nombre del producto</th>
		<th>Salida</th>
		<th>Llegada</th>
		<th>Cantidad</th>
		<th>Fecha</th>
		<th>Nota</th>
		<th>Estado</th>
    <th>Agregar</th>
    </tr>
	<?php 
 	require("../../Control/conexion.php");
 	$sel_pro_llegada="SELECT Id_movimiento,Codigo_pro,Nombre,desde,destino,Cantidad,Fecha,Nota,Estado_mo FROM productos JOIN movi_pro ON movi_pro.Id_prod_2=productos.Id_pro JOIN movimientos 
	 on movimientos.Id_movimiento=movi_pro.Id_movi_1 WHERE destino=?";
	 $pre_sel_llegada=$con->prepare($sel_pro_llegada);
	 $pre_sel_llegada->execute(array($sucu));

	 while ($row=$pre_sel_llegada->fetch(PDO::FETCH_ASSOC)) {
    $estado=$row['Estado_mo'];
    if ($estado==="Entregado") {
      $IdMo=$row['Id_movimiento'];
      $can=$row['Cantidad'];
      $codigo=$row['Codigo_pro'];
      
      echo "
      <tr>
      <td>$row[Id_movimiento]</td>
      <td>$row[Codigo_pro]</td>
      <td>$row[Nombre]</td>
      <td>$row[desde]</td>
      <td>$row[destino]</td>
      <td>$row[Cantidad]</td>
      <td>$row[Fecha]</td>
      <td>$row[Nota]</td>
      <td>$row[Estado_mo]</td>
      <td><a href='../../Control/Con_almacen/con_llegada.php?cantidad=$can&&
      co=$codigo&&
      agre=$IdMo&&
      sucur=$row[desde]
      '><button class='btn btn-success'>Agregar</button></a></td>
      </tr>";
    }else if($estado==="En Camino"){
       echo "
      <tr>
      <td>$row[Id_movimiento]</td>
      <td>$row[Codigo_pro]</td>
      <td>$row[Nombre]</td>
      <td>$row[desde]</td>
      <td>$row[destino]</td>
      <td>$row[Cantidad]</td>
      <td>$row[Fecha]</td>
      <td>$row[Nota]</td>
      <td>$row[Estado_mo]</td>
      <td></td>
      </tr>";
    }elseif ($estado==="Concretado") {
       
    }
	 		
	 }

	 ?>
	</table>
	</div>
	</div>

<!-- modal -->
<div class="modal-ingresarPro">
<div class="container">
<div class="panel-primary">
  <div class="panel-heading">Regitrar Nuevo Producto</div>
  <div class="panel-body">
  <?php
  require '../../Control/conexion.php';
  $codi=!empty($_GET['codi'])?$_GET['codi']:'';
  $s=!empty($_GET['s'])?$_GET['s']:''; 
  $pro="SELECT Nombre,Tama,Modelo,Precio_com,Descripcion,Precio_ven,id_prove_p FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro 
         JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 WHERE Ciudad=? AND Codigo_pro=? ";
  $pre_pro=$con->prepare($pro);
  $pre_pro->execute(array($s,$codi));
  while ($r=$pre_pro->fetch(PDO::FETCH_ASSOC)) {
    $pro=$r['Nombre'];
    $tamaño=$r['Tama'];
    $modelo=$r['Modelo'];
    $venta=$r['Precio_ven'];
    $descrip=$r['Descripcion'];
    $compra=$r['Precio_com'];
    $provedor=$r['id_prove_p'];
  }

   ?>
  <section>
    <article>
      <form action="../../Control/Con_almacen/ingre_pro_modal.php" method="post" class="form-horizontal formulario">
                  <div class="form-group">  
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">No.Movi</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <?php
                    $no=!empty($_REQUEST['no'])?$_REQUEST['no']:'';
                     echo'<input type="text" name="movi" id="movi" value='.$no.' class="form-control" autofocus readonly="readonly">'
                    ;?>
                    <span id="error1" class="incorrecto">Error, no realice acciones que pueden causar problemas en el sistema.</span>
                    </div>
                    </div>

                   
                  <div class="form-group">  
                  <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Código</label>
                   <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                   <?php 
                   $codi=!empty($_REQUEST['codi'])?$_REQUEST['codi']:'';
                   echo '<input type="text" name="clave_pro" id="clave_pro" value='.$codi.' class="form-control" autofocus readonly="readonly">';
                    ?>
                    <span id="error1" class="incorrecto">Error, no realice acciones que pueden causar problemas en el sistema</span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Producto</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <?php 
                    $pro=!empty($pro)?$pro:'';
                      echo '<input type="text" name="nombre" id="nombre" value="'.$pro.'" class="form-control">';
                     ?>
                      <span id="error2" class="incorrecto">Complete el campo con un nombre de producto. <strong>Ejemplo:Llanta Delanteras</strong></span> 
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Tamaño</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <?php
                    $tamaño=!empty($tamaño)?$tamaño:'';
                    echo '<input type="text" name="tamaño" id="tamaño" value="'.$tamaño.'" class="form-control">';
                     ?>
                    <span id="error3" class="incorrecto">Complete el campo con un tamaño de producto. <strong>Ejemplo:255/75R15</strong></span>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Modelo</label>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8" >
                    <?php 
                    $modelo=!empty($modelo)?$modelo:'';
                    echo '<input type="text" name="modelo" id="modelo" value="'.$modelo.'"class="form-control">';
                     ?>
                    <span id="error4" class="incorrecto">Complete el campo con un modelo de producto <strong>Ejemplo:2016-2018</strong></span>
                    </div>
                    </div>


             <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Descipción</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php 
            echo '<textarea type="text" name="descrip" id="descrip" class="form-control">'.$descrip.'</textarea>';
             ?>
            <span id="error5" class="incorrecto">Complete el campo con una descripción <strong>Ejemplo:Llanta para camioneta doble rodado</strong></span>
            </div>
            </div>
            
          
            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Stock</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php 
            $ca=!empty($_REQUEST['ca'])?$_REQUEST['ca']:'';
            echo '<input type="text" name="stock" id="stock" value='.$ca.' class="form-control" readonly="readonly">';
             ?>
            <span id="error6" class="incorrecto">Error, no realice acciones que pueden causar problemas en el sistema</span>
            </div>
            </div>

          <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Compra</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php
            $compra=!empty($compra)?$compra:''; 
            echo '<input type="text" name="precio_compra" id="p_c" value="'.$compra.'" class="form-control" readonly="readonly"> ';
             ?>
            <span id="error7" class="incorrecto">Complete el campo con una cantidad. <strong>Ejemplo:$3500</strong></span>   
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Venta</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php 
            echo '<input type="text" name="precio_venta" id="precio_venta" value="'.$venta.'" class="form-control">';
             ?>
            <span id="error8" class="incorrecto">Complete el campo con una cantidad. <strong>Ejemplo:$4500</strong></span>
            </div>
            </div>
            
            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Entrada</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <?php 
              $en=date('d-m-Y');
            echo '<input type="date" name="fecha_entra" id="fechae" value="'.$en.'" class="form-control">';
             ?>
            <span id="error9" class="incorrecto">Complete el campo con una fecha de entrada de producto</span>
            </div>  
            </div>
            
            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Caducidad</label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <input type="date" name="fecha_ca" id="fecha" class="form-control">
            <span id="error10" class="incorrecto">Complete el campo con una fecha de Caducidad del producto</span>
            </div>  
            </div>

            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1">Estado</label>
              <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                <select type="text" name="estado" id="estado" class="form-control">
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
              $cons="SELECT Nombre_empresa FROM provedores WHERE Id_provedor=?";
            $res=$con->prepare($cons);
            $res->execute(array($provedor));
            echo "<div class='form-group'>";
            echo '<label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>';
            echo "<div class='col-xs-12 col-sm-12 col-md-8 col-lg-8'>";
            echo "<select name='id_pro' class='form-control'>";
            while ($row=$res->fetch(PDO::FETCH_ASSOC)) {
              echo "<option value='".$provedor."'> $row[Nombre_empresa] </option>";
            }
            echo "</select>";
            echo "</div>";
            echo "</div>";
             ?>
    
            <div class="form-group">
            <label class="control-label col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 ">
            <input type="submit" value="Aceptar" class="btn btn-success" id="formu" >
            <input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../../Vista/Almacen/llegada.php'"/>
            </div> 
            </div>

      </form>
    </article>
  </section>
  </div>
  <div class="panel-footer"><h4><span>Llatera del Pacífico</span></h4></div>
</div>
</div>
    </div>
  </div>
</div>
</div>
<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../../Diseño/Validar-almacen/validar-modal.js"></script>
</body>
</html>