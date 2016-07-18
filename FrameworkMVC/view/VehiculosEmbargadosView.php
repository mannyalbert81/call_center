
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Tipo de Vehiculos Embargados- aDocument 2015</title>
        
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
		
            <!-- AQUI NOTIFICAIONES -->
		<script type="text/javascript" src="view/css/lib/alertify.js"></script>
		<link rel="stylesheet" href="view/css/themes/alertify.core.css" />
		<link rel="stylesheet" href="view/css/themes/alertify.default.css" />
		
		
		
		<script>

		function Ok(){
				alertify.success("Has Pulsado en Guardar"); 
				return false;
			}
			
			function Borrar(){
				alertify.success("Has Pulsado en Borrar"); 
				return false; 
			}

			function notificacion(){
				alertify.success("Has Pulsado en Buscar"); 
				return false; 
			}
		</script>
		
		
		
		<!-- TERMINA NOTIFICAIONES -->  
        	
        	
        
       <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
                
            
        </style>
         
         <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#Guardar").click(function() 
			{
		   
		    	var id_tipo_vehiculos= $("#id_tipo_vehiculos").val();
		    	var id_marca_vehiculos= $("#id_marca_vehiculos").val();
		    	var placa_vehiculos_embargados= $("#placa_vehiculos_embargados").val();
		    	var modelo_vehiculos_embargados= $("#placa_vehiculos_embargados").val();
		    	var observacion_vehiculos_embargados= $("#observacion_vehiculos_embargados").val();
		    	var observacion_vehiculos_embargados= $("#observacion_vehiculos_embargados").val();
		   				
		    	if (id_tipo_vehiculos== "")
		    	{
			    	
		    		$("#mensaje_tipo").text("Introduzca un tipo");
		    		$("#mensaje_tipo").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_tipo").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	if (id_marca_vehiculos== "")
		    	{
			    	
		    		$("#mensaje_marca").text("Introduzca una marca");
		    		$("#mensaje_marca").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_marca").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	if (placa_vehiculos_embargados== "")
		    	{
			    	
		    		$("#mensaje_placa").text("Introduzca una placa");
		    		$("#mensaje_placa").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_placa").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	if (modelo_vehiculos_embargados== "")
		    	{
			    	
		    		$("#mensaje_modelo").text("Introduzca un modelo");
		    		$("#mensaje_modelo").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_modelo").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	if (observacion_vehiculos_embargados== "")
		    	{
			    	
		    		$("#mensaje_observacion").text("Introduzca una observacion");
		    		$("#mensaje_observacion").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_observacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	if (fecha_ingreso_vehiculos_embargados== "")
		    	{
			    	
		    		$("#mensaje_fecha").text("Introduzca una fecha");
		    		$("#mensaje_fecha").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_fecha").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	
			}); 


		 
				
				$( "#id_tipo_vehiculos" ).focus(function() {
					$("#mensaje_tipo").fadeOut("slow");
    			});
				$( "#id_marca_vehiculos" ).focus(function() {
					$("#mensaje_marca").fadeOut("slow");
    			});
				$( "#placa_vehiculos_embargados" ).focus(function() {
					$("#mensaje_placa").fadeOut("slow");
    			});
				$( "#modelo_vehiculos_embargados" ).focus(function() {
					$("#mensaje_modelo").fadeOut("slow");
    			});
    			$( "#observacion_vehiculos_embargados" ).focus(function() {
					$("#mensaje_observacion").fadeOut("slow");
    			});
    			$( "#fecha_ingreso_vehiculos_embargados" ).focus(function() {
					$("#mensaje_fecha").fadeOut("slow");
    			});
						      
				    
		}); 

	</script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
       
       
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
     
      <form action="<?php echo $helper->url("VehiculosEmbargados","InsertaVehiculosEmbargados"); ?>" method="post" class="col-lg-12">
            <h4 style="color:#ec971f;">Insertar Vehiculos Embargados</h4>
   
            	
            		<div class="col-lg-12">
     
           
        </div>
        <section class="col-lg-12 usuario" style="height:100px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Juicio</b></th>
	    		<th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Nombres Clientes</th>
	    		<th style="color:#456789;font-size:80%;">Titulo Credito</th>
	    		    	           
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->id_titulo_credito; ?>     </td> 
		              
		           	   
		    		
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	      
	       <div class="row">
	          
			    <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Tipo Vehiculos</p>
			  	<select name="id_tipo_vehiculos" id="id_tipo_vehiculos"  class="form-control" >
					<?php foreach($resultTipoVehiculos as $resTipoVehiculos) {?>
						<option value="<?php echo $resTipoVehiculos->id_tipo_vehiculos; ?>" <?php if ($resTipoVehiculos->id_tipo_vehiculos == $resEdit->id_tipo_vehiculos)  echo  ' selected="selected" '  ;  ?> ><?php echo $resTipoVehiculos->nombre_tipo_vehiculos; ?> </option><?php } ?>
				</select> 			  
			  </div>
		
		<div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Marca</p>
			  	<select name="id_marca_vehiculos" id="id_marca_vehiculos"  class="form-control">
					<?php foreach($resultMarcaVehiculos as $resMarcaVehiculos) {?>
						<option value="<?php echo $resMarcaVehiculos->id_marca_vehiculos; ?>"  <?php if ($resMarcaVehiculos->id_marca_vehiculos == $resEdit->id_marca_vehiculos ) echo ' selected="selected" '  ; ?> ><?php echo $resMarcaVehiculos->nombre_marca_vehiculos; ?> </option><?php } ?>
				</select> 			  
			  </div>
			 
			  </div>
			  <div class="row">
		    <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Placa</p>
			  	<input type="text"  name="placa_vehiculos_embargados" id="placa_vehiculos_embargados" value="<?php echo $resEdit->placa_vehiculos_embargados; ?>" class="form-control"/> 
			    <div id="mensaje_placa" class="errores"></div>
			  </div>
			
			 
			
		    <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Modelo</p>
			  	<input type="text"  name="modelo_vehiculos_embargados" id="modelo_vehiculos_embargados" value="<?php echo $resEdit->modelo_vehiculos_embargados; ?>" class="form-control"/> 
			    <div id="mensaje_modelo" class="errores"></div>
			  </div>
			   </div>
			 
		    
		    <div class="row">
			  <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Observaciones</p>
			  	<input type="text" name="observacion_vehiculos_embargados" id="observacion_vehiculos_embargados" value="<?php echo $resEdit->observacion_vehiculos_embargados; ?>" class="form-control"/> 
			  <div id="mensaje_observacion" class="errores"></div>
			  </div>
		  
		   <div class="col-lg-3" id="div_desde">
      		<span>Fecha:</span>
           <input type="date"  name="fecha_ingreso_vehiculos_embargados" id="fecha_ingreso_vehiculos_embargados" value="" class="form-control"/>
           <div id="mensaje_desde" class="errores"></div>
           </div>
	     	  </div>
	     	<hr>
	            	  
            
		     <?php } } 
		     else {?>
		    
		       
		    
		    
		<div class="row">
		
		       <div class="col-xs-3 col-md-3" >
			  	
			  	 			  
			  </div>
			  
			    <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Tipo Vehiculos</p>
			  	<select name="id_tipo_vehiculos" id="id_tipo_vehiculos"  class="form-control" >
					<?php foreach($resultTipoVehiculos as $resTipoVehiculos) {?>
						<option value="<?php echo $resTipoVehiculos->id_tipo_vehiculos; ?>" ><?php echo $resTipoVehiculos->nombre_tipo_vehiculos; ?> </option><?php } ?>
				</select> 			  
			  </div>
		
		<div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Marca</p>
			  	<select name="id_marca_vehiculos" id="id_marca_vehiculos"  class="form-control" >
					<?php foreach($resultMarcaVehiculos as $resMarcaVehiculos) {?>
						<option value="<?php echo $resMarcaVehiculos->id_marca_vehiculos; ?>" ><?php echo $resMarcaVehiculos->nombre_marca_vehiculos; ?> </option><?php } ?>
				</select> 			  
			  </div>
			  </div>
			   <div class="row">
			    <div class="col-xs-3 col-md-3" >
			  	
			  	 			  
			  </div>
		    <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Placa</p>
			  	<input type="hidden"  name="id_clientes" id="id_clientes" value="<?php echo $id_clientes;?>" class="form-control"/>
			  	<input type="hidden"  name="id_titulo_credito" id="id_titulo_credito" value="<?php echo $id_titulo_credito;?>" class="form-control"/>
			  	<input type="text"  name="placa_vehiculos_embargados" id="placa_vehiculos_embargados" class="form-control"/> 
			    <div id="mensaje_cedula" class="errores"></div>
			  </div>
			
			 
			
		    <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Modelo</p>
			  	<input type="text"  name="modelo_vehiculos_embargados" id="modelo_vehiculos_embargados" class="form-control"/> 
			    <div id="mensaje_cedula" class="errores"></div>
			  </div>
			   </div>
			
		    
		     <div class="row">
		      <div class="col-xs-3 col-md-3" >
			  	
			  	 			  
			  </div>
			  <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Observaciones</p>
			  	<input type="text" name="observacion_vehiculos_embargados" id="observacion_vehiculos_embargados" class="form-control"/> 
			  <div id="mensaje_nombres" class="errores"></div>
			  </div>
		  
		   <div class="col-xs-3 col-md-3" id="div_desde">
      		<p  class="formulario-subtitulo" >Fecha:</p>
           <input type="date"  name="fecha_ingreso_vehiculos_embargados" id="fecha_ingreso_vehiculos_embargados" value="" class="form-control"/>
           <div id="mensaje_desde" class="errores"></div>
           </div>
             </div>
			
			<hr>
			
			
		     <?php } ?>
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" > 
           <input type="submit" id="Guardar" name="Guardar" value="Guardar" onClick="Ok()" class="btn btn-success"/>
           </div>
            </div>
            
          </form>  
     
       <!-- termina el form --> 
       
        
      </div>
      </div>
   </body>  

    </html>   