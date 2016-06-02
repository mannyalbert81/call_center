
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Distribucion Gastos - coactiva 2015</title>
        
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
		   
		    	var nombre_tipo_identificacion = $("#nombre_tipo_identificacion").val();
		    
		   				
		    	if (nombre_tipo_identificacion == "")
		    	{
			    	
		    		$("#mensaje_nombres").text("Introduzca un tipo de identificacion ");
		    		$("#mensaje_nombres").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#nombre_tipo_identificacion" ).focus(function() {
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
       
      <form action="<?php echo $helper->url("DistribucionGastos","InsertaDistribucionGastos"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
            
         
        	    <h4 style="color:#ec971f;">Insertar Tipos de Identificaciones</h4>
            	<hr/>
            	
		   		
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            
            
        
			   
			   <div class="row">
		       <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Id_Gasto:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="<?php echo $resEdit->nombre_tipo_identificacion; ?>" class="form-control"/> 
			  	<input type="hidden"  name="id_tipo_identificacion"  value="<?php echo $resEdit->id_tipo_identificacion; ?>" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  
			   <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Nº Referencia:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="<?php echo $resEdit->nombre_tipo_identificacion; ?>" class="form-control"/> 
			  	<input type="hidden"  name="id_tipo_identificacion"  value="<?php echo $resEdit->id_tipo_identificacion; ?>" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
		    </div>
		    
		    
		     <?php } } else {?>
		    
			   <div class="row">
		       <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Id. Gasto:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  
			   <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Nº Referencia:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  </div>
			   <div class="row">
			  <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Valor ($):</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Gastos Por:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>  
			   </div> 
			  		  
			   <div class="row">
		       <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Entidad:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			   
			  					  
			   <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Nº Juicio:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			   </div>
			  <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Identificacion cliente</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Fecha Recepcion:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>		  
			 </div>

		    <hr>
		        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Tipos de Identificacion</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Nombre</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_tipo_identificacion; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_identificacion; ?>     </td> 
		              
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("TipoIdentificacion","index"); ?>&id_tipo_identificacion=<?php echo $res->id_tipo_identificacion; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("TipoIdentificacion","borrarId"); ?>&id_tipo_identificacion=<?php echo $res->id_tipo_identificacion; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
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
		   
               	
		     <?php } ?>
		     
		     
		       <div class="row">
			  <div class="col-xs-12 col-md-6" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
			  </div>
			</div>     
               
		
		 <hr>
          
       </form>
    
      
        
      </div>
      </div>
   </body>  

    </html>   