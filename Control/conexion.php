<?php 

 $name_bd="llantera_pacifico";
 $host="localhost";
 $usaurio="root";
 $pass="";

	$con = new PDO("mysql:dbname=$name_bd; host=$host", $usaurio, $pass);

	if ($con) {
		// echo "Conexion exitosa";
	}else {
		echo "Error de conexion";
	}
		
	
 ?>