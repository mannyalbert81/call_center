<!DOCTYPE HTML>
<html lang="es">
     <head>
         <meta charset="utf-8"/>
        <title>Firmas Digitales - coactiva 2016</title>
        
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
				alertify.success("Has Pulsado en Procesar"); 
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
        
        <script>
		$(document).ready(function(){
			$("#Buscar").click(function(){
				//alert("hola");
				 var startDate = new Date($('#fecha_desde').val());

                 var endDate = new Date($('#fecha_hasta').val());

                 var inicio = $('#fecha_desde').val();

                 var fin = $('#fecha_hasta').val();

				if((inicio=="" && fin=="")||(inicio!="" && fin!="")){
                     
                	 return true;
                 }else {
                	 alert("ingrese fechas de busqueda");
                     return false;
                     }

                
                 });
			});
		</script>
        
        <script>
		$(document).ready(function(){
			$("#fecha_hasta").change(function(){
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
        
         <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#procesar").click(function() 
			{
		   
		    	var archivo = $("#archivo").val();
		    
		   				
		    	if (archivo == "")
		    	{
			    	
		    		$("#mensaje_archivo").text("Introduzca una Recaudacion ");
		    		$("#mensaje_archivo").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_archivo").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    
			}); 
                    $( "#archivo" ).focus(function() {
					$("#mensaje_archivo").fadeOut("slow");
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
  
  	      <form action="<?php echo $helper->url("Recaudacion","index"); ?>" enctype="multipart/form-data"  method="post" class="col-lg-6">
          
            <h4 style="color:#ec971f;">Procesar Archivo de Recaudacion</h4>
            <hr/>
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	       <?php } } else {?>
		    	<div class="col-xs-6 col-md-6">
		             <p  class="formulario-subtitulo" >Institucion Recaudadora:</p>  
		             <select name="recaudacion_institucion" id="recaudacion_institucion"  class="form-control">
									<?php foreach($resultInsRec as $res) {?>
				 						<option value="<?php echo $res->id_recaudacion_institucion; ?>" ><?php echo $res->nombre_recaudacion_institucion; ?> </option>
						            <?php } ?>
								    	
					</select>
		         </div>
			     <div class="col-xs-6 col-md-6">
			  		<p  class="formulario-subtitulo" >Firma</p>
			  		<input type="file" name="archivo" id="archivo" accept="txt" onKeyDown="return intro(event)" value="" class="form-control"/> 
			   		<div id="mensaje_archivo" class="errores"></div>
			     </div>
   				 
		       
			<hr>
		     <?php } ?>
		
		
		<div class="row">
			<div class="col-xs-12 col-md-12" style="text-align: center;" > 
           		<?php if ($mensaje == "")?>
           		<?php {?>
           			<div class="alert alert-warning" role="alert"><?php echo $mensaje ; ?></div>
           		<?php }?>
           		
           </div>
        </div>
		<div class="row">
			<div class="col-xs-12 col-md-12" style="text-align: center;" > 
           		
           		<input type="submit" id="procesar" name="procesar" value="Procesar" onClick="Ok()" class="btn btn-success"/>
           </div>
        </div>
    </form>
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Archivos Procesados</h4>
            <hr/>
        </div>
         <div class="row">
         <!-- empieza formulario busqueda -->
         <div style="margin-bottom: 10px;">
           <form action="<?php echo $helper->url("Recaudacion","Index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
           
           <div class="col-lg-4">
           <span>Desde:</span>
           <input type="date"  name="fecha_desde" id="fecha_desde" value="" class="form-control"/>
           <div id="mensaje_desde" class="errores"></div>
            </div>
            
           <div class="col-lg-4">
           <span>Hasta:</span>
           <input type="date" id="fecha_hasta" name="fecha_hasta" value=""  class="form-control">
           <div id="mensaje_hasta" class="errores"></div>
           </div>
          
           
          
           <div class="col-lg-3">
           <span style="color:#ffffff;">Hasta:</span>
           <input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-default"/>
           </div>
         
          </form>
          </div>
           <!-- termina formulario busqueda -->
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        
        	<table class="table table-hover">
	         <tr>
	    		
	    		
	    		<th style="font-size:85%;" >Id</th>
	    		<th style="font-size:85%;">Fecha</th>
	    		<th style="font-size:85%;">Hora</th>
	    		<th style="font-size:85%;">Institucion</th>
	    		<th style="font-size:85%;">Registros</th>
	    		<th style="font-size:85%;" >Monto</th>
	    		<th style="font-size:85%;">Procesado</th>
	  		</tr>
                <?php $registros = 1;?>
                 <?php foreach($resultSet as $res) {?>
	        		<tr>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $registros; ?>  </td>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_creacion_recaudacion_cabeza; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->hora_creacion_recaudacion_cabeza; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_recaudacion_institucion; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->cantidad_registros_recaudacion_cabeza; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->valor_total_dolares_recaudacion_cabeza; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>     </td>
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("FirmasDigitales","index"); ?>&id_firmas_digitales=<?php echo $res->id_recaudacion_cabeza; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Detalle</a>
			                </div>
			            
			           </td>
			            <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("RecaudacionDetalle","index"); ?>&id_recaudacion_cabeza=<?php echo $res->id_recaudacion_cabeza; ?>" class="btn btn-warning" onClick="Borrar()" style="font-size:65%;">Ver Detalle</a>
			                </div>
			            
			             </td>
			           
		    		</tr>
		    		<?php $registros ++?>
		        <?php } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
        	
        
        
        </section>
        </div>
       </div>
 
  </div>
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          
