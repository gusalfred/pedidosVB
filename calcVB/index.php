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
		<title>Calculadora de volumen</title>
    </head>
	<script src="../js/Jquery-3.2.1.js"></script>
	<script src="../js/materialize.js"></script>
	<style>
		body{
			overflow: auto;
		}
		[type="radio"]:checked + label:after,
		[type="radio"].with-gap:checked + label:before,
		[type="radio"].with-gap:checked + label:after {
		  border: 2px solid #ffb300 ;
		}
		
		[type="radio"]:checked + label:after,
		[type="radio"].with-gap:checked + label:after {
		  background-color: #ffb300 ;
		}

	</style>
    <body>
		<!---mediano-->
		<div class="row bglogin1">
			<div class="col m4 offset-m4 s8 offset-s2">
				<img src="../img/logoSdw.png" class="responsive-img">
			</div>
		</div>
		<form class="row container" id="calc" autocomplete="off">
			<div class="col m12 s12 center-align">
				<div class="row">
					<h4 class="left-align">
						<i class="fa fa-lg mdi mdi-package-variant-closed indigo-text"></i>Calculadora de volumen
					</h4>
					<div class="divider "></div>
				</div>
				<div class="row left-align" >
					<div class="col s6">
						 <input name="tipo" type="radio" value="volumen" id="volumen" checked/>
						<label for="volumen">Pies Cúbicos</label>
					</div>
					<div class="col s6">
						 <input name="tipo" type="radio" value="libras" id="libras" />
						<label for="libras">Libras volumétricas</label>
					</div>				
				</div>
				<div class="row left-align">
					<div class="col s6">
						 <input name="unidad" type="radio" value="cm" id="cm" checked/>
						<label for="cm">CM</label>
					</div>	
					<div class="col s6">
						 <input name="unidad" type="radio" value="in" id="in"/>
						<label for="in">IN</label>
					</div>					
				</div>
				<div class="row valign-wrapper">
					<div class="input-field col m4 s12">
						<i class="mdi mdi-arrow-expand prefix" style="transform: rotate(-45deg)"></i>
						<input id="alto" type="text" class="validate" name="alto">
						<label for="alto">Alto (cm)</label>
					</div>
					<i class="mdi mdi-close"></i>
					<div class="input-field col m4 s12">
						<i class="mdi mdi-arrow-expand prefix" style="transform: rotate(45deg)"></i>
						<input id="ancho" type="text" class="validate" name="ancho">
						<label for="ancho">Ancho (cm)</label>
					</div>
					<i class="mdi mdi-close "></i>
					<div class="input-field col m4 s12">
						<i class="mdi mdi-arrow-expand prefix" ></i>
						<input id="largo" type="text" class="validate" name="largo">
						<label for="largo">Largo (cm)</label>
					</div>
				</div>
				<div class="row">
					<h4 class="col s12 amber-text"><span class="total">0</span> <span class="unit">ft<sup>3</sup></span></h4>
					<button class="col m4 offset-m4 s12 btn indigo waves-effect waves-light" type="submit">
						<i class="mdi mdi-calculator"></i>Calcular
					</button>
					<button class="col m4 offset-m4 s12 btn btn-flat waves-effect limpiar" style="display:none">
						<i class="mdi mdi-backspace"></i> Limpiar
					</button>
				</div>
			</div>
		</form>		
    </body>
	<script>
		$(document).ready(function(){
			$('#calc')[0].reset();		//evento q resetea el formulario al cargar la pagina
			//funcion q filtra q se acepten solo numeros en los intputs
			 $("#calc input").keydown(function (e) {
				// Allow: backspace, delete, tab, escape, enter and .
				if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
					 // Allow: Ctrl+A, Command+A
					(e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || 
					 // Allow: home, end, left, right, down, up
					(e.keyCode >= 35 && e.keyCode <= 40)) {
						 // let it happen, don't do anything
						 return;
				}
				// Ensure that it is a number and stop the keypress
				if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
					e.preventDefault();
				}
			});
			});
		//funcion para cambiar la unidad del total
		$('[name="tipo"]').change(function(){
			var valor =$(this).val();
			if(valor==='volumen'){
					$('.unit').html('ft<sup>3</sup>');
				}else{
					$('.unit').html('lb');
				}
			});
		//funcion para cambiar las unidades de las diemnsiones
		$('[name="unidad"]').change(function(){
			var valor =$(this).val();
			if(valor==='cm'){
				$('#calc label').each(function(){
					var txt=$(this).text();
					$(this).text(txt.replace('in','cm'));
					});
				}else{
					$('#calc label').each(function(){
					var txt=$(this).text();
					$(this).text(txt.replace('cm','in'));
					});
				}
			});
		//funcion para calcular
		$('[type="submit"]').click(function(e){
			e.preventDefault();
			var datos=$('#calc').serializeArray();
			if( !$('#calc input[type="text"]').val() ) {
				  $('#calc input').addClass('invalid');
				  return false;
			}else{
				item=[];
				$(datos).each(function(i, field){
					item[field.name] = field.value;
				  });
			}
			
			var total='';
			if(item.tipo ==='volumen'){
				switch(item.unidad){
					case 'cm':
						total=(item.largo*item.alto*item.ancho/1728).toFixed(2); //cálculo cm a pies cubicos
						break;
					case 'in':
						var largo=item.largo*parseFloat(2.59),
						alto= item.alto*parseFloat(2.59),
						ancho=item.ancho*parseFloat(2.59);
						total=(largo*alto*ancho/1728).toFixed(2); //cálculo pulgadas a pies cubicos
				}
			}
			if(item.tipo ==='libras'){
				switch(item.unidad){
					case 'cm':
						var largo2=item.largo*parseFloat(0.393701),
						alto2= item.alto*parseFloat(0.393701),
						ancho2=item.ancho*parseFloat(0.393701);
						total=(largo2*alto2*ancho2/166).toFixed(2); //cálculo CM a libras
						break;
					case 'in':
						total=(item.largo*item.alto*item.ancho/166).toFixed(2); //cálculo pulgadas a libras
						break;
				}
			}
			//console.log(item['tipo']);
			total=total.replace('.',',');		//reemplaza el punto decimal por una coma
			 total = total.replace(/(\d+)(\d{3})/, '$1' + '.' + '$2');		//agrega un punto al pasar los 1000
			//timeout q espera a la animacion de las waves
			setTimeout(function(){
				$('.total').text(total);
				$('[type="submit"]').css('display','none');
				 $('#calc input').prop('disabled',true);
				$('.limpiar').css('display','block');
				},500);
			
			//console.log(total);
			});
		//funcion del boton de limpiar
		$('.limpiar').click(function(e){
			e.preventDefault();
			setTimeout(function(){
					$('#calc')[0].reset(); //resetea el formulario
					$('#calc input').prop('disabled',false);		//habilita los inputs
					$('#calc label').removeClass('active');		//desactiva los label de los inputs
					$('.total').text('0');			//resetea el valor del total
					$('.limpiar').css('display','none');		//oculta el boton de limpiar
					$('.unit').html('ft<sup>3</sup>');		//reestablece la unnidad por defecto del total
					$('[type="submit"]').css('display','block');		//aparece el boton de total
					//reestablece los label a CM(valor por defecto)
					$('#calc label').each(function(){
						var txt=$(this).text();
						$(this).text(txt.replace('in','cm'));
					});
				},300);			
			});
	</script>
</html>