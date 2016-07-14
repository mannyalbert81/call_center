
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Documentos - aDocument 2015</title>
        
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
         
        <script type="text/javascript">
		$(document).ready(function(){
			
	   		$("#Guardar").click(function() {
		   		
		   		url = $("#enlace").attr("href");
		     	//window.open(url, '_blank');
		     	window.open(url, this.target, 'width=1000, height=800, menubar=no');
		     	return true;
	   		});
		});
       </script>
         
         <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#Guardar").click(function() 
			{
		   
		    	var nombre_ciudad = $("#nombre_ciudad").val();
		    
		   				
		    	if (nombre_ciudad == "")
		    	{
			    	
		    		$("#mensaje_nombres").text("Introduzca una ciudad ");
		    		$("#mensaje_nombres").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_nombres").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#nombre_ciudad" ).focus(function() {
					$("#mensaje_nombres").fadeOut("slow");
    			});
				
			
		
				
		
		      
				    
		}); 

	</script>
     

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
       
       
		   
		?>
 
			  
			  <div class="container">
			  
			  <div class="row" style="background-color: #ffffff;" >
			  
			  <h4 ALIGN="center"></h4>
			<div class="" style="margin-left:50px">	
				<BR>
            	
		    <h4 style="color:#ec971f;" ALIGN="center" >EMISIÓN Y APROBACIÓN DE DOCUMENTOS</h4>
		    
            	<BR>
            	
            	<div class="col-lg-11" style=" text-aling: justify;">
            	 	<p align = "justify"><b><center><font face="univers" size=2>***Esta Leyenda será incluída automaticamente por el sistema a las Providencias para los casos de Juicios anteriores a la gestión del nuevo Liquidador***</b></font></center></p>
					<p align = "justify"><font face="univers" size=1><b>VISTOS:</b> Avoco conocimiento del presente proceso en mi calidad de Liquidador del Banco Territorial S.A. en Liquidación conforme la designación a mí extendida mediante Resolución No. SB-2016-304 emitida por el MBA. Christian Cruz Rodríguez en su calidad de Superintendente de Bancos, dada en la Superintendencia de Bancos en Quito Distrito Metropolitano con fecha 28 de abril de 2016 debidamente inscrita en el Registro Mercantil del cantón Guayaquil el 03 de mayo de 2016, cuyo desglose ordeno dejando copias certificadas en autos.- Continúen actuando los abogados Nombre Secretario y Nombre Abogado en calidad de secretario y abogado impulsor respectivamente, con los juramentos que tienen rendido en autos.-</font></p>
			  </div>
			     <br>
			     <br>
    
     
     
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Documentos","index"); ?>" method="post" enctype="multipart/form-data">
            
         
            <div class="col-lg-6">	
          <p margin-left: 2cm;>

		   		
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
		    
		     <?php } } else {?>
		    
			   <div class="row">
		    <div class="col-xs-4 col-md-4" style="margin-top:10px">
			  	<p  class="formulario-subtitulo" >Ciudad:</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
					<?php foreach($resultDatos as $res) {?>
						 <option value="<?php echo $res->id_ciudad; ?>"  ><?php echo $res->nombre_ciudad; ?> </option>
			            <?php } ?>
				</select> 
			  </div>
			 </div>
		      
		      
		       <div class="row">
		       <div class="col-xs-4 col-md-4" style="margin-top:10px">
			  <p  class="formulario-subtitulo" >Juicios:</p>
	          <input type="text" id="juicios" name="juicios" class="form-control" value="">
	        
	         <input type="hidden" id="id_juicios" name="id_juicios" value="<?php if(!empty($resulSet)){ foreach ($resulSet as $res){
	         echo 	$res->id_juicios;
	         }}?>">
		   	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
		    
		    <div class="col-xs-4 col-md-4" style="margin-top:10px">
		     <p  class="formulario-subtitulo" >Validar:</p>
			  <input type="submit" id="Validar" name="Validar" value="Validar" onClick="Ok()" class="btn btn-success"/>
			 </div>
		       </div>
		       
		      <div class="row">
		     <div class="col-xs-4 col-md-4" style="margin-top:10px">
			  	<p  class="formulario-subtitulo" >Estado Procesal:</p>
			  	<select name="id_estados_procesales_juicios" id="id_estados_procesales_juicios"  class="form-control" >
					<?php foreach($resultEstPro as $res) {?>
						<option value="<?php echo $res->id_estados_procesales_juicios; ?>"  ><?php echo $res->nombre_estado_procesal_juicios; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
		      </div>
		      
		      <div class="row">
		      <div class="col-xs-4 col-md-4" style="margin-top:10px">
			  <p  class="formulario-subtitulo" >Fecha de Providencia:</p>
					   
	          <input type="text" id="fecha_emision_documentos" name="fecha_emision_documentos" value="<?php  $fecha=date("d/m/Y");  echo $fecha;?>" class="form-control">
		   	   	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
		    
		     <div class="col-xs-4 col-md-4" style="margin-top:10px">
			  <p  class="formulario-subtitulo" >Hora de Providencia:</p>
	          <input type="time" id="hora_emision_documentos" name="hora_emision_documentos" class="form-control" value="<?php echo date("G:i:s");?>">
		   	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
		      </div>
		      
		      
		      <div class="row">
		      <div class="col-xs-6 col-md-6" style="margin-top:10px">
			  <p  class="formulario-subtitulo" >Detalle:</p>
					   
	          <input type="text" id="detalle_documentos" name="detalle_documentos" value="" class="form-control">
		   	   	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
		    </div>
		    
		    <div class="row">
		     <div class="col-xs-6 col-md-6" style="margin-top:10px">
			  <p  class="formulario-subtitulo" >Observación:</p>
	          <input type="text" id="observacion_documentos" name="observacion_documentos" class="form-control" value="">
		   	<div id="mensaje_criterio" class="errores"></div>	   
		    </div>
		      </div>

		    
		    <?php } ?>
		     </p>
		     </div>
		     
         <div class="col-lg-5">
             <div class="row">
              <div class="col-xs-4 col-md-4" style="margin-top:10px">
              <p  class="formulario-subtitulo" ><?php setlocale(LC_ALL,"es_ES"); define("CHARSET", "iso-8859-1"); echo strftime("%A %d de %B del %Y");?></p>
		      <textarea id="avoco_vistos_documentos" name="avoco_vistos_documentos" rows="8" cols="60">VISTOS: </textarea>
		      </div>
		      </div>
        </div>
          
          
          
          <div class="row">
			  <div class="col-xs-12 col-md-6" style="text-align: center;" >
			  <input type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php echo $helper->url("Documentos","InsertaDocumentos"); ?>'" value="Guardar" onClick="Ok()" class="btn btn-success"/>
		     <a id="enlace" href="/FrameworkMVC/view/ireports/ContDocumentosReport.php?id_juicios=<?php echo $resulSet[0]->id_juicios; ?>" style="margin-top: 10px; display: none;" class="btn"></a>				   		
		        	
		  </div>
			  </div>    
       </form>
       <!-- termina el form --> 
       <BR>     
        
      </div>
      </div>
      </center>
      </div>
      </div>
   </body>  

    </html>   