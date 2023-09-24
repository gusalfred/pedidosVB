<?php
include("../conf/Conexion.php");
 check_conectado();
 if($sesion_stat=='si'){
	redir('../');
	}?>
<html lang="es">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
		<link rel="stylesheet" type="text/css" href="../fonts/MaterialDesign/css/materialdesignicons.min.css" media="all"  />
		<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.css"  media="all"/>
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/animate.css">
		<link rel="icon"  type="image/png"  href="../img/logo.png">
		<title>Seguimiento de pedidos</title>
    </head>
	<script src="../js/Jquery-3.2.1.js"></script>
	<script src="../js/materialize.min.js"></script>
    <body>
        <div class="row bglogin">
            <div class="col s12 m4 offset-m4 center-align" style="margin-top: 2%">
				<div class="card">
					<div class="card-image ">
						<img class="responsive-img" src="../img/logo.png">
					</div>
					<div class="card-content">
						<div class="input-field s12 ">
							<i class="mdi mdi-account-circle prefix"></i>
							<input id="user" type="email" class="validate" data-tooltip="ingrese una direccion de correo válida">
							<label for="user">Usuario</label>
						</div>
						<div class="input-field s12">
							<i class="mdi mdi-key prefix"></i>
							<input id="key" type="password" class="validate">
							<label for="key">Contraseña</label>
						</div>
					</div>
					<div class="card-action">
						<button id="login" class="btn  yellow accent-2 waves-effect waves-light black-text">Enviar <i class="mdi mdi-login-variant"></i></button>
					</div>
				</div>
            </div>
        </div>
    </body>
	<script src="../js/motio.js"></script>
    <script src="../js/scriptsjava.js"></script>
</html>