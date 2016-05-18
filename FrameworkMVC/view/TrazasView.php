<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Actividades - coactiva 2016</title>
        
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
       
       
       
       <?php
       
       
       
		   
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
   <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de Actividades</h4>
            
        </div>
        <section class="col-lg-12 actividades" style="height:400px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Usuario</th>
	    		<th style="color:#456789;font-size:80%;">Nombre del Controlador</th>
	    		<th style="color:#456789;font-size:80%;">Acción</th>
	    		<th style="color:#456789;font-size:80%;">Parámetros</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
	    		
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultActi)) {  foreach($resultActi as $res) {?>
	        		<tr>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_trazas; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->usuario_usuarios; ?></td> 
		                <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_controlador; ?></td> 
		                 <td style="color:#000000;font-size:80%;"> <?php echo $res->accion_trazas; ?></td> 
		                  <td style="color:#000000;font-size:80%;"> <?php echo $res->parametros_trazas; ?></td> 
		                  <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?></td> 
		              
		           	  
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