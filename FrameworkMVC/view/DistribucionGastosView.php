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
       $resultMenu=array(1=>"Cheque",2=>"Reembolso");
       $resultGastos=array(1=>"Oficios",2=>"Citaciones",3=>"Otros");
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("DistribucionGastos","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- empieza la cabecera  -->
         <div class="col-lg-12" style="display:none;">
         <hr>
        	    <h4 style="color:#ec971f;">Distribucion Gastos</h4>
    
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
       	
			  
		    
		     <?php } } else {?>
		    
			   
		       <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Id Gastos:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-3">
			  	<p  class="formulario-subtitulo" style="" >Forma:</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultMenu as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select> 			
			  </div>
			
			
		       <div class="col-xs-3">
			  	<p  class="formulario-subtitulo" >Nº Referencia:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" >Valor ($):</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			
	
		     <?php } ?>
		     
		     
		  
			  <div class="col-xs-1"  >
			  <p  class="formulario-subtitulo" style="color:#ffffff" >GUARDAR</p>
			  	<input type="submit" id="Guardar" name="Guardar" value="Crear Gasto" class="btn btn-success"/>
			  </div>
			    
     	 
         </div>   
         <!-- termina la cabecera  -->
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Distribucion Gastos</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  			<div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Gastos Por:</p>
			  	<select name="gastos_por" id="gastos_por"  class="form-control" >
					<?php foreach($resultGastos as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select>
			<input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-default form-control" style="margin-top: 10px;"/> 			
		 </div>
		 
  			
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Entidad:</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultGastos as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Juicio:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>

         </div>
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Identificacion:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>

         </div>
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control "/> 
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control "/> 
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
		 
  			</div>
		</div>
        	
		 </div>
		 
		 <div class="col-lg-12">
		 
		 
		 <div class="col-lg-5">
		 
		 <div class="col-xs-4 ">
         		<p class="formulario-subtitulo" >Tipo Gasto:</p>
         </div>
		<div class="col-xs-6 ">
         		
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultGastos as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select> 
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
		
		<div class="col-xs-4 ">
         		<p class="formulario-subtitulo" >Descripcion Diligencia:</p>
         </div>
		<div class="col-xs-6 ">
         		<textarea id="nombre_oficios" name="nombre_oficios"  rows="1" class="form-control" ></textarea>
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
		
		<div class="col-xs-4 ">
         		<p class="formulario-subtitulo" >Valor($) a distribuir:</p>
         </div>
		<div class="col-xs-6 ">
         		<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
		<div class="col-xs-10 ">
		 <hr>
		 </div>
		 
		 <div class="col-xs-4 ">
         		<p class="formulario-subtitulo" >Tipo Gasto:</p>
         </div>
		<div class="col-xs-6 ">
         		
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultGastos as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select> 
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
		
		<div class="col-xs-4 ">
         		<p class="formulario-subtitulo" >Descripcion Diligencia:</p>
         </div>
		<div class="col-xs-6 ">
         		<textarea id="nombre_oficios" name="nombre_oficios"  rows="1" class="form-control" ></textarea>
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
		
		<div class="col-xs-4 ">
         		<p class="formulario-subtitulo" >Valor($) a distribuir:</p>
         </div>
		<div class="col-xs-6 ">
         		<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
		 
		 </div>
		 
		 <div class="col-lg-7">
		 <section class="" style="height:300px;overflow-y:scroll;">
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
           
       	</table>     
      </section>
		 
		 </div>
		 		 
		 </div>
		 
		 <div class="col-lg-12">
		 <div class="col-lg-3">
		 </div>
		 
		 <div class="col-lg-5" style="text-align: center;">
		 <div class="col-lg-4" style="text-align: center;">
		 <input type="submit" id="Buscar" name="Buscar" value="Reasignar" class="btn btn-default form-control" style="margin-top: 10px;"/> 
		 </div>
		 <div class="col-lg-3" style="text-align: center;">			
		<input type="submit" id="Buscar" name="Buscar" value="Cancelar" class="btn btn-default form-control" style="margin-top: 10px;"/> 			
		</div>
		<div class="col-lg-5" style="text-align: center;">
		<input type="submit" id="Buscar" name="Buscar" value="Nuevo Gasto" class="btn btn-default form-control" style="margin-top: 10px;"/> 			
		</div>
		 </div>
		 <div class="col-lg-3">
		 
		 </div>
		 </div>
		 
		 <div class="col-lg-12" style="margin-top: 20px;">
		 <div class="panel panel-default">
  			<div class="panel-body">
  		</div>
  		</div>
		 </div>
		 
		  <div class="col-lg-12" style="margin-top: 20px;">
		 <div class="col-lg-4">
		 <span>Total detalle de gasto ($):</span>
		 </div>
		 <div class="col-lg-4">
		 <input type="text" id="Buscar" name="Buscar" value="" class=" form-control" style="margin-top: 10px;"/> 
		 </div>
		 <div class="col-lg-4">
		 <input type="submit" id="Buscar" name="Buscar" value="Imprimir" class="btn btn-default form-control" style="margin-top: 10px;"/> 	
		 </div>
		 </div>
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
   </body>  

    </html>   