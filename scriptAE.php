	<div id="add_data_Modal" class="modal fade">
 <div class="modal-dialog">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles2">

   </div>
   <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   </div>
  </div>
 </div>
</div>



<div id="dataModal" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles">
    
   </div>
   <div class="modal-footer">
   
   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   
   </div>
  </div>
 </div>
</div>
	

<!--NUEVO CODIGO BORRAR-->
<div id="dataModal3" class="modal fade">
 <div class="modal-dialog modal-lg">
  <div class="modal-content">
   <div class="modal-header">

    <h4 class="modal-title">Detalles</h4>
   </div>
   <div class="modal-body" id="personal_detalles3">
    ¿ESTÁS SEGURO DE BORRAR ESTE REGISTRO?
   </div>
   <div class="modal-footer">
          <span id="btnYes" class="btn confirm">SI BORRAR</span>	  
   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
   
   </div>
  </div>
 </div>
</div>


	<script type="text/javascript">
	
	var fileobj;
	function upload_file(e,name) {
	    e.preventDefault();
	    fileobj = e.dataTransfer.files[0];
	    ajax_file_upload1(fileobj,name);
	}
	 
	function file_explorer(name) {
	    document.getElementsByName(name)[0].click();
	    document.getElementsByName(name)[0].onchange = function() {
	        fileobj = document.getElementsByName(name)[0].files[0];
	        ajax_file_upload1(fileobj,name);
	    };
	}

	function ajax_file_upload1(file_obj,nombre) {
	    if(file_obj != undefined) {
	        var form_data = new FormData();                  
	        form_data.append(nombre, file_obj);
	        form_data.append("IPaltaeventos",  $("#IPaltaeventos").val());
	        $.ajax({
	            type: 'POST',
	            url: 'altaeventos/controladorAE.php',
	            contentType: false,
	            processData: false,
	            data: form_data,
 beforeSend: function() {
$('#1'+nombre).html('<p style="color:green;">Cargando archivo!</p>');
$('#mensajeADJUNTOCOL').html('<p style="color:green;">Actualizado!</p>');
    },				
	            success:function(response) {
//alert(response);
if($.trim(response) == 2 ){

$('#1'+nombre).html('<p style="color:red;">Error, archivo diferente a PDF, JPG o GIF.</p>');
$('#'+nombre).val("");
}else{
$('#'+nombre).val(response);
$('#1'+nombre).html('<a target="_blank" href="includes/archivos/'+$.trim(response)+'">Visualizar!</a>');

$('#2'+nombre).load(location.href + ' #2'+nombre);
$('#'+nombre).val(null);

	document.getElementsByName('ARCHIVO_RELACIONADO_MONTAJE')[0].value = '';
	document.getElementsByName('SUBIR_COTIZACION')[0].value = '';
	document.getElementsByName('SUBIR_ORDEN_COMPRA')[0].value = '';
	document.getElementsByName('SUBIR_CONTRATO_FIRMADO')[0].value = '';
	document.getElementsByName('SUBIR_COTIZACION_FIRMADA')[0].value = '';
	document.getElementsByName('LOGO_CLIENTE')[0].value = '';

}

	            }
	        });
	    }
	}
	
	
function pasara1_personal(pasara1_personal_id){
	//$('#personal_detalles4').html();
	//$('#dataModal4').modal('show');	 pasarpagadoingreso1a

	var checkBox = document.getElementById("pasarapersonal"+pasara1_personal_id);
	var pasapersonal_text = "";
	if (checkBox.checked == true){
	pasapersonal_text = "si";
	}else{
	pasapersonal_text = "no";
	}
	  $.ajax({
		url:'altaeventos/controladorAE.php',
		method:'POST',
		data:{pasara1_personal_id:pasara1_personal_id,pasapersonal_text:pasapersonal_text},
		beforeSend:function(){
		$('#mensajePERSONAL').html('cargando');
	},
		success:function(data){
			
	$("#reset_personal").load(location.href + " #reset_personal");			
			
		$('#mensajePERSONAL').html("<span id='ACTUALIZADO' >"+data+"</span>");
	}
	});

}
function pasara1_personal2(pasara1_personal2_id){
	//$('#personal2_detalles4').html();
	//$('#dataModal4').modal('show');	 pasarpagadoingreso1a

	var checkBox = document.getElementById("pasarapersonal2"+pasara1_personal2_id);
	var pasapersonal2_text = "";
	if (checkBox.checked == true){
	pasapersonal2_text = "si";
	}else{
	pasapersonal2_text = "no";
	}
	  $.ajax({
		url:'altaeventos/controladorAE.php',
		method:'POST',
		data:{pasara1_personal2_id:pasara1_personal2_id,pasapersonal2_text:pasapersonal2_text},
		beforeSend:function(){
		$('#mensajePERSONAL2').html('cargando');
	},
		success:function(data){
			
	$("#reset_personal2").load(location.href + " #reset_personal2");			
			
		$('#mensajePERSONAL2').html("<span id='ACTUALIZADO' >"+data+"</span>");
	}
	});

}

function getemployee(){
var NOMBRE_PERSONAL1 = $( "#NOMBRE_PERSONAL option:selected" ).val();
var NOMBRE_PERSONAL2 = $( "#NOMBRE_PERSONAL option:selected" ).text();
$.ajax({
url:'altaeventos/controladorAE.php',
method:'POST',
data:{NOMBRE_PERSONAL1:NOMBRE_PERSONAL1,NOMBRE_PERSONAL2:NOMBRE_PERSONAL2},
beforeSend:function(){
$('#mensajePERSONAL').html('cargando');
},
success:function(data){

		$("#obtener_puesto").load(location.href + " #obtener_puesto");
		$("#obtener_cel").load(location.href + " #obtener_cel");
		$("#obtener_email").load(location.href + " #obtener_email");
$("#mensajePERSONAL").html("<span id='ACTUALIZADO' >"+data+"</span>");
		
}
});
}

function getemployee2(){
var NOMBRE_PERSONAL12 = $( "#NOMBRE_PERSONAL2 option:selected" ).val();
var NOMBRE_PERSONAL22 = $( "#NOMBRE_PERSONAL2 option:selected" ).text();
$.ajax({
url:'altaeventos/controladorAE.php',
method:'POST',
data:{NOMBRE_PERSONAL12:NOMBRE_PERSONAL12,NOMBRE_PERSONAL22:NOMBRE_PERSONAL22},
beforeSend:function(){
$('#mensajePERSONAL2').html('cargando');
},
success:function(data){

		$("#obtener_puesto2").load(location.href + " #obtener_puesto2");
		$("#obtener_cel2").load(location.href + " #obtener_cel2");
		$("#obtener_email2").load(location.href + " #obtener_email2");
$("#mensajePERSONAL2").html("<span id='ACTUALIZADO' >"+data+"</span>");
		
}
});
}


function getval(){
var INICIALES_EMPRESA_EVENTO1 = $( "#INICIALES_EMPRESA_EVENTO option:selected" ).text();
$.ajax({
url:'altaeventos/controladorAE.php',
method:'POST',
data:{INICIALES_EMPRESA_EVENTO1:INICIALES_EMPRESA_EVENTO1},
beforeSend:function(){
$('#mensajenumeroevento').html('cargando');
},
success:function(data){

		$("#numeroeventoiniciales").load(location.href + " #numeroeventoiniciales");
$("#mensajenumeroevento").html("<span id='ACTUALIZADO' >"+data+"</span>");
		
}
});
}




function pasarpagadoingreso(pasarpagadoingreso_id){
	//$('#personal_detalles4').html();
	//$('#dataModal4').modal('show');	 pasarpagadoingreso1a

	var checkBox = document.getElementById("pasarpagadoingreso1a"+pasarpagadoingreso_id);
	var pasarpagadoingreso_text = "";
	if (checkBox.checked == true){
	pasarpagadoingreso_text = "si";
	}else{
	pasarpagadoingreso_text = "no";
	}
	  $.ajax({
		url:'altaeventos/controladorAE.php',
		method:'POST',
		data:{pasarpagadoingreso_id:pasarpagadoingreso_id,pasarpagadoingreso_text:pasarpagadoingreso_text},
		beforeSend:function(){
		$('#mensapagosingresos').html('cargando');
	},
		success:function(data){
			
	$("#actualizatotalpagadoingreso").load(location.href + " #actualizatotalpagadoingreso");
			
		$('#mensapagosingresos').html("<span id='ACTUALIZADO' >"+data+"</span>");
	}
	});

}



function pasarpagadoegreso(pasarpagadoegreso_id){
	//$('#personal_detalles4').html();
	//$('#dataModal4').modal('show');	 pasarpagadoingreso1a

	var checkBox = document.getElementById("pasarpagadoegreso1a"+pasarpagadoegreso_id);
	var pasarpagadoingreso_text = "";
	if (checkBox.checked == true){
	pasarpagadoegreso_text = "si";
	}else{
	pasarpagadoegreso_text = "no";
	}
	  $.ajax({
		url:'altaeventos/controladorAE.php',
		method:'POST',
		data:{pasarpagadoegreso_id:pasarpagadoegreso_id,pasarpagadoegreso_text:pasarpagadoegreso_text},
		beforeSend:function(){
		$('#mensajepagosegresos').html('cargando');
	},
		success:function(data){
			
	$("#actualizatotalpagadoegreso").load(location.href + " #actualizatotalpagadoegreso");			
			
		$('#mensajepagosegresos').html("<span id='ACTUALIZADO' >"+data+"</span>");
	}
	});

}




function pasarpagadoavion(pasarpagadoavion_id){
	//$('#personal_detalles4').html();
	//$('#dataModal4').modal('show');	 pasarpagadoingreso1a

	var checkBox = document.getElementById("pasarpagadoavion1a"+pasarpagadoavion_id);
	var pasarpagadoingreso_text = "";
	if (checkBox.checked == true){
	pasarpagadoavion_text = "si";
	}else{
	pasarpagadoavion_text = "no";
	}
	  $.ajax({
		url:'altaeventos/controladorAE.php',
		method:'POST',
		data:{pasarpagadoavion_id:pasarpagadoavion_id,pasarpagadoavion_text:pasarpagadoavion_text},
		beforeSend:function(){
		$('#mensajeboletosavion').html('cargando');
	},
		success:function(data){
	$("#actualizatotalpagadoavion").load(location.href + " #actualizatotalpagadoavion");
		$('#mensajeboletosavion').html("<span id='ACTUALIZADO' >"+data+"</span>");
	}
	});

}

function comasainput(name){
	
const numberNoCommas = (x) => {
  return x.toString().replace(/,/g, "");
}

    var total = document.getElementsByName(name)[0].value;
	 var total2 = numberNoCommas(total)
const numberWithCommas = (x) => {
  return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}	
    document.getElementsByName(name)[0].value = numberWithCommas(total2);	
}



	$(document).ready(function(){

$("#clickbuscar").click(function(){
const formData = new FormData($('#buscaform')[0]);

$.ajax({
    url: 'inventario/fetch_pagesInventario.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false
})
.done(function(data) {
				
	$("#results").load("inventario/fetch_pagesInventario.php");

})
.fail(function() {
    console.log("detect error");
});
});

/////////////////////SCRIPT enviar EMAIL///UPDATE ALTA EVENTOS/////
$(document).on('click', '#BUTTON_ALTA_EVENTOS1', function(){
var EMAIL_ALTA_EVENTOS1 = $('#EMAIL_ALTA_EVENTOS1').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emai_altaevento1").serialize();



$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_ALTA_EVENTOS1:EMAIL_ALTA_EVENTOS1},


beforeSend:function(){
$('#mensajeALTAEVENTOS').html('cargando');
},
success:function(data){
$('#mensajeALTAEVENTOS').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});






$("#ENVIAR_EVENTOS").click(function(){
const formData = new FormData($('#ALTAEVENTOSform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeALTAEVENTOS').html('cargando'); 
    },    
  success:function(data){
	    
	$("#resetaltaeventos").load(location.href + " #resetaltaeventos");
	   
	$("#mensajeALTAEVENTOS").html("<span id='ACTUALIZADO' >"+data+"</span>");

    if (typeof setFormularioBloqueado === "function") {
        setFormularioBloqueado(true);
    }
	
	$("#2SUBIR_COTIZACION").load(location.href + " #2SUBIR_COTIZACION");
	$("#2SUBIR_ORDEN_COMPRA").load(location.href + " #2SUBIR_ORDEN_COMPRA");
	$("#2SUBIR_CONTRATO_FIRMADO").load(location.href + " #2SUBIR_CONTRATO_FIRMADO");
	$("#2SUBIR_COTIZACION_FIRMADA").load(location.href + " #2SUBIR_COTIZACION_FIRMADA");
	$("#2LOGO_CLIENTE").load(location.href + " #2LOGO_CLIENTE");
	$("#2IMAGEN_EVENTO").load(location.href + " #2IMAGEN_EVENTO");
	$("#2ARCHIVO_RELACIONADO_MONTAJE").load(location.href + " #2ARCHIVO_RELACIONADO_MONTAJE");		 
   }
   
})
});





 $(document).on('click', '.view_dataaltaeventosborrar', function(){
  //$('#dataModal').modal();
  var borra_ALTAE = $(this).attr("id");
  var borraraltaeventos = "borraraltaeventos";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR
  
  $.ajax({
    url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_ALTAE:borra_ALTAE,borraraltaeventos:borraraltaeventos},
   
    beforeSend:function(){  
    $('#mensajeINVENTARIOG').html('cargando'); 
    },    
   success:function(data){
	   		$("#resetaltaeventos").load(location.href + " #resetaltaeventos");
	   			$('#dataModal3').modal('hide');
			$("#mensajeALTAEVENTOS").html("<span id='ACTUALIZADO' >"+data+"</span>");			
	
   }
  });
   //AGREGAR	
	});
  //AGREGAR	
 });

//SCRIPT PARA BORRAR FOTOGRAFIA
$(document).on('click', '.view_dataAEborrar', function(){
var borra_fotoid = $(this).attr('id');
var borrafoto = 'borrafoto';
$('#personal_detalles3').html();
$('#dataModal3').modal('show');
$('#btnYes').click(function() {
$.ajax({
url: 'altaeventos/controladorAE.php',
method:'POST',
data:{borra_fotoid:borra_fotoid,borrafoto:borrafoto},
beforeSend:function(){
$('#mensajeALTAEVENTOS').html('cargando');
},
success:function(data){
$('#dataModal3').modal('hide');
$('#mensajeALTAEVENTOS').html("<span id='ACTUALIZADO' >"+data+"</span>");
$('#'+borra_fotoid).load(location.href + ' #'+borra_fotoid);
$('#A'+borra_fotoid).load(location.href + ' #A'+borra_fotoid);
}
});
});
});









/**//**//**//**//**//**//**//**/
/*CIERRE*/
/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/

/////////////////////SCRIPT enviar EMAIL///CRONOS VUELOS/////
$(document).on('click', '#BUTTON_email_cierre', function(){
var EMAIL_cierre_e = $('#EMAIL_cierre_e').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emai_cierre").serialize();



$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_cierre_e:EMAIL_cierre_e},


beforeSend:function(){
$('#mensajecierre').html('cargando');
},
success:function(data){
$('#mensajecierre').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});






 $(document).on('click', '.view_dataaltaeventosmodifica', function(){
 
  var personal_id = $(this).attr("id");
  $.ajax({
    url: 'altaeventos/vistapreviaeventos.php',
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajecierre').html('cargando'); 
    },    
   success:function(data){
	$("#resetaltaeventos").load(location.href + " #resetaltaeventos");
    $('#personal_detalles').html("<span id='ACTUALIZADO' >"+data+"</span>");
    $('#dataModal').modal('show');
   }
  });
 });






$("#GUARDAR_CIERRE").click(function(){
const formData = new FormData($('#cierreEVENTOSform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajecierre').html('cargando'); 
    },    
   success:function(data){
			$("#mensajecierre").html("<span id='ACTUALIZADO' >"+data+"</span>");			
	$("#reset_cierre").load(location.href + " #reset_cierre");

   }
   
})
});



$(document).on('click', '.view_datacierreborrar', function(){
var borra_CIERREID = $(this).attr('id');
var borraCIERRE = 'borraCIERRE';
$('#personal_detalles3').html();
$('#dataModal3').modal('show');
$('#btnYes').click(function() {
$.ajax({
url: 'altaeventos/controladorAE.php',
method:'POST',
data:{borra_CIERREID:borra_CIERREID,borraCIERRE:borraCIERRE},
beforeSend:function(){
$('#mensajecierre').html('cargando');
},
success:function(data){
$('#dataModal3').modal('hide');
$('#mensajecierre').html("<span id='ACTUALIZADO' >"+data+"</span>");
	$("#reset_cierre").load(location.href + " #reset_cierre");

}
});
});
});

/////////////////////  COTIZACION DE PROVEEDORES //////////////////////////////////////



$("#GUARDAR_COTIPRO").click(function(){
const formData = new FormData($('#COTIPROform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeCOTIPRO').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_COTIPRO").load(location.href + " #reset_COTIPRO");	
			$("#mensajeCOTIPRO").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});


$(document).on('click', '.view_COTIPRO', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
  url:"altaeventos/VistaPreviaCOTIPRO.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeCOTIPRO').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_dataCOTIPROborrar', function(){

  var borra_cotipro = $(this).attr("id");
  var borra_COTIPRO = "borra_COTIPRO";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
  url:"altaeventos/controladorAE.php",
   method:"POST",
   data:{borra_cotipro:borra_cotipro,borra_COTIPRO:borra_COTIPRO},
   
    beforeSend:function(){  
    $('#mensajeCOTIPRO').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeCOTIPRO").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_COTIPRO").load(location.href + " #reset_COTIPRO");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });		

/////////////////////SCRIPT enviar EMAIL//////
$(document).on('click', '#BUTTON_COTIPRO', function(){
var EMAIL_COTIPRO = $('#EMAIL_COTIPRO').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_COTIPRO").serialize();

$.ajax({
  url:"altaeventos/controladorAE.php",
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_COTIPRO:EMAIL_COTIPRO},


beforeSend:function(){
$('#mensajeCOTIPRO').html('cargando');
},
success:function(data){
$('#mensajeCOTIPRO').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});




/**//**//**//**//**//**//**//**/
/*CIERRE*/
/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/





/**//**//**//**//**//**//**//**/
/*OPERATIVO*/
/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/

/////////////////////SCRIPT enviar EMAIL///CRONOS VUELOS/////
$(document).on('click', '#BUTTON_EMAIL_PO', function(){
var EMAIL_PROGRAMA_OPERATIVO = $('#EMAIL_PROGRAMA_OPERATIVO').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emai_po").serialize();



$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_PROGRAMA_OPERATIVO:EMAIL_PROGRAMA_OPERATIVO},


beforeSend:function(){
$('#mensajePROGRAMAOPERATIVO').html('cargando');
},
success:function(data){
$('#mensajePROGRAMAOPERATIVO').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});




//MODIFICA
 $(document).on('click', '.view_dataPROGRAMAmodifica', function(){
 
  var personal_id = $(this).attr("id");
  $.ajax({
    url: 'altaeventos/VistapreviaProgramaOperativo.php',
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajePROGRAMAOPERATIVO').html('cargando'); 
    },    
   success:function(data){
	$("#reset_OPERATIVO").load(location.href + " #reset_OPERATIVO");
    $('#personal_detalles').html("<span id='ACTUALIZADO' >"+data+"</span>");
    $('#dataModal').modal('show');
   }
  });
 });





//GUARDA
$("#GUARDAR_PROGRAMAOPERATIVO").click(function(){
const formData = new FormData($('#PROGRAMAOPERATIVOform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajePROGRAMAOPERATIVO').html('cargando'); 
    },    
   success:function(data){
			$("#mensajePROGRAMAOPERATIVO").html("<span id='ACTUALIZADO' >"+data+"</span>");			
	$("#reset_OPERATIVO").load(location.href + " #reset_OPERATIVO");
   }
   
})
});


//BORRA
//borraOPERATIVO
$(document).on('click', '.view_dataPROGRAMAborrar', function(){
var borra_ID_OPERATIVO = $(this).attr('id');
var borraOPERATIVO = 'borraOPERATIVO';
$('#personal_detalles3').html();
$('#dataModal3').modal('show');
$('#btnYes').click(function() {
$.ajax({
url: 'altaeventos/controladorAE.php',
method:'POST',
data:{borra_ID_OPERATIVO:borra_ID_OPERATIVO,borraOPERATIVO:borraOPERATIVO},
beforeSend:function(){
$('#mensajePROGRAMAOPERATIVO').html('cargando');
},
success:function(data){
$('#dataModal3').modal('hide');
$('#mensajePROGRAMAOPERATIVO').html("<span id='ACTUALIZADO' >"+data+"</span>");
	$("#reset_OPERATIVO").load(location.href + " #reset_OPERATIVO");

}
});
});
});


/**//**//**//**//**//**//**//**/
/*OPERATIVO*/
/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/





/**//**//**//**//**//**//**//**/
/*ROOMING*/
/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/

/////////////////////SCRIPT enviar rooming
$(document).on('click', '#BUTTON_email_rooming', function(){
var EMAIL_rooming = $('#EMAIL_rooming').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emai_rooming").serialize();

$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_rooming:EMAIL_rooming},

beforeSend:function(){
$('#mensajeROOMING').html('cargando');
},
success:function(data){
$('#mensajeROOMING').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});





 $(document).on('click', '.view_dataROOMINGmodifica', function(){
 
  var personal_id = $(this).attr("id");
  $.ajax({
    url: 'altaeventos/VistapreviaRoomingList.php',
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeROOMING').html('cargando'); 
    },    
   success:function(data){
	$("#reset_rooming").load(location.href + " #reset_rooming");
    $('#personal_detalles').html("<span id='ACTUALIZADO' >"+data+"</span>");
    $('#dataModal').modal('show');
   }
  });
 });






$("#GUARDAR_ROOMING").click(function(){
const formData = new FormData($('#ROOMINGform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeROOMING').html('cargando'); 
    },    
   success:function(data){
			$("#mensajeROOMING").html("<span id='ACTUALIZADO' >"+data+"</span>");			
	$("#reset_rooming").load(location.href + " #reset_rooming");

   }
   
})
});


//reset_rooming
$(document).on('click', '.view_dataROMMINGborrar', function(){
var borra_ROOMING_ID = $(this).attr('id');
var borraROOMING = 'borraROOMING';
$('#personal_detalles3').html();
$('#dataModal3').modal('show');
$('#btnYes').click(function() {
$.ajax({
url: 'altaeventos/controladorAE.php',
method:'POST',
data:{borraROOMING:borraROOMING,borra_ROOMING_ID:borra_ROOMING_ID},
beforeSend:function(){
$('#mensajeROOMING').html('cargando');
},
success:function(data){
$('#dataModal3').modal('hide');
$('#mensajeROOMING').html("<span id='ACTUALIZADO' >"+data+"</span>");
	$("#reset_rooming").load(location.href + " #reset_rooming");

}
});
});
});


/**//**//**//**//**//**//**//**/
/*ROOMING*/
/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/











$(document).on('click', '.view_datacierremodifica', function(){
var personal_id = $(this).attr('id');
$.ajax({
url:'altaeventos/VistapreviaCierre.php',
method:'POST',
data:{personal_id:personal_id},
beforeSend:function(){
$('#mensajeALTAEVENTOS').html('cargando');
},
success:function(data){
$('#personal_detalles').html(data);
$('#dataModal').modal('toggle');
}
});
});

/**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**//**/





 $(document).on('click', '.view_dataaltaeventosmodifica', function(){
 
  var personal_id = $(this).attr("id");
  $.ajax({
    url: 'altaeventos/vistapreviaeventos.php',
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeALTAEVENTOS').html('cargando'); 
    },    
   success:function(data){
	$("#resetaltaeventos").load(location.href + " #resetaltaeventos");
    $('#personal_detalles').html("<span id='ACTUALIZADO' >"+data+"</span>");
    $('#dataModal').modal('show');
   }
  });
 });





$("#GUARDAR_NUMERO_EVENTO").click(function(){
const formData = new FormData($('#numeroeventosform')[0]);

    $.ajax({
		url: 'altaeventos/controladorAE.php',
		type: 'POST',
		dataType: 'html',
		data: formData,
		cache: false,
		contentType: false,
		processData: false,
		
		 beforeSend:function(){
		$('#mensajenumeroevento').html('cargando'); 
		},    
	   success:function(data){
		$("#numeroevento1a").load(location.href + " #numeroevento1a");
		$("#fechaautorizacion").load(location.href + " #fechaautorizacion");
		$("#refreshnumevento").load(location.href + " #refreshnumevento");
		$("#numeroeventoiniciales").load(location.href + " #numeroeventoiniciales");
		$("#mensajenumeroevento").html("<span id='ACTUALIZADO' >"+data+"</span>");
			if($.trim(data) =="Ingresado" || $.trim(data) =="Actualizado"){
				$("#bloquea_boton").load(location.href + " #bloquea_boton");				
			}
		
	   }
	})
});









/**//*quitar si trabaja onchange*/
$(document).on('click', '#buscarINICIALES', function(){
var INICIALES_EMPRESA_EVENTO1 = $( "#INICIALES_EMPRESA_EVENTO option:selected" ).text();
$.ajax({
url:'altaeventos/controladorAE.php',
method:'POST',
data:{INICIALES_EMPRESA_EVENTO1:INICIALES_EMPRESA_EVENTO1},
beforeSend:function(){
$('#mensajenumeroevento').html('cargando');
},
success:function(data){

		$("#numeroeventoiniciales").load(location.href + " #numeroeventoiniciales");
$("#mensajenumeroevento").html("<span id='ACTUALIZADO' >"+data+"</span>");
		
}
});
});






















/////////////////////////////NUEVO DOCUMENTO CIERRE ////////////////


$("#enviardocucierre").click(function(){
const formData = new FormData($('#DOCUMENTONUEVOcierreform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeDOCUnuevocierre').html('cargando'); 
    },    
   success:function(data){
	
		$("#reseteateNUEVOCIERRE").load(location.href + " #reseteateNUEVOCIERRE");	
			$("#mensajeDOCUnuevocierre").html("<span id='ACTUALIZADO' >"+data+"</span>");			
		$("#despleResetCierre").load(location.href + " #despleResetCierre");	

   }
   
})
});



$(document).on('click', '.view_dataNUEVOdocucierre', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPrevianuevodocucierre.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeDOCUnuevocierre').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 });

$(document).on('click', '.view_databorraNUEVOdocucierre', function(){

  var borra_NUEVOD = $(this).attr("id");
  var BORRAREGISTRO_cierrenuevo = "BORRAREGISTRO_cierrenuevo";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_NUEVOD:borra_NUEVOD,BORRAREGISTRO_cierrenuevo:BORRAREGISTRO_cierrenuevo},
   
    beforeSend:function(){  
    $('#mensajeDOCUnuevocierre').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeDOCUnuevocierre").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reseteateNUEVOCIERRE").load(location.href + " #reseteateNUEVOCIERRE");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });	




///////////////////////////CRONOLOGICO DE VUELOS//////////////////////////////




$("#GUARDAR_CRONOVUELOS").click(function(){
const formData = new FormData($('#cronoVUELOSform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajecronov').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_cronovuelos").load(location.href + " #reset_cronovuelos");	
			$("#mensajecronov").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});



$(document).on('click', '.view_dataCRONOVUELOS', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPreviacronosvuelos.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajecronov').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 });

$(document).on('click', '.view_dataCRONOVUELOSborrar', function(){

  var borra_cronosvuelos = $(this).attr("id");
  var borra_CRONOSV = "borra_CRONOSV";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_cronosvuelos:borra_cronosvuelos,borra_CRONOSV:borra_CRONOSV},
   
    beforeSend:function(){  
    $('#mensajecronov').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajecronov").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_cronovuelos").load(location.href + " #reset_cronovuelos");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });		

/////////////////////SCRIPT enviar EMAIL///CRONOS VUELOS/////
$(document).on('click', '#BUTTON_CRONO_VUELOS', function(){
var EMAIL_CRNO_VUELOS = $('#EMAIL_CRNO_VUELOS').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_cronovuelos").serialize();



$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_CRNO_VUELOS:EMAIL_CRNO_VUELOS},


beforeSend:function(){
$('#mensajecronov').html('cargando');
},
success:function(data){
$('#mensajecronov').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});











///////////////////////////CRONOLOGICO TERRRESTRE//////////////////////////////

/////////////////////SCRIPT enviar EMAIL///CRONOS TERRRESTRE/////
$(document).on('click', '#BUTTON_cronoterrestre', function(){
var EMAIL_cronoterrestre = $('#EMAIL_cronoterrestre').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_cronoterrestre").serialize();



$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_cronoterrestre:EMAIL_cronoterrestre},


beforeSend:function(){
$('#mensajecronoterrestre').html('cargando');
},
success:function(data){
$('#mensajecronoterrestre').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});


$("#GUARDAR_cronoterrestre").click(function(){
const formData = new FormData($('#cronoterrestreform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajecronoterrestre').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_cronoterrestre").load(location.href + " #reset_cronoterrestre");	
			$("#mensajecronoterrestre").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});



$(document).on('click', '.view_datacronoterrestre', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPreviacronosterrestre.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajecronoterrestre').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 });

$(document).on('click', '.view_datacronoterrestreborrar', function(){

  var borra_cronos_T = $(this).attr("id");
  var borra_CRONOSTERRRE = "borra_CRONOSTERRRE";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_cronos_T:borra_cronos_T,borra_CRONOSTERRRE:borra_CRONOSTERRRE},
   
    beforeSend:function(){  
    $('#mensajecronoterrestre').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajecronoterrestre").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_cronoterrestre").load(location.href + " #reset_cronoterrestre");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });		




//////////////////////////////////Cobros cliente//////////////////////////////



$("#GUARDAR_COBROSCLIENTE").click(function(){
const formData = new FormData($('#cronoCOBROSform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajecobroscliente').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_cobroscliente").load(location.href + " #reset_cobroscliente");	
			$("#mensajecobroscliente").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});


$(document).on('click', '.view_datacobroscliente1', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPreviacobroscliente.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajecobroscliente').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_datacobrosclienteborrar', function(){

  var borra_cobros_C = $(this).attr("id");
  var borra_COBROSCLIENTE = "borra_COBROSCLIENTE";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_cobros_C:borra_cobros_C,borra_COBROSCLIENTE:borra_COBROSCLIENTE},
   
    beforeSend:function(){  
    $('#mensajecobroscliente').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajecobroscliente").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_cobroscliente").load(location.href + " #reset_cobroscliente");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });		

/////////////////////SCRIPT enviar EMAIL//////
$(document).on('click', '#BUTTON_COBROS_CLIENTES', function(){
var EMAIL_COBROS_CLIENTES = $('#EMAIL_COBROS_CLIENTES').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_cobroscliente").serialize();

$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_COBROS_CLIENTES:EMAIL_COBROS_CLIENTES},


beforeSend:function(){
$('#mensajecobroscliente').html('cargando');
},
success:function(data){
$('#mensajecobroscliente').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});


////////////////////////////////////////INGRESOS//////////////////////////////////////////




$("#GUARDA_PAGOS").click(function(){
const formData = new FormData($('#pagosingresosform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensapagosingresos').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_ingresos").load(location.href + " #reset_ingresos");	
			$("#mensapagosingresos").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});


$(document).on('click', '.view_datapagoingreso', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPreviapagosingresos.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensapagosingresos').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_datapagoingresoborrar', function(){

  var borra_cobros_INGRE = $(this).attr("id");
  var borra_PAGOSINGRESOS = "borra_PAGOSINGRESOS";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_cobros_INGRE:borra_cobros_INGRE,borra_PAGOSINGRESOS:borra_PAGOSINGRESOS},
   
    beforeSend:function(){  
    $('#mensapagosingresos').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensapagosingresos").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_ingresos").load(location.href + " #reset_ingresos");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });	

$(document).on('click', '#BUTTON_PAGOS_INGRESOS', function(){
var EMAIL_PAGOS_INGRESOS = $('#EMAIL_PAGOS_INGRESOS').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_pagosingresos").serialize();



$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_PAGOS_INGRESOS:EMAIL_PAGOS_INGRESOS},


beforeSend:function(){
$('#mensapagosingresos').html('cargando');
},
success:function(data){
$('#mensapagosingresos').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});





/////////////////////////////////////////EGRESOS//////////////////////////////////////////



$("#GUARDAR_pagosegresos").click(function(){
const formData = new FormData($('#pagosegresosform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajepagosegresos').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_egresos").load(location.href + " #reset_egresos");	
			$("#mensajepagosegresos").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});



$(document).on('click', '.view_datapagoegreso', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPreviapgoegreso.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajepagosegresos').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_datapagoegresoborrar', function(){

  var borra_pago_egre = $(this).attr("id");
  var borra_PAGOEGRESOS = "borra_PAGOEGRESOS";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_pago_egre:borra_pago_egre,borra_PAGOEGRESOS:borra_PAGOEGRESOS},
   
    beforeSend:function(){  
    $('#mensajepagosegresos').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajepagosegresos").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_egresos").load(location.href + " #reset_egresos");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });	


//////////EMAIL EGRESOS//////////////
$(document).on('click', '#BUTTON_PAGOS_EGRESOS', function(){
var EMAIL_PAGOS_EGRESOS = $('#EMAIL_PAGOS_EGRESOS').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_pagosEgresos").serialize();



$.ajax({
    url:'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_PAGOS_EGRESOS:EMAIL_PAGOS_EGRESOS},


beforeSend:function(){
$('#mensajepagosegresos').html('cargando');
},
success:function(data){
$('#mensajepagosegresos').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});






////////////////////////////BOLETOS AVION//////////////////////////////////////////



$("#GUARDAR_BOLETOSAVION").click(function(){
const formData = new FormData($('#BOLETOSAVIONform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajeboletosavion').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_boletos").load(location.href + " #reset_boletos");	
			$("#mensajeboletosavion").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});



$(document).on('click', '.view_databoletosavion', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPreviaboletoavion.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajeboletosavion').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_databoletosavionborrar', function(){

  var borra_bole_avion = $(this).attr("id");
  var borra_BOLETOSAVION = "borra_BOLETOSAVION";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_bole_avion:borra_bole_avion,borra_BOLETOSAVION:borra_BOLETOSAVION},
   
    beforeSend:function(){  
    $('#mensajeboletosavion').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajeboletosavion").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_boletos").load(location.href + " #reset_boletos");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });	

/////////////EMAIL/////////////////
$(document).on('click', '#BUTTON_EMAIL_BOLETOS_AVION', function(){
var EMAIL_BOLETOS_AVION = $('#EMAIL_BOLETOS_AVION').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emil_BOLETOSAVION").serialize();

$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{EMAIL_BOLETOS_AVION:EMAIL_BOLETOS_AVION},

beforeSend:function(){
$('#mensajeboletosavion').html('cargando');
},
success:function(data){
$('#mensajeboletosavion').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});


//////////////////////////PERSONAL/////////////////////////////////


$("#guardaPERSONAL").click(function(){
const formData = new FormData($('#PERSONALform')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajePERSONAL').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_personal").load(location.href + " #reset_personal");	
			$("#mensajePERSONAL").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});


$(document).on('click', '.view_dataDATOSpersonalmodifica', function(){
  //$('#dataModal').modal();
  var personal_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPreviapersonal.php",
   method:"POST",
   data:{personal_id:personal_id},
    beforeSend:function(){  
    $('#mensajePERSONAL').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_dataDATOSpersonalborrar', function(){

  var borra_bole_perso = $(this).attr("id");
  var borra_PERSONAL = "borra_PERSONAL";

  //AGREGAR
    $('#personal_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_bole_perso:borra_bole_perso,borra_PERSONAL:borra_PERSONAL},
   
    beforeSend:function(){  
    $('#mensajePERSONAL').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajePERSONAL").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_personal").load(location.href + " #reset_personal");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });	

/////////////EMAIL/////////////////
$(document).on('click', '#enviarimailPERSONAL', function(){
var PERSONAL_ENVIAR_IMAIL = $('#PERSONAL_ENVIAR_IMAIL').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emai_personal").serialize();

$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{PERSONAL_ENVIAR_IMAIL:PERSONAL_ENVIAR_IMAIL},

beforeSend:function(){
$('#mensajePERSONAL').html('cargando');
},
success:function(data){
$('#mensajePERSONAL').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});



////////////////////////////PERSONAL2/////////////////////////////////////////////////////////
$("#guardaPERSONAL2").click(function(){
const formData = new FormData($('#PERSONAL2form')[0]);

$.ajax({
    url: 'altaeventos/controladorAE.php',
    type: 'POST',
    dataType: 'html',
    data: formData,
    cache: false,
    contentType: false,
    processData: false,
	
	 beforeSend:function(){  
    $('#mensajePERSONAL2').html('cargando'); 
    },    
   success:function(data){
	
		$("#reset_personal2").load(location.href + " #reset_personal2");	
			$("#mensajePERSONAL2").html("<span id='ACTUALIZADO' >"+data+"</span>");

   }
   
})
});


$(document).on('click', '.view_dataDATOSpersonal2modifica', function(){
  //$('#dataModal').modal();
  var personal2_id = $(this).attr("id");
  $.ajax({
   url:"altaeventos/VistaPreviapersonal2.php",
   method:"POST",
   data:{personal2_id:personal2_id},
    beforeSend:function(){  
    $('#mensajePERSONAL2').html('CARGANDO'); 
    },    
   success:function(data){
    $('#personal2_detalles').html(data);
    $('#dataModal').modal('show');
   }
  });
 })



$(document).on('click', '.view_dataDATOSpersonal2borrar', function(){

  var borra_perso2 = $(this).attr("id");
  var borra_PERSONAL2 = "borra_PERSONAL2";

  //AGREGAR
    $('#personal2_detalles3').html();
    $('#dataModal3').modal('show');
  $('#btnYes').click(function() {
  //AGREGAR

  
  $.ajax({
   url: 'altaeventos/controladorAE.php',
   method:"POST",
   data:{borra_perso2:borra_perso2,borra_PERSONAL2:borra_PERSONAL2},
   
    beforeSend:function(){  
    $('#mensajePERSONAL2').html('CARGANDO'); 
    },    
   success:function(data){
	   			$('#dataModal3').modal('hide');	   
			$("#mensajePERSONAL2").html("<span id='ACTUALIZADO' >"+data+"</span>");			
			$("#reset_personal2").load(location.href + " #reset_personal2");
   }
  });
  
    //AGREGAR	
	});
  //AGREGAR	 
  
 });	

/////////////EMAIL/////////////////
$(document).on('click', '#enviarimailPERSONAL2', function(){
var PERSONAL2_ENVIAR_IMAIL = $('#PERSONAL2_ENVIAR_IMAIL').val();


        var myCheckboxes = new Array();
        $("input:checked").each(function() {
           myCheckboxes.push($(this).val());
        });
var dataString = $("#form_emai_personal2").serialize();

$.ajax({
    url: 'altaeventos/controladorAE.php',
method:'POST',
dataType: 'html',

data: dataString+{PERSONAL2_ENVIAR_IMAIL:PERSONAL2_ENVIAR_IMAIL},

beforeSend:function(){
$('#mensajePERSONAL2').html('cargando');
},
success:function(data){
$('#mensajePERSONAL2').html("<span id='ACTUALIZADO' >"+data+"</span>");

}
});
});

///////////////////////////////////////////////////////////////////////////////////////////////////
	
	
			$('#target1').hide("linear");
			$('#target2').show("linear");
			$('#target3').hide("linear");
			$('#target4').hide("linear");
			$('#target5').hide("linear");
			$('#target6').hide("linear");
			$('#target7').hide("linear");
			$('#target8').hide("linear");
			$('#target9').hide("linear");
			$('#target10').hide("linear");
			$('#target101').hide("linear");
			$('#target11').hide("linear");
			$('#target111').hide("linear");
			$('#target12').hide("linear");
			$('#target121').hide("linear");
			$('#target13').hide("linear");
			$('#target14').hide("linear");
			$('#target15').hide("linear");
			$('#target16').hide("linear");
			$('#target17').hide("linear");
			$('#target18').hide("linear");
			$('#target19').hide("linear");
			$('#target20').hide("linear");
			$('#targetVIDEO').hide("linear");
			
			$("#mostrar1").click(function(){
				$('#target1').show("swing");
		 	});
			$("#ocultar1").click(function(){
				$('#target1').hide("linear");
			});
			$("#mostrar2").click(function(){
				$('#target2').show("swing");
		 	});
			$("#ocultar2").click(function(){
				$('#target2').hide("linear");
			});
			$("#mostrar3").click(function(){
				$('#target3').show("swing");
		 	});
			$("#ocultar3").click(function(){
				$('#target3').hide("linear");
			});
			$("#mostrar4").click(function(){
				$('#target4').show("swing");
		 	});
			$("#ocultar4").click(function(){
				$('#target4').hide("linear");
			});
			$("#mostrar5").click(function(){
				$('#target5').show("swing");
		 	});
			$("#ocultar5").click(function(){
				$('#target5').hide("linear");
			});
			$("#mostrar6").click(function(){
				$('#target6').show("swing");
		 	});
			$("#ocultar6").click(function(){
				$('#target6').hide("linear");
			});
			$("#mostrar7").click(function(){
				$('#target7').show("swing");
		 	});
			$("#ocultar7").click(function(){
				$('#target7').hide("linear");
			});
			$("#mostrar8").click(function(){
				$('#target8').show("swing");
		 	});
			$("#ocultar8").click(function(){
				$('#target8').hide("linear");
			});
			$("#mostrar9").click(function(){
				$('#target9').show("swing");
		 	});
			$("#ocultar9").click(function(){
				$('#target9').hide("linear");
			});
			$("#mostrar10").click(function(){
				$('#target10').show("swing");
		 	});
			$("#ocultar10").click(function(){
				$('#target10').hide("linear");
			});
			
			$("#mostrar101").click(function(){
				$('#target101').show("swing");
		 	});
			$("#ocultar101").click(function(){
				$('#target101').hide("linear");
			});
			
			$("#mostrar11").click(function(){
				$('#target11').show("swing");
		 	});
			$("#ocultar11").click(function(){
				$('#target11').hide("linear");
			});
			
			$("#mostrar111").click(function(){
				$('#target111').show("swing");
		 	});
			$("#ocultar111").click(function(){
				$('#target111').hide("linear");
			});			
			
			
			$("#mostrar12").click(function(){
				$('#target12').show("swing");
		 	});
			$("#ocultar12").click(function(){
				$('#target12').hide("linear");
			});
			
			$("#mostrar121").click(function(){
				$('#target121').show("swing");
		 	});
			$("#ocultar121").click(function(){
				$('#target121').hide("linear");
			});			
			
			$("#mostrar13").click(function(){
				$('#target13').show("swing");
		 	});
			$("#ocultar13").click(function(){
				$('#target13').hide("linear");
			});
			
			$("#mostrar14").click(function(){
				$('#target14').show("swing");
		 	});
			$("#ocultar14").click(function(){
				$('#target14').hide("linear");
			});		


			$("#mostrar15").click(function(){
				$('#target15').show("swing");
		 	});
			$("#ocultar15").click(function(){
				$('#target15').hide("linear");
			});					

			$("#mostrar16").click(function(){
				$('#target16').show("swing");
		 	});
			$("#ocultar16").click(function(){
				$('#target16').hide("linear");
			});	

			$("#mostrar17").click(function(){
				$('#target17').show("swing");
		 	});
			$("#ocultar17").click(function(){
				$('#target17').hide("linear");
			});	

			$("#mostrar18").click(function(){
				$('#target18').show("swing");
		 	});
			$("#ocultar18").click(function(){
				$('#target18').hide("linear");
			});

			$("#mostrar19").click(function(){
				$('#target19').show("swing");
		 	});
			$("#ocultar19").click(function(){
				$('#target19').hide("linear");
			});

			$("#mostrar20").click(function(){
				$('#target20').show("swing");
		 	});
			$("#ocultar20").click(function(){
				$('#target20').hide("linear");
			});
			
			$("#mostrarVIDEO").click(function(){
				$('#targetVIDEO').show("swing");
		 	});
			$("#ocultarVIDEO").click(function(){
				$('#targetVIDEO').hide("linear");
			});





			$("#mostrartodos2").click(function(){
				$('#target1').show("swing");
				$('#target2').show("swing");
				$('#target3').show("swing");
				$('#target4').show("swing");
				$('#target5').show("swing");
				$('#target6').show("swing");
				$('#target7').show("swing");
				$('#target8').show("swing");
				$('#target9').show("swing");
				$('#target10').show("swing");
				$('#target101').show("swing");
				$('#target11').show("swing");
				$('#target111').show("swing");
				$('#target12').show("swing");
				$('#target121').show("swing");
				$('#target13').show("swing");
				$('#target14').show("swing");
				$('#target15').show("swing");
				$('#target16').show("swing");
				$('#target17').show("swing");
				$('#target18').show("swing");
				$('#target19').show("swing");
				$('#target20').show("swing");
				$('#targetVIDEO').show("swing");
		 	});
			
			$("#ocultartodos2").click(function(){
				$('#target1').hide("linear");
				$('#target2').hide("linear");	
				$('#target3').hide("linear");
				$('#target4').hide("linear");
				$('#target5').hide("linear");
				$('#target6').hide("linear");
				$('#target7').hide("linear");
				$('#target8').hide("linear");
				$('#target9').hide("linear");
				$('#target10').hide("linear");
				$('#target101').hide("linear");
				$('#target11').hide("linear");
				$('#target111').hide("linear");
				$('#target12').hide("linear");
				$('#target121').hide("linear");
				$('#target13').hide("linear");
				$('#target14').hide("linear");
				$('#target15').hide("linear");
				$('#target16').hide("linear");
				$('#target17').hide("linear");
				$('#target18').hide("linear");
				$('#target19').hide("linear");
				$('#target20').hide("linear");
				$('#targetVIDEO').hide("linear");
			});










			$("#mostrartodos").click(function(){
				$('#target1').show("swing");
				$('#target2').show("swing");
				$('#target3').show("swing");
				$('#target4').show("swing");
				$('#target5').show("swing");
				$('#target6').show("swing");
				$('#target7').show("swing");
				$('#target8').show("swing");
				$('#target9').show("swing");
				$('#target10').show("swing");
				$('#target101').show("swing");
				$('#target11').show("swing");
				$('#target111').show("swing");
				$('#target12').show("swing");
				$('#target121').show("swing");
				$('#target13').show("swing");
				$('#target14').show("swing");
				$('#target15').show("swing");
				$('#target16').show("swing");
				$('#target17').show("swing");
				$('#target18').show("swing");
				$('#target19').show("swing");
				$('#target20').show("swing");
				$('#targetVIDEO').show("swing");
		 	});
			
			$("#ocultartodos").click(function(){
				$('#target1').hide("linear");
				$('#target2').hide("linear");	
				$('#target3').hide("linear");
				$('#target4').hide("linear");
				$('#target5').hide("linear");
				$('#target6').hide("linear");
				$('#target7').hide("linear");
				$('#target8').hide("linear");
				$('#target9').hide("linear");
				$('#target10').hide("linear");
				$('#target101').hide("linear");
				$('#target11').hide("linear");
				$('#target111').hide("linear");
				$('#target12').hide("linear");
				$('#target121').hide("linear");
				$('#target13').hide("linear");
				$('#target14').hide("linear");
				$('#target15').hide("linear");
				$('#target16').hide("linear");
				$('#target17').hide("linear");
				$('#target18').hide("linear");
				$('#target19').hide("linear");
				$('#target20').hide("linear");
				$('#targetVIDEO').hide("linear");
			});

		});
	</script>