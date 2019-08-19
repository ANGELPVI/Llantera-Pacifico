<?php date_default_timezone_set('America/Monterrey');
require '../../Vista/Ventas/clientes.php';
if ($_POST) {
	require('../../Control/conexion.php');
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    $consul="SELECT Id_sucu,Id_persona,Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $Idsu=$row['Id_sucu'];
     $Id_pe=$row['Id_persona'];
    }

  }

$abono=filter_var(!empty($_POST['abono'])?$_POST['abono']:'',FILTER_SANITIZE_STRING);
$fecha_abono=date('Y-m-d');
$id=filter_var(!empty($_POST['id'])?$_POST['id']:'',FILTER_SANITIZE_STRING);
$recibo=filter_var(!empty($_POST['recibo'])?$_POST['recibo']:'',FILTER_SANITIZE_STRING);


if ($abono&&$id&&$recibo&&is_numeric($abono)&&is_numeric($id)&&is_numeric($recibo)&& $abono<$recibo) {
 $act_abono="UPDATE credito SET Abonos=?, Fecha_abono=?,Total_cuenta=Total_cuenta-? WHERE Id_credito=? AND Id_sucursal_cre=?";
$pre_abono=$con->prepare($act_abono);
if ($pre_abono->execute(array($abono,$fecha_abono,$abono,$id,$Idsu))) {
  
  echo "
    <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
     <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
        $(document).ready(function(){   
        swal({
          title: 'Abono exitoso!',
          text: 'El abono se realizó exitosamente, espere 5 segundo para ver los cambios.',
          timer: 5000,
          showConfirmButton: false
        });
        });
      </script>
      <meta http-equiv='Refresh' content='5;url=http://localhost:8080/Llantera Pacifico/Control/con-ventas/abonos.php?abonos=".$abono."&&cli=".$_SESSION['cliente']."&&r=".$recibo."'>
      ";

}else{
  echo "algo paso";
}
}else{
  echo "
    <link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
     <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
      <script type='text/javascript'>
        $(document).ready(function(){   
        sweetAlert('Error', 'Todos los campos son numéricos y obligatorios ', 'error');
        });
      </script>

      ";
}



}

 ?>