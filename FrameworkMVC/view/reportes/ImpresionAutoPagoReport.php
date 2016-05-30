<?php

$base_url = "http://186.71.249.121:4000/Vademano/";



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
'<strong>'.'<font size=2>'. $nombre_ciudad . '<font>'. '</strong>'.
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
'<strong>'.'<font size=2>'.  'FECHA DE INICIO: 2016-05-26'. '<font>'. '</strong>'.
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












'</div>'.
'</div>'.
		
		
	
  
  '</body></html>';
 
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream($identificacion_clientes .'.pdf',array('Attachment'=>0));

?>