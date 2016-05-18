<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Actividades - coactiva 2016</title>
        
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
		
		<script>

		

		</script>
		
		<script>
		$(document).ready(function(){

	       $("#fecha_desde").change(function() {





                        var startDate = new Date($('#fecha_subida_desde').val());

                        var endDate = new Date($('#fecha_subida_hasta').val());



                        if (startDate > endDate){

                                       $("#fecha_subida_hasta").val("");



                                       alert('Fecha subida DESDE mayor a  fecha FINAL');

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
      <div class="col-lg-3" > 
      
      </div>
      
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
           <div class="col-lg-3" id="div_contenido">
           <input type="text"  name="contenido" id="contenido" value="" class="form-control"/>
           <div id="mensaje_contenido" class="errores"></div>
            </div>
            
            <div class="col-lg-3" id="div_ddl_accion">
           
           <select name="ddl_accion" id="ddl_accion"  class="form-control">
                                    <?php foreach($acciones as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>"><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_ddl_accion" class="errores"></div>
           </div>
            
           <div class="col-lg-3" id="div_ddl_criterio">
           
           <select name="ddl_criterio" id="ddl_criterio"  class="form-control">
                                    <?php foreach($resulMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>"><?php echo $desc ?> </option>
                                    <?php } ?>
                                        
           </select>
           <div id="mensaje_criterio" class="errores"></div>
           </div>
          
           
          
           <div class="col-lg-3">
           <input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-default"/>
           </div>
         
          </form>
          </div>
        </div>
       <!-- termina formulario de busqueda -->
       
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
   
     </body>  
    </html>   