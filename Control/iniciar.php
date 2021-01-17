<?php 
include("../Vista/index.php");

if ($_POST) {
	require("conexion.php");
	$usuario=filter_var($_POST['usuario'],FILTER_SANITIZE_STRING);
 	$p=filter_var($_POST['contra'],FILTER_SANITIZE_STRING);
     
	//$tipo=filter_var($_POST['cargo'],FILTER_SANITIZE_STRING);

	$consul="SELECT *FROM personal WHERE Id_persona= :usuario";
	$re=$con->prepare($consul);

	$re->execute(array(":usuario"=>$usuario));

		if ($re->rowCount()===1) {
		while ($registro=$re->fetch(PDO::FETCH_ASSOC)) {
		if (password_verify($p,$registro['Pass'])) {
			if ($registro['Tipo']=="Almacenista") {
				session_start();
				$_SESSION["usuario"]=$registro['Id_persona'];
				header("location:../Vista/Almacen/inicio_almacen.php");
				
			}elseif ($registro['Tipo']=='Vendedor') {
				session_start();
				$_SESSION["usuario"]=$registro['Id_persona'];
				header("location:../Vista/Ventas/incio-ventas.php");
				
			}elseif ($registro['Tipo']=='Administrativo') {
				session_start();
				$_SESSION["usuario"]=$registro['Id_persona'];
				header("location:../Vista/Admi/incio-admi.php");
			}

		}else {
			header("location:../Control/iniciar.php?error=error");
		}
		
	}      
	
	}else {
		// echo "No Existe el usuario";
		header("location:../Control/iniciar.php?error=error");
		
	}

	
}

 
?>