 									<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Notificaciones - aDocument 2015</title>
        
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
				alertify.success("Has Pulsado en Editar"); 
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
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;
		    	var descripcion_notificaciones = $("#descripcion_notificaciones").val();
		    
		    	
		    	
		    	
		    	
		    	
		    	if (id_tipo_notificacion == "")
		    	{
			    	
		    		$("#mensaje_ruc").text("Introduzca un tipo de notificacion");
		    		$("#mensaje_ruc").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_ruc").fadeOut("slow"); //Muestra mensaje de error
		            
				}    
				
		    	if (descripcion_notificaciones == "")
		    	{
			    	
		    		$("#mensaje_nombres").text("Introduzca una Notificacion ");
		    		$("#mensaje_nombres").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    }); 


		        $( "#id_tipo_notificacion" ).focus(function() {
				  $("#mensaje_ruc").fadeOut("slow");
			    });
				
				$( "#descripcion_notificaciones" ).focus(function() {
					$("#mensaje_nombres").fadeOut("slow");
    			});
				
					    
		}); 

	</script>
        
          
    </head>
      <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
  
     <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
  
      <form action="<?php echo $helper->url("Notificaciones","InsertaNotificaciones"); ?>" method="post" class="col-lg-6">
            <h4 style="color:#ec971f;">Insertar Notificaciones</h4>
            <hr/>
            	
            		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	       <div class="row">
			    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Notificacion</p>
			  	<select name="id_tipo_notificacion" id="id_tipo_notificacion"  class="form-control" >
					<?php foreach($resultTipoNotificacion as $resTipoNotificacion) {?>
						<option value="<?php echo $resTipoNotificacion->id_tipo_notificacion; ?>" <?php if ($resTipoNotificacion->id_tipo_notificacion == $resEdit->id_tipo_notificacion )  echo  ' selected="selected" '  ;  ?> ><?php echo $resTipoNotificacion->descripcion_notificacion; ?> </option><?php } ?>
				</select> 			  
			  </div>
		
		<div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuarios</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultUsuarios as $resUsuarios) {?>
						<option value="<?php echo $resUsuarios->id_usuarios; ?>"  <?php if ($resUsuarios->id_usuarios == $resEdit->id_usuarios ) echo ' selected="selected" '  ; ?> ><?php echo $resUsuarios->nombre_usuarios; ?> </option><?php } ?>
				</select> 			  
			  </div>
			  </div>
			<br>		 
		    <div class="row">
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Descripcion Notificaciones</p>
			  	<input type="text" name="descripcion_notificaciones" id="descripcion_notificaciones" value="<?php echo $resEdit->descripcion_notificaciones; ?>" class="form-control"/> 
			  <div id="mensaje_nombres" class="errores"></div>
			  </div>
		    </div>
		   
	     	
	     	<hr>
	            	  
            
		     <?php } } 
		     else {?>
		    
		<div class="row">
			    
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Notificacion</p>
			  	<select name="id_tipo_notificacion" id="id_tipo_notificacion"  class="form-control" >
					<?php foreach($resultTipoNotificacion as $resTipoNotificacion) {?>
						<option value="<?php echo $resTipoNotificacion->id_tipo_notificacion; ?>"  ><?php echo $resTipoNotificacion->descripcion_notificacion; ?>  </option>
						 <?php } ?>
						 
				</select> 			  
			  </div>
				<div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuarios</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultUsuarios as $resUsuarios) {?>
						<option value="<?php echo $resUsuarios->id_usuarios; ?>"      ><?php echo $resUsuarios->nombre_usuarios; ?> </option>
			            <?php } ?>
				</select> 			  
			  </div>
			  </div>
		    <br>
		    <div class="row">
			  <div class="col-xs-12 col-md-12">
			  	<center><p  class="formulario-subtitulo" >Descripcion Notificaciones</p>
			  	<input type="text" name="descripcion_notificaciones" id="descripcion_notificaciones"  class="form-control"/> 
			  <div id="mensaje_nombres" class="errores"></div>
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
          
       
        
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Notificaciones</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Tipo Notificacion</th>
	    		<th style="color:#456789;font-size:80%;">Usuario</th>
	    		<th style="color:#456789;font-size:80%;">Descripcion</th>
	    	</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_notificaciones; ?>  </td>
	                   <td style="color:#000000;font-size:80%;" > <?php echo $res->id_tipo_notificacion; ?>     </td>
	                   <td style="color:#000000;font-size:80%;" > <?php echo $res->id_usuarios; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->descripcion_notificaciones; ?>     </td>
		                 
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Notificaciones","index"); ?>&id_notificaciones=<?php echo $res->id_notificaciones; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Notificaciones","borrarId"); ?>&id_notificaciones=<?php echo $res->id_notificaciones; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
			                
			                <hr/>
		               </td>
		    		</tr>
		        <?php } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
   
      </div>
      </div>
   
  
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>
