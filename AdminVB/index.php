<?php
include("../conf/Conexion.php");
$lista=mysqli_query($Conexion,"select * from pedido where eliminado='no' order by id_pedido");
$count=mysqli_num_rows($lista);
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
		<link rel="stylesheet" href="../css/animate.css">
		<link rel="icon"  type="image/png"  href="../img/logoVB.png">
		<title>Seguimiento de pedidos</title>
    </head>
	<script src="js/Jquery-3.2.1.js"></script>
	<script src="js/materialize.js"></script>
    <body>
		<!--peuqeño-->
		<div class="row bglogin1 hide-on-med-and-up">
			<div class="col s12">
				<img src="../img/logoSdw.png" class="responsive-img">
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
					<button class="col s2 clean btn btn-flat waves-effect waves-yellow limpiar tooltipped" data-tooltip="Limpiar busqueda" data-position="top" data style="display:none">
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
				<img src="../img/logoSdw.png" class="responsive-img">
			</div>
			<div class="col m8 ">
				<form class="row card-panel white valign-wrapper" >
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
			
		</div>
		<!--FAB-->
		<div class="fixed-action-btn click-to-toggle">
			<a class="btn-floating yellow accent-2  tooltipped waves-effect waves-light" data-tooltip="Agregar pedidos" data-position="left" href="#agregar">
			  <i class=" mdi mdi-plus grey-text text-darken-4"></i>
			</a>
			<ul>
				<li><a class="btn-floating light-blue tooltipped editgroup" data-tooltip="Modificar pedidos" data-position="left"><i class="mdi mdi-pencil"></i></a></li>
				<li><a class="btn-floating amber darken-4 tooltipped deletegroup" data-tooltip="Eliminar pedidos" data-position="left"><i class="mdi mdi-delete"></i></a></li>
			  </ul>
		 </div>
		<!--modal-->
			<div id="agregar" class="modal modal-fixed-footer" style="display:none">
				<div class="modal-content row center-align">
					<b>N° de registros: <span class="total">1</span></b><br>
					<form id="insertFrom" class="col m12 s12">
						<div class="input-field" id="campo1">
							<i class="mdi mdi-playlist-plus prefix"></i>
							<textarea id="numero" class="validate materialize-textarea "></textarea>
							<label for="id">Pedidos</label>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button id="insert" class=" waves-effect waves-light btn yellow accent-2 black-text"><i class="mdi mdi-arrow-down"></i>insertar</button>
				</div>
			</div>
			<!--modal edicion individual-->
			<div id="editar" class="modal" style="display: none">
				<div class="modal-content center-align individual">
					<h4><small class="grey-text"><i class="mdi mdi-pencil"></i> Editar Pedido:</small> <span id="Npedido"></span></h4>
					<p>Estado:</p>
					<div class="row">
							<!-- Dropdown Trigger -->
							<button class='dropdown-button btn btn-large grey lighten-2 col s12 m12 waves-effect black-text' data-activates='dropdown1'>
								Estado
							</button>
							<!-- Dropdown Structure -->
							<ul id='dropdown1' class='dropdown-content'>
							  <li class="1"><a href="#!"><i class="flag-icon flag-icon-pa"></i> Panamá</a></li>
							  <li class="2"><a href="#!"><i class="fa fa-lg mdi mdi-truck-fast amber-text"></i> En Camino</a></li>
							  <li class="3" ><a href="#!">Venezuela <i class="flag-icon flag-icon-ve"></i></a></li>
							</ul>
					</div>						
					<button id="update" class="waves-effect waves-light btn green" data-up="" data-val=""><i class="mdi mdi-autorenew"></i>Actualizar</button>
				</div>					
			</div>
			<!--modal edicion grupo-->
			<div id="editarG" class="modal" style="display: none">
				<div class="modal-content center-align grupal">
					<h4>
						<small class="grey-text"><i class="mdi mdi-pencil"></i> Editar</small>
						<span id="GNpedido" class="black-text">0</span>
						<small class="grey-text">Pedidos</small>
					</h4>
					<div class="row">
						<!--chips-->
							<div class="chips chips-initial" style="max-height: 10em;overflow-y: scroll"></div>
					</div>
					<div class="row">
							<!-- Dropdown Trigger -->
							<button class='dropdown-button btn btn-large grey lighten-2 col s12 m12 waves-effect black-text dropBtn2' data-activates='dropdown2'>
								Estado
							</button>
							<!-- Dropdown Structure -->
							<ul id='dropdown2' class='dropdown-content'>
							  <li class="1"><a href="#!"><i class="flag-icon flag-icon-pa"></i> Panamá</a></li>
							  <li class="2"><a href="#!"><i class="fa fa-lg mdi mdi-truck-fast amber-text"></i> En Camino</a></li>
							  <li class="3" ><a href="#!">Venezuela <i class="flag-icon flag-icon-ve"></i></a></li>
							</ul>
					</div>	
					<button id="updateG" class="waves-effect waves-light btn green" data-up="" data-val=""><i class="mdi mdi-autorenew"></i>Actualizar</button>
				</div>		
			</div>
			
			<!--modal delete individual-->
			<div id="delete" class="modal" style="display:none">
				<div class="modal-content center-align" >
					<h4>
						<small class="grey-text"><i class="fa fa-3x mdi mdi-alert-outline amber-text"></i><br> Esta seguro que desea eliminar el pedido:</small>
						<br><span id="NPedidoDel"></span>
					</h4>			
					<button id="deletebtn" class="waves-effect waves-light btn red" data-eli=""><i class="mdi mdi-close-octagon-outline"></i> Eliminar</button>
				</div>					
			</div>
			
			<!--modal delete grupal-->
			<div id="deleteG" class="modal" style="display:none">
				<div class="modal-content center-align" >
					<h4>
						<small class="grey-text"><i class="fa fa-3x mdi mdi-alert-outline amber-text"></i><br> Esta seguro que desea eliminar los siguientes <span id="Ndel">0</span> pedidos:</small>
					</h4>
					<div class="row">
						<!--chips-->
							<div class="chips chips-del" style="max-height: 10em;overflow-y: scroll"></div>
					</div>
					<button id="delgroupbtn" class="waves-effect waves-light btn red" ><i class="mdi mdi-close-octagon-outline"></i> Eliminar</button>
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
	<script src="../libs/Inputmask/dist/jquery.inputmask.bundle.js"></script>
    <script src="js/scriptsjava.js"></script>
</html>