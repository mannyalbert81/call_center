
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
         
         <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#Guardar").click(function() 
			{
		   
		    	var observacion_vehiculos_embargados= $("#observacion_vehiculos_embargados").val();
		    
		   				
		    	if (observacion_vehiculos_embargados== "")
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


		 
				
				$( "#observacion_vehiculos_embargados" ).focus(function() {
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
     
      <form action="<?php echo $helper->url("ConvenioPagoSolicitud","InsertaConvenioPagoSolicitud"); ?>" method="post" class="col-lg-12">
            
            <h4 style="color:#ec971f;">Convenio Pago Solicitud</h4>
   
            	
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
	        
	      
	            	  
            
		     <?php } } 
		     else {?>
		    
		       
		    
		     <?php } ?>
		     
		     
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" > 
           <input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
           </div>
            </div>
            
          </form>  
     
       <!-- termina el form --> 
       
        
      </div>
      </div>
   </body>  

    </html>   