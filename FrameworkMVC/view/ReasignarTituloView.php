<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Reasignar Titulo - aDocument 2015</title>
        
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
       
    <script >
    
	</script>
    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
       

  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("ReasignarTitulo","InsertaRasignacionTitulo"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-6">
            
         
        	    <h4 style="color:#ec971f;">Reasignación de Abogado a los Títulos de Crédito </h4>
            	<hr/>
            	
		   		
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            
              
			   <div class="row">
			   
			   <div class="col-xs-12 col-md-6">
			  	<p  class="formulario-subtitulo" >Abogado:</p>
			  	<select name="tipo_honorario" id="tipo_honorario"  class="form-control" >
					<?php foreach($resultUsuarioImpulsor as $resAbg) {?>
						<option value="<?php echo $resAbg->id_usuarios; ?>" ><?php echo $resAbg->nombre_usuarios; ?> </option>
						           
			        <?php } ?>
				</select> 
				<div id="mensaje_tipo_honorario" class="errores"></div>			  
			  </div>
			  
			  <div class="col-xs-12 col-md-6">
			  	<p  class="formulario-subtitulo" >Reasignar al abogado:</p>
			  	<select name="tipo_honorario" id="tipo_honorario"  class="form-control" >
					<?php foreach($resultUsuarioImpulsor as $resAbg) {?>
						<option value="<?php echo $resAbg->id_usuarios; ?>"><?php echo $resAbg->descripcion_tipo_honorarios; ?> </option>
						           
			        <?php } ?>
				</select> 
				<div id="mensaje_tipo_honorario" class="errores"></div>			  
			  </div>
			  
			   </div>
		    
		     <?php } } else {?>
		    
			    <div class="row">
			    
			    <div class="col-xs-12 col-md-6">
			  	<p  class="formulario-subtitulo" >Abogado:</p>
			  	<select name="tipo_honorario" id="tipo_honorario"  class="form-control" >
					<?php foreach($resultUsuarioImpulsor as $resAbg) {?>
						<option value="<?php echo $resAbg->id_usuarios; ?>" ><?php echo $resAbg->nombre_usuarios; ?> </option>
						           
			        <?php } ?>
				</select> 
				<div id="mensaje_tipo_honorario" class="errores"></div>			  
			  </div>
			  
			  <div class="col-xs-12 col-md-6">
			  	<p  class="formulario-subtitulo" >Reasignar al abogado:</p>
			  	<select name="tipo_honorario" id="tipo_honorario"  class="form-control" >
					<?php foreach($resultUsuarioImpulsor as $resAbg) {?>
						<option value="<?php echo $resAbg->id_usuarios; ?>" ><?php echo $resAbg->nombre_usuarios; ?> </option>
						           
			        <?php } ?>
				</select> 
				<div id="mensaje_tipo_honorario" class="errores"></div>			  
			  </div>
			   
			   </div>
		    
		         	
		     <?php } ?>
		     
		     
		       <div class="row" style="margin-top: 20px;">
			  <div class="col-xs-12 col-md-6" style="text-align: center;" >
			  	<input type="submit" id="buscar" name="buscar" value="Buscar" class="btn btn-default"/>
			  </div>
			   <div class="col-xs-12 col-md-6" style="text-align: center;" >
			  	<input type="submit" id="reasignar" name="reasignar" value="Reasignar" class="btn btn-default"/>
			  </div>
			</div>     
               
		
		 <hr>
          
       </form>
       <!-- termina el form --> 
       
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de titulo</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Tipo</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Descripcion</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Desde</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Hasta</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Por la Base Porcion Fija</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Por Exceso Porcentaje</b></th>
	    		
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_honorarios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->descripcion_tipo_honorarios; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->descripcion_honorarios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->desde_honorarios; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->hasta_honorarios; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->por_base_pocion_baja; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->por_exceso_porcentaje; ?></td>
		                 
		              
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Honorarios","index"); ?>&id_honorarios=<?php echo $res->id_honorarios; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Honorarios","borrarId"); ?>&id_honorarios=<?php echo $res->id_honorarios; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
			                </div>
			                <hr/>
		               </td>
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
      </div>
      </div>
   
     </body>  
    </html>   