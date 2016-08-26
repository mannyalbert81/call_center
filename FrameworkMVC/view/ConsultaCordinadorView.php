 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Consulta Cordinador - coactiva 2016</title>
        
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
				alertify.success("Has Pulsado en Reporte"); 
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
		$("#id_secretario").change(function(){

            // obtenemos el combo de resultado combo 2
           var $ddl_impulsor = $("#id_impulsor");
       	

            // lo vaciamos
           var ddl_secretario = $(this).val();

          
           $ddl_impulsor.empty();

          
            if(ddl_secretario != 0)
            {
            	
            	 var datos = {
                   	   
           			   usuarios:$(this).val()
                  };
             
            	


         	   $.post("<?php echo $helper->url("ConsultaCordinador","Impulsor"); ?>", datos, function(resultImpulsor) {

         		 		$.each(resultImpulsor, function(index, value) {
         		 			$ddl_impulsor.append("<option value= " +value.id_abogado +" >" + value.impulsores  + "</option>");	
                    		 });

         		 		 	 		   
         		  }, 'json');


            }
            else
            {
                
         	   $ddl_resultado.empty();

            }
		//alert("hola;");
		});
        });
	
       

	</script>
   
	
	
	<script>
	$(document).ready(function(){
		$("#id_ciudad").change(function(){

            // obtenemos el combo de resultado combo 2
           var $ddl_secretario = $("#id_secretario");
       	

            // lo vaciamos
           var ddl_ciudad = $(this).val();

          
           $ddl_secretario.empty();

          
            if(ddl_ciudad != 0)
            {
            	
            	 var datos = {
                   	   
           			   ciudad:$(this).val()
                  };
             
            	


         	   $.post("<?php echo $helper->url("ConsultaCordinador","Secrtetarios"); ?>", datos, function(resultSecretario) {

         		 		$.each(resultSecretario, function(index, value) {
         		 			$ddl_secretario.append("<option value= " +value.id_usuarios +" >" + value.nombre_usuarios  + "</option>");	
                    		 });

         		 		 	 		   
         		  }, 'json');


            }
            else
            {
                
         	   $ddl_resultado.empty();

            }
		//alert("hola;");
		});
        });
	
       

	</script>

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php
       
       $sel_id_ciudad = "";
       $sel_tipo_documento ="";
       $sel_id_secretario = "";
       $sel_id_impulsor = "";
       $sel_identificacion="";
       $sel_numero_juicio="";
      
       $sel_fecha_desde="";
       $sel_fecha_hasta="";
       
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       
       	$sel_id_ciudad = 			$_POST['id_ciudad'];
       	$sel_tipo_documento = 		$_POST['tipo_documento'];
       	$sel_id_secretario = 		$_POST['id_secretario'];
       	$sel_id_impulsor = 			$_POST['id_impulsor'];
       	$sel_identificacion=		$_POST['identificacion'];
       	$sel_numero_juicio=			$_POST['numero_juicio'];
      
       	$sel_fecha_desde=			$_POST['fecha_desde'];
       	$sel_fecha_hasta=			$_POST['fecha_hasta'];
       
       }
       ?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("ConsultaCordinador","consulta_cordinador"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Consulta Cordinador</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  			
		   <div class="row">
	     <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Ciudad:</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control">
			  	<option value="0"  >--Seleccione--</option>
			  		<?php foreach($resultCiu as $res) {?>
						 <option value="<?php echo $res->id_ciudad; ?>" <?php if($sel_id_ciudad==$res->id_ciudad){echo "selected";}?>   ><?php echo $res->nombre_ciudad; ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		   <div class="col-xs-2 ">
			   <p  class="formulario-subtitulo" >Tipo Documento:</p>
			  
			   <select name="tipo_documento" id="tipo_documento"  class="form-control">
			    <option value="citaciones"  >Citaciones</option>
			    <option value="providencias"  >Providencias</option>
			    <option value="oficios"  >Oficios</option>
			    <option value="avoco_conocimiento"  >Avoco Conocimiento</option>
			    <option value="auto_pago"  >Auto de Pago</option>
			   </select>
	      </div> 
	      
	      <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Secretarios:</p>
			  <select name="id_secretario" id="id_secretario"  class="form-control">
			  	<option value="0">--Sin Especificar--</option>
			    </select>
		 </div>
		   	
		  <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Impulsores:</p>
			  	<select name="id_impulsor" id="id_impulsor"  class="form-control">
			  	<option value="0">--Sin Especificar--</option>
			    </select>
		 </div>
		  		
		 <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Identificacion:</p>
			  	<input type="text"  name="identificacion" id="identificacion" value="<?php echo $sel_identificacion;?>" class="form-control" placeholder="Ingrese"/> 
			    <div id="mensaje_identificacion" class="errores"></div>

         </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Juicio:</p>
			  	<input type="text"  name="numero_juicio" id="numero_juicio" value="<?php echo $sel_numero_juicio;?>" class="form-control" placeholder="Ingrese"/> 
			    <div id="mensaje_juicio" class="errores"></div>

         </div>
        </div>
	     
	    <div class="row"> 
	     <div class="col-xs-2 ">
			   <p  class="formulario-subtitulo" >Estado Documento:</p>
			  
			 <select name="estado_documento" id="estado_documento"  class="form-control">
			   <option value="0"  >--Seleccione--</option>
			   <option value="firmado"  >Firmado</option>
			   <option value="no_firmado"  >No Firmado</option>
			 </select>
	    </div> 
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_desde" id="fecha_desde" value="<?php echo $sel_fecha_desde;?>" class="form-control " placeholder="Seleccione"/> 
			    <div id="mensaje_fecha_desde" class="errores"></div>
		</div>
         
        <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_hasta" id="fecha_hasta" value="<?php echo $sel_fecha_hasta;?>" class="form-control " placeholder="Seleccione"/> 
			    <div id="mensaje_fecha_hasta" class="errores"></div>
		</div>
		 </div>
  			</div>
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
		 <input type="submit" id="buscar" name="buscar" value="Buscar" onClick="notificacion()" class="btn btn-warning " style="margin-top: 10px;"/> 	
		 
		 <?php if(!empty($resultSet))  {?>
		 <a href="/FrameworkMVC/view/ireports/ContDocumentosGeneralReport.php?id_ciudad=<?php  echo $sel_id_ciudad ?>&identificacion=<?php  echo $sel_identificacion?>&numero_juicio=<?php  echo $sel_numero_juicio?>&fecha_desde=<?php  echo $sel_fecha_desde?>&fecha_hasta=<?php  echo $sel_fecha_hasta?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success">Reporte</a>
		  <?php } else {?>
		  
		  <?php } ?>
		 </div>
		</div>
        	
		 </div>
		 <div class="col-lg-12">
		 <div class="col-lg-12">
		 <div class="col-lg-10"></div>
		 <div class="col-lg-2">
		 <span class="form-control"><strong>Registros:</strong><?php if(!empty($resultSet)) echo "  ".count($resultSet);?></span>
		 </div>
		 </div>
		 
		 <div class="col-lg-12">
		
		 <section class="" style="height:300px;overflow-y:scroll;">
        
        
               <?php if (!empty($resultCita)) {?>
               	<table class="table table-hover ">
               	<tr >
               	<th style="color:#456789;font-size:80%;"><b>Id</b></th>
               	<th style="color:#456789;font-size:80%;">Nº Juicio Referido</th>
               	<th style="color:#456789;font-size:80%;">Identificacion</th>
               	<th style="color:#456789;font-size:80%;">Cliente</th>
               	<th style="color:#456789;font-size:80%;">Fecha</th>
               	<th style="color:#456789;font-size:80%;">Ciudad</th>
               	<th style="color:#456789;font-size:80%;">Persona Recibe</th>
               	<th style="color:#456789;font-size:80%;">Relacion</th>
               	<th style="color:#456789;font-size:80%;">Usuarios</th>
               	 
               	<th></th>
               	<th></th>
               	</tr>
               	
                 <?php		foreach($resultCita as $res) {   ?>
	          
               		<tr>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_juicios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_citaciones; ?></td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_ciudad; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_persona_recibe_citaciones; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->relacion_cliente_citaciones; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuarios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;">
		               <a href="<?php echo $helper->url("ConsultaCordinador","abrirPdf_citaciones"); ?>&id=<?php echo $res->id_citaciones; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" class="btn btn-success" onClick="Ok()" style="font-size:65%;">-- VER --</a>
		               </td> 
		    		</tr>
		    		
		    	<?php } }elseif (!empty($resultProv)) {?>
		    		<table class="table table-hover ">
		    		<tr >
		    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
		    		<th style="color:#456789;font-size:80%;"><b>Ciudad</b></th>
		    		<th style="color:#456789;font-size:80%;">Nº Juicio Referido</th>
		    		<th style="color:#456789;font-size:80%;">Cliente</th>
		    		<th style="color:#456789;font-size:80%;">Identificacion</th>
		    		<th style="color:#456789;font-size:80%;">Nombre Documento</th>
		    		<th style="color:#456789;font-size:80%;">Impulsor</th>
		    		<th style="color:#456789;font-size:80%;">secretarios</th>
		    		<th style="color:#456789;font-size:80%;">Fecha Emisión</th>
		    		<th style="color:#456789;font-size:80%;">Hora Emision</th>
		    		<th></th>
		    		<th></th>
		    		</tr>
		    		
		    		<?php 
		    		
		    		foreach($resultProv as $res) {   ?>
		
               		<tr>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_documentos; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_ciudad; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?></td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_documento; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->impulsores; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->secretarios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_emision_documentos; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->hora_emision_documentos; ?>     </td> 
		               
		               <td style="color:#000000;font-size:80%;">
		               <a href="<?php echo $helper->url("ConsultaCordinador","abrirPdf_providencias"); ?>&id=<?php echo $res->id_documentos; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" class="btn btn-success" onClick="Ok()" style="font-size:65%;">-- VER --</a>
		               </td> 
		    		</tr>
		    		
		    	<?php } }elseif (!empty($resultOfi)) {?> 
		    	
		    	
		    	<table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Numero</th>
	    		<th style="color:#456789;font-size:80%;">Juicio</th>
	    		<th style="color:#456789;font-size:80%;">Titulo Credito</th>
	    		<th style="color:#456789;font-size:80%;">Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Entidades</th>
	    		<th style="color:#456789;font-size:80%;">Creado</th>
	             	
	    		<th></th>
	    		<th></th>
	  		</tr>
        
		    
		    	<?php  foreach($resultOfi as $res) {   ?>

				       		<tr>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_oficios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_oficios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->id_titulo_credito; ?></td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?>     </td> 
		                <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_entidades; ?>     </td> 
		                 <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>     </td> 
		            
		               <td style="color:#000000;font-size:80%;">
		               <a href="<?php echo $helper->url("ConsultaCordinador","abrirPdf_oficios"); ?>&id=<?php echo $res->id_oficios; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" class="btn btn-success" onClick="Ok()" style="font-size:65%;">-- VER --</a>
		               </td> 
		    		</tr>
		    		
		    		<?php } }elseif (!empty($resultAvoCono)) {?>  
		    		
		    	<table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Nº Juicio Referido</th>
	    		<th style="color:#456789;font-size:80%;">Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Ciudad</th>
	    		<th style="color:#456789;font-size:80%;">Secretario</th>
	    		<th style="color:#456789;font-size:80%;">Impulsor</th>
	    		<th style="color:#456789;font-size:80%;">Creado</th>

	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
		    		<?php foreach($resultAvoCono as $res) {   ?>

				     <tr>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_avoco_conocimiento; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_ciudad; ?></td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->secretarios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->impulsores; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>     </td> 
		            
		               <td style="color:#000000;font-size:80%;">
		               <a href="<?php echo $helper->url("ConsultaCordinador","abrirPdf_avoco_conocimiento"); ?>&id=<?php echo $res->id_avoco_conocimiento; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" class="btn btn-success" onClick="Ok()" style="font-size:65%;">-- VER --</a>
		               </td> 
		    		</tr>
		    		
		    		<?php } }elseif (!empty($resultAutoPago)) {?>  
		    			
		    			
		    			<table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Titulo</th>
	    		<th style="color:#456789;font-size:80%;">Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Usuario</th>
	    		<th style="color:#456789;font-size:80%;">Fecha </th>
	    		<th style="color:#456789;font-size:80%;">Estado</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
		    			
			    		<?php	foreach($resultAutoPago as $res) {?>

		      		<tr>
	        		   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_auto_pagos; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->id_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuarios; ?></td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_asiganacion_auto_pagos; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_estado; ?>     </td> 
		            
		               <td style="color:#000000;font-size:80%;">
		               <a href="<?php echo $helper->url("ConsultaCordinador","abrirPdf_auto_pago"); ?>&id=<?php echo $res->id_auto_pagos; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" class="btn btn-success" onClick="Ok()" style="font-size:65%;">-- VER --</a>
		               </td> 
		    		</tr>
		    		
		    		<?php }}else {?>
		    		
		    		<table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Nº Juicio Referido</th>
	    		<th style="color:#456789;font-size:80%;">Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Estado Procesal</th>
	    		<th style="color:#456789;font-size:80%;">Fecha Emisión</th>
	    		<th style="color:#456789;font-size:80%;">Impulsor</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
		    		
		    		<tr>
	                  	<td></td>
            			<td></td>
            			<td></td>
            			<td colspan="5" style="color:#ec971f;font-size:8;" style="text-aling:center";> <?php echo '<span id="snResult">NO EXISTE DATOS PARA ESOS FILTROS</span>' ?></td>
	       				
		   </tr>
		    		
		    		<?php } ?>
               
       	</table>
       </section>
		</div>
		 </div>
<div class="text-center">	
  <ul class="pagination">
  <li><a href="#">&laquo;</a></li>
  <li><a href="#">1</a></li>
  <li><a href="#">2</a></li>
  <li><a href="#">3</a></li>
  <li><a href="#">4</a></li>
  <li><a href="#">5</a></li>
  <li><a href="#">&raquo;</a></li>
</ul>                       
 </div>

      </form>
     
      </div>
     
  </div>
      <!-- termina
       busqueda  -->
   </body>  

    </html>   