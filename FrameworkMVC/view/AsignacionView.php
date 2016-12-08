    <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Asignacion - CallCenter 2016</title>
        
          <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  <script src="view/js/ValidarUsuarios.js"></script>
		
	
       
         
           <script >
		$(document).ready(function(){

			$("#Buscar").click(function()

			{

				var contenido = $("#contenido").val();
				var criterio= $("#criterio").val();

				if (contenido != "" && criterio==0)
		    	{
					$("#mensaje_criterio").text("Seleccione filtro de busqueda");
		    		$("#mensaje_criterio").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    }
		    	else 
		    	{
		    		$("#mensaje_criterio").fadeOut("slow"); //Muestra mensaje de error
		    		
		            
				}    

				if (criterio !=0 && contenido=="")
		    	{

			    	
		    		$("#mensaje_contenido").text("Ingrese Contenido a buscar");
		    		$("#mensaje_contenido").fadeIn("slow"); //Muestra mensaje de error
		            return false;
			    	
		    		
			    }
		    	else 
		    	{
		    		$("#mensaje_contenido").fadeOut("slow"); //Muestra mensaje de error
		            
				}    


				

		
				
			});


			$( "#contenido" ).focus(function() {
				  $("#mensaje_contenido").fadeOut("slow");
			    });

			$( "#criterio" ).focus(function() {
				  $("#mensaje_criterio").fadeOut("slow");
			    });
		   
			
		});
			</script >
			
			

	
    </head>
    <body class="cuerpo">
    
   
       <?php include("view/modulos/menu.php"); ?>
     
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
      
      <!-- empieza el form --> 
       
      <form id="form-usuarios" action="<?php echo $helper->url("Asignacion","InsertaAsignacion"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-5">
           
           <br>
            
       
		    
		    
			<div class="well">
            <h4 style="color:#ec971f;">Datos del Usuario</h4>
            <hr/>
            <div class="row">
		    <div class="col-xs-6 col-md-6">
		    <div class="form-group ">
		                          <label for="cedula_usuarios" class="control-label">Cedula</label>
                                  <input type="text" class="form-control" id="cedula_usuarios" name="cedula_usuarios" value=""  placeholder="Cedula">
                                  <span class="help-block"></span>
            </div>
		    </div>
		    </div>
		    </div> 
		 
		    
		   
               	
		   
		    
		     <div class="row">
		    <div class="col-xs-12 col-md-12 col-lg-12" style="text-align: center;">
		    <div class="form-group">
                                  <button type="submit" id="Guardar" name="Guardar" class="btn btn-success">Guardar</button>
            </div>
		    </div>
		    </div>     
            </form>
       
      
      
            
       		<form action="<?php echo $helper->url("Usuarios","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-7">
     		<br>
     		<div class="well">  
            <h4 style="color:#ec971f;">Usuarios Registrados</h4>
            
            <div class="row">
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <input type="text" class="form-control" id="contenido" name="contenido" value="">
                                  
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <select name="criterio" id="criterio"  class="form-control">
                                    <?php foreach($resultMenu as $val=>$desc) {?>
                                         <option value="<?php echo $val ?>" ><?php echo $desc ?> </option>
                                    <?php } ?>
                                  </select>
            </div>
		    </div>
		    <div class="col-xs-4 col-md-4 col-lg-4">
		    <div class="form-group">
                                  
                                  <button type="submit" id="Buscar" name="Buscar" class="btn btn-info">Buscar</button>
            </div>
		    </div>
			</div>  
             
       
       <div class="datagrid"> 
       <section style="height:485px; overflow-y:scroll;">
       <table class="table table-hover ">
       
       <thead>
           <tr>
		            <th style="font-size:100%;"></th>
		    		<th style="font-size:100%;">Id</th>
		    		<th style="font-size:100%;">Nombre</th>
		    		<th style="font-size:100%;">Rol</th>
		    		
		    		
	  		</tr>
	   </thead>
       <tfoot>
       		<tr>
					<td colspan="4">
						<div id="paging">
							<ul>
								<li>
									<a href="#">
						<span>Previous</span>
									</a>
								</li>
								<li>
									<a href="#" class="active">
						<span>1</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>2</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>3</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>4</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>5</span>
									</a>
								</li>
								<li>
									<a href="#">
						<span>Next</span>
									</a>
								</li>
								</ul>
						</div>
					
			</tr>
       				
       </tfoot>
       
                <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        	 
               
	   <tbody>
	   		<tr>
	        		   <td> <input type="image" name="image" src="view/DevuelveImagen.php?id_valor=<?php echo $res->id_usuarios; ?>&id_nombre=id_usuarios&tabla=usuarios&campo=imagen_usuarios"  alt="<?php echo $res->id_usuarios; ?>" width="40" height="40" >      </td>
		               <td style="font-size:80%;"> <?php echo $res->id_usuarios; ?></td>
		               <td style="font-size:80%;"> <?php echo $res->nombre_usuarios; ?>     </td> 
		               <td style="font-size:80%;"> <?php echo $res->nombre_rol; ?>  </td>
	   
		     </tr>
	   
	   </tbody>	
	        		
		        <?php } }else{ ?>
            <tr>
            <td></td>
            <td></td>
	                   <td colspan="5" style="color:#ec971f;font-size:8;"> <?php echo '<span id="snResult">No existen resultados</span>' ?></td>
	        <td></td>
		               
		    </tr>
            <?php 
		}
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>     
		     
      </section>
      
       </div>
        </div>
          </form> 
   
     
      </div>
      
      
      <br>
      <br>
      <br>
      <br>
      
   </div>
   <?php include("view/modulos/footer.php"); ?>
     </body>  
    </html>   