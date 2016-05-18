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
           		
           		<input type="submit" id="procesar" name="procesar" value="Procesar" class="btn btn-success"/>
           </div>
        </div>
    </form>
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Archivos Procesados</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        
        	<table class="table table-hover">
	         <tr>
	    		
	    		
	    		<th>Id</th>
	    		<th>Fecha</th>
	    		<th>Hora</th>
	    		<th>Institucion</th>
	    		<th>Registros</th>
	    		<th>Monto</th>
	    		<th>Procesado</th>
	  		</tr>
                <?php $registros = 1;?>
                 <?php foreach($resultSet as $res) {?>
	        		<tr>
	        		   <td> <?php echo $registros; ?>  </td>
	        		   <td> <?php echo $res->fecha_creacion_recaudacion_cabeza; ?>     </td> 
		               <td> <?php echo $res->hora_creacion_recaudacion_cabeza; ?>     </td>
		               <td> <?php echo $res->nombre_recaudacion_institucion; ?>     </td>
		               <td> <?php echo $res->cantidad_registros_recaudacion_cabeza; ?>     </td>
		               <td> <?php echo $res->valor_total_dolares_recaudacion_cabeza; ?>     </td>
		               <td> <?php echo $res->creado; ?>     </td>
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("FirmasDigitales","index"); ?>&id_firmas_digitales=<?php echo $res->id_recaudacion_cabeza; ?>" class="btn btn-warning" style="font-size:65%;">Detalle</a>
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
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          
