 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Consulta Seguimiento Gastos - coactiva 2016</title>
        
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

		$("#tipo_gasto").change(function(){


           var $valor_tipo_gasto = $("#valor_a_distribuir");

           var id_tipo_gasto = $(this).val();

           $valor_tipo_gasto.empty();

           
           if(id_tipo_gasto > 0)
           {
        	  var datos = {id_tipo_gasto : $(this).val() };
  
        	  var resultTipogasto= $.post("<?php echo $helper->url("DistribucionGastos","devuelveTipoGasto"); ?>", datos, function(resultTipo_gasto) {
        		  }, "json");    		  

        	  resultTipogasto.done(function(resultTipo_gasto ) {

        		  $.each(resultTipo_gasto, function(index, value) {
        			  $valor_tipo_gasto.val(value.valor_tipo_gasto);
  			 	     });
            	  });

           }
           else
           {
        	  
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
 
                    $("#mensaje_fecha_hasta").text("Fecha desde no debe ser mayor ");
		    		$("#mensaje_fecha_hasta").fadeIn("slow"); //Muestra mensaje de error  
		    		$("#fecha_hasta").val("");

                        }
				});

			 $( "#fecha_hasta" ).focus(function() {
				  $("#mensaje_fecha_hasta").fadeOut("slow");
			   });
			});
        </script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php

       $resultGastos=array(1=>"Oficios",2=>"Citaciones",3=>"Otros");

      
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("SeguimientoGastos","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;"> Consulta Seguimiento Gastos</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  			<div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Gastos Por:</p>
			  	<select name="gastos_por" id="gastos_por"  class="form-control" >
					<?php foreach($resultGastos as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select>
					
		 </div>
		   			
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Ciudad:</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
			  		<option value="0"><?php echo "--Seleccione--";  ?> </option>
					<?php foreach($resultCiudad as $res) {?>
						<option value="<?php echo $res->id_ciudad; ?>"><?php echo $res->nombre_ciudad;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Juicio:</p>
			  	<input type="text"  name="numero_juicio" id="numero_juicio" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>

         </div>
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Titulo:</p>
			  	<input type="text"  name="numero_titulo" id="numero_titulo" value="" class="form-control"/> 
			    <div id="mensaje_numero_titulo" class="errores"></div>

         </div>
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_desde" id="fecha_desde" value="" class="form-control "/> 
			    <div id="mensaje_fecha_desde" class="errores"></div>
		</div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_hasta" id="fecha_hasta" value="" class="form-control "/> 
			    <div id="mensaje_fecha_hasta" class="errores"></div>
		</div>
		 
  			</div>
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
		 <input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-warning " onClick="notificacion()" style="margin-top: 10px;"/> 	
		 </div>
		</div>
        	
		 </div>
		 
		 <div class="col-lg-12">
		
		 <span class="form-control">registros:<?php if(!empty($resultSet)) echo "  ".count($resultSet);?></span>
		 <section class="" style="height:300px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	            
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Nº Titulo Credito</th>
	    		<th style="color:#456789;font-size:80%;">Nº Juicio</th>
	    		<th style="color:#456789;font-size:80%;">Fecha Diligencia</th>
	    		<th style="color:#456789;font-size:80%;">Tipo Gasto</th>
	    		<th style="color:#456789;font-size:80%;">Diligencia</th>
	    		<th style="color:#456789;font-size:80%;">Estado</th>
	    		<th style="color:#456789;font-size:80%;">Valor</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		
	        		  
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_distribucion_gastos; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->id_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_gastos; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->descripcion_distribucion_gastos; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_estado; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->valor_tipo_gasto; ?>     </td> 
		              
		    		</tr>
		        <?php } }  ?>
           
       	</table>     
      </section>
		 </div>
		 </form>
     
      </div>
  </div>
      <!-- termina
       busqueda  -->
   </body>  

    </html>   