<?php
/*
clase EPC INNOVA
CREADO : 10/mayo/2023
TESTER: FATIMA ARELLANO
PROGRAMER: SANDOR ACTUALIZACION: 1 MAY 2023
fecha sandor: 24/ABRIL/2025
fecha fatima
*/
	define('__ROOT3__', dirname(dirname(__FILE__)));
	require __ROOT3__."/includes/class.epcinn.php";	
	

	
	class accesoclase extends colaboradores{


	public function array_smtp($iniciales){

		$conn = $this->db();
		$variablequery = "select * from 03datossmtp where prefijo = '".$iniciales."' limit 1 ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);
		$host['Host'] = $row['Host'];
		$host['Username'] = $row['Username'];
		$host['Passwordd'] = $row['Passwordd'];
		$host['SMTPSecure'] = $row['SMTPSecure'];
		$host['Port'] = $row['Port'];
		$host['setFrom1'] = $row['setFrom1'];
		$host['setFrom2'] = $row['setFrom2'];
		$host['prefijo'] = $row['prefijo'];
		$host['idRelacion'] = $row['idRelacion'];
		return $host;
	}


	public function variables_informacionfiscal_logo2($idRelacion){
		
		$conn = $this->db();

		$variablequery = "select id,ADJUNTAR_LOGO_INFORMACION from 03docs_info_fiscal where idRelacion = '".$idRelacion."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);
		if($row['id']!=''){
		return $row['ADJUNTAR_LOGO_INFORMACION'];
		}else{

		$variablequery1 = "select id from 03datosdelaempresa where NCE_OBSERVACIONES = 'EP' OR NCE_OBSERVACIONES = 'EPC'  ";
		$arrayquery1 = mysqli_query($conn,$variablequery1);
		$row = mysqli_fetch_array($arrayquery1, MYSQLI_ASSOC);
		if($row['id']==0){
			$idempresa = 1;
		}else{
			$idempresa = $row['id'];			
		}
		
			
		$variablequery = "select ADJUNTAR_LOGO_INFORMACION from 03docs_info_fiscal where idRelacion = '".$row['id']."'  ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);
		return $row['ADJUNTAR_LOGO_INFORMACION'];			
		}
	}


	public function buscarnumero($filtro){
		$conn = $this->db();
		$variable = "select * from 04NUMEROevento where NUMERO_DE_EVENTO like '%".$filtro."%' ";
$variablequery = mysqli_query($conn,$variable);
		while($row = mysqli_fetch_array($variablequery, MYSQLI_ASSOC)){
			$resultado [] = $row['NUMERO_DE_EVENTO'];
		}
		return $resultado;
		
	}


	
	public function NUMERO_EVENTO($NCE_OBSERVACIONES){
		$conn = $this->db();
		$variable = "select MAX(CONSECUTIVO) + 1 AS ULTIMO from 03datosdelaempresa WHERE NCE_OBSERVACIONES = '".$NCE_OBSERVACIONES."' ";
	 $variablequery = mysqli_query($conn,$variable);
	$row = mysqli_fetch_array($variablequery);
	return $row['ULTIMO'];
	}
	
	public function sologuardarAE($campo,$nuevonombre,$nombretabla,$idpost,$fecha,$idrelacionsesion,$BANDERA){
		$conn = $this->db();//idrelacionsesion
		$variablequery2 = 
		"insert into ".$nombretabla." 
		(idRelacion,".$campo.",fecha,idrelacionsesion, BANDERA) 
		values 
		(".$idpost.",'".$nuevonombre."','".$fecha."','".$idrelacionsesion."','".$BANDERA."') ";
		mysqli_query($conn,$variablequery2);
		}


	public function Listado_fotoseventostemporal($CAMPO,$fecha,$idrelacionsesion,$idrelacion){
		$conn = $this->db();

		$variablequery = "select id, ".$CAMPO." from 04EVENTOSfotos where 

		idRelacion  = '".$idrelacion."' and
		(".$CAMPO." is not null or ".$CAMPO." <> '') and BANDERA = 'si'
		order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}






	public function cargarAE($archivo,$nombretabla,$IDENTIFICADOR='1',$idpost='no',$where=false,$idTemporal=false,$fecha=false,$idrelacionsesion=false,$BANDERA=false)
	{
		$nombre_carpeta=__ROOT2__.'/includes/archivos';
		$filehandle = opendir($nombre_carpeta);
		$nombretemp = $_FILES[$archivo]["tmp_name"];
		$nombrearchivo = $_FILES[$archivo]["name"];
		$tamanyoarchivo = $_FILES[$archivo]["size"];
		//$tipoarchivo = getimagesize($nombretemp);
		$extension = explode('.',$nombrearchivo);
		$cuenta = count($extension) - 1;
		$nuevonombre =  $archivo.'_'.date('Y_m_d_h_i_s').'.'.$extension[$cuenta];
		 $extension[$cuenta];

		if( 
		strtolower($extension[$cuenta]) == 'pdf' or 
		strtolower($extension[$cuenta]) == 'gif' or 
		strtolower($extension[$cuenta]) == 'jpeg' or 
		strtolower($extension[$cuenta]) == 'jpg' or 
		strtolower($extension[$cuenta]) == 'png' or 
		strtolower($extension[$cuenta]) == 'mp4' or 
		strtolower($extension[$cuenta]) == 'docx' or 
		strtolower($extension[$cuenta]) == 'doc' or 
		strtolower($extension[$cuenta]) == 'xml' or 
		strtolower($extension[$cuenta]) == 'txt' or
		strtolower($extension[$cuenta]) == 'xlsx' or
		strtolower($extension[$cuenta]) == 'htm' or
		strtolower($extension[$cuenta]) == 'xls'  		
		){ //gif o jpg
		/*if ($tamanyoarchivo <= $tamanyomax) { //archivo demasioado grande*/
		if(move_uploaded_file($nombretemp, $nombre_carpeta.'/'. $nuevonombre)){
		chmod ($nombre_carpeta.'/' . $nuevonombre, 0755);
		$tamanyo =fileSize($nombre_carpeta.'/'. $nuevonombre);
		$fp = fopen($nombre_carpeta.'/'.$nuevonombre, "rb"); 
		$contenido = fread($fp, $tamanyo);
		$contenido = addslashes($contenido);
		if($IDENTIFICADOR=='1'){
		$this->sologuardar($archivo,$nuevonombre,$nombretabla);
		}elseif($IDENTIFICADOR=='2'){
		$this->sologuardar2($archivo,$nuevonombre,$nombretabla);
		}elseif($IDENTIFICADOR=='3'){
		$this->sologuardar3($archivo,$nuevonombre,$nombretabla,$idpost);
		}elseif($IDENTIFICADOR=='4'){
		$this->sologuardar4($archivo,$nuevonombre,$nombretabla,$idpost);
		}elseif($IDENTIFICADOR=='5'){
		$this->sologuardar5($archivo,$nuevonombre,$nombretabla,$where,$idpost);
		}elseif($IDENTIFICADOR=='6'){
		$this->sologuardar6($archivo,$nuevonombre,$nombretabla,$idpost,$idTemporal);
		}elseif($IDENTIFICADOR=='7'){
		$this->sologuardarAE($archivo,$nuevonombre,$nombretabla,$idpost,$fecha,$idrelacionsesion,$BANDERA);
		}
		
		return trim($nuevonombre);
		}
		else{
			return "1";
		}
		}
		else{
			return " ";
		}
	}

	
	/*
	
	INFORMACION IMPORTANTE
	//
	*/
	
	
	public function var_altaeventos(){
		$conn = $this->db();
		$variablequery = "select * from 04altaeventos where id = '".$_SESSION['idevento']."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		return $row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);		
	}
	
	
	public function var_altaeventosdoctos(){
		$conn = $this->db();
		$variablequery = "select * from 04EVENTOSfotos where id = '".$_SESSION['id']."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		return $row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);		
	}
	
	public function Listado_altaeventosDOCTOS($id){ 
	$conn = $this->db(); 
	$variablequery = "select * from 04EVENTOSfotos where idRelacion = '".$id."'  order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery); }
	
	public function variable_altaeventos(){
		$conn = $this->db();
		$variablequery = "select * from 04altaeventos where idRelacion = '".$_SESSION['id']."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		return $row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);		
	}

	public function variable_fecha(){
		$conn = $this->db();
		$variablequery = "select FECHA_AUTORIZACION_EVENTO from 04altaeventos where id = '".$_SESSION['idevento']."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);
		return $row['FECHA_AUTORIZACION_EVENTO'];
		
	}


	public function revisar_altaeventos(){
		$conn = $this->db();
		$var1 = 'select id from 04altaeventos where idRelacion =  "'.$_SESSION['id'].'" ';
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['id'];
	}

	public function buscar(){
	$palabraclave = isset($_POST['busqueda'])?trim(strval($_POST['busqueda'])):'';
	//if($palabraclave!=''){
	$ResultadoPais[] = 'bbbbbbb'.$_POST['busqueda'];
	$ResultadoPais[] = 'nnnnnnn'.$_POST['busqueda'];
	}

	public function altaeventos ($NUMERO_EVENTO,$FECHA_ALTA_EVENTO , $STATUS_EVENTO , $FECHA_AUTORIZACION_EVENTO , $MONTOC_TOTAL_EVENTO , $MONTO_TOTAL_AVION ,$CANTIDAD_PORCENTAJEV,$FEE_COBRADO, $PORCENTAJE_FEE,$MONTO_TOTAL_DEL_EVENTO , $NOMBRE_COMERCIAL_EVENTO , $NOMBRE_FISCAL_EVENTO , $NOMBRE_EVENTO , $NOMBRE_CORTO_EVENTO , $NOMBRE_CONTACTO_EVENTO , $CELULAR_CONTACTO_1 , $CORREO_CONTACTO_1 , $AREA_CONTACTO_CLIENTE , $OBSERVACIONES_1 , $TIPO_DE_EVENTO , $FORMATO_EVENTO , $PAIS_DEL_EVENTO , $CIUDAD_DEL_EVENTO , $HOTEL_LUGAR , $NUMERO_DE_PERSONAS , $FECHA_INICIO_EVENTO , $NOMBRE_COMERCIAL , $FECHA_FINAL_EVENTO , $HORA_TERMINO_EVENTO , $FECHA_LLEGADA_STAFF , $HORA_LLEGADA_STAFF , $FECHA_REGRESO_STAFF , $HORA_REGRESO_STAFF , $MATERIAL_EQUIPO_BODEGA, $FECHA_INICIO_MONTAJE, $HORA_INICIO_MONTAJE, $FECHA_DESMONTAJE,$HORA_DESMONTAJE, $LUGAR_MONTAJE,$SERVICIO_OTORGAR,$MONEDAS,$NOMBRE_VENDEDOR,$NOMBRE_EJECUTIVOEVENTO,$CIERRE_TOTAL,$TOTAL_AVION_SINIVA,$NOMBRE_INGRESO,$NOMBRE_AUDITOR,$hALTAEVENTOS,$enviaraltaeventos, $borraraltaeventos,$IPaltaeventos){
		$MONTO_TOTAL_DEL_EVENTO  = str_replace(',','',$MONTO_TOTAL_DEL_EVENTO);
		$CANTIDAD_PORCENTAJEV  = str_replace(',','',$CANTIDAD_PORCENTAJEV);
		$MONTO_TOTAL_AVION  = str_replace(',','',$MONTO_TOTAL_AVION);
		$FEE_COBRADO  = str_replace(',','',$FEE_COBRADO);
		$MONTOC_TOTAL_EVENTO  = str_replace(',','',$MONTOC_TOTAL_EVENTO);		
		$TOTAL_AVION_SINIVA  = str_replace(',','',$TOTAL_AVION_SINIVA);
		
		$conn = $this->db();
		$existe = $this->revisar_altaeventos();
		$session = isset($_SESSION['id'])?$_SESSION['id']:'';                               
	if($session != ''){
		$nombreVendedorAnterior = '';
		$nombreEjecutivoAnterior = '';
		if($IPaltaeventos != 'enviaraltaeventos' and $IPaltaeventos >= '1'){
			$varNombresActuales = "select NOMBRE_VENDEDOR, NOMBRE_EJECUTIVOEVENTO from 04altaeventos where id = '".$IPaltaeventos."' ";
			$queryNombresActuales = mysqli_query($conn,$varNombresActuales);
			$rowNombresActuales = mysqli_fetch_array($queryNombresActuales, MYSQLI_ASSOC);
			$nombreVendedorAnterior = isset($rowNombresActuales['NOMBRE_VENDEDOR']) ? trim($rowNombresActuales['NOMBRE_VENDEDOR']) : '';
			$nombreEjecutivoAnterior = isset($rowNombresActuales['NOMBRE_EJECUTIVOEVENTO']) ? trim($rowNombresActuales['NOMBRE_EJECUTIVOEVENTO']) : '';
		}
			
		$var1 = "update 04altaeventos set   NUMERO_EVENTO = '".$NUMERO_EVENTO."' , FECHA_ALTA_EVENTO = '".$FECHA_ALTA_EVENTO."' ,  STATUS_EVENTO = '".$STATUS_EVENTO."' , FECHA_AUTORIZACION_EVENTO = '".$FECHA_AUTORIZACION_EVENTO."' , MONTOC_TOTAL_EVENTO = '".$MONTOC_TOTAL_EVENTO."' , MONTO_TOTAL_AVION = '".$MONTO_TOTAL_AVION."' , CANTIDAD_PORCENTAJEV = '".$CANTIDAD_PORCENTAJEV."' , FEE_COBRADO = '".$FEE_COBRADO."' , PORCENTAJE_FEE = '".$PORCENTAJE_FEE."' , MONTO_TOTAL_DEL_EVENTO = '".$MONTO_TOTAL_DEL_EVENTO."' , NOMBRE_COMERCIAL_EVENTO = '".$NOMBRE_COMERCIAL_EVENTO."' , NOMBRE_FISCAL_EVENTO = '".$NOMBRE_FISCAL_EVENTO."' , NOMBRE_EVENTO = '".$NOMBRE_EVENTO."' , NOMBRE_CORTO_EVENTO = '".$NOMBRE_CORTO_EVENTO."' , NOMBRE_CONTACTO_EVENTO = '".$NOMBRE_CONTACTO_EVENTO."' , CELULAR_CONTACTO_1 = '".$CELULAR_CONTACTO_1."' , CORREO_CONTACTO_1 = '".$CORREO_CONTACTO_1."' , AREA_CONTACTO_CLIENTE = '".$AREA_CONTACTO_CLIENTE."' , OBSERVACIONES_1 = '".$OBSERVACIONES_1."' , TIPO_DE_EVENTO = '".$TIPO_DE_EVENTO."' , FORMATO_EVENTO = '".$FORMATO_EVENTO."' , PAIS_DEL_EVENTO = '".$PAIS_DEL_EVENTO."' , CIUDAD_DEL_EVENTO = '".$CIUDAD_DEL_EVENTO."' , HOTEL_LUGAR = '".$HOTEL_LUGAR."' , NUMERO_DE_PERSONAS = '".$NUMERO_DE_PERSONAS."' , FECHA_INICIO_EVENTO = '".$FECHA_INICIO_EVENTO."' , NOMBRE_COMERCIAL = '".$NOMBRE_COMERCIAL."' , FECHA_FINAL_EVENTO = '".$FECHA_FINAL_EVENTO."' , HORA_TERMINO_EVENTO = '".$HORA_TERMINO_EVENTO."' , FECHA_LLEGADA_STAFF = '".$FECHA_LLEGADA_STAFF."' , HORA_LLEGADA_STAFF = '".$HORA_LLEGADA_STAFF."' , FECHA_REGRESO_STAFF = '".$FECHA_REGRESO_STAFF."' , HORA_REGRESO_STAFF = '".$HORA_REGRESO_STAFF."' , MATERIAL_EQUIPO_BODEGA = '".$MATERIAL_EQUIPO_BODEGA."' , FECHA_INICIO_MONTAJE = '".$FECHA_INICIO_MONTAJE."' , HORA_INICIO_MONTAJE = '".$HORA_INICIO_MONTAJE."' , FECHA_DESMONTAJE = '".$FECHA_DESMONTAJE."' , HORA_DESMONTAJE = '".$HORA_DESMONTAJE."' , LUGAR_MONTAJE = '".$LUGAR_MONTAJE."' , SERVICIO_OTORGAR = '".$SERVICIO_OTORGAR."' , MONEDAS = '".$MONEDAS."' , NOMBRE_VENDEDOR = '".$NOMBRE_VENDEDOR."' , NOMBRE_EJECUTIVOEVENTO = '".$NOMBRE_EJECUTIVOEVENTO."' , CIERRE_TOTAL = '".$CIERRE_TOTAL."' , TOTAL_AVION_SINIVA = '".$TOTAL_AVION_SINIVA."' , NOMBRE_INGRESO = '".$NOMBRE_INGRESO."' , NOMBRE_AUDITOR = '".$NOMBRE_AUDITOR."' , hALTAEVENTOS = '".$hALTAEVENTOS."' where id = '".$IPaltaeventos."' ; ";
	                                                                                    
		$var2 = "insert into 04altaeventos ( NUMERO_EVENTO, FECHA_ALTA_EVENTO, STATUS_EVENTO, FECHA_AUTORIZACION_EVENTO, MONTOC_TOTAL_EVENTO, MONTO_TOTAL_AVION,CANTIDAD_PORCENTAJEV,FEE_COBRADO, PORCENTAJE_FEE,MONTO_TOTAL_DEL_EVENTO, NOMBRE_COMERCIAL_EVENTO, NOMBRE_FISCAL_EVENTO, NOMBRE_EVENTO, NOMBRE_CORTO_EVENTO, NOMBRE_CONTACTO_EVENTO, CELULAR_CONTACTO_1, CORREO_CONTACTO_1, AREA_CONTACTO_CLIENTE, OBSERVACIONES_1, TIPO_DE_EVENTO, FORMATO_EVENTO, PAIS_DEL_EVENTO, CIUDAD_DEL_EVENTO, HOTEL_LUGAR, NUMERO_DE_PERSONAS, FECHA_INICIO_EVENTO, NOMBRE_COMERCIAL, FECHA_FINAL_EVENTO, HORA_TERMINO_EVENTO, FECHA_LLEGADA_STAFF, HORA_LLEGADA_STAFF, FECHA_REGRESO_STAFF, HORA_REGRESO_STAFF,MATERIAL_EQUIPO_BODEGA,FECHA_INICIO_MONTAJE,HORA_INICIO_MONTAJE,FECHA_DESMONTAJE,HORA_DESMONTAJE,LUGAR_MONTAJE,SERVICIO_OTORGAR,MONEDAS,NOMBRE_VENDEDOR,NOMBRE_EJECUTIVOEVENTO,CIERRE_TOTAL,TOTAL_AVION_SINIVA,NOMBRE_INGRESO,NOMBRE_AUDITOR, hALTAEVENTOS, idRelacion) values ( '".$NUMERO_EVENTO."' , '".$FECHA_ALTA_EVENTO."' , '".$STATUS_EVENTO."' , '".$FECHA_AUTORIZACION_EVENTO."' , '".$MONTOC_TOTAL_EVENTO."' , '".$MONTO_TOTAL_AVION."' , '".$CANTIDAD_PORCENTAJEV."' , '".$FEE_COBRADO."' , '".$PORCENTAJE_FEE."' , '".$MONTO_TOTAL_DEL_EVENTO."' , '".$NOMBRE_COMERCIAL_EVENTO."' , '".$NOMBRE_FISCAL_EVENTO."' , '".$NOMBRE_EVENTO."' , '".$NOMBRE_CORTO_EVENTO."' , '".$NOMBRE_CONTACTO_EVENTO."' , '".$CELULAR_CONTACTO_1."' , '".$CORREO_CONTACTO_1."' , '".$AREA_CONTACTO_CLIENTE."' , '".$OBSERVACIONES_1."' , '".$TIPO_DE_EVENTO."' , '".$FORMATO_EVENTO."' , '".$PAIS_DEL_EVENTO."' , '".$CIUDAD_DEL_EVENTO."' , '".$HOTEL_LUGAR."' , '".$NUMERO_DE_PERSONAS."' , '".$FECHA_INICIO_EVENTO."' , '".$NOMBRE_COMERCIAL."' , '".$FECHA_FINAL_EVENTO."' , '".$HORA_TERMINO_EVENTO."' , '".$FECHA_LLEGADA_STAFF."' , '".$HORA_LLEGADA_STAFF."' , '".$FECHA_REGRESO_STAFF."' , '".$HORA_REGRESO_STAFF."' , '".$MATERIAL_EQUIPO_BODEGA."' , '".$FECHA_INICIO_MONTAJE."' , '".$HORA_INICIO_MONTAJE."' , '".$FECHA_DESMONTAJE."' , '".$HORA_DESMONTAJE."' , '".$LUGAR_MONTAJE."' , '".$SERVICIO_OTORGAR."' , '".$MONEDAS."' , '".$NOMBRE_VENDEDOR."' , '".$NOMBRE_EJECUTIVOEVENTO."' , '".$CIERRE_TOTAL."' , '".$TOTAL_AVION_SINIVA."' , '".$NOMBRE_INGRESO."' , '".$NOMBRE_AUDITOR."' , '".$hALTAEVENTOS."' , '".$_SESSION['id']."');  ";	
			
	   	    if($IPaltaeventos != 'enviaraltaeventos' and $IPaltaeventos >= '1'){

	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		$nombreVendedorAnterior = str_replace(' ','^^',$nombreVendedorAnterior);
		$nombreEjecutivoAnterior = str_replace(' ','^^',$nombreEjecutivoAnterior);
		$nombreVendedorNuevo = str_replace(' ','^^',$NOMBRE_VENDEDOR);
		$nombreEjecutivoNuevo = str_replace(' ','^^',$NOMBRE_EJECUTIVOEVENTO);
		if($nombreVendedorAnterior != ''){
			$actualizaVendedor = "update 04personal set NOMBRE_PERSONAL = CONCAT(idPersonal,'^^','".$nombreVendedorNuevo."'), PERSONAL_FECHA_ULTIMA_CARGA = '".date('Y-m-d')."' where idRelacion = '".$IPaltaeventos."' and NOMBRE_PERSONAL like '%^^".$nombreVendedorAnterior."%' and autorizaAUT = 'si' ";
			mysqli_query($conn,$actualizaVendedor) or die('P156-V'.mysqli_error($conn));
		}
		if($nombreEjecutivoAnterior != ''){
			$actualizaEjecutivo = "update 04personal set NOMBRE_PERSONAL = CONCAT(idPersonal,'^^','".$nombreEjecutivoNuevo."'), PERSONAL_FECHA_ULTIMA_CARGA = '".date('Y-m-d')."' where idRelacion = '".$IPaltaeventos."' and NOMBRE_PERSONAL like '%^^".$nombreEjecutivoAnterior."%' and autorizaAUT = 'si' ";
			mysqli_query($conn,$actualizaEjecutivo) or die('P156-E'.mysqli_error($conn));
		}
		return "Actualizado";
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		$varfotos = "update 04EVENTOSfotos set idRelacion = '".mysqli_insert_id($conn)."',fecha=null,idrelacionsesion=null  where fecha = '".date('Y-m-d')."' and idrelacionsesion = '".$_SESSION['id']."' ";
		mysqli_query($conn,$varfotos) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "HA CADUCADO TU SESIÓN ";	
		}
    }

	public function Listado_fotoseventos($idrow){
		$conn = $this->db();

		$variablequery = "select * from 04EVENTOSfotos where idRelacion = '".$idrow."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}


	public function borrafoto($idrow){
		$conn = $this->db();

		echo $variablequery = "delete from 04EVENTOSfotos where id = '".$idrow."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}


	public function Listado_altaeventos(){
		$conn = $this->db();

		$variablequery = "select * from 04altaeventos order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}


	public function Listado_altaeventos2($id){
		$conn = $this->db();
		$variablequery = "select * from 04altaeventos  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}



	public function borraraltaeventos($id){
		$conn = $this->db();
		$variablequery = "delete from 04altaeventos where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}	
	
	








	public function lista_colaboradoreventos(){
		$conn = $this->db();
		$variable = "select 01empresa.id as idR, USUARIO_CRM  from 
		01empresa, 01adjuntoscolaboradores
		WHERE ESTATUS_CRM_ACTIVOBAJA='ACTIVO' and
		01empresa.id = `01adjuntoscolaboradores`.`idRelacion`
		";
	return $variablequery = mysqli_query($conn,$variable);

	}

    public function lista_colaboradoreventos2(){
		$conn = $this->db();
		$variable = "select 01empresa.id as idR, USUARIO_CRM  from 
		01empresa, 01adjuntoscolaboradores
		WHERE ESTATUS_CRM_ACTIVOBAJA='ACTIVO' and
		01empresa.id = `01adjuntoscolaboradores`.`idRelacion`
		";
	return $variablequery = mysqli_query($conn,$variable);

	}



	public function un_solo_colaborador2($id,$tabla,$campo){
	$conn = $this->db();
	$variable = "select id , ".$campo."  from ".$tabla."
	WHERE id = '".$id."' ";
	$variablequery = mysqli_query($conn,$variable);
	$row = mysqli_fetch_array($variablequery);
	return $row[$campo];
	}




	public function un_solo_colaborador($id,$tabla,$campo){
	$conn = $this->db();
	$variable = "select id , ".$campo."  from ".$tabla."
	WHERE id = '".$id."' ";
	$variablequery = mysqli_query($conn,$variable);
	$row = mysqli_fetch_array($variablequery);
	return $row[$campo];
	}
	
	
	
	
	/*funcion que trae iniciales del corporativo*/
	public function lista_inicialescorp(){
		$conn = $this->db();
		$variable = "select NCE_OBSERVACIONES from 03datosdelaempresa ";
	return $variablequery = mysqli_query($conn,$variable);

	}

	public function variable_numeroevento(){
		$conn = $this->db();
		$variablequery = "select * from 04NUMEROevento where idRelacion = '".$_SESSION['idevento']."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		return $row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);		
	}

	public function revisar_numeroevento($numeroevento){
		$conn = $this->db();
		$var1 = 'select id from 04NUMEROevento where NUMERO_DE_EVENTO =  "'.$numeroevento.'" ';
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['id'];
	}
	
	public function revisar_04altaeventos_ID($numeroevento){
		$conn = $this->db();
		$var1 = 'select id from 04altaeventos  where NUMERO_EVENTO =  "'.$numeroevento.'" ';
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['id'];
	}


	public function refresca_num_evento(){
		$conn = $this->db();
		$var1 = 'select NUMERO_EVENTO from 04altaeventos where id =  "'.$_SESSION['idevento'].'" ';
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['NUMERO_EVENTO'];
	}
	
	public function numeroevento ($NUMERO_EVENTO_COLABORADOR , $INICIALES_EMPRESA_EVENTO , $NUMERO_DE_EVENTO , $FECHA_NUMERO_EVENTO , $hnumeroevento){
		$conn = $this->db();
		$existe = $this->revisar_numeroevento($INICIALES_EMPRESA_EVENTO.$NUMERO_DE_EVENTO);
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){
			
		$var1 = "update 04NUMEROevento set 
		NUMERO_EVENTO_COLABORADOR = '".$NUMERO_EVENTO_COLABORADOR."' ,
		INICIALES_EMPRESA_EVENTO = '".$INICIALES_EMPRESA_EVENTO."' ,
		NUMERO_DE_EVENTO = '".$INICIALES_EMPRESA_EVENTO.$NUMERO_DE_EVENTO."' , 
		FECHA_NUMERO_EVENTO = '".$FECHA_NUMERO_EVENTO."' , 
		hnumeroevento = '".$hnumeroevento."' where NUMERO_DE_EVENTO = '".$INICIALES_EMPRESA_EVENTO.$NUMERO_DE_EVENTO."'; ";
	
		$var2 = "insert into 04NUMEROevento (
		NUMERO_EVENTO_COLABORADOR, 
		INICIALES_EMPRESA_EVENTO, 
		NUMERO_DE_EVENTO, 
		FECHA_NUMERO_EVENTO, 
		hnumeroevento, 
		idRelacion) values ( 
		'".$NUMERO_EVENTO_COLABORADOR."' , 
		'".$INICIALES_EMPRESA_EVENTO."' , 
		'".$INICIALES_EMPRESA_EVENTO.$NUMERO_DE_EVENTO."' , 
		'".$FECHA_NUMERO_EVENTO."' , 
		'".$hnumeroevento."' , 
		'".$_SESSION['idevento']."'
		);  ";	
		
		$vareventos = "update 04altaeventos set 
		NUMERO_EVENTO = '".$INICIALES_EMPRESA_EVENTO.$NUMERO_DE_EVENTO."' ,
		FECHA_AUTORIZACION_EVENTO = '".date('Y-m-d')."',
		iniciales_evento  = '".$INICIALES_EMPRESA_EVENTO."'
		where id = '".$session."' ";	

		$vainiciales = "update 03datosdelaempresa set 
		CONSECUTIVO = '".$NUMERO_DE_EVENTO."' 
		where NCE_OBSERVACIONES = '".$INICIALES_EMPRESA_EVENTO."' ";
		
       $sqlvar = "select * from 04altaeventos where id = '".$session."' ";
                $queryalta = mysqli_query($conn,$sqlvar) or die('P156'.mysqli_error($conn));
                $rowalta = mysqli_fetch_array($queryalta, MYSQLI_ASSOC);

                $inicialesEvento = strtoupper($INICIALES_EMPRESA_EVENTO);
                $colaboradoresInnQuery = array();

                if($inicialesEvento == 'INN'){
                        $colaboradoresInn = array(148,150,151);
                        foreach ($colaboradoresInn as $colaboradorInnId) {
                                $sqlColaboradorInn = "select NOMBRE_1, NOMBRE_2, APELLIDO_PATERNO, APELLIDO_MATERNO from 01informacionpersonal where id = '".$colaboradorInnId."' limit 1 ";
                                $queryColaboradorInn = mysqli_query($conn,$sqlColaboradorInn) or die('P477'.mysqli_error($conn));
                                $rowColaboradorInn = mysqli_fetch_array($queryColaboradorInn, MYSQLI_ASSOC);
                                if($rowColaboradorInn){
                                        $nombreColaboradorInn = trim($rowColaboradorInn['NOMBRE_1'].' '.$rowColaboradorInn['NOMBRE_2'].' '.$rowColaboradorInn['APELLIDO_PATERNO'].' '.$rowColaboradorInn['APELLIDO_MATERNO']);
                                        $nombreColaboradorInn = preg_replace('/\s+/', ' ', $nombreColaboradorInn);
                                        $nombreColaboradorInn = str_replace(' ','^^',$nombreColaboradorInn);

                                        $colaboradoresInnQuery[] = 'insert into 04personal
                                        (NOMBRE_PERSONAL, PERSONAL_FECHA_ULTIMA_CARGA, hDatosPERSONAL, autoriza, idRelacion, idPersonal)
                                        values
                                        ("'.$colaboradorInnId.'^^'.$nombreColaboradorInn.'", "'.date('Y-m-d').'", "calendarios", "si", "'.$session.'", "'.$colaboradorInnId.'")';
                                }
                        }
                }
		

		
		$NOMBRE_VENDEDOR = str_replace(' ','^^',$rowalta['NOMBRE_VENDEDOR']);
		$NOMBRE_EJECUTIVOEVENTO = str_replace(' ','^^',$rowalta['NOMBRE_EJECUTIVOEVENTO']);
		$NOMBRE_INGRESO = str_replace(' ','^^',$rowalta['NOMBRE_INGRESO']);
	
     $NOMBRE_VENDEDOR_query='insert into 04personal 
    (NOMBRE_PERSONAL, PERSONAL_FECHA_ULTIMA_CARGA, hDatosPERSONAL, autoriza, autorizaAUT, idRelacion, idPersonal) 
    values 
    ("'.$rowalta['NOMBRE_VENDEDOR_id'].'^^'.$NOMBRE_VENDEDOR.'", 
    "'.date('Y-m-d').'",  
    "calendarios",  
    "si",  
    "si",  
    "'.$session.'",
    "'.$rowalta['NOMBRE_VENDEDOR_id'].'")';

		$NOMBRE_EJECUTIVOEVENTO_query = 'insert into 04personal 
		(NOMBRE_PERSONAL, PERSONAL_FECHA_ULTIMA_CARGA, hDatosPERSONAL, autoriza, autorizaAUT, idRelacion, idPersonal) 
		values 
		("'.$rowalta['NOMBRE_EJECUTIVOEVENTO_id'].'^^'.$NOMBRE_EJECUTIVOEVENTO.'", "'.date('Y-m-d').'", "calendarios", "si","si", "'.$session.'", "'.$rowalta['NOMBRE_EJECUTIVOEVENTO_id'].'")';

		$NOMBRE_INGRESO_query = 'insert into 04personal 
		(NOMBRE_PERSONAL, PERSONAL_FECHA_ULTIMA_CARGA, hDatosPERSONAL, autoriza,  idRelacion, idPersonal) 
		values 
		("'.$rowalta['NOMBRE_INGRESO_id'].'^^'.$NOMBRE_INGRESO.'", "'.date('Y-m-d').'", "calendarios", "si", "'.$session.'", "'.$rowalta['NOMBRE_INGRESO_id'].'")';
	
	
////////////////////////////////////////////////////////////////////////////////////////cod fatima
/*
04EVENTOSfotos.SUBIR_COTIZACION  <---> 04COTICLIENTES.ADJUNTO_COTICLIENTES --- terminado
04altaeventos.MONTO_TOTAL_DEL_EVENTO  <---> 04COTICLIENTES.DOCUMENTO_COTICLIENTES
*/

	$sql04EVENTOSfotos = "select SUBIR_COTIZACION from 04EVENTOSfotos where idRelacion = '".$session."' and `BANDERA` = 'si' and SUBIR_COTIZACION<>'' ";
	$queryEVENTOSfotos = mysqli_query($conn,$sql04EVENTOSfotos) or die('P156'.mysqli_error($conn));
	
	/*  $rowalta */ 
	$MONTO_TOTAL_DEL_EVENTO  = str_replace(',','',$rowalta['MONTO_TOTAL_DEL_EVENTO']);

	/*$COTI_query = 'INSERT INTO 04COTICLIENTES 
	(DOCUMENTO_COTICLIENTES, FECHA_COTICLIENTES, 
	idRelacion) 
	VALUES 
	("'.$MONTO_TOTAL_DEL_EVENTO.'", "'.date('Y-m-d').'", 
	"'.$session.'" )';*/

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////	cod fatima	


        if($existe == 0 or $existe == ''){


                mysqli_query($conn,$NOMBRE_VENDEDOR_query) or die('P478'.mysqli_error($conn));
                mysqli_query($conn,$NOMBRE_EJECUTIVOEVENTO_query) or die('P479'.mysqli_error($conn));
                mysqli_query($conn,$NOMBRE_INGRESO_query) or die('P480'.mysqli_error($conn));
                foreach ($colaboradoresInnQuery as $queryInn) {
                        mysqli_query($conn,$queryInn) or die('P481'.mysqli_error($conn));
                }

                mysqli_query($conn,$var2) or die('P156'.mysqli_error($conn));
                //return mysqli_insert_id($conn);

		mysqli_query($conn,$vareventos) or die('P507'.mysqli_error($conn));
		mysqli_query($conn,$vainiciales) or die('P508'.mysqli_error($conn));

		/*nueva peticion 25-abril2025 inicia*/
	while($rowCOTI33 = mysqli_fetch_array($queryEVENTOSfotos, MYSQLI_ASSOC)){
			$COTICLIENTE_query = 'INSERT INTO 04COTICLIENTES 
			(ADJUNTO_COTICLIENTES, FECHA_COTICLIENTES, 
			 idRelacion, DOCUMENTO_COTICLIENTES) 
			VALUES 
			("'.$rowCOTI33["SUBIR_COTIZACION"].'", "'. date('Y-m-d').'", 
			 "'.$session.'", '.$MONTO_TOTAL_DEL_EVENTO.' )';
			mysqli_query($conn,$COTICLIENTE_query) or die('QAFATIMA518'.mysqli_error($conn));
	}
		/*nueva peticion 25-abril2025 termina*/

		return "Ingresado";
		}else{
		/*mysqli_query($conn,$var1) or die('P160'.mysqli_error($conn));
		mysqli_query($conn,$vareventos) or die('P157'.mysqli_error($conn));
		mysqli_query($conn,$vainiciales) or die('P157'.mysqli_error($conn));		*/
		//return "Actualizado";
		return "PREVIAMENTE INGRESADO, BUSCA OTRO NUM DE EVENTO, EVENTO #".$INICIALES_EMPRESA_EVENTO.$NUMERO_DE_EVENTO;
		}
			
        }else{
		echo "SELECCIONA UN EVENTO DE LA LISTA";	
		}
    }
	







/*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*//*cierr*/
	public function revisar_guardar_cierre($IPCIERRE){
		$conn = $this->db();
		$var1 = 'select id from 04cierre where id = "'.$IPCIERRE.'" ';
		//echo 'sssssssssssss'.$var1;
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['id'];
	}

	public function guardar_cierre(  $DOCUMENTO_cierre , $OBSERVACIONES_cierre , $fecha_cierre,$adjunto_cierre , $hCIERRE, $IPCIERRE,$enviarCIERRE){
		
		$conn = $this->db();
		$existe = $this->revisar_guardar_cierre($IPCIERRE);
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){
			
		$var1 = "update 04cierre set 
		DOCUMENTO_cierre = '".$DOCUMENTO_cierre."' , 
		OBSERVACIONES_cierre = '".$OBSERVACIONES_cierre."' , 

		hCIERRE = '".$hCIERRE."'  where id = '".$IPCIERRE."' ; ";
	
		 $var2 = " insert into 04cierre ( DOCUMENTO_cierre, OBSERVACIONES_cierre, fecha_cierre,adjunto_cierre, hCIERRE, idRelacion) values ( 
		 '".$DOCUMENTO_cierre."' , '".$OBSERVACIONES_cierre."' ,
		 '".$fecha_cierre."' , '".$adjunto_cierre."' , 
		 '".$hCIERRE."' , '".$session."' ); ";		
			
	    if($enviarCIERRE=='enviarCIERRE'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}




	public function Listado_cierre(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04cierre WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	
    public function Listado_cierre2($id){
		$conn = $this->db();
		$variablequery = "select * from 04cierre  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}

	public function BORRAREGISTRO_cierre( $borra_CIERREID){
		$conn = $this->db();
		$var1 = 'DELETE from 04cierre where id = "'.$borra_CIERREID.'" ';
		//echo 'sssssssssssss'.$var1;
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		mysqli_fetch_array($query, MYSQLI_ASSOC);
				RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}
	









/*nuevodocucierr*//*nuevodocucierr*//*nuevodocucierr*//*nuevodocucierr*//*nuevodocucierr*/


	public function NUEVODOCUCIERRE($nuevo_documento_cierre , $hnuevodocucierre,$enviarCIERRENUEVO,$IPCIERRENUEVO){
		
		$conn = $this->db();
		//$existe = $this->revisar_guardar_cierrenuevo();
		$session = isset($_SESSION['id'])?$_SESSION['id']:'';  
		if($session != ''){
			
		 $var1 = "update 04nuevodocumentocierre set 
		 nuevo_documento_cierre = '".$nuevo_documento_cierre."' , hnuevodocucierre = '".$hnuevodocucierre."'  where id = '".$IPCIERRENUEVO."' ; ";
	
		 $var2 = " insert into 04nuevodocumentocierre (nuevo_documento_cierre, hnuevodocucierre, idRelacion) values ( '".$nuevo_documento_cierre."' , '".$hnuevodocucierre."' , '".$session."' ); ";		
			
	    if($enviarCIERRENUEVO=='enviarCIERRENUEVO'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}


	public function Listado_nuevocierre2($id){
		$conn = $this->db();
		$variablequery = "select * from 04nuevodocumentocierre  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}

	public function Listado_nuevocierre(){
		$conn = $this->db();
		$variablequery = "select * from 04nuevodocumentocierre ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	public function revisar_guardar_nuevo($id){
		$conn = $this->db();
		$var1 = 'select id from 04nuevodocumentocierre where id = "'.$id.'" ';
		
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['id'];
	}
	public function BORRAREGISTRO_cierrenuevo($id){
		$conn = $this->db();
		$var1 = 'DELETE from 04nuevodocumentocierre where id = "'.$id.'" ';
	
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		mysqli_fetch_array($query, MYSQLI_ASSOC);
				RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}
	



/*programa operativo*//*programa operativo*//*programa operativo*//*programa operativo*//*programa operativo*//*programa operativo*/

	public function revisar_programaoperativo($IPCIERRE){
		$conn = $this->db();
		$var1 = 'select id from 04programaoperativo where id = "'.$IPCIERRE.'" ';
		//echo 'sssssssssssss'.$var1;
		$query = mysqli_query($conn,$var1) or die('P44'.mysqli_error($conn));
		$row = mysqli_fetch_array($query, MYSQLI_ASSOC);
		return $row['id'];
	}

	public function guarda_programaoperativo($ADJUNTO_PROGRAMAOPERATIVO, $DOCUMENTO_PROGRAMAOPERATIVO , $OBSERVACIONES_PROGRAMAOPERATIVO , $FECHA_PROGRAMAOPERATIVO , $hPROGRAMAOPERATIVO, $ipPROGRAMAOPERATIVO,$enviarOPERATIVO){
		
		$conn = $this->db();
		//$existe = $this->revisar_programaoperativo($IPCIERRE);
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){
			
		 $var1 = "update 04programaoperativo set 

		 DOCUMENTO_PROGRAMAOPERATIVO = '".$DOCUMENTO_PROGRAMAOPERATIVO."' ,
		 OBSERVACIONES_PROGRAMAOPERATIVO = '".$OBSERVACIONES_PROGRAMAOPERATIVO."' , 
 
		 hPROGRAMAOPERATIVO = '".$hPROGRAMAOPERATIVO."'
		 where id = '".$ipPROGRAMAOPERATIVO."' ;  ";
	
		 $var2 = " insert into 04programaoperativo (ADJUNTO_PROGRAMAOPERATIVO, DOCUMENTO_PROGRAMAOPERATIVO, OBSERVACIONES_PROGRAMAOPERATIVO, FECHA_PROGRAMAOPERATIVO, hPROGRAMAOPERATIVO, idRelacion) values ('".$ADJUNTO_PROGRAMAOPERATIVO."', '".$DOCUMENTO_PROGRAMAOPERATIVO."' , '".$OBSERVACIONES_PROGRAMAOPERATIVO."' , '".$FECHA_PROGRAMAOPERATIVO."' , '".$hPROGRAMAOPERATIVO."' , '".$session."' ); ";		
			
	    if($enviarOPERATIVO=='enviarOPERATIVO'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}

	public function borra_programaoperativo($id){
		$conn = $this->db();
		$variablequery = "delete from 04programaoperativo where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}	
	
	public function Listado_PROGRAMAOPERATIVO($idrelacionsesion){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04programaoperativo WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	
	public function Listado_operativo2($id){
		$conn = $this->db();
		$variablequery = "select * from 04programaoperativo  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}







/*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*//*rooming list*/



	public function guarda_rooming($ADJUNTO_ROOMING1,$DOCUMENTO_ROOMING , $OBSERVACIONES_ROOMING , $FECHA_ROOMING , $enviarROOMINGLISTOV,$iproominglinst ){
		
		$conn = $this->db();
		//$existe = $this->revisar_programaoperativo($IPCIERRE);
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){
			
		 $var1 = "update 04roominglist set 
		 DOCUMENTO_ROOMING  = '".$DOCUMENTO_ROOMING."' ,
		 OBSERVACIONES_ROOMING = '".$OBSERVACIONES_ROOMING."' , 
		 hROOMING = '".$hROOMING."' where id = '".$iproominglinst."' ;  ";
	
		 $var2 = "insert into 04roominglist ( DOCUMENTO_ROOMING, OBSERVACIONES_ROOMING, FECHA_ROOMING, hROOMING, idRelacion,ADJUNTO_ROOMING) values ( '".$DOCUMENTO_ROOMING."' , '".$OBSERVACIONES_ROOMING."' , '".$FECHA_ROOMING."' , '".$hROOMING."' , '".$session."' , '".$ADJUNTO_ROOMING1."' ); ";		
			
	    if($enviarROOMINGLISTOV=='enviarROOMINGLISTOV'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}
	
	public function borra_rooming($id){
		$conn = $this->db();
		$variablequery = "delete from 04roominglist where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}	
	
	public function Listado_rooming2($id){
		$conn = $this->db();
		$variablequery = "select * from 04roominglist  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	
	
	
	public function Listado_rooming(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04roominglist WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	
	





    /////////////////////////CRONOS VUELOS///////////////////////////////////



public function CRONOVUELOS($DOCUMENTO_CRONOVUELOS ,$OBSERVACIONES_CRONOVUELOS,$ADJUNTO_CRONOVUELOS , $FECHA_CRONOVUELOS , $hCRONOVUELOS1,$Icronosvuelos,$enviarCRONOSVUELOS){
		
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){                            
			
		 $var1 = "update 04cronologicovuelos  set 
		 DOCUMENTO_CRONOVUELOS = '".$DOCUMENTO_CRONOVUELOS."' , 
		 OBSERVACIONES_CRONOVUELOS = '".$OBSERVACIONES_CRONOVUELOS."' ,
		 hCRONOVUELOS1 = '".$hCRONOVUELOS1."' 
		 where id = '".$Icronosvuelos."' ;  ";
	
		 $var2 = "insert into 04cronologicovuelos ( DOCUMENTO_CRONOVUELOS, OBSERVACIONES_CRONOVUELOS, ADJUNTO_CRONOVUELOS,FECHA_CRONOVUELOS, hCRONOVUELOS1, idRelacion) values ( '".$DOCUMENTO_CRONOVUELOS."' , '".$OBSERVACIONES_CRONOVUELOS."' , '".$ADJUNTO_CRONOVUELOS."' , '".$FECHA_CRONOVUELOS."' , '".$hCRONOVUELOS1."' , '".$session."' ); ";		
			
	    if($enviarCRONOSVUELOS=='enviarCRONOSVUELOS'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}
	
	
	
		public function Listado_CRONOVUELOS2($id){
		$conn = $this->db();
		$variablequery = "select * from 04cronologicovuelos  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	
	
	public function Listado_CRONOvuelos(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04cronologicovuelos WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	
	
	
	
	public function borra_CRONOSV($id){
		$conn = $this->db();
		$variablequery = "delete from 04cronologicovuelos where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}




     ///////////////////////////// CRONOS TERRESTRE/////////////////////////

        public function CRONOterrestre($DOCUMENTO_cronoterrestre , $ADJUNTO_cronoterrestre ,$OBSERVACIONES_cronoterrestre , $FECHA_cronoterrestre , $hCRONOTERRESTRE,$Ipcronoterrestre,$enviarcronoterre ){
		
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){                            
			
		 $var1 = "update 04cronoterrestre  set  
		 DOCUMENTO_cronoterrestre = '".$DOCUMENTO_cronoterrestre."' ,
		 OBSERVACIONES_cronoterrestre = '".$OBSERVACIONES_cronoterrestre."' ,
		 hCRONOTERRESTRE = '".$hCRONOTERRESTRE."'  
		 where id = '".$Ipcronoterrestre."' ;  ";
	
		 $var2 = "insert into 04cronoterrestre (DOCUMENTO_cronoterrestre, ADJUNTO_cronoterrestre,OBSERVACIONES_cronoterrestre, FECHA_cronoterrestre, hCRONOTERRESTRE, idRelacion) values ( '".$DOCUMENTO_cronoterrestre."' , '".$ADJUNTO_cronoterrestre."' , '".$OBSERVACIONES_cronoterrestre."' , '".$FECHA_cronoterrestre."' , '".$hCRONOTERRESTRE."' , '".$session."' ); ";		
			
	    if($enviarcronoterre=='enviarcronoterre'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}
	
		
	public function Listado_CRONOTERRESTRE(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04cronoterrestre WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	
		public function Listado_CRONOTERRESTRE2($id){
		$conn = $this->db();
		$variablequery = "select * from 04cronoterrestre  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	

	
	
	
	
	public function borra_CRONOSTERRRE($id){
		$conn = $this->db();
		$variablequery = "delete from 04cronoterrestre where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}


  ///////////////////////////// COBROS CLIENTE/////////////////////////

        public function cobroscliente($DOCUMENTO_COBROS ,$ADJUNTO_COBROS, $OBSERVACIONES_COBROS , $FECHA_COBROS , $hCOBROSCLIENTE,$Ipcobroscliente,$enviarcobroscliente){
		
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){                            
			
		 $var1 = "update 04cobroscliente  set
		 DOCUMENTO_COBROS = '".$DOCUMENTO_COBROS."' , 
		 OBSERVACIONES_COBROS = '".$OBSERVACIONES_COBROS."' ,  
		 hCOBROSCLIENTE = '".$hCOBROSCLIENTE."'
		 where id = '".$Ipcobroscliente."' ;  ";
	
		 $var2 = "insert into 04cobroscliente ( DOCUMENTO_COBROS,ADJUNTO_COBROS, OBSERVACIONES_COBROS, FECHA_COBROS, hCOBROSCLIENTE, idRelacion) values ( '".$DOCUMENTO_COBROS."' , '".$ADJUNTO_COBROS."' , '".$OBSERVACIONES_COBROS."' , '".$FECHA_COBROS."' , '".$hCOBROSCLIENTE."' , '".$session."' ); ";		
			
	    if($enviarcobroscliente=='enviarcobroscliente'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}
	
		
	public function Listado_cobroscliente(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04cobroscliente WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	
		public function Listado_cobroscliente2($id){
		$conn = $this->db();
		$variablequery = "select * from 04cobroscliente  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	

	
	
	
	
	public function borra_COBROSCLIENTE($id){
		$conn = $this->db();
		$variablequery = "delete from 04cobroscliente where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}


	
	
		
	
	
	

  ///////////////////////////// PAGOS INGRESOS/////////////////////////

        public function pagoingreso( $DOCUMENTO_INGRESOS ,$ADJUNTO_INGRESOS, $OBSERVACIONES_INGRESOS, $FECHA_INGRESOS , $hPAGOSINGRESOS1,$IpINGRESOS,$enviarpagosingre ){
			
		$OBSERVACIONES_INGRESOS = str_replace(',','',$OBSERVACIONES_INGRESOS);
		
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){                            
			
		 $var1 = "update 04pagosingresos  set  
		 DOCUMENTO_INGRESOS = '".$DOCUMENTO_INGRESOS."' , 
		 OBSERVACIONES_INGRESOS = '".$OBSERVACIONES_INGRESOS."' ,  
		 hPAGOSINGRESOS1 = '".$hPAGOSINGRESOS1."'
		 where id = '".$IpINGRESOS."' ;  ";
	
		 $var2 = "insert into 04pagosingresos  ( DOCUMENTO_INGRESOS,ADJUNTO_INGRESOS, OBSERVACIONES_INGRESOS, FECHA_INGRESOS, hPAGOSINGRESOS1, idRelacion) values ( '".$DOCUMENTO_INGRESOS."' , '".$ADJUNTO_INGRESOS."' , '".$OBSERVACIONES_INGRESOS."' , '".$FECHA_INGRESOS."' , '".$hPAGOSINGRESOS1."' , '".$session."' ); ";		
			
			
	    if($enviarpagosingre=='enviarpagosingre'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}
	
		
	public function Listado_pagosingresos(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04pagosingresos WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}

	
		public function Listado_pagosingresos2($id){
		$conn = $this->db();
		$variablequery = "select * from 04pagosingresos  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	

	public function borra_PAGOSINGRESOS($id){
		$conn = $this->db();
		$variablequery = "delete from 04pagosingresos where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}


			 
	public function actualizapagoingreso($pasarpagadoingreso_id , $pasarpagadoingreso_text ){

		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){
			
		 $var1 = "update 04pagosingresos set pagado = '".$pasarpagadoingreso_text."' where id = '".$pasarpagadoingreso_id."' ;  ";
		 
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";

	}else{
		echo "TU SESIÓN HA TERMINADO";	
	}
	}
	
	 
	public function total_ingreso_pagado(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select sum(OBSERVACIONES_INGRESOS) as totalpagado from 04pagosingresos WHERE idRelacion = '".$session."' and pagado = 'si' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery);
		return $row['totalpagado'];
		
	}
	
  ///////////////////////////// PAGOS EGRESOS/////////////////////////

        public function pagoegreso( $DOCUMENTO_EGRESO , $ADJUNTO_EGRESO, $MONTO_EGRESO, $FECHA_EGRESO , $hpagosegresos1, $IpEGRESOS,$enviarpagosEgreso ){
		$MONTO_EGRESO = str_replace(',','',$MONTO_EGRESO);
		//enviarpagosEgreso
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){                            
			
		 $var1 = "update 04pagoegresos  set
		 DOCUMENTO_EGRESO = '".$DOCUMENTO_EGRESO."' ,
		 MONTO_EGRESO = '".$MONTO_EGRESO."' ,
		 hpagosegresos1 = '".$hpagosegresos1."'
		 where id = '".$IpEGRESOS."' ;  ";
	
		 $var2 = "insert into 04pagoegresos  (DOCUMENTO_EGRESO,ADJUNTO_EGRESO, MONTO_EGRESO, FECHA_EGRESO, hpagosegresos1, idRelacion) values ( '".$DOCUMENTO_EGRESO."' , '".$ADJUNTO_EGRESO."' , '".$MONTO_EGRESO."' , '".$FECHA_EGRESO."' , '".$hpagosegresos1."' , '".$session."' ); ";		
			
			
	    if($enviarpagosEgreso=='enviarpagosEgreso'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}
	
		
	public function Listado_pagoegresos(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04pagoegresos WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	
		public function Listado_pagoegresos2($id){
		$conn = $this->db();
		$variablequery = "select * from 04pagoegresos  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	

	public function borra_PAGOEGRESOS($id){
		$conn = $this->db();
		$variablequery = "delete from 04pagoegresos where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}
                     
					 
					 
	public function actualizapagoegreso($pasarpagadoingreso_id , $pasarpagadoingreso_text ){

		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){
			
		 $var1 = "update 04pagoegresos set pagado = '".$pasarpagadoingreso_text."' where id = '".$pasarpagadoingreso_id."' ;  ";
		 
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";

	}else{
		echo "TU SESIÓN HA TERMINADO";	
	}
	}
					 
					 
	public function total_egreso_pagado(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select sum(MONTO_EGRESO) as totalpagado from 04pagoegresos WHERE idRelacion = '".$session."' and pagado = 'si' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery);
		return $row['totalpagado'];
		
	}
					 
		
  ///////////////////////////// BOLETOS AVION/////////////////////////

        public function boletosavion($DOCUMENTO_BOLETOSAVION ,$ADJUNTO_BOLETOSAVION, $MONTO_BOLETOSAVION ,$FECHA_BOLETOSAVION , $hBOLETOSAVION1  ,$hpagosegresos1, $Ipboletosavion,$enviarboletos){
			
		$MONTO_BOLETOSAVION = str_replace(',','',$MONTO_BOLETOSAVION);
		
		//Ipboletosavion
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){                            
			
		 $var1 = "update 04boletosavion set
		 DOCUMENTO_BOLETOSAVION = '".$DOCUMENTO_BOLETOSAVION."'  ,
		 MONTO_BOLETOSAVION = '".$MONTO_BOLETOSAVION."'
		 
		 where id = '".$Ipboletosavion."' ;  ";
	
		 $var2 = "insert into 04boletosavion (DOCUMENTO_BOLETOSAVION,ADJUNTO_BOLETOSAVION, MONTO_BOLETOSAVION, FECHA_BOLETOSAVION, hBOLETOSAVION1, idRelacion) values ( '".$DOCUMENTO_BOLETOSAVION."' , '".$ADJUNTO_BOLETOSAVION."' , '".$MONTO_BOLETOSAVION."' , '".$FECHA_BOLETOSAVION."' , '".$hBOLETOSAVION1."' , '".$session."' ); ";		
			
			
	    if($enviarboletos=='enviarboletos'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}
	
		
	public function Listado_boletosavion(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04boletosavion WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	
		public function Listado_boletosavion2($id){
		$conn = $this->db();
		$variablequery = "select * from 04boletosavion  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	

	public function borra_BOLETOSAVION($id){
		$conn = $this->db();
		$variablequery = "delete from 04boletosavion where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}

	
	public function PASARPAGADOavion($pasarpagadoingreso_id , $pasarpagadoingreso_text ){

		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){
			
		 $var1 = "update 04boletosavion set pagado = '".$pasarpagadoingreso_text."' where id = '".$pasarpagadoingreso_id."' ;  ";
		 
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";

	}else{
		echo "TU SESIÓN HA TERMINADO";	
	}
	}
	
	public function total_boletosavion_pagado(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select sum(MONTO_BOLETOSAVION) as totalpagado from 04boletosavion WHERE idRelacion = '".$session."' and pagado = 'si' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery);
		return $row['totalpagado'];
		
	}
	
	
/*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*//*resumen ingreso egreso*/

	public function resumeningresos(){
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		$variablequery = "select * from 04pagosingresos where idRelacion = '".$session."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);

	}

	public function resumenegresos(){
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		$variablequery = "select * from 04pagoegresos where idRelacion = '".$session."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}


	public function resumenboletosavion(){
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		$variablequery = "select * from 04boletosavion where idRelacion = '".$session."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
		
	
	
	





//////////////////  COTIZACIÓN DEL PROVEEDOR ///////////////////////////////////////////////

public function COTIPRO($NOMBRE_PROVEEDOR,$DOCUMENTO_COTIPRO ,$ADJUNTO_COTIPRO, $OBSERVACIONES_COTIPRO , $FECHA_COTIPRO , $hCOTIPRO,$IpCOTIPRO,$enviarCOTIPRO){
	  
	$conn = $this->db();
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
	if($session != ''){                            
		
	 $var1 = "update 04cotizacionproveedores  set
	 
	 NOMBRE_PROVEEDOR= '".$NOMBRE_PROVEEDOR."' ,
	 DOCUMENTO_COTIPRO= '".$DOCUMENTO_COTIPRO."' , 
	 OBSERVACIONES_COTIPRO = '".$OBSERVACIONES_COTIPRO."' ,  
	 hCOTIPRO = '".$hCOTIPRO."'
	 where id = '".$IpCOTIPRO."' ;  ";

	 $var2 = "insert into 04cotizacionproveedores (NOMBRE_PROVEEDOR, DOCUMENTO_COTIPRO,ADJUNTO_COTIPRO, OBSERVACIONES_COTIPRO, FECHA_COTIPRO, hCOTIPRO, idRelacion) values ( '".$NOMBRE_PROVEEDOR."' ,'".$DOCUMENTO_COTIPRO."' , '".$ADJUNTO_COTIPRO."' , '".$OBSERVACIONES_COTIPRO."' , '".$FECHA_COTIPRO."' , '".$hCOTIPRO."' , '".$session."' ); ";		
		
		if($enviarCOTIPRO=='enviarCOTIPRO'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
}

	
public function Listado_COTIPRO(){
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
	
	$conn = $this->db();
	$variablequery = "select * from 04cotizacionproveedores WHERE idRelacion = '".$session."' order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_COTIPRO2($id){
	$conn = $this->db();
	$variablequery = "select * from 04cotizacionproveedores  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}


public function borra_COTIPRO($id){
	$conn = $this->db();
	$variablequery = "delete from 04cotizacionproveedores where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
}
	

	///////////////////////////// PERSONAL2 2  /////////////////////////

    public function PERSONAL2($NOMBRE_PERSONAL2 ,$PUESTO_PERSONAL2 ,$WHAT_PERSONAL2 , $EMAIL_PERSONAL2 ,$FECHA_INICIO1,$FECHA_FINAL1,$NUMERO_DIAS1, $MONTO_BONO1,$MONTO_BONO_TOTAL1,$TOTAL1,$ULTIMO_DIA1, $VIATICOS_PERSONAL2 , $OBSERVACIONES_PERSONAL2 , $PERSONAL2_FECHA_ULTIMA_CARGA , $hDatosPERSONAL2,$ENVIARpersonal2,$IPpersonal2){
		
    $conn = $this->db();
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
	if($session != ''){                            
    $MONTO_BONO_TOTAL1 = str_replace(',','',$MONTO_BONO_TOTAL1);
    $MONTO_BONO_TOTAL1 = str_replace('$','',$MONTO_BONO_TOTAL1);

    $VIATICOS_PERSONAL2 = str_replace(',','',$VIATICOS_PERSONAL2);
    $VIATICOS_PERSONAL2 = str_replace('$','',$VIATICOS_PERSONAL2);	

    $TOTAL1 = str_replace(',','',$TOTAL1);
    $TOTAL1 = str_replace('$','',$TOTAL1);		                           
    
    $var1 = "update 04personal2  set

     NOMBRE_PERSONAL2 = '".$NOMBRE_PERSONAL2."' , 
    PUESTO_PERSONAL2 = '".$PUESTO_PERSONAL2."' , 
    WHAT_PERSONAL2 = '".$WHAT_PERSONAL2."' , 
    EMAIL_PERSONAL2 = '".$EMAIL_PERSONAL2."' , 
 
    FECHA_INICIO1 = '".$FECHA_INICIO1."' , 
    FECHA_FINAL1 = '".$FECHA_FINAL1."' , 
    NUMERO_DIAS1 = '".$NUMERO_DIAS1."' , 
    MONTO_BONO1 = '".$MONTO_BONO1."' , 
    MONTO_BONO_TOTAL1 = '".$MONTO_BONO_TOTAL1."' , 
    TOTAL1 = '".$TOTAL1."' , 
    ULTIMO_DIA1 = '".$ULTIMO_DIA1."' , 
 
    VIATICOS_PERSONAL2 = '".$VIATICOS_PERSONAL2."' , 
    OBSERVACIONES_PERSONAL2 = '".$OBSERVACIONES_PERSONAL2."' ,
    hDatosPERSONAL2 = '".$hDatosPERSONAL2."'
    where id = '".$IPpersonal2."' ;  ";

    $var2 = "insert into 04personal2 (NOMBRE_PERSONAL2, PUESTO_PERSONAL2, WHAT_PERSONAL2, EMAIL_PERSONAL2,FECHA_INICIO1,FECHA_FINAL1,NUMERO_DIAS1,MONTO_BONO1, MONTO_BONO_TOTAL1, TOTAL1, ULTIMO_DIA1,
    VIATICOS_PERSONAL2, OBSERVACIONES_PERSONAL2, PERSONAL2_FECHA_ULTIMA_CARGA, hDatosPERSONAL2, idRelacion) values ( '".$NOMBRE_PERSONAL2."' , '".$PUESTO_PERSONAL2."' , '".$WHAT_PERSONAL2."' , '".$EMAIL_PERSONAL2."' , '".$FECHA_INICIO1."' , '".$FECHA_FINAL1."' , '".$NUMERO_DIAS1."' , '".$MONTO_BONO1."' , '".$MONTO_BONO_TOTAL1."' , '".$TOTAL1."' , '".$ULTIMO_DIA1."' , '".$VIATICOS_PERSONAL2."' , '".$OBSERVACIONES_PERSONAL2."' , '".$PERSONAL2_FECHA_ULTIMA_CARGA."' , '".$hDatosPERSONAL2."' , '".$session."' ); ";		
    
     if($ENVIARpersonal2=='ENVIARpersonal2'){
     mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
     return "Actualizado";
            
}   else{
    mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
    return "Ingresado";
}
    
}   else{
    echo "TU SESIÓN HA TERMINADO";	
}

}


     public function listado_personal3(){
     $session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';

     $conn = $this->db();
     $variablequery = "select * from 04personal2 WHERE idRelacion = '".$session."' order by id desc ";
     return $arrayquery = mysqli_query($conn,$variablequery);
     }	


     public function listado_personal22($id){
     $conn = $this->db();
      $variablequery = "select * from 04personal2  where id = '".$id."' ";
     return $arrayquery = mysqli_query($conn,$variablequery);
     }


     public function borra_PERSONAL2($id){
     $conn = $this->db();
     $variablequery = "delete from 04personal2 where id = '".$id."' ";
     $arrayquery = mysqli_query($conn,$variablequery);
     RETURN 

     "<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
     }
	
	
	
	
	
	
	
	
  ///////////////////////////// PERSONAL  /////////////////////////

        public function PERSONAL($NOMBRE_PERSONAL ,$PUESTO_PERSONAL ,$WHAT_PERSONAL , $EMAIL_PERSONAL ,$FECHA_INICIO,$FECHA_FINAL,$NUMERO_DIAS, $MONTO_BONO,$MONTO_BONO_TOTAL,$VIATICOS_PERSONAL ,$TOTAL,$ULTIMO_DIA, $OBSERVACIONES_PERSONAL , $PERSONAL_FECHA_ULTIMA_CARGA , $hDatosPERSONAL,$ENVIARpersonal,$IPpersonal){
		
		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){                            
			
		 $var1 = "update 04personal  set
         NOMBRE_PERSONAL = '".$NOMBRE_PERSONAL."' , 
		 PUESTO_PERSONAL = '".$PUESTO_PERSONAL."' , 
		 WHAT_PERSONAL = '".$WHAT_PERSONAL."' , 
		 EMAIL_PERSONAL = '".$EMAIL_PERSONAL."' ,
         FECHA_INICIO = '".$FECHA_INICIO."' , 
         FECHA_FINAL = '".$FECHA_FINAL."' , 
         NUMERO_DIAS = '".$NUMERO_DIAS."' , 
         MONTO_BONO = '".$MONTO_BONO."' , 
         MONTO_BONO_TOTAL = '".$MONTO_BONO_TOTAL."' ,
         VIATICOS_PERSONAL = '".$VIATICOS_PERSONAL."' ,		 
         TOTAL = '".$TOTAL."' , 
         ULTIMO_DIA = '".$ULTIMO_DIA."' , 		 
		 OBSERVACIONES_PERSONAL = '".$OBSERVACIONES_PERSONAL."' ,
		 PERSONAL_FECHA_ULTIMA_CARGA = '".$PERSONAL_FECHA_ULTIMA_CARGA."' ,
		 hDatosPERSONAL = '".$hDatosPERSONAL."'
		 where id = '".$IPpersonal."' ;  ";
	
		 $var2 = "insert into 04personal (NOMBRE_PERSONAL, PUESTO_PERSONAL, WHAT_PERSONAL, EMAIL_PERSONAL,FECHA_INICIO,FECHA_FINAL,NUMERO_DIAS,MONTO_BONO,MONTO_BONO_TOTAL,VIATICOS_PERSONAL,TOTAL,ULTIMO_DIA,  OBSERVACIONES_PERSONAL, PERSONAL_FECHA_ULTIMA_CARGA, hDatosPERSONAL, idRelacion) values ( '".$NOMBRE_PERSONAL."' , '".$PUESTO_PERSONAL."' , '".$WHAT_PERSONAL."' , '".$EMAIL_PERSONAL."' , '".$FECHA_INICIO."' , '".$FECHA_FINAL."' , '".$NUMERO_DIAS."' , '".$MONTO_BONO."' , '".$MONTO_BONO_TOTAL."' , '".$VIATICOS_PERSONAL."' , '".$TOTAL."' , '".$ULTIMO_DIA."' , '".$OBSERVACIONES_PERSONAL."' , '".$PERSONAL_FECHA_ULTIMA_CARGA."' , '".$hDatosPERSONAL."' , '".$session."' ); ";		
			
	    if($ENVIARpersonal=='ENVIARpersonal'){
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";
					
		}else{
		mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
		return "Ingresado";
		}
			
        }else{
		echo "TU SESIÓN HA TERMINADO";	
		}
		
	}
	
		
	public function listado_personal(){
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
		
		$conn = $this->db();
		$variablequery = "select * from 04personal WHERE idRelacion = '".$session."' order by id desc ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}	

	
		public function listado_personal2($id){
		$conn = $this->db();
		$variablequery = "select * from 04personal  where id = '".$id."' ";
		return $arrayquery = mysqli_query($conn,$variablequery);
	}
	
	
	    public function borra_PERSONAL($id){
		$conn = $this->db();
		$variablequery = "delete from 04personal where id = '".$id."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		RETURN 
		
		"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
	}

	
	

	
     

	public function variable_comborelacion1a(){
		$session = isset($_SESSION['id'])?$_SESSION['id']:'';		
		
		$conn = $this->db();				
		$variablequery = "select * from 02empresarelacion where idRelacionP = '".$session."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery);
		if($row['idRelacionC']>=1){
		return $row['idRelacionC'];
		}else{
		return "no";			
		}
		
		}

	public function variables_informacionfiscal_logo(){
		$conn = $this->db();
		$variablequery = "select ADJUNTAR_LOGO_INFORMACION from 03docs_info_fiscal where idRelacion = '".$_SESSION['idlc']."' ";
		$arrayquery = mysqli_query($conn,$variablequery);
		$row = mysqli_fetch_array($arrayquery, MYSQLI_ASSOC);
		return $row['ADJUNTAR_LOGO_INFORMACION'];
		
	}
	
      public function actualizapersonal2($pasara1_personal2_id , $pasapersonal2_text ){

      $conn = $this->db();
      $session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
      if($session != ''){
    
      $var1 = "update 04personal2 set autoriza  = '".$pasapersonal2_text."' where id = '".$pasara1_personal2_id."' ;  ";
 
      mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
      return "Actualizado";

     }else{
     echo "TU SESIÓN HA TERMINADO";	
    }
    }
	
	public function actualizapersonal($pasara1_personal_id , $pasapersonal_text ){

		$conn = $this->db();
		$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
		if($session != ''){
			
		 $var1 = "update 04personal set autoriza  = '".$pasapersonal_text."' where id = '".$pasara1_personal_id."' ;  ";
		 
		mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
		return "Actualizado";

	}else{
		echo "TU SESIÓN HA TERMINADO";	
	}
	}	
	

    
//////////////////  vehiculos eventos ///////////////////////////////////////////////

    public function VEHICULO($VEHICULOSEVE_VEHICULO , $VEHICULOSEVE_CANTIDAD , $VEHICULOSEVE_ENTREGA ,$VEHICULOSEVE_FOTO, $VEHICULOSEVE_LUGAR , $VEHICULOSEVE_HORA , $VEHICULOSEVE_DEVOLU , $VEHICULOSEVE_LUDEVO , $VEHICULOSEVE_HORADEVO , $VEHICULOSEVE_SOLICITUD , $VEHICULOSEVE_DIAS , $VEHICULOSEVE_COSTO , $VEHICULOSEVE_IVA, $VEHICULOSEVE_SUB , $PRECIOPESOS_SOFTWARE , $VEHICULOSEVE_OBSERVA , $HVEHICULOSEVE,$enviarVEHICULOSEVE,$IpVEHICULOSEVE){
	  
	$conn = $this->db();
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
	if($session != ''){                            
		
	 $var1 = "update 04vehiculoevento  set
	 
VEHICULOSEVE_VEHICULO = '".$VEHICULOSEVE_VEHICULO."' , VEHICULOSEVE_CANTIDAD = '".$VEHICULOSEVE_CANTIDAD."' , VEHICULOSEVE_FOTO = '".$VEHICULOSEVE_FOTO."' , VEHICULOSEVE_ENTREGA = '".$VEHICULOSEVE_ENTREGA."' , VEHICULOSEVE_LUGAR = '".$VEHICULOSEVE_LUGAR."' , VEHICULOSEVE_HORA = '".$VEHICULOSEVE_HORA."' , VEHICULOSEVE_DEVOLU = '".$VEHICULOSEVE_DEVOLU."' , VEHICULOSEVE_LUDEVO = '".$VEHICULOSEVE_LUDEVO."' , VEHICULOSEVE_HORADEVO = '".$VEHICULOSEVE_HORADEVO."' , VEHICULOSEVE_SOLICITUD = '".$VEHICULOSEVE_SOLICITUD."' , VEHICULOSEVE_DIAS = '".$VEHICULOSEVE_DIAS."' , VEHICULOSEVE_COSTO = '".$VEHICULOSEVE_COSTO."' , VEHICULOSEVE_IVA = '".$VEHICULOSEVE_IVA."' , VEHICULOSEVE_SUB = '".$VEHICULOSEVE_SUB."' ,PRECIOPESOS_SOFTWARE = '".$PRECIOPESOS_SOFTWARE."' , VEHICULOSEVE_OBSERVA = '".$VEHICULOSEVE_OBSERVA."' , HVEHICULOSEVE = '".$HVEHICULOSEVE."'
	 where id = '".$IpVEHICULOSEVE."' ;  ";

	 $var2 = "insert into 04vehiculoevento (VEHICULOSEVE_VEHICULO, VEHICULOSEVE_CANTIDAD, VEHICULOSEVE_FOTO, VEHICULOSEVE_ENTREGA, VEHICULOSEVE_LUGAR, VEHICULOSEVE_HORA, VEHICULOSEVE_DEVOLU, VEHICULOSEVE_LUDEVO, VEHICULOSEVE_HORADEVO, VEHICULOSEVE_SOLICITUD, VEHICULOSEVE_DIAS, VEHICULOSEVE_COSTO, VEHICULOSEVE_IVA,VEHICULOSEVE_SUB, PRECIOPESOS_SOFTWARE, VEHICULOSEVE_OBSERVA, HVEHICULOSEVE, idRelacion) values ( '".$VEHICULOSEVE_VEHICULO."' , '".$VEHICULOSEVE_CANTIDAD."' , '".$VEHICULOSEVE_FOTO."' , '".$VEHICULOSEVE_ENTREGA."' , '".$VEHICULOSEVE_LUGAR."' , '".$VEHICULOSEVE_HORA."' , '".$VEHICULOSEVE_DEVOLU."' , '".$VEHICULOSEVE_LUDEVO."' , '".$VEHICULOSEVE_HORADEVO."' , '".$VEHICULOSEVE_SOLICITUD."' , '".$VEHICULOSEVE_DIAS."' , '".$VEHICULOSEVE_COSTO."' , '".$VEHICULOSEVE_IVA."' , '".$VEHICULOSEVE_SUB."' , '".$PRECIOPESOS_SOFTWARE."' , '".$VEHICULOSEVE_OBSERVA."' , '".$HVEHICULOSEVE."' , '".$session."' ); ";		
		
		if($enviarVEHICULOSEVE=='enviarVEHICULOSEVE'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
}

	
public function Listado_VEHICULOSEVE(){
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
	
	$conn = $this->db();
	$variablequery = "select * from 04vehiculoevento WHERE idRelacion = '".$session."' order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_VEHICULOSEVE2($id){
	$conn = $this->db();
	$variablequery = "select * from 04vehiculoevento  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}


public function borra_VEHICULOSEVE($id){
	$conn = $this->db();
	$variablequery = "delete from 04vehiculoevento where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
}




//////////////////  material y equipo eventos ///////////////////////////////////////////////

    public function material ($MATERIAL_EQUIPO , $MATERIAL_CANTIDAD , $MATERIAL_ENTREGA ,$MATERIAL_FOTO, $MATERIAL_LUGAR , $MATERIAL_HORA , $MATERIAL_DEVOLU , $MATERIAL_LUDEVO , $MATERIAL_HORADEVO , $MATERIAL_SOLICITUD , $MATERIAL_DIAS , $MATERIAL_COSTO , $MATERIAL_IVA, $MATERIAL_SUB , $MATERIAL_TOTAL , $MATERIAL_OBSERVA , $HMATERIAL,$enviarMATERIAL,$IpMATERIAL){
	  
	$conn = $this->db();
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
	if($session != ''){                            
		
	 $var1 = "update 04materialyequipo  set
	 
MATERIAL_EQUIPO = '".$MATERIAL_EQUIPO."' , MATERIAL_CANTIDAD = '".$MATERIAL_CANTIDAD."' , MATERIAL_FOTO = '".$MATERIAL_FOTO."' , MATERIAL_ENTREGA = '".$MATERIAL_ENTREGA."' , MATERIAL_LUGAR = '".$MATERIAL_LUGAR."' , MATERIAL_HORA = '".$MATERIAL_HORA."' , MATERIAL_DEVOLU = '".$MATERIAL_DEVOLU."' , MATERIAL_LUDEVO = '".$MATERIAL_LUDEVO."' , MATERIAL_HORADEVO = '".$MATERIAL_HORADEVO."' , MATERIAL_SOLICITUD = '".$MATERIAL_SOLICITUD."' , MATERIAL_DIAS = '".$MATERIAL_DIAS."' , MATERIAL_COSTO = '".$MATERIAL_COSTO."' , MATERIAL_IVA = '".$MATERIAL_IVA."' , MATERIAL_SUB = '".$MATERIAL_SUB."' ,MATERIAL_TOTAL = '".$MATERIAL_TOTAL."' , MATERIAL_OBSERVA = '".$MATERIAL_OBSERVA."' , HMATERIAL = '".$HMATERIAL."'
	 where id = '".$IpMATERIAL."' ;  ";

	 $var2 = "insert into 04materialyequipo (MATERIAL_EQUIPO, MATERIAL_CANTIDAD, MATERIAL_FOTO, MATERIAL_ENTREGA, MATERIAL_LUGAR, MATERIAL_HORA, MATERIAL_DEVOLU, MATERIAL_LUDEVO, MATERIAL_HORADEVO, MATERIAL_SOLICITUD, MATERIAL_DIAS, MATERIAL_COSTO, MATERIAL_IVA,MATERIAL_SUB, MATERIAL_TOTAL, MATERIAL_OBSERVA, HMATERIAL, idRelacion) values ( '".$MATERIAL_EQUIPO."' , '".$MATERIAL_CANTIDAD."' , '".$MATERIAL_FOTO."' , '".$MATERIAL_ENTREGA."' , '".$MATERIAL_LUGAR."' , '".$MATERIAL_HORA."' , '".$MATERIAL_DEVOLU."' , '".$MATERIAL_LUDEVO."' , '".$MATERIAL_HORADEVO."' , '".$MATERIAL_SOLICITUD."' , '".$MATERIAL_DIAS."' , '".$MATERIAL_COSTO."' , '".$MATERIAL_IVA."' , '".$MATERIAL_SUB."' , '".$MATERIAL_TOTAL."' , '".$MATERIAL_OBSERVA."' , '".$HMATERIAL."' , '".$session."' ); ";		
		
		if($enviarMATERIAL=='enviarMATERIAL'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
    }

	
    public function Listado_MATERIAL(){
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
	
	$conn = $this->db();
	$variablequery = "select * from 04materialyequipo WHERE idRelacion = '".$session."' order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_MATERIAL2($id){
	$conn = $this->db();
	$variablequery = "select * from 04materialyequipo  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}


    public function borra_MATERIAL($id){
	$conn = $this->db();
	$variablequery = "delete from 04materialyequipo where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
}

//////////////////  PAPELERIA ///////////////////////////////////////////////

    public function papeleria ($PAPELERIA_EQUIPO , $PAPELERIA_CANTIDAD , $PAPELERIA_ENTREGA ,$PAPELERIA_FOTO, $PAPELERIA_LUGAR , $PAPELERIA_HORA , $PAPELERIA_DEVOLU , $PAPELERIA_LUDEVO , $PAPELERIA_HORADEVO , $PAPELERIA_SOLICITUD , $PAPELERIA_DIAS , $PAPELERIA_COSTO , $PAPELERIA_IVA, $PAPELERIA_SUB , $PAPELERIA_TOTAL , $PAPELERIA_OBSERVA , $HPAPELERIA,$enviarPAPELERIA,$IpPAPELERIA){
	  
	$conn = $this->db();
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
	if($session != ''){                            
		
	 $var1 = "update 04papeleria  set
	 
PAPELERIA_EQUIPO = '".$PAPELERIA_EQUIPO."' , PAPELERIA_CANTIDAD = '".$PAPELERIA_CANTIDAD."' , PAPELERIA_FOTO = '".$PAPELERIA_FOTO."' , PAPELERIA_ENTREGA = '".$PAPELERIA_ENTREGA."' , PAPELERIA_LUGAR = '".$PAPELERIA_LUGAR."' , PAPELERIA_HORA = '".$PAPELERIA_HORA."' , PAPELERIA_DEVOLU = '".$PAPELERIA_DEVOLU."' , PAPELERIA_LUDEVO = '".$PAPELERIA_LUDEVO."' , PAPELERIA_HORADEVO = '".$PAPELERIA_HORADEVO."' , PAPELERIA_SOLICITUD = '".$PAPELERIA_SOLICITUD."' , PAPELERIA_DIAS = '".$PAPELERIA_DIAS."' , PAPELERIA_COSTO = '".$PAPELERIA_COSTO."' , PAPELERIA_IVA = '".$PAPELERIA_IVA."' , PAPELERIA_SUB = '".$PAPELERIA_SUB."' ,PAPELERIA_TOTAL = '".$PAPELERIA_TOTAL."' , PAPELERIA_OBSERVA = '".$PAPELERIA_OBSERVA."' , HPAPELERIA = '".$HPAPELERIA."'
	 where id = '".$IpPAPELERIA."' ;  ";

	 $var2 = "insert into 04papeleria (PAPELERIA_EQUIPO, PAPELERIA_CANTIDAD, PAPELERIA_FOTO, PAPELERIA_ENTREGA, PAPELERIA_LUGAR, PAPELERIA_HORA, PAPELERIA_DEVOLU, PAPELERIA_LUDEVO, PAPELERIA_HORADEVO, PAPELERIA_SOLICITUD, PAPELERIA_DIAS, PAPELERIA_COSTO, PAPELERIA_IVA,PAPELERIA_SUB, PAPELERIA_TOTAL, PAPELERIA_OBSERVA, HPAPELERIA, idRelacion) values ( '".$PAPELERIA_EQUIPO."' , '".$PAPELERIA_CANTIDAD."' , '".$PAPELERIA_FOTO."' , '".$PAPELERIA_ENTREGA."' , '".$PAPELERIA_LUGAR."' , '".$PAPELERIA_HORA."' , '".$PAPELERIA_DEVOLU."' , '".$PAPELERIA_LUDEVO."' , '".$PAPELERIA_HORADEVO."' , '".$PAPELERIA_SOLICITUD."' , '".$PAPELERIA_DIAS."' , '".$PAPELERIA_COSTO."' , '".$PAPELERIA_IVA."' , '".$PAPELERIA_SUB."' , '".$PAPELERIA_TOTAL."' , '".$PAPELERIA_OBSERVA."' , '".$HPAPELERIA."' , '".$session."' ); ";		
		
		if($enviarPAPELERIA=='enviarPAPELERIA'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
    }

	
    public function Listado_PAPELERIA(){
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
	
	$conn = $this->db();
	$variablequery = "select * from 04papeleria WHERE idRelacion = '".$session."' order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_PAPELERIA2($id){
	$conn = $this->db();
	$variablequery = "select * from 04papeleria  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}


    public function borra_PAPELERIA($id){
	$conn = $this->db();
	$variablequery = "delete from 04papeleria where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
}

//////////////////  OFICINA ///////////////////////////////////////////////

    public function oficina ($OFICINA_EQUIPO , $OFICINA_CANTIDAD , $OFICINA_ENTREGA ,$OFICINA_FOTO, $OFICINA_LUGAR , $OFICINA_HORA , $OFICINA_DEVOLU , $OFICINA_LUDEVO , $OFICINA_HORADEVO , $OFICINA_SOLICITUD , $OFICINA_DIAS , $OFICINA_COSTO , $OFICINA_IVA, $OFICINA_SUB , $OFICINA_TOTAL , $OFICINA_OBSERVA , $HOFICINA,$enviarOFICINA,$IpOFICINA){
	  
	$conn = $this->db();
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
	if($session != ''){                            
		
	 $var1 = "update 04oficina  set
	 
OFICINA_EQUIPO = '".$OFICINA_EQUIPO."' , OFICINA_CANTIDAD = '".$OFICINA_CANTIDAD."' , OFICINA_FOTO = '".$OFICINA_FOTO."' , OFICINA_ENTREGA = '".$OFICINA_ENTREGA."' , OFICINA_LUGAR = '".$OFICINA_LUGAR."' , OFICINA_HORA = '".$OFICINA_HORA."' , OFICINA_DEVOLU = '".$OFICINA_DEVOLU."' , OFICINA_LUDEVO = '".$OFICINA_LUDEVO."' , OFICINA_HORADEVO = '".$OFICINA_HORADEVO."' , OFICINA_SOLICITUD = '".$OFICINA_SOLICITUD."' , OFICINA_DIAS = '".$OFICINA_DIAS."' , OFICINA_COSTO = '".$OFICINA_COSTO."' , OFICINA_IVA = '".$OFICINA_IVA."' , OFICINA_SUB = '".$OFICINA_SUB."' ,OFICINA_TOTAL = '".$OFICINA_TOTAL."' , OFICINA_OBSERVA = '".$OFICINA_OBSERVA."' , HOFICINA = '".$HOFICINA."'
	 where id = '".$IpOFICINA."' ;  ";

	 $var2 = "insert into 04oficina (OFICINA_EQUIPO, OFICINA_CANTIDAD, OFICINA_FOTO, OFICINA_ENTREGA, OFICINA_LUGAR, OFICINA_HORA, OFICINA_DEVOLU, OFICINA_LUDEVO, OFICINA_HORADEVO, OFICINA_SOLICITUD, OFICINA_DIAS, OFICINA_COSTO, OFICINA_IVA,OFICINA_SUB, OFICINA_TOTAL, OFICINA_OBSERVA, HOFICINA, idRelacion) values ( '".$OFICINA_EQUIPO."' , '".$OFICINA_CANTIDAD."' , '".$OFICINA_FOTO."' , '".$OFICINA_ENTREGA."' , '".$OFICINA_LUGAR."' , '".$OFICINA_HORA."' , '".$OFICINA_DEVOLU."' , '".$OFICINA_LUDEVO."' , '".$OFICINA_HORADEVO."' , '".$OFICINA_SOLICITUD."' , '".$OFICINA_DIAS."' , '".$OFICINA_COSTO."' , '".$OFICINA_IVA."' , '".$OFICINA_SUB."' , '".$OFICINA_TOTAL."' , '".$OFICINA_OBSERVA."' , '".$HOFICINA."' , '".$session."' ); ";		
		
		if($enviarOFICINA=='enviarOFICINA'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
    }

	
    public function Listado_OFICINA(){
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
	
	$conn = $this->db();
	$variablequery = "select * from 04oficina WHERE idRelacion = '".$session."' order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_OFICINA2($id){
	$conn = $this->db();
	$variablequery = "select * from 04oficina  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}


    public function borra_OFICINA($id){
	$conn = $this->db();
	$variablequery = "delete from 04oficina where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
}




//////////////////  BOTIQUIN ///////////////////////////////////////////////

    public function botiquin ($BOTIQUIN_EQUIPO , $BOTIQUIN_CANTIDAD , $BOTIQUIN_ENTREGA ,$BOTIQUIN_FOTO, $BOTIQUIN_LUGAR , $BOTIQUIN_HORA , $BOTIQUIN_DEVOLU , $BOTIQUIN_LUDEVO , $BOTIQUIN_HORADEVO , $BOTIQUIN_SOLICITUD , $BOTIQUIN_DIAS , $BOTIQUIN_COSTO , $BOTIQUIN_IVA, $BOTIQUIN_SUB , $BOTIQUIN_TOTAL , $BOTIQUIN_OBSERVA , $HBOTIQUIN,$enviarBOTIQUIN,$IpBOTIQUIN){
	  
	$conn = $this->db();
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';  
	if($session != ''){                            
		
	 $var1 = "update 04botiquin  set
	 
BOTIQUIN_EQUIPO = '".$BOTIQUIN_EQUIPO."' , BOTIQUIN_CANTIDAD = '".$BOTIQUIN_CANTIDAD."' , BOTIQUIN_FOTO = '".$BOTIQUIN_FOTO."' , BOTIQUIN_ENTREGA = '".$BOTIQUIN_ENTREGA."' , BOTIQUIN_LUGAR = '".$BOTIQUIN_LUGAR."' , BOTIQUIN_HORA = '".$BOTIQUIN_HORA."' , BOTIQUIN_DEVOLU = '".$BOTIQUIN_DEVOLU."' , BOTIQUIN_LUDEVO = '".$BOTIQUIN_LUDEVO."' , BOTIQUIN_HORADEVO = '".$BOTIQUIN_HORADEVO."' , BOTIQUIN_SOLICITUD = '".$BOTIQUIN_SOLICITUD."' , BOTIQUIN_DIAS = '".$BOTIQUIN_DIAS."' , BOTIQUIN_COSTO = '".$BOTIQUIN_COSTO."' , BOTIQUIN_IVA = '".$BOTIQUIN_IVA."' , BOTIQUIN_SUB = '".$BOTIQUIN_SUB."' ,BOTIQUIN_TOTAL = '".$BOTIQUIN_TOTAL."' , BOTIQUIN_OBSERVA = '".$BOTIQUIN_OBSERVA."' , HBOTIQUIN = '".$HBOTIQUIN."'
	 where id = '".$IpBOTIQUIN."' ;  ";

	 $var2 = "insert into 04botiquin (BOTIQUIN_EQUIPO, BOTIQUIN_CANTIDAD, BOTIQUIN_FOTO, BOTIQUIN_ENTREGA, BOTIQUIN_LUGAR, BOTIQUIN_HORA, BOTIQUIN_DEVOLU, BOTIQUIN_LUDEVO, BOTIQUIN_HORADEVO, BOTIQUIN_SOLICITUD, BOTIQUIN_DIAS, BOTIQUIN_COSTO, BOTIQUIN_IVA,BOTIQUIN_SUB, BOTIQUIN_TOTAL, BOTIQUIN_OBSERVA, HBOTIQUIN, idRelacion) values ( '".$BOTIQUIN_EQUIPO."' , '".$BOTIQUIN_CANTIDAD."' , '".$BOTIQUIN_FOTO."' , '".$BOTIQUIN_ENTREGA."' , '".$BOTIQUIN_LUGAR."' , '".$BOTIQUIN_HORA."' , '".$BOTIQUIN_DEVOLU."' , '".$BOTIQUIN_LUDEVO."' , '".$BOTIQUIN_HORADEVO."' , '".$BOTIQUIN_SOLICITUD."' , '".$BOTIQUIN_DIAS."' , '".$BOTIQUIN_COSTO."' , '".$BOTIQUIN_IVA."' , '".$BOTIQUIN_SUB."' , '".$BOTIQUIN_TOTAL."' , '".$BOTIQUIN_OBSERVA."' , '".$HBOTIQUIN."' , '".$session."' ); ";		
		
		if($enviarBOTIQUIN=='enviarBOTIQUIN'){
	mysqli_query($conn,$var1) or die('P156'.mysqli_error($conn));
	return "Actualizado";
				
	}else{
	mysqli_query($conn,$var2) or die('P160'.mysqli_error($conn));
	return "Ingresado";
	}
		
	}else{
	echo "TU SESIÓN HA TERMINADO";	
	}
	
    }

	
    public function Listado_BOTIQUIN(){
	$session = isset($_SESSION['idevento'])?$_SESSION['idevento']:'';
	
	$conn = $this->db();
	$variablequery = "select * from 04botiquin WHERE idRelacion = '".$session."' order by id desc ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}	


	public function Listado_BOTIQUIN2($id){
	$conn = $this->db();
	$variablequery = "select * from 04botiquin  where id = '".$id."' ";
	return $arrayquery = mysqli_query($conn,$variablequery);
}


    public function borra_BOTIQUIN($id){
	$conn = $this->db();
	$variablequery = "delete from 04botiquin where id = '".$id."' ";
	$arrayquery = mysqli_query($conn,$variablequery);
	RETURN 
	
	"<P style='color:green; font-size:25px;'>ELEMENTO BORRADO</P>";
}






	
} 	 
	 
	 
?>