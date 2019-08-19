<?php date_default_timezone_set('America/Monterrey');
require '../../Vista/Admi/compras.php';
if ($_POST) {
	require '../../Control/conexion.php';
  if (!isset($_SESSION["usuario"])) {
    header("location:../../Control/iniciar.php");
  }else {
    include("../../Control/conexion.php");
    $consul="SELECT Id_sucu,Nombre,Ciudad FROM personal JOIN sucursal ON sucursal.Id_sucu=personal.Id_sucu_1 WHERE Id_persona=:usua";
    $re=$con->prepare($consul);
    $re->execute(array(":usua"=>$_SESSION['usuario']));
    while ($row=$re->fetch(PDO::FETCH_ASSOC)) {
     $Idsu=$row['Id_sucu'];
    }
  }

  	// variables de formularío
  	$idCom=NULL;
  	$factura=rand(100,10000000);
	$id_pro=filter_var($_POST['id_pro'],FILTER_SANITIZE_STRING);
	$nombre=filter_var($_POST['nombre'],FILTER_SANITIZE_STRING);
	$cantidad=filter_var($_POST['cantidad'],FILTER_SANITIZE_STRING);
	$total=filter_var($_POST['total'],FILTER_SANITIZE_STRING);
	$fecha=date('Y-m-d');

	$sel_provedor="SELECT Nombre_empresa,Nombre,Id_pro,id_prove_p FROM productos JOIN provedores on provedores.Id_provedor=productos.id_prove_p WHERE Id_pro=?";
	$pre_compra=$con->prepare($sel_provedor);
	$pre_compra->execute(array($id_pro));
	while ($row=$pre_compra->fetch(PDO::FETCH_ASSOC)) {
		$provedor=$row['id_prove_p'];
		$empresa=$row['Nombre_empresa'];

	}

	// Insertar en al tabla compras
	$insertar="INSERT INTO compra(Id_compra,Id_produc_c,Id_provedor_c,Id_perso_c,Id_sucu_c,Cantidad_c,Nombre_pro_em,Codigo_fatura_c,Fecha,total_c) VALUES (?,?,?,?,?,?,?,?,?,?);";
	$pre_inser=$con->prepare($insertar);
	if ($pre_inser->execute(array($idCom,$id_pro,$provedor,$_SESSION["usuario"],$Idsu,$cantidad,$empresa,$factura,$fecha,$total))) {
		echo "
		<link rel='stylesheet' type='text/css' href='../../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Exito', 'La compra se realizo con exito,', 'success');
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




}




 ?>