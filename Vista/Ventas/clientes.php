<?php 
$valor=!empty($_GET['valor'])?$_GET['valor']:'';
$agregar=!empty($_REQUEST['agregar'])?$_REQUEST['agregar']:'';
$abonos=!empty($_REQUEST['abonos'])?$_REQUEST['abonos']:'';
if ($valor) {
   echo "
<script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-abonos').slideDown('slow');
   });
   </script>
  ";
}elseif($agregar){
   echo "
<script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-insertar').slideDown('slow');
   });
   </script>
  ";
}else if ($abonos) {
  echo "
<script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'>
 </script><script type='text/javascript' src='../../Diseño/js/bootstrap.min.js'></script>
  <script type='text/javascript'>
   $(document).ready(function(){
      $('.modal-abonos').slideDown('slow');
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
	<title>Clietes</title>
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
        <a href='../../Vista/Ventas/incio-ventas.php?agregar=registro'>Agregar Cliente</a>
        <a href='../../Vista/Ventas/clientes.php'>Clientes</a>
        <a href='../../Vista/Admi/incio-admi.php'>Admistrador</a>
        <a href='../../Vista/Ventas/incio-ventas.php'>Inicio</a>
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
        <a href='../../Vista/Ventas/incio-ventas.php?agregar=registro'>Agregar Cliente</a>
        <a href='../../Vista/Ventas/clientes.php'>Clientes</a>
        <a href='../../Vista/Ventas/incio-ventas.php'>Inicio</a>
        <a href='../../Control/cerrar.php'>Cerrar Sesión</a>
      </nav>
    </div>
</div>
  ";

 }
  ?>
  <br>
<!-- Tabla de clientes -->
<div class="container">
  <div class="table-responsive">
    <table class="table table-cliete">
    <tr class="bg-primary">
      <th>IFE</th>
      <th>Nombre</th>
      <th>Teléfono</th>
      <th>Celular</th>
      <th>Correo</th>
      <th>Direccion</th>
      <th>RFC</th>
      <th></th>
    </tr>
    <?php 
    $va='a';
    require '../../Control/conexion.php';
    $clientes="SELECT Id_cliente,Nom_cliete_p,Telefono_cli_p,Dereccion_cli_p,Correo_cli_p,Celular_cli_p,RFC_cli FROM clientes_p JOIN sucursal ON sucursal.Id_sucu=clientes_p.Id_sucursal_p WHERE Id_sucursal_p=?";
    $pre_cli=$con->prepare($clientes);
    $pre_cli->execute(array($Idsu));
    
    while ($row=$pre_cli->fetch(PDO::FETCH_ASSOC)) {
      echo "
      <tr>
      <td>$row[Id_cliente]</td>
      <td>$row[Nom_cliete_p]</td>
      <td>$row[Telefono_cli_p]</td>
      <td>$row[Celular_cli_p]</td>
      <td>$row[Correo_cli_p]</td>
      <td>$row[Dereccion_cli_p]</td>
      <td>$row[RFC_cli]</td>
       <td><a href='../../Vista/Ventas/clientes.php?valor=$va&&cli=$row[Id_cliente]'><button class='btn btn-success'>Abono</button></a></td>
       </tr>
    
      ";
    }
    
     ?>
     </table>
  </div>
</div>

<!-- Ventana modal de abonos -->
<div class="modal-abonos">
  <div class="container">
  <br>
    <div class="table-responsive">
      <div class="panel-primary">
      
        <div class="panel-heading ">Historial de Crédito</div>
      
        <div class="panel-body">
        <table class="table table-abono">
        <tr class="bg-primary">
          <th>Producto</th>
          <th>Descuento</th>
          <th>Total</th>
          <th>Abono</th>
          <th>Debe</th>
          <th>Fecha de compra</th>
          <th>Fecha abono</th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          
        </tr>
          <?php
          require '../../Control/conexion.php';
          $cli=filter_var(!empty($_REQUEST['cli'])?$_REQUEST['cli']:'',FILTER_SANITIZE_STRING); 
          $sel_cre="SELECT Id_credito,Id_cliente,Nom_cliete_p,Nombre,Des_cre,Deuda,Abonos,Total_cuenta,Fecha_compra,Fecha_abono,Id_sucu FROM credito JOIN productos ON productos.Id_pro=credito.Id_produc_cre JOIN sucursal ON sucursal.Id_sucu=credito.Id_sucursal_cre JOIN clientes_p ON clientes_p.Id_cliente=credito.Id_cliente_cre_p
            WHERE  Id_cliente=? AND Id_sucu=? AND Total_cuenta>0";
            $pre_abono=$con->prepare($sel_cre);
            $pre_abono->execute(array($cli,$Idsu));
            while ($ro=$pre_abono->fetch(PDO::FETCH_ASSOC)) {
              $idclre=$ro['Id_credito'];
              $_SESSION['cliente']=$ro['Id_cliente'];
              echo "
                <tr>
                <td>$ro[Nombre]</td>
                <td>$ro[Des_cre]%</td>
                <td>$ro[Deuda]</td>
                <td>$ro[Abonos]</td>
                <td>$ro[Total_cuenta]</td>
                <td>$ro[Fecha_compra]</td>
                <td>$ro[Fecha_abono]</td>
                <td><form action='../../Control/con-ventas/abonos.php' method='post'></td>
                    <td><input type='radio' name='id' value='".$idclre."'></td>
                    <td><input type='text' name='abono' id='abonos' placeholder='abonar' class='form-control'></td>
                    <td><input type='text' name='recibo' id='recibo'placeholder='Recibo' class='form-control'></td>
                    <td><input type='submit' value='Abonar' class='btn btn-primary' id='abonar'></td>
                  <td></form></td>
                </tr>            
      
                ";
            }
      
           ?>
           
           </table>
        </div>
        <div class="panel-footer">
        <?php

        $r=!empty($_REQUEST['r'])?$_REQUEST['r']:'';
         echo '<a href="../../Control/con-ventas/ticke_credito.php?cli='.$_SESSION['cliente'].'&&re='.$r.' "><button class="btn btn-success">Imprimir</button></a>'
         ;?>
           <input type="button" class="btn btn-danger " value="Cancelar" onClick="location.href='../../Vista/Ventas/clientes.php'"/>
         </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="../../Diseño/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../../Diseño/js/bootstrap.min.js"></script>
</body>
</html>