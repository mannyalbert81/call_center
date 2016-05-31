<?php

$base_url = "http://localhost:4000/FrameworkMVC/";



$identificacion_clientes						   = "";	  
$total                               			   = "";	
$juicio_referido_titulo_credito			   = ""; 
$nombres_clientes                             = ""; 
$nombre_ciudad                                 = ""; 
//require('view/fpdf/fpdf.php');

require_once('view/dompdf/dompdf_config.inc.php' );;

foreach($resultCliente as $res) 
{
	
	$identificacion_clientes						   =$res->identificacion_clientes;
	$total                               			   =$res->total;
	$juicio_referido_titulo_credito			           =$res->juicio_referido_titulo_credito;
	$nombres_clientes			                       =$res->nombres_clientes;
	$nombre_ciudad                                      =$res->nombre_ciudad;
	$creado                                             = date('Y-m-d ',strtotime($res->creado));
	
	
	
}



foreach($resultSecretario as $res)
{
	$id_impulsor				=$res->id_abogado;
	$nombre_impulsor			=$res->impulsadores;
	$id_secretario				=$res->id_secretario;
	$nombre_secretario			=$res->secretarios;
	
}
$logo_impulsore ="";
foreach($resultFirma_abogado as $res)
{
	$id_firma_abogado			=$res->id_firmas_digitales;
	$firma_abogado				=$res->imagen_firmas_digitales;
	
	$logo_impulsores 			= '<img src="'. $base_url.'view/DevuelveImagen.php?id_valor='.$id_firma_abogado.'&id_nombre=id_firmas_digitales&tabla=firmas_digitales&campo=imagen_firmas_digitales" width="120" height="80" />';
	
}

$logo_secretarios="";
foreach($resultFirma_secretario as $res)
{
	$id_firma_secretario			=$res->id_firmas_digitales;
	$firma_secretario				=$res->imagen_firmas_digitales;
	
	$logo_secretarios 				= '<img src="'. $base_url.'view/DevuelveImagen.php?id_valor='.$id_firma_secretario.'&id_nombre=id_firmas_digitales&tabla=firmas_digitales&campo=imagen_firmas_digitales" width="120" height="80" />';
	
}

$logo_liquidador ="";
foreach($resultLiquidador as $res)
{
	$id_usuarios                   =$res->id_usuarios;
	$nombre_liquidador             =$res->nombre_usuarios;
	$firma_liquidador             =$res->imagen_firmas_digitales;
	
	$logo_liquidador 				= '<img src="'. $base_url.'view/DevuelveImagen.php?id_valor='.$id_usuarios.'&id_nombre=id_usuarios&tabla=firmas_digitales&campo=imagen_firmas_digitales" width="120" height="80" />';
	
}
    



$html =
  '<html>'.
  '<head>'.
  	'<meta charset="utf-8"/>'.
  	'<title> '.'' .' BANCO DEL FOMENTO</title>'.
  	
  '</head>'.
  '<body>'.
  
'<div style=" position: absolute;  margin-left: 10%; width:80%;">'.
'<div style="border:1px solid;">'.

'<div style="margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: center;">'.
'<strong>'.'<font size=4>'. 'BANCO DEL FOMENTO EN LIQUIDACIÓN'. '<font>'.'</strong>'.
'</div>'.
'</div>'.

'<br>'.


'<div style="border:1px solid;">'.
'<div style="margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: center;">'.
'<strong>'.'<font size=2>'.  'JUZGADO DE COACTIVA'. '<font>' . '</strong>'.
'</div>'.

'<div style="margin-top:0px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: center;">'.
'<strong>'.'<font size=2>'. $nombre_ciudad . '<<font color="Gray"></font>>'. '</strong>'.
'</div>'.

'<div style="margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: center;">'.
'<strong>'.'<font size=2>'.  'JUICIO COACTIVO Nº  '.$juicio_referido_titulo_credito. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: center;">'.
'<strong>'.'<font size=2>'.  'CUERPO: 1ER CUERPO'. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'ACTOR: BANCO DEL FOMENTO EN LIQUIDACIÓN'. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'FECHA DE INICIO: ' .$creado. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'FECHA DE CITACIÓN: '. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'FORMA DE CITACIÓN: '. '<font>'. '</strong>'.
'</div>'.


'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: center;">'.
'<strong>'.'<font size=2>'.  '_______ PERSONAL    _______ POR TRES BOLETAS    ________ POR LA PRENSA '. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'DEMANDADO '. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'DEUDOR: '.$nombres_clientes. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'CI - RUC: '.$identificacion_clientes. '<font>'. '</strong>'.
'</div>'.


'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'GARANTE '. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'CI - RUC: '. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'CASILLA JUDICIAL:'. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'DEFENSOR: '. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'DE: '. '<font>'. '</strong>'.
'</div>'.

'<div style="margin-left:20px; margin-top:20px; color:#000000; font-family: sans-serif; font-size:75%; width:100%; text-align: left;">'.
'<strong>'.'<font size=2>'.  'CUANTIA INICIAL: USD$  '.$total. '<font>'. '</strong>'.
'</div>'.


'<div align="center" style= "margin-top:60px">'.
'<center>'.
'<table border="0"  width="100"  align="center">'.


'<tr>'.
'<td align="center">'.$logo_impulsores . '</td>'.
'<td align="center" style="color:#ffffff">'.'......'.'</td>'.
'<td align="center">'.$logo_liquidador . '</td>'.
'<td align="center" style="color:#ffffff">'.'......'.'</td>'.
'<td align="center">'.$logo_secretarios .'</td>'.
'</tr>'.
'<tr>'.
'<td align="center">'. '<strong>'.'<font size=2>'.  'IMPULSOR '. '<font>'. '</strong>'.'</td>'.
'<td align="center" style="color:#ffffff">'.'......'.'</td>'.
'<td align="center">'. '<strong>'.'<font size=2>'.  'LIQUIDADOR '. '<font>'. '</strong>'.'</td>'.
'<td align="center" style="color:#ffffff">'.'......'.'</td>'.
'<td align="center">'. '<strong>'.'<font size=2>'.  'SECRETARIO '. '<font>'. '</strong>'.'</td>'.
'</tr>'.
'<tr>'.
'<td align="center">'. '<strong>'.'<font size=2>'.'Ab. '. $nombre_impulsor. '<font>'. '</strong>'.'</td>'.
'<td align="center" style="color:#ffffff">'.'......'.'</td>'.
'<td align="center">'. '<strong>'.'<font size=2>'.'Dr. '. $nombre_liquidador . '<font>'. '</strong>'.'</td>'.
'<td align="center" style="color:#ffffff">'.'......'.'</td>'.
'<td align="center">'. '<strong>'.'<font size=2>'.'Ab. '. $nombre_secretario . '<font>'. '</strong>'.'</td>'.
'</tr>'.

'</table>'.
'</center>'.
'</div>'.

'<div align="center" style= "margin-top:120px">'.
'</div>'.


'</div>'.
'</div>'.
		
  
  '</body></html>' .
 
'<html>'.
'<head>'.
'<meta charset="utf-8"/>'.
'<title> '.'' .' BANCO DEL FOMENTO</title>'.
 
'</head>'.
'<body>'.


'<div >'.
'<p>'.
'

VISTOS: Del (los) título (s) de crédito No. (s) 0000030092 que por concepto de EMISIÓN Y
USO DE TARJETA DE CRÉDITO - CREDITO SI que ha (n) sido expedido (s) por el Banco
Territorial S.A. en Liquidación, y emitido (s) en fecha 15/11/2014 , de conformidad con la
(s) liquidación (es) que se manda (n) agregar a los autos aparece que CHACON SOLIS
OSCAR STALIN con C.I. 0801852476, adeuda (n) a esta Institución Bancaria en
Liquidación la suma de USD$ 2,362.86 ( DOS MIL TRESCIENTOS SESENTA y DOS 86/100
DOLARES DE LOS ESTADOS UNIDOS DE AMÉRICA), más los intereses, costas y gastos
judiciales que se generen hasta la fecha de pago total. Y siendo la obligación líquida,
determinada y de plazo vencido, en mi calidad de Liquidador del Banco Territorial S.A. en
Liquidación conforme la designación a mí extendida mediante Resolución No. SB-2014-
1059 emitida por el Ab. Pedro Solines Chacón en su calidad de Superintendente de
Bancos, dada en la Superintendencia de Bancos en Quito Distrito Metropolitano con fecha
02 de diciembre de 2014 debidamente inscrita en el Registro Mercantil del cantón
Guayaquil el 04 de diciembre de 2014, cuyo desglose ordeno dejando copias certificadas
en autos, y de conformidad con lo dispuesto en los Arts. 941, 945, 946. 948 y 951 del
Código de Procedimiento Civil, INICIO el presente juicio coactivo contra CHACON SOLIS
OSCAR STALIN, registrado con C.I. Nº 0801852476 ; y en consecuencia ORDENO que el
(los) deudor (es) pague (n) al Banco Territorial S.A. en Liquidación la cantidad adeudada,
más los intereses generados hasta la fecha y los que se generen hasta la total cancelación
de la deuda, intereses de mora, comisión, gastos judiciales, costas procesales, honorarios y
otros accesorios legales, o dimita bienes en el término perentorio de tres días, contados
desde que se cite con el auto de pago, apercibiéndole (s) que de no hacerlo se le
embargará bienes que aseguren la recuperación de todo lo adeudado, de conformidad con
lo dispuesto en el Art. 962 del Código de Procedimiento Civil, actúen en el presente juicio,
como secretario e impulsor respectivamente, el Ab. Jéssica Mavel Bravo Palacios y el(la)
Ab. Fabricio José Terán Dávila , quienes estando presentes aceptan los cargos conferidos y
juran desempeñarlos fiel y legalmente, firmando para constancia con el suscrito Juez de
Coactiva. Desglósese el (los) título (s) de crédito aparejado (s) a la coactiva, así como el
documento habilitante que acredita la calidad invocada, dejándose las copias certificadas
en autos, remitiéndose el original al departamento correspondiente para su respectiva
custodia. En lo principal, por disposición de lo prescrito en la parte final del inciso
primero del Art. 942 del Código de Procedimiento Civil, en concordancia con los Arts. 421
y 426 del Código Adjetivo Civil, díctanse las siguientes medidas cautelares: UNO) Al tenor
de lo dispuesto en los Arts. 6, 9 y 18 de la Ley del Sistema Nacional de Registro de Datos
Públicos, notifíquese a los señores Registradores de la Propiedad del (los) cantón (es)
Rumiñahui,Mejía,Pedro Vicente Maldonado,Pedro Moncayo,Puerto Quito,Cayambe,San
Miguel de los Bancos,Quito, para que remitan a este Juzgado un certificado actualizado de
bienes inmuebles que consten inscritos a nombre del (los) coactivado (s) debiéndose
señalar linderos, medidas, superficie, historia de dominio; y, se inscriba la Prohibición de
gravar y/o enajenar sobre los bienes inmuebles que el (los) coactivado (s) tenga inscritos
a su nombre en dichos Registros. Hecho, remítase a la Secretaría de este Juzgado ubicado
en la ciudad de Quito, José Luis Tamayo 935 y Foch, teléfono 026015479 ext. 5246; DOS)
		
		
'.
'</p>'

.		
 '</div>'.



'</body></html>';


$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("letter", "portrait");
$dompdf->render();

$dompdf->stream($identificacion_clientes .'.pdf',array('Attachment'=>0));

?>