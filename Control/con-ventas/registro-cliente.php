<?php 

if ($_POST) {
	require '../conexion.php';
	$id_per=filter_var($_POST['ife'],FILTER_SANITIZE_STRING);
	$nombre=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
	$tel=filter_var($_POST['tel'],FILTER_SANITIZE_STRING);
	$cel=filter_var($_POST['cel'],FILTER_SANITIZE_STRING);
	$correo=filter_var($_POST['correo'],FILTER_SANITIZE_STRING);
	$dire=filter_var($_POST['dire'],FILTER_SANITIZE_STRING);
	$rfc=filter_var($_POST['rfc'],FILTER_SANITIZE_STRING);
	$id_sucu=filter_var($_POST['id_sucu'],FILTER_SANITIZE_STRING);

	$insertar_cliente="INSERT INTO clientes_p (Id_cliente,Nom_cliete_p,Telefono_cli_p,Celular_cli_p,Correo_cli_p,Dereccion_cli_p,RFC_cli,Id_sucursal_p) VALUES (?,?,?,?,?,?,?,?)";
	$pre_insercion=$con->prepare($insertar_cliente);
	if ($pre_insercion->execute(array($id_per,$nombre,$tel,$cel,$correo,$dire,$rfc,$id_sucu))) {
		header("location:../../Vista/Ventas/incio-ventas.php?exito=exito");
	}else{
		header("location:../../Vista/Ventas/incio-ventas.php?error=error");
	}
}


 ?>