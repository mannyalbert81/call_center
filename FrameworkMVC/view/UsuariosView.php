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
				alertify.success("Has Pulsado en Buscar"); 
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
	
	      <script>
	      $(document).ready(function(){

	    	 

	             $("#cedula_usuarios").keypress(function(){

	                 var cedula=$("#cedula_usuarios").val();
	                 

	                 
	                 if(cedula.length == 10)
	                 {
		                 
		                 //return true;  @Author :  REFERENCIADO Victor Diaz De La Gasca.
	                	 var digito_region = cedula.substring(0,2);
	                	 
	                     //Pregunto si la region existe ecuador se divide en 24 regiones
							if( digito_region >= 1 && digito_region <=24 )
							{
								// Extraigo el ultimo digito
							   var ultimo_digito   = cedula.substring(9,10);
							   
							   //Agrupo todos los pares y los sumo
							   var pares = parseInt(cedula.substring(1,2)) + parseInt(cedula.substring(3,4)) + parseInt(cedula.substring(5,6)) + parseInt(cedula.substring(7,8));

							   //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
							   var numero1 = cedula.substring(0,1);
							   var numero1 = (numero1 * 2);
							   if( numero1 > 9 ){ var numero1 = (numero1 - 9);} 

							   var numero3 = cedula.substring(2,3);
							   var numero3 = (numero3 * 2);
							   if( numero3 > 9 ){ var numero3 = (numero3 - 9); } 

							   var numero5 = cedula.substring(4,5);
							   var numero5 = (numero5 * 2);
							   if( numero5 > 9 ){ var numero5 = (numero5 - 9); }

							   var numero7 = cedula.substring(6,7);
							   var numero7 = (numero7 * 2);
							   if( numero7 > 9 ){ var numero7 = (numero7 - 9); }

							   var numero9 = cedula.substring(8,9);
							   var numero9 = (numero9 * 2);
							   if( numero9 > 9 ){ var numero9 = (numero9 - 9); } 

							   var impares = numero1 + numero3 + numero5 + numero7 + numero9;

							   //Suma total
							   var suma_total = (pares + impares);
							   
							   //extraemos el primero digito
							   var primer_digito_suma = String(suma_total).substring(0,1);

							   //Obtenemos la decena inmediata
							   var decena = (parseInt(primer_digito_suma) + 1)  * 10;
							   
							   //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
							   var digito_validador = decena - suma_total;
							   
							   //Si el digito validador es = a 10 toma el valor de 0
							   if(digito_validador == 10)
								 var digito_validador = 0;

							   //Validamos que el digito validador sea igual al de la cedula
							   if(digito_validador == ultimo_digito){
								   $('input[name="Guardar"]').removeAttr('disabled');
								   $("#mensaje_cedula").fadeOut("slow"); //Muestra mensaje de error
								 return true;
								
								 
							   }else{

								   $('input[name="Guardar"]').attr('disabled','disabled');
		  
								    $("#mensaje_cedula").text("Cedula es incorrecta");
						    		$("#mensaje_cedula").fadeIn("slow"); //Muestra mensaje de error
						    		
						            
							   }
							   
							 }else{
							   // imprimimos en consola si la region no pertenece
							   console.log('Esta cedula no pertenece a ninguna region');
							 }


	                 }else 
		                 {
		                	 $("#mensaje_cedula").fadeOut("slow"); //Muestra mensaje de error
		                     return true;
		                 }
	                  


	                 });

                 $("#cedula_usuarios").change(function(){

					var cedula=$("#cedula_usuarios").val();

	                 
	                 if(cedula.length < 10)
	                 {
	                	 $("#mensaje_cedula").text("Cedula es incorrecta");
				    		$("#mensaje_cedula").fadeIn("slow"); //Muestra mensaje de error
				    		 $('input[name="Guardar"]').attr('disabled','disabled');
				    		 
	                 }


                     });

	             $( "#cedula_usuarios" ).focus(function() {
		             return true;
					  $("#mensaje_cedula").fadeOut("slow");
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
       
      <form action="<?php echo $helper->url("Usuarios","InsertaUsuarios"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            
         
        	    <h4 style="color:#ec971f;">Insertar Usuarios</h4>
            	<hr/>
            	
		   		
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
            
            
            <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Cedula</p>
			  	<input type="text"  name="cedula_usuarios" id="cedula_usuarios" value="<?php echo $resEdit->cedula_usuarios; ?>" class="form-control"/> 
			    <div id="mensaje_cedula" class="errores"></div>
			  </div>
			   </div>
			   
			   <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombres Usuario</p>
			  	<input type="text"  name="nombre_usuarios" id="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuario</p>
			  	<input type="text"  name="usuario_usuarios" id="usuario_usuarios" value="<?php echo $resEdit->usuario_usuarios; ?>" class="form-control"/> 
			    <div id="mensaje_usuario" class="errores"></div>
			  </div>
			   </div>
		    
		    <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p class="formulario-subtitulo" >Clave Usuario </p>
			  	<input type="password" name="clave_usuarios" id="clave_usuarios" value="" class="form-control"/>
			 	<div id="mensaje_clave" class="errores"></div>
			 	</div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Confirme Clave </p>
			  	<input type="password" name="cclave_usuarios" id="cclave_usuarios" value="" class="form-control"/>
			  	 <div id="mensaje_cclave" class="errores"></div>
			  	 </div>
			  </div>
		    
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Teléfono Usuario </p>
			  	<input type="text" name="telefono_usuarios" id="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>" class="form-control"/>
			  
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Celular  Usuario</p>
			  	<input type="text" name="celular_usuarios" id="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>" class="form-control"/> 
			  <div id="mensaje_celular" class="errores"></div>
			  </div>
		    </div>
		    
		    
		    <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Correo </p>
			  	<input type="email"  name="correo_usuarios" id="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>" class="form-control" />
				
				<div id="mensaje_correo" class="errores"></div>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Roles</p>
			  	<select name="id_rol" id="id_rol"  class="form-control" >
					<?php foreach($resultRol as $resRol) {?>
					<option value="<?php echo $resRol->id_rol; ?>" <?php if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $resRol->nombre_rol; ?> </option>
						            
						<?php } ?>
				</select> 
			  </div>
		      </div>
		      
		      <div class="row">
			    
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Estados</p>
			  	<select name="estados" id="estados"  class="form-control" >
					<?php foreach($resultEst as $resEst) {?>
						<option value="<?php echo $resEst->id_estado; ?>" <?php if ($resEst->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $resEst->nombre_estado; ?> </option>
						           
			        <?php } ?>
				</select> 			  
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
			  	<p  class="formulario-subtitulo" >Foto</p>
			  	<input type="file" name="imagen_usuarios" id="imagen_usuarios" value="" class="form-control" /> 
			  
			  </div>
			  
			</div>
		 <hr>
            
            
		     <?php } } else {?>
		    
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Cedula</p>
			  	<input type="text"  name="cedula_usuarios" id="cedula_usuarios" value="" class="form-control"/> 
			    <div id="mensaje_cedula" class="errores"></div>
			  </div>
			   </div>
			   
			   <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombres Usuario</p>
			  	<input type="text"  name="nombre_usuarios" id="nombre_usuarios" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Usuario</p>
			  	<input type="text"  name="usuario_usuarios" id="usuario_usuarios" value="" class="form-control"/> 
			    <div id="mensaje_usuario" class="errores"></div>
			  </div>
			   </div>
		    
		    <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p class="formulario-subtitulo" >Clave Usuario </p>
			  	<input type="password" name="clave_usuarios" id="clave_usuarios" value="" class="form-control"/>
			 	<div id="mensaje_clave" class="errores"></div>
			 	</div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Confirme Clave </p>
			  	<input type="password" name="cclave_usuarios" id="cclave_usuarios" value="" class="form-control"/>
			  	 <div id="mensaje_cclave" class="errores"></div>
			  	 </div>
			  </div>
		    
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Teléfono Usuario </p>
			  	<input type="text" name="telefono_usuarios" id="telefono_usuarios" value="" class="form-control"/>
			  
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Celular  Usuario</p>
			  	<input type="text" name="celular_usuarios" id="celular_usuarios" value="" class="form-control"/> 
			  <div id="mensaje_celular" class="errores"></div>
			  </div>
		    </div>
		    
		    
		    <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Correo </p>
			  	<input type="email"  name="correo_usuarios" id="correo_usuarios" value="" class="form-control" />
			    <div id="mensaje_correo" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Roles</p>
			  	<select name="id_rol" id="id_rol"  class="form-control" >
					<?php foreach($resultRol as $resRol) {?>
						<option value="<?php echo $resRol->id_rol; ?>"  ><?php echo $resRol->nombre_rol; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
		      </div>
		      
		      <div class="row">
			    
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Estados</p>
			  	<select name="estados" id="estados"  class="form-control" >
					<?php foreach($resultEst as $resEst) {?>
						<option value="<?php echo $resEst->id_estado; ?>"  ><?php echo $resEst->nombre_estado; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
			  
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
					<?php foreach($resultCiu as $resCiu) {?>
						<option value="<?php echo $resCiu->id_ciudad; ?>"  ><?php echo $resCiu->nombre_ciudad; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
			  
			  
			</div>
			
			<div class="row">
			
               <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Foto</p>
			  	
			  	<input type="file" name="imagen_usuarios" id="imagen_usuarios" value="" class="form-control"/> 
			  </div>
			  
			</div>
		    <hr>
		    
		   
               	
		     <?php } ?>
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" value="Guardar" onClick="Ok()" class="btn btn-success"/>
			  </div>
			</div>     
               
		
		 <hr>
          
          </form>
       
         <!-- termina el form -->
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Usuarios</h4>
           
     <!-- empieza formulario de busqueda -->
     
            <hr>
        <div class="row">
           <form action="<?php echo $helper->url("Usuarios","Index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
           
           <div class="col-lg-4">
           <input type="text"  name="contenido" id="contenido" value="" class="form-control"/>
           <div id="mensaje_contenido" class="errores"></div>
            </div>
            
           <div class="col-lg-4">
           <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" <?php //if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
          
           
          
           <div class="col-lg-2">
           <input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-default"/>
           </div>
           
         
          </form>
          
       <!-- termina formulario de busqueda -->
        <hr/>
         
       <section class="col-lg-12  usuario" style="height:450px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"></th>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Nombre</th>
	    		<th style="color:#456789;font-size:80%;">Usuario</th>
	    		<th style="color:#456789;font-size:80%;">Correo</th>
	    		<th style="color:#456789;font-size:80%;">Rol</th>
	    		<th style="color:#456789;font-size:80%;">Estado</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		   <td> <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $res->id_usuarios; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $res->id_usuarios; ?>" width="80" height="60" >      </td>
		              <td style="color:#000000;font-size:80%;"> <?php echo $res->id_usuarios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuarios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->usuario_usuarios; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->correo_usuarios; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_rol; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_estado; ?>  </td>
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Usuarios","index"); ?>&id_usuarios=<?php echo $res->id_usuarios; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Usuarios","borrarId"); ?>&id_usuarios=<?php echo $res->id_usuarios; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
			           </td>
		               <td>   
			                	<div class="right">
			                	<a href="/FrameworkMVC/view/ireports/ContUsuariosSubReport.php?id_usuarios=<?php echo $res->id_usuarios; ?>"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"; class="btn btn-success" style="font-size:65%;">Reporte</a>
			                 </div>
			               <hr/>
		               </td>
		    		</tr>
		        <?php } }else{ ?>
            <tr>
            <td></td>
            <td></td>
	                   <td colspan="5" style="color:#ec971f;font-size:8;"> <?php echo '<span id="snResult">No existen resultados</span>' ?></td>
	        <td></td>
		               
		    		</tr>
            <?php 
		}
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
		     
      </section>
        
        </div>
       
       
      
      </div>
      </div>
   </div>
     </body>  
    </html>   