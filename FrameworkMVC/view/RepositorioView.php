<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Gestion Repositorio - aDocument 2015</title>
        
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
		
		
		
		<!-- TERMINA NOTIFICACIONES -->
        
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
		   
		    	var nombre_controladores = $("#nombre_controladores").val();
		    
		   				
		    	if (nombre_controladores == "")
		    	{
			    	
		    		$("#mensaje_nombres").text("Introduzca un tipo de controlador ");
		    		$("#mensaje_nombres").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#nombre_controladores" ).focus(function() {
					$("#mensaje_nombres").fadeOut("slow");
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
       
      <form action="<?php echo $helper->url("Repositorio","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            
         
        	    <h4 style="color:#ec971f;">Insertar Repositorios</h4>
            	<hr/>
            	
		   	<?php if($resultado!=""){
		   		echo "
                <script language='JavaScript'>
                alert('$resultado');
                </script>";
		   	}?>	
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
			   <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombres Controladores</p>
			  	<input type="text"  name="nombre_controladores" id="nombre_controladores" value="<?php echo $resEdit->nombre_controladores; ?>" class="form-control"/> 
			  	<input type="hidden"  name="id_controladores"  value="<?php echo $resEdit->id_controladores; ?>" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			   </div>
		    
		     <?php } } else {?>
		    
			   <div class="row">
			   <p  class="" style="margin-left:50px; ">Ubicacion de Repositorio: /Document_Root/Documentos/</p>
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombre Repositorio</p>
			  	<input type="text"  name="nombre_repositorio" id="nombre_repositorio" value="" class="form-control"/> 
			    <div id="mensaje_repositorio" class="errores"></div>
			  </div>
			 </div>

		    <hr>
		    
		   
               	
		     <?php } ?>
		     
		     
		       <div class="row">
			  <div class="col-xs-12 col-md-6" style="text-align: center;" >
			  	<input type="submit" id="guardar" name="guardar" value="Guardar" onClick="Ok()" class="btn btn-success"/>
			  </div>
			</div>     
               
		
		 <hr>
          
       </form>
       <!-- termina el form --> 
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Repositorios</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Nº</b></th>
	    		<th style="color:#456789;font-size:80%;">Nombre Repositorio</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php  if (!empty($resultSet)) { $contador=1; foreach($resultSet as $res) { ?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $contador ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res ?>     </td> 
		              
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Repositorio","index"); ?>&nombre_dir=<?php echo $res ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Eliminar</a>
			                </div>
			            
			           </td>
			             
		    		</tr>
		        <?php  $contador=$contador+1;} } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
      </div>
      </div>
  
     </body>  
    </html>   