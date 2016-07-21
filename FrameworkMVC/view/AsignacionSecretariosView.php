<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Asignacion Secretarios - coactiva 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 		
 		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
   
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
				alertify.success("Has Pulsado en Reasignar"); 
				return false; 
			}
		</script>
		
		
		
		<!-- TERMINA NOTIFICAIONES -->
  
  <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#ciudad").change(function() {
				
               // 
                var $usuarios = $("#usuarios");

               // lo vaciamos
               
				///obtengo el id seleccionado
				

               var id_ciudad = $(this).val();


               $usuarios.empty();

               
               if(id_ciudad > 0)
               {
            	   
            	   var datos = {
            			   id_ciudad : $(this).val()
                   };

            	   $usuarios.append("<option value= " +"0" +" > --SIN ESPECIFICAR--</option>");
            	           
                   
                  
            	   $.post("<?php echo $helper->url("AsignacionSecretarios","devuelveUsuarios"); ?>", datos, function(resultUsu) {

            		 		$.each(resultUsu, function(index, value) {
            		 			$usuarios.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }
               else
               {
            	  
               }
               
		    });


		   
		   
		    
		}); 

	</script>
  
  
  
  
  
	<script>
        
       $(document).ready(function(){

        

		    // cada vez que se cambia el valor del combo1 o busqueda
		    $("#ddl_busqueda").change(function() {

               // obtenemos el combo de resultado combo 2
              var $ddl_resultado = $("#ddl_resultado");

               // lo vaciamos
              var ddl_busqueda = $(this).val();


               $ddl_resultado.empty();

              
           
               if(ddl_busqueda == 1)
               {
            	   $ddl_resultado.append("<option value= " +"0" +" > --Secretarios--</option>");
            	   
            	   var datos = {
                    	   
            			   ddl_busqueda:$(this).val()
                   };


            	   $.post("<?php echo $helper->url("AsignacionSecretarios","returnSecretarios"); ?>", datos, function(resultUsuarioSecretario) {

            		 		$.each(resultUsuarioSecretario, function(index, value) {
               		 	    $ddl_resultado.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }else if(ddl_busqueda == 2)

                   {
                   
            	   $ddl_resultado.append("<option value= " +"0" +" > --Abg Impulsores--</option>");
            	   
            	   var datos = {
                    	   
            			   ddl_busqueda:$(this).val()
                   };


            	   $.post("<?php echo $helper->url("AsignacionSecretarios","returnImpulsores"); ?>", datos, function(resultUsuarioImpulsor) {

            		 		$.each(resultUsuarioImpulsor, function(index, value) {
               		 	    $ddl_resultado.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }
               else
               {
                   
            	   $ddl_resultado.empty();

               }
               
		    });
    
		}); 

	</script>
	
	<!-- script para ddl ciudad -->
	<script>
	$(document).ready(function(){
		$("#id_ciudad").change(function(){

            // obtenemos el combo de resultado combo 2
           var $ddl_secretario = $("#id_usuarioSecretario");
       	

            // lo vaciamos
           var ddl_ciudad = $(this).val();

          
            $ddl_secretario.empty();

          
            if(ddl_ciudad != 0)
            {
            	
            	 var datos = {
                   	   
           			   ciudad:$(this).val()
                  };
             
            	


         	   $.post("<?php echo $helper->url("AsignacionSecretarios","returnSecretariosbyciudad"); ?>", datos, function(resultUsuarioSecretarioC) {

         		 		$.each(resultUsuarioSecretarioC, function(index, value) {
            		 	    $ddl_secretario.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
                    		 });

         		 		 	 		   
         		  }, 'json');


            }
            else
            {
                
         	   $ddl_resultado.empty();

            }
		//alert("hola;");
		});

		$("#id_ciudad").change(function(){

            // obtenemos el combo de resultado combo 2
           var $ddl_impulsor = $("#id_usuarioImpulsor");
       	

            // lo vaciamos
           var ddl_ciudad = $(this).val();

          
            $ddl_impulsor.empty();

          
            if(ddl_ciudad != 0)
            {
            	
            	 var datos = {
                   	   
           			   ciudad:$(this).val()
                  };
             
            	


         	   $.post("<?php echo $helper->url("AsignacionSecretarios","returnImpulsorbyciudad"); ?>", datos, function(resultUsuarioImpulC) {

         		 		$.each(resultUsuarioImpulC, function(index, value) {
            		 	    $ddl_impulsor.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
                    		 });

         		 		 	 		   
         		  }, 'json');


            }
            else
            {
                
         	   $ddl_impulsor.empty();

            }
		
		});
		});
	
	</script>
	
	<script>
	$(document).ready(function(){
	
		$("#Guardar").click(function(){

			var $id_impulsor=$("#id_usuarioImpulsor");

			if($id_impulsor.val()!="")
			{
				var datos = {id_abgImpulsor:$id_impulsor.val()};

				  
				$.post("<?php echo $helper->url("AsignacionSecretarios","CompruebaImpulsores"); ?>",datos, function(ressultAsg) 
						{
					
						 	 		   
			       		}, 'json');
			
			}
			 
			
	});
	});
    </script>
	
	<script>
        
       $(document).ready(function(){

    	   $("#Buscar").click(function()

    				{

    					var contenido = $("#ddl_busqueda").val();
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
 	 

	</script>
	
	
	
      <script>
        
       $(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#id_controladores").change(function() {

               // obtenemos el combo de subcategorias
                var $id_acciones = $("#id_acciones");
               // lo vaciamos
               
				///obtengo el id seleccionado
				

               var id_controladores = $(this).val();


               $id_acciones.empty();

               $id_acciones.append("<option value= " +"0" +" > --TODOS--</option>");
           
               if(id_controladores > 0)
               {
            	   var datos = {
            			   id_controladores : $(this).val()
                   };


            	   $.post("<?php echo $helper->url("PermisosRoles","devuelveAcciones"); ?>", datos, function(resultAcc) {

            		 		$.each(resultAcc, function(index, value) {
               		 	    $id_acciones.append("<option value= " +value.id_acciones +" >" + value.nombre_acciones  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }
               else
               {
            	   $.post("<?php echo $helper->url("PermisosRoles","devuelveAllAcciones"); ?>", datos, function(resultAcc) {

   		 		        $.each(resultAcc, function(index, value) {
          		 	    $id_acciones.append("<option value= " +value.id_acciones +" >" + value.nombre_acciones  + "</option>");	
                	  });
     		  		}, 'json');

               }
               
		    });
    
		}); 

	</script>
		
	<script>

		$(document).ready(function(){

			$("#id_acciones").change(function() {

	               // obtenemos el combo de categorias
	                var $id_controladores = $("#id_controladores");
	               
					///obtengo el id seleccionado
					var id_acciones = $(this).val();

	               if(id_acciones > 0)

	               {
	            	   var datos = {
	            			   id_acciones : $(this).val()
	                   };


	            	   //$categorias.append("<option value= " +"0" +" >"+ id_subcategorias  +"</option>");
	                   $.post("<?php echo $helper->url("PermisosRoles","devuelveSubByAcciones"); ?>", datos, function(resultAcc) {
	            		   
         		 		  $.each(resultAcc, function(index, value) {
         		 			$('#id_controladores').val( value.id_controladores );//To select Blue	 
 								
							 });

         		 		 	 		   
         		  		}, 'json');
	                   
	               }
	               else
	               {

	          		 $('#controladres').val( 0 );//To select Blue

			        }
	               
	               
			    });
		}); 

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
    </head>
    
    
   <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
  <div></div>
       
      <form action="<?php echo $helper->url("AsignacionSecretarios","InsertaAsignacionSecretarios"); ?>" method="post" class="col-lg-4">
            <h4 style="color:#ec971f;">Insertar Asignacion Secretarios</h4>
            <hr/>
            	
		   		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	            	
	            	<div class="row">
	            	<div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
			  	
					<?php foreach($resultCiu as $resCiu) {?>
						<option value="<?php echo $resCiu->id_ciudad; ?>"  <?php //if ($resCiu->id_ciudad == $resEdit->id_ciudad ) echo ' selected="selected" '  ; ?> ><?php echo $resCiu->nombre_ciudad; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
	            	 </div>
	            	
	            	<div class="row">
	            	<input type="hidden" id="id_asignacion_secretarios_hidden" name="id_asignacion_secretarios_hidden" value="<?php echo $resEdit->id_asignacion_secretarios ?>">
	            	<div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	Nombre Secretario: <select name="id_usuarioSecretario" id="id_usuarioSecretario"  class="form-control">
									<?php foreach($resultUsuarioSecretario as $resSecretario) {?>
				 						<option value="<?php echo $resSecretario->id_usuarios; ?>" <?php if ($resSecretario->id_usuarios == $resEdit->id_secretario )  echo  ' selected="selected" '  ;  ?> ><?php echo $resSecretario->nombre_usuarios; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   </div>
		   		   <div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	 Nombre Abogado Impulsor: <select name="id_usuarioImpulsor" id="id_usuarioImpulsor"  class="form-control">
									<?php foreach($resultEdit as $resEdit) {?>
				 						<option value="<?php echo $resEdit->id_abogado; ?>" <?php if ($resEdit->id_asignacion_secretarios == $resEdit->id_asignacion_secretarios )  echo  ' selected="selected" '  ;  ?> ><?php echo $resEdit->impulsadores; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   
		   		    </div>
	            	</div>
		   		   
		   		   <hr>
		    
		     <?php } } else {?>
		    
		    <div class="row">
		    
		    
		    <div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	Cuidad: <select name="id_ciudad" id="id_ciudad"  class="form-control">
	            			        <option value="0">--Seleccione--</option>
									<?php foreach($resultCiu as $resCiudad) {?>
									<option value="<?php echo $resCiudad->id_ciudad; ?>" ><?php echo $resCiudad->nombre_ciudad; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   </div>
		   		   <hr>
		    
		   
		    
		      </div>
		    
		    
	            	<div class="row">
	            	
	            	<div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	Nombre Secretario: <select name="id_usuarioSecretario" id="id_usuarioSecretario"  class="form-control">
									<?php foreach($resultUsuarioSecretario as $resSecretario) {?>
				 						<option value="<?php echo $resSecretario->id_usuarios; ?>" ><?php echo $resSecretario->nombre_usuarios; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   </div>
		   		   <div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	 Nombre Abogado Impulsor: <select name="id_usuarioImpulsor" id="id_usuarioImpulsor"  class="form-control">
									<?php foreach($resultUsuarioImpulsor as $resImpulsor) {?>
				 						<option value="<?php echo $resImpulsor->id_usuarios; ?>"  ><?php echo $resImpulsor->nombre_usuarios; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   
		    	    </div>
	            	</div>
		        <hr>
		     <?php } ?>
		        
		        <div class="row" >
 				<div class="col-xs-12 col-md-12" style="text-align: center; margin-bottom: 20px;" >
           			<span id="msg_impulsor" Style="Display:none; color:#d93e1b;">ABOGADO IMPULSOR YA SE ENCUENTRA ASIGNADO</span>
           		</div>
           		
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
           <input type="submit" id="Guardar" name="Guardar" value="Guardar" onClick="Ok()" class="btn btn-success"/>
           </div>
           </div>
          </form>
       
       
        <div class="col-lg-8">
            <h4 style="color:#ec971f;">Asignacion Secretarios</h4>
           
             <!-- empieza formulario de busqueda -->
     
            <hr>
        <div class="row">
           <form action="<?php echo $helper->url("AsignacionSecretarios","Index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
           
          
            
            <div class="col-lg-4">
           <select name="ddl_busqueda" id="ddl_busqueda"  class="form-control">
                                    <?php foreach($resultAsignacion as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" ><?php echo $desc ?> </option>
                                    <?php } ?>
                                    </select>
           <div id="mensaje_ddl_busqueda" class="errores"></div>
           </div>
                                        
            
           <div class="col-lg-4">
           <select name="ddl_resultado" id="ddl_resultado"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" <?php //if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_ddl_resultado" class="errores"></div>
           </div>
          
           
          
           <div class="col-lg-4">
           <input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-default"/>
           </div>
         
          </form>
          
       <!-- termina formulario de busqueda -->
       
        <hr/>
        </div>
           
        </div>
        <section class="col-lg-8 usuario" style="height:400px;overflow-y:scroll; margin-top: 10px;">
       
        <table class="table table-hover">
	         <tr>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Secretario</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Abogado Impulsor</th>
	    			    		<th></th>
	    		<th></th>
	  		</tr>
	  							
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res-> id_asignacion_secretarios; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->secretarios; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res-> impulsadores; ?>     </td> 
		               
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("AsignacionSecretarios","index"); ?>&id_asignacion_secretarios=<?php echo $res->id_asignacion_secretarios ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Reasignar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("AsignacionSecretarios","borrarId"); ?>&id_asignacion_secretarios=<?php echo $res->id_asignacion_secretarios; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
	
		               </td>
		               <td>
	                         <div class="right">
			                	<a href="/FrameworkMVC/view/ireports/ContAsignacionSecretariosSubReport.php?id_asignacion_secretarios=<?php echo $res->id_asignacion_secretarios; ?>"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"; class="btn btn-success" style="font-size:65%;">Reporte</a>
			                 </div>
			           
		               </td>
		    		</tr>	    
		        <?php } }else{	  ?>
		        
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
       
     </body>  
    </html>   