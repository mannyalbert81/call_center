
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
		   
		    	var observaciones_vehiculos_embargados= $("#observaciones_vehiculos_embargados").val();
		    
		   				
		    	if (nombre_vehiculos_embargados== "")
		    	{
			    	
		    		$("#mensaje_nombres").text("Introduzca un tipo de vehiculos embargados");
		    		$("#mensaje_nombres").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#observaciones_vehiculos_embargados" ).focus(function() {
					$("#mensaje_nombres").fadeOut("slow");
    			});
				
			
		
				
		
		      
				    
		}); 

	</script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
       
       
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
     
      <form action="<?php echo $helper->url("VehiculosEmbargados","InsertaVehiculosEmbargados"); ?>" method="post" class="col-lg-6">
            <h4 style="color:#ec971f;">Insertar Vehiculos Embargados</h4>
            <hr/>
            	
            		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	       <div class="row">
			    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Vehiculos</p>
			  	<select name="id_tipo_vehiculos" id="id_tipo_vehiculos"  class="form-control" >
					<?php foreach($resultTipoVehiculos as $resTipoVehiculos) {?>
						<option value="<?php echo $resTipoVehiculos->id_tipo_vehiculos; ?>" <?php if ($resTipoVehiculos->id_tipo_vehiculos == $resEdit->id_tipo_vehiculos)  echo  ' selected="selected" '  ;  ?> ><?php echo $resTipoVehiculos->nombre_tipo_vehiculos; ?> </option><?php } ?>
				</select> 			  
			  </div>
		
		<div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Marca</p>
			  	<select name="id_marca_vehiculos" id="id_marca_vehiculos"  class="form-control" >
					<?php foreach($resultMarcaVehiculos as $resMarcaVehiculos) {?>
						<option value="<?php echo $resMarcaVehiculos->id_marca_vehiculos; ?>"  <?php if ($resMarcaVehiculos->id_marca_vehiculos == $resEdit->id_marca_vehiculos ) echo ' selected="selected" '  ; ?> ><?php echo $resMarcaVehiculos->nombre_marca_vehiculos; ?> </option><?php } ?>
				</select> 			  
			  </div>
			 
			  </div>
			  <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Placa</p>
			  	<input type="text"  name="placa_vehiculos_embargados" id="placa_vehiculos_embargados" value="<?php echo $resEdit->placa_vehiculos_embargados; ?>" class="form-control"/> 
			    <div id="mensaje_cedula" class="errores"></div>
			  </div>
			
			 
			
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Modelo</p>
			  	<input type="text"  name=",modelo_vehiculos_embargados" id="modelo_vehiculos_embargados" value="<?php echo $resEdit->modelo_vehiculos_embargados; ?>" class="form-control"/> 
			    <div id="mensaje_cedula" class="errores"></div>
			  </div>
			   </div>
			 
		    
		    <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Observaciones</p>
			  	<input type="text" name="observacion_vehiculos_embargados" id="observacion_vehiculos_embargados" value="<?php echo $resEdit->observacion_vehiculos_embargados; ?>" class="form-control"/> 
			  <div id="mensaje_nombres" class="errores"></div>
			  </div>
		    </div>
		   
	     	
	     	<hr>
	            	  
            
		     <?php } } 
		     else {?>
		    
		<div class="row">
			    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Vehiculos</p>
			  	<select name="id_tipo_vehiculos" id="id_tipo_vehiculos"  class="form-control" >
					<?php foreach($resultTipoVehiculos as $resTipoVehiculos) {?>
						<option value="<?php echo $resTipoVehiculos->id_tipo_vehiculos; ?>" ><?php echo $resTipoVehiculos->nombre_tipo_vehiculos; ?> </option><?php } ?>
				</select> 			  
			  </div>
		
		<div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Marca</p>
			  	<select name="id_marca_vehiculos" id="id_marca_vehiculos"  class="form-control" >
					<?php foreach($resultMarcaVehiculos as $resMarcaVehiculos) {?>
						<option value="<?php echo $resMarcaVehiculos->id_marca_vehiculos; ?>" ><?php echo $resMarcaVehiculos->nombre_marca_vehiculos; ?> </option><?php } ?>
				</select> 			  
			  </div>
			  </div>
			   <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Placa</p>
			  	<input type="text"  name="placa_vehiculos_embargados" id="placa_vehiculos_embargados" class="form-control"/> 
			    <div id="mensaje_cedula" class="errores"></div>
			  </div>
			
			 
			
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Modelo</p>
			  	<input type="text"  name=",modelo_vehiculos_embargados" id="modelo_vehiculos_embargados" class="form-control"/> 
			    <div id="mensaje_cedula" class="errores"></div>
			  </div>
			   </div>
			
		    
		     <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Observaciones</p>
			  	<input type="text" name="observacion_vehiculos_embargados" id="observacion_vehiculos_embargados" class="form-control"/> 
			  <div id="mensaje_nombres" class="errores"></div>
			  </div>
		    </div>
		   
			
			<hr>
		     <?php } ?>
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" > 
           <input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
           </div>
            </div>
            
          </form>  
     
       <!-- termina el form --> 
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Tipos de Vehiculos Embargados</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Tipo</th>
	    		<th style="color:#456789;font-size:80%;">Marca</th>
	    		<th style="color:#456789;font-size:80%;">Observacion</th>
	    		    		
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_vehiculos_embargados; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_tipo_vehiculos; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_marca_vehiculos; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->observacion_vehiculos_embargados; ?>     </td> 
		              
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("VehiculosEmbargados","index"); ?>&id_vehiculos_embargados=<?php echo $res->id_vehiculos_embargados; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("VehiculosEmbargados","borrarId"); ?>&id_vehiculos_embargados=<?php echo $res->id_vehiculos_embargados; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
			                </div>
			                <hr/>
		               </td>
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
      </div>
      </div>
   </body>  

    </html>   