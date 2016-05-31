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
		
		
	
  
  '</body></html>';
 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream($identificacion_clientes .'.pdf',array('Attachment'=>0));

?>