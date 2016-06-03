
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Distribucion Gastos - coactiva 2016</title>
        
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
			    	
		    		$("#mensaje_nombres").text("Introduzca un Gasto");
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
       
      <form action="<?php echo $helper->url("TipoIdentificacion","InsertaTipoIdentificacion"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            
         <hr>
        	    <h4 style="color:#ec971f;">Distribucion Gastos</h4>
    
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
       	
			   <div class="row">
		       <div class="col-xs-3 col-md-3">
			  	<p  class="formulario-subtitulo" >Nombres tipos de Identificaciones</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="<?php echo $resEdit->nombre_tipo_identificacion; ?>" class="form-control"/> 
			  	<input type="hidden"  name="id_tipo_identificacion"  value="<?php echo $resEdit->id_tipo_identificacion; ?>" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			   </div>
		    
		     <?php } } else {?>
		    
			   <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Id Gastos:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Cheque o Reembolso:</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultUsuarios as $resUsuarios) {?>
						<option value="<?php echo $resUsuarios->id_usuarios; ?>"      ><?php echo $resUsuarios->nombre_usuarios; ?> </option>
			            <?php } ?>
				</select> 			
			  </div>
			 </div>
			 <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nº Referencia:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Valor ($):</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			 </div>
	
		     <?php } ?>
		     
		     
		       <div class="row">
			  <div class="col-xs-12 col-md-6" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" value="Crear Gasto" class="btn btn-success"/>
			  </div>
			</div>     
     	 <hr>
		 <h4 style="color:#ec971f;">Registro Gastos</h4>
           
           <div class="row">
		      <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Gasto</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultUsuarios as $resUsuarios) {?>
						<option value="<?php echo $resUsuarios->id_usuarios; ?>"      ><?php echo $resUsuarios->nombre_usuarios; ?> </option>
			            <?php } ?>
				</select> 			  
			  </div>
		<div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Descripcion Diligencia</p>
			  	<textarea id="" name="" rows="2" cols="15" class="form-control"><?php echo $resEdit->nombre_oficios; ?></textarea> 
			  	<input type="hidden"  name="id_oficios"  value="<?php echo $resEdit->id_oficios; ?>" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			 </div> 
			 <div class="row">
			 <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Valor a Distribuir ($):</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>	
          </div>
          <hr>
           <h4 style="color:#ec971f;">Ingreso de Soporte</h4>
           
           <div class="row">
		 <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Documento Soporte</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultUsuarios as $resUsuarios) {?>
						<option value="<?php echo $resUsuarios->id_usuarios; ?>"      ><?php echo $resUsuarios->nombre_usuarios; ?> </option>
			            <?php } ?>
				</select> 			  
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nº Documento:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			 </div> 
			 <div class="row">
			 <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >A favor de:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>	
          </div>
            
		 <div class="row">
			  <div class="col-xs-12 col-md-6" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" value="Asignar" class="btn btn-success"/>
			  </div>
			</div>  
			<hr>		
       </form>
        <hr>
            <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Tipos de Identificacion</h4>
            <hr/>
            <div class="col-xs-4">
               <input type="text"  name="contenido_busqueda" id="contenido_busqueda" value="" class="form-control"/>
           <div id="mensaje_contenido_busqueda" class="errores"></div>
            </div>
            
           <div class="col-xs-4">
           <select name="criterio_busqueda" id="criterio_busqueda"  class="form-control">
                                    <?php foreach($resultMenu_busqueda as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" <?php //if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
           
           <div class="col-xs-4" >
		
			  	<input type="submit" id="buscar" name="Buscar"  onclick="this.form.action='<?php echo $helper->url("AutoPagos","index"); ?>'" value="buscar" class="btn btn-default"/>
			</div>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Nº Oficio</th>
	    		<th style="color:#456789;font-size:80%;">Nº Juicio</th>
	    		<th style="color:#456789;font-size:80%;">Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Entidad</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
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
		        <?php } }  ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
      </div>
      </div>
   </body>  

    </html>   