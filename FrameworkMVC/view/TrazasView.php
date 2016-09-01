<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Actividades - CallCenter 2016</title>
        
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
        	
        	
	<script>
	$(document).ready(function(){

		//alert("hola");
		$("#div_ddl_accion").hide();

		$("#ddl_criterio").change(function(){

			var ddl_criterio=$(this).val();

			if(ddl_criterio==3){
				//alert("hola");
				$("#div_ddl_accion").show();
				$("#div_contenido").hide();
				}else{
					$("#div_ddl_accion").hide();
					$("#div_contenido").show();
					}

			});
		
		});

		</script>
		
		<script>
		$(document).ready(function(){
			$("#Buscar").click(function(){
				//alert("hola");
				 var startDate = new Date($('#fecha_desde').val());

                 var endDate = new Date($('#fecha_hasta').val());

                 var inicio = $('#fecha_desde').val();

                 var fin = $('#fecha_hasta').val();

                 if(inicio=="" || fin==""){
                     alert("ingrese fechas de busqueda");
                	 return false;
                 }
                 
                 });
			});
		</script>
        
		
		<script>
		$(document).ready(function(){

	       $("#fecha_hasta").change(function() {

                var startDate = new Date($('#fecha_desde').val());

                 var endDate = new Date($('#fecha_hasta').val());

                 if (startDate > endDate){
 
                    $("#mensaje_hasta").text("Fecha desde no debe ser mayor ");
		    		$("#mensaje_hasta").fadeIn("slow"); //Muestra mensaje de error  
		    		$("#fecha_hasta").val("");

                        }

               });

	       $( "#fecha_hasta" ).focus(function() {
				  $("#mensaje_hasta").fadeOut("slow");
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
       
       
       
       <?php
       
       $acciones=array(0=>"GUARDAR",1=>"EDITAR",2=>"ELIMINAR");
      // $resultActi=array(id_trazas=>"");
       
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
   <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Actividades</h4>
            
        </div>
    <!-- empieza formulario de busqueda -->
     
           
     <div class="col-lg-12" style="margin-bottom: 10px;"> 
     <div class="row">  
      
           <form action="<?php echo $helper->url("Trazas","Index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
     
      		<div class="col-lg-3" id="div_desde">
      		<span>Desde:</span>
           <input type="date"  name="fecha_desde" id="fecha_desde" value="" class="form-control"/>
           <div id="mensaje_desde" class="errores"></div>
           </div>
           <div class="col-lg-3" id="div_hasta">
           <span>Hasta:</span>
           <input type="date"  name="fecha_hasta" id="fecha_hasta" value="" class="form-control"/>
           <div id="mensaje_hasta" class="errores"></div>
           </div>
           <div class="col-lg-2" id="div_contenido">
           <span>Contenido de busqueda:</span>
           <input type="text"  name="contenido" id="contenido" value="" class="form-control"/>
           <div id="mensaje_contenido" class="errores"></div>
            </div>
            
           <div class="col-lg-2" id="div_ddl_accion">
           <span>Accion:</span>
           <select name="ddl_accion" id="ddl_accion"  class="form-control">
                                    <?php foreach($acciones as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>"><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_ddl_accion" class="errores"></div>
           </div>
            
           <div class="col-lg-2" id="div_ddl_criterio">
           <span>Criterio:</span>
           <select name="ddl_criterio" id="ddl_criterio"  class="form-control">
                                    <?php foreach($resulMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>"><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
          
           
          
           <div class="col-lg-1">
           <span style="color:#ffffff;">Buscar:</span>
           <input type="submit" id="Buscar" name="Buscar" value="Buscar" onClick="notificacion()" class="btn btn-default"/>
           </div>
         
          </form>
          </div>
        </div>
       <!-- termina formulario de busqueda -->
       
       <div class="col-lg-12">
		 
	      <div class="col-lg-12">
		 <div class="col-lg-10"></div>
		 <div class="col-lg-2">
       <span class="form-control" style="margin-bottom:0px;"><strong>Registros:</strong><?php if(!empty($resultActi)) echo "  ".count($resultActi);?></span>
		 </div>
		 </div>
		 <div class="col-lg-12">
       
        <section class="col-lg-12 actividades" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Usuario</th>
	    		<th style="color:#456789;font-size:80%;">Nombre del Controlador</th>
	    		<th style="color:#456789;font-size:80%;">Acción</th>
	    		<th style="color:#456789;font-size:80%;">Parámetros</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultActi)) {  foreach($resultActi as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_trazas; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->usuario_usuarios; ?></td> 
		                <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_controlador; ?></td> 
		                 <td style="color:#000000;font-size:80%;"> <?php echo $res->accion_trazas; ?></td> 
		                  <td style="color:#000000;font-size:80%;"> <?php echo $res->parametros_trazas; ?></td> 
		                  <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?></td> 
		              
		           	  
		    		</tr>
		        <?php } }else{ ?>
                <tr>
	                  	<td></td>
            			<td></td>
	                    <td colspan="4" style="color:#ec971f;font-size:8;"> <?php echo '<span id="snResult">No existen resultados</span>' ?></td>
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
   <?php include("view/modulos/footer.php"); ?>
     </body>  
    </html>   