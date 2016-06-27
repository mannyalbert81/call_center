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
    $(document).ready(function(){
        
   	
        $("#marcar_todo").change(function () {
            if ($(this).is(':checked')) {
               
                $(".marcados").prop('checked', true); 
            } else {
                
                $("input:checkbox").prop('checked', false);
                $("input[type=checkbox]").prop('checked', false);
            }
        });
        });
	</script>
	
	<script >
$(document).ready(function() {
		
		$('#reasignar').click(function(){
	        var selected = '';  
	          
	        $('.marcados').each(function(){
	            if (this.checked) {
	                selected +=$(this)+' esta '+$(this).val()+', ';
	            }
	        }); 

	        if (selected != '') {
	            return true;
	        }
	        else{
	            alert('Debes seleccionar al menos una opción.');
	            return false;
	        }

	      
	    }); 

	});
	</script>
	
	
    </head>
    <body style="background-color: #d9e3e4;">
    <?php /*
    $("#hola").click(function(){
	    	
		    });    */ ?>
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
 <?php
 
 $nuevo_usuario="";
 
  		   $sel_id_abogado_asignado = "";
  		   
		   if ($nuevo_usuario)
		   {
		   	
		   }
		   else 
		   {
			   	if($_SERVER['REQUEST_METHOD']=='POST' )
			   	{
			   		$sel_id_abogado_asignado = $_POST['abogado_asignado'];
			   
			   	}
			   
			   	
			
		   }
	?>
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
       <!-- empieza el form --> 
  <form  action="<?php echo $helper->url("ReasignarTitulo","Index"); ?>" method="post"   class="col-lg-12">   
            	
		   		
            
          <?php if ($resultEdit !="" ) { foreach($resultEdit as $resEdit) {?>
            <?php //no hay edicion de registros ?>
		   <?php } } else {?>
		    

			     
			   <div class="col-lg-6">
			   <h4 style="color:#ec971f;">Reasignación de Abogado a los Títulos de Crédito </h4>
            	<hr/>
			   
			   <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Abogado:</p>
			  	<select name="abogado_asignado" id="abogado_asignado"  class="form-control" >
					<?php foreach($resultUsuarioImpulsor as $resAbg) {?>
						<option value="<?php echo $resAbg->id_usuarios; ?>"  <?php if($sel_id_abogado_asignado==$resAbg->id_usuarios){echo "selected";}?>><?php echo $resAbg->nombre_usuarios; ?> </option>
						           
			        <?php } ?>
				</select> 
				<div id="mensaje_tipo_honorario" class="errores"></div>			  
			  </div>
			  
			  <div class="col-xs-12 col-md-12" style="text-align: center; margin-top: 20px;" >
			  	<input type="submit" id="buscar" name="buscar" value="Buscar" class="btn btn-default"/>
			  </div>
			  
			  
			   <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Reasignar al abogado:</p>
			  	<select name="abogado_reasignar" id="abogado_reasignar"  class="form-control" >
					<?php foreach($resultUsuarioImpulsor as $resAbg) {?>
						<option value="<?php echo $resAbg->id_usuarios; ?>"><?php echo $resAbg->nombre_usuarios; ?> </option>
						           
			        <?php } ?>
				</select> 
				<div id="mensaje_tipo_honorario" class="errores"></div>			  
			  </div>
			  
			  <div class="col-xs-12 col-md-12" style="text-align: center; margin-top: 20px;" >
			  	<input type="submit" id="reasignar" name="reasignar" value="Reasignar" class="btn btn-default"/>
			  </div>   
			 
			  
			  <div class=" col-lg-12" style="margin-top: 30px;">
			  	<p  >Cantidad de registros: <?php  echo count($resultSet); ?></p>
			  	
						  
			  </div>
			   </div>
		    
		         	
		     <?php } ?>
		     
		     


       <!-- termina el form --> 
       <div class="row">
        <div class="col-lg-6">
            <h4 style="color:#ec971f;">Lista de titulo</h4>
            <hr/>
        </div>
        <section class="col-lg-6 usuario" style="height:400px;overflow-y:scroll;">

        <table class="table table-hover ">
	         <tr >
	            <th style="color:#456789;font-size:80%;"><input type="checkbox" id="marcar_todo" name="marcar_todo" class="checkbox"></th>
	    		<th style="color:#456789;font-size:80%;"><b>Nº Titulo</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Nº Juicio</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Identificacion</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Nombres Cliente</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Total</b></th>
	    		<th style="color:#456789;font-size:80%;"><b>Fecha Corte</b></th>
	    	
	    		<th></th>
	    		<th></th>
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		   <th style="color:#    ;font-size:80%;"><input type="checkbox" id="id_titulo_credito[]" name="id_titulo_credito[]" value="<?php echo $res->id_titulo_credito; ?>" class="marcados"></th>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->id_titulo_credito; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo "0"; ?>     </td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->identificacion_clientes; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->total; ?></td>
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->fecha_corte; ?>     </td>
		              
		    		</tr>
		        <?php } } ?>
            
            <?php 
            
            //echo "<script type='text/javascript'> alert('Hola')  ;</script>";
            
            ?>
            
       	</table>
       
      </section>
      </div>
       </form>
      </div>
      </div>
   
   
     </body>  
    </html>   