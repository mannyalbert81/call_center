<!DOCTYPE HTML>
<html lang="es">
      <head>
        <meta charset="utf-8"/>
        <title>Usuarios - aDocument 2015</title>
   
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

		    $("#Guardar").click(function() {


		    	//alert("sus claves no coinciden");
		    	return false;
		    	

/*
		    	if (   $('#clave_usuarios').val()) ==  $('#clave_usuarios_r').val()) )
		    	{
					
	    	    }
				else
				{
					alert('Clave no coinciden');
					
				}
*/

			  });

		}); 

	</script>
    </head>
    <body>
    
       <?php include("view/modulos/head.php"); ?>
       
       <?php include("view/modulos/menu.php"); ?>
  
  <div class="container">
  
  <div class="row">
  
  <div></div>
    
      <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Usuarios","InsertaUsuarios"); ?>" method="post" class="col-lg-5">
            <h4 style="color:#ec971f;">Insertar Usuarios</h4>
            <hr/>
            <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            <table class="table">
            	<tr>
            		<th style="width: 50%">Nombres Usuario </th>
            		<th style="width: 50%">Usuario </th>
            		
            	</tr>
            	<tr>
				   <td>	<input type="text" name="nombre_usuarios" value="<?php echo $resEdit->nombre_usuarios; ?>" class="form-control"/> </td>
		           <td> <input type="text" name="usuario_usuarios" value="<?php echo $resEdit->usuario_usuarios; ?>" class="form-control"/> </td>
	            </tr>
	            <tr>
            		<th style="width: 50%">Clave Usuario </th>
            		<th style="width: 50%">Repita Clave Usuario </th>
            	</tr>
	            <tr>
		            <td> <input type="password" name="clave_usuarios" id="clave_usuarios" value="" class="form-control"/></td>
		            <td> <input type="password" name="clave_usuarios_r" id="clave_usuarios_r"  value="" class="form-control"/></td>
	            </tr>
	            <tr>
            		<th style="width: 50%">Teléfono Usuario </th>
            		<th style="width: 50%">Celular  Usuario </th>
            	</tr>
	            <tr>
	        		<td> <input type="text" name="telefono_usuarios" value="<?php echo $resEdit->telefono_usuarios; ?>" class="form-control"/> </td>
            		<td> <input type="text" name="celular_usuarios" value="<?php echo $resEdit->celular_usuarios; ?>" class="form-control"/> </td>    
	            </tr>
                <tr>
            		<th style="width: 50%">Correo Usuario </th>
            		<th style="width: 50%">Rol Usuario </th>
            	</tr>
                <tr>
                	<td>
            		<select name="id_rol" id="id_rol"  class="form-control">
									<?php foreach($resultRol as $resRol) {?>
				 						<option value="<?php echo $resRol->id_rol; ?>" <?php if ($resRol->id_rol == $resEdit->id_rol )  echo  ' selected="selected" '  ;  ?> ><?php echo $resRol->nombre_rol; ?> </option>
						            <?php } ?>
								    	
									</select>
									
					</td>    
                
                   <td> <input type="email" name="correo_usuarios" value="<?php echo $resEdit->correo_usuarios; ?>" class="form-control"/> </td>
                </tr>
                <tr>
            		
            		<th style="width: 50%">Estado Usuario </th>
            	</tr>
                
                <tr>
                
                
                	<td>
						<select name="id_estado" id="id_estado"  class="form-control">
									<?php foreach($resultEst as $resEst) {?>
				 						<option value="<?php echo $resEst->id_estado; ?>" <?php if ($resEst->id_estado == $resEdit->id_estado )  echo  ' selected="selected" '  ;  ?> ><?php echo $resEst->nombre_estado; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		                
                	</td>
                	<td></td>
            	</tr>
		   	
		    </table>        
            
		     <?php } } else {?>
		    
		    <table class="table">
            	<tr>
            		<th style="width: 50%">Nombres Usuario </th>
            		<th style="width: 50%">Usuario </th>
            		
            	</tr>
            	<tr>
				   <td>	<input type="text" name="nombre_usuarios" value="" class="form-control"/> </td>
		           <td> <input type="text" name="usuario_usuarios" value="" class="form-control"/> </td>
	            </tr>
	            <tr>
            		<th style="width: 50%">Clave Usuario </th>
            		<th style="width: 50%">Repita Clave Usuario </th>
            	</tr>
	            <tr>
		            <td> <input type="password" name="clave_usuarios" id="clave_usuarios" value="" class="form-control"/></td>
		            <td> <input type="password" name="clave_usuarios_r" id="clave_usuarios_r" value="" class="form-control"/></td>
	            </tr>
	            <tr>
            		<th style="width: 50%">Teléfono Usuario </th>
            		<th style="width: 50%">Celular  Usuario </th>
            	</tr>
	            <tr>
	        		<td> <input type="text" name="telefono_usuarios" value="" class="form-control"/> </td>
            		<td> <input type="text" name="celular_usuarios" value="" class="form-control"/> </td>    
	            </tr>
                <tr>
            		<th style="width: 50%">Rol Usuario </th>
            		<th style="width: 50%">Correo Usuario </th>
            	</tr>
                <tr>
                	<td>
            		<select name="id_rol" id="id_rol"  class="form-control">
									<?php foreach($resultRol as $resRol) {?>
				 						<option value="<?php echo $resRol->id_rol; ?>" ><?php echo $resRol->nombre_rol; ?> </option>
						            <?php } ?>
								    	
									</select>
									
					</td>    
                
                   <td> <input type="email" name="correo_usuarios" value="" class="form-control"/> </td>
                </tr>
                <tr>
            		
            		<th style="width: 50%">Estado Usuario </th>
            	</tr>
                
                <tr>
                
                
                	<td>
						<select name="id_estado" id="id_estado"  class="form-control">
									<?php foreach($resultEst as $resEst) {?>
				 						<option value="<?php echo $resEst->id_estado; ?>" ><?php echo $resEst->nombre_estado; ?> </option>
						            <?php } ?>
								    	
									</select>
		   		                
                	</td>
                	<td></td>
            	</tr>
		   	
		    </table>        
               	
		     <?php } ?>
		        
           <input type="submit" value="Guardar" id="Guardar" class="btn btn-success"/>
          </form>
       <!-- termina el form --> 
       
        <div class="col-lg-7">
            <h4 style="color:#ec971f;">Lista de Usuarios</h4>
            <hr/>
        </div>
        <section class="col-lg-7 usuario" style="height:600px;overflow-y:scroll;">
        <table class="table table-hover">
	         <tr>
	    		<th>Id</th>
	    		<th>Nombre</th>
	    		<th>Usuario</th>
	    		<th>Teléfono</th>
	    		<th>Celular</th>
	    		<th>Correo</th>
	    		<th>Rol</th>
	    		<th>Estado</th>
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	                   <td> <?php echo $res->id_usuarios; ?>  </td>
		               <td> <?php echo $res->nombre_usuarios; ?>     </td> 
		               <td> <?php echo $res->usuario_usuarios; ?>  </td>
		               <td> <?php echo $res->telefono_usuarios; ?>  </td>
		               <td> <?php echo $res->celular_usuarios; ?>  </td>
		               <td> <?php echo $res->correo_usuarios; ?>  </td>
		               <td> <?php echo $res->nombre_rol; ?>  </td>
		               <td> <?php echo $res->nombre_estado; ?>  </td>
		           	   <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("Usuarios","index"); ?>&id_usuarios=<?php echo $res->id_usuarios; ?>" class="btn btn-warning">Editar</a>
			                </div>
			            
			             </td>
			             <td>   
			                	<div class="right">
			                    <a href="<?php echo $helper->url("Usuarios","borrarId"); ?>&id_usuarios=<?php echo $res->id_usuarios; ?>" class="btn btn-danger">Borrar</a>
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
   </div>
     </body>  
    </html>   