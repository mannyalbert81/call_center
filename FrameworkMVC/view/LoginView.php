
     <?php include("view/modulos/head.php"); ?>
<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="utf-8"/>
        <title>Login - CallCenter 2016</title>
       
       
      	 <link rel="stylesheet" href="view/css/bootstrap.css">
    
			  <script src="view/js/jquery.js"></script>
			  <script src="view/js/bootstrap.min.js"></script>
			  <script src="view/js/bootstrapValidator.min.js"></script>
			  <script src="view/js/noty.js"></script>
			  <script src="view/js/ValidarLogin.js"></script>
     
     
  
     
     
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
    
     <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
     
       
   
   
        <form id="form-login"  action="<?php echo $helper->url("Usuarios","Loguear"); ?>" method="post" class="col-lg-6" style="padding-top:250px;">
                     
    <div id="login-overlay" class="modal-dialog" >
      <div class="modal-content">
          
          <div class="modal-body">
              
              <div class="row" >
               <div class="col-lg-6 col-md-3" >
                      <div class="well">
                              <div class="form-group">
                                  <label for="usuarios" class="control-label">Usuario</label>
                                  <input type="text" class="form-control" id="usuarios" name="usuarios" value=""  placeholder="Usuario">
                                  <span class="help-block"></span>
                              </div>
                              <div class="form-group">
                                  <label for="clave" class="control-label">Password</label>
                                  <input type="password" class="form-control" id="clave" name="clave" value="" placeholder="Password">
                                  <span class="help-block"></span>
                              </div>
                             
                              <button type="submit" class="btn btn-success btn-block">Login</button>
                               
                      </div>
                  </div>
                  
                		  <div class="col-lg-6 col-md-3">
		                      <p class="lead">Consejos de Seguridad <span class="text-success"></span></p>
		                      <ul class="list-unstyled" style="line-height: 2">
		                          <li><span class="fa fa-check text-success"></span> Recuerda tu usuario y tu clave.</li>
		                          <li><span class="fa fa-check text-success"></span> No enseñes a nadie tu clave.</li>
		                          <li><span class="fa fa-check text-success"></span> La clave es personal.</li>
		                          <li><span class="fa fa-check text-success"></span> Cuidala.</li>
		                     
		                      </ul>
		                  </div>
              </div>
              
          </div>
      </div>
 </div>
 </form>
       
   <br>
        
    	<footer class="col-lg-12">
           <?php include("view/modulos/footer.php"); ?>
        </footer>     
    </body>
</html>