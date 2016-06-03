<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Gastos - coactiva 2016</title>
        
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

			$("#Guardar").click(function()

			{

				var contenido = $("#contenido").val();
				var fecha_asignacion= $("#fecha_asignacion").val();

				if (contenido != "" && fecha_asignacion==0)
		    	{
					$("#mensaje_criterio").text("Seleccione una fecha");
		    		$("#mensaje_criterio").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_criterio").fadeOut("slow"); //Muestra mensaje de error
		    		
		            
				}    

				if (criterio !=0 && fecha_asignacion=="")
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
        
    
    		
			
	
    <script>
    $(document).ready(function(){
        $("#marcar_clientes").change(function () {
            if ($(this).is(':checked')) {
               
                $(".marcados_clientes").prop('checked', true); 
            } else {
                
               
                $("input[type=checkbox]").prop('checked', false);
            }
        });
        });
    </script>
    
    <script>
    $(document).ready(function(){
        $("#marcar_oficios").change(function () {
            if ($(this).is(':checked')) {
               
                $(".marcados_oficios").prop('checked', true); 
            } else {
                
             
                $("input[type=checkbox]").prop('checked', false);
            }
        });
        });
    </script>

    <script>
    $(document).ready(function(){
        
 		$("#buscar").click(function () {
             
             var fecha_asignacion = $("#fecha_asignacion").val();
             var contenido = $("#contenido_busqueda").val();
             if(fecha_asignacion!=0 && contenido==""){
          	   $("#mensaje_contenido").text("Ingrese contenido");
  	    	   $("#mensaje_contenido").fadeIn("slow"); //Muestra mensaje de error
                 return false;
                 }else if(fecha_asignacion==0 && contenido!=""){
               $("#mensaje_criterio").text("Selecione una busqueda");
        	   $("#mensaje_criterio").fadeIn("slow");
        	     return false;
                 }else{
                	 return true;
                     }
          });
          
          $( "#contenido_busqueda" ).focus(function() {
  			  $("#mensaje_contenido").fadeOut("slow");
  		    });
          $( "#fecha_asignacion" ).focus(function() {
  			  $("#mensaje_criterio").fadeOut("slow");
  		    });
        });

    </script>
    
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
     	$resultMenu_busqueda=array(0=>"Identificacion",1=>"Titulo Credito");
     	
     	
     	$sel_id_usuarioAgente = "";
     	$sel_id_usuarioImpulsor="";
     	$sel_id_entidades="";
     	$sel_fecha_asignacion="";
   
     		
     	if($_SERVER['REQUEST_METHOD']=='POST' )
     		{
     			$sel_id_usuarioAgente = $_POST['id_usuarioAgente'];
     			$sel_id_usuarioImpulsor=$_POST['id_usuarioImpulsor'];
     			$sel_id_entidades=$_POST['id_entidades'];
     			$sel_fecha_asignacion=$_POST['fecha_asignacion'];
     	
     		}
     	
     		 
     			
     	
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
     
      <form action="<?php echo $helper->url("Gastos","InsertaGastos"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
    
    <div class="col-lg-5">
    <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
           <?php //no hay datos para editar?>
        
            
		     <?php } } else {?>
		     
		 
		    <h4 style="color:#ec971f;">Gastos</h4>
            	<hr/>
            	 <div class="row" >
		   	<div class="col-xs-5" aling="center">
			  	<p  class="formulario-subtitulo" >Entidad</p>
			 	<select name="id_entidades" id="id_entidades"  class="form-control" >
			 	<option value="0">--SELECCIONE--</option>
					<?php foreach($resultEnti as $res) {?>
						<option value="<?php echo $res->id_entidades; ?>" <?php if($sel_id_entidades==$res->id_entidades){echo "selected";}?> ><?php echo $res->nombre_entidades; ?> </option>
			        <?php } ?>
				</select> 			  
			  </div>
			  </div>
			
	
		    
			  <div class="col-xs-12" style="text-align: center;" >
			  <p style="color:#ffffff;" >-----</p>
			
			  	<input type="submit" id="Guardar" name="Guardar" value="Guardar" class="btn btn-success"/>
			  </div>
			 
			<div class="col-xs-1"  style="width: 400px;">
			<hr>
			</div>
			 
      
             	
		     <?php } ?>
    </div>
    
    
    <div  class="col-lg-7">
     <h4 style="color:#ec971f;">Lista de Clientes - Juicios</h4>
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
		
			  	<input type="submit" id="buscar" name="buscar"  onclick="this.form.action='<?php echo $helper->url("Gastos","index"); ?>'" value="buscar" class="btn btn-default"/>
			</div>
		<div class="col-xs-12" style="margin: 10px;">	

	</div>
	<div class="col-xs-12">
      
      
        
       <section   style="height:150px;overflow-y:scroll;width: 655px;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><input type="checkbox" id="marcar_clientes" class="checkbox"> </th>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	            <th style="color:#456789;font-size:80%;">Nombres Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Juicio</th>
	    		
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		<th style="color:#456789;font-size:80%;"><input type="checkbox" id="id_clientes[]"   name="id_clientes[]"  value="<?php echo $res->id_clientes; ?>" class="marcados_clientes"></th>
	                 
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_clientes; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>  </td>
		               
		             
		              
		           	   <td>
			           		
			                <hr/>
		               </td>
		    		</tr>
		        <?php } } ?>
		        
      
        
            <?php 
          
            
            ?>
            
       	</table>     
		     
      </section>
        
        </div>
  
    
     <h4 style="color:#ec971f;">Lista de Oficios</h4>
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
		
			  	<input type="submit" id="buscar" name="buscar"  onclick="this.form.action='<?php echo $helper->url("Gastos","index"); ?>'" value="buscar" class="btn btn-default"/>
			</div>
		<div class="col-xs-12" style="margin: 10px;">	

	</div>
	<div class="col-xs-12">
      
      
        
       <section   style="height:150px;overflow-y:scroll;width: 655px;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><input type="checkbox" id="marcar_oficios" class="checkbox"> </th>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Numero de Oficios</th>
	    		
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultOfi)) {  foreach($resultOfi as $res) {?>
	        		<tr>
	        		<th style="color:#456789;font-size:80%;"><input type="checkbox" id="id_oficios[]"   name="id_oficios[]"  value="<?php echo $res->id_oficios; ?>" class="marcados_oficios"></th>
	                 
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_oficios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_oficios; ?>     </td> 
		               
		             
		              
		           	   <td>
			           		
			                <hr/>
		               </td>
		    		</tr>
		        <?php } } ?>
		        
      
        
            <?php 
          
            
            ?>
            
       	</table>     
		     
      </section>
        
        </div>
    </div>
    
    </form>
  

    </div>
   </div>
     </body>  
    </html>   