<?php 
include("../Vista/registro.php");

if ($_POST) {
	require("conexion.php");

	
	$id_p=filter_var($_POST['id_p'],FILTER_SANITIZE_STRING);
	$nombre=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
	$pass=filter_var($_POST['contraseña'],FILTER_SANITIZE_STRING);
	$tipo=filter_var($_POST['tipo'],FILTER_SANITIZE_STRING);
	$tel=filter_var($_POST['telefono'],FILTER_SANITIZE_STRING);
	$cel=filter_var($_POST['celular'],FILTER_SANITIZE_STRING);
	$ciudad=filter_var($_POST['ciudad'],FILTER_SANITIZE_STRING);
	$colonia=filter_var($_POST['colonia'],FILTER_SANITIZE_STRING);
	$calle=filter_var($_POST['calle'],FILTER_SANITIZE_STRING);
	$rfc=filter_var($_POST['rfc'],FILTER_SANITIZE_STRING);
	$id_sucu=filter_var($_POST['id_sucu'],FILTER_SANITIZE_STRING);
	$cifrado=password_hash($pass,PASSWORD_DEFAULT);
	
	// Consulta
	// $ins="CALL inse_personal(?,?,?,?,?,?,?,?,?,?,?)";
	$ins="INSERT INTO personal(Id_persona,Nombre,Pass,Tipo,Tel,Celular,Ciudad_pe,Colonia_pe,Calle_pe,RFC,Id_sucu_1) VALUES (?,?,?,?,?,?,?,?,?,?,?);";

	$i=$con->prepare($ins);
	if ($i->execute(array($id_p,$nombre,$cifrado,$tipo,$tel,$cel,$ciudad,$colonia,$calle,$rfc,$id_sucu))) {
		echo "
		<link rel='stylesheet' type='text/css' href='../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				swal({
				  title: 'Registro exitoso!',
				  text: 'El registro se realizó con exito, espere 5 segundos para que se guarden los cambios.',
				  timer: 5000,
				  showConfirmButton: false
				});
				});
			</script>
			<meta http-equiv='Refresh' content='5;url=http://localhost:8080/Llantera Pacifico/Vista/Admi/empleados.php'>

		  ";
	}else {
		echo "
		<link rel='stylesheet' type='text/css' href='../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'No se pudo registrar al empleado, compruebe que el No.Control no se este duplicando.', 'error');
				});
			</script>

		  ";
}

}

 ?>