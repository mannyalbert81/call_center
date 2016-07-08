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
        
           <!-- AQUI NOTIFICAIONES -->
		<script type="text/javascript" src="view/css/lib/alertify.js"></script>
		<link rel="stylesheet" href="view/css/themes/alertify.core.css" />
		<link rel="stylesheet" href="view/css/themes/alertify.default.css" />
		
		
		
		<script>

		function Ok(){
				alertify.success("Has Pulsado en Procesar"); 
				return false;
			}
			
			function Borrar(){
				alertify.success("Has Pulsado en Borrar"); 
				return false; 
			}

			function notificacion(){
				alertify.success("Has Pulsado en Editar"); 
				return false; 
			}
		</script>
		
		
		
		<!-- TERMINA NOTIFICAIONES -->
		
        <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#procesar").click(function() 
			{
		   
		    	var archivo = $("#archivo").val();
		    
		   				
		    	if (archivo == "")
		    	{
			    	
		    		$("#mensaje_archivo").text("Introduzca una Importacion de Clientes ");
		    		$("#mensaje_archivo").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_archivo").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#archivo" ).focus(function() {
					$("#mensaje_archivo").fadeOut("slow");
    			});
				
	}); 

	</script>
        
        
        
        
    </head>
      <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
  
  <div class="container">
  <center>
     <div class="row" style="background-color: #ffffff;">
  
  	      <form action="<?php echo $helper->url("Clientes","ImportacionClientes"); ?>" enctype="multipart/form-data"  method="post" class="col-lg-12">
           <br>
            <h4 style="color:#ec971f;">Importar Clientes</h4>
            <hr/>
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	       <?php } } else {?>
		    	
			     <div class="col-xs-12 col-md-12">
			  		<p  class="formulario-subtitulo" >ARCHIVO</p>
			  		<input type="file" name="archivo" id="archivo" accept="txt" onKeyDown="return intro(event)" value="" class="form-control"/> 
			   		<div id="mensaje_archivo" class="errores"></div>
			     </div>
   				 <br>
		       
			
		     <?php } ?>
		
		
		<div class="row">
			<div class="col-xs-12 col-md-12" style="text-align: center;" > 
           		<?php if ($mensaje == "")?>
           		<?php {?>
           			<div class="alert alert-warning" role="alert"><?php echo $mensaje ; ?></div>
           		<?php }?>
           		
           </div>
        </div>
        <hr>  
		<div class="row">
			<div class="col-xs-12 col-md-12" style="text-align: center;" > 
          		
           		<input type="submit" id="procesar" name="procesar" value="Procesar" onClick="Ok()" class="btn btn-success"/>
           </div>
        </div>
      <hr>
      
    </form>
       
        
 
  </div>
  </div>
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          
