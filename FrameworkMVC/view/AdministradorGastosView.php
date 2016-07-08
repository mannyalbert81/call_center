<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Administrador Gastos - aDocument 2015</title>
        
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

		    // cada vez que se cambia el valor del combo
		    $("#Guardar").click(function() 
			{
		   
		    	var nombre_administrador_gastos= $("#nombre_administrador_gastos").val();
		    
		   				
		    	if (nombre_administrador_gastos== "")
		    	{
			    	
		    		$("#mensaje_busqueda").text("Introduzca un nombre");
		    		$("#mensaje_busqueda").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_busqueda").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#nombre_administrador_gastos" ).focus(function() {
					$("#mensaje_busqueda").fadeOut("slow");
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
  
  
      <form action="<?php echo $helper->url("AdministradorGastos","InsertaAdministradorGastos"); ?>" method="post" class="col-lg-6">
            <h4 style="color:#ec971f;">Insertar Administrador Gastos</h4>
            <hr/>
            	
            		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	       <div class="row">
			    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo administrador de gastos</p>
			  	<select name="id_tipo_gastos" id="id_tipo_gastos"  class="form-control" >
					<?php foreach($resultTipoGastos as $res) {?>
						<option value="<?php echo $res->id_tipo_gastos; ?>" <?php if ($res->id_tipo_gastos == $resEdit->id_tipo_gastos )  echo  ' selected="selected" '  ;  ?> ><?php echo $res->nombre_tipo_gastos; ?> </option><?php } ?>
				</select> 			  
			  </div>
			  </div>
		    
		    <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombre Administrador de Gastos</p>
			  	<input type="text" name="nombre_administrador_gastos" id="nombre_administrador_gastos" value="<?php echo $resEdit->nombre_administrador_gastos; ?>" class="form-control"/> 
			  <div id="mensaje_busqueda" class="errores"></div>
			  </div>
		    </div>
		   
	     	<div class="row">
	     	<div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >estado</p>
		   		   		<select name="estado" id="estado"  class="form-control">
										<option value="TRUE"  <?php  if ( $resEdit->estado =='t')  echo ' selected="selected" ' ; ?> >ACTIVO </option>
						            	<option value="FALSE" <?php  if ( $resEdit->estado =='f')  echo ' selected="selected" ' ; ?>  >INACTIVO </option>
					    </select>
		   		   		  </div>
		   		   		   </div>
	     	<hr>
	            	  
            
		     <?php } } 
		     else {?>
		    
		<div class="row">
			    
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Administrador Gastos</p>
			  	<select name="id_tipo_gastos" id="id_tipo_gastos"  class="form-control" >
					<?php foreach($resultTipoGastos as $res) {?>
						<option value="<?php echo $res->id_tipo_gastos; ?>"  ><?php echo $res->nombre_tipo_gastos; ?>  </option>
						          
			        <?php } ?>
				</select> 			  
			  </div>
		    </div>
		    
		    <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombre Administrador Gastos</p>
			  	<input type="text" name="nombre_administrador_gastos" id="nombre_administrador_gastos" value="" class="form-control"/> 
			  <div id="mensaje_busqueda" class="errores"></div>
			  </div>
		    </div>
		   
		   <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Estado</p>
		   		   		<select name="estado" id="estado"  class="form-control">
										<option value="TRUE"  >ACTIVO </option>
						            	<option value="FALSE"  >INACTIVO </option>
					    </select>
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
            <h4 style="color:#ec971f;">Admimistrador de Gastos</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Nombre</th>
	    		<th style="color:#456789;font-size:80%;">Estado</th>
	    	</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   
	                   <td style="color:#000000;font-size:80%;" > <?php echo $res->id_tipo_gastos; ?>     </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_administrador_gastos; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->estado; ?>  
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("AdministradorGastos","index"); ?>&id_administrador_gastos=<?php echo $res->id_administrador_gastos; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("AdministradorGastos","borrarId"); ?>&id_administrador_gastos=<?php echo $res->id_administrador_gastos; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
			                
			                <hr/>
		               </td>
		    		</tr>
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
