<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Importacion Clientes - coactiva 2016</title>
        
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
		   
		    	var imagen_firmas_digitales = $("#imagen_firmas_digitales").val();
		    
		   				
		    	if (imagen_firmas_digitales == "")
		    	{
			    	
		    		$("#mensaje_imagen_firmas_digitales").text("Introduzca una Firma ");
		    		$("#mensaje_imagen_firmas_digitales").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_imagen_firmas_digitales").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#imagen_firmas_digitales" ).focus(function() {
					$("#mensaje_imagen_firmas_digitales").fadeOut("slow");
    			});
				
	}); 

	</script>
        
        
        
        
    </head>
      <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
  
  <div class="container">
  
     <div class="row" style="background-color: #ffffff;">
  
  	      <form action="<?php echo $helper->url("Clientes","ImportacionClientes"); ?>" enctype="multipart/form-data"  method="post" class="col-lg-6">
            <h4 style="color:#ec971f;">Procesar Archivo de Recaudacion</h4>
            <hr/>
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	       <?php } } else {?>
		    	
			     <div class="col-xs-6 col-md-6">
			  		<p  class="formulario-subtitulo" >Firma</p>
			  		<input type="file" name="archivo" id="archivo" accept="txt" onKeyDown="return intro(event)" value="" class="form-control"/> 
			   		<div id="mensaje_imagen_firmas_digitales" class="errores"></div>
			     </div>
   				 
		       
			
		     <?php } ?>
		
		
		<div class="row">
			<div class="col-xs-12 col-md-12" style="text-align: center;" > 
           		<?php if ($mensaje == "")?>
           		<?php {?>
           			<div class="alert alert-warning" role="alert"><?php echo $mensaje ; ?></div>
           		<?php }?>
           		
           </div>
        </div>
		<div class="row">
			<div class="col-xs-12 col-md-12" style="text-align: center;" > 
           		
           		<input type="submit" id="procesar" name="procesar" value="Procesar" class="btn btn-success"/>
           </div>
        </div>
    </form>
       
        
 
  </div>
  </div>
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          
