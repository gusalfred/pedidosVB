$('form')[0].reset();
var vacios='0';		//variable para los campos vacios
var llenos='0';		//variable para los campos llenos
$(document).ready(function(){
	
//TOOLTIP
	$('.tooltipped').tooltip({
		html: 'true',
		position: 'top'
	});
	
//SIDENAV
	$(".button-collapse").sideNav();
//COLLPASIBLE
 //$('.collapsible').collapsible();
//SELECT
 //$('select').material_select();

 //TEXTAREA
 $('textarea').trigger('autoresize');
//MODAL
    $('.modal').modal(); //activacion de modals
	
//INPUT MASK
	
$('#nombre, #apellido').inputmask('a{1,20}[ a{1,20}]',{
	showMaskOnHover: false,
	greedy:false
	});
$('#code').inputmask('*{1,12}',{showMaskOnHover: false});
//mask para correo
 $('.correo').inputmask({
	showMaskOnHover: false,
    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}.*{2,6}[.*{1,2}]",
    greedy: false,
    onBeforePaste: function (pastedValue) {
      pastedValue = pastedValue.toLowerCase();
      return pastedValue.replace("mailto:", "");
    },
    definitions: {
      '*': {
        validator: "[0-9A-Za-z!#$%*+/?^_`|\-]",
        cardinality: 1,
        casing: "lower"
      }
    },
	onincomplete:function(){
		//alert('debe ingresar una dirección de correo completa');
		vacios++;
		$('.correo').removeClass('valid').addClass('invalid');
	},
	oncomplete:function(){
		vacios--;
	}
  });
 //mask para telefono
	 $('.telf').inputmask("phone", {
		showMaskOnHover: false,
		oncleared: function(){
			var id=$(this).attr('id');
			$('label[for="'+id+'"]').removeClass('valid');
			$('#flag'+id).attr('class','');
			},
		onKeyValidation: function () { 
			var id=$(this).attr('id');
			var pais=$(this).inputmask('getmetadata').cd;
			var flag=$(this).inputmask('getmetadata').cc.toLowerCase();
			$('label[for="'+id+'"]').addClass('valid').attr('data-content',pais);
			$('#flag'+id).attr('class','flag-icon flag-icon-'+flag);
		},
		onincomplete:function(){
			//alert('debe ingresar una dirección de correo completa');
			vacios++;
			$(this).removeClass('valid').addClass('invalid');
		},
		oncomplete:function(){
			vacios--;
		}
	  });
	 
//FIN DOCUMENT READY
  });


//boton de resetear
$('#resetF, .volver').on('click',function(e){
	e.preventDefault(); //previene q se envie el formulario
	$('#usrReg')[0].reset(); //resetea el formulario
	$(".cities").material_select('destroy');     //|VACIA LOS SELECT DE LAS CIUDADES Y LOS ESTADOS
    $('.states').material_select('destroy'); 	//|
	$('label').removeClass('red-text active');
	$('#cliente').hide();
	$('.bg').css('display','block');			//oculta el formulario
	$('.ok').css('display','none');		//muestra el mensaje de ok
	vacios='0';
	});
//radio
$('input[name="cliente"]').on('change',function(){
	if($(this).val()==='si'){
		$('#cliente').toggle('slow');
	}else{
		$('#cliente').toggle('fast');
		$('#code').val('');
		$('label[for="code"]').removeClass('active');
	}
	});

//-----AJAX------

//insercion
$('#insert').on('click',function(e){
	e.preventDefault();
	//efetos al enviar
	$('form').css('opacity','0.5');		//aclaramiento del formulario
	$('#loader').css('display','block');		//muestra el loader
	//funcion de espera *no necesario*
	setTimeout(function(){
		//revisa si todos los campos estan llenos
		$('input[type="text"],textarea').not(':hidden').each(function(){
			var esto=$(this);
			if(!$.trim($(esto).val()) || $(esto).val()===''){				
				$(esto).removeClass('valid').addClass('invalid').val($(esto).val().replace(/\s+/g, ''));		//limpia los inputs de espacios vacios, o los vuelve invalidos
				$('label[for="'+esto.attr('id')+'"]').removeClass('active');			//desactiva las etiquetas de los imputs q tengan puros esoacios en blancos
				vacios ++;
			}else{
				vacios--;
			}
			});
		//revisa si se chequeo la casilla de acuerdo
		if($('#ok').not(':hidden').is(':checked')){
			vacios--;
			$('label[for="ok"]').removeClass('red-text');
			}else{
				vacios++;
				$('label[for="ok"]').addClass('red-text');
			}
	console.log( vacios+' v/ll '+llenos);
	if(vacios =='-12' || vacios =='-15'){
		var form = $('#usrReg').serialize();
		//envio por ajax
		console.log(form);
		$.ajax({
		url : "./process/insert.php", 
		type : "POST", 
		data : form,
		dataType: 'json',
		success: function(insert){
			switch(insert.stat){
				case 'ok':
					$('#agregar').modal('close');
					//Materialize.toast(insert.msg,4000,'green');
					$('.bg').css('display','none');			//oculta el formulario
					$('.ok').css('display','block');		//muestra el mensaje de ok
					$('#loader').css('display','none');		//oculta el loader
					break;
				case 'error':
					Materialize.toast(insert.msg,10000,'red');
					$('form').css('opacity','1');		//obscurecimiento del formulario
					$('#loader').css('display','none');		//oculta el loader
					break;
				case 'repetido':
					Materialize.toast(insert.msg,10000,'amber');
					$('form').css('opacity','1');		//obscurecimiento del formulario
					$('#loader').css('display','none');		//muestra el loader
					break;
			}
			$('#numero').attr('disabled',false);
		},
		error:function(){
			Materialize.toast('<i class="mdi mdi-close-circle-outline"></i>&nbsp  Se produjo un error',4000,'red');
			$('form').css('opacity','1');		//obscurecimiento del formulario
			$('#loader').css('display','none');		//oculta el loader
			}
		});
	}else{
		Materialize.toast('<i class="fa fa-lg mdi mdi-eye"></i><b>!</b>&nbsp Debe llenar todos los campos',4000,'red');
		$('form').css('opacity','1');		//aclaramiento del formulario
		$('#loader').css('display','none');		//muestra el loader
		vacios='0';
	}
	},2000);
	});
