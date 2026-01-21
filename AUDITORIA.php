<div id="content">     
			<hr/>
		<strong>	  <p class="mb-0 text-uppercase" ><img src="includes/contraer31.png" id="mostrar9" style="cursor:pointer;"/>
<img src="includes/contraer41.png" id="ocultar9" style="cursor:pointer;"/>&nbsp;&nbsp;&nbsp; AUTORIZACIÓN PARA DAR DE ALTA  UN EVENTO </p></strong></div>


<div  id="mensajenumeroevento2">
<div class="progress" style="width: 25%;">
									<div class="progress-bar" role="progressbar" style="width: <?php echo $NEporcentaje ; ?>%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"><?php echo $Aeventosporcentaje ; ?>%</div></div>
									</div>
							
	        <div id="target9" style="display:block;" class="content2">
        <div class="card">
          <div class="card-body">
                      <form class="row g-3 needs-validation was-validated" id="numeroeventosform"  novalidate="" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
 
                




                      <div class="col-md-4"style="background:#fbeee6">
                      <strong>  <label for="validationCustom01" class="form-label">NOMBRE DEL COLABORADOR:</label></strong>
<?php
$encabezadoA = '';
$queryper = $conexion->colaborador_generico_bueno();
$encabezadoA = '<select class="form-select mb-3" aria-label="Default select example" id="NUMERO_EVENTO_COLABORADOR" required="" name="NUMERO_EVENTO_COLABORADOR"  placeholder="SELECIONA UNA OPCIÓN"><option value="MARIA AMPARO RODRIGUEZ GALEANA">MARIA AMPARO RODRIGUEZ GALEANA</option>';


$fondos = array("fff0df","f4ffdf","dfffed","dffeff","dfe8ff","efdfff","ffdffd","efdfff","ffdfe9");
$num = 0;

while($row = mysqli_fetch_array($queryper))
{

if($num==8){$num=0;}else{$num++;}

$select='';
if('MARIA AMPARO RODRIGUEZ'==$row['NOMBRE_1'].' '.$row['APELLIDO_PATERNO'] OR 'AMPARO RODRIGUEZ'==$row['NOMBRE_1'].' '.$row['APELLIDO_PATERNO']){
$select='selected';
}

$option2 .= '<option style="background: #'.$fondos[$num].'" '.$select.' 
value="'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].'">'.$row['NOMBRE_1'].' '.$row['NOMBRE_2'].' '.$row['APELLIDO_PATERNO'].' '.$row['APELLIDO_MATERNO'].
'</option>';
}
echo $encabezadoA.$option2.'</select>';		
?>                          <div class="valid-feedback">Bien!</div>
                        </div>


			  
						
                        <div class="col-md-4"style="background:#d4f6c8">

                        <strong>
						
						<label for="validationCustom01" class="form-label">INICIALES DE LA EMPRESA:</label></strong>
						  
						  <?php
						  $encabezado='';$option='';
	$queryper = $altaeventos->lista_inicialescorp();
	$encabezado = '<select class="form-select mb-3" aria-label="Default select example" id="INICIALES_EMPRESA_EVENTO" required="" name="INICIALES_EMPRESA_EVENTO"  onchange="getval();">
	<option value="">SELECCIONA UNA OPCIÓN</option>';	
	while($row1 = mysqli_fetch_array($queryper))
	{
	$select='';
	if($INICIALES_EMPRESA_EVENTO==$row1['NCE_OBSERVACIONES']){$select = "selected";};

	$option .= '<option style="background: #c9e8e8" '.$select.' value="'.$row1['NCE_OBSERVACIONES'].'">'.$row1['NCE_OBSERVACIONES'].'</option>';
	}
	echo $encabezado.$option.'</select>';			
	?>
						  
						  
						  
						  
                        </div>
						
						
						
						
                        <div class="col-md-4"style="background:#fbeee6">

                        <strong>   <label for="validationCustom01" class="form-label">NÚMERO DE EVENTO</label></strong>
						
						<span id="numeroeventoiniciales">
						<?php $NCE_OBSERVACIONES= $_SESSION['INICIALES_EMPRESA_EVENTO1']; ?>
                          <input type="text" class="form-control" id="validationCustom01" value="<?php echo $queryper = $altaeventos->NUMERO_EVENTO($NCE_OBSERVACIONES); ?>" required="" name="NUMERO_DE_EVENTO">
                          <div class="valid-feedback">Bien!</div>
						</span>  
						  
						  
						  </div>
						  
						  
        
						  <div><tr>
                        <th style="text-align:center;background:#faebee;" scope="col">FECHA DE ÚLTIMA CARGA</th>   
           <td  style="background:#faebee">
           <strong>
           <?php echo date('Y-m-d'); ?>
           </strong>
           <input type="hidden" style="width:200px;"  class="form-control" id="validationCustom03"   value="<?php echo date('Y-m-d'); ?>" name="FECHA_NUMERO_EVENTO">
           
           </td></tr></div>



                                    
    <input type="hidden" value="hnumeroevento" name="hnumeroevento"/>     
 
  
      
 </table>
         
<table style="width:100%;" >
<tr>
<td  width="100%" style="width:100%;">
<span id="bloquea_boton" width="100%" style="width:100%;">
	<?php 
		if($conexion->variablespermisos('','AUDITORIA_R','guardar')=='si'){
		$NUMERO_EVENTO_existe = $altaeventos->refresca_num_evento();
			if(strlen($NUMERO_EVENTO_existe) == 0 and ($NUMERO_EVENTO_existe!='FALTA CAMPO NUMERO DE EVENTO' or $NUMERO_EVENTO_existe!='FALTA CAMPO INICIALES DE EVENTO' or $NUMERO_EVENTO_existe!='FALTA CAMPO NOMBRE DEL COLABORADOR' or $NUMERO_EVENTO_existe!='EVENTO PREVIAMENTE INGRESADO') ){
			?>
			<button  style="float:right; width:100%;"  class="btn btn-sm btn-outline-success px-5"   type="button" id="GUARDAR_NUMERO_EVENTO">GUARDAR</button>
			<?php
			}
		}
	?></span>
	</td>
	</tr>
	<tr>
	<td>
	<div style="
	 position: absolute;
		top: 50%; 
		right: 50%;
		transform: translate(50%,-50%);
		text-transform: uppercase;
		font-family: verdana;
		font-size: 2em;
		font-weight: 500;
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
		1px 30px 60px rgba(16,16,16,0.4);" id="mensajenumeroevento"/>  </td></tr>
</table>
		   
		   </form>


 
</div>
</div>  
</div>  