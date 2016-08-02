 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Distribucion Gastos - coactiva 2016</title>
        
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		  			   
          <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
	      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
		  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
		
		<link rel="stylesheet" href="http://jqueryvalidation.org/files/demo/site-demos.css">
        <script src="http://jqueryvalidation.org/files/dist/jquery.validate.min.js"></script>
        <script src="http://jqueryvalidation.org/files/dist/additional-methods.min.js"></script>
 		
 		<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
		
		
		
		<script language="javascript" type="text/javascript" src="/view/css/tinymce/js/tinymce/tinymce.js"> </script>
        <script language="javascript" type="text/javascript">
	      tinyMCE.init({
	         mode : "textareas",
	         theme : "advanced"
	      });
	      </script>
		
		
		
		
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
				alertify.success("Has Pulsado en Asignar"); 
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
		    // cada vez que se cambia el valor del combo
		    $(document).ready(function(){
		    
		    $("#Asignar").click(function() 
			{
		    
		    	var descripcion_diligencia= $("#descripcion_diligencia").val();
		     	var numero_documento = $("#numero_documento").val();
		    	var a_favor_de= $("#a_favor_de").val();
		    	 	
		    		    	
		    	
		    	if (descripcion_diligencia == "")
		    	{
			    	
		    		$("#mensaje_descripcion").text("Introduzca una Descripcion");
		    		$("#mensaje_descripcion").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_descripcion").fadeOut("slow"); //Muestra mensaje de error
		            
				}    
				
		    	if (numero_documento == "")
		    	{
			    	
		    		$("#mensaje_numero_documento").text("Introduzca un Numero de Documento");
		    		$("#mensaje_numero_documento").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_numero_documento").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	if (a_favor_de== "")
		    	{
			    	
		    		$("#mensaje_a_favor_de").text("Introduzca un Dato");
		    		$("#mensaje_a_favor_de").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_a_favor_de").fadeOut("slow"); //Muestra mensaje de error
		            
				}   
		
			}); 


		        $( "#descripcion_diligencia" ).focus(function() {
				  $("#mensaje_descripcion").fadeOut("slow");
			    });
				
				$( "#numero_documento" ).focus(function() {
					$("#mensaje_numero_documento").fadeOut("slow");
    			});
				$( "#a_favor_de" ).focus(function() {
					$("#mensaje_a_favor_de").fadeOut("slow");
    			});
    			
				
		
				
		      
				    
		}); 

	</script>
         
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
       
       <script>
       $(document).ready(function(){

    	   $("#tipo_gasto").prop("disabled","disabled");
    	   $("#descripcion_diligencia").prop("disabled","disabled");
           $("#tipo_documento").prop("disabled","disabled");
           $("#numero_documento").prop("disabled","disabled");
           $("#a_favor_de").prop("disabled","disabled");
 

            $(".marcados").click(function(){

            	var cant = $("input:checked").length;
            	
                if(cant!=0)
                {
            	 $("#tipo_gasto").prop("disabled","");
          	     $("#descripcion_diligencia").prop("disabled","");
                 $("#tipo_documento").prop("disabled","");
                 $("#numero_documento").prop("disabled","");
                 $("#a_favor_de").prop("disabled","");
                }else
                    {
                	  $("#tipo_gasto").prop("disabled","disabled");
               	      $("#descripcion_diligencia").prop("disabled","disabled");
                      $("#tipo_documento").prop("disabled","disabled");
                      $("#numero_documento").prop("disabled","disabled");
                      $("#a_favor_de").prop("disabled","disabled");
                    }
                
                });
 	 });
       </script>
       
        <script >
    $(document).ready(function(){
        
        $("#marcar_todo").change(function () {
            if ($(this).is(':checked')) {
               
                $(".marcados").prop('checked', true); 
                $("#tipo_gasto").prop("disabled","");
         	     $("#descripcion_diligencia").prop("disabled","");
                $("#tipo_documento").prop("disabled","");
                $("#numero_documento").prop("disabled","");
                $("#a_favor_de").prop("disabled","");

                
            } else {
                
                $("input:checkbox").prop('checked', false);
                $("input[type=checkbox]").prop('checked', false);
                $("#tipo_gasto").prop("disabled","disabled");
         	      $("#descripcion_diligencia").prop("disabled","disabled");
                $("#tipo_documento").prop("disabled","disabled");
                $("#numero_documento").prop("disabled","disabled");
                $("#a_favor_de").prop("disabled","disabled");
            }
        });
        });
	</script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php
       $resultMenu=array(1=>"Cheque",2=>"Reembolso");
       $resultGastos=array(1=>"Oficios",2=>"Citaciones",3=>"Otros");
       $resultTipoDocumento=array(0=>"--Seleccione--",1=>"Cheque",2=>"Factura",3=>"NA");
       if(empty($result_tipo_gasto)){
       	echo  "no hay datos";
       }
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("DistribucionGastos","index"); ?>" method="post" name="tinymce" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- empieza la cabecera  -->
         <div class="col-lg-12" style="display:none;">
         <hr>
        	    <h4 style="color:#ec971f;">Distribucion Gastos</h4>
    
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
       	
			  
		    
		     <?php } } else {?>
		    
			   
		       <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Id Gastos:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-3">
			  	<p  class="formulario-subtitulo" style="" >Forma:</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
					<?php foreach($resultMenu as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select> 			
			  </div>
			
			
		       <div class="col-xs-3">
			  	<p  class="formulario-subtitulo" >Nº Referencia:</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			  <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" >Valor ($):</p>
			  	<input type="text"  name="nombre_tipo_identificacion" id="nombre_tipo_identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>
			  </div>
			
	
		     <?php } ?>
		     
		     
		  
			  <div class="col-xs-1"  >
			  <p  class="formulario-subtitulo" style="color:#ffffff" >GUARDAR</p>
			  	<input type="submit" id="Guardar" name="Guardar" value="Crear Gasto" class="btn btn-success"/>
			  </div>
			    
     	 
         </div>   
         <!-- termina la cabecera  -->
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Distribucion Gastos</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  			<div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Gastos Por:</p>
			  	<select name="gastos_por" id="gastos_por"  class="form-control" >
					<?php foreach($resultGastos as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select>
				 <div class="col-lg-12" style="text-align: center;">
		         <div class="col-lg-12" style="text-align: center;">
			<input type="submit" id="Buscar" name="Buscar" value="Buscar" class="btn btn-default form-control" style="margin-top: 10px;"/> 			
		 </div>
		 </div>
		</div> 
  			
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Entidad:</p>
			  	<select name="id_entidad" id="id_entidad"  class="form-control" >
			  		<option value="0"><?php echo "--Seleccione--";  ?> </option>
					<?php foreach($resultEntidad as $res) {?>
						<option value="<?php echo $res->id_entidades; ?>"><?php echo $res->nombre_entidades;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Juicio:</p>
			  	<input type="text"  name="numero_juicio" id="numero_juicio" value="" class="form-control"/> 
			    <div id="mensaje_juicio" class="errores"></div>

         </div>
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Identificacion:</p>
			  	<input type="text"  name="identificacion" id="identificacion" value="" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>

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
		</div>
        	
		 </div>
		 
		 
		 
		 <div class="col-lg-12">
		 
		  <!-- comienza lateral izd -->
		 <?php //if(!empty($resultSet)){?>
		 <div class="col-lg-5">
		 
		 <div class="col-xs-4 " style="margin-top: 5px;">
         		<p class="formulario-subtitulo" >Tipo Gasto:</p>
         </div>
		<div class="col-xs-6 "  style="margin-top: 5px;">
         		
			  	<select name="tipo_gasto" id="tipo_gasto"  class="form-control" >
			  			<option value="0">--Seleccione</option>
					<?php foreach($result_tipo_gasto as $restipo_gasto) { ?>
						<option value="<?php echo $restipo_gasto->id_tipo_gastos;?>"><?php echo  $restipo_gasto->nombre_tipo_gastos; ?> </option>
			            <?php } ?>
				</select> 
			    <div id="mensaje_tipo_gasto" class="errores"></div>
		</div>
		
		<div class="col-xs-4 "  style="margin-top: 5px;">
         		<p class="formulario-subtitulo" >Descripcion Diligencia:</p>
         </div>
		<div class="col-xs-6 "  style="margin-top: 5px;">
         		<textarea id="descripcion_diligencia" name="descripcion_diligencia"  rows="1" class="form-control" ></textarea>
			    <div id="mensaje_descripcion" class="errores"></div>
		</div>
		
		<div class="col-xs-4 "  style="margin-top: 5px;">
         		<p class="formulario-subtitulo" >Valor($) a distribuir:</p>
         </div>
		<div class="col-xs-6 "  style="margin-top: 5px;">
         		<input type="text"  name="valor_a_distribuir" id="valor_a_distribuir" value="" class="form-control"  disabled/> 
			    <div id="mensaje_valor" class="errores"></div>
		</div>
		<div class="col-xs-10 "  style="margin-top: 5px;">
		 <hr>
		 </div>
		 
		 <div class="col-xs-4 "  style="margin-top: 5px;">
         		<p class="formulario-subtitulo" >Documento/soporte:</p>
         </div>
		<div class="col-xs-6 "  style="margin-top: 5px;">
         		
			  	<select name="tipo_documento" id="tipo_documento"  class="form-control" >
					<?php foreach($resultTipoDocumento as $val=>$desc) {?>
						<option value="<?php echo $val ?>"><?php echo $desc ?> </option>
			            <?php } ?>
				</select> 
			    <div id="mensaje_nombres" class="errores"></div>
		</div>
		
		<div class="col-xs-4 "  style="margin-top: 5px;">
         		<p class="formulario-subtitulo" >Nº Documento:</p>
         </div>
		<div class="col-xs-6 "  style="margin-top: 5px;">
         		<textarea id="numero_documento" name="numero_documento"  rows="1" class="form-control" ></textarea>
			    <div id="mensaje_numero_documento" class="errores"></div>
		</div>
		
		<div class="col-xs-4 "  style="margin-top: 5px;">
         		<p class="formulario-subtitulo" >A favor de:</p>
         </div>
		<div class="col-xs-6 "  style="margin-top: 5px;">
         		<input type="text"  name="a_favor_de" id="a_favor_de" value="" class="form-control"/> 
			    <div id="mensaje_a_favor_de" class="errores"></div>
		</div>
		 
		 </div>
		 <?php  //}?>
		 <!-- termina lateral izd -->
		 
		 <div class="col-lg-7">
		 <span class="form-control">registros:<?php if(!empty($resultSet)) echo "  ".count($resultSet);?></span>
		 <section class="" style="height:300px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"><input type="checkbox" id="marcar_todo" name="marcar_todo" class="checkbox"></th>
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Nº Oficio</th>
	    		<th style="color:#456789;font-size:80%;">Nº Juicio</th>
	    		<th style="color:#456789;font-size:80%;">Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Entidad</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		
	        		   <td style="color:#000000;font-size:80%;"><input type="checkbox" id="id_oficios[]" name="id_oficios[]" value="<?php echo $res->id_oficios; ?>" class="marcados"></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_oficios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_oficios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_emision_juicios; ?>     </td> 
		              
		    		</tr>
		        <?php } }  ?>
           
       	</table>     
      </section>
		 
		 </div>
		 		 
		 </div>
		
		 
		 <div class="col-lg-12">
		 <div class="col-lg-3">
		 </div>
		 
		 <div class="col-lg-5" style="text-align: center;">
		 <div class="col-lg-12" style="text-align: center;">
		 <input type="submit" id="Asignar" name="Asignar" value="Asignar" onclick="this.form.action='<?php echo $helper->url("DistribucionGastos","AsignarDistribucionGasto"); ?>'" class="btn btn-success " onClick="notificacion()" style="margin-top: 10px;"/> 
		 </div>
				
		 </div>
		 <div class="col-lg-3">
		 
		 </div>
		 </div>
		  
		 
		 
      
       </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
   </body>  

    </html>   