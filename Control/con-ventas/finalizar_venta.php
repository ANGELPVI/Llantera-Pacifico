<?php 

if ($_POST) {
	require('../../Control/conexion.php');
	$iva=0.16;
	$s=0;
	 $idcom=NULL;
	 $fecha_com=date('Y-m-d');
	 $nume_venta=rand(1,1000000);

	session_start();
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

  	//variables de formulario
	$cliente=filter_var(!empty($_REQUEST['cliente'])?$_REQUEST['cliente']:'',FILTER_SANITIZE_STRING);
	$tipocompra=filter_var($_POST['tipocompra'],FILTER_SANITIZE_STRING);
	$forma=filter_var($_POST['forma'],FILTER_SANITIZE_STRING);
	$paga=filter_var($_POST['pagar'],FILTER_SANITIZE_STRING);
	
	//sacar cliente
	$clientes="SELECT Id_cliente FROM clientes_p JOIN sucursal ON sucursal.Id_sucu=clientes_p.Id_sucursal_p WHERE Id_sucursal_p=? AND Id_cliente=?";
	$pre_cli=$con->prepare($clientes);
 	$pre_cli->execute(array($Idsu,$cliente));
 	while ($row=$pre_cli->fetch(PDO::FETCH_ASSOC)) {
 		 $cli=$row['Id_cliente'];
 		
 	}

	//si la compra la realiza un cliente registrado.
	if ($cliente) {
		//comparamos si el cliente exite.
		$cli=!empty($cli)?$cli:'';
		if ($cliente==$cli) {
			//Que tipo de compra es.
		if ($tipocompra=="decontado" && isset($_SESSION["des"]) && $paga>=$_SESSION["des"]) {
			  //seleccionar la tabla de venta
	 	  $mostrar="SELECT *FROM venta_morelia WHERE Id_sucu_veta=?";
          $pre_most=$con->prepare($mostrar);
          $pre_most->execute(array($Idsu));
          while ($r=$pre_most->fetch(PDO::FETCH_ASSOC)) {
          	$IdPro=$r['Id_pro_vet'];
          	$codi_pro=$r['Codi_pro_ve'];
            $canti=$r['Cantidad'];
            $nombre=$r['Nombre_ve_pro'];
            $cos=$r['Costo'];

            //actualizar el stock
            $act_stock="UPDATE productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro
				 JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3
				 set Stock=Stock-? WHERE Id_sucu=? AND Codigo_pro=?";
			$pre_act_stock=$con->prepare($act_stock);
			if ($pre_act_stock->execute(array($canti,$Idsu,$codi_pro))) {
				//insertar en la tabla ventas
				$insert="INSERT INTO ventas (Id_venta,Numero_ven,Id_cliete_v,Id_produc_v,Descuento,Cantidad_v,Fecha,Total,Id_persona_v,Id_sucu_v) VALUES (?,?,?,?,?,?,?,?,?,?)";
				$pre_ven=$con->prepare($insert);
				if ($pre_ven->execute(array($idcom,$nume_venta,$cliente,$IdPro,$_SESSION["porcentaje"],$canti,$fecha_com,$cos,$Id_pe,$Idsu))) {
						//eliminar la tabla venta temporal
						$eliminar_datos_ve="DELETE FROM venta_morelia WHERE Id_sucu_veta=?";
						$pre_eliminar=$con->prepare($eliminar_datos_ve);
						if ($pre_eliminar->execute(array($Idsu))) {
							header("location:../../Control/con-ventas/ticke_venta.php?venta=$nume_venta&&pagar=$paga&&p=$forma");
							
						}else{
							echo "no se elimino";
						}
				}else{
					echo "no se inserto";
				}

			}else{
				echo "no se actualizo";
			}



          }
		  

		}elseif ($tipocompra=="credito" && isset($_SESSION["des"]) && $paga==0) {
			$cambio=$paga-$_SESSION["des"];
			$abono=$paga-$paga;
		  //seleccionar la tabla de venta
	 	  $mostrar="SELECT *FROM venta_morelia WHERE Id_sucu_veta=?";
          $pre_most=$con->prepare($mostrar);
          $pre_most->execute(array($Idsu));

          while ($r=$pre_most->fetch(PDO::FETCH_ASSOC)) {
          	$x=0;
          	$IdPro=$r['Id_pro_vet'];
          	$codi_pro=$r['Codi_pro_ve'];
            $canti=$r['Cantidad'];
            $nombre=$r['Nombre_ve_pro'];
            $cos=$r['Costo'];

            $s=$x+$r['Costo'];
            $i=$s*$iva;
            $fi=$s+$i;
            $descuento=$_SESSION["porcentaje"]/100*$fi;
			$re=$fi-$descuento;
            
            //actualizar el stock
            $act_stock="UPDATE productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro
				 JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3
				 set Stock=Stock-? WHERE Id_sucu=? AND Codigo_pro=?";
			$pre_act_stock=$con->prepare($act_stock);
			if ($pre_act_stock->execute(array($canti,$Idsu,$codi_pro))) {
				//insertar en la tabla Credito
				$insert="INSERT INTO credito(Id_credito,Id_produc_cre,Abonos,Deuda,Des_cre,Fecha_abono,Fecha_compra,Total_cuenta,Id_sucursal_cre,Id_perso_cre,Id_cliente_cre_p) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
				$pre_ven=$con->prepare($insert);
				if ($pre_ven->execute(array($idcom,$IdPro,$abono,$re,$_SESSION["porcentaje"],$fecha_com,$fecha_com,$re,$Idsu,$Id_pe,$cliente))) {
						//eliminar la tabla venta temporal
						$eliminar_datos_ve="DELETE FROM venta_morelia WHERE Id_sucu_veta=?";
						$pre_eliminar=$con->prepare($eliminar_datos_ve);
						if ($pre_eliminar->execute(array($Idsu))) {
							$v='v';
							$va=password_hash($v,PASSWORD_DEFAULT);
							header("location:../../Vista/Ventas/clientes.php?valor=$va&&cli=$cliente");							
						}else{
							echo "no se elimino";
						}
				}else{
					echo "no se inserto";
				}

			}else{
				echo "no se actualizo";
			}



          }		 	

			
		}else{
			$a=0;
			$va=password_hash($a,PASSWORD_DEFAULT);
			header('location:../../Vista/Ventas/incio-ventas.php?a='.$va.'');//erroe en el pago
		}	

		}else{
			$b=0;
			$vb=password_hash($a,PASSWORD_DEFAULT);
			header('location:../../Vista/Ventas/incio-ventas.php?b='.$vb.'');//El quiete no esta registrado
		}
		
	}else {
		//si la compra es decotado
		if ($tipocompra=="decontado" && isset($_SESSION["des"]) && $paga>=$_SESSION["des"]) {
	    //seleccionar la tabla de venta
	 	 $mostrar="SELECT *FROM venta_morelia WHERE Id_sucu_veta=?";
          $pre_most=$con->prepare($mostrar);
          $pre_most->execute(array($Idsu));

          while ($r=$pre_most->fetch(PDO::FETCH_ASSOC)) {
          	$IdPro=$r['Id_pro_vet'];
          	$codi_pro=$r['Codi_pro_ve'];
            $canti=$r['Cantidad'];
            $nombre=$r['Nombre_ve_pro'];
            $cos=$r['Costo'];

            //actualizar el stock
            $act_stock="UPDATE productos JOIN sucu_pro ON sucu_pro.Id_pro_1=productos.Id_pro
				 JOIN sucursal ON sucursal.Id_sucu=sucu_pro.Id_sucu_3
				 set Stock=Stock-? WHERE Id_sucu=? AND Codigo_pro=?";
			$pre_act_stock=$con->prepare($act_stock);
			if ($pre_act_stock->execute(array($canti,$Idsu,$codi_pro))) {
			//insertar en la tabla ventas normales
			$insert="INSERT INTO ventas_normal(Id_venta_no,Numero_venta_no,Id_pro_nor,Cantidad,Fecha,Total,Id_sucu_no,Id_perso_no)
			VALUES (?,?,?,?,?,?,?,?)";
			$pre_insertar=$con->prepare($insert);
			if ($pre_insertar->execute(array($idcom,$nume_venta,$IdPro,$canti,$fecha_com,$cos,$Idsu,$Id_pe))) {
				$eliminar_datos_ve="DELETE FROM venta_morelia WHERE Id_sucu_veta=?";
				$pre_eliminar=$con->prepare($eliminar_datos_ve);
				if ($pre_eliminar->execute(array($Idsu))) {
					header("location:../../Control/con-ventas/ticke.php?venta=$nume_venta&&pagar=$paga&&p=$forma");
				}else{
					echo "no se elimino";
				}
				
			}else{
				echo "no se inserto";
			}


			}else{
				echo "no se hizo nada y lla valio";
			}

          }

		}else{
			$c=0;
			$vc=password_hash($c,PASSWORD_DEFAULT);
			header('location:../../Vista/Ventas/incio-ventas.php?c='.$vc.'');//El quiete no esta registrado
		}

		
	}	
          
}

 ?>