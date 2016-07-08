<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Recaudacion Detalle - aDocument 2015</title>
        
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
				alertify.success("Has Pulsado en Consultar"); 
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

        $("#buscar").click(function(){

        	var contenido = $("#contenido_busqueda").val();
        	var criterio = $("#criterio_busqueda").val();

        	if(criterio!=0 && contenido=="")
            	{
        		$("#mensaje_contenido").text("Ingrese contenido");
	    		$("#mensaje_contenido").fadeIn("slow"); //Muestra mensaje de error
	            return false;
            	}
        });

        $( "#contenido_busqueda" ).focus(function() {
			$("#mensaje_contenido").fadeOut("slow");
		});


        });
	
	</script>
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
    
 		<?php $resultMenu=array(0=>"--Seleccione--",1=>"Nombre Tercero",2=>"Numero Tercero",3=>"Valor Movimiento"); ?>
  
 		<div class="container">
  
 	 	<div class="row" style="background-color: #ffffff;">
 	 	
 	 	<div class="col-lg-12" style="margin-top: 20px;">
 	 	<div class="row">
 	 	<form action="<?php echo $helper->url("RecaudacionDetalle","Index"); ?>" method="post" enctype="multipart/form-data" >
 	 	
        <div class="col-lg-4">
        <input type="hidden" id="id_cabecera" name="id_cabecera" value="<?php echo $id_cabecera; ?>">
        <label style="display: none;"><?php echo $id_cabecera; ?></label>
        <input type="text" id="contenido_busqueda" name="contenido_busqueda" value="" class="form-control">
        <div id="mensaje_contenido" class="errores"></div>
        </div>
         <div class="col-lg-4">
         <select name="criterio_busqueda" id="criterio_busqueda" class="form-control">
         							<?php foreach($resultMenu as $val=>$desc) {?>
				 						<option value="<?php echo $val ?>" ><?php echo $desc; ?> </option>
						            <?php } ?>
						            </select>
        </div>
         <div class="col-lg-4">
         <input type="submit" id="buscar" name="buscar" value="Consultar" onClick="notificacion()" class="btn btn-default">
        </div>
        </form>
 	 	</div>
 	 	</div>
 	 	<hr>
 	 	
 	 	<div class="col-lg-12" style="margin-top: 20px;">
 	 	<div class="row">
 	 	 <h4 style="color:#ec971f;">Recaudacion</h4>
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
		               
			           
		    		</tr>
		    		<?php $registros ++?>
		        <?php } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
 	 	</div>
 	 	</div>
 	 	
 	 	 <h4 style="color:#ec971f;"> Detalle Recaudacion</h4>
 	 	
 	 	<div class="col-lg-12" style="margin-top: 5px;">
 	 	<div class="row" style=" height:300px; overflow-x: scroll; overflow-y:scroll;">

        
 	 	 <table class="table table-hover">
	         <tr>
	    		
	    		
	    		<th style="font-size:85%;" ></th>
	    		<th style="font-size:85%;">Orden</th>
	    		<th style="font-size:85%;">Numero Movimiento</th>
	    		<th style="font-size:85%;">Numero Orden</th>
	    		<th style="font-size:85%;">Forma Movimiento</th>
	    		<th style="font-size:85%;">Fecha Movimiento</th>
	    		<th style="font-size:85%;">Moneda</th>
	    		<th style="font-size:85%;">Valor Movimiento</th>
	    		<th style="font-size:85%;">Localidad Movimiento</th>
	    		<th style="font-size:85%;">Agencia Movimiento</th>
	    		<th style="font-size:85%;">Codigo Estado Pago</th>
	    		<th style="font-size:85%;">Codigo Pais</th>
	    		<th style="font-size:85%;">Codigo Banco</th>
	    		<th style="font-size:85%;">Tipo Cuenta</th>
	    		<th style="font-size:85%;">Numero Cuenta</th>
	    		<th style="font-size:85%;">Codigo Tercero</th>
	    		<th style="font-size:85%;">Descripcion Est Movimiento</th>
	    		<th style="font-size:85%;">Secuencia Error</th>
	    		<th style="font-size:85%;">Referencia Estado</th>
	    		<th style="font-size:85%;">Codigo Servico Ban</th>
	    		<th style="font-size:85%;">Orden Banco</th>
	    		<th style="font-size:85%;">Ruc Tercero</th>
	    		<th style="font-size:85%;">Nombre Tercero</th>
	    		<th style="font-size:85%;">Rubro Uno</th>
	    		<th style="font-size:85%;">Rubro Dos</th>
	    		<th style="font-size:85%;">Creado</th>
	    		<th style="font-size:85%;">Modificado</th>
	    	
	  		</tr>
                <?php $registros = 1;?>
                 <?php foreach($resultDetalle as $resdet) {?>
	        		<tr>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $registros; ?>  </td>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $resdet->orden_empresa_recaudacion_detalle; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->numero_movimiento_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->numero_orden_procesada_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->forma_movimiento_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->fecha_movimiento_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->moneda_operacion_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->valor_movimiento_recaudacion_detalle; ?>  </td>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $resdet->localidad_movimiento_recaudacion_detalle; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->agencia_movimiento_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->codigo_estado_pago_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->codigo_pais_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->codigo_banco_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->tipo_cuenta_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->numero_cuenta_recaudacion_detalle; ?>  </td>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $resdet->codigo_tercero_recaudacion_detalle; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->descripcion_estado_movimiento_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->secuencia_error_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->referencia_estado_cuenta_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->codigo_servicio_bancario_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->orden_banco_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->nuc_tercero_recaudacion_detalle; ?>  </td>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $resdet->nombre_tercero_recaudacion_detalle; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->rubro_uno_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->rubro_dos_recaudacion_detalle; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->creado; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $resdet->modificado; ?>     </td>

			           
		    		</tr>
		    		<?php $registros ++?>
		        <?php } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
 	 	 
 	 	</div>
 	 	</div>
 	 	
 	 	
  
     	</div>
      	</div>
   
     </body>  
    </html>   