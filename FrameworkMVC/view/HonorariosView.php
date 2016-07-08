<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Honorarios - aDocument 2015</title>
        
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

        $("#Guardar").click(function(){

        	var ltCredito = $("#nombre_ltcredito").val();

			if (ltCredito == "")
	    	{
				$("#mensaje_nombre_ltcredito").text("INGRESE INFORMACION REQUERIDA");
	    		$("#mensaje_nombre_ltcredito").fadeIn("slow"); //Muestra mensaje de error
	            return false;
		    }
	    	else 
	    	{
	    		$("#mensaje_nombre_ltcredito").fadeOut("slow"); //Muestra mensaje de error
	    		
	            
			}    

			
            });

        $( "#nombre_ltcredito" ).focus(function() {
			  $("#mensaje_nombre_ltcredito").fadeOut("slow");
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
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Honorarios","InsertaHonorarios"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            
         
        	    <h4 style="color:#ec971f;">Insertar Honorarios</h4>
            	<hr/>
            	
		   		
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
              
			   <div class="row">
			   
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Honorario</p>
			  	<select name="tipo_honorario" id="tipo_honorario"  class="form-control" >
					<?php foreach($rsTipoHonorario as $resTipoH) {?>
						<option value="<?php echo $resTipoH->id_tipo_honorarios; ?>" <?php if ($resTipoH->id_tipo_honorarios == $resTipoH->id_tipo_honorarios )  echo  ' selected="selected" '  ;  ?> ><?php echo $resTipoH->descripcion_tipo_honorarios; ?> </option>
						           
			        <?php } ?>
				</select> 
				<div id="mensaje_tipo_honorario" class="errores"></div>			  
			  </div>
			  
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Descripcion</p>
			  	<input type="text"  name="descripcion" id="descripcion" value="" class="form-control"/> 
			  	<input type="hidden"  name="id_honorario" id="id_honorario" value="" class="form-control"/>
			    <div id="mensaje_descripcion" class="errores"></div>
			  </div>
			  
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Desde</p>
			  	<input type="text"  name="desde_honorarios" id="desde_honorarios" value="" class="form-control"/> 
			    <div id="mensaje_desde_honorarios" class="errores"></div>
			  </div>
			  
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Hasta</p>
			  	<input type="text"  name="hasta_honorarios" id="hasta_honorarios" value="" class="form-control"/> 
			  	<div id="mensaje_hasta_honorarios" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Por la Base Porcion Fija</p>
			  	<input type="text"  name="x_base_fija" id="x_base_fija" value="" class="form-control"/> 
			  	<div id="mensaje_x_base_fija" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Por el Exceso Porcentaje</p>
			  	<input type="text"  name="x_exceso" id="x_exceso" value="" class="form-control"/> 
			  	<div id="mensaje_x_exceso" class="errores"></div>
			  </div>
			   </div>
		    
		     <?php } } else {?>
		    
			    <div class="row">
			   
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Honorario</p>
			  	<select name="estados" id="estados"  class="form-control" >
					<?php foreach($rsTipoHonorario as $resTipoH) {?>
						<option value="<?php echo $resTipoH->id_tipo_honorarios; ?>"><?php echo $resTipoH->descripcion_tipo_honorarios; ?> </option>
						           
			        <?php } ?>
				</select>
				<div id="mensaje_tipo_honorario" class="errores"></div>	 			  
			  </div>
			  
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Descripcion</p>
			  	<input type="text"  name="descripcion" id="descripcion" value="" class="form-control"/> 
			  	<div id="mensaje_descripcion" class="errores"></div>
			  </div>
			  
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Desde</p>
			  	<input type="text"  name="desde" id="desde" value="" class="form-control"/> 
			    <div id="mensaje_desde_honorarios" class="errores"></div>
			  </div>
			  
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Hasta</p>
			  	<input type="text"  name="hasta" id="hasta" value="" class="form-control"/> 
			  	<div id="mensaje_hasta_honorarios" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Por la Base Porcion Fija</p>
			  	<input type="text"  name="x_base_fija" id="x_base_fija" value="" class="form-control"/> 
			  	<div id="mensaje_x_base_fija" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Por el Exceso Porcentaje</p>
			  	<input type="text"  name="x_exceso" id="x_exceso" value="" class="form-control"/> 
			  	<div id="mensaje_x_exceso" class="errores"></div>
			  </div>
			   </div>
		    
		         	
		     <?php } ?>
		     
		     
		       <div class="row" style="margin-top:20px">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" value="Guardar" onClick="Ok()" class="btn btn-success"/>
			  </div>
			</div>     
               
		
		 <hr>
          
       </form>
       <!-- termina el form --> 
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Honorarios</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Tipo</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Descripcion</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Desde</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Hasta</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Base Porcion Fija</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Exceso Porcentaje</b></th>
	    		
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_honorarios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->descripcion_tipo_honorarios; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->descripcion_honorarios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->desde_honorarios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->hasta_honorarios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->por_base_pocion_baja; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->por_exceso_porcentaje; ?></td>
		                 
		              
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Honorarios","index"); ?>&id_honorarios=<?php echo $res->id_honorarios; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Honorarios","borrarId"); ?>&id_honorarios=<?php echo $res->id_honorarios; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
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
      </div>
      </div>
   
     </body>  
    </html>   