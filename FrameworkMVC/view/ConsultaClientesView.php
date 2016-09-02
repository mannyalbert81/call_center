 <!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Consulta Clientes - CallCenter 2016</title>
        
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
				alertify.success("Has Pulsado en Reporte"); 
				return false;
			}
			
			function Borrar(){
				alertify.success("Has Pulsado en Borrar"); 
				return false; 
			}

			function notificacion(){
				alertify.success("Has Pulsado en Buscar"); 
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
         
       
	

    </head>
    <body style="background-color: #d9e3e4;">
    
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       <?php

       $sel_id_ciudad = "";
       $sel_identificacion="";
       $sel_nombres_clientes="";
       $sel_celular_clientes="";
       $sel_fecha_desde="";
       $sel_fecha_hasta="";
        
    
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	 
       	 
       	$sel_id_ciudad = $_POST['id_ciudad'];
       	$sel_identificacion=$_POST['identificacion'];
       	$sel_nombres_clientes=$_POST['nombres_clientes'];
       	$sel_celular_clientes=$_POST['celular_clientes'];
       	$sel_fecha_desde=$_POST['fecha_desde'];
       	$sel_fecha_hasta=$_POST['fecha_hasta'];
       	 
       }
      
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("Clientes","consulta_clientes"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
         
         <!-- comienxza busqueda  -->
         <div class="col-lg-12" style="margin-top: 10px">
         
       	 <h4 style="color:#ec971f;">Consulta Clientes</h4>
       	 
       	 
       	 <div class="panel panel-default">
  			<div class="panel-body">
  			
  			
		   			
          <div class="col-xs-2">
			  	<p  class="formulario-subtitulo" style="" >Ciudad:</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" >
			  		<?php foreach($resultCiu as $res) {?>
						<option value="<?php echo $res->id_ciudad; ?>" <?php if($sel_id_ciudad==$res->id_ciudad){echo "selected";}?>><?php echo $res->nombre_ciudad;  ?> </option>
			            <?php } ?>
				</select>
		 </div>
		 
		 <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Identificacion:</p>
			  	<input type="text"  name="identificacion" id="identificacion" value="<?php echo $sel_identificacion;?>" class="form-control"/> 
			    <div id="mensaje_identificacion" class="errores"></div>

         </div>
		 
		  <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Nombres y Apellidos</p>
			  	<input type="text"  name="nombres_clientes" id="nombres_clientes" value="<?php echo $sel_nombres_clientes;?>" class="form-control"/> 
			    

         </div>
          <div class="col-xs-2 ">
			  	<p  class="formulario-subtitulo" >Celular</p>
			  	<input type="text"  name="celular_clientes" id="celular_clientes" value="<?php echo $sel_celular_clientes;?>" class="form-control"/> 
			    <div id="mensaje_numero_titulo" class="errores"></div>

         </div>
         
         <div class="col-xs-2 ">
         		<p class="formulario-subtitulo" >Desde:</p>
			  	<input type="date"  name="fecha_desde" id="fecha_desde" value="<?php echo $sel_fecha_desde;?>" class="form-control "/> 
			    <div id="mensaje_fecha_desde" class="errores"></div>
		</div>
         
          <div class="col-xs-2 ">
          		<p class="formulario-subtitulo" >Hasta:</p>
			  	<input type="date"  name="fecha_hasta" id="fecha_hasta" value="<?php echo $sel_fecha_hasta;?>" class="form-control "/> 
			    <div id="mensaje_fecha_hasta" class="errores"></div>
		</div>
		 
  			</div>
  		<div class="col-lg-12" style="text-align: center; margin-bottom: 20px">
		 <input type="submit" id="buscar" name="buscar" value="Buscar" class="btn btn-warning " onClick="notificacion()" style="margin-top: 10px;"/> 	
		
		<?php if(!empty($resultSet))  {?>
		 <a href="/FrameworkMVC/view/ireports/ContClientesReport.php?id_ciudad=<?php  echo $sel_id_ciudad ?>&identificacion=<?php  echo $sel_identificacion?>&nombres_clientes=<?php  echo $sel_nombres_clientes?>&celular_clientes=<?php  echo $sel_celular_clientes?>&fecha_desde=<?php  echo $sel_fecha_desde?>&fecha_hasta=<?php  echo $sel_fecha_hasta?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" style="margin-top: 10px;" class="btn btn-success">Reporte</a>
		            
		  <?php } else {?>
		  
		  <?php } ?>
		 </div>
		</div>
        	
		 </div>
		 
		 
		 <div class="col-lg-12">
		 
	      <div class="col-lg-12">
		 <div class="col-lg-10"></div>
		 <div class="col-lg-2">
		 <span class="form-control" style="margin-bottom:0px;"><strong>Registros:</strong><?php if(!empty($resultSet)) echo "  ".count($resultSet);?></span>
		 </div>
		 </div>
		 <div class="col-lg-12">
		 
		 
		 <section class="" style="height:300px;overflow-y:scroll;">
        <table class="table table-hover ">
	         <tr >
	            
	    		<th style="color:#456789;font-size:80%;"><b>Id</b></th>
	    		<th style="color:#456789;font-size:80%;">Tipo Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">N° Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Cliente</th>
	    		<th style="color:#456789;font-size:80%;">Tipo Persona</th>
	    		<th style="color:#456789;font-size:80%;">Ciudad</th>
	    		<th style="color:#456789;font-size:80%;">Telefono</th>
	    		<th style="color:#456789;font-size:80%;">Celular</th>
	    		<th style="color:#456789;font-size:80%;">Direccion</th>
	    		<th style="color:#456789;font-size:80%;">Fecha</th>
	    	    <th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		
	        		  
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_clientes; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_identificacion; ?>     </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		                 <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_tipo_persona; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_ciudad; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->telefono_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->celular_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->direccion_clientes; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->creado; ?>     </td> 
		                <td style="color:#000000;font-size:80%;">
		               <a href="/FrameworkMVC/view/ireports/ContClientesSubReport.php?id_clientes=<?php echo $res->id_clientes; ?>" onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false" class="btn btn-success" onClick="Ok()" style="font-size:80%;">Ver</a>
		               </td> 
		    		</tr>
		        <?php } }  ?>
           
       	</table>     
      </section>
		 
		 		 
		 </div>
		 </div>
		
		
      
       </form>
     
      </div>
     
  </div>
      <?php include("view/modulos/footer.php"); ?>
   </body>  

    </html>   