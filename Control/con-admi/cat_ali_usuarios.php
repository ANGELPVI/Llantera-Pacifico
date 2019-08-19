<?php
include '../../Vista/Admi/empleados.php';
$eliminar=!empty($_GET['eliminar'])?$_GET['eliminar']:'';
if ($_POST) {
	require '../../Control/conexion.php';
	$clave=filter_var($_POST['clave'],FILTER_SANITIZE_STRING);
	$nombre=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
	$tipo=filter_var($_POST['tipo'],FILTER_SANITIZE_STRING);
	$tel=filter_var($_POST['tel'],FILTER_SANITIZE_STRING);
	$cel=filter_var($_POST['cel'],FILTER_SANITIZE_STRING);
	$ciu=filter_var($_POST['ciu'],FILTER_SANITIZE_STRING);
	$col=filter_var($_POST['col'],FILTER_SANITIZE_STRING);
	$calle=filter_var($_POST['calle'],FILTER_SANITIZE_STRING);

	$act_usuario="UPDATE personal SET Nombre=?,Tipo=?,Tel=?,Celular=?,Ciudad_pe=?,Colonia_pe=?,Calle_pe=? WHERE Id_persona=? AND Id_sucu_1=?";
	$pre_act_usuario=$con->prepare($act_usuario);

	if ($pre_act_usuario->execute(array($nombre,$tipo,$tel,$cel,$ciu,$col,$calle,$clave,$Idsu))) {
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				swal({
				  title: 'Actualización exitosa!',
				  text: 'La actualizacion se realizó con exito, los cambios se veran en 5 segundos.',
				  timer: 5000,
				  showConfirmButton: false
				});
				});
			</script>
			<meta http-equiv='Refresh' content='5;url=http://localhost:8080/Llantera Pacifico/Vista/Admi/empleados.php'>

		  ";

	}else{
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'No se pudo realizar la actualizacion, compueve su conexión', 'error');
				});
			</script>

		  ";
	}
}elseif ($eliminar) {
	require '../conexion.php';
	$eliminarUsuario="DELETE FROM personal WHERE Id_persona=?";
	$pre_elimi=$con->prepare($eliminarUsuario);
	if ($pre_elimi->execute(array($eliminar))) {
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				swal({
				  title: 'Eliminación exitosa!',
				  text: 'La eliminación se realizó con exito, los cambios se veran en 5 segundos.',
				  timer: 5000,
				  showConfirmButton: false
				});
				});
			</script>
			<meta http-equiv='Refresh' content='5;url=http://localhost:8080/Llantera Pacifico/Vista/Admi/empleados.php'>

		  ";


	}else{
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'No se pudo realizar la eliminacón, compueve su conexión', 'error');
				});
			</script>

		  ";
	}
}




 ?>