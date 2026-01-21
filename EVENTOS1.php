<?php
/*
version sandor: 16 abril 2025
version fatis : 06/04/2025
*/
?>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/mask@3.x.x/dist/cdn.min.js"></script>					
<script >						
function calcular() {
    const numberNoCommas = (x) => {
        return x.toString().replace(/,/g, "");
    }

    const numberWithCommas = (x) => {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function formatInputPreservingCursor(inputElement, value) {
        const originalValue = inputElement.value;
        const cursorPos = inputElement.selectionStart;

        const commasBefore = originalValue.slice(0, cursorPos).split(',').length - 1;

        const formattedValue = numberWithCommas(value);
        inputElement.value = formattedValue;

        let newCursorPos = cursorPos - commasBefore;
        let i = 0, charsPassed = 0;
        while (charsPassed < newCursorPos && i < formattedValue.length) {
            if (formattedValue[i] !== ',') {
                charsPassed++;
            }
            i++;
        }
        inputElement.setSelectionRange(i, i);
    }

    // Listener para inputs tipo .tol
    const inputs = document.querySelectorAll(".tol");

    inputs.forEach(input => {
        input.addEventListener("keydown", function (e) {
            const keyCode = e.keyCode || e.which;

            // Teclas numéricas (teclado principal del 0 al 9 o numpad 0 al 9)
            const isNumberKey =
                (keyCode >= 48 && keyCode <= 57) || // Teclado principal
                (keyCode >= 96 && keyCode <= 105) ||
				(keyCode === 46) ||
				(keyCode === 8 );  // Numpad

            if (isNumberKey) {
                // Esperar a que el valor se actualice antes de formatear
                setTimeout(() => {
                    const arr = document.getElementsByClassName("tol");

                    let MONTOC_TOTAL_EVENTO_elem = document.getElementsByName("MONTOC_TOTAL_EVENTO")[0];
                    let MONTO_TOTAL_AVION_elem = document.getElementsByName("MONTO_TOTAL_AVION")[0];
                    let FEE_COBRADO_elem = document.getElementsByName("FEE_COBRADO")[0];

                    let MONTOC_TOTAL_EVENTO2 = numberNoCommas(MONTOC_TOTAL_EVENTO_elem.value);
                    let MONTO_TOTAL_AVION2 = numberNoCommas(MONTO_TOTAL_AVION_elem.value);
                    let FEE_COBRADO2 = numberNoCommas(FEE_COBRADO_elem.value);

                    let tot = 0;
                    for (let i = 0; i < arr.length; i++) {
                        if (parseFloat(numberNoCommas(arr[i].value)))
                            tot += parseFloat(numberNoCommas(arr[i].value));
                    }

                    formatInputPreservingCursor(document.getElementById('MONTO_TOTAL_DEL_EVENTO'), tot);
                    formatInputPreservingCursor(FEE_COBRADO_elem, FEE_COBRADO2);
                    formatInputPreservingCursor(MONTO_TOTAL_AVION_elem, MONTO_TOTAL_AVION2);
                    formatInputPreservingCursor(MONTOC_TOTAL_EVENTO_elem, MONTOC_TOTAL_EVENTO2);
                }, 0);
            }
        });
    });
}


document.addEventListener("DOMContentLoaded", calcular);


$("#tot").on({
    "focus": function (event) {
        $(event.target).select();
    },
    "keyup": function (event) {
        $(event.target).val(function (index, value ) {
            return value.replace(/\D/g, "")
                        .replace(/([0-9])([0-9]{2})$/, '$1.$2')
                        .replace(/\B(?=(\d{3})+(?!\d)\.?)/g, ",");
        });
    }
});

       function actualizarFechaDestino() {
            // Obtener el valor del campo de origen (fecha)
            let fechaOrigen = document.getElementById("FECHA_FINAL_EVENTO").value;

            // Verificar si se ingresó una fecha válida
            if (fechaOrigen) {
                // Convertir la fecha a un objeto Date
                let fecha = new Date(fechaOrigen);

                // Agregar 30 días a la fecha
                fecha.setDate(fecha.getDate() + 30);

                // Formatear la nueva fecha en YYYY-MM-DD
                let nuevaFecha = fecha.toISOString().split('T')[0];

                // Asignar la nueva fecha al campo de destino
                document.getElementById("CIERRE_TOTAL").value = nuevaFecha;
            } else {
                // Si no hay fecha en el campo de origen, limpiar el campo de destino
                document.getElementById("CIERRE_TOTAL").value = "";
            }
        }

</script>



<div id="content">     
			<hr/>
		<strong>	  <p class="mb-0 text-uppercase" ><img src="includes/contraer31.png" id="mostrar1" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar1" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp; ALTA DE EVENTOS (SIN NÚMERO DE EVENTO)</p></strong></div>


<div  id="mensajeALTAEVENTOS2">
<div class="progress" style="width: 25%;">
<div class="progress-bar" role="progressbar" style="width: <?php echo $Aeventosporcentaje ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $Aeventosporcentaje ; ?>%</div></div>
 </div>
							
	        <div id="target1" style="display:block;" class="content2">
        <div class="card">
          <div class="card-body">
                      <form class="row g-3 needs-validation was-validated" id="ALTAEVENTOSform"  novalidate="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"> 
 
                      <table  style="border-collapse: collapse;" border="1" class="table mb-0 table-striped">



                                    <tr style="background:#efdcf0">

<th scope="row"> <label for="validationCustom03" class="form-label">No. DE EVENTO:</label></th>
<td>

<span id="refreshnumevento">
<?php 

$NUMERO_EVENTO = $altaeventos->refresca_num_evento();

?>
<input type="text" class="form-control" required=""  value="<?php echo $NUMERO_EVENTO; ?>" name="NUMERO_EVENTO" id="NUMERO_EVENTO" placeholder="No. DE EVENTO" readonly="readonly" >
</span>

</td>
</tr>        
		 
         <tr  style="background: #efdcf0"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">FECHA DE ALTA DEL EVENTO:</label></th>
         <td>

 <input type="date" class="form-control" id="validationCustom03" required=""    value="<?php echo date('Y-m-d'); ?>" name="FECHA_ALTA_EVENTO" readonly="readonly">
 </div>
 </td> 




 
                 <tr style="background:#fcf3cf">
    <th style="text-align:left" scope="col">NOMBRE DEL VENDEDOR:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></th>
       <td>
<?php
$encabezadoA = '';
$queryper = $conexion->colaborador_generico_bueno();
$encabezadoA = '<select class="form-select mb-3" aria-label="Default select example" id="NOMBRE_VENDEDOR" required="" name="NOMBRE_VENDEDOR"  placeholder="SELECIONA UNA OPCIÓN">
<option> SELECIONA UNA OPCIÓN</option>';


$fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
$num = 0;

while($row = mysqli_fetch_array($queryper))
{

if($num==8){$num=0;}else{$num++;}

$select='';
if($_SESSION['idem']==$row['idRelacion']){
$select='selected';
}

$option2 .= '<option style="background: #'.$fondos[$num].'" '.$select.' 
value="'.$row['aliasid'].'^^^'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].'">'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].
'</option>';
}
echo $encabezadoA.$option2.'</select>';		
?></td>

    </tr>
	
                  
                 <tr style="background:#fcf3cf">
    <th style="text-align:left" scope="col">NOMBRE DEL RESPONSABLE DEL EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></th>
       <td>
<?php
$encabezadoA = '';
$queryper = $conexion->colaborador_generico_bueno();
$encabezadoA = '<select class="form-select mb-3" aria-label="Default select example" id="NOMBRE_EJECUTIVOEVENTO" required="" name="NOMBRE_EJECUTIVOEVENTO"  placeholder="SELECIONA UNA OPCIÓN">
<option> SELECIONA UNA OPCIÓN</option>';


$fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
$num = 0;

while($row = mysqli_fetch_array($queryper))
{

if($num==8){$num=0;}else{$num++;}

$select='';
if($_SESSION['idem']==$row['idRelacion']){
$select='selected';
}

$option99 .= '<option style="background: #'.$fondos[$num].'" '.$select.' 
value="'.$row['aliasid'].'^^^'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].'">'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].
'</option>';
}
echo $encabezadoA.$option99.'</select>';		
?></td>

    </tr>

 <tr  style="background: #efdcf0"> 

<th scope="row"> <label  for="validationCustom03" class="form-label">NOMBRE DEL EJECUTIVO QUE INGRESO ESTÉ EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
<td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $_SESSION["NOMBREUSUARIO"]; ?>" name="NOMBRE_INGRESO"placeholder="NOMBRE DEL EJECUTIVO QUE INGRESO" readonly="readonly"></td>
</tr>


 <?php if($conexion->variablespermisos('','auditor','ver')=='si'){ ?>

<tr style="background:#fcf3cf">
<th style="text-align:left" scope="col">NOMBRE DEL AUDITOR:</th>
<td>
<?php
$queryper = $conexion->colaborador_generico_bueno();

$encabezadoA = '<select class="form-select mb-3" aria-label="Default select example" id="NOMBRE_AUDITOR" required name="NOMBRE_AUDITOR">
<option value="">SELECCIONA UNA OPCIÓN</option>';

$fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
$num = 0;
$option99 = ""; // si no lo declaras, PHP te lo marca Notice

while($row = mysqli_fetch_array($queryper)){
    if($num==8){$num=0;}else{$num++;}

    $option99 .= '<option style="background:#'.$fondos[$num].'" 
    value="'.$row['aliasid'].'^^^'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].'">'
    .$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].'</option>';
}

echo $encabezadoA.$option99.'</select>';
?>
</td>
</tr><?php } ?>

	
	
	
   <tr style="background:#fcf3cf">
   <th scope="row"> <label for="validationCustom03" class="form-label">FECHA BLOQUEO DEL EVENTO:</label></th>
 <td><input type="date" class="form-control" id="CIERRE_TOTAL" required=""  value="<?php echo $CIERRE_TOTAL; ?>" name="CIERRE_TOTAL"  placeholder="BLOQUEO EVENTO" readonly="readonly"> </div></td></tr>


         	
<tr style="background:#fcf3cf">
    <th> 
        <strong><label for="validationCustom03" class="form-label">STATUS DEL EVENTO:</label></strong>  
    </th>
    <td>
        <span id="desplegadoreset">
            <?php
            $encabezado = '';
            $option = '';
            $queryper = $conexion->desplegables07('ALTA_EVENTOS','STATUS_EVENTO');
            
            // Almacenar y ordenar opciones
            $opciones = array();
            while($row1 = mysqli_fetch_array($queryper)) {
                $opciones[] = $row1;
            }
            usort($opciones, function($a, $b) {
                return strcasecmp($a['nombre_campo'], $b['nombre_campo']);
            });
            
            // Generar HTML
            $encabezado = '<select class="form-select mb-3" aria-label="Default select example" id="STATUS_EVENTO" required="" name="STATUS_EVENTO">
                           <option value="">SELECCIONA UNA OPCIÓN</option>';
            $fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
            $num = 0;
            
            foreach($opciones as $row1) {
                $num = ($num == 8) ? 0 : $num + 1;
                $select = ($STATUS_EVENTO == $row1['nombre_campo']) ? "selected" : "";
                $option .= '<option style="background: #'.$fondos[$num].'" '.$select.' value="'.$row1['nombre_campo'].'">'.strtoupper($row1['nombre_campo']).'</option>';
            }
            echo $encabezado.$option.'</select>';			
            ?>        
        </span>
    </td>
</tr>


			 
				 
				 
				 
				 
         <tr  style="background:#fcf3cf"> 
                 <th scope="row"> 
				 
				 
				 <label  style="width:300px" for="validationCustom03" class="form-label">TIPO DE MONEDA O DIVISA:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
                
      

                 <td>
				 
               
				 <select class="form-select mb-3" aria-label="Default select example" id="validationCustom02" required="" name="MONEDAS">
                
                         <option style="background: #c9e8e8" value="MXN" <?php if($MONEDAS=='MXN'){echo "selected";} ?>>MXN (Peso mexicano)</option>
                         <option style="background: #a3e4d7" value="USD" <?php if($MONEDAS=='USD'){echo "selected";} ?>>USD (Dolar)</option>
                         <option style="background: #e8f6f3" value="EUR" <?php if($MONEDAS=='EUR'){echo "selected";} ?>>EUR (Euro)</option>
                         <option style="background: #fdf2e9" value="GBP" <?php if($MONEDAS=='GBP'){echo "selected";} ?>>GBP (Libra esterlina)</option>
                         <option style="background: #eaeded" value="CHF" <?php if($MONEDAS=='CHF'){echo "selected";} ?>>CHF (Franco suizo)</option>
                         <option style="background: #fdebd0" value="CNY" <?php if($MONEDAS=='CNY'){echo "selected";} ?>>CNY (Yuan)</option>
                         <option style="background: #ebdef0" value="JPY" <?php if($MONEDAS=='JPY'){echo "selected";} ?>>JPY (Yen japonés)</option>
                         <option style="background: #d6eaf8" value="HKD" <?php if($MONEDAS=='HKD'){echo "selected";} ?>>HKD (Dólar hongkonés)</option>
                         <option style="background: #fef5e7" value="CAD" <?php if($MONEDAS=='CAD'){echo "selected";} ?>>CAD (Dólar canadiense)</option>
                         <option style="background: #ebedef" value="AUD" <?php if($MONEDAS=='AUD'){echo "selected";} ?>>AUD (Dólar australiano)</option>
                         <option style="background: #fbeee6" value="BRL" <?php if($MONEDAS=='BRL'){echo "selected";} ?>>BRL (Real brasileño)</option>
                         <option style="background: #e8f6f3" value="RUB" <?php if($MONEDAS=='RUB'){echo "selected";} ?>>RUB  (Rublo ruso)</option>

                         </select> 
                           
							
							</td>                    

                 </tr>

    
         <tr style="background:#fcf3cf"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">MONTO TOTAL COTIZADO DEL EVENTO<a style="color:red;font-size:15px">     CON IVA </a>Y SIN BOLETOS DE AVION :<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td>

         <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"  style="width:350px;height:40px;"  id="tol" required="" onkeyup="calcular()"  value="<?php echo number_format($MONTOC_TOTAL_EVENTO,2,'.',','); ?>" name="MONTOC_TOTAL_EVENTO" class="tol"   placeholder="MONTO TOTAL COTIZADO DEL EVENTO">
 </div>
 </td>
         </tr>
         <tr  style="background:#fcf3cf">                                           
         <th scope="row"> <label for="validationCustom03" class="form-label"> BOLETOS DE AVION<a style="color:red;font-size:15px">     CON IVA </a>:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
        
         <td> <div class="input-group mb-3"> <span class="input-group-text">$</span><input type="text"  style="width:350px;height:40px;"  id="tol" required=""  onkeyup="calcular()" value="<?php echo number_format($MONTO_TOTAL_AVION,2,'.',','); ?>" name="MONTO_TOTAL_AVION" class="tol" placeholder="MONTO TOTAL COTIZADO DE BOLETOS DE AVION"></td>
         </div></tr>		 
		 
		 
		 
		         <tr style="background:#fcf3cf"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">MONTO TOTAL COTIZADO DEL EVENTO <a style="color:red;font-size:15px">SIN IVA </a>Y SIN BOLETOS DE AVION :<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td>

         <div class="input-group mb-3"> <span class="input-group-text">$</span> <input type="text"  style="width:350px;height:40px;"  id="" 
		 value="<?php echo number_format($CANTIDAD_PORCENTAJEV,2,'.',','); ?>" onkeyup="comasainput('CANTIDAD_PORCENTAJEV')"  name="CANTIDAD_PORCENTAJEV" class=""      placeholder=" MONTO TOTAL COTIZADO DEL EVENTO">
 </div>
 </td>
         </tr>
        

		 
		 
		 
		 
		 
		          <tr  style="background:#fcf3cf">                                           
         <th scope="row"> <label for="validationCustom03" class="form-label"> BOLETOS DE AVION<a style="color:red;font-size:15px"> SIN IVA </a>:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
        
         <td> <div class="input-group mb-3"> <span class="input-group-text">$</span><input type="text"  style="width:350px;height:40px;"  onkeyup="comasainput('TOTAL_AVION_SINIVA')" required=""  value="<?php echo number_format($TOTAL_AVION_SINIVA,2,'.',','); ?>" name="TOTAL_AVION_SINIVA"  placeholder="MONTO TOTAL COTIZADO DE BOLETOS DE AVION SIN IVA"></td>
         </div></tr>
		 
             <tr  style="background: #efdcf0">                                           
         <th scope="row"> <label for="validationCustom03" class="form-label"> PORCENTAJE  FEE COBRADO AL CLIENTE:</label></th>
        
         <td> <div class="input-group mb-3"> <span class="input-group-text">%</span><input type="text"  style="width:350px;height:40px;background:#DAE1ED"  required="" 
		 value="<?php echo $PORCENTAJE_FEE; ?>" name="PORCENTAJE_FEE"  placeholder="PORCENTAJE  FEE COBRADO AL CLIENTE" readonly="readonly"></td>
         </div></tr>
		 
             <tr  style="background: #efdcf0">                                           
         <th scope="row"> <label for="validationCustom03" class="form-label">FEE COBRADO AL CLIENTE:</label></th>
        
         <td> <div class="input-group mb-3"> <span class="input-group-text">$</span><input type="text"  style="width:350px;height:40px;background:#DAE1ED"  id="tol" required="" onkeyup="calcular()"  value="<?php echo number_format($FEE_COBRADO,2,'.',','); ?>" name="FEE_COBRADO" class="tol" placeholder="FEE COBRADO AL CLIENTE" readonly="readonly"></td>
         </div></tr>
		 
         <tr style="background: #efdcf0"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">MONTO TOTAL DEL EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td>

         <div class="input-group mb-3"> <span class="input-group-text">$</span><input type="text"  class="form-control" id="MONTO_TOTAL_DEL_EVENTO" required="" value="<?php echo number_format($MONTO_TOTAL_DEL_EVENTO,2,'.',','); ?>" name="MONTO_TOTAL_DEL_EVENTO" placeholder="MONTO TOTAL DEL EVENTO:"  readonly="readonly">
 </div>
 </td>
         </tr>


    





<tr style="background:#fcf3cf">
    <th scope="row">
        <label for="validationCustom03" class="form-label">
            NOMBRE DEL EVENTO:<br>
            <a style="color:red;font-size:11px">OBLIGATORIO</a>
        </label>
    </th>

    <td>

        <!-- INPUT PRINCIPAL -->
        <input 
            type="text" 
            class="form-control" 
            id="validationCustom03" 
            required 
            value="<?php echo $NOMBRE_EVENTO; ?>" 
            name="NOMBRE_EVENTO"
            placeholder="NOMBRE DEL EVENTO"
        >

 </td></tr>

      
         <tr style="background:#fcf3cf">
         <th scope="row"> <label for="validationCustom03" class="form-label">NOMBRE CORTO DEL EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td>

 <input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $NOMBRE_CORTO_EVENTO; ?>" name="NOMBRE_CORTO_EVENTO" placeholder="NOMBRE CORTO DEL EVENTO">    
 </td>
         </tr>
		








         <tr style="background: #efdcf0">
         <th scope="row"> <label for="validationCustom03" class="form-label">NOMBRE COMERCIAL DE LA EMPRESA (CLIENTE):</label></th>
         <td>
		 
		 <input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $NOMBRE_COMERCIAL_EVENTO; ?>" name="NOMBRE_COMERCIAL_EVENTO" placeholder="NOMBRE COMERCIAL DE LA EMPRESA (CLIENTE)" >
		 
		 </td>
         </tr>
		          <tr style="background:#fcf3cf"> 
       <th><label for="validationCustom02" class="form-label"> NOMBRE FISCAL O RAZÓN SOCIAL DE LA EMPRESA (CLIENTE):</label></th>
        <td>
		 
		 <input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $NOMBRE_FISCAL_EVENTO; ?>" name="NOMBRE_FISCAL_EVENTO" placeholder="NOMBRE FISCAL DE LA EMPRESA (CLIENTE)" >
		 
		 </td>
         </tr>

         <tr style="background: #efdcf0"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">NOMBRE DEL CONTACTO CLIENTE:</label></th>
         <td>

 <input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $NOMBRE_CONTACTO_EVENTO; ?>" name="NOMBRE_CONTACTO_EVENTO" placeholder="NOMBRE DEL CONTACTO CLIENTE 1" >
 </div>
 </td>
         </tr>
         <tr style="background: #efdcf0">
         <th scope="row"> <label for="validationCustom03" class="form-label">CÉLULAR DEL CONTACTO CLIENTE:</label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $CELULAR_CONTACTO_1; ?>" name="CELULAR_CONTACTO_1" placeholder="CELULAR DEL CONTACTO CLIENTE 1" ></td>
         </tr>
        
         <tr style="background: #efdcf0"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">CORREO DEL CONTACTO CLIENTE:</label></th>
         <td>

 <input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $CORREO_CONTACTO_1; ?>" name="CORREO_CONTACTO_1" placeholder="CORREO DEL CONTACTO CLIENTE 1" >
 </div>
 </td>
         </tr>
         <tr style="background: #efdcf0">  

         <th scope="row"> <label for="validationCustom03" class="form-label">DEPARTAMENTO O ÁREA DEL CONTACTO CLIENTE:</label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $AREA_CONTACTO_CLIENTE; ?>" name="AREA_CONTACTO_CLIENTE"placeholder="AREA DEL CONTACTO CLIENTE 1" ></td>
         </tr>
         	 
         <tr style="background:#fcf3cf"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">OBSERVACIONES:     </label></th>
         <td>

 <input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $OBSERVACIONES_1; ?>" name="OBSERVACIONES_1" placeholder="OBSERVACIONES 1" >
 </div>
 </td>
         </tr>


<tr style="background:#fcf3cf">
    <th> 
        <strong><label for="validationCustom03" class="form-label">TIPO DE EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></strong>  
    </th>
    <td>
        <span id="desplegadoreset">
            <?php
            $encabezado = '';
            $option = '';
            $queryper = $conexion->desplegables07('ALTA_EVENTOS','TIPO_EVENTO');
            
            // Almacenar todas las opciones en un arreglo
            $opciones = array();
            while($row1 = mysqli_fetch_array($queryper)) {
                $opciones[] = $row1;
            }
            
            // Ordenar alfabéticamente (sin distinguir mayúsculas/minúsculas)
            usort($opciones, function($a, $b) {
                return strcasecmp($a['nombre_campo'], $b['nombre_campo']);
            });
            
            $encabezado = '<select class="form-select mb-3" aria-label="Default select example" id="TIPO_DE_EVENTO" required="" name="TIPO_DE_EVENTO">
                           <option value="">SELECCIONA UNA OPCIÓN</option>';
            $fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
            $num = 0;
            
            foreach($opciones as $row1) {
                if($num == 8) { 
                    $num = 0; 
                } else { 
                    $num++; 
                }
                $select = ($TIPO_DE_EVENTO == $row1['nombre_campo']) ? "selected" : "";
                $option .= '<option style="background: #'.$fondos[$num].'" '.$select.' value="'.$row1['nombre_campo'].'">'.strtoupper($row1['nombre_campo']).'</option>';
            }
            echo $encabezado.$option.'</select>';			
            ?>		
        </span>
    </td>
</tr>
         


<tr  style="background:#fcf3cf">
<th> <strong><label for="validationCustom03" class="form-label">FORMATO DEL EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></strong>  </th>
                        <td>  <select class="form-select mb-3" aria-label="Default select example" id="" required="" name="FORMATO_EVENTO" >
                         <option selected="">SELECCIONA UNA OPCION</option>

                       
                         <option style="background:#d9f9fa " <?php if($FORMATO_EVENTO=='PRESENCIAL'){echo "selected";} ?> value="PRESENCIAL">PRESENCIAL</option>
                         <option style="background:#eff9eb " <?php if($FORMATO_EVENTO=='VIRTUAL'){echo "selected";} ?> value="VIRTUAL">VIRTUAL</option>
                         <option style="background:#e1f5de " <?php if($FORMATO_EVENTO=='HIBRIDO'){echo "selected";} ?> value="HIBRIDO">HIBRIDO</option>
                  

						 </select>
						 
						 </td>

                 </tr>

         </tr>

<tr style="background:#fcf3cf">    
    <th scope="row"> 
        <label style="width:300px" for="validationCustom03" class="form-label">PAÍS DONDE SE LLEVARA A CABO EL EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label>
    </th>
    <td>
        <?php
        if($PAIS_DEL_EVENTO != ''){$DESHABILITAR = 'disabled';}
        $encabezado = '';
        $option = '';
        $queryper = $conexion->paises();
        // Agregamos estilo CSS al select
        $encabezado = '<select class="form-select mb-3" aria-label="Default select example" 
                        id="validationCustom02" required="" name="PAIS_DEL_EVENTO"
                        style="text-transform: uppercase;"> 
                        <option value="" '.$DESHABILITAR.'>SELECCIONA UNA OPCIÓN </option>';
        
        $fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
        $num = 0;
        
        while($row1 = mysqli_fetch_array($queryper)) {
            if($num == 8){$num = 0;} else {$num++;}
            $PAIS_DEL_EVENTO = 'México';
            $select = '';
            if( $row1['nombre']==$PAIS_DEL_EVENTO ){$select = "selected";}
            
            // Convertimos el texto a mayúsculas (doble seguridad)
            $option .= '<option style="background: #'.$fondos[$num].'" '.$select.' 
                        value="'.$row1['nombre'].'" '.$DESHABILITAR.'>'
                        .strtoupper($row1['nombre']).'</option>';
        }
        echo $encabezado.$option.'</select>';			
        ?>	
    </td>
</tr>




         <tr style="background:#fcf3cf">
         <th scope="row"> <label for="validationCustom03" class="form-label">CIUDAD DONDE SE LLEVARA A CABO EL EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $CIUDAD_DEL_EVENTO; ?>" name="CIUDAD_DEL_EVENTO" placeholder="CIUDAD DONDE SE LLEVARA A CABO EL EVENTO"></td>
         </tr>
        
        <tr style="background:#fcf3cf">
         <th scope="row"> <label for="validationCustom03" class="form-label">HOTEL O LUGAR:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td>

 <input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $HOTEL_LUGAR; ?>" name="HOTEL_LUGAR"placeholder="HOTEL O LUGAR">
 </div>
 </td>
         </tr>
         <tr style="background:#fcf3cf">  

         <th scope="row"> <label for="validationCustom03" class="form-label">NÚMERO DE PERSONAS:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $NUMERO_DE_PERSONAS; ?>" name="NUMERO_DE_PERSONAS"placeholder="NUMERO DE PERSONAS"></td>
         </tr>
     
        
        <tr style="background:#fcf3cf">
         <th scope="row"> <label for="validationCustom03" class="form-label">FECHA INICIO DEL EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td>

 <input type="date" class="form-control" id="validationCustom03" required=""  value="<?php echo $FECHA_INICIO_EVENTO; ?>" name="FECHA_INICIO_EVENTO"placeholder="DIA DE INICIO DEL EVENTO">
 </div>
 </td>
         </tr>
        
         <tr  style="background:#fcf3cf"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">HORA DE INICIO DEL EVENTO:</label></th>
         <td ><input type="time" class="form-control" required=""  value="<?php echo $NOMBRE_COMERCIAL; ?>" name="NOMBRE_COMERCIAL" placeholder="HORA DE INICIO DEL EVENTO"></td>
         </tr>

         <tr style="background:#fcf3cf"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">FECHA FINAL DEL EVENTO:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
         <td>

 <input type="date" class="form-control" id="FECHA_FINAL_EVENTO" required="" oninput="actualizarFechaDestino()" value="<?php echo $FECHA_FINAL_EVENTO; ?>" name="FECHA_FINAL_EVENTO" placeholder="FECHA FINAL DEL EVENTO">
 </div>
 </td>
         </tr>

        
         <tr  style="background:#fcf3cf"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">HORA DE TERMINO EVENTO:</label></th>
         <td>

 <input type="time" class="form-control" id="validationCustom03" required=""  value="<?php echo $HORA_TERMINO_EVENTO; ?>" name="HORA_TERMINO_EVENTO"placeholder="HORA DE TERMINO EVENTO">
 </div>
 </td>
         </tr>
        <tr style="background:#fcf3cf"> 

         <th scope="row"> <label for="validationCustom03" class="form-label">FECHA LLEGADA DEL STAFF:</label></th>
         <td><input type="date" class="form-control" id="validationCustom03" required=""  value="<?php echo $FECHA_LLEGADA_STAFF; ?>" name="FECHA_LLEGADA_STAFF"placeholder="DIA DE LLEGADA DEL STAFF"></td>
         </tr>

        
         <tr  style="background:#fcf3cf"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">HORA LLEGADA DEL STAFF:</label></th>
         <td>

 <input type="time" class="form-control" id="validationCustom03" required=""  value="<?php echo $HORA_LLEGADA_STAFF; ?>" name="HORA_LLEGADA_STAFF"placeholder="HORA DE TERMINO EVENTO">
 </div>
 </td>
         </tr>
    
        
        <tr style="background:#fcf3cf">
         <th scope="row"> <label for="validationCustom03" class="form-label">FECHA  REGRESO DEL STAFF:</label></th>
         <td>

 <input type="date" class="form-control" id="validationCustom03" required=""  value="<?php echo $FECHA_REGRESO_STAFF; ?>" name="FECHA_REGRESO_STAFF"placeholder="FECHA DE REGRESO DEL STAFF:">
 </div>
 </td>
         </tr>
         <tr style="background:#fcf3cf"> 

         <th scope="row"> <label for="validationCustom03" class="form-label">HORA REGRESO DEL STAFF:</label></th>
         <td><input type="time" class="form-control" id="validationCustom03" required=""  value="<?php echo $HORA_REGRESO_STAFF; ?>" name="HORA_REGRESO_STAFF" placeholder="HORA DE REGRESO DEL STAFF"></td>
         </tr>




		<tr style="background:#fcf3cf">
		<th scope="row"> <label  style="width:300px" for="validationCustom03" class="form-label">REQUIERE DE MATERIAL Y EQUIPO DE BODEGA?</label></th>    
		<td><select class="form-select mb-3" aria-label="Default select example" id="validationCustom02" required="" name="MATERIAL_EQUIPO_BODEGA"> >
		<option selected="">SELECCIONA UNA OPCIÓN</option>
		<option style="background: #c9e8e8" value="SI" <?php if($MATERIAL_EQUIPO_BODEGA=='SI'){echo "selected";} ?>>SI</option>
		<option style="background: #a3e4d7" value="NO" <?php if($MATERIAL_EQUIPO_BODEGA=='NO'){echo "selected";} ?>>NO</option>
		</select> 
		</div> 
		</tr>
        <tr style="background:#fcf3cf"> 
        <th scope="row"> <label for="validationCustom03" class="form-label">FECHA DE INICIO DE MONTAJE:</label></th>
        <td><input type="date" class="form-control" id="validationCustom03" required=""  value="<?php echo $FECHA_INICIO_MONTAJE; ?>" name="FECHA_INICIO_MONTAJE" placeholder="FECHA DE INICIO DE MONTAJE"></td>
        </tr>
		<tr style="background:#fcf3cf"> 
        <th scope="row"> <label for="validationCustom03" class="form-label">HORA DE INICIO DE MONTAJE:</label></th>
        <td><input type="time" class="form-control" id="validationCustom03" required=""  value="<?php echo $HORA_INICIO_MONTAJE; ?>" name="HORA_INICIO_MONTAJE" placeholder="HORA DE INICIO DE MONTAJE"></td>
        </tr>
        <tr style="background:#fcf3cf"> 
        <th scope="row"> <label for="validationCustom03" class="form-label">FECHA DE DESMONTAJE:</label></th>
        <td><input type="date" class="form-control" id="validationCustom03" required=""  value="<?php echo $FECHA_DESMONTAJE; ?>" name="FECHA_DESMONTAJE" placeholder="FECHA DE DESMONTAJE"></td>
        </tr>
		<tr style="background:#fcf3cf"> 
        <th scope="row"> <label for="validationCustom03" class="form-label">HORA DE INICIO DE DESMONTAJE:</label></th>
        <td><input type="time" class="form-control" id="validationCustom03" required=""  value="<?php echo $HORA_DESMONTAJE; ?>" name="HORA_DESMONTAJE" placeholder="HORA DE INICIO DE DESMONTAJE"></td>
        </tr>
        <tr style="background:#fcf3cf"> 
        <th scope="row"> <label for="validationCustom03" class="form-label">LUGAR DE MONTAJE Y DESMONTAJE:</label></th>
        <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $LUGAR_MONTAJE; ?>" name="LUGAR_MONTAJE" placeholder="LUGAR DE MONTAJE Y DESMONTAJE:"></td>
        </tr>






	<tr style="background:#fcf3cf">  
    <th scope="row"> <label for="validationCustom03" class="form-label">ADJUNTAR ARCHIVO RELACIONADO CON EL MONTAJE:</label></th> <td>
    <div id="drop_file_zone" ondrop="upload_file(event,'ARCHIVO_RELACIONADO_MONTAJE')" ondragover="return false" ><p>Suelta aquí o busca tu archivo</p>
	<p><input class="form-control form-control-sm" id="ARCHIVO_RELACIONADO_MONTAJE" type="text" onkeydown="return false" onclick="file_explorer('ARCHIVO_RELACIONADO_MONTAJE');"  VALUE="<?php echo $ARCHIVO_RELACIONADO_MONTAJE; ?>" required /></p>
    <input type="file" name="ARCHIVO_RELACIONADO_MONTAJE" id="nono"/>
    <div id="1ARCHIVO_RELACIONADO_MONTAJE">
    <?php
    if($ARCHIVO_RELACIONADO_MONTAJE!=""){echo "<a target='_blank' href='includes/archivos/".$ARCHIVO_RELACIONADO_MONTAJE."'>Visualizar!</a>"; 
     }?></div>
     </div>         
     <div id="2ARCHIVO_RELACIONADO_MONTAJE"><?php $querycontras2 = $altaeventos->Listado_fotoseventostemporal('ARCHIVO_RELACIONADO_MONTAJE',date('Y-m-d'),$_SESSION['idem']);
     while($row2=mysqli_fetch_array($querycontras2)){
    echo "<a target='_blank' href='includes/archivos/".$row2['ARCHIVO_RELACIONADO_MONTAJE']."' id='A".$row2['id']."' >Visualizar!</a> "." <span id='".$row2['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$row2['fecha']."</span>".'<br/>';
     }
    ?></div>				 
    </td></tr>

        <tr style="background:#fcf3cf"> 
        <th scope="row"> <label for="validationCustom03" class="form-label">SERVICIOS PARA OTORGAR:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th>
        <td><input type="text" class="form-control" id="validationCustom03" required=""  value="<?php echo $SERVICIO_OTORGAR; ?>" name="SERVICIO_OTORGAR" placeholder="SERVICIOS PARA OTORGAR:"></td>
        </tr>
 



    <tr style="background:#fcf3cf">  
    <th scope="row"> <label for="validationCustom03" class="form-label">SUBIR COTIZACIÓN PARA EL CLIENTE:<br><a style="color:red;font-size:11px">OBLIGATORIO</a></label></th> <td>
    <div id="drop_file_zone" ondrop="upload_file(event,'SUBIR_COTIZACION')" ondragover="return false" ><p>Suelta aquí o busca tu archivo</p>
	<p><input class="form-control form-control-sm" id="SUBIR_COTIZACION" type="text" onkeydown="return false" onclick="file_explorer('SUBIR_COTIZACION');"  VALUE="<?php echo $SUBIR_COTIZACION; ?>" required /></p>
    <input type="file" name="SUBIR_COTIZACION" id="nono"/>
    <div id="1SUBIR_COTIZACION">
    <?php
    if($SUBIR_COTIZACION!=""){echo "<a target='_blank' href='includes/archivos/".$SUBIR_COTIZACION."'>Visualizar!</a>"; 
     }?></div>
     </div>         
     <div id="2SUBIR_COTIZACION"><?php $querycontras2 = $altaeventos->Listado_fotoseventostemporal('SUBIR_COTIZACION',date('Y-m-d'),$_SESSION['idem']);
     while($row2=mysqli_fetch_array($querycontras2)){
    echo "<a target='_blank' href='includes/archivos/".$row2['SUBIR_COTIZACION']."' id='A".$row2['id']."' >Visualizar!</a> "." <span id='".$row2['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$row2['fecha']."</span>".'<br/>';
     }
    ?></div>				 
    </td></tr>




<tr style="background:#fcf3cf">  

<th scope="row"> <label for="validationCustom03" class="form-label">SUBIR ORDEN DE COMPRA DEL CLIENTE:</label></th>
<td>
<div id="drop_file_zone" ondrop="upload_file(event,'SUBIR_ORDEN_COMPRA')" ondragover="return false" >
<p>Suelta aquí o busca tu archivo</p>
<p><input class="form-control form-control-sm" id="SUBIR_ORDEN_COMPRA" type="text" onkeydown="return false" onclick="file_explorer('SUBIR_ORDEN_COMPRA');"  VALUE="<?php echo $SUBIR_ORDEN_COMPRA; ?>" required /></p>
<input type="file" name="SUBIR_ORDEN_COMPRA" id="nono"/>
<div id="1SUBIR_ORDEN_COMPRA">
<?php
if($SUBIR_ORDEN_COMPRA!=""){echo "<a target='_blank' href='includes/archivos/".$SUBIR_ORDEN_COMPRA."'>Visualizar!</a>"; 
}?></div>
</div>         
<div id="2SUBIR_ORDEN_COMPRA"><?php $querycontras2 = $altaeventos->Listado_fotoseventostemporal('SUBIR_ORDEN_COMPRA',date('Y-m-d'),$_SESSION['idem']);

while($row2=mysqli_fetch_array($querycontras2)){
echo "<a target='_blank' href='includes/archivos/".$row2['SUBIR_ORDEN_COMPRA']."' id='A".$row2['id']."' >Visualizar!</a> "." <span id='".$row2['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$row2['fecha']."</span>".'<br/>';
}
?></div>				 
</td></tr>




<tr style="background:#fcf3cf">  

<th scope="row"> <label for="validationCustom03" class="form-label">SUBIR CONTRATO FIRMADO:</label></th>
<td>
<div id="drop_file_zone" ondrop="upload_file(event,'SUBIR_CONTRATO_FIRMADO')" ondragover="return false" >
<p>Suelta aquí o busca tu archivo</p>
<p><input class="form-control form-control-sm" id="SUBIR_CONTRATO_FIRMADO" type="text" onkeydown="return false" onclick="file_explorer('SUBIR_CONTRATO_FIRMADO');"  VALUE="<?php echo $SUBIR_CONTRATO_FIRMADO; ?>" required /></p>
<input type="file" name="SUBIR_CONTRATO_FIRMADO" id="nono"/>
<div id="1SUBIR_CONTRATO_FIRMADO">
<?php
if($SUBIR_CONTRATO_FIRMADO!=""){echo "<a target='_blank' href='includes/archivos/".$SUBIR_CONTRATO_FIRMADO."'>Visualizar!</a>"; 
}?></div>
</div>         
<div id="2SUBIR_CONTRATO_FIRMADO"><?php $querycontras2 = $altaeventos->Listado_fotoseventostemporal('SUBIR_CONTRATO_FIRMADO',date('Y-m-d'),$_SESSION['idem']);

while($row2=mysqli_fetch_array($querycontras2)){
echo "<a target='_blank' href='includes/archivos/".$row2['SUBIR_CONTRATO_FIRMADO']."' id='A".$row2['id']."' >Visualizar!</a> "." <span id='".$row2['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$row2['fecha']."</span>".'<br/>';
}
?></div>				 
</td></tr>


<tr style="background:#fcf3cf"> 
<th scope="row"> <label for="validationCustom03" class="form-label">SUBIR COTIZACIÓN FIRMADA POR EL CLIENTE AUTORIZANDO EL EVENTO:</label></th>
<td>
<div id="drop_file_zone" ondrop="upload_file(event,'SUBIR_COTIZACION_FIRMADA')" ondragover="return false" >
<p>Suelta aquí o busca tu archivo</p>
<p><input class="form-control form-control-sm" id="SUBIR_COTIZACION_FIRMADA" type="text" onkeydown="return false" onclick="file_explorer('SUBIR_COTIZACION_FIRMADA');"  VALUE="<?php echo $SUBIR_COTIZACION_FIRMADA; ?>" required /></p>
<input type="file" name="SUBIR_COTIZACION_FIRMADA" id="nono"/>
<div id="1SUBIR_COTIZACION_FIRMADA">
<?php
if($SUBIR_COTIZACION_FIRMADA!=""){echo "<a target='_blank' href='includes/archivos/".$SUBIR_COTIZACION_FIRMADA."'>Visualizar!</a>"; 
}?></div>
</div>         
<div id="2SUBIR_COTIZACION_FIRMADA"><?php $querycontras2 = $altaeventos->Listado_fotoseventostemporal('SUBIR_COTIZACION_FIRMADA',date('Y-m-d'),$_SESSION['idem']);

while($row2=mysqli_fetch_array($querycontras2)){
echo "<a target='_blank' href='includes/archivos/".$row2['SUBIR_COTIZACION_FIRMADA']."' id='A".$row2['id']."' >Visualizar!</a> "." <span id='".$row2['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$row2['fecha']."</span>".'<br/>';
}
?></div>				 
</td></tr>


      
<tr style="background:#fcf3cf">  

<th scope="row"> <label for="validationCustom03" class="form-label">LOGO DEL CLIENTE:</label></th>
<td>
<div id="drop_file_zone" ondrop="upload_file(event,'LOGO_CLIENTE')" ondragover="return false" >
<p>Suelta aquí o busca tu archivo</p>
<p><input class="form-control form-control-sm" id="LOGO_CLIENTE" type="text" onkeydown="return false" onclick="file_explorer('LOGO_CLIENTE');"  VALUE="<?php echo $LOGO_CLIENTE; ?>" required /></p>
<input type="file" name="LOGO_CLIENTE" id="nono"/>
<div id="1LOGO_CLIENTE">
<?php
if($LOGO_CLIENTE!=""){echo "<a target='_blank' href='includes/archivos/".$LOGO_CLIENTE."'>Visualizar!</a>"; 
}?></div>
</div>         
<div id="2LOGO_CLIENTE"><?php $querycontras2 = $altaeventos->Listado_fotoseventostemporal('LOGO_CLIENTE',date('Y-m-d'),$_SESSION['idem']);

while($row2=mysqli_fetch_array($querycontras2)){
echo "<a target='_blank' href='includes/archivos/".$row2['LOGO_CLIENTE']."' id='A".$row2['id']."' >Visualizar!</a> "." <span id='".$row2['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$row2['fecha']."</span>".'<br/>';
}
?></div>				 
</td></tr>





         <tr style="background:#fcf3cf"> 
         <th scope="row"> <label for="validationCustom03" class="form-label">IMÁGEN DEL EVENTO:</label></th>
<td>
<div id="drop_file_zone" ondrop="upload_file(event,'IMAGEN_EVENTO')" ondragover="return false" >
<p>Suelta aquí o busca tu archivo</p>
<p><input class="form-control form-control-sm" id="IMAGEN_EVENTO" type="text" onkeydown="return false" onclick="file_explorer('IMAGEN_EVENTO');"  VALUE="<?php echo $IMAGEN_EVENTO; ?>" required /></p>
<input type="file" name="IMAGEN_EVENTO" id="nono"/>
<div id="1IMAGEN_EVENTO">
<?php
if($IMAGEN_EVENTO!=""){echo "<a target='_blank' href='includes/archivos/".$IMAGEN_EVENTO."'>Visualizar!</a>"; 
}?></div>
</div>         
<div id="2IMAGEN_EVENTO"><?php $querycontras2 = $altaeventos->Listado_fotoseventostemporal('IMAGEN_EVENTO',date('Y-m-d'),$_SESSION['idem']);

while($row2=mysqli_fetch_array($querycontras2)){
echo "<a target='_blank' href='includes/archivos/".$row2['IMAGEN_EVENTO']."' id='A".$row2['id']."' >Visualizar!</a> "." <span id='".$row2['id']."' class='view_dataAEborrar' style='cursor:pointer;color:blue;'>Borrar!</span><span > ".$row2['fecha']."</span>".'<br/>';
}
?></div>				 
</td></tr>



 
                  </table><table><tr>



                                    
    <input type="hidden" value="hALTAEVENTOS" name="hALTAEVENTOS">     
 
   <td>
           

 <button  style="float:right"  class="btn btn-sm btn-outline-success px-5"  type="button" id="MODIFICAR_EVENTOS" name="MODIFICAR_EVENTOS">MODIFICAR</button><div style="
    color: #f5f5f5;
    text-shadow: 1px 1px 1px #919191,
        1px 2px 1px #919191,
        1px 3px 1px #919191,
        1px 4px 1px #919191,
        1px 5px 1px #919191,
        1px 6px 1px #919191,
        1px 7px 1px #919191,
        1px 8px 1px #919191,
        1px 9px 1px #919191,
        1px 10px 1px #919191,
    1px 18px 6px rgba(16,16,16,0.4),
    1px 22px 10px rgba(16,16,16,0.2),
    1px 25px 35px rgba(16,16,16,0.2),
    1px 30px 60px rgba(16,16,16,0.4);
	@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 100; }
}"


 id="mensajeALTAEVENTOS"/></td>
    <?php if($conexion->variablespermisos('','ALTA_EVENTOSF','guardar')=='si'){ ?>
 <td>
           

 <button  style="float:right"  class="btn btn-sm btn-outline-success px-5"  type="button" id="ENVIAR_EVENTOS" name="ENVIAR_EVENTOS">GUARDAR</button><div style="
    color: #f5f5f5;
    text-shadow: 1px 1px 1px #919191,
        1px 2px 1px #919191,
        1px 3px 1px #919191,
        1px 4px 1px #919191,
        1px 5px 1px #919191,
        1px 6px 1px #919191,
        1px 7px 1px #919191,
        1px 8px 1px #919191,
        1px 9px 1px #919191,
        1px 10px 1px #919191,
    1px 18px 6px rgba(16,16,16,0.4),
    1px 22px 10px rgba(16,16,16,0.2),
    1px 25px 35px rgba(16,16,16,0.2),
    1px 30px 60px rgba(16,16,16,0.4);
	@keyframes fadeIn {
  0% { opacity: 0; }
  100% { opacity: 100; }
}"


 id="mensajeALTAEVENTOS"/></td></tr><?php } ?>
           
                   </table>
                  </form>
                  <?php if($conexion->variablespermisos('','ALTA_EVENTOSF','email')=='si'){ ?>
                 <form name="form_emai_altaevento" id="form_emai_altaevento">
             <td ><textarea  placeholder="ESCRIBE AQUÍ TUS CORREOS SEPARADOS POR PUNTO Y COMA EJEMPLO: NOMBRE@CORREO.ES;NOMBRE@CORREO.ES" style="width: 500px;" name="EMAIL_ALTA_EVENTOS" id="EMAIL_ALTA_EVENTOS" class="form-control" aria-label="With textarea"><?php echo $EMAIL_ALTA_EVENTOS; ?></textarea>
            <button class="btn btn-sm btn-outline-success px-5"  type="button" id="BUTTON_ALTA_EVENTOS">ENVIAR POR EMAIL</button></td> <?php } ?>  
                
           </tr></table>

<style>
  /* Para el input de búsqueda de Select2 */
  .select2-container--classic .select2-search__field {
    text-transform: uppercase;
  }
</style>
</div> 
</div>
</div>
