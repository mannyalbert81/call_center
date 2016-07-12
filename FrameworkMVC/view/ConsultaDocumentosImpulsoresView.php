 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Consulta Documentos Impulsores - coactiva 2016</title>
        
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

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php
       
       $sel_id_ciudad = "";
       $sel_identificacion="";
       $sel_numero_juicio="";
       $sel_id_usuarios="";
       $sel_fecha_desde="";
       $sel_fecha_hasta="";
       
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       
       
       	$sel_id_ciudad = $_POST['id_ciudad'];
       	$sel_identificacion=$_POST['identificacion'];
       	$sel_numero_juicio=$_POST['numero_juicio'];
       	$sel_id_usuarios=$_POST['id_usuarios'];
       	$sel_fecha_desde=$_POST['fecha_desde'];
       	$sel_fecha_hasta=$_POST['fecha_hasta'];
       	 
       }
       
     	?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("ConsultaDocumentosImpulsores","consulta_impulsores"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Consulta Documentos Impuslsores</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  			
		   			
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Ciudad:</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
			  		<option value="0"><?php echo "--Seleccione--";  ?> </option>
					<?php foreach($resultCiu as $res) {?>
						<option value="<?php echo $res->id_ciudad; ?>"<?php if($sel_id_ciudad==$res->id_ciudad){echo "selected";}?>><?php echo $res->nombre_ciudad;  ?> </option>
			         
			            <?php } ?>
				</select>
		 </div>
		 
		 <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Impulsor:</p>
			  	<select name="id_usuarios" id="id_usuarios"  class="form-control" >
			  		<option value="0"><?php echo "--Seleccione--";  ?> </option>
					<?php foreach($resultUsu as $res) {?>
						<option value="<?php echo $res->id_usuarios; ?>"<?php if($sel_id_ciudad==$res->id_usuarios){echo "selected";}?>><?php echo $res->nombre_usuarios;  ?> </option>
			         
			            <?php } ?>
				</select>
		 </div>
		 
		 <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Identificacion:</p>
			  	<input type="text"  name="identificacion" id="identificacion" value="<?php echo $sel_identificacion;?>" class="form-control"/> 
			    <div id="mensaje_identificacion" class="errores"></div>

         </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nº Juicio:</p>
			  	<input type="text"  name="numero_juicio" id="numero_juicio" value="<?php echo $sel_numero_juicio;?>" class="form-control"/> 
			    <div id="mensaje_nombres" class="errores"></div>

         </div>
          
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_desde" id="fecha_desde" value="<?php echo $sel_fecha_desde;?>" class="form-control "/> 
			    <div id="mensaje_fecha_desde" class="errores"></div>
		</div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_hasta" id="fecha_hasta" value="<?php echo $sel_fecha_hasta;?>" class="form-control "/> 
			    <div id="mensaje_fecha_hasta" class="errores"></div>
		</div>
		 
  			</div>
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
		 <input type="submit" id="buscar" name="buscar" value="Buscar" onClick="notificacion()" class="btn btn-warning " style="margin-top: 10px;"/> 	
		 
		 <?php if(!empty($resultSet))  {?>
		 <a href="/FrameworkMVC/view/ireports/ContDocumentosReport.php?id_ciudad=<?php  echo $sel_id_ciudad ?>&identificacion=<?php  echo $sel_identificacion?>&numero_juicio=<?php  echo $sel_numero_juicio?>&id_usuarios=<?php  echo $sel_id_usuarios?>&fecha_desde=<?php  echo $sel_fecha_desde?>&fecha_hasta=<?php  echo $sel_fecha_hasta?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success">Reporte</a>
		            
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
        <table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"></th>
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Nº Juicio Referido</th>
	    		<th style="color:#456789;font-size:80%;">Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Estado Procesal</th>
	    		<th style="color:#456789;font-size:80%;">Fecha Emisión>
	    		<th style="color:#456789;font-size:80%;">Impulsor</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		   <td> <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $res->id_usuarios; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $res->id_usuarios; ?>" width="80" height="60" >      </td>
		             <td style="color:#000000;font-size:80%;"> <?php echo $res->id_documentos; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_estado_procesal_juicios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_emision_documentos; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuarios; ?>     </td> 
		            
		               <td style="color:#000000;font-size:80%;">
		               <a href="/FrameworkMVC/view/ireports/ContDocumentosSubReport.php?id_citaciones=<?php echo $res->id_citaciones; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" class="btn btn-success" onClick="Ok()" style="font-size:65%;">-- VER --</a>
		               </td> 
		    		</tr>
		        <?php } }  ?>
               
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