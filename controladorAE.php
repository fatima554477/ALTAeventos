<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }

define('__ROOT1__', dirname(dirname(__FILE__)));
include_once (__ROOT1__."/includes/error_reporting.php");
include_once (__ROOT1__."/altaeventos/class.epcinnAE.php");

$altaeventos  = NEW accesoclase();
$conexion = NEW colaboradores();
$var_INICIALES = $altaeventos->var_altaeventos();
$var_INICIALES['iniciales_evento'];

$hALTAEVENTOS = isset($_POST["hALTAEVENTOS"])?$_POST["hALTAEVENTOS"]:"";
$enviaraltaeventos = isset($_POST["enviaraltaeventos"])?$_POST["enviaraltaeventos"]:"";
$borraraltaeventos = isset($_POST["borraraltaeventos"])?$_POST["borraraltaeventos"]:"";   
$borrafoto = isset($_POST["borrafoto"])?$_POST["borrafoto"]:"";	
$hnumeroevento = isset($_POST["hnumeroevento"])?$_POST["hnumeroevento"]:"";
$enviarnumeroE = isset($_POST["enviarnumeroE"])?$_POST["enviarnumeroE"]:"";
$busqueda = isset($_POST["busqueda"])?$_POST["busqueda"]:"";

//hCIERRE
$hCIERRE = isset($_POST["hCIERRE"])?$_POST["hCIERRE"]:"";                              
$enviarCIERRE = isset($_POST["enviarCIERRE"])?$_POST["enviarCIERRE"]:"";
$borraCIERRE = isset($_POST["borraCIERRE"])?$_POST["borraCIERRE"]:"";
$hnuevodocucierre = isset($_POST["hnuevodocucierre"])?$_POST["hnuevodocucierre"]:"";	
$enviarCIERRENUEVO = isset($_POST["enviarCIERRENUEVO"])?$_POST["enviarCIERRENUEVO"]:"";	
$BORRAREGISTRO_cierrenuevo = isset($_POST["BORRAREGISTRO_cierrenuevo"])?$_POST["BORRAREGISTRO_cierrenuevo"]:"";
$INICIALES_EMPRESA_EVENTO1 = isset($_POST["INICIALES_EMPRESA_EVENTO1"])?$_POST["INICIALES_EMPRESA_EVENTO1"]:"";
$IPCIERRE2 = isset($_POST["IPCIERRE2"])?$_POST["IPCIERRE2"]:"";
$hPROGRAMAOPERATIVO = isset($_POST["hPROGRAMAOPERATIVO"])?$_POST["hPROGRAMAOPERATIVO"]:"";
$ipPROGRAMAOPERATIVO = isset($_POST["ipPROGRAMAOPERATIVO"])?$_POST["ipPROGRAMAOPERATIVO"]:"";
$enviarOPERATIVO = isset($_POST["enviarOPERATIVO"])?$_POST["enviarOPERATIVO"]:"";
$borraOPERATIVO = isset($_POST["borraOPERATIVO"])?$_POST["borraOPERATIVO"]:"";
$ipROOMINGLISTOV = isset($_POST["ipROOMINGLISTOV"])?$_POST["ipROOMINGLISTOV"]:"";
$hROOMING = isset($_POST["hROOMING"])?$_POST["hROOMING"]:"";
$borraROOMING = isset($_POST["borraROOMING"])?$_POST["borraROOMING"]:"";
$enviarROOMINGLISTOV = isset($_POST["enviarROOMINGLISTOV"])?$_POST["enviarROOMINGLISTOV"]:"";
$hCRONOTERRESTRE = isset($_POST["hCRONOTERRESTRE"])?$_POST["hCRONOTERRESTRE"]:"";
$hCRONOVUELOS1 = isset($_POST["hCRONOVUELOS1"])?$_POST["hCRONOVUELOS1"]:"";
$enviarCRONOSVUELOS = isset($_POST["enviarCRONOSVUELOS"])?$_POST["enviarCRONOSVUELOS"]:"";$borra_CRONOSV = isset($_POST["borra_CRONOSV"])?$_POST["borra_CRONOSV"]:""; 
$enviarcronoterre = isset($_POST["enviarcronoterre"])?$_POST["enviarcronoterre"]:"";$borra_CRONOSTERRRE = isset($_POST["borra_CRONOSTERRRE"])?$_POST["borra_CRONOSTERRRE"]:""; 
$hCOBROSCLIENTE = isset($_POST["hCOBROSCLIENTE"])?$_POST["hCOBROSCLIENTE"]:""; 
$enviarcobroscliente = isset($_POST["enviarcobroscliente"])?$_POST["enviarcobroscliente"]:""; 
$borra_COBROSCLIENTE = isset($_POST["borra_COBROSCLIENTE"])?$_POST["borra_COBROSCLIENTE"]:""; 
$EMAIL_CRNO_VUELOS = isset($_POST["EMAIL_CRNO_VUELOS"])?$_POST["EMAIL_CRNO_VUELOS"]:"";
$EMAIL_COBROS_CLIENTES = isset($_POST["EMAIL_COBROS_CLIENTES"])?$_POST["EMAIL_COBROS_CLIENTES"]:"";
$EMAIL_cierre_e = isset($_POST["EMAIL_cierre_e"])?$_POST["EMAIL_cierre_e"]:"";
$EMAIL_PROGRAMA_OPERATIVO = isset($_POST["EMAIL_PROGRAMA_OPERATIVO"])?$_POST["EMAIL_PROGRAMA_OPERATIVO"]:"";
$EMAIL_rooming = isset($_POST["EMAIL_rooming"])?$_POST["EMAIL_rooming"]:"";
$EMAIL_cronoterrestre= isset($_POST["EMAIL_cronoterrestre"])?$_POST["EMAIL_cronoterrestre"]:"";
$EMAIL_ALTA_EVENTOS1= isset($_POST["EMAIL_ALTA_EVENTOS1"])?$_POST["EMAIL_ALTA_EVENTOS1"]:"";
$hPAGOSINGRESOS1= isset($_POST["hPAGOSINGRESOS1"])?$_POST["hPAGOSINGRESOS1"]:"";
$enviarpagosingre= isset($_POST["enviarpagosingre"])?$_POST["enviarpagosingre"]:"";
$borra_PAGOSINGRESOS= isset($_POST["borra_PAGOSINGRESOS"])?$_POST["borra_PAGOSINGRESOS"]:"";
$hpagosegresos1= isset($_POST["hpagosegresos1"])?$_POST["hpagosegresos1"]:"";
$enviarpagosEgreso= isset($_POST["enviarpagosEgreso"])?$_POST["enviarpagosEgreso"]:"";
$borra_PAGOEGRESOS= isset($_POST["borra_PAGOEGRESOS"])?$_POST["borra_PAGOEGRESOS"]:"";
$hBOLETOSAVION1= isset($_POST["hBOLETOSAVION1"])?$_POST["hBOLETOSAVION1"]:"";
$enviarboletos= isset($_POST["enviarboletos"])?$_POST["enviarboletos"]:"";
$borra_BOLETOSAVION= isset($_POST["borra_BOLETOSAVION"])?$_POST["borra_BOLETOSAVION"]:"";
$EMAIL_PAGOS_INGRESOS= isset($_POST["EMAIL_PAGOS_INGRESOS"])?$_POST["EMAIL_PAGOS_INGRESOS"]:"";
$EMAIL_PAGOS_EGRESOS= isset($_POST["EMAIL_PAGOS_EGRESOS"])?$_POST["EMAIL_PAGOS_EGRESOS"]:"";
$EMAIL_BOLETOS_AVION= isset($_POST["EMAIL_BOLETOS_AVION"])?$_POST["EMAIL_BOLETOS_AVION"]:"";
$hDatosPERSONAL= isset($_POST["hDatosPERSONAL"])?$_POST["hDatosPERSONAL"]:"";
$ENVIARpersonal= isset($_POST["ENVIARpersonal"])?$_POST["ENVIARpersonal"]:"";
$borra_PERSONAL= isset($_POST["borra_PERSONAL"])?$_POST["borra_PERSONAL"]:"";
$PERSONAL_ENVIAR_IMAIL= isset($_POST["PERSONAL_ENVIAR_IMAIL"])?$_POST["PERSONAL_ENVIAR_IMAIL"]:"";
$Ipcobroscliente = isset($_POST["Ipcobroscliente"])?$_POST["Ipcobroscliente"]:"";
$IpINGRESOS = isset($_POST["IpINGRESOS"])?$_POST["IpINGRESOS"]:"";
$IpEGRESOS = isset($_POST["IpEGRESOS"])?$_POST["IpEGRESOS"]:""; 
$Ipboletosavion = isset($_POST["Ipboletosavion"])?$_POST["Ipboletosavion"]:"";
$Ipcronoterrestre = isset($_POST["Ipcronoterrestre"])?$_POST["Ipcronoterrestre"]:""; 
$Icronosvuelos = isset($_POST["Icronosvuelos"])?$_POST["Icronosvuelos"]:"";
$hCOTIPRO = isset($_POST["hCOTIPRO"])?$_POST["hCOTIPRO"]:"";
$enviarCOTIPRO = isset($_POST["enviarCOTIPRO"])?$_POST["enviarCOTIPRO"]:"";
$IpCOTIPRO = isset($_POST["IpCOTIPRO"])?$_POST["IpCOTIPRO"]:"";
$borra_COTIPRO = isset($_POST["borra_COTIPRO"])?$_POST["borra_COTIPRO"]:"";
$EMAIL_COTIPRO = isset($_POST["EMAIL_COTIPRO"])?$_POST["EMAIL_COTIPRO"]:"";
$hDatosPERSONAL2= isset($_POST["hDatosPERSONAL2"])?$_POST["hDatosPERSONAL2"]:"";
$ENVIARpersonal2= isset($_POST["ENVIARpersonal2"])?$_POST["ENVIARpersonal2"]:"";
$borra_PERSONAL2= isset($_POST["borra_PERSONAL2"])?$_POST["borra_PERSONAL2"]:"";
$PERSONAL2_ENVIAR_IMAIL= isset($_POST["PERSONAL2_ENVIAR_IMAIL"])?$_POST["PERSONAL2_ENVIAR_IMAIL"]:"";



	$cuenta_fechas= isset($_POST["cuenta_fechas"])?$_POST["cuenta_fechas"]:"";
if($cuenta_fechas=='cuenta_fechas'){
$fechaFinal= isset($_POST["VEHICULOSEVE_DEVOLU"])?$_POST["VEHICULOSEVE_DEVOLU"]:"";
$fechaInicial= isset($_POST["VEHICULOSEVE_ENTREGA"])?$_POST["VEHICULOSEVE_ENTREGA"]:"";
	$fechaInicialSegundos = strtotime($fechaInicial);
	$fechaFinalSegundos = strtotime($fechaFinal);
	if($fechaFinalSegundos>=$fechaInicialSegundos){
	$dias = ($fechaFinalSegundos - $fechaInicialSegundos) / 86400;
	echo $dias + 1;
	}else{
	echo "0";	
	}
}


$cantidad_precio= isset($_POST["cantidad_precio"])?$_POST["cantidad_precio"]:"";
if($cantidad_precio=='cantidad_precio'){
$VEHICULOSEVE_DIAS= isset($_POST["VEHICULOSEVE_DIAS"])?$_POST["VEHICULOSEVE_DIAS"]:"";
$VEHICULOSEVE_COSTO= isset($_POST["VEHICULOSEVE_COSTO"])?$_POST["VEHICULOSEVE_COSTO"]:"";
$VEHICULOSEVE_CANTIDAD= isset($_POST["VEHICULOSEVE_CANTIDAD"])?$_POST["VEHICULOSEVE_CANTIDAD"]:"";

if($VEHICULOSEVE_CANTIDAD=='' or $VEHICULOSEVE_CANTIDAD==0)
{$VEHICULOSEVE_CANTIDAD=1;}

$VEHICULOSEVE_COSTO = str_replace(',','',$VEHICULOSEVE_COSTO);
$VEHICULOSEVE_COSTO = str_replace('$','',$VEHICULOSEVE_COSTO);
	if($VEHICULOSEVE_DIAS!='' and $VEHICULOSEVE_COSTO!=''){
    $sub_total = ($VEHICULOSEVE_DIAS * $VEHICULOSEVE_COSTO) * $VEHICULOSEVE_CANTIDAD ;
	/*$iva = $sub_total * .16;
	$gtotal =  $sub_total + $iva;*/
	$iva = 0;
	$gtotal =  $sub_total + $iva;
	}else{
	$sub_total = 0;
	$iva = 0;
	$gtotal =  0;	
	}
	echo '^'.number_format($gtotal,2,'.',',').'^'.number_format($iva,2,'.',',').'^'.number_format($sub_total,2,'.',',');
}

///////////////////////////////PERSONAL2 2///////////////////////////////////////
if($hDatosPERSONAL2 == 'hDatosPERSONAL2' OR $ENVIARpersonal2=='ENVIARpersonal2'){


$NOMBRE_PERSONAL2 = isset($_POST["NOMBRE_PERSONAL2"])?$_POST["NOMBRE_PERSONAL2"]:"";
$PUESTO_PERSONAL2 = isset($_POST["PUESTO_PERSONAL2"])?$_POST["PUESTO_PERSONAL2"]:"";
$WHAT_PERSONAL2 = isset($_POST["WHAT_PERSONAL2"])?$_POST["WHAT_PERSONAL2"]:"";
$EMAIL_PERSONAL2 = isset($_POST["EMAIL_PERSONAL2"])?$_POST["EMAIL_PERSONAL2"]:"";

$FECHA_INICIO1 = isset($_POST["FECHA_INICIO1"])?$_POST["FECHA_INICIO1"]:"";
$FECHA_FINAL1 = isset($_POST["FECHA_FINAL1"])?$_POST["FECHA_FINAL1"]:"";
$NUMERO_DIAS1 = isset($_POST["NUMERO_DIAS1"])?$_POST["NUMERO_DIAS1"]:"";
$MONTO_BONO1 = isset($_POST["MONTO_BONO1"])?$_POST["MONTO_BONO1"]:"";
$MONTO_BONO_TOTAL1 = isset($_POST["MONTO_BONO_TOTAL1"])?$_POST["MONTO_BONO_TOTAL1"]:"";
$TOTAL1 = isset($_POST["TOTAL1"])?$_POST["TOTAL1"]:"";
$ULTIMO_DIA1 = isset($_POST["ULTIMO_DIA1"])?$_POST["ULTIMO_DIA1"]:"";


$VIATICOS_PERSONAL2 = isset($_POST["VIATICOS_PERSONAL2"])?$_POST["VIATICOS_PERSONAL2"]:"";
$OBSERVACIONES_PERSONAL2 = isset($_POST["OBSERVACIONES_PERSONAL2"])?$_POST["OBSERVACIONES_PERSONAL2"]:"";
$PERSONAL2_FECHA_ULTIMA_CARGA = isset($_POST["PERSONAL2_FECHA_ULTIMA_CARGA"])?$_POST["PERSONAL2_FECHA_ULTIMA_CARGA"]:"";
$hDatosPERSONAL2 = isset($_POST["hDatosPERSONAL2"])?$_POST["hDatosPERSONAL2"]:"";
$IPpersonal2 = isset($_POST["IPpersonal2"])?$_POST["IPpersonal2"]:"";

	
     echo $altaeventos->PERSONAL2($NOMBRE_PERSONAL2 ,$PUESTO_PERSONAL2 ,$WHAT_PERSONAL2 , $EMAIL_PERSONAL2 ,$FECHA_INICIO1,$FECHA_FINAL1,$NUMERO_DIAS1, $MONTO_BONO1,$MONTO_BONO_TOTAL1,$TOTAL1,$ULTIMO_DIA1, $VIATICOS_PERSONAL2 , $OBSERVACIONES_PERSONAL2 , $PERSONAL2_FECHA_ULTIMA_CARGA , $hDatosPERSONAL2,$ENVIARpersonal2,$IPpersonal2);   
}

     if($borra_PERSONAL2 == 'borra_PERSONAL2' ){

$borra_perso2 = isset($_POST["borra_perso2"])?$_POST["borra_perso2"]:"";
	echo $altaeventos->borra_PERSONAL2( $borra_perso2 );
}


$NOMBRE_PERSONAL21 = isset($_POST['NOMBRE_PERSONAL21'])?$_POST['NOMBRE_PERSONAL21']:'';

if($NOMBRE_PERSONAL21==true){
	$NOMBRE_PERSONAL22 = isset($_POST['NOMBRE_PERSONAL22'])?$_POST['NOMBRE_PERSONAL22']:'';
	$_SESSION['NOMBRE_PERSONAL21']=$NOMBRE_PERSONAL21;
    echo $NOMBRE_PERSONAL22;
}

$pasara1_personal2_id= isset($_POST["pasara1_personal2_id"])?$_POST["pasara1_personal2_id"]:"";
$pasapersonal2_text= isset($_POST["pasapersonal2_text"])?$_POST["pasapersonal2_text"]:"";

if($pasara1_personal2_id!='' and ($pasapersonal2_text=='si' or $pasapersonal2_text=='no') ){
echo $altaeventos->actualizapersonal2 ($pasara1_personal2_id , $pasapersonal2_text  );
}


 	//EMAIL personal2//

if($PERSONAL2_ENVIAR_IMAIL ==true){

$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($PERSONAL2_ENVIAR_IMAIL=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['personal2'])?$_POST['personal2']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('NOMBRE_PERSONAL2, PUESTO_PERSONAL2, WHAT_PERSONAL2,EMAIL_PERSONAL2,VIATICOS_PERSONAL2,OBSERVACIONES_PERSONAL2 ',

'NOMBRE ,PUESTO,NÚMERO CELULAR, EMAIL, VIATICOS,OBSERVACIONES', '04personal2',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );


$html = $altaeventos->html2('PERSONAL2 DEL EVENTO',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
}
	
 //include_once (__ROOT1__."/includes/crea_funciones.php"); 




///////////////////////////////PERSONAL///////////////////////////////////////
if($hDatosPERSONAL == 'hDatosPERSONAL' OR $ENVIARpersonal=='ENVIARpersonal'){


$NOMBRE_PERSONAL = isset($_POST["NOMBRE_PERSONAL"])?$_POST["NOMBRE_PERSONAL"]:"";
$PUESTO_PERSONAL = isset($_POST["PUESTO_PERSONAL"])?$_POST["PUESTO_PERSONAL"]:"";
$WHAT_PERSONAL = isset($_POST["WHAT_PERSONAL"])?$_POST["WHAT_PERSONAL"]:"";
$EMAIL_PERSONAL = isset($_POST["EMAIL_PERSONAL"])?$_POST["EMAIL_PERSONAL"]:"";
$VIATICOS_PERSONAL = isset($_POST["VIATICOS_PERSONAL"])?$_POST["VIATICOS_PERSONAL"]:"";
$OBSERVACIONES_PERSONAL = isset($_POST["OBSERVACIONES_PERSONAL"])?$_POST["OBSERVACIONES_PERSONAL"]:"";
$PERSONAL_FECHA_ULTIMA_CARGA = isset($_POST["PERSONAL_FECHA_ULTIMA_CARGA"])?$_POST["PERSONAL_FECHA_ULTIMA_CARGA"]:"";
$hDatosPERSONAL = isset($_POST["hDatosPERSONAL"])?$_POST["hDatosPERSONAL"]:"";
$IPpersonal = isset($_POST["IPpersonal"])?$_POST["IPpersonal"]:"";

	
     echo $altaeventos->PERSONAL($NOMBRE_PERSONAL ,$PUESTO_PERSONAL ,$WHAT_PERSONAL , $EMAIL_PERSONAL , $VIATICOS_PERSONAL , $OBSERVACIONES_PERSONAL , $PERSONAL_FECHA_ULTIMA_CARGA , $hDatosPERSONAL,$ENVIARpersonal,$IPpersonal);   
}

     if($borra_PERSONAL == 'borra_PERSONAL' ){

$borra_bole_perso = isset($_POST["borra_bole_perso"])?$_POST["borra_bole_perso"]:"";
	echo $altaeventos->borra_PERSONAL( $borra_bole_perso );
}


$NOMBRE_PERSONAL1 = isset($_POST['NOMBRE_PERSONAL1'])?$_POST['NOMBRE_PERSONAL1']:'';

if($NOMBRE_PERSONAL1==true){
	$NOMBRE_PERSONAL2 = isset($_POST['NOMBRE_PERSONAL2'])?$_POST['NOMBRE_PERSONAL2']:'';
	$_SESSION['NOMBRE_PERSONAL1']=$NOMBRE_PERSONAL1;
    echo $NOMBRE_PERSONAL2;
}

$NOMBRE_PERSONAL12 = isset($_POST['NOMBRE_PERSONAL12'])?$_POST['NOMBRE_PERSONAL12']:'';

if($NOMBRE_PERSONAL12==true){
	$NOMBRE_PERSONAL22 = isset($_POST['NOMBRE_PERSONAL22'])?$_POST['NOMBRE_PERSONAL22']:'';
	$_SESSION['NOMBRE_PERSONAL21']=$NOMBRE_PERSONAL12;
    echo $NOMBRE_PERSONAL22;
}


$pasara1_personal_id= isset($_POST["pasara1_personal_id"])?$_POST["pasara1_personal_id"]:"";
$pasapersonal_text= isset($_POST["pasapersonal_text"])?$_POST["pasapersonal_text"]:"";

if($pasara1_personal_id!='' and ($pasapersonal_text=='si' or $pasapersonal_text=='no') ){
echo $altaeventos->actualizapersonal ($pasara1_personal_id , $pasapersonal_text  );
}


 	//EMAIL personal//

if($PERSONAL_ENVIAR_IMAIL ==true){

$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($PERSONAL_ENVIAR_IMAIL=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['personal'])?$_POST['personal']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('NOMBRE_PERSONAL, PUESTO_PERSONAL, WHAT_PERSONAL,EMAIL_PERSONAL,VIATICOS_PERSONAL,OBSERVACIONES_PERSONAL ',

'NOMBRE ,PUESTO,NÚMERO CELULAR, EMAIL, VIATICOS,OBSERVACIONES', '04personal',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );


$html = $altaeventos->html2('PERSONAL DEL EVENTO',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
}
	
 //include_once (__ROOT1__."/includes/crea_funciones.php"); 	
	

	
	
/////////////////////////COTIZACION DE CLIENTES////////////////////////////////////////


if($hCOTICLIENTES == 'hCOTICLIENTES' or $enviarCOTICLIENTES=='enviarCOTICLIENTES'){
	
	
	if( $_FILES["ADJUNTO_COTICLIENTES"] == true){
	$ADJUNTO_COTICLIENTES = $conexion->solocargar("ADJUNTO_COTICLIENTES");
	}if($ADJUNTO_COTICLIENTES=='2' or $ADJUNTO_COTICLIENTES=='' or $ADJUNTO_COTICLIENTES=='1'){
	$ADJUNTO_COTICLIENTES1 = "";	
	}else{
	$ADJUNTO_COTICLIENTES1 = $ADJUNTO_COTICLIENTES;
				 }
   $NOMBRE_COTIZACION = isset($_POST["NOMBRE_COTIZACION"])?$_POST["NOMBRE_COTIZACION"]:"";	   				 
   $NOMBRE_CLIENTES = isset($_POST["NOMBRE_CLIENTES"])?$_POST["NOMBRE_CLIENTES"]:"";
   $DOCUMENTO_COTICLIENTES = isset($_POST["DOCUMENTO_COTICLIENTES"])?$_POST["DOCUMENTO_COTICLIENTES"]:"";

   $OBSERVACIONES_COTICLIENTES = isset($_POST["OBSERVACIONES_COTICLIENTES"])?$_POST["OBSERVACIONES_COTICLIENTES"]:"";
   $FECHA_COTICLIENTES = isset($_POST["FECHA_COTICLIENTES"])?$_POST["FECHA_COTICLIENTES"]:"";
   $hCOTICLIENTES = isset($_POST["hCOTICLIENTES"])?$_POST["hCOTICLIENTES"]:""; 
				 
				 
					 
   echo $altaeventos->COTICLIENTES($NOMBRE_COTIZACION,$NOMBRE_CLIENTES, $DOCUMENTO_COTICLIENTES,$ADJUNTO_COTICLIENTES, $OBSERVACIONES_COTICLIENTES, $FECHA_COTICLIENTES, $hCOTICLIENTES, $IpCOTICLIENTES,$enviarCOTICLIENTES );
				 
					
				   
   }
   
   elseif($EMAIL_COTICLIENTES ==true){
   $conexion2 = new herramientas();
   $NOMBRE_1 = 'Peticion';
   $EMAILnombre = array($EMAIL_COTICLIENTES=>$NOMBRE_1);
   $adjuntos = array(''=>'');
   $Subject = 'DATOS SOLICITADOS';
	/*nuevo*/
   $array = isset($_POST['cotiCLIENTES'])?$_POST['cotiCLIENTES']:'';
   if($array != ''){
   $loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
   $or1='';
   for($rrr=0;$rrr<=$loopcuenta;$rrr++){
   if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
   $query1 .= ' id= '.$array[$rrr].$or1;
   }
   $query2 = str_replace('[object Object]','',$query1);
   $query2 = "and (".$query2.") ";
   }else{
   echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
   } 
																				   
   $MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('NOMBRE_CLIENTES,DOCUMENTO_COTICLIENTES, OBSERVACIONES_COTICLIENTES, FECHA_COTICLIENTES ',
				 
   'NOMBRE CLIENTES,MONTO, OBSERVACIONES,FECHA', '04COTICLIENTES',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );
   $variables = 'ADJUNTO_COTICLIENTES, ';
   //DOCUMENTO_COTICLIENTES trim($variables, ',');
				 
   $cadenacompleta =substr($variables, 0, -2);
				  
   $adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04COTICLIENTES', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );
				 

				 
     $html = $altaeventos->html2('COTIZACIÓN DE CLIENTES ',$MANDA_INFORMACION );

     $smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
     $idlogo = $smtp['idRelacion'];
     $logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);
				 
   $embebida = array('../includes/archivos/'.$logo => 'ver');
   echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
   }  
					 
	if($borra_COTICLIENTES == 'borra_COTICLIENTES' ){
				 
   $borra_cotiCLIENTES = isset($_POST["borra_cotiCLIENTES"])?$_POST["borra_cotiCLIENTES"]:"";
   echo $altaeventos->borra_COTICLIENTES( $borra_cotiCLIENTES );
   }	
   	   //include_once (__ROOT1__."/includes/crea_funciones.php");  



	
	
	
//////////////////boletos avion/////////////////////////////////////////

$pasarpagadoavion_id= isset($_POST["pasarpagadoavion_id"])?$_POST["pasarpagadoavion_id"]:"";
$pasarpagadoavion_text= isset($_POST["pasarpagadoavion_text"])?$_POST["pasarpagadoavion_text"]:"";

if($pasarpagadoavion_id!='' and ($pasarpagadoavion_text=='si' or $pasarpagadoavion_text=='no') ){
	//echo $pasarpagadoavion_id.$pasarpagadoavion_text;
echo $altaeventos->PASARPAGADOavion ($pasarpagadoavion_id , $pasarpagadoavion_text  );

}

if($hBOLETOSAVION1 == 'hBOLETOSAVION1' or $enviarboletos=='enviarboletos'){
	
			  	   	   if( $_FILES["ADJUNTO_BOLETOSAVION"] == true){
$ADJUNTO_BOLETOSAVION = $conexion->solocargar("ADJUNTO_BOLETOSAVION");
}if($ADJUNTO_BOLETOSAVION=='2' or $ADJUNTO_BOLETOSAVION=='' or $ADJUNTO_BOLETOSAVION=='1'){
 $ADJUNTO_BOLETOSAVION1 = "";	
}else{
 $ADJUNTO_BOLETOSAVION1 = $ADJUNTO_BOLETOSAVION;
} 
	
	
$DOCUMENTO_BOLETOSAVION = isset($_POST["DOCUMENTO_BOLETOSAVION"])?$_POST["DOCUMENTO_BOLETOSAVION"]:"";
$MONTO_BOLETOSAVION = isset($_POST["MONTO_BOLETOSAVION"])?$_POST["MONTO_BOLETOSAVION"]:"";
$FECHA_BOLETOSAVION = isset($_POST["FECHA_BOLETOSAVION"])?$_POST["FECHA_BOLETOSAVION"]:"";
$hBOLETOSAVION1 = isset($_POST["hBOLETOSAVION1"])?$_POST["hBOLETOSAVION1"]:"";
$Ipboletosavion = isset($_POST["Ipboletosavion"])?$_POST["Ipboletosavion"]:"";
 
 echo $altaeventos->boletosavion( $DOCUMENTO_BOLETOSAVION ,$ADJUNTO_BOLETOSAVION1, $MONTO_BOLETOSAVION ,$FECHA_BOLETOSAVION , $hBOLETOSAVION1  ,$hpagosegresos1, $Ipboletosavion,$enviarboletos);   
}


if($borra_BOLETOSAVION == 'borra_BOLETOSAVION' ){

$borra_bole_avion = isset($_POST["borra_bole_avion"])?$_POST["borra_bole_avion"]:"";
	echo $altaeventos->borra_BOLETOSAVION( $borra_bole_avion );
}
 
 	//EMAIL BOLETOS DE AVION//

if($EMAIL_BOLETOS_AVION ==true){

$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_BOLETOS_AVION=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['boletosavion'])?$_POST['boletosavion']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_BOLETOSAVION, MONTO_BOLETOSAVION, FECHA_BOLETOSAVION ',

'NOMBRE ,MONTO ,FECHA', '04boletosavion',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );



$variables = 'ADJUNTO_BOLETOSAVION, ';
 $cadenacompleta =substr($variables, 0, -2); 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04boletosavion', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );



$html = $altaeventos->html2('RESUMEN DE BOLETOS AVION',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
}
 //include_once (__ROOT1__."/includes/crea_funciones.php"); 





//////////////////EGRESOS/////////////////////////////////////////



$pasarpagadoegreso_id= isset($_POST["pasarpagadoegreso_id"])?$_POST["pasarpagadoegreso_id"]:"";
$pasarpagadoegreso_text= isset($_POST["pasarpagadoegreso_text"])?$_POST["pasarpagadoegreso_text"]:"";

if($pasarpagadoegreso_id!='' and ($pasarpagadoegreso_text=='si' or $pasarpagadoegreso_text=='no') ){
	//echo $pasarpagadoegreso_id.$pasarpagadoegreso_text;
echo $altaeventos->actualizapagoegreso ($pasarpagadoegreso_id , $pasarpagadoegreso_text  );

}



if($hpagosegresos1 == 'hpagosegresos1' or $enviarpagosEgreso=='enviarpagosEgreso'){
	
		  	   	   if( $_FILES["ADJUNTO_EGRESO"] == true){
$ADJUNTO_EGRESO = $conexion->solocargar("ADJUNTO_EGRESO");
}if($ADJUNTO_EGRESO=='2' or $ADJUNTO_EGRESO=='' or $ADJUNTO_EGRESO=='1'){
 $ADJUNTO_EGRESO1 = "";	
}else{
 $ADJUNTO_EGRESO1 = $ADJUNTO_EGRESO;
} 	
	
	
$DOCUMENTO_EGRESO = isset($_POST["DOCUMENTO_EGRESO"])?$_POST["DOCUMENTO_EGRESO"]:"";
$MONTO_EGRESO = isset($_POST["MONTO_EGRESO"])?$_POST["MONTO_EGRESO"]:"";
$FECHA_EGRESO = isset($_POST["FECHA_EGRESO"])?$_POST["FECHA_EGRESO"]:"";
$hpagosegresos1 = isset($_POST["hpagosegresos1"])?$_POST["hpagosegresos1"]:""; 
$IpEGRESOS = isset($_POST["IpEGRESOS"])?$_POST["IpEGRESOS"]:""; 


 echo $altaeventos->pagoegreso( $DOCUMENTO_EGRESO, $ADJUNTO_EGRESO1, $MONTO_EGRESO, $FECHA_EGRESO ,$hpagosegresos1, $IpEGRESOS,$enviarpagosEgreso );   
}	 
 //include_once (__ROOT1__."/includes/crea_funciones.php"); 
 
 if($borra_PAGOEGRESOS == 'borra_PAGOEGRESOS' ){

$borra_pago_egre = isset($_POST["borra_pago_egre"])?$_POST["borra_pago_egre"]:"";
	echo $altaeventos->borra_PAGOEGRESOS( $borra_pago_egre );
}
//////////////////EMAIL EGRESOS/////////////////////

if($EMAIL_PAGOS_EGRESOS ==true){

$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_PAGOS_EGRESOS=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['pagoegreso'])?$_POST['pagoegreso']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_EGRESO, MONTO_EGRESO, FECHA_EGRESO ',

'NOMBRE ,MONTO,FECHA', '04pagoegresos',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );

$variables = 'ADJUNTO_EGRESO, ';


 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04pagoegresos', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );

$html = $altaeventos->html2('RESUMEN DE EGRESOS',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
}






//////////////////INGRESOS/////////////////////////////////////////


$pasarpagadoingreso_id= isset($_POST["pasarpagadoingreso_id"])?$_POST["pasarpagadoingreso_id"]:"";
$pasarpagadoingreso_text= isset($_POST["pasarpagadoingreso_text"])?$_POST["pasarpagadoingreso_text"]:"";

if($pasarpagadoingreso_id!='' and ($pasarpagadoingreso_text=='si' or $pasarpagadoingreso_text=='no') ){
echo $altaeventos->actualizapagoingreso ($pasarpagadoingreso_id , $pasarpagadoingreso_text  );
}


   if($hPAGOSINGRESOS1 == 'hPAGOSINGRESOS1' or $enviarpagosingre=='enviarpagosingre'){
	   
		  	   	   if( $_FILES["ADJUNTO_INGRESOS"] == true){
$ADJUNTO_INGRESOS = $conexion->solocargar("ADJUNTO_INGRESOS");
}if($ADJUNTO_INGRESOS=='2' or $ADJUNTO_INGRESOS=='' or $ADJUNTO_INGRESOS=='1'){
 $ADJUNTO_INGRESOS1 = "";	
}else{
 $ADJUNTO_INGRESOS1 = $ADJUNTO_INGRESOS;
}   
	   	   
$DOCUMENTO_INGRESOS = isset($_POST["DOCUMENTO_INGRESOS"])?$_POST["DOCUMENTO_INGRESOS"]:"";
$OBSERVACIONES_INGRESOS = isset($_POST["OBSERVACIONES_INGRESOS"])?$_POST["OBSERVACIONES_INGRESOS"]:"";
$FECHA_INGRESOS = isset($_POST["FECHA_INGRESOS"])?$_POST["FECHA_INGRESOS"]:"";
$hPAGOSINGRESOS1 = isset($_POST["hPAGOSINGRESOS1"])?$_POST["hPAGOSINGRESOS1"]:"";
$IpINGRESOS = isset($_POST["IpINGRESOS"])?$_POST["IpINGRESOS"]:""; 	
   
		echo $altaeventos->pagoingreso(  $DOCUMENTO_INGRESOS ,$ADJUNTO_INGRESOS1, $OBSERVACIONES_INGRESOS , $FECHA_INGRESOS , $hPAGOSINGRESOS1,$IpINGRESOS,$enviarpagosingre );   
}	 
 
 if($borra_PAGOSINGRESOS == 'borra_PAGOSINGRESOS' ){

$borra_cobros_INGRE = isset($_POST["borra_cobros_INGRE"])?$_POST["borra_cobros_INGRE"]:"";
	echo $altaeventos->borra_PAGOSINGRESOS( $borra_cobros_INGRE );
}   

  //////////////EMAIL INGRESOS//////////////
if($EMAIL_PAGOS_INGRESOS ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_PAGOS_INGRESOS=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['pagoingreso'])?$_POST['pagoingreso']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_INGRESOS, OBSERVACIONES_INGRESOS, FECHA_INGRESOS ',

'NOMBRE ,MONTO,FECHA', '04pagosingresos',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );

$variables = 'ADJUNTO_INGRESOS, ';
//DOCUMENTO_COBROS trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04pagosingresos', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );

$html = $altaeventos->html2('RESUMEN DE INGRESOS',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
}	   
	   

 //include_once (__ROOT1__."/includes/crea_funciones.php"); 
   








//////////////////////////////CHECK LIST/////////////////////////
  if($hCOBROSCLIENTE == 'hCOBROSCLIENTE' or $enviarcobroscliente=='enviarcobroscliente'){
	  
	  	   	   if( $_FILES["ADJUNTO_COBROS"] == true){
$ADJUNTO_COBROS = $conexion->solocargar("ADJUNTO_COBROS");
}if($ADJUNTO_COBROS=='2' or $ADJUNTO_COBROS=='' or $ADJUNTO_COBROS=='1'){
 $ADJUNTO_COBROS1 = "";	
}else{
 $ADJUNTO_COBROS1 = $ADJUNTO_COBROS;
}
	  
$DOCUMENTO_COBROS = isset($_POST["DOCUMENTO_COBROS"])?$_POST["DOCUMENTO_COBROS"]:"";
$OBSERVACIONES_COBROS = isset($_POST["OBSERVACIONES_COBROS"])?$_POST["OBSERVACIONES_COBROS"]:"";
$FECHA_COBROS = isset($_POST["FECHA_COBROS"])?$_POST["FECHA_COBROS"]:"";
$hCOBROSCLIENTE = isset($_POST["hCOBROSCLIENTE"])?$_POST["hCOBROSCLIENTE"]:""; 


	  
	echo $altaeventos->cobroscliente( $DOCUMENTO_COBROS ,$ADJUNTO_COBROS1, $OBSERVACIONES_COBROS , $FECHA_COBROS , $hCOBROSCLIENTE,$Ipcobroscliente,$enviarcobroscliente );
	  
	//include_once (__ROOT1__."/includes/crea_funciones.php"); 
   
  
 }
elseif($EMAIL_COBROS_CLIENTES ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_COBROS_CLIENTES=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['cobrosclientes'])?$_POST['cobrosclientes']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_COBROS, OBSERVACIONES_COBROS, FECHA_COBROS ',

'NOMBRE ,OBSERVACIONES,FECHA', '04cobroscliente',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );

$variables = 'ADJUNTO_COBROS, ';
//DOCUMENTO_COBROS trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04cobroscliente', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );

$html = $altaeventos->html2('COBROS AL CLIENTE ',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
}
 
 
 
 
 if($borra_COBROSCLIENTE == 'borra_COBROSCLIENTE' ){

$borra_cobros_C = isset($_POST["borra_cobros_C"])?$_POST["borra_cobros_C"]:"";
	echo $altaeventos->borra_COBROSCLIENTE( $borra_cobros_C );
}







  
   if($hCRONOTERRESTRE == 'hCRONOTERRESTRE' or $enviarcronoterre=='enviarcronoterre'){
	   
	   
	   	   if( $_FILES["ADJUNTO_cronoterrestre"] == true){
$ADJUNTO_cronoterrestre = $conexion->solocargar("ADJUNTO_cronoterrestre");
}if($ADJUNTO_cronoterrestre=='2' or $ADJUNTO_cronoterrestre=='' or $ADJUNTO_cronoterrestre=='1'){
 $ADJUNTO_cronoterrestre1 = "";	
}else{
 $ADJUNTO_cronoterrestre1 = $ADJUNTO_cronoterrestre;
}
	
	   
$DOCUMENTO_cronoterrestre = isset($_POST["DOCUMENTO_cronoterrestre"])?$_POST["DOCUMENTO_cronoterrestre"]:"";
$OBSERVACIONES_cronoterrestre = isset($_POST["OBSERVACIONES_cronoterrestre"])?$_POST["OBSERVACIONES_cronoterrestre"]:"";
$FECHA_cronoterrestre = isset($_POST["FECHA_cronoterrestre"])?$_POST["FECHA_cronoterrestre"]:"";
$hCRONOTERRESTRE = isset($_POST["hCRONOTERRESTRE"])?$_POST["hCRONOTERRESTRE"]:"";
$Ipcronoterrestre = isset($_POST["Ipcronoterrestre"])?$_POST["Ipcronoterrestre"]:""; 

	   echo $altaeventos->CRONOterrestre ( $DOCUMENTO_cronoterrestre , $ADJUNTO_cronoterrestre1 ,$OBSERVACIONES_cronoterrestre , $FECHA_cronoterrestre , $hCRONOTERRESTRE,$Ipcronoterrestre,$enviarcronoterre );
}


elseif($EMAIL_cronoterrestre ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_cronoterrestre=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['cronoterrestre'])?$_POST['cronoterrestre']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_cronoterrestre, OBSERVACIONES_cronoterrestre, FECHA_cronoterrestre ',

'NOMBRE ,OBSERVACIONES,FECHA', '04cronoterrestre',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );

$variables = 'ADJUNTO_cronoterrestre, ';
// trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04cronoterrestre', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );

$html = $altaeventos->html2('CRONOLOGICO DE TRANSPORTACIÓN TERRESTRE ',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
} 


if($borra_CRONOSTERRRE == 'borra_CRONOSTERRRE' ){

$borra_cronos_T = isset($_POST["borra_cronos_T"])?$_POST["borra_cronos_T"]:"";
	echo $altaeventos->borra_CRONOSTERRRE( $borra_cronos_T );
}
	
    //include_once (__ROOT1__."/includes/crea_funciones.php"); 
   
	 
                                                                   
   if($hCRONOVUELOS1 == 'hCRONOVUELOS1' OR $enviarCRONOSVUELOS=='enviarCRONOSVUELOS'){
	   
	   if( $_FILES["ADJUNTO_CRONOVUELOS"] == true){
$ADJUNTO_CRONOVUELOS = $conexion->solocargar("ADJUNTO_CRONOVUELOS");
}if($ADJUNTO_CRONOVUELOS=='2' or $ADJUNTO_CRONOVUELOS=='' or $ADJUNTO_CRONOVUELOS=='1'){
 $ADJUNTO_CRONOVUELOS1 = "";	
}else{
 $ADJUNTO_CRONOVUELOS1 = $ADJUNTO_CRONOVUELOS;
}
	   
$DOCUMENTO_CRONOVUELOS = isset($_POST["DOCUMENTO_CRONOVUELOS"])?$_POST["DOCUMENTO_CRONOVUELOS"]:"";
$OBSERVACIONES_CRONOVUELOS = isset($_POST["OBSERVACIONES_CRONOVUELOS"])?$_POST["OBSERVACIONES_CRONOVUELOS"]:"";
$FECHA_CRONOVUELOS = isset($_POST["FECHA_CRONOVUELOS"])?$_POST["FECHA_CRONOVUELOS"]:"";
$hCRONOVUELOS1 = isset($_POST["hCRONOVUELOS1"])?$_POST["hCRONOVUELOS1"]:""; 
$Icronosvuelos = isset($_POST["Icronosvuelos"])?$_POST["Icronosvuelos"]:""; 


	   echo $altaeventos->CRONOVUELOS ($DOCUMENTO_CRONOVUELOS ,$OBSERVACIONES_CRONOVUELOS,$ADJUNTO_CRONOVUELOS1 , $FECHA_CRONOVUELOS , $hCRONOVUELOS1,$Icronosvuelos,$enviarCRONOSVUELOS);
    //include_once (__ROOT1__."/includes/crea_funciones.php"); 
}
/*PARA ENVIAR EMAIL*/

elseif($EMAIL_CRNO_VUELOS ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_CRNO_VUELOS=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['cronovuelos'])?$_POST['cronovuelos']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_CRONOVUELOS, OBSERVACIONES_CRONOVUELOS, FECHA_CRONOVUELOS ',

'NOMBRE ,OBSERVACIONES,FECHA', '04cronologicovuelos',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );

$variables = 'ADJUNTO_CRONOVUELOS, ';
// trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04cronologicovuelos', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );

$html = $altaeventos->html2('CRONOLOGICO DE VUELOS ',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
} 



if($borra_CRONOSV == 'borra_CRONOSV' ){

$borra_cronosvuelos = isset($_POST["borra_cronosvuelos"])?$_POST["borra_cronosvuelos"]:"";
	echo $altaeventos->borra_CRONOSV( $borra_cronosvuelos );
}







	   
  //include_once (__ROOT1__."/includes/crea_funciones.php");  


   
//enviarROOMINGLISTOV
if($borraROOMING=='borraROOMING'){
$borra_ROOMING_ID = isset($_POST["borra_ROOMING_ID"])?$_POST["borra_ROOMING_ID"]:"";
	   echo $altaeventos->borra_rooming ($borra_ROOMING_ID);
}

if($hROOMING =='hROOMING' OR $enviarROOMINGLISTOV=='enviarROOMINGLISTOV'){
//DOCUMENTO_ROOMING
$DOCUMENTO_ROOMING = isset($_POST["DOCUMENTO_ROOMING"])?$_POST["DOCUMENTO_ROOMING"]:"";
$OBSERVACIONES_ROOMING = isset($_POST["OBSERVACIONES_ROOMING"])?$_POST["OBSERVACIONES_ROOMING"]:"";
$FECHA_ROOMING = isset($_POST["FECHA_ROOMING"])?$_POST["FECHA_ROOMING"]:"";
$iproominglinst = isset($_POST["iproominglinst"])?$_POST["iproominglinst"]:"";
	if( $_FILES["ADJUNTO_ROOMING"] == true){
$ADJUNTO_ROOMING = $conexion->solocargar("ADJUNTO_ROOMING");
}if($ADJUNTO_ROOMING=='2' or $ADJUNTO_ROOMING=='' or $ADJUNTO_ROOMING=='1'){
 $ADJUNTO_ROOMING1 = "";	
}else{
 $ADJUNTO_ROOMING1 = $ADJUNTO_ROOMING;
}

	   echo $altaeventos->guarda_rooming ($ADJUNTO_ROOMING1,$DOCUMENTO_ROOMING , $OBSERVACIONES_ROOMING , $FECHA_ROOMING , $enviarROOMINGLISTOV,$ipROOMINGLISTOV);	
    // include_once (__ROOT1__."/includes/crea_funciones.php"); 
	//04roominglist
	
}

elseif($EMAIL_rooming ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_rooming=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['rooming'])?$_POST['rooming']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_ROOMING, OBSERVACIONES_ROOMING, FECHA_ROOMING ',

'NOMBRE ,OBSERVACIONES,FECHA', '04roominglist',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );

$variables = 'ADJUNTO_ROOMING, ';
// trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04roominglist', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );

$html = $altaeventos->html2('ROOMING LIST ',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
} 




if($borraOPERATIVO =='borraOPERATIVO'){
	
$borra_ID_OPERATIVO	 = isset($_POST["borra_ID_OPERATIVO"])?$_POST["borra_ID_OPERATIVO"]:"";
//borra_ID_OPERATIVO
	   echo $altaeventos->borra_programaoperativo ( $borra_ID_OPERATIVO);	
    // include_once (__ROOT1__."/includes/crea_funciones.php"); 
}

if($hPROGRAMAOPERATIVO =='hPROGRAMAOPERATIVO' OR $enviarOPERATIVO =='enviarOPERATIVO'){


$OBSERVACIONES_PROGRAMAOPERATIVO = isset($_POST["OBSERVACIONES_PROGRAMAOPERATIVO"])?$_POST["OBSERVACIONES_PROGRAMAOPERATIVO"]:"";
$FECHA_PROGRAMAOPERATIVO = isset($_POST["FECHA_PROGRAMAOPERATIVO"])?$_POST["FECHA_PROGRAMAOPERATIVO"]:"";
$hPROGRAMAOPERATIVO = isset($_POST["hPROGRAMAOPERATIVO"])?$_POST["hPROGRAMAOPERATIVO"]:""; 
$DOCUMENTO_PROGRAMAOPERATIVO = isset($_POST["DOCUMENTO_PROGRAMAOPERATIVO"])?$_POST["DOCUMENTO_PROGRAMAOPERATIVO"]:""; 
	if( $_FILES["ADJUNTO_PROGRAMAOPERATIVO"] == true){
$ADJUNTO_PROGRAMAOPERATIVO = $conexion->solocargar("ADJUNTO_PROGRAMAOPERATIVO");
}if($ADJUNTO_PROGRAMAOPERATIVO=='2' or $ADJUNTO_PROGRAMAOPERATIVO=='' or $ADJUNTO_PROGRAMAOPERATIVO=='1'){
 $ADJUNTO_PROGRAMAOPERATIVO1 = "";	
}else{
 $ADJUNTO_PROGRAMAOPERATIVO1 = $ADJUNTO_PROGRAMAOPERATIVO;
}	

echo $altaeventos->guarda_programaoperativo ($ADJUNTO_PROGRAMAOPERATIVO1, $DOCUMENTO_PROGRAMAOPERATIVO , $OBSERVACIONES_PROGRAMAOPERATIVO , $FECHA_PROGRAMAOPERATIVO , $hPROGRAMAOPERATIVO, $ipPROGRAMAOPERATIVO,$enviarOPERATIVO );   
   //  include_once (__ROOT1__."/includes/crea_funciones.php");  
}


elseif($EMAIL_PROGRAMA_OPERATIVO ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_PROGRAMA_OPERATIVO=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['programaOPERA'])?$_POST['programaOPERA']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_PROGRAMAOPERATIVO, OBSERVACIONES_PROGRAMAOPERATIVO, FECHA_PROGRAMAOPERATIVO ',

'NOMBRE ,OBSERVACIONES,FECHA', '04programaoperativo',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );

$variables = 'ADJUNTO_PROGRAMAOPERATIVO, ';
// trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04programaoperativo', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );

$html = $altaeventos->html2('PROGRAMA OPERATIVO ',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
} 

if($INICIALES_EMPRESA_EVENTO1 ==true){
	ECHO $_SESSION['INICIALES_EMPRESA_EVENTO1']=$INICIALES_EMPRESA_EVENTO1;
	}


if($hnuevodocucierre == 'hnuevodocucierre' ){
	//enviarCIERRENUEVO
	
$nuevo_documento_cierre = isset($_POST["nuevo_documento_cierre"])?$_POST["nuevo_documento_cierre"]:"";
$hnuevodocucierre = isset($_POST["hnuevodocucierre"])?$_POST["hnuevodocucierre"]:""; 	
$IPCIERRENUEVO = isset($_POST["IPCIERRENUEVO"])?$_POST["IPCIERRENUEVO"]:""; 	
   echo $altaeventos->NUEVODOCUCIERRE ($nuevo_documento_cierre , $hnuevodocucierre,$enviarCIERRENUEVO,$IPCIERRENUEVO);
   
     //include_once (__ROOT1__."/includes/crea_funciones.php");  
//echo "asdfasdf";

 }	 
   elseif($BORRAREGISTRO_cierrenuevo == 'BORRAREGISTRO_cierrenuevo'){
	$borra_NUEVOD = isset($_POST["borra_NUEVOD"])?$_POST["borra_NUEVOD"]:"";
		
	echo $altaeventos->BORRAREGISTRO_cierrenuevo($borra_NUEVOD);
	 
	
  //include_once (__ROOT1__."/includes/crea_funciones.php");  
} 



if($hCIERRE == 'hCIERRE' or $enviarCIERRE=='enviarCIERRE'){
	
	if( $_FILES["adjunto_cierre"] == true){
 $adjunto_cierre = $conexion->solocargar("adjunto_cierre");
}if($adjunto_cierre=='2' or $adjunto_cierre=='' or $adjunto_cierre=='1'){
 $adjunto_cierre1 = "";	
}else{
 $adjunto_cierre1 = $adjunto_cierre;
}	



$DOCUMENTO_cierre = isset($_POST["DOCUMENTO_cierre"])?$_POST["DOCUMENTO_cierre"]:"";
$OBSERVACIONES_cierre = isset($_POST["OBSERVACIONES_cierre"])?$_POST["OBSERVACIONES_cierre"]:"";
$fecha_cierre = isset($_POST["fecha_cierre"])?$_POST["fecha_cierre"]:"";
$IPCIERRE2 = isset($_POST["IPCIERRE2"])?$_POST["IPCIERRE2"]:"";

	echo $altaeventos->guardar_cierre(  $DOCUMENTO_cierre , $OBSERVACIONES_cierre , $fecha_cierre ,$adjunto_cierre1, $hCIERRE, $IPCIERRE2,$enviarCIERRE);
		// include_once (__ROOT1__."/includes/crea_funciones.php");
//echo "entro";
}

elseif($EMAIL_cierre_e ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_cierre_e=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
$array = isset($_POST['cierre'])?$_POST['cierre']:'';
//print_r('ppppp'.$array);
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('DOCUMENTO_cierre, OBSERVACIONES_cierre, fecha_cierre ',

'NOMBRE ,OBSERVACIONES,FECHA', '04cierre',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );

$variables = 'adjunto_cierre, ';
// trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04cierre', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );

$html = $altaeventos->html2('CIERRE ',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];

$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
} 


if($borraCIERRE == 'borraCIERRE' ){

$borra_CIERREID = isset($_POST["borra_CIERREID"])?$_POST["borra_CIERREID"]:"";
	echo $altaeventos->BORRAREGISTRO_cierre( $borra_CIERREID );
}




if($busqueda==true){

	 $resultado = $altaeventos->buscarnumero($busqueda);
	 echo json_encode($resultado);
}

if($hALTAEVENTOS == 'hALTAEVENTOS' ){
$NUMERO_EVENTO = isset($_POST["NUMERO_EVENTO"])?$_POST["NUMERO_EVENTO"]:"";
$FECHA_ALTA_EVENTO = isset($_POST["FECHA_ALTA_EVENTO"])?$_POST["FECHA_ALTA_EVENTO"]:"";
$STATUS_EVENTO = isset($_POST["STATUS_EVENTO"])?$_POST["STATUS_EVENTO"]:"";
$FECHA_AUTORIZACION_EVENTO = isset($_POST["FECHA_AUTORIZACION_EVENTO"])?$_POST["FECHA_AUTORIZACION_EVENTO"]:"";
$MONTOC_TOTAL_EVENTO = isset($_POST["MONTOC_TOTAL_EVENTO"])?$_POST["MONTOC_TOTAL_EVENTO"]:"";
$MONTO_TOTAL_AVION = isset($_POST["MONTO_TOTAL_AVION"])?$_POST["MONTO_TOTAL_AVION"]:"";
$CANTIDAD_PORCENTAJEV = isset($_POST["CANTIDAD_PORCENTAJEV"])?$_POST["CANTIDAD_PORCENTAJEV"]:"";
$FEE_COBRADO = isset($_POST["FEE_COBRADO"])?$_POST["FEE_COBRADO"]:"";
$PORCENTAJE_FEE = isset($_POST["PORCENTAJE_FEE"])?$_POST["PORCENTAJE_FEE"]:"";
$MONTO_TOTAL_DEL_EVENTO = isset($_POST["MONTO_TOTAL_DEL_EVENTO"])?$_POST["MONTO_TOTAL_DEL_EVENTO"]:"";
$NOMBRE_COMERCIAL_EVENTO = isset($_POST["NOMBRE_COMERCIAL_EVENTO"])?$_POST["NOMBRE_COMERCIAL_EVENTO"]:"";
$NOMBRE_FISCAL_EVENTO = isset($_POST["NOMBRE_FISCAL_EVENTO"])?$_POST["NOMBRE_FISCAL_EVENTO"]:"";
$NOMBRE_EVENTO = isset($_POST["NOMBRE_EVENTO"])?$_POST["NOMBRE_EVENTO"]:"";
$NOMBRE_CORTO_EVENTO = isset($_POST["NOMBRE_CORTO_EVENTO"])?$_POST["NOMBRE_CORTO_EVENTO"]:"";
$NOMBRE_CONTACTO_EVENTO = isset($_POST["NOMBRE_CONTACTO_EVENTO"])?$_POST["NOMBRE_CONTACTO_EVENTO"]:"";
$CELULAR_CONTACTO_1 = isset($_POST["CELULAR_CONTACTO_1"])?$_POST["CELULAR_CONTACTO_1"]:"";
$CORREO_CONTACTO_1 = isset($_POST["CORREO_CONTACTO_1"])?$_POST["CORREO_CONTACTO_1"]:"";
$AREA_CONTACTO_CLIENTE = isset($_POST["AREA_CONTACTO_CLIENTE"])?$_POST["AREA_CONTACTO_CLIENTE"]:"";
$OBSERVACIONES_1 = isset($_POST["OBSERVACIONES_1"])?$_POST["OBSERVACIONES_1"]:"";
$TIPO_DE_EVENTO = isset($_POST["TIPO_DE_EVENTO"])?$_POST["TIPO_DE_EVENTO"]:"";
$FORMATO_EVENTO = isset($_POST["FORMATO_EVENTO"])?$_POST["FORMATO_EVENTO"]:"";
$PAIS_DEL_EVENTO = isset($_POST["PAIS_DEL_EVENTO"])?$_POST["PAIS_DEL_EVENTO"]:"";
$CIUDAD_DEL_EVENTO = isset($_POST["CIUDAD_DEL_EVENTO"])?$_POST["CIUDAD_DEL_EVENTO"]:"";
$HOTEL_LUGAR = isset($_POST["HOTEL_LUGAR"])?$_POST["HOTEL_LUGAR"]:"";
$NUMERO_DE_PERSONAS = isset($_POST["NUMERO_DE_PERSONAS"])?$_POST["NUMERO_DE_PERSONAS"]:"";
$FECHA_INICIO_EVENTO = isset($_POST["FECHA_INICIO_EVENTO"])?$_POST["FECHA_INICIO_EVENTO"]:"";
$NOMBRE_COMERCIAL = isset($_POST["NOMBRE_COMERCIAL"])?$_POST["NOMBRE_COMERCIAL"]:"";
$FECHA_FINAL_EVENTO = isset($_POST["FECHA_FINAL_EVENTO"])?$_POST["FECHA_FINAL_EVENTO"]:"";
$HORA_TERMINO_EVENTO = isset($_POST["HORA_TERMINO_EVENTO"])?$_POST["HORA_TERMINO_EVENTO"]:"";
$FECHA_LLEGADA_STAFF = isset($_POST["FECHA_LLEGADA_STAFF"])?$_POST["FECHA_LLEGADA_STAFF"]:"";
$HORA_LLEGADA_STAFF = isset($_POST["HORA_LLEGADA_STAFF"])?$_POST["HORA_LLEGADA_STAFF"]:"";
$FECHA_REGRESO_STAFF = isset($_POST["FECHA_REGRESO_STAFF"])?$_POST["FECHA_REGRESO_STAFF"]:"";
$HORA_REGRESO_STAFF = isset($_POST["HORA_REGRESO_STAFF"])?$_POST["HORA_REGRESO_STAFF"]:"";
$MATERIAL_EQUIPO_BODEGA = isset($_POST["MATERIAL_EQUIPO_BODEGA"])?$_POST["MATERIAL_EQUIPO_BODEGA"]:"";
$FECHA_INICIO_MONTAJE = isset($_POST["FECHA_INICIO_MONTAJE"])?$_POST["FECHA_INICIO_MONTAJE"]:"";
$HORA_INICIO_MONTAJE = isset($_POST["HORA_INICIO_MONTAJE"])?$_POST["HORA_INICIO_MONTAJE"]:"";
$FECHA_DESMONTAJE = isset($_POST["FECHA_DESMONTAJE"])?$_POST["FECHA_DESMONTAJE"]:"";
$HORA_DESMONTAJE = isset($_POST["HORA_DESMONTAJE"])?$_POST["HORA_DESMONTAJE"]:"";
$LUGAR_MONTAJE = isset($_POST["LUGAR_MONTAJE"])?$_POST["LUGAR_MONTAJE"]:"";
$SERVICIO_OTORGAR = isset($_POST["SERVICIO_OTORGAR"])?$_POST["SERVICIO_OTORGAR"]:"";
$MONEDAS = isset($_POST["MONEDAS"])?$_POST["MONEDAS"]:"";
$NOMBRE_VENDEDOR = isset($_POST["NOMBRE_VENDEDOR"])?$_POST["NOMBRE_VENDEDOR"]:"";
$NOMBRE_EJECUTIVOEVENTO = isset($_POST["NOMBRE_EJECUTIVOEVENTO"])?$_POST["NOMBRE_EJECUTIVOEVENTO"]:"";
$NOMBRE_INGRESO = isset($_POST["NOMBRE_INGRESO"])?$_POST["NOMBRE_INGRESO"]:"";
$CIERRE_TOTAL = isset($_POST["CIERRE_TOTAL"])?$_POST["CIERRE_TOTAL"]:"";
$TOTAL_AVION_SINIVA = isset($_POST["TOTAL_AVION_SINIVA"])?$_POST["TOTAL_AVION_SINIVA"]:"";
$hALTAEVENTOS = isset($_POST["hALTAEVENTOS"])?$_POST["hALTAEVENTOS"]:""; 
$IPaltaeventos = isset($_POST["IPaltaeventos"])?$_POST["IPaltaeventos"]:"";

	
   echo $altaeventos->altaeventos ($NUMERO_EVENTO,$FECHA_ALTA_EVENTO , $STATUS_EVENTO , $FECHA_AUTORIZACION_EVENTO , $MONTOC_TOTAL_EVENTO , $MONTO_TOTAL_AVION ,$CANTIDAD_PORCENTAJEV,$FEE_COBRADO, $PORCENTAJE_FEE,$MONTO_TOTAL_DEL_EVENTO , $NOMBRE_COMERCIAL_EVENTO , $NOMBRE_FISCAL_EVENTO , $NOMBRE_EVENTO , $NOMBRE_CORTO_EVENTO , $NOMBRE_CONTACTO_EVENTO , $CELULAR_CONTACTO_1 , $CORREO_CONTACTO_1 , $AREA_CONTACTO_CLIENTE , $OBSERVACIONES_1 , $TIPO_DE_EVENTO , $FORMATO_EVENTO , $PAIS_DEL_EVENTO , $CIUDAD_DEL_EVENTO , $HOTEL_LUGAR , $NUMERO_DE_PERSONAS , $FECHA_INICIO_EVENTO , $NOMBRE_COMERCIAL , $FECHA_FINAL_EVENTO , $HORA_TERMINO_EVENTO , $FECHA_LLEGADA_STAFF , $HORA_LLEGADA_STAFF , $FECHA_REGRESO_STAFF , $HORA_REGRESO_STAFF , $MATERIAL_EQUIPO_BODEGA, $FECHA_INICIO_MONTAJE, $HORA_INICIO_MONTAJE, $FECHA_DESMONTAJE,$HORA_DESMONTAJE, $LUGAR_MONTAJE,$SERVICIO_OTORGAR,$MONEDAS,$NOMBRE_VENDEDOR,$NOMBRE_EJECUTIVOEVENTO,$CIERRE_TOTAL,$TOTAL_AVION_SINIVA,$NOMBRE_INGRESO,$hALTAEVENTOS,$enviaraltaeventos, $borraraltaeventos,$IPaltaeventos);
	
//include_once (__ROOT1__."/includes/crea_funciones.php");

}


elseif($EMAIL_ALTA_EVENTOS1 ==true){
$conexion2 = new herramientas();
$NOMBRE_1 = 'Peticion';
$EMAILnombre = array($EMAIL_ALTA_EVENTOS1=>$NOMBRE_1);
$adjuntos = array(''=>'');
$Subject = 'DATOS SOLICITADOS';
/*nuevo*/
//$array = isset($_POST['cronovuelos'])?$_POST['cronovuelos']:'';
if($array != ''){
$loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
$or1='';
for($rrr=0;$rrr<=$loopcuenta;$rrr++){
	if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
	$query1 .= ' id= '.$array[$rrr].$or1;
}
$query2 = str_replace('[object Object]','',$query1);
$query2 = "and (".$query2.") ";
}else{
	//echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
} 
                                                                  
$MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('STATUS_EVENTO, NUMERO_EVENTO, FECHA_ALTA_EVENTO ',

'NOMBRE ,OBSERVACIONES,FECHA', '04altaeventos',  " where id = '".$_SESSION['idevento']."' "/*nuevo*/ );

$variables = 'SUBIR_COTIZACION, ';
// trim($variables, ',');

 $cadenacompleta =substr($variables, 0, -2);
 
$adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04EVENTOSfotos', " where idRelacion = '".$_SESSION['idevento']."' " );

$html = $altaeventos->html2('ALTA DE EVENTOS ',$MANDA_INFORMACION );

$smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
$idlogo = $smtp['idRelacion'];
$logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);

$embebida = array('../includes/archivos/'.$logo => 'ver');
echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
} 


  
    elseif($borraraltaeventos == 'borraraltaeventos'){
	$borra_ALTAE = isset($_POST["borra_ALTAE"])?$_POST["borra_ALTAE"]:"";
		
	echo $altaeventos->borraraltaeventos($borra_ALTAE);
	  
}
  
    elseif($borrafoto == 'borrafoto'){
	$borra_fotoid = isset($_POST["borra_fotoid"])?$_POST["borra_fotoid"]:"";

	echo $altaeventos->borrafoto($borra_fotoid);
}

elseif($hnumeroevento == 'hnumeroevento' ){
$NUMERO_EVENTO_COLABORADOR = isset($_POST["NUMERO_EVENTO_COLABORADOR"])?$_POST["NUMERO_EVENTO_COLABORADOR"]:"";
$INICIALES_EMPRESA_EVENTO = isset($_POST["INICIALES_EMPRESA_EVENTO"])?$_POST["INICIALES_EMPRESA_EVENTO"]:"";
$NUMERO_DE_EVENTO = isset($_POST["NUMERO_DE_EVENTO"])?$_POST["NUMERO_DE_EVENTO"]:"";
$FECHA_NUMERO_EVENTO = isset($_POST["FECHA_NUMERO_EVENTO"])?$_POST["FECHA_NUMERO_EVENTO"]:"";
$hnumeroevento = isset($_POST["hnumeroevento"])?$_POST["hnumeroevento"]:""; 	

		
	if($NUMERO_DE_EVENTO==''){
		echo "FALTA CAMPO NUMERO DE EVENTO";
	}elseif($INICIALES_EMPRESA_EVENTO==''){
		echo "FALTA CAMPO INICIALES DE EVENTO";
	}elseif($NUMERO_EVENTO_COLABORADOR ==''){
		echo "FALTA CAMPO NOMBRE DEL COLABORADOR";	
	}elseif($altaeventos->revisar_04altaeventos_ID($INICIALES_EMPRESA_EVENTO.$NUMERO_DE_EVENTO)>1){
		echo "EVENTO PREVIAMENTE INGRESADO";
	}else{
		echo $altaeventos->numeroevento ($NUMERO_EVENTO_COLABORADOR , $INICIALES_EMPRESA_EVENTO , $NUMERO_DE_EVENTO , $FECHA_NUMERO_EVENTO , $hnumeroevento );
	}
				
	  //include_once (__ROOT1__."/includes/crea_funciones.php");

}




/////////////////////////COTIZACION DE PROVEEDORES////////////////////////////////////////


if($hCOTIPRO == 'hCOTIPRO' or $enviarCOTIPRO=='enviarCOTIPRO'){
	
	
	if( $_FILES["ADJUNTO_COTIPRO"] == true){
	$ADJUNTO_COTIPRO = $conexion->solocargar("ADJUNTO_COTIPRO");
	}if($ADJUNTO_COTIPRO=='2' or $ADJUNTO_COTIPRO=='' or $ADJUNTO_COTIPRO=='1'){
	$ADJUNTO_COTIPRO1 = "";	
	}else{
	$ADJUNTO_COTIPRO1 = $ADJUNTO_COTIPRO;
				 }
	   				 
   $NOMBRE_PROVEEDOR = isset($_POST["NOMBRE_PROVEEDOR"])?$_POST["NOMBRE_PROVEEDOR"]:"";
   $DOCUMENTO_COTIPRO = isset($_POST["DOCUMENTO_COTIPRO"])?$_POST["DOCUMENTO_COTIPRO"]:"";
   $OBSERVACIONES_COTIPRO = isset($_POST["OBSERVACIONES_COTIPRO"])?$_POST["OBSERVACIONES_COTIPRO"]:"";
   $FECHA_COTIPRO = isset($_POST["FECHA_COTIPRO"])?$_POST["FECHA_COTIPRO"]:"";
   $hCOTIPRO = isset($_POST["hCOTIPRO"])?$_POST["hCOTIPRO"]:""; 
				 
				 
					 
   echo $altaeventos->COTIPRO( $NOMBRE_PROVEEDOR,$DOCUMENTO_COTIPRO ,$ADJUNTO_COTIPRO, $OBSERVACIONES_COTIPRO , $FECHA_COTIPRO , $hCOTIPRO,$IpCOTIPRO,$enviarCOTIPRO );
				 
					
				   
   }
   elseif($EMAIL_COTIPRO ==true){
   $conexion2 = new herramientas();
   $NOMBRE_1 = 'Peticion';
   $EMAILnombre = array($EMAIL_COTIPRO=>$NOMBRE_1);
   $adjuntos = array(''=>'');
   $Subject = 'DATOS SOLICITADOS';
	/*nuevo*/
   $array = isset($_POST['cotipro'])?$_POST['cotipro']:'';
   if($array != ''){
   $loopcuenta = count($array) - 1;$loopcuenta2 = count($array) - 2;
   $or1='';
   for($rrr=0;$rrr<=$loopcuenta;$rrr++){
   if($rrr<=$loopcuenta2){$or1 = ' or ';}else{$or1 = '';}
   $query1 .= ' id= '.$array[$rrr].$or1;
   }
   $query2 = str_replace('[object Object]','',$query1);
   $query2 = "and (".$query2.") ";
   }else{
   echo "SELECCIONA UNA CASILLA DEL LISTADO DE ABAJO."; exit;
   } 
																				   
   $MANDA_INFORMACION = $altaeventos->MANDA_INFORMACION('NOMBRE_PROVEEDOR,DOCUMENTO_COTIPRO, OBSERVACIONES_COTIPRO, FECHA_COTIPRO ',
				 
   'NOMBRE PROVEEDOR,MONTO, OBSERVACIONES,FECHA', '04cotizacionproveedores',  " where idRelacion = '".$_SESSION['idevento']."' ".$query2/*nuevo*/ );
   $variables = 'ADJUNTO_COTIPRO, ';
   //DOCUMENTO_COTIPRO trim($variables, ',');
				 
   $cadenacompleta =substr($variables, 0, -2);
				  
   $adjuntos = $altaeventos->ADJUNTA_IMAGENES_EMAIL($cadenacompleta,'04cotizacionproveedores', " where idRelacion = '".$_SESSION['idevento']."' ".$query2 );
				 

				 
     $html = $altaeventos->html2('COTIZACIÓN DE PROVEEDORES ',$MANDA_INFORMACION );

     $smtp = $altaeventos->array_smtp($var_INICIALES['iniciales_evento']);
     $idlogo = $smtp['idRelacion'];
     $logo = $altaeventos->variables_informacionfiscal_logo2($idlogo);
				 
   $embebida = array('../includes/archivos/'.$logo => 'ver');
   echo $conexion2->email($EMAILnombre, $html, $adjuntos, $embebida, $Subject,$smtp);
   }  
					 
	if($borra_COTIPRO == 'borra_COTIPRO' ){
				 
   $borra_cotipro = isset($_POST["borra_cotipro"])?$_POST["borra_cotipro"]:"";
   echo $altaeventos->borra_COTIPRO( $borra_cotipro );
   }	
   	   //include_once (__ROOT1__."/includes/crea_funciones.php");  









$id = $_SESSION['id'];
$fechaActual = date('Y-m-d');	
	/*
if($hALTAEVENTOS!='hALTAEVENTOS' AND ( $_FILES["ARCHIVO_RELACIONADO_MONTAJE"] == true or $_FILES["SUBIR_COTIZACION"] == true or $_FILES["SUBIR_ORDEN_COMPRA"] == true or $_FILES["SUBIR_CONTRATO_FIRMADO"] == true or $_FILES["SUBIR_COTIZACION_FIRMADA"] == true or $_FILES["LOGO_CLIENTE"] == true or
$_FILES["IMAGEN_EVENTO"] == true  ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $altaeventos->cargarAE($ETQIETA,'04EVENTOSfotos','7', 0,'','',$fechaActual,$id);

}	
}*/

//aqui actualiza desde vistapreviaeventos.php
$IPaltaeventos = isset($_POST["IPaltaeventos"])?$_POST["IPaltaeventos"]:"";
if($IPaltaeventos!='' AND ( $_FILES["ARCHIVO_RELACIONADO_MONTAJE"] == true or $_FILES["SUBIR_COTIZACION"] == true or $_FILES["SUBIR_ORDEN_COMPRA"] == true or $_FILES["SUBIR_CONTRATO_FIRMADO"] == true or $_FILES["SUBIR_COTIZACION_FIRMADA"] == true or $_FILES["LOGO_CLIENTE"] == true or $_FILES["IMAGEN_EVENTO"] == true  ) ){
	//ECHO 'AAAAAAAAAAAAAAAA';
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $altaeventos->cargarAE($ETQIETA,'04EVENTOSfotos','7', $IPaltaeventos,'','',$fechaActual,$id ,'si');

}
}


	   
	   
if($IpCOTIPRO== true and ( $_FILES["ADJUNTO_COTIPRO"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04cotizacionproveedores','3',$IpCOTIPRO);
}	

}



if($IPCIERRE2 == true and ( $_FILES["adjunto_cierre"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04cierre','3',$IPCIERRE2);
}	

}



if($ipPROGRAMAOPERATIVO == true and ( $_FILES["ADJUNTO_PROGRAMAOPERATIVO"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04programaoperativo','3',$ipPROGRAMAOPERATIVO);
}	

}


if($ipROOMINGLISTOV == true and ( $_FILES["ADJUNTO_ROOMING"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04roominglist','3',$ipROOMINGLISTOV);
}	

}

if($Icronosvuelos == true and ( $_FILES["ADJUNTO_CRONOVUELOS"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04cronologicovuelos','3',$Icronosvuelos);
}	

}

if($Ipcronoterrestre == true and ( $_FILES["ADJUNTO_cronoterrestre"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04cronoterrestre','3',$Ipcronoterrestre);
}	

}
//ADJUNTO_COBROS
if($Ipcobroscliente == true and ( $_FILES["ADJUNTO_COBROS"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04cobroscliente','3',$Ipcobroscliente);
}	

}

if($IpINGRESOS == true and ( $_FILES["ADJUNTO_INGRESOS"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04pagosingresos','3',$IpINGRESOS);
}	

}


if($IpEGRESOS == true and ( $_FILES["ADJUNTO_EGRESO"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04pagoegresos','3',$IpEGRESOS);
}	

}

if($Ipboletosavion == true and ( $_FILES["ADJUNTO_BOLETOSAVION"] == true ) ){
foreach($_FILES AS $ETQIETA => $VALOR){
	echo $conexion->cargar($ETQIETA,'04boletosavion','3',$Ipboletosavion);
}	

}

?>