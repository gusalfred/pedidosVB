<?php
include("conf/Conexion.php");
$lista=mysqli_query($Conexion,"select * from pedido where eliminado='no' order by id_pedido");
$count=mysqli_num_rows($lista);
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
		<link rel="stylesheet" type="text/css" href="fonts/MaterialDesign/css/materialdesignicons.min.css" media="all"  />
		<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/materialize.css"  media="all"/>
		<link rel="stylesheet" href="fonts/flags.css/css/flag-icon.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" href="css/animate.css">
		<link rel="icon"  type="image/png"  href="img/logoVB.png">
		<title>Seguimiento de pedidos</title>
    </head> 
	<script src="js/Jquery-3.2.1.js"></script>
	<script src="js/materialize.js"></script>
    <body>
		<!--peuqeño-->
		<div class="row bglogin1 hide-on-med-and-up">
			<div class="col s12">
				<img src="img/logoSdw.png" class="responsive-img">
			</div>
			<form class="col s12 formbusq">
				<div class="row card-panel white valign-wrapper">
					<div class="col s12 search-containerS">
						<div class="input-field search">
							<i class="mdi mdi-magnify prefix"></i>
							<input id="idBusq" type="text" class="validate numero" placeholder="99999">
							<label for="idBusq">Código</label>
						</div>
					</div>
					<button class="col s2  clean btn btn-flat waves-effect waves-yellow limpiar tooltipped" data-tooltip="Limpiar busqueda" data-position="top" data style="display:none">
						<i class="mdi mdi-backspace"></i>
					</button>
					<div class="col s5 center-align">
						<button type="submit" class="btn yellow accent-2 black-text waves-effect waves-orange buscar">Buscar</button>
					</div>
				</div>
			</form>
		</div>
		<!---mediano-->
		<div class="row bglogin1 valign-wrapper hide-on-med-and-down">
			<div class="col m4">
				<img src="img/logoSdw.png" class="responsive-img">
			</div>
			<div class="col m8 ">
				<form class="row card-panel white valign-wrapper formbusq">
					<div class="col m10 search-container">
						<div class="input-field">
							<i class="mdi mdi-magnify prefix"></i>
							<input id="idBusq" type="text" class="validate numero"  placeholder="99999">
							<label for="idBusq">Código</label>
						</div>
					</div>
					<button class="col m1 clean btn btn-flat waves-effect waves-yellow limpiar tooltipped" data-tooltip="Limpiar busqueda" data-position="top" data style="display:none">
						<i class="mdi mdi-backspace"></i>
					</button>
					<div class="col m2">
						<button type="submit" class="btn yellow accent-2 black-text waves-effect waves-orange buscar">Buscar</button>
					</div>
				</form>
			</div>
		</div>	
		<div class="row tabla">
			<!---contenido de la tabla-->
			<div class="center-align">
				<p style="font-size: x-large;" class="indigo-text "><i class="fa fa-5x mdi mdi-search-web "></i><br>Búsqueda</p>
			</div>  
		</div>
		<!--loader-->
		<div id="loader" style="display:none">
			<div class="preloader-wrapper active" style="left:50%;margin-top:10% !important">
				<div class="spinner-layer spinner-red-only">
				  <div class="circle-clipper left">
					<div class="circle"></div>
				  </div><div class="gap-patch">
					<div class="circle"></div>
				  </div><div class="circle-clipper right">
					<div class="circle"></div>
				  </div>
				</div>
			</div>
		</div>
    </body>
	<script src="libs/Inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/scriptsjava.js"></script>
</html>