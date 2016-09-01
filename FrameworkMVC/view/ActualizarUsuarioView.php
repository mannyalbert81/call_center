


<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Actualizar Usuarios - CallCenter 2016</title>
        
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
				alertify.success("Has Pulsado en Actualizar"); 
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
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var cedula_usuario = $("#cedula_usuarios").val();
		    	var nombre_usuario = $("#nombre_usuarios").val();
		    	var usuario_usuario = $("#usuario_usuarios").val();
		    	var clave_usuario = $("#clave_usuarios").val();
		    	var cclave_usuario = $("#cclave_usuarios").val();
		    	var celular_usuario = $("#celular_usuarios").val();
		    	var correo_usuario  = $("#correo_usuarios").val();
		    	var correo_usuario  = $("#correo_usuarios").val();
		    	
		    	
		    	if (cedula_usuario == "")
		    	{
			    	
		    		$("#mensaje_cedula").text("Introduzca una Cedula");
		    		$("#mensaje_cedula").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_cedula").fadeOut("slow"); //Muestra mensaje de error
		            
				}    
				
		    	if (nombre_usuario == "")
		    	{
			    	
		    		$("#mensaje_nombres").text("Introduzca un Nombre");
		    		$("#mensaje_nombres").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	if (usuario_usuario == "")
		    	{
			    	
		    		$("#mensaje_usuario").text("Introduzca una Usuario");
		    		$("#mensaje_usuario").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_usuario").fadeOut("slow"); //Muestra mensaje de error
		            
				}   
						    	
				//la clave

		    	if (clave_usuario == "")
		    	{
		    		
		    		$("#mensaje_clave").text("Introduzca una Clave");
		    		$("#mensaje_clave").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_clave").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	

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
				

				//los telefonos
		    	
		    	if (celular_usuario == "" )
		    	{
			    	
		    		$("#mensaje_celular").text("Ingrese un Celular");
		    		$("#mensaje_celular").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_celular").fadeOut("slow"); //Muestra mensaje de error
		            
				}

				// correos
				
		    	if (correo_usuario == "")
		    	{
			    	
		    		$("#mensaje_correo").text("Introduzca un correo");
		    		$("#mensaje_correo").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else if (regex.test($('#correo_usuario').val().trim()))
		    	{
		    		$("#mensaje_correo").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	else 
		    	{
		    		$("#mensaje_correo").text("Introduzca un correo Valido");
		    		$("#mensaje_correo").fadeIn("slow"); //Muestra mensaje de error
		            return false;	
			    }

		    	

		    					    

			}); 


		        $( "#cedula_usuarios" ).focus(function() {
				  $("#mensaje_cedula").fadeOut("slow");
			    });
				
				$( "#nombre_usuarios" ).focus(function() {
					$("#mensaje_nombres").fadeOut("slow");
    			});
				$( "#usuario_usuarios" ).focus(function() {
					$("#mensaje_usuario").fadeOut("slow");
    			});
    			
				$( "#clave_usuarios" ).focus(function() {
					$("#mensaje_clave").fadeOut("slow");
    			});
				$( "#cclave_usuarios" ).focus(function() {
					$("#mensaje_cclave").fadeOut("slow");
    			});
				
				$( "#celular_usuarios" ).focus(function() {
					$("#mensaje_celular").fadeOut("slow");
    			});
				
				$( "#correo_usuarios" ).focus(function() {
					$("#mensaje_correo").fadeOut("slow");
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
            <hr>
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
           
            	
            	
            	<div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Cedula</p>
			  	<input type="text" name="cedula_usuarios" value="<?php echo $resEdit->cedula_usuarios; ?>" class="form-control" readonly/> 
  	             <div id="mensaje_cedula" class="errores"></div>
			  </div>
			 
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
					<?php foreach($resultCiu as $resCiu) {?>
						<option value="<?php echo $resCiu->id_ciudad; ?>"  <?php if ($resCiu->id_ciudad == $resEdit->id_ciudad ) echo ' selected="selected" '  ; ?> ><?php echo $resCiu->nombre_ciudad; ?> </option>
			        <?php } ?>
				</select> 
			 </div>
			  	</div>
            	
            	
            	<div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombres Usuario</p>
			  	<input type="text" name="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>" class="form-control"/> 
  	            <div id="mensaje_nombres" class="errores"></div>
			  </div>
			 
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuario</p>
			  	<input type="text" name="usuario_usuarios" value="<?php echo $resEdit->usuario_usuarios; ?>" class="form-control"/> 
			  	<div id="mensaje_usuario" class="errores"></div>
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
			  	<input type="password" name="cclave_usuarios" id="cclave_usuarios" value="" class="form-control"/> 
			  	<div id="mensaje_cclave" class="errores"></div>
			  </div>
			    </div>
			    
			       	<div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Teléfono Usuario</p>
			  	<input type="text" name="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>" class="form-control"/>
			  	
			  </div>
			 
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Celular Usuario</p>
			  	<input type="text" name="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>" class="form-control"/> 
			  	<div id="mensaje_celular" class="errores"></div>
			  </div>
			    </div>
            	 
            	 <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Correo Usuario</p>
			  	<input type="email" name="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>" class="form-control"/>
			  	<div id="mensaje_correo" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Foto</p>
			  	<input type="file" name="imagen_usuarios" id="imagen_usuarios" value="" class="form-control" /> 
			  
			  </div>
            	 </div>
                  
            
		     <?php } } else {?>
		    
		   
            	
            <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Cedula</p>
			  	<input type="text" name="cedula_usuarios" value="" class="form-control" readonly/> 
  	            <div id="mensaje_descripcion_notificacion" class="errores"></div>
			  </div>
			 
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
					<?php foreach($resultCiu as $resCiu) {?>
						<option value=""  ><?php echo $resCiu->nombre_ciudad; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
			  	</div>
			  	
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
            		
		        
               	
		     <?php } ?>
		     <div class="row">
		      <hr>
		    <div class="col-xs-12 col-md-12" style="text-align: center;" >     
           <input type="submit" value="Actualizar" name="Guardar" id="Guardar"  onClick="Ok()" class="btn btn-success"/>
            <hr>
            </div>    
            </div>         
          	</form>
                   
       <div class="col-lg-6">
       
            <h4 style="color:#ec971f;">Fotografia del Usuario</h4>
           
        <div class="row">
        <div class="col-xs-12 col-md-12" style="margin-top:20px">
        <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $_SESSION['id_usuarios']; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $_SESSION['id_usuarios'];?>" width="450" height="400"  style="float:left;" >
 		</div>
 		</div>

        
        </div>
       </div>
       </div>
       <?php include("view/modulos/footer.php"); ?>
     </body>  
    </html>   