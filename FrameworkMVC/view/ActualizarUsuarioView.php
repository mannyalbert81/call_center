


<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Usuarios - coactiva 2016</title>
        
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
		
		
		
		      <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
        
        </style>
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
				alertify.success("Has Pulsado en Editar"); 
				return false; 
			}
		</script>
		
		 <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#Guardar").click(function() 
			{
		   
		    	var clave_usuario = $("#clave_usuarios").val();
		    	var cclave_usuario = $("#cclave_usuarios").val();
		    
		   				
		    	if (cclave_usuario == "")
		    	{
		    		
		    		$("#mensaje_cclave").text("Introduzca una Clave");
		    		$("#mensaje_cclave").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_cclave").fadeOut("slow"); 
		            
				}
		    	
		    	if (clave_usuario != cclave_usuario)
		    	{
			    	
		    		$("#mensaje_cclave").text("Claves no Coinciden");
		    		$("#mensaje_cclave").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else
		    	{
		    		$("#mensaje_cclave").fadeOut("slow"); 
			        
		    	}	
				


			});
				
				
				
			
				$( "#clave_usuarios" ).focus(function() {
					$("#mensaje_clave").fadeOut("slow");
    			});
				$( "#cclave_usuarios" ).focus(function() {
					$("#mensaje_cclave").fadeOut("slow");
    			});
				
		
		      
				    
		}); 

	</script>
		
		
		
		<!-- TERMINA NOTIFICAIONES -->
        
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
        
      <form action="<?php echo $helper->url("Usuarios","Actualiza"); ?>" method="post" enctype="multipart/form-data" class="col-lg-6">
            
            <center><h4 style="color:#ec971f;">Actualizar Datos de Usuario</h4></center>
            
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            <table class="table">
            	
            	<div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombres Usuario</p>
			  	<input type="text" name="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>" class="form-control"/> 
  	            <div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			 
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuario</p>
			  	<input type="text" name="usuario_usuarios" value="<?php echo $resEdit->usuario_usuarios; ?>" class="form-control"/> 
			  	<div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			  	</div>
			   
			   	<div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Clave Usuario</p>
			  	<input type="password" name="clave_usuarios"  id="clave_usuarios" value="" class="form-control"/> 
			  	<div id="mensaje_clave" class="errores"></div>
			  </div>
			 
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Repita Clave Usuario</p>
			  	<input type="password" name="clave_usuario_r" id="clave_usuario_r" value="" class="form-control"/> 
			  	<div id="mensaje_cclave" class="errores"></div>
			  </div>
			    </div>
			    
			       	<div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Teléfono Usuario</p>
			  	<input type="text" name="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>" class="form-control"/>
			  	<div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			 
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Celular Usuario</p>
			  	<input type="text" name="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>" class="form-control"/> 
			  	<div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			    </div>
            	 
            	 <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Correo Usuario</p>
			  	<input type="email" name="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>" class="form-control"/>
			  	<div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
            	 </div>
            	 
		    </table>           
            
		     <?php } } else {?>
		    
		    <table class="table">
            	
            <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombres Usuario</p>
			  	<input type="text" name="nombre_usuarios" value="" class="form-control"/> 
  	            <div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			 
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuario</p>
			  	<input type="text" name="usuario_usuarios" value="" class="form-control"/> 
			  	<div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			  	</div>
			  	
			 
            	  	<div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Clave Usuario</p>
			  	<input type="password" name="clave_usuarios"  id="clave_usuarios" value="" class="form-control"/> 
			  	<div id="mensaje_clave" class="errores"></div>
			  </div>
			 
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Repita Clave Usuario</p>
			  	<input type="password" name="clave_usuario_r" id="clave_usuario_r" value="" class="form-control"/> 
			  	<div id="mensaje_cclave" class="errores"></div>
			  </div>
			    </div>
			    
			    <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Teléfono Usuario</p>
			  	<input type="text" name="telefono_usuarios" value="" class="form-control"/>
			  	<div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			 
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Celular Usuario</p>
			  	<input type="text" name="celular_usuarios" value="" class="form-control"/> 
			  	<div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			    </div>
			    
			    <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Correo Usuario</p>
			  	<input type="email" name="correo_usuarios" value="" class="form-control"/>
			  	<div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
            	 </div>
            		
		    </table>        
               	
		     <?php } ?>
		    <div class="col-xs-12 col-md-12" style="text-align: center;" >     
           <input type="submit" value="Guardar" name="guardar" id="guardar"  onClick="Ok()"class="btn btn-success"/>
            <hr>
            </div>            
          	</form>
                   
       

        
        </div>
       </div>
       </div>
     </body>  
    </html>   