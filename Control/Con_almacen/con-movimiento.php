<?php date_default_timezone_set('America/Monterrey');
include("../../Vista/Almacen/movimiento.php");

if ($_POST) {
	require("../conexion.php");
	$consul="SELECT Id_persona,Ciudad,Id_sucu_1 FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $id_per=$row['Id_persona'];
     $desde=$row['Ciudad'];
     $id_sucursal=$row['Id_sucu_1'];
    }

	$id_pro=filter_var($_POST['id_pro'],FILTER_SANITIZE_STRING);//va en la otra tabla.
	$con_movi="SELECT Id_pro,Nombre,Stock,Ciudad,Id_sucu FROM productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro 
			   JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3 WHERE Id_sucu=? AND Codigo_pro=?";
	$seleccion=$con->prepare($con_movi);
	$seleccion->execute(array($id_sucursal,$id_pro));
	
	if ($seleccion->rowCount()===1) {
	while ($row=$seleccion->fetch(PDO::FETCH_ASSOC)) {
		 $stock=$row['Stock'];
		 $IdPro=$row['Id_pro'];
		}
		$cantidad=filter_var($_POST['cantidad'],FILTER_SANITIZE_STRING);
		if ($stock>$cantidad && $cantidad!=0) {
			//Codigo insertar en movimientos
			$id_movi=rand(100,30000);//va en las dos tablas
			$destino=filter_var($_POST['destino'],FILTER_SANITIZE_STRING);
			$fecha_sali=date('Y-m-d');
			$nota=filter_var($_POST['nota'],FILTER_SANITIZE_STRING);
			$estado="En Camino";

			$ins_movi="INSERT INTO movimientos(Id_movimiento,Id_personal,desde,destino,Cantidad,Fecha,Nota,Estado_mo) VALUES (?,?,?,?,?,?,?,?);";
			$pre=$con->prepare($ins_movi);

			if ($pre->execute(array($id_movi,$id_per,$desde,$destino,$cantidad,$fecha_sali,$nota,$estado))) {
				//aqui se debe insertar en la otra tabla movi_producto
				$in_movi_pro="INSERT INTO movi_pro(Id_movi_1,Id_prod_2) VALUES (?,?)";
				$p_movi_pro=$con->prepare($in_movi_pro);
				if ($p_movi_pro->execute(array($id_movi,$IdPro))) {

					$sql_actulizar="UPDATE productos SET Stock=Stock-? WHERE Id_pro=?";
					$pre_actulizar=$con->prepare($sql_actulizar);
					if ($pre_actulizar->execute(array($cantidad,$IdPro))) {
						echo "
				<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
        		 <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 		<script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
				<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Exito', 'El movimiento se realizó exitosamente', 'success');
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
				sweetAlert('Error', 'Se ha producido un error en el sistema, contacte al soporte técnico', 'error');
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
				sweetAlert('Error', 'Se ha producido un error en el sistema, contacte al soporte técnico', 'error');
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
				sweetAlert('Error', 'Se ha producido un error en el sistema, contacte al soporte técnico', 'error');
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
				sweetAlert('Error', 'No cuenta con suficiente Stock.', 'error');
				});
			</script>

		  ";
		}
		
	}else {
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'El producto no exite, revise el código de producto.','error');
				});
			</script>

		  ";
		
	}

}

 ?>





