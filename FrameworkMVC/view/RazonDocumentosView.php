
   <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>RazonDocumentos - aDocument 2015</title>
        
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
         
       
         <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#Guardar").click(function() 
			{
		    	var juicios = $("#juicios").val();
		    	var detalle_documentos = $("#detalle_documentos").val();
		    	var observacion_documentos = $("#observacion_documentos").val();
		    	var avoco_vistos_documentos = $("#avoco_vistos_documentos").val();
		    	
		   				
		    	if (juicios == "")
		    	{
			    	
		    		$("#mensaje_juicio").text("Introduzca un Juicio");
		    		$("#mensaje_juicio").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_juicio").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	

				if (detalle_documentos == "")
		    	{
			    	
		    		$("#mensaje_detalle").text("Introduzca un Detalle");
		    		$("#mensaje_detalle").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_detalle").fadeOut("slow"); //Muestra mensaje de error
		            
				}if (observacion_documentos == "")
		    	{
			    	
		    		$("#mensaje_observacion").text("Introduzca una Observacion");
		    		$("#mensaje_observacion").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_observacion").fadeOut("slow"); //Muestra mensaje de error
		            
				}if (avoco_vistos_documentos == "")
		    	{
			    	
		    		$("#mensaje_avoco").text("Introduzca un Contenido");
		    		$("#mensaje_avoco").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_avoco").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
		    	

			
		    					    

			}); 


		 
				
				$( "#juicios" ).focus(function() {
					$("#mensaje_juicio").fadeOut("slow");
					});
					
					
						$( "#detalle_documentos" ).focus(function() {
							$("#mensaje_detalle").fadeOut("slow");
						});

							$( "#observacion_documentos" ).focus(function() {
								$("#mensaje_observacion").fadeOut("slow");
							});
								$( "#avoco_vistos_documentos" ).focus(function() {
									$("#mensaje_avoco").fadeOut("slow"); 			});
				
			
		
				
		
		      
				    
		}); 

	</script>
	 <script >
		$(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#Validar").click(function() 
			{
		    	var juicios = $("#juicios").val();
		   				
		    	if (juicios == "")
		    	{
			    	
		    		$("#mensaje_juicio").text("Introduzca un Juicio");
		    		$("#mensaje_juicio").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_juicio").fadeOut("slow"); //Muestra mensaje de error
		            
				}
		    	
			}); 
		}); 

	</script>
	
	<script type="text/javascript" src="/ckeditor/ckeditor.js"></script>
	
	  

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       
       <?php
       
      
       $sel_cuerpo="";
       $sel_id_documento="";
       
      
        
       if($_SERVER['REQUEST_METHOD']=='GET')
       {
       	
       	if(isset($_GET['dato']))
       	{
       	$a=stripslashes($_GET['dato']);
       	
       	$_dato=urldecode($a);
       	
       	$_dato=unserialize($a);
       	
       	
       	$sel_cuerpo=$_dato['cuerpo'];
       	$sel_id_documento=$_dato['idDocumento'];
       	}
      
       }
		?>
   
			  <div class="container">
			  
			  <div class="row" style="background-color: #ffffff;" >
			  
			  <h4 ALIGN="center"></h4>
			 <div class="" style="margin-left:50px">	
				<BR>
            	
		    <h4 style="color:#ec971f;" ALIGN="center" >SENTAR RAZÓN </h4>
		    
			 </div>
    
     
     
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("RazonDocumentos","index"); ?>" method="post" enctype="multipart/form-data">
            
        <div class="col-lg-12" style="margin-top: 10px">
         
       	 
  			
  			 <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
		    
		     <?php } } else {?>
  			
  			 <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Documento:</p>
			  	<input type="text"  name="id_documentos" id="id_documentos" value="<?php  if($sel_id_documento==""){echo $datos['idDocumentos'];}else{echo $sel_id_documento;} ?>" class="form-control"/ readonly>
			   </div>
            
		    <?php } ?>
		    
		    </div>
		    		
		<div class="col-xs-12 col-md-12" style="margin-top:10px">
		 <div class="form-group">
		       
	        <?php  include ("view/ckeditor/ckeditor.php");
			   $valor = "$sel_cuerpo";
			   $CKEditor = new CKEditor();
			   $config = array();
			   $config['toolbar'] = array(
			   	      array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
			   		  array( 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo'),
			   	      array( 'TextColor','BGColor','-','NewPage','Maximize'),
			   		  array( 'NumberedList','BulletedList','-','Outdent','Indent','/'),
			   		  array( 'Styles','Format','Font','FontSize')
			   	  );
			  $CKEditor->basePatch = "./ckeditor/";
			   $CKEditor->editor("cuerpo_razon_documentos",$valor,$config);
			   //$CKEditor->replaceAll();
	           ?> 
	           
	          
	          <!--  
	          <div class="col-xs-12 col-md-12" style="margin-top:10px">
		       
  				<label for="comment"><?php setlocale(LC_ALL,"es_ES");  echo strftime("%A %d de %B del %Y");?></label>
  				<textarea class="form-control" rows="8" id="avoco" name="avoco"><?php echo "Vistos: ".$sel_cuerpo;?></textarea>
  				<div id="mensaje_avoco" class="errores"></div>
			 
			  </div>
  			  -->
		    
     
			  
		      <div class="col-xs-12 col-md-6" style="text-align: center; margin-top:10px"  >
		      </div>
		       <div class="col-xs-12 col-md-3" style="text-align: center; margin-top:10px"  >
			  <input type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php  echo $helper->url("RazonDocumentos","InsertaRazonDocumentos"); ?>'" value="Guardar" class="btn btn-success"/>
			  </div>
			   <div class="col-xs-12 col-md-3" style="text-align: center; margin-top:10px" >
			 <input type="submit" id="Visualizar" name="Visualizar" onclick="this.form.action='<?php echo $helper->url("RazonDocumentos","VisualizarRazonDocumentos"); ?>'" value="Visualizar" class="btn btn-info"/>
			 </div>
			 
			 <div class="col-xs-6 col-md-12" style="margin-top:50px">
			 </div>
		    
  			 
		</div>
		
		
		 
		</div>
		
	   </form>
       
      </div>
      </div>
     

     
   </body>  
 <?php include 'view/modulos/footer.php';?>
    </html>   