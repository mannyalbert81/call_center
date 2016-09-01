<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Login - CallCenter 2016</title>
       
       
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
		
		
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>   
       
        <style>
            input{
                margin-top:5px;
                margin-bottom:5px;
            }
            .right{
                float:right;
            }
        </style>
        <style>
			body {
			
			    /* Ubicación de la imagen */
		 
		  background-image: url(view/images/call_center.jpg);
		
		  /* Nos aseguramos que la imagen de fondo este centrada vertical y
		    horizontalmente en todo momento */
		  background-position: center center;
		
		  /* La imagen de fondo no se repite */
		  background-repeat: no-repeat;
		
		  /* La imagen de fondo está fija en el viewport, de modo que no se mueva cuando
		     la altura del contenido supere la altura de la imagen. */
		  background-attachment: fixed;
		
		  /* La imagen de fondo se reescala cuando se cambia el ancho de ventana
		     del navegador */
		  background-size: cover;
		
		  /* Fijamos un color de fondo para que se muestre mientras se está
		    cargando la imagen de fondo o si hay problemas para cargarla  */
		  background-color: #464646;
			}
			</style>
    </head>
   
   
   
    <body class="img-responsive" style="background-color: #d9e3e4;" >
     <?php include("view/modulos/modal.php"); ?>
     <?php include("view/modulos/head.php"); ?>
       
   
   
        <form action="<?php echo $helper->url("usuarios","Loguear"); ?>" method="post"  class="col-lg-12" style=" padding-top:150px;">
        
        <div class="row">
        
        
        	<div class="col-xs-1 col-md-1">
        	</div>
        	<div class="col-xs-8 col-md-4">
        		<div class="col-xs-4 col-md-2">
        		</div>
        		
        	    <div class="col-xs-8 col-md-8">
		        	  <div   style="background:#A5DF00 ;border-radius: 5px;  border: 1px solid #063B41;"  >
		     		     <div class="row">
								<div class="col-xs-2 col-md-2">					
									
								</div>
								
								
								<div class="col-xs-8 col-md-8">					
									<h5 class="text-center" style="color: #ffffff;" >Inicio de Sesión</h5>
								</div>
								<div class="col-xs-2 col-md-2">					
									
								</div>
						</div>            	
		            		
		     		     
		     		     
		   
		        		<div class="text-center"  >
							<div class="row">
								<div class="col-xs-2 col-md-2">					
									
								</div>
								<div class="col-xs-8 col-md-8">					
									<input type="text" name="usuarios" class="form-control" placeholder="Usuario"  style="text-align: center; " />
								</div>
								<div class="col-xs-2 col-md-2">					
									
								</div>
							</div>            	
		            		<div class="row">
								<div class="col-xs-2 col-md-2">					
									
								</div>
								<div class="col-xs-8 col-md-8">					
									<input type="password" name="clave" placeholder="Clave" class="form-control"  style="text-align: center; "/>
								</div>
								<div class="col-xs-2 col-md-2">					
									
								</div>
							</div>            	
		            		
		            		<div class="row">
								<div class="col-xs-2 col-md-2">					
									
								</div>
								<div class="col-xs-8 col-md-8">					
									<input type="submit" value="Login" class="btn btn-default" />
								<br>
								<br>
									
								</div>
								<div class="col-xs-2 col-md-2">					
									
								</div>
							</div>            	
		            		
		            	
		            	</div>
		              </div>
		          </div>
		          <div class="col-xs-2 col-md-2">
        		  </div>
        	</div>
            <div class="col-xs-3 col-md-3">
        	</div>
        	
          
    	</div>    
        </form>
       
   
        
    	<footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>     
    </body>
</html>