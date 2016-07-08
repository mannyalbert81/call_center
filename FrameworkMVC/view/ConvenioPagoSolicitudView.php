
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      <meta charset="utf-8"/>
        <title>Convenio Pago Solicitud- coactiva 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 		
 		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		<script>
		    webshims.setOptions('forms-ext', {types: 'date'});
			webshims.polyfill('forms forms-ext');
		</script>
		<style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
         
        <!-- AQUI NOTIFICAIONES -->
		<script type="text/javascript" src="view/css/lib/alertify.js"></script>
		<link rel="stylesheet" href="view/css/themes/alertify.core.css" />
		<link rel="stylesheet" href="view/css/themes/alertify.default.css" />
		
		
		
		<script>

		function Ok(){
				alertify.success("Has Pulsado en Generar"); 
				return false;
			}
			
			function Borrar(){
				alertify.success("Has Pulsado en Borrar"); 
				return false; 
			}

			function notificacion(){
				alertify.success("Has Pulsado en Aceptar"); 
				return false; 
			}
		</script>
		
		
		
		<!-- TERMINA NOTIFICAIONES -->
     	<script>
		$(document).ready(function(){

			$("#generar_cuotas").click(function(){

				var numero_cuotas = $("#numero_cuotas").val();
				var fecha_corte = $("#fecha_corte").val();

				if (numero_cuotas == "" )
		    	{
					$("#mensaje_numero_cuotas").text("Ingrese plazo");
		    		$("#mensaje_numero_cuotas").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
				if (fecha_corte == "" )
				{
					$("#mensaje_fecha_corte").text("Ingrese fecha corte");
		    		$("#mensaje_fecha_corte").fadeIn("slow"); //Muestra mensaje de error
		            return false;
				}


				});

			 $( "#numero_cuotas" ).focus(function() {
				 
				  $("#mensaje_numero_cuotas").fadeOut("slow");
				  return true;
			    });

			 $( "#fecha_corte" ).focus(function() {
				 
				  $("#mensaje_fecha_corte").fadeOut("slow");
				  return true;
			    });

	       
        });
		</script>
 

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       // variables para tabla de amortizacion
       
       $interes=null;
       $total=null;
       $porcentaje_capital=null;
       $total_capital=0;
       
       if(!empty($resultDatos)){
       	foreach ($resultDatos as $res){
       		$interes=0;
       		$total=$res['total'];
       		$porcentaje_capital=$res['porcentaje_capital'];
       		$total_capital=$res['total_capital'];
       	}
       }
       
       $fecha_actual=strtotime(Date("Y-m-d"));
       $hoy=Date("y-m-d");
       ?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
     
      <form action="<?php echo $helper->url("ConvenioPagoSolicitud","Index"); ?>" method="post" class="col-lg-12">
            
            <h4 style="color:#ec971f;">Convenio Pago Solicitud</h4>
   
            	<!-- elementos ocultos -->
            		<div class="col-lg-12">
           
        </div>
        <section class="col-lg-12 usuario" style="height:100px;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Juicio</b></th>
	    		<th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Nombres Clientes</th>
	    		<th style="color:#456789;font-size:80%;">Titulo Credito</th>
	    		<th style="color:#456789;font-size:80%;">Fecha Corte</th>
	    		<th style="color:#456789;font-size:80%;">Dias Mora</th>
	    		<th style="color:#456789;font-size:80%;">Total</th>
	    		
	    	</tr>    	           
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->id_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_corte; ?> 
		               <input type="hidden" id="fecha_emision" name="fecha_emision" value="<?php echo  $res->fecha_corte; ?>">    </td>
		               <td style="color:#000000;font-size:80%;"> <?php $fecha_ingreso=strtotime("$res->fecha_corte"); $diferencia=$fecha_actual-$fecha_ingreso; echo $diferencia/86400; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->total; ?>     </td>
		               <td><input type="hidden" id="total" name="total" value="<?php echo $res->total; ?>"></td>
		               
		               
		    </tr>
		    
		    
		        <?php } } ?>
            
           
            
       	</table>   
       	
       	  
      </section>
      
      
       <div class="col-lg-12 panel panel-default" >
       <div class="panel-body">
       <div class="col-xs-4 col-md-4">
      
       		<div class="col-xs-5 col-md-5" >
       		<div class="checkbox">
			<label class="formulario-subtitulo"><input type="checkbox" class="" id="por_capital_chk" name="por_capital_chk" value="">% Capital
			</label>
			</div>			
			</div>
     
     		<div class="col-xs-7 col-md-7">
			  	<input type="text" class="form-control" id="por_capital" name="por_capital" value="<?php echo $porcentaje_capital; ?>">			  
			</div>
			
			<div class="col-xs-12 col-md-12">
			  		  
			</div>
			
			
			<div class="col-xs-5 col-md-5">
			<div class="checkbox">
			<label class="formulario-subtitulo"><input type="checkbox" class="" id="valor_inicial_chk" name="valor_inicial_chk" value="">Valor Inicial
			
			</label>
			</div>
			</div>
				
			
           <div class="col-xs-7 col-md-7">
			  	<input type="text" class="form-control" id="valor_inicial" name="valor_inicial" value="">			  
			</div>
			
			<div class="col-xs-12 col-md-12">
			  		  
			</div>
			
			<div class="col-xs-5 col-md-5">
			  	<span class="formulario-subtitulo">Numero cuotas:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7">
			  	<input type="text" class="form-control" id="numero_cuotas" name="numero_cuotas" value="">
			  	<div id="mensaje_numero_cuotas" class="errores"></div>			  
			</div>
			
			<div class="col-xs-5 col-md-5">
			  	<span class="formulario-subtitulo">Fecha corte:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7">
			  	<input type="date" class="form-control" id="fecha_corte" name="fecha_corte" value="">
			  	<div id="mensaje_fecha_corte" class="errores"></div>			  
			</div>
			
		</div>
			
			
		<div class="col-xs-4 col-md-4">
			<div class="col-xs-2 col-md-2">
			<div class="checkbox">
			<label class="formulario-subtitulo"><input type="checkbox" class="" id="exoneracion" name="exoneracion" value="">
			Exoneracion
			</label>
			</div>			  		  
			</div>
			<div class="col-xs-12 col-md-12" style="margin-top: 20px;">
			  		  
			</div>
			<div class="col-xs-5 col-md-5">
			  	<span class="formulario-subtitulo">% Intereses:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7">
			  	<input type="text" class="form-control" id="interes" name="interes" value="">			  
			</div>
			
			<div class="col-xs-5 col-md-5">
			  	<span class="formulario-subtitulo">% Mora Coactiva:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7">
			  	<input type="text" class="form-control" id="mora_coactiva" name="mora_coactiva" value="">			  
			</div>
		</div>
		
		<div class="col-xs-4 col-md-4">
		  <div class="col-xs-12 col-md-12" style="text-align: center;" > 
          <span>Taza de Interes</span><br>
          <span>BC:</span><br>
          <span>0.812</span>
           </div>
         
			
			 <div class="col-xs-12 col-md-12" style="margin-top: 60px; margin-left: 60px;" > 
			
           <input type="submit" id="generar_cuotas" name="generar_cuotas" value="Generar Cuotas" onClick="Ok()" class="btn btn-default"/>
           </div>
          
        </div>
        
        </div>
        </div>
        
        <?php if(!empty($resultDatos)){	
        
  
 	?>
         
        
        <div class="col-lg-12 col-xs-6">
		
		<section class="col-lg-12 usuario" style=" min-height: 100px; 	max-height: 400px; overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Periodo</b></th>
	    		<th style="color:#456789;font-size:80%;">Fecha Vencimiento</th>
	    		<th style="color:#456789;font-size:80%;">Abono Capital</th>
	    		<th style="color:#456789;font-size:80%;">Interes</th>
	    		<th style="color:#456789;font-size:80%;">Capital+Interes</th>
	    		<th style="color:#456789;font-size:80%;">Saldo Capital</th>
	    		<th style="color:#456789;font-size:80%;">Saldo Honorarios</th>
	    		<th style="color:#456789;font-size:80%;">Otros Rubros</th>
	    		<th style="color:#456789;font-size:80%;">Cuota a Cancelar</th>
	    	</tr>
	    	
	      <?php if (!empty($resultAmortizacion)) {
	      	
	      	foreach ($resultAmortizacion['tabla'] as $res)	{
	      		
	       ?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['periodo']; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['fecha_vencimiento']; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['abono_capital'],2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['interes'],2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['capital_interes'],2); ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo abs(round($res[0]['saldo_capital'],2)); ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['saldo_honorarios'],2); ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo round($res[0]['otros'],2); ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res[0]['cuota']; ?>     </td>  
		               
		    </tr>
		    
		    
		    
		        <?php  } ?>
            
            
            
       	</table>  
       	
       	
       	  
      </section>
		
		</div>
	 <div class="col-lg-12 panel panel-default" style="margin-top:20px;" >
       <div class="panel-body">
       <div class="col-xs-4 col-md-4">
      
			<?php foreach ($resultAmortizacion['totales'] as $totales){?>
			<div class="col-xs-5 col-md-5">
			  	<span class="formulario-subtitulo">Total Capital:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7" >
			<span  id="total_capital"  class="form-control" ><?php echo round($totales['total_capital'],2); ?></span>		  
			</div>
			
			<div class="col-xs-5 col-md-5">
			  	<span class="formulario-subtitulo">Total Interes:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7" style="margin-top:5px;">
			<span  id="total_interes"  class="form-control" ><?php echo  round($totales['total_interes'],2); ?></span>
			</div>
			
			<div class="col-xs-5 col-md-5">
			  	<span class="formulario-subtitulo">Total Honorarios:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7" style="margin-top:5px;">
			<span  id="total_honorarios"  class="form-control" ><?php echo round($totales['total_honorarios'],2); ?></span>	
			</div>
			
			<div class="col-xs-5 col-md-5">
			  	<span class="formulario-subtitulo">Total Otros Rubros:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7" style="margin-top:5px;">
			<span  id="total_otros"  class="form-control" ><?php echo round($totales['total_otros'],2); ?></span>
			</div>
			<div class="col-xs-12 col-md-12" >
			</div>
			<div class="col-xs-5 col-md-5" style="margin-top:5px;">
			  	<span class="formulario-subtitulo">Total Convenio:</span>			  
			</div>
			
			<div class="col-xs-7 col-md-7" style="margin-top:5px;">
			<span  id="total_convenio"  class="form-control" ><?php echo round($totales['total_convenio'],2); ?></span>
			</div>
			
			<div class="col-xs-12 col-md-12" style="margin:50px auto;">
			 <input type="submit" id="aceptar" name="aceptar" value="Aceptar Convenio" onClick="notificacion()" class="btn btn-success"/>
			</div>
			
		</div>
		
		<?php }} ?>
		
		<div class="col-xs-8 col-md-8">
		
		<section class="col-lg-12 usuario" style="height:350px;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Rubros</b></th>
	    		<th style="color:#456789;font-size:80%;">Deuda</th>
	    		<th style="color:#456789;font-size:80%;">Interes Rebaja</th>
	    		<th style="color:#456789;font-size:80%;">% Rebaja de Interes</th>
	    		<th style="color:#456789;font-size:80%;">Cuota Inicial</th>
	    		<th style="color:#456789;font-size:80%;">Saldo</th>
	    	</tr>    	           
	            <?php if (!empty($resultRubros)) {
	            	
	            	
	            	foreach($resultRubros as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res['rubros']; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res['deuda']; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res['interes_rebaja']; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res['porc_rebaja']; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res['cuota_inicial']; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res['saldos']; ?>     </td> 
		               
		    		</tr>
		    
		    
		        <?php } } ?>
            
           
       	</table>   
       	
       	  
      </section>
		
		</div>
			
		
        </div>
        </div>
        
        <?php } ?>
        
        
            
          </form>  
     
       <!-- termina el form --> 
       
        
      </div>
      </div>
   </body>  

    </html>   