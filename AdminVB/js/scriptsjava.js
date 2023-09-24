//funciones predefinidas
function lista(){
	$.ajax({
		url : "./process/lista.php", 
		type : "get", 
		dataType: 'html',
		success: function(info){
			$('.tabla').html(info);		
			},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>  Error al listar!',4000,'red');
			}
	});
}
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
    $('.modal').modal(); //activacion de modals
	var ModOrigCntnt=$('#agregar .modal-content').html(); //contenido original del modal de agregar
	var Modeditorig=$('.dropBtn2').html(); //contenido original del modal de agregar
	//eventos del modal de insercion 
	$('#agregar').modal({
		ready:function(){//ocultar los botones del fab al abrirse de primero
			$('.fixed-action-btn ul').css('display','none');
			$('.checkB').prop('checked',false);
			},
		complete:function(){
			$('#agregar .modal-content').html(ModOrigCntnt);
			num=1;
			$('#numero').val('');
			$('.hiddendiv.common').attr('style','').html('');
		}
		});
	//eventos del modal de edicion individual
	$('#editar').modal({
		complete:function(){
			$('.dropBtn2').html(Modeditorig);
		}
		});
	//eventos del modal de edicion grupal
	$('#editarG').modal({
		complete:function(){
			$('.dropBtn2').html(Modeditorig);
			$('.chips').html('');
		}
		});
	//eventos del modal de edicion grupal
	$('#deleteG').modal({
		complete:function(){
			$('.chips-del').html('');
			//Group_edit=[];
		}
		});
//INPUT MASK
$('.numero').inputmask("99999");  //static mask
//modificacion de tamaño de elementos
var docH=$(window).height(); //altura de la ventana
var docW=$(window).width();	//anchura de la ventana
var headerH=$('.bglogin1').not(':hidden').outerHeight();  //altura el "banner"
var table=$('table').height(); //altura de la tabla
$('.bglogin').height(docH); //altura ajustable del fondo del login
//tamaño ajustable de la tabla
if(docW <600){
	$('body').css('height',headerH+table+'px'); //altura ajustable del documento
	$('.btn-floating').removeClass('btn-large');
}else{
	$('body').css('height',headerH+table+'px'); //altura ajustable del documento
	$('.tabla').height(docH-headerH);
	$('.fixed-action-btn > a').addClass('btn-large');
}
//listado
lista();
$('.numero').val('');//restablece el input para agregar q por alguna razon se guarda entre refrescos de pagina xD

$(document).bind('input','#numero', function(){
	$(this).val();
	$('#numero').trigger('autoresize');
	});
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
		$('.fixed-action-button a').removeClass('btn-large');
		}else{
			$('body').css('height',headerH+table+'px'); //altura ajustable del documento
			$('.tabla').height(docH-headerH);
			$('.fixed-action-btn > a').addClass('btn-large');
		}
	});
//-----AJAX------

//funcion de validacion para login
/*var btnContnt=$('#login').html();  //contenido original del boton
$('#login').on('click', function(){
	$(this).html('<i class="mdi mdi-loading fa fa-spin"></i>').attr('disabled',true);   //contenido secundario del boton	
	
	//variable q almacena cuantos input necesarios para el registro estan llenos o vacios
	var vacio=$('.card-content input').filter(function(){
    return !$(this).val();
				}).length;
	var lleno=$('.card-content input').not('.invalid').filter(function(){
	return this.value.length >0;
			}).length;
	
		//funcion q resalta los campos vacios
		$('.card-content input').each(function(n,element){
			if ($.trim(element.value).length <3 || $(element).is(':invalid')) {
					$(element).addClass('invalid').tooltip({tooltip:'Debe poseer al menos 3 caracteres'});
					//alert('Field '+element.name+' must have a value');
				}else{
						$(element).removeClass('invalid').tooltip('remove');
					}
		  });
	
	var total=lleno-vacio;
	//alert(lleno+'-'+vacio);
	if(total =='2'){
		$.ajax({
				url : "./process/login.php", 
				type : "POST", 
				data : $('.card-content input').serialize(),
				dataType: 'json',
				success: function(info){
					if(info.respuesta==='si'){
						$('#login').html(btnContnt).attr('disabled',false);
						$('#modal1').modal('close');
						Materialize.toast('<i class=" mdi mdi-check"></i> ¡Gracias! Nos pondremos en contacto con tigo cuando podamos',4000,'green');
						}				
					},
				error:function(){
					$('#contentModal').css('opacity','1');
					$('#login').html(btnContnt).attr('disabled',false);
					Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>  Fuck!',4000,'red');
					}
			});
	}else{
		setTimeout(function(){
			$('#login').html(btnContnt).attr('disabled',false);
			Materialize.toast('<i class="mdi mdi-eye"></i><b>!</b> Debe llenar todos los campos',4000,'red');			
			return false;
			},1000);		
		}	
	});*/

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
	$('.numero').val('').inputmask("99999").removeClass('valid');
	$('.tabla').html(origContent);
	lista();
	});
//contar elementos pegados o insertados de lista de ingreso
$(document).bind('input','#numero',function(){
	var lines = $('#numero').val().split(/\n/);
	var textsN =[];
	setTimeout(function () { 
		for (var i=0; i < lines.length; i++) {
		  // only push this line if it contains a non whitespace character.
		  if (/\S/.test(lines[i])) {
			textsN.push($.trim(lines[i]));
		  }
		}
		$('#numero').val();
		$('#numero').trigger('autoresize');
		$('.total').text(textsN.length);
    }, 100);
});
//insercion
$('#insert').on('click',function(){
	var valor=$('#numero').val();
	$('#numero').attr('disabled',true);
	if(valor !==''){
		//creacion del array de la lista para su empaquetado de envio
		var lines = $('#numero').val().split(/\n/);
		var textsN =[];
		for (var i=0; i < lines.length; i++) {
		  // only push this line if it contains a non whitespace character.
		  if (/\S/.test(lines[i])) {
			textsN.push($.trim(lines[i]));
		  }
		}
		//envio por ajax
		$.ajax({
		url : "./process/insert.php", 
		type : "POST", 
		data : {numero:textsN},
		dataType: 'json',
		success: function(insert){
			switch(insert.stat){
				case 'ok':
					$('#agregar').modal('close');
					lista();
					Materialize.toast(insert.msg,4000,'green');
					break;
				case 'error':
					lista();
					Materialize.toast(insert.msg,5000,'red');
					break;
				case 'repetido':
					lista();
					Materialize.toast(insert.msg,10000,'amber');
					break;
			}
			$('#numero').attr('disabled',false);
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
			}
		});
	}else{
		$('#insertFrom .input-field .validate').addClass('invalid');
		Materialize.toast('<i class="fa fa-lg mdi mdi-eye"></i><b>!</b>&nbsp  llene el campo',4000,'red');
	}
	});
///seleccion
var checked = []; //varaiable array para el grupo seleccionado
var nBox=0;
if(nBox > 1){
		$('.fixed-action-btn ul').css('display','block');
		$('.fixed-action-btn').openFAB();
	}else{
		$('.fixed-action-btn ul').css('display','none');
		$('.fixed-action-btn').closeFAB();
	}
//checkbox q chequea a todos los demas
$(document).on('change','#checkall',function(){
	if(this.checked){
		$('.checkB').prop('checked',true);
		checked=[];
		$("input[name='idS[]']:checked").each(function (){
			checked.push($(this).val());
		});
	}else{
		$('.checkB').prop('checked',false);
		checked=[];
		$("input[name='idS[]']").each(function (){
			checked.splice($.inArray($(this).val()),1);
		});
	}
	//conteo para mostrar el menu del FAB
	var nBox=$(checked).length;
	if(nBox > 1){
		$('.fixed-action-btn ul').css('display','block');
		$('.fixed-action-btn').openFAB();
	}else{
		$('.fixed-action-btn ul').css('display','none');
		$('.fixed-action-btn').closeFAB();
	}
	});
//llamada de la funcion d conteo al chequear un checkbox
$(document).on('change','.checkB',function(){
	if(this.checked){
		checked.push($(this).val());		//si es chequeado lo agrega al array
	}else{
		checked.splice($.inArray($(this).val(),checked),1);		//si lo deschequean lo elimina del array
	}
	//conteo para mostrar el menu del FAB *otra vez*
	var nBox=$(checked).length;
	if(nBox > 1){
		$('.fixed-action-btn ul').css('display','block');
		$('.fixed-action-btn').openFAB();
	}else{
		$('.fixed-action-btn ul').css('display','none');
		$('.fixed-action-btn').closeFAB();
	}
});
//editar---individual
$(document).on('click','[data-edit]',function(){
	var este=$(this);
	var edit=$(this).attr('data-edit');  //captura el id del regisro a editar
	var btnIcon=$(this).children('i').attr('class');		//captura contenido original del boton
	$('#update').attr('data-up',edit);  //guarda el id en un atributo dentro del boton de actualizar
		$(this).children('i').attr('class','fa fa-spin fa-circle-o-notch grey-text text-darken-3');  //icono con animacion de carga
	$.ajax({
		url: './process/insert.php',
		type: 'POST',
		data: {id_edit:edit},
		dataType: 'json',
		success:function(datEdit){
			$('#Npedido').text(datEdit.name_cons);  //nombre en el titulo
			switch(datEdit.stat_cons){				//switch para el estado dependiendo de lo que reciba
				case 'Panamá':
					$('#update').attr('data-val','1');  //guarda el valor en un atributo dentro del boton de actualizar
					$('.dropdown-button').html($('#dropdown1 .1').html());
					break;
				case 'En curso':
					$('#update').attr('data-val','2');  //guarda el valor en un atributo dentro del boton de actualizar
					$('.dropdown-button').html($('#dropdown1 .2').html());
					break;
				case 'Venezuela':
					$('#update').attr('data-val','3');  //guarda el valor en un atributo dentro del boton de actualizar
					$('.dropdown-button').html($('#dropdown1 .3').html());
					break;
			}
			setTimeout(function(){
				$(este).children('i').attr('class',btnIcon);  //restaura contenido priginal del boton
				$('#editar').modal('open');						//abre el modal de edicion
				},500);
			
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
			$(this).children('i').attr('class',btnIcon);
		}
		});
	});
//editar---grupal---
var Group_edit=[];//variable q contiene el arreglo json devuelto por la consulta php para usarlo en otras funciones,
//en el modal, la edicion y eliminacion 
$(document).on('click','.editgroup',function(){
	var este=$(this);
	var groupE=checked; //variable q contiene el grupo de elementos seleccionados devueltos por la funcion de seleccion
	var btnIcon=$(this).children('i').attr('class');		//captura contenido original del boton
	$(this).children('i').attr('class','fa fa-spin fa-circle-o-notch white-text');  //icono con animacion de carga
	$.ajax({
		url:'./process/actions_group.php',
		type: 'post',
		data: {editG:groupE},
		dataType: 'json',
		success:function(group){
			$('#GNpedido').text(group.Gtotal);
			$(este).children('i').attr('class',btnIcon);  //restauracion de icono
			$.each(group,function(variable,valor){
				if(variable!=='Gtotal'){		//condicion q evita q se agregue el contador
					$('.chips').append('<div class="chip">'+valor+'</div>'); //agrega los 'chips'
					Group_edit.push(valor);
				}				
				});
			$('#editarG').modal('open'); //abre el modal de edicion grupal
				//console.log(Group_edit);
		}
		});
	});
//drowpdow as select
$(document).on('click','.dropdown-content li',function(e){
	e.preventDefault();
	var content=$(this).html();
	var value=$(this).attr('class');
	$('.dropdown-button').html(content);
	switch(value){
		case '1':
			$('#update,#updateG').attr('data-val',value);  //guarda el valor en un atributo dentro del boton de actualizar
			break;
		case '2':
			$('#update,#updateG').attr('data-val',value);  //guarda el valor en un atributo dentro del boton de actualizar
			break;
		case '3':
			$('#update,#updateG').attr('data-val',value);  //guarda el valor en un atributo dentro del boton de actualizar
			break;
	}
	});
//---actualizar---individual---
$('#update').on('click',function(){
	var idUp=$(this).attr('data-up');
	var value=$(this).attr('data-val');
	$.ajax({
		url: './process/insert.php',
		type: 'POST',
		data: {id_update:idUp,state:value},
		dataType: 'json',
		success:function(update){
			if(update.stat==='ok'){
				$('#editar').modal('close'); 	//cierra el modal de edicion
				lista();
			}
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
		}
		});
	});
//Actualizar---grupal---
$('#updateG').on('click',function(){
	var idUpG=Group_edit;		//variable a va a contener el array
	var value=$(this).attr('data-val');		//variable con el valor de la seleccion
	$('#updateG i').addClass('fa fa-spin');
	$(this).prop('disabled',true);
	$.ajax({
		url: './process/actions_group.php',
		type: 'POST',
		data: {id_update:idUpG,state:value},
		dataType: 'json',
		success:function(updateG){
			$('#updateG').prop('disabled',false);
			//setTimeout(function(){
				if(updateG.stat==='ok'){
					$('#updateG i').removeClass('fa fa-spin');
					$('#editarG').modal('close'); 	//cierra el modal de edicion
					Materialize.toast('<i class="fa fa-lg mdi mdi-check-circle-outline"></i>&nbsp Registros actualizados',2000,'green');
					lista();
				}
				//},1000);
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
		}
		});
	});
//--eliminar consulta--individual
$(document).on('click','[data-del]',function(){
	var del=$(this).attr('data-del');  //captura el id del regisro a eliminar
	$('#deletebtn').attr('data-eli',del);
	$.ajax({
		url: './process/insert.php',
		type: 'POST',
		data: {id_edit:del},
		dataType: 'json',
		success:function(datDelete){
			$('#NPedidoDel').text(datDelete.name_cons);  //nombre en el titulo
			$('#delete').modal('open');
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
		}
		});
});
//--eliminar confirmacion--indicidual
$('#deletebtn').on('click',function(){
	var idDel=$(this).attr('data-eli');
	$.ajax({
		url: './process/insert.php',
		type: 'POST',
		data: {id_Del:idDel},
		dataType: 'json',
		success:function(dataDel){
			if(dataDel.stat==='ok'){
				$('#delete').modal('close'); 	//cierra el modal de edicion
				lista();
				Materialize.toast('<i class=" mdi mdi-check-circle-outline"></i>&nbsp Eliminado',4000,'green');
			}
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
		}
		});
	});
//--eliminar consulta--grupal
$(document).on('click','.deletegroup',function(){
	var groupDel=checked; //captura el array de los elementos a eliminar
	var este=$(this);
	var btnIcon=$(this).children('i').attr('class');		//captura contenido original del boton
	$(this).children('i').attr('class','fa fa-spin fa-circle-o-notch white-text');  //icono con animacion de carga
	$.ajax({
		url: './process/actions_group.php',
		type: 'POST',
		data: {editG:groupDel},
		dataType: 'json',
		success:function(datDelGroup){
			$('#Ndel').text(datDelGroup.Gtotal);
			$(este).children('i').attr('class',btnIcon);  //restauracion de icono
			$.each(datDelGroup,function(variable,valor){
				if(variable!=='Gtotal'){		//condicion q evita q se agregue el contador
					$('.chips-del').append('<div class="chip red white-text">'+valor+'</div>'); //agrega los 'chips'
					Group_edit.push(valor);
				}				
				});
			$('#deleteG').modal('open'); //abre el modal de edicion grupal
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
		}
		});
});
//--eliminar confirmacion--grupal
$('#delgroupbtn').on('click',function(){
	var groupDel=countBox(); //captura el array de los elementos a eliminar
	$.ajax({
		url: './process/actions_group.php',
		type: 'POST',
		data: {DelG:groupDel},
		dataType: 'json',
		success:function(dataDel){
			if(dataDel.stat==='ok'){
				$('#deleteG').modal('close'); 	//cierra el modal de edicion
				lista();
				Materialize.toast('<i class=" mdi mdi-check-circle-outline"></i>&nbsp Eliminado',4000,'green');
			}
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error'+dataDel.stat,4000,'red');
		}
		});
	});