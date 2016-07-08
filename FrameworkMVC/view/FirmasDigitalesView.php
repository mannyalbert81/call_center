<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Firmas Digitales - coactiva 2016</title>
        
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
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
  
  <div class="container">
  
     <div class="row" style="background-color: #ffffff;">
  
  	      <form action="<?php echo $helper->url("FirmasDigitales","InsertaFirmasDigitales"); ?>" enctype="multipart/form-data"  method="post" class="col-lg-6">
           
            <h4 style="color:#ec971f;">Insertar Firmas Digitales</h4>
            <hr/>
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	       
	        <div class="row">
		     <div class="col-xs-6 col-md-6">
		     <p  class="formulario-subtitulo" >Nombre Firmante</p>
		             <select name="abogados" id="abogados"  class="form-control">
						<?php foreach($resultUsuarioSecretario as $resSecretario) {?>
							<option value="<?php echo $resSecretario->id_usuarios; ?>" <?php if ($resSecretario->id_usuarios == $resEdit->id_usuarios ) echo ' selected="selected" '  ; ?> ><?php echo $resSecretario->nombre_usuarios; ?> </option>
			               
			            <?php } ?>
				</select>
		     </div>
		     
		     <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Firma</p>
			  	<input type="file" name="imagen_firmas_digitales" id="imagen_firmas_digitales" value="<?php echo $resEdit->imagen_firmas_digitales; ?>" class="form-control"/> 
			 
			  <div id="mensaje_imagen_firmas_digitales" class="errores"></div>
			  </div>
		    </div>
		    
	     	<hr>
	        
		     <?php } } else {?>
		    	
		   
		    	
		    	 <div class="row">
		    	<div class="col-xs-6 col-md-6">
		    	<p  class="formulario-subtitulo" >Nombre Firmante</p>
		          <select name="abogados" id="abogados"  class="form-control">
									<?php foreach($resultUsuarioSecretario as $resSecretario) {?>
				 						<option value="<?php echo $resSecretario->id_usuarios; ?>" ><?php echo $resSecretario->nombre_usuarios; ?> </option>
						            <?php } ?>
								    	
					</select>
		         </div>
		         
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Firma</p>
			  	<input type="file" name="imagen_firmas_digitales" id="imagen_firmas_digitales" accept="png|jpg|jpeg" onKeyDown="return intro(event)" value="" class="form-control"/> 
			   <div id="mensaje_imagen_firmas_digitales" class="errores"></div>
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
            <h4 style="color:#ec971f;">Firmas</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        
        	<table class="table table-hover">
	         <tr>
	    		
	    		
	    		<th>Id</th>
	    		<th>Nombre Firmante</th>
	    		<th>Firma</th>
	  		</tr>
                <?php $registros = 1;?>
                 <?php foreach($resultSet as $res) {?>
	        		<tr>
	        		   <td> <?php echo $registros; ?>  </td>
		               <td> <?php echo $res->nombre_usuarios; ?>     </td> 
		               <td> <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $res->id_firmas_digitales; ?>&id_nombre=id_firmas_digitales&tabla=firmas_digitales&campo=imagen_firmas_digitales"  alt="<?php echo $res->id_usuarios; ?>" width="80" height="60" >      </td>
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("FirmasDigitales","index"); ?>&id_firmas_digitales=<?php echo $res->id_firmas_digitales; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("FirmasDigitales","borrarId"); ?>&id_firmas_digitales=<?php echo $res->id_firmas_digitales; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
			                <hr/>
		               </td>
		    		</tr>
		    		<?php $registros ++?>
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
