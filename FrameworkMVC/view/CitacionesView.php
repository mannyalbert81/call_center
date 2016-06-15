
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Citaciones - Coactiva 2016</title>
        
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
		   
		    	var nombre_oficios= $("#nombre_oficios").val();
		    
		   				
		    	if (nombre_oficios == "")
		    	{
			    	
		    		$("#mensaje_nombres").text("Introduzca Información para el Oficio");
		    		$("#mensaje_nombres").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
			}); 

				
				$( "#nombre_oficios" ).focus(function() {
					$("#mensaje_nombres").fadeOut("slow");
    			});
				
			 
				    
		}); 

	</script>
	
	<script>
    $(document).ready(function(){
        $("#marcar_todo").change(function () {
            if ($(this).is(':checked')) {
               
                $(".marcados").prop('checked', true); 
            } else {
                
                $("input:checkbox").prop('checked', false);
                $("input[type=checkbox]").prop('checked', false);
            }
        });
        });
    </script>
    
    <script >
$(document).ready(function() {
		
		$('#Guardar').click(function(){
	        var selected = '';  
	          
	        $('.marcados').each(function(){
	            if (this.checked) {
	                selected +=$(this)+' esta '+$(this).val()+', ';
	            }
	        }); 

	        if (selected != '') {
	            return true;
	        }
	        else{
	            alert('Debes seleccionar un juicio.');
	            return false;
	        }

	      
	    }); 

	});
	</script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
       $resultMenu=array(0=>"Todos",1=>"Identificacion",2=>"Juicio");
       
       
       $sel_id_ciudad="";
       $sel_fecha_citacion="";
       $sel_id_usuarios="";
       $sel_id_tipo_citaciones="";
       
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       
       	$sel_id_ciudad=$_POST['id_ciudad'];
       	$sel_fecha_citacion=$_POST['fecha_citacion'];
       	$sel_id_usuarios=$_POST['id_usuarios'];
       	$sel_id_tipo_citaciones=$_POST['id_tipo_citaciones'];
       }
       
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Citaciones","InsertaCitaciones"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
            
               
        	    
            	
		   		
            <div class="col-lg-5">
            
            <h4 style="color:#ec971f;">Insertar Citaciones </h4>
            	<hr/>
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
		     <?php } } else {?>
		    <div class="row">
		    <div class="col-xs-6 col-md-6">
			  <p  class="formulario-subtitulo" >Fecha de Citacion </p>
	          <input type="date" id="fecha_citaciones" name="fecha_citaciones" class="form-control" value="<?php echo $sel_fecha_citacion;?>">
		   	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
            	
		   	<div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
					<?php foreach($resultCiu as $resCiu) {?>
						<option value="<?php echo $resCiu->id_ciudad; ?>" <?php if($sel_id_ciudad==$resCiu->id_ciudad){echo "selected";}?> ><?php echo $resCiu->nombre_ciudad; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
			  </div>
			  
			  <div class="row">
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Tipo Boleta</p>
			  	<select name="id_tipo_citaciones" id="id_tipo_citaciones"  class="form-control" >
					<?php foreach($resultTipoCit as $res) {?>
						<option value="<?php echo $res->id_tipo_citaciones; ?>" <?php if($sel_id_tipo_citaciones==$res->id_tipo_citaciones){echo "selected";}?> ><?php echo $res->nombre_tipo_citaciones; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Citador Judicial</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultUsuarios as $res) {?>
						<option value="<?php echo $res->id_usuarios; ?>" <?php if($sel_id_usuarios==$res->id_usuarios){echo "selected";}?> ><?php echo $res->nombre_usuarios; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
			  </div>
			  
			  <div class="row">
		       <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombre Persona Recibe</p>
			  	<input type="text"  name="nombre_persona_recibe_citaciones" id="nombre_persona_recibe_citaciones" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  
			   <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Relacion con Cliente</p>
			  	<input type="text"  name="relacion_cliente_citaciones" id="relacion_cliente_citaciones" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			 </div>
			  
			  <hr>
		    
		   
               	
		     <?php } ?>
		     
		     
		       <div class="row">
			  <div class="col-xs-12 col-md-6" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
			  </div>
			</div>     
               
		
		 <hr>
          </div>
       
       
        <div class="col-lg-7">
            <h4 style="color:#ec971f;">Lista de Clientes - Jucios</h4>
            <hr/>
            <div class="col-xs-4">
			
           <input type="text"  name="contenido_busqueda" id="contenido_busqueda" value="" class="form-control"/>
           <div id="mensaje_contenido_busqueda" class="errores"></div>
            </div>
            
           <div class="col-xs-4">
           <select name="criterio_busqueda" id="criterio_busqueda"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" <?php //if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
           
           <div class="col-xs-4" >
		
			  	<input type="submit" id="buscar" name="buscar"  onclick="this.form.action='<?php echo $helper->url("Citaciones","index"); ?>'" value="buscar" class="btn btn-default"/>
			</div>
		<div class="col-xs-12" style="margin: 10px;">	

	</div>
	
	<div class="col-xs-12">
        
        <section class="col-lg-12 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"><input type="checkbox" id="marcar_todo" class="checkbox"> </th>
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Clientes</th>
	    		<th style="color:#456789;font-size:80%;">Juicio</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultDatos)) {  foreach($resultDatos as $res) {?>
	        		<tr>
	        		<th style="color:#456789;font-size:80%;"><input type="checkbox" id="id_juicios[]"   name="id_juicios[]"  value="<?php echo $res->id_juicios; ?>" class="marcados"></th>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_juicios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?>     </td> 
		              <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		              <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		             
		           	   
			            
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
      </div>
      </div>
       </form>
       <!-- termina el form --> 
      </div>
      </div>
     
   </body>  

    </html>   