<!DOCTYPE HTML>
<html lang="es">
     <head>
        <meta charset="utf-8"/>
        <title>Entidades - aDocument 2016</title>
   
      
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
      <body>
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
  
    
      <form action="<?php echo $helper->url("Entidades","InsertaEntidades"); ?>" method="post" class="col-lg-5">
            <h4>Insertar Entidades</h4>
            <hr/>
            	
		   		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	        
	            	
	        <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ruc Entidades </p>
			  	<input type="text" name="ruc_entidades" id="ruc_entidades" value="<?php echo $resEdit->ruc_entidades; ?>" class="form-control"/>
			  <div id="" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombre Entidades</p>
			  	<input type="text" name="nombre_entidades" id="nombre_entidades" value="<?php echo $resEdit->nombre_entidades; ?>" class="form-control"/> 
			  <div id="" class="errores"></div>
			  </div>
		    </div>
		        <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Telefono Entidades </p>
			  	<input type="text" name="telefono_entidades" id="telefono_entidades" value="<?php echo $resEdit->telefono_entidades; ?>" class="form-control"/>
			  <div id="" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Direccion Entidades</p>
			  	<input type="text" name="direccion_entidades" id="direccion_entidades" value="<?php echo $resEdit->direccion_entidades; ?>" class="form-control"/> 
			  <div id="" class="errores"></div>
			  </div>
		    </div>
		      <div class="row">
		  	  </div>
			
	            	
	            	
	            	
	            	  
            
		     <?php } } else {?>
		    
		             <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Ruc Entidades </p>
			  	<input type="text" name="ruc_entidades" id="ruc_entidades" value="" class="form-control"/>
			  <div id="" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Nombre Entidades</p>
			  	<input type="text" name="nombre_entidades" id="nombre_entidades" value="" class="form-control"/> 
			  <div id="" class="errores"></div>
			  </div>
		    </div>
		        <div class="row">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Telefono Entidades </p>
			  	<input type="text" name="telefono_entidades" id="telefono_entidades" value="" class="form-control"/>
			  <div id="" class="errores"></div>
			  </div>
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Direccion Entidades</p>
			  	<input type="text" name="direccion_entidades" id="direccion_entidades" value="" class="form-control"/> 
			  <div id="" class="errores"></div>
			  </div>
		    </div>
		      <div class="row">
		 
			  </div>
			
		     <?php } ?>
		        
           <input type="submit" value="Guardar" class="btn btn-success"/>
          </form>
       
       
        <div class="col-lg-7">
            <h4>Entidades</h4>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Ruc</th>
	    		<th>Nombre</th>
	    		<th>Telefono</th>
	    		<th>Direccion</th>
	  		</tr>
            
	            <?php foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_entidades; ?>  </td>
		               <td> <?php echo $res->ruc_entidades; ?>     </td> 
		                 <td> <?php echo $res->nombre_entidades; ?>     </td>
		                 <td> <?php echo $res->telefono_entidades; ?>     </td>  
		                 <td> <?php echo $res->Direccion_entidades; ?>     </td> 
		               
		               <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Entidades","index"); ?>&id_rol=<?php echo $res->id_rol; ?>" class="btn btn-warning">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Entidades","borrarId"); ?>&id_entidades=<?php echo $res->id_entidades; ?>" class="btn btn-danger">Borrar</a>
			                </div>
			                <hr/>
		               </td>
		    		</tr>
		        <?php } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
      </section>
       
  
       
       <?php include("view/modulos/footer.php"); ?>
        
     </body>  
    </html>          