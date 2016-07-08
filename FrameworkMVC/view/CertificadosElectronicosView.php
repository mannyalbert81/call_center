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
				alertify.success("Has Pulsado en Aceptar"); 
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
	

	</script>
        
        
        
    </head>
      <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
      
       <?php
       
        
		?>



  
  <div class="container">
  
     <div class="row" style="background-color: #ffffff;">
  
  	      <form action="<?php echo $helper->url("CertificadosElectronicos","index"); ?>" enctype="multipart/form-data"  method="post" class="col-lg-6">
           
            <h4 style="color:#ec971f;">Insertar Firmas Digitales</h4>
            <hr/>
            
            <div class="row">
			<div class="col-xs-12 col-md-12" style="text-align: center;" > 
           		<input type="submit" id="registrar" name="registrar" value="Registrar" class="btn btn-success"/>
           </div>
        </div>
          <?php if (!empty($resultCertificado) ) { ?>
          
          	<div class="row">
          	<div class="col-xs-6 col-md-6">
          	<p  class="formulario-subtitulo" >Alias</p>
          	<input type="text" id="alias" name="alias" value="<?php ?> " class="form-control">
          	</div>
          	 
          	</div>
          	
          	<div class="row">
          	<div class="col-xs-6 col-md-6">
          	<p  class="formulario-subtitulo" >Emitido por:</p>
          	<input type="hidden" id="numero_serie" name="numero_serie" value="<?php echo  $resultCertificado[0];?> " class="form-control">
          	<input type="text" id="emitido_por" name="emitido_por" value="<?php echo  $resultCertificado[1];?> " class="form-control">
          	</div>
          	 
          	</div>
          	
          	<div class="row">
          	<div class="col-xs-6 col-md-6">
          	<p  class="formulario-subtitulo" >Emitido para:</p>
          	<input type="text" id="emitido_para" name="emitido_para" value="<?php echo  $resultCertificado[2];?> " class="form-control">
          	</div>
          	</div>
          	
          	<div class="row">
          	<div class="col-xs-6 col-md-6">
          	
          	<input type="hidden" id="fecha_expira" name="fecha_expira" value="<?php echo  $resultCertificado[3];?> " class="form-control">
          	</div>
          	 
          	</div>
          	
          	<div class="row">
			<div class="col-xs-12 col-md-12" style="text-align: center;" > 
           		<input type="submit" id="aceptar" name="aceptar" value="Aceptar" onClick="Ok()" onclick="this.form.action='<?php echo $helper->url("CertificadosElectronicos","InsertaFirmas"); ?>'" class="btn btn-success"/>
           </div>
           </div>
          	
          	<hr>
	        
		     <?php  } else {?>
		    	
		   
		    	
		    	 <div class="row">
		    	<div class="col-xs-6 col-md-6">
		    	<p  class="formulario-subtitulo" >Alias</p>
		         <input type="text" id="alias" name="alias" value=" " class="form-control">
		         </div>
		         
			  </div>
	 	       
			<hr>
		     <?php } ?>
		
    </form>
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;"></h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        
        	<table class="table table-hover">
	         <tr>
	    		
	    		
	    		
	  		</tr>
                <?php $registros = 1;?>
                 <?php if($resultSet!=""){ foreach($resultSet as $res) {?>
	        		<tr>
	        		   <td> <?php echo $registros; ?>  </td>
		               <td> <?php echo $res->nombre_usuarios; ?>     </td> 
		               <td> <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $res->id_firmas_digitales; ?>&id_nombre=id_firmas_digitales&tabla=firmas_digitales&campo=imagen_firmas_digitales"  alt="<?php echo $res->id_usuarios; ?>" width="80" height="60" >      </td>
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("FirmasDigitales","index"); ?>&id_firmas_digitales=<?php echo $res->id_firmas_digitales; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("FirmasDigitales","borrarId"); ?>&id_firmas_digitales=<?php echo $res->id_firmas_digitales; ?>" class="btn btn-danger" onClick="Borrar()" style="font-size:65%;">Borrar</a>
			                </div>
			                <hr/>
		               </td>
		    		</tr>
		    		<?php $registros ++?>
		        <?php } }?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
        	
        
        
        </section>
       </div>
 
  </div>
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          
