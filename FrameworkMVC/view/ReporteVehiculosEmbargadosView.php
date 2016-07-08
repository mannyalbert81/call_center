<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Reporte Vehiculos Embargados- coactiva 2016</title>
        
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
				alertify.success("Has Pulsado en Buscar"); 
				return false;
			}
			
			function Borrar(){
				alertify.success("Has Pulsado en Borrar"); 
				return false; 
			}

			function notificacion(){
				alertify.success("Has Pulsado en Reporte"); 
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
		    $("#buscar").click(function() 
			{
		   
		    	var contenido_busqueda= $("#contenido_busqueda").val();
		    
		   				
		    	if (contenido_busqueda== "")
		    	{
			    	
		    		$("#mensaje_busqueda").text("Introduzca un tipo de busqueda");
		    		$("#mensaje_busqueda").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_busqueda").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#contenido_busqueda" ).focus(function() {
					$("#mensaje_busqueda").fadeOut("slow");
    			});
				
			
		
				
		
		      
				    
		}); 

	</script>
 
    
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       $resultMenu=array(0=>"Identificacion",1=>"Placa Vehiculo");
  
       $fecha_actual = strtotime(Date("Y-m-d"));
         
		?>
 
  
  
	
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
     
      <form action="<?php echo $helper->url("ReporteVehiculosEmbargados","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
    
    <div class="col-lg-5">
    <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
           <?php //no hay datos para editar?>
        
            <?php } } else {?>
		     
		      <h4 style="color:#ec971f;">Reporte Vehiculos Embargados</h4>
            	<hr/>
		     
		     <div class="row">
			    
			  <div class="col-xs-4 col-md-6">
			  	<p  class="formulario-subtitulo" >Seleccione</p>
			  	<select name="criterio_busqueda" id="criterio_busqueda"  class="form-control" >
					<?php foreach($resultMenu as $val=>$desc) {?>
						<option value="<?php echo $val; ?>"  ><?php echo $desc ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
		    
		     
             	
             	
		    <div class="col-xs-6 col-md-6">
		    	<p  class="formulario-subtitulo" style="color: #ffffff;" >--</p>
			  <input type="text" name="contenido_busqueda" id="contenido_busqueda" value="" class="form-control"/>
			  <div id="mensaje_busqueda" class="errores"></div>
			  </div>
			  
			<div class="col-xs-12 col-md-12" style="margin-top: 20px; text-align: center;" >
		
			  	<input type="submit" id="buscar" name="buscar"  value="buscar" onClick="Ok()" class="btn btn-default"/>

			</div>
			
			  </div>
              <?php } ?>
              </div>
    
    
    <div  class="col-lg-7">
     <h4 style="color:#ec971f;">Lista Vehiculos Embargados</h4>
            <hr/>
    		
		<div class="col-xs-12" style="margin: 5px;">	

	</div>
	
	<div class="col-xs-12">
      
      
        
       <section   style="height:400px;overflow-y:scroll;width: 655px;">
        <table class="table table-hover ">
	         <tr >
	    		
	    		
	    		<th style="color:#456789;font-size:80%;">Identificación</th>
	    		<th style="color:#456789;font-size:80%;">Nombres Clientes</th>
	    		<th style="color:#456789;font-size:80%;">Tipo Vehiculo</th>
	    		<th style="color:#456789;font-size:80%;">Placa</th>
	    		<th style="color:#456789;font-size:80%;">Modelo</th>
	    		<th style="color:#456789;font-size:80%;">Marca</th>
	    		<th style="color:#456789;font-size:80%;">Fecha Ingreso</th>
	    		<th style="color:#456789;font-size:80%;">Nº Dias Retenido</th>
	    
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultDatos)) {  foreach($resultDatos as $res) {?>
	        		<tr>
	       
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_vehiculos; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->placa_vehiculos_embargados; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->modelo_vehiculos_embargados; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_marca_vehiculos; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_ingreso_vehiculos_embargados; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php $fecha_ingreso=strtotime("$res->fecha_ingreso_vehiculos_embargados"); $diferencia=$fecha_actual-$fecha_ingreso; echo $diferencia/86400; ?>  </td>
		     
		             <td>   
			                	<div class="right">
			                	<a href="/FrameworkMVC/view/ireports/ContVehiculosSubReport.php?id_vehiculos_embargados=<?php echo $res->id_vehiculos_embargados; ?>"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"; class="btn btn-success" onClick="notificacion()" style="font-size:65%;">Reporte</a>
			                 </div>
			              
		               </td>
		    		</tr>
		        <?php } } ?>
      
       	</table>     
		     
      </section>
        
        </div>
       
    </div>
    
    </form>
 </div>
   </div>
     </body>  
    </html>   