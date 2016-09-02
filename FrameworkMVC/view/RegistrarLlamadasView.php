


<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Registrar Llamadas - CallCenter 2016</title>
        
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

			$("#Buscar").click(function()

			{

				var contenido = $("#contenido").val();
				var criterio= $("#criterio").val();

				if (contenido != "" && criterio==0)
		    	{
					$("#mensaje_criterio").text("Seleccione filtro de busqueda");
		    		$("#mensaje_criterio").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_criterio").fadeOut("slow"); //Muestra mensaje de error
		    		
		            
				}    

				if (criterio !=0 && contenido=="")
		    	{

			    	
		    		$("#mensaje_contenido").text("Ingrese Contenido a buscar");
		    		$("#mensaje_contenido").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    	
		    		
			    }
		    	else 
		    	{
		    		$("#mensaje_contenido").fadeOut("slow"); //Muestra mensaje de error
		            
				}    


				

		
				
			});


			$( "#contenido" ).focus(function() {
				  $("#mensaje_contenido").fadeOut("slow");
			    });

			$( "#criterio" ).focus(function() {
				  $("#mensaje_criterio").fadeOut("slow");
			    });
		   
			
		});
			</script >
        
        
        
			
			
			<script >
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Guardar").click(function() 
			{
		    	var regex = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
		    	var validaFecha = /([0-9]{4})\-([0-9]{2})\-([0-9]{2})/;

		    	var identificacion_clientes = $("#identificacion_clientes").val();
		    	var nombres_clientes = $("#nombres_clientes").val();
		    	var telefono_clientes = $("#telefono_clientes").val();
		    	var celular_clientes = $("#celular_clientes").val();
		    	var direccion_clientes = $("#direccion_clientes").val();
		    	
		    	
		    	
		    	if (identificacion_clientes == "")
		    	{
			    	
		    		$("#mensaje_identificacion_clientes").text("Introduzca una Identificacion");
		    		$("#mensaje_identificacion_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_identificacion_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}    
				
		    	if (nombres_clientes == "")
		    	{
			    	
		    		$("#mensaje_nombres_clientes").text("Introduzca un Nombre");
		    		$("#mensaje_nombres_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}  

		    	if (telefono_clientes == "")
		    	{
			    	
		    		$("#mensaje_telefono_clientes").text("Introduzca un Teléfono");
		    		$("#mensaje_telefono_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_telefono_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				} 

		    	if (celular_clientes == "")
		    	{
			    	
		    		$("#mensaje_celular_clientes").text("Introduzca un Celular");
		    		$("#mensaje_celular_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_celular_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}

		    	if (direccion_clientes == "")
		    	{
			    	
		    		$("#mensaje_direccion_clientes").text("Introduzca una Dirección");
		    		$("#mensaje_direccion_clientes").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_direccion_clientes").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

		    					    

			}); 

		    $( "#identificacion_clientes" ).focus(function() {
				  $("#mensaje_identificacion_clientes").fadeOut("slow");
			    });
				
		        $( "#nombres_clientes" ).focus(function() {
				  $("#mensaje_nombres_clientes").fadeOut("slow");
			    });

		        $( "#telefono_clientes" ).focus(function() {
					  $("#mensaje_telefono_clientes").fadeOut("slow");
				    });
		        $( "#celular_clientes" ).focus(function() {
					  $("#mensaje_celular_clientes").fadeOut("slow");
				    });
		        $( "#direccion_clientes" ).focus(function() {
					  $("#mensaje_direccion_clientes").fadeOut("slow");
				    });
				
		
				
		      
				    
		}); 

	</script>
	
	<script>
		function contador (campo, cuentacampo, limite) {
		if (campo.value.length > limite) campo.value = campo.value.substring(0, limite);
		else cuentacampo.value = limite - campo.value.length;
		} 
    </script>
	
    </head>
    <body style="background-color: #d9e3e4;" >
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
       $sel_identificacion = "";
  
        
        
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	 
       	if(!empty($resultSet)){
       		$sel_identificacion = $_POST['identificacion'];
       	}
       	 
       }
       
       $habilitar="disabled";
        
       if(!empty($resultSet) || $sel_identificacion!=""){
       	$habilitar="";
       }
       
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
  
    
      <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("RegistrarLlamadas","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
            
         <div class="col-lg-6">
         
        	    <h4 style="color:#ec971f; text-align: center;" >Datos del Cliente</h4>
            	<hr/>
            	
		   	<div class="panel panel-default">
  			<div class="panel-body">
  			
  			 <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Identificacion:</p>
			  	<input type="text"  name="identificacion" id="identificacion" value="<?php echo $sel_identificacion;?>" class="form-control"/> 
			    <div id="mensaje_identificacion" class="errores"></div>
           </div>
		   
		   <div class="col-xs-6 col-md-6">
			 <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-warning " onClick="notificacion()" style="margin-top: 30px;"/> 	
		  
		  </div>
		    </div>
		    </div>
		    </div>	
            
          <?php if (!empty($resultSet) ) { foreach($resultSet as $resEdit) {?>
          
		     <div class="panel panel-default">
  			<div class="panel-body">
  			
		    <div class="row">
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Identificacion</p>
			  	<select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultTipoIdent as $resTipoIdent) {?>
					<option value="<?php echo $resTipoIdent->id_tipo_identificacion; ?>"  <?php if ($resTipoIdent->id_tipo_identificacion == $resEdit->id_tipo_identificacion ) echo ' selected="selected" '  ; ?> ><?php echo $resTipoIdent->nombre_tipo_identificacion; ?> </option>
						   <?php } ?>
				</select> 
			  </div>
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Numero de Identificación</p>
			  	<input type="text"  name="identificacion_clientes" id="identificacion_clientes" value="<?php echo $resEdit->identificacion_clientes; ?>" class="form-control" readonly /> 
			    <div id="mensaje_identificacion_clientes" class="errores"></div>
			  <input type="hidden"  name="id_clientes" id="id_clientes" value="<?php echo $resEdit->id_clientes; ?>" class="form-control"/> 
			  </div>
			   </div>
			   
			   
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombres Cliente</p>
			  	<input type="text" name="nombres_clientes" id="nombres_clientes" value="<?php echo $resEdit->nombres_clientes; ?>" class="form-control" <?php echo $habilitar;?>/>
			  <div id="mensaje_nombres_clientes" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Teléfono</p>
			  	<input type="text" name="telefono_clientes" id="telefono_clientes" value="<?php echo $resEdit->telefono_clientes; ?>" class="form-control" <?php echo $habilitar;?>/>
			  <div id="mensaje_telefono_clientes" class="errores"></div>
			  </div>
		    </div>
		    
		     <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Celular </p>
			  	<input type="text" name="celular_clientes" id="celular_clientes" value="<?php echo $resEdit->celular_clientes; ?>" class="form-control" <?php echo $habilitar;?>/>
			  <div id="mensaje_celular_clientes" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Dirección</p>
			  	<input type="text" name="direccion_clientes" id="direccion_clientes" value="<?php echo $resEdit->direccion_clientes; ?>" class="form-control" <?php echo $habilitar;?>/>
			  <div id="mensaje_direccion_clientes" class="errores"></div>
			  </div>
			  
		    </div>
		    
		    
		    <div class="row">
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultCiu as $res) {?>
						<option value="<?php echo $res->id_ciudad; ?>" <?php if ($res->id_ciudad == $resEdit->id_ciudad ) echo ' selected="selected" '  ; ?>  ><?php echo $res->nombre_ciudad; ?> </option>
						
			        <?php } ?>
				</select> 
			  </div>
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Persona</p>
			  	<select name="id_tipo_persona" id="id_tipo_persona"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultTipoPer as $res) {?>
						<option value="<?php echo $res->id_tipo_persona; ?>"  <?php if ($res->id_tipo_persona == $resEdit->id_tipo_persona ) echo ' selected="selected" '  ; ?>  ><?php echo $res->nombre_tipo_persona; ?> </option>
						
			        <?php } ?>
				</select> 
			  </div>
		    </div>
		    
			  
			  </div>
		    </div> 
          
          
		     <?php } } else {?>
		     
		    <div class="panel panel-default">
  			<div class="panel-body">
		    
		  <div class="row">
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Identificacion</p>
			  	<select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultTipoIdent as $resTipoIdent) {?>
						<option value="<?php echo $resTipoIdent->id_tipo_identificacion; ?>"  ><?php echo $resTipoIdent->nombre_tipo_identificacion; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Numero de Identificación</p>
			  	<input type="text"  name="identificacion_clientes" id="identificacion_clientes" value="" class="form-control" <?php echo $habilitar;?>/> 
			    <div id="mensaje_identificacion_clientes" class="errores"></div>
			  </div>
			   </div>
			   
			   
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombres </p>
			  	<input type="text" name="nombres_clientes" id="nombres_clientes" value="" class="form-control" <?php echo $habilitar;?>/>
			  <div id="mensaje_nombres_clientes" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Teléfono</p>
			  	<input type="text" name="telefono_clientes" id="telefono_clientes" value="" class="form-control" <?php echo $habilitar;?>/>
			  <div id="mensaje_telefono_clientes" class="errores"></div>
			  </div>
			  
		    </div>
		    
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Celular </p>
			  	<input type="text" name="celular_clientes" id="celular_clientes" value="" class="form-control" <?php echo $habilitar;?>/>
			  <div id="mensaje_celular_clientes" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Dirección</p>
			  	<input type="text" name="direccion_clientes" id="direccion_clientes" value="" class="form-control" <?php echo $habilitar;?>/>
			  <div id="mensaje_direccion_clientes" class="errores"></div>
			  </div>
			  
		    </div>
		    
		    
		    <div class="row">
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultCiu as $res) {?>
						<option value="<?php echo $res->id_ciudad; ?>"  ><?php echo $res->nombre_ciudad; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
		    
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Persona</p>
			  	<select name="id_tipo_persona" id="id_tipo_persona"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultTipoPer as $res) {?>
						<option value="<?php echo $res->id_tipo_persona; ?>"  ><?php echo $res->nombre_tipo_persona; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
			   </div>
			   
			  </div>
			   </div> 
		     	
		     <?php } ?>
		     
		     </div>
               	
		     
		     
		     <div class="col-lg-6">
         
        	    <h4 style="color:#ec971f; text-align: center;" >Registrar Llamada</h4>
            	<hr/> 	
               	
             <div class="panel panel-default">
  			 <div class="panel-body">
  			 
  		     <div class="row">
		     	 <div class="col-xs-6 col-md-6">
			  		<p  class="formulario-subtitulo" >Fecha</p>
			  		<input type="text" name="fecha_registrar_llamadas" id="fecha_registrar_llamadas" value="<?php $sdate=date("d")."/".date("m")."/".date("Y"); $stime=date("h").":".date("i"); echo "$sdate";?>" class="form-control" readonly/>
				 </div>
			  
				 <div class="col-xs-6 col-md-6">
			  	    <p  class="formulario-subtitulo" >Hora</p>
			  		<input type="text" name="hora_registrar_llamadas" id="hora_registrar_llamadas" value="<?php $sdate=date("d")."/".date("m")."/".date("Y"); $stime=date("h").":".date("i");  echo " $stime";?>" class="form-control" readonly/>
			 	</div>
			</div>
		    
		      <div class="row">
		     	 <div class="col-xs-6 col-md-6">
			  		<p  class="formulario-subtitulo" >Nombre Contesta LLamada</p>
			  		<input type="text" name="persona_contesta_llamada" id="persona_contesta_llamada" value="" class="form-control" <?php echo $habilitar;?>/>
				    <div id="mensaje_persona_contesta_llamada" class="errores"></div>
			     </div>
			  
				 <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Parentesco con Cliente</p>
			  	<select name="id_parentesco_clientes" id="id_parentesco_clientes"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultParent as $res) {?>
						<option value="<?php echo $res->id_parentesco_clientes; ?>"  ><?php echo $res->nombre_parentesco_clientes; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
			</div>
			
			
			<div class="row">
			<div class="col-xs-12 col-md-12" >
			  	<p  class="formulario-subtitulo" >Observaciones </p>
	          	<textarea  class="form-control" id="observaciones_registra_llamadas" name="observaciones_registra_llamadas" wrap="physical" rows="3"  onKeyDown="contador(this.form.observaciones_registra_llamadas,this.form.remLen,500);" onKeyUp="contador(this.form.observaciones_registra_llamadas,this.form.remLen,500);" <?php echo $habilitar;?>></textarea>
	          	<p  class="formulario-subtitulo" >Te quedan <input type="text" name="remLen" size="2" maxlength="2" value="500" readonly="readonly"> letras por escribir. </p>
	        		   
            </div>
			
			 </div>
			
             </div>
             </div>  	
               	
               	
             </div>
		     
		     
		     
		     
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php  echo $helper->url("RegistrarLlamadas","InsertaRegistrarLlamadas"); ?>'" value="Guardar" class="btn btn-success"/>
			  </div>
			</div>     
               
		
		 <hr>
          
          </form>
       
         <!-- termina el form -->
       
       
      </div>
   </div>
   <?php include("view/modulos/footer.php"); ?>
     </body>  
    </html>   