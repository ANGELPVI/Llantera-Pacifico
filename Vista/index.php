<?php 
$error=!empty($_GET['error'])?$_GET['error']:'';
if ($error) {
	echo "
		<link rel='stylesheet' type='text/css' href='../Diseño/js/dist/sweetalert.css'>   
         <script type='text/javascript' src='../Diseño/js/jquery-3.1.1.min.js'></script> 
 		 <script type='text/javascript' src='../Diseño/js/dist/sweetalert.min.js'></script>
			<script type='text/javascript'>
				$(document).ready(function(){		
				sweetAlert('Error', 'Usuario o Contraseña no valida.', 'error');
				});
			</script>

		  ";
}

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Index</title>
	<link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="../Diseño/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../Diseño/iconos/fonts/style.css">
	<style>
	*{
		padding: 0;
		margin: 0;
	}
	header{
		width: 100%;
		height: 300px;
		color: #ffffff;
		font-family: 'Anton', sans-serif;
		font-size: 60px;
		text-align: center;
		padding-top: 80px;
}
	
body{
	background: #0575E6;  /* fallback for old browsers */
	background: -webkit-linear-gradient(to bottom, #021B79, #0575E6);  /* Chrome 10-25, Safari 5.1-6 */
	background: linear-gradient(to bottom, #021B79, #0575E6); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
}
.panel{
	background: rgba(56,229,99,0.6);
	max-width: 400px;
	height: 400px;
	box-shadow: 10px 10px 8px black;
	border-radius: 5%;
	
}
span{
	color: #fff;
	font-size: 20px;
}
.panel-heading{
	font-family: 'Arvo', serif;
	font-size: 50px;
	text-align: center;
	color: #fff;
}
.container{
	margin-top:-3px;
}
</style>

</head>
<body>

<header>
	SERVICIOS Y LLANTAS EL PACÍFICO, S.A.
</header>

<div class="container">
	<div class="panel container justify-content-center">
	<div class="panel-heading">Login</div>
	<div class="panel-body">
	<br>
	
		<form action="../Control/iniciar.php" method="post" class="form-horizontal">
		<div class="form-group">
		<label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"><span class="icon-user"></span></label>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		<input type="text" name="usuario" placeholder="Usuario" id="usuario" class="form-control" autofocus>
		</div>
		</div>
	<br><br>
		<div class="form-group">
		<label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"><span class="icon-lock"></span></label>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
		<input type="password" name="contra" placeholder="Contraseña" id="contra" class="form-control" autofocus>
		</div>
		</div>

		<div class="form-group">
		<label class="control-label  col-xs-1 col-sm-1 col-md-1 col-lg-1 col-lg-offset-1"></label>
		<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-lg-offset-7" >
		<input type="submit" value="Iniciar" class="btn btn-success" id="iniciar">
		</div>
		</div>
		</form>
	</div>
	</div>
</div>
<br>
<br>
<script type="text/javascript" src="../Diseño/js/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="../Diseño/js/bootstrap.min.js"></script>
</body>
</html>