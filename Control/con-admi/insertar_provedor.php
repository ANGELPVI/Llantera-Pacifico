<?php
require '../../Vista/Admi/agregar_provedores.php';
if ($_POST) {
	require '../conexion.php';
	$Idprovedor=NULL;
	$provedor=filter_var($_POST['provedor'],FILTER_SANITIZE_STRING);
	$correo=filter_var($_POST['correo'],FILTER_SANITIZE_STRING);
	$tel=filter_var($_POST['tele'],FILTER_SANITIZE_STRING);
	$ciudad=filter_var($_POST['ciu'],FILTER_SANITIZE_STRING);
	$estado=filter_var($_POST['estado'],FILTER_SANITIZE_STRING);
	$col=filter_var($_POST['col'],FILTER_SANITIZE_STRING);
	$calle=filter_var($_POST['calle'],FILTER_SANITIZE_STRING);
	$rfc=filter_var($_POST['rfc'],FILTER_SANITIZE_STRING);

	// Comprobar si el rfc no esta repetido
	$sel_rfc="SELECT RFC FROM provedores WHERE RFC=?";
	$pre_sel_rfc=$con->prepare($sel_rfc);
	$pre_sel_rfc->execute(array($rfc));

	if ($pre_sel_rfc->rowCount()==0) {
		// insertar provedor
	$inseProvedor="INSERT INTO provedores(Id_provedor,Telefono,Correo,Ciudad_prove,Estado_pro,Colonia_prove,Calle_prove,Nombre_empresa,RFC) VALUES (?,?,?,?,?,?,?,?,?)";
		$pre_insercion=$con->prepare($inseProvedor);
		if ($pre_insercion->execute(array($Idprovedor,$tel,$correo,$ciudad,$estado,$col,$calle,$provedor,$rfc))) {
			echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Exito', 'El registro se realizó exitosamente', 'success');
				});
			</script>

		  ";
		}else{
				echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'Error, a ocurrido un error de sistema, contacte con soporte técnico.', 'error');
				});
			</script>

		  ";
		}
	 	
	 }else{
	 	echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'Error, el RFC de la empresa se esta duplicando con otro.', 'error');
				});
			</script>

		  ";
	 } 

}




 ?>