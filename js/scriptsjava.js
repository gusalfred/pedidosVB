$(document).ready(function(){
//TOOLTIP
	$('.tooltipped').tooltip({
		html: 'true',
		position: 'top'
	});
	
//SIDENAV
	$(".button-collapse").sideNav();

//MATERIALBOXED
   $('.materialboxed').materialbox();
   
//MODAL
    $('.modal').modal();
	var ModOrigCntnt=$('#agregar .modal-content').html();
	$('#agregar').modal({
		complete:function(){
			$('#agregar .modal-content').html(ModOrigCntnt);
			num=1;
			//INPUT MASK
			//$('.numero').inputmask("**-******");  //static mask
			$('#numero').val('');
			$('.hiddendiv.common').attr('style','').html('');
		}
		});
//INPUT MASK
$('.numero').inputmask("99999");  //static mask
//modificacion de tamaño de elementos
var docH=$(window).height(); //altura de la ventana
var docW=$(window).width();	//anchura de la ventana
var headerH=$('.bglogin1').not(':hidden').outerHeight();  //altura el "banner"
var table=$('table').height();
$('.bglogin').height(docH); //altura ajustable del fondo del login
//tamaño ajustable de la tabla
if(docW <600){
	$('body').css('height',headerH+table+'px'); //altura ajustable del documento
}else{
	$('body').css('height',headerH+table+'px'); //altura ajustable del documento
	$('.tabla').height(docH-headerH);
}
//listado
lista();
$('.numero').val('');//restablece el input para agregar q por alguna razon se guarda entre refrescos de pagina xD
//FIN DOCUMENT READY
  });

//FUNCIONES EN WINDOWS RESIZE 
$(window).resize(function(){
	var docH=$(window).height();	//altura de la ventana
	var docW=$(window).width();	//anchura de la ventana
	var headerH=$('.bglogin1').not(':hidden').outerHeight(); //aplica el estilo al 'header' q no este oculto
	var table=$('table').height();
	$('.bglogin').height(docH);  //login
	if(docW < 600){
		$('body').css('height',headerH+table+'px'); //altura ajustable del documento
		}else{
			$('body').css('height',headerH+table+'px'); //altura ajustable del documento
			$('.tabla').height(docH-headerH);
		}
	});
//funcion q evita q se muestren automaticmente los botones de edicion de grupos
 $(document).on('mouseenter','.fixed-action-btn',function(){
	
	});
//-----AJAX------
//busqueda
var origContent=$('.tabla').html();
$(document).on('click','.buscar',function(e){
	e.preventDefault();
	var loader=$('#loader').html();
	var termino=$('.numero').not(':hidden').val();
	if(termino!==''){
		$('.tabla').html(loader);
		setTimeout(function(){
		$.ajax({
			url: './process/lista.php',
			type: 'POST',
			data: {busq:termino},
			dataType: 'html',
			success: function(results){
					$('.tabla').html(results);
					$('.search-container').removeClass('m10').addClass('m9');
					$('.search-containerS').removeClass('s12').addClass('s10');
					$('.limpiar').css('display','block');
				},
				error:function(){
					$('.tabla').html(origContent);
					Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
				}
			});		
		},2000);
	}
	
	});
//limpiar resultados
$(document).on('click','.limpiar',function(e){
	e.preventDefault();
	$('.search-container').removeClass('m9').addClass('m10');
	$(this).css('display','none');
	$('.numero').not(':hidden').val('').inputmask("99999").removeClass('valid');
	$('.tabla').html(origContent);
	lista();
	});