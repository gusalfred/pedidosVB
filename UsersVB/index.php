<?php
include("../conf/Conexion.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no"/>
		<link rel="stylesheet" type="text/css" href="../fonts/MaterialDesign/css/materialdesignicons.min.css" media="all"  />
		<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="../css/materialize.css"  media="all"/>
		<link rel="stylesheet" href="../fonts/flags.css/css/flag-icon.min.css">
		<link rel="stylesheet" type="text/css" href="../css/style.css" />
		<link rel="stylesheet" type="text/css" href="../css/animate.css">
		<link rel="icon"  type="image/png"  href="../img/logoVB.png">
		<title>Registro de Usuarios</title>
    </head>
	<script src="js/Jquery-3.2.1.js"></script>
	<script src="js/materialize.js"></script>
	<script src="../libs/Inputmask/dist/jquery.inputmask.bundle.js"></script>
	<script src="js/phone.js"></script>
	<style>
		body{
			overflow-y: auto;
		}
		.bglogin1{
			background-image: url('../img/shipping2.jpg');
		}
		#telflabel:after{
			content: "";
			opacity: 0;
		   }
		#telflabel.valid:after{
			content: attr(data-content);
			opacity: 1;
		}
		#telfOfilabel:after{
			content: "";
			opacity: 0;
		   }
		#telfOfilabel.valid:after{
			content: attr(data-content);
			opacity: 1;
		}
		.bg{
			background-image: url('../img/register.jpg');
			background-size: cover;
			padding-bottom: 5%;
			background-position: 30% 50%;
		}
		/*RADIOS*/
		[type="radio"]:checked + label,
		[type="radio"].with-gap:checked + label,
		[type="radio"].with-gap:checked + label {
		  color: #3f51b5 ;
		}
		[type="radio"]:checked + label:after,
		[type="radio"].with-gap:checked + label:before,
		[type="radio"].with-gap:checked + label:after {
		  border: 2px solid #3f51b5 ;
		}
		
		[type="radio"]:checked + label:after,
		[type="radio"].with-gap:checked + label:after {
		  background-color: #3f51b5 ;
		}
		.select-wrapper span.caret {
			color: #3f51b5;
			font-size: 15px;
			line-height: 15px;
		  }
	</style>
    <body>
		<div class="row bglogin1">
				<div class="col s12 m3 offset-m4">
					<img src="../img/logoSdw.png" class="responsive-img">
				</div>
			</div>
		<div class="bg" >
			<div class="row">
				<h5 class="indigo-text text-accent-3 col s12 center-align">
					<i class="mdi mdi-pencil-circle-outline fa fa-lg"></i> Llene el formulario y recibirá un correo con su código de Venbox para realizar sus compras
				</h5>
			</div>
			<div class="container">
				<form class="row" id="usrReg" >
					<div class="input-field col m6 s12">
						<input  id="nombre" type="text" class="validate" name="nombre">
						<label for="nombre">Nombre <span class="red-text">*</span></label>
					</div>
					<div class="input-field col m6 s12">
						<input  id="apellido" type="text" class="validate" name="apellido">
						<label for="apellido">Apellido <span class="red-text">*</span></label>
					</div>
					<div class="input-field col m6 s12">
						<input  id="id" type="text" class="validate" name="id">
						<label for="id">Documento de Identidad <span class="red-text">*</span></label>
					</div>
					<div class="input-field col m6 s12">
						<input  id="correo" type="text" class="validate correo" name="correo">
						<label for="correo">Correo <span class="red-text">*</span></label>
					</div>
					<div class="input-field col m6 s12">
						<input  id="telf" type="text" class="validate telf" name="telf">
						<label for="telf" id="telflabel">Teléfono <span class="red-text">*</span> <span id="flagtelf"></span></label>
					</div>
					<div class="input-field col m6 s12">
						<input  id="telfOfi" type="text" class="validate telf" name="telfOfi">
						<label for="telfOfi" id="telfOfilabel">Teléfono Oficina <span class="red-text">*</span> <span id="flagtelfOfi"></span></label>
					</div>
					<div class="input-field col m4 s12">
						<select name="pais" class="countries" id="countries">
							<option value=''></option>
						</select>
						<label for="country">País <span class="red-text">*</span></label>
					</div>
					<div class="input-field col m4 s12">
						<select name="states" class="states" id="state">
							<option value=''></option>
						</select>
						<label for="state">Estado <span class="red-text">*</span></label>
					</div>
					<div class="input-field col m4 s12">
						<select name="cities" class="cities">
							<option value=''></option>
						</select>
						<label>Ciudad <span class="red-text">*</span></label>
					</div>
					<div class="input-field col s12 m12">
						<textarea id="address" class="materialize-textarea validate" name="address"></textarea>
						<label for="address">Dirección</label>
					</div>
					<div class=" col s12 m12 center-align" style="margin-bottom:3%">
						<p class="center-align"> ¿Eres cliente Super-Extra®?</p>
						<input name="cliente" type="radio" value="no" id="no" checked/>
						<label for="no" style="padding-right: 3%">no</label>
						<input name="cliente" type="radio" value="si" id="si"/>
						<label for="si" >si</label>
					</div>
					<div class="input-field col s12 m4 offset-m4" id="cliente" style="display: none">
						<i class="prefix mdi mdi-seal"></i>
						<input id="code" type="text" class=validate" name="code">
						<label for="code">Ingresa tu código</label>
					</div>
					<div class="col s12 center-align">
						<small >El tiempo de entrega es un estimado y no representa promesa alguna. Nuestra empresa se compromete a hacer todo lo posible
						para completar la entrega a tiempo. Esta prohibido el envío de líquidos corrosivos, armas de fuego y material pornográfico.
						En caso de pérdida de un paquete, el seguro se compromete a pagar el 100% del valor asegurado. En caso de pérdida parcial o
						daños el seguro se compromete a pagar lo proporcional al valor asegurado. Todos los paquetes estan sujetos a inspección y
						rastreo de los mismos.</small>
					</div>
					<div class="col s12 ">
						<p class="center-align">
							<input type="checkbox" id="ok" name="ok">
							<label for="ok">Estoy de acuerdo</label>
						</p>
					</div>
					<div class="divider col s12" style="margin-bottom:2%;margin-top:2%; background-color: #616161"></div>
					<button class="btn yellow accent-4 black-text waves-effect waves-orange col s6 m3 offset-m2" id="insert">
						<i class="mdi mdi-cube-send"></i> Enviar
					</button>
					<button class="btn grey lighten-2 grey-text text-darken-3 waves-effect waves-yellow col s6 m3 offset-m2 " id="resetF">
						<i class="mdi mdi-backspace"></i> Resetear
					</button>
				</form>
			</div>
		</div>
		
		<!--loader-->
		<div id="loader" style="display:none">
			<div class="preloader-wrapper active" style="position: absolute; top:50%; left:50%;z-index: 2">
				<div class="spinner-layer spinner-blue-only">
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
		<!--msg de ok-->
		<div class="ok" style="display:none">
			<div class="row ">
				<div class="col s12 center-align">
					<h4 class="allcenter indigo-text text-accent-3"><i class="mdi mdi-checkbox-marked-circle-outline fa fa-2x"></i><br>¡Listo!<br>
					<small class="black-text"><small>Se te ha enviado un correo con tu código de VenBox para realizar tu pedidos.</small></small>
					<button class="col s4 offset-s4 btn yellow accent-2 black-text volver"><i class="mdi mdi-arrow-left"></i> Volver</button>
					</h4>
				</div>
			</div>
		</div>
    </body>
	<script src="js/scriptsjava.js"></script>
	<script src="../libs/cities-dropdown/js/location.js"></script>
</html>