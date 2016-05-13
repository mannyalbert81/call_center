


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
		    	var cedula_usuario = $("#cedula_usuarios").val();
		    	var nombre_usuario = $("#nombre_usuarios").val();
		    	var usuario_usuario = $("#usuario_usuarios").val();
		    	var clave_usuario = $("#clave_usuarios").val();
		    	var cclave_usuario = $("#cclave_usuarios").val();
		    	var telefono_usuario = $("#telefono_usuarios").val();	
		    	var celular_usuario = $("#celular_usuarios").val();
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
		    	if (telefono_usuario == "" )
		    	{
			    	
		    		$("#mensaje_telefono").text("Ingrese un Teléfono");
		    		$("#mensaje_telefono").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_telefono").fadeOut("slow"); //Muestra mensaje de error
		            
				}

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
				$( "#telefono_usuarios" ).focus(function() {
					$("#mensaje_telefono").fadeOut("slow");
    			});
				$( "#celular_usuarios" ).focus(function() {
					$("#mensaje_celular").fadeOut("slow");
    			});
				
				$( "#correo_usuarios" ).focus(function() {
					$("#mensaje_correo").fadeOut("slow");
    			});
		
				
		
		      
				    
		}); 

	</script>
	
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
       
       /*
  		   $sel_id_usuario = "";
  		   $sel_nombre_usuario = "";
  		   $sel_usuario_usuario = "";
  		   $sel_telefono_usuario = "";
  		   $sel_celular_usuario = ""; 
  		   $sel_correo_usuario = ""; 
  		   $sel_id_rol = ""; 
  		   $sel_id_estado = "";
  		   $sel_cedula_usuario = "";
		   if ($nuevo_usuario)
		   {
		   	
		   }
		   else 
		   {
			   	if($_SERVER['REQUEST_METHOD']=='POST' )
			   	{
			   		//$sel_foto_fichas_fotos = $_FILES['foto_fichas_fotos'];
			   		
			   		$sel_id_usuario = $_POST['id_usuarios'];
			   		$sel_nombres_usuario = $_POST['nombre_usuarios'];
			   	    $sel_telefono_usuario = $_POST['telefono_usuarios'];
			   		$sel_celular_usuario = $_POST['celular_usuarios'];
			   		$sel_correo_usuario = $_POST['correo_usuarios'];
			   		$sel_id_rol = $_POST['roles'];
			   		$sel_id_estado = $_POST['estados'];
			   		$sel_cedula_usuario = $_POST['cedula_usuarios'];

			   	}
			   
			   	if($_SERVER['REQUEST_METHOD']=='GET' )
			   	{
			   		//$sel_foto_fichas_fotos = $_FILES['foto_fichas_fotos'];
			   		if ($resultEdit !="" ) {
			   			
			   		}
			   		else 
			   		{
				   		$sel_id_usuario = $_GET['id_usuarios'];
				   		$sel_nombre_usuario = $_GET['nombres_usuarios'];
				   		$sel_telefono_usuario = $_GET['telefono_usuarios'];
				   		$sel_celular_usuario = $_GET['celular_usuarios'];
				   		$sel_correo_usuario = $_GET['correo_usuarios'];
				   		$sel_id_rol = $_GET['roles'];
				   		$sel_id_estado = $_GET['estados'];
				   		$sel_cedula_usuario = $_GET['cedula_usuarios'];
			   		}
			   		
			   	}
			
		   }
		   
		   
		   		*/
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
  <div></div>
    
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
			  <div id="mensaje_telefono" class="errores"></div>
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
			  <div id="mensaje_telefono" class="errores"></div>
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
			</div>
		    <hr>
		    
		   
               	
		     <?php } ?>
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
			  </div>
			</div>     
               
		
		 <hr>
          
          </form>
       <!-- termina el form --> 
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Usuarios</h4>
            <!-- empieza formulario de busqueda -->
        <div class="row">
           <form action="<?php echo $helper->url("Usuarios","Index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
           
           <div class="col-lg-4">
           <input type="text"  name="usuario_usuarios" id="usuario_usuarios" value="" class="form-control"/>
            </div>
           <div class="col-lg-4">
           <select name="id_rol" id="id_rol"  class="form-control">
									<?php foreach($resultMenu as $val=>$desc) {?>
				 						<option value="<?php echo $val ?>" <?php //if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $desc ?> </option>
						            <?php } ?>
								    	
									</select>
		   </div>
           <div class="col-lg-4">
           <input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-success"/>
           </div>
         
          </form>
           <!-- termina formulario de busqueda -->
        <hr/>
      
       <section class="col-lg-12  usuario" style="height:500px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
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
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_usuarios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuarios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->usuario_usuarios; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->correo_usuarios; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_rol; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_estado; ?>  </td>
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Usuarios","index"); ?>&id_usuarios=<?php echo $res->id_usuarios; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Usuarios","borrarId"); ?>&id_usuarios=<?php echo $res->id_usuarios; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
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
      </div>
   </div>
     </body>  
    </html>   