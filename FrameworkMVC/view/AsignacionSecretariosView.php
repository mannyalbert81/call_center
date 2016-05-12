<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Permisos Rol - coactiva 2016</title>
   
  
		
      <script>
        
       $(document).ready(function(){

		    // cada vez que se cambia el valor del combo
		    $("#id_controladores").change(function() {

               // obtenemos el combo de subcategorias
                var $id_acciones = $("#id_acciones");
               // lo vaciamos
               
				///obtengo el id seleccionado
				

               var id_controladores = $(this).val();


               $id_acciones.empty();

               $id_acciones.append("<option value= " +"0" +" > --TODOS--</option>");
           
               if(id_controladores > 0)
               {
            	   var datos = {
            			   id_controladores : $(this).val()
                   };


            	   $.post("<?php echo $helper->url("PermisosRoles","devuelveAcciones"); ?>", datos, function(resultAcc) {

            		 		$.each(resultAcc, function(index, value) {
               		 	    $id_acciones.append("<option value= " +value.id_acciones +" >" + value.nombre_acciones  + "</option>");	
                       		 });

            		 		 	 		   
            		  }, 'json');


               }
               else
               {
            	   $.post("<?php echo $helper->url("PermisosRoles","devuelveAllAcciones"); ?>", datos, function(resultAcc) {

   		 		        $.each(resultAcc, function(index, value) {
          		 	    $id_acciones.append("<option value= " +value.id_acciones +" >" + value.nombre_acciones  + "</option>");	
                	  });
     		  		}, 'json');

               }
               
		    });
    
		}); 

	</script>
		
	<script>

		$(document).ready(function(){

			$("#id_acciones").change(function() {

	               // obtenemos el combo de categorias
	                var $id_controladores = $("#id_controladores");
	               
					///obtengo el id seleccionado
					var id_acciones = $(this).val();

	               if(id_acciones > 0)

	               {
	            	   var datos = {
	            			   id_acciones : $(this).val()
	                   };


	            	   //$categorias.append("<option value= " +"0" +" >"+ id_subcategorias  +"</option>");
	                   $.post("<?php echo $helper->url("PermisosRoles","devuelveSubByAcciones"); ?>", datos, function(resultAcc) {
	            		   
         		 		  $.each(resultAcc, function(index, value) {
         		 			$('#id_controladores').val( value.id_controladores );//To select Blue	 
 								
							 });

         		 		 	 		   
         		  		}, 'json');
	                   
	               }
	               else
	               {

	          		 $('#controladres').val( 0 );//To select Blue

			        }
	               
	               
			    });
		}); 

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
  
  <div></div>
       
      <form action="<?php echo $helper->url("AsignacionSecretarios","InsertaAsignacionSecretarios"); ?>" method="post" class="col-lg-4">
            <h4 style="color:#ec971f;">Insertar Asignacion Secretarios</h4>
            <hr/>
            	
		   		
            
             <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
	            	
	            	
	            	<div class="row">
	            	
	            	<div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	Nombre Secretario: <select name="id_usuarioSecretario" id="id_usuarioSecretario"  class="form-control">
									<?php foreach($resultUsuarioSecretario as $resSecretario) {?>
				 						<option value="<?php echo $resSecretario->id_usuarios; ?>" <?php if ($resSecretario->id_usuarios == $resSecretario->id_usuarios )  echo  ' selected="selected" '  ;  ?> ><?php echo $resSecretario->nombre_usuarios; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   </div>
		   		   <div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	 Nombre Abogado Impulsor: <select name="id_usuarioImpulsor" id="id_usuarioImpulsor"  class="form-control">
									<?php foreach($resultUsuarioImpulsor as $resImpulsor) {?>
				 						<option value="<?php echo $resImpulsor->id_usuarios; ?>" <?php if ($resImpulsor->id_usuarios == $resImpulsor->id_usuarios )  echo  ' selected="selected" '  ;  ?> ><?php echo $resImpulsor->nombre_usuarios; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   
		   		    </div>
	            	</div>
		   		   
		   		   <hr>
		    
		     <?php } } else {?>
		    
	            	<div class="row">
	            	
	            	<div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	Nombre Secretario: <select name="id_usuarioSecretario" id="id_usuarioSecretario"  class="form-control">
									<?php foreach($resultUsuarioSecretario as $resSecretario) {?>
				 						<option value="<?php echo $resSecretario->id_usuarios; ?>" ><?php echo $resSecretario->nombre_usuarios; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   </div>
		   		   <div class="col-xs-12 col-md-12" style="margin-top: 20px;">
	            	 Nombre Abogado Impulsor: <select name="id_usuarioImpulsor" id="id_usuarioImpulsor"  class="form-control">
									<?php foreach($resultUsuarioImpulsor as $resImpulsor) {?>
				 						<option value="<?php echo $resImpulsor->id_usuarios; ?>"  ><?php echo $resImpulsor->nombre_usuarios; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		   
		    	    </div>
	            	</div>
		        <hr>
		     <?php } ?>
		        
		        <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
           <input type="submit" value="Guardar" class="btn btn-success"/>
           </div>
           </div>
          </form>
       
       
        <div class="col-lg-8">
            <h4 style="color:#ec971f;">Asignacion Secretarios</h4>
           
        </div>
        <section class="col-lg-8 usuario" style="height:400px;overflow-y:scroll; margin-top: 10px;">
        <table class="table table-hover">
	         <tr>
	    		<th style="color:#456789;font-size:80%;">Id</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Secretario</th>
	    		<th style="color:#456789;font-size:80%;">Nombre Abogado Impulsor</th>
	    		<th style="color:#456789;font-size:80%;">Editar</th>
	    		<th style="color:#456789;font-size:80%;">Borrar</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res-> id_asignacion_secretarios; ?>  </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->secretarios; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res-> impulsadores; ?>     </td> 
		               
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("AsignacionSecretarios","index"); ?>&id_asignacion_secretarios=<?php echo $res->id_asignacion_secretarios; ?>" class="btn btn-warning" style="font-size:65%;">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("AsignacionSecretarios","borrarId"); ?>&id_asignacion_secretarios=<?php echo $res->id_asignacion_secretarios; ?>" class="btn btn-danger" style="font-size:65%;">Borrar</a>
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