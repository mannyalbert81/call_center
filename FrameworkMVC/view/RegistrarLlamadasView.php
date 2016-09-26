


<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Registrar Llamadas - CallCenter 2016</title>
        
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
				alertify.success("Has Pulsado en Guardar"); 
				return false;
			}
			
			function Borrar(){
				alertify.success("Has Pulsado en Borrar"); 
				return false; 
			}

			function notificacion(){
				alertify.success("Has Pulsado en Editar"); 
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
       
        
	
	<script>
		function contador (campo, cuentacampo, limite) {
		if (campo.value.length > limite) campo.value = campo.value.substring(0, limite);
		else cuentacampo.value = limite - campo.value.length;
		} 
    </script>
	
	
	<script >
        $(document).ready(function() {
		$('#Guardar').click(function(){
	        var selected = ''; 
	        var selected_no= '';

	        $('#recibio_registrar_llamadas_si').each(function(){
	            if (this.checked) {
	                selected +=$(this)+' esta '+$(this).val()+', ';
	            }
	        }); 
	        $('#recibio_registrar_llamadas_no').each(function(){
	            if (this.checked) {
	            	selected_no +=$(this)+' esta '+$(this).val()+', ';
	            }
	        }); 

	        if (selected != '' || selected_no!='') {
	            return true;
	        }
	        else{
	            alert('Debes seleccionar Si o No.');
	            return false;
	        }


	      
	    }); 

	});
	</script>
	
	
	<script>
       $(document).ready(function(){

    	   $("#persona_contesta_llamada").prop("disabled","disabled");
    	   $("#observaciones_registra_llamadas").prop("disabled","disabled");
    	   $("#parentesco_clientes").prop("disabled","disabled");
 

            $("#recibio_registrar_llamadas_si").click(function(){

            	var cant = $("input:checked").length;
            	
                if(cant!=0)
                {
            	 $("#persona_contesta_llamada").prop("disabled","");
          	     $("#observaciones_registra_llamadas").prop("disabled","");
          	     $("#parentesco_clientes").prop("disabled","");
                }else
                    {
                	  $("#persona_contesta_llamada").prop("disabled","disabled");
               	      $("#observaciones_registra_llamadas").prop("disabled","disabled");
               	      $("#parentesco_clientes").prop("disabled","disabled");
                    }
                
                });
 	    });
       </script>
	
		<script>
       $(document).ready(function(){

    	   $("#persona_contesta_llamada").prop("disabled","disabled");
    	   $("#observaciones_registra_llamadas").prop("disabled","disabled");
    	   $("#parentesco_clientes").prop("disabled","disabled");
 
           $("#recibio_registrar_llamadas_no").click(function(){

            	var cant = $("input:checked").length;
            	
                if(cant!=0)
                {
            	 $("#persona_contesta_llamada").prop("disabled","disabled");
          	     $("#observaciones_registra_llamadas").prop("disabled","disabled");
          	     $("#parentesco_clientes").prop("disabled","disabled");
                }else
                    {
                	  $("#persona_contesta_llamada").prop("disabled","disabled");
               	      $("#observaciones_registra_llamadas").prop("disabled","disabled");
               	      $("#parentesco_clientes").prop("disabled","disabled");
                    }
                
                });
 	    });
       </script>
	
	
    </head>
    <body style="background-color: #d9e3e4;" >
    
       <?php include("view/modulos/modal.php"); ?>
       <?php include("view/modulos/head.php"); ?>
       <?php include("view/modulos/menu.php"); ?>
       
       
       <?php
       
       $sel_identificacion = "";
       $sel_numero_titulo_credito = "";
      
       
       if($_SERVER['REQUEST_METHOD']=='POST' )
       {
       	 
       		$sel_identificacion = $_POST['identificacion'];
       		$sel_numero_titulo_credito = $_POST['numero_titulo_credito'];
       	
      	 
       }
       
      
       
       
       $habilitar="disabled";
       if(!empty($resultEdit)){
       	$habilitar="";
       }
       
       
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
  
    
      <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("RegistrarLlamadas","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
            
         <div class="col-lg-12">
         
         <h4 style="color:#ec971f; text-align: center;" >Busqueda</h4>
        	 	
		   	<div class="panel panel-default">
  			<div class="panel-body">
  			
  			<div class="row">
  			<div class="col-xs-2 col-md-2" style="text-align: center;">
			  
            </div>
		    <div class="col-xs-3 col-md-3" style="text-align: center;">
			  	<p  class="formulario-subtitulo" >Identificacion:</p>
			  	<input type="text"  name="identificacion" id="identificacion" value="<?php echo $sel_identificacion;?>" class="form-control"/> 
			   
            </div>
		   
		   <div class="col-xs-3 col-md-3" style="text-align: center;">
			  	<p  class="formulario-subtitulo" >Titulo Credito:</p>
			  	<input type="text"  name="numero_titulo_credito" id="numero_titulo_credito" value="<?php echo $sel_numero_titulo_credito;?>" class="form-control"/> 
			   
            </div>
		   
		   <div class="col-xs-3 col-md-3">
			 <input type="submit" id="buscar" name="buscar"  value="Buscar" class="btn btn-warning " onClick="notificacion()" style="margin-top: 30px;"/> 	
		  
		  </div>
		    </div>
		    </div>
		    </div>	
            
             </div>
             
            	
          <?php if(!empty($resultSet))  {?>
		    <div class="col-lg-12">
			 <div class="panel-panel-default">
			 <div class="panel-body">
  		     <section class="" style="height:100px;overflow-y:scroll;">
             <table class="table table-hover ">
	         <tr >
	            
	            <th style="color:#456789;font-size:80%;"></th>
	            <th style="color:#456789;font-size:80%;">Identificacion</th>
	    		<th style="color:#456789;font-size:80%;">Nombre</th>
	    		<th style="color:#456789;font-size:80%;">Ciudad</th>
	    		<th style="color:#456789;font-size:80%;">Titulo Credito</th>
	    		<th style="color:#456789;font-size:80%;">Monto</th>
	    		<th style="color:#456789;font-size:80%;">Juicio</th>
	    		<th style="color:#456789;font-size:80%;">Abogado Impulsor</th>
	    		<th></th>
	    		
	  		</tr>
            
	            <?php if (!empty($resultSet)) {  foreach($resultSet as $res) {?>
	        		<tr>
	        		   <td style="color:#000000;font-size:80%;"></td>
	        		   <td style="color:#000000;font-size:80%;"><?php echo $res->identificacion_clientes; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombres_clientes; ?></td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_ciudad; ?>     </td>
	                   <td style="color:#000000;font-size:80%;"> <?php echo $res->numero_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->total_total_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->juicio_referido_titulo_credito; ?>     </td> 
		               <td style="color:#000000;font-size:80%;"> <?php echo $res->nombre_usuarios; ?>     </td> 
		                  <td>
			           		<div class="right">
			                    <a href="<?php echo $helper->url("RegistrarLlamadas","index"); ?>&id_clientes=<?php echo $res->id_clientes; ?>" class="btn btn-warning" onClick="notificacion()" style="font-size:75%;">--Seleccionar--</a>
			                </div>
			            
			             </td> 
		    		</tr>
		        <?php } }  ?>
           
       	</table>     
      </section>
		      </div>
             </div>
             </div>        
		  <?php } else {?>
		  
		  <?php } ?> 
            	 
            	 
			 
             
             <div class="col-lg-12">
          <?php if (!empty($resultEdit) ) { foreach($resultEdit as $resEdit) {?>
            
          <div class="col-lg-8">
		     <div class="panel panel-default">
  			<div class="panel-body">
  			
  			<h4 style="color:#ec971f; text-align: center;" >Datos del Cliente</h4>
  			<hr>
		    <div class="row">
		    
		    <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Tipo Identificacion</p>
			  	<select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultTipoIdent as $resTipoIdent) {?>
					<option value="<?php echo $resTipoIdent->id_tipo_identificacion; ?>"  <?php if ($resTipoIdent->id_tipo_identificacion == $resEdit->id_tipo_identificacion ) echo ' selected="selected" '  ; ?> ><?php echo $resTipoIdent->nombre_tipo_identificacion; ?> </option>
						   <?php } ?>
				</select> 
			  </div>
		    
		    <div class="col-xs-8 col-md-8">
			  	<p  class="formulario-subtitulo" >Nombres Cliente</p>
			  	<input type="text" name="nombres_clientes" id="nombres_clientes" value="<?php echo $resEdit->nombres_clientes; ?>" class="form-control" <?php echo $habilitar;?>/>
			   <input type="hidden"  name="id_clientes" id="id_clientes" value="<?php echo $resEdit->id_clientes; ?>" class="form-control"/> 
			  </div>
			  
			   </div>
			   
			   
		    <div class="row">
		    
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Teléfono</p>
			  	<input type="text" name="telefono_clientes" id="telefono_clientes" value="<?php echo $resEdit->telefono_clientes; ?>" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			  
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Celular </p>
			  	<input type="text" name="celular_clientes" id="celular_clientes" value="<?php echo $resEdit->celular_clientes; ?>" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			  
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultCiu as $res) {?>
						<option value="<?php echo $res->id_ciudad; ?>" <?php if ($res->id_ciudad == $resEdit->id_ciudad ) echo ' selected="selected" '  ; ?>  ><?php echo $res->nombre_ciudad; ?> </option>
						
			        <?php } ?>
				</select> 
			    </div>
		    </div>
		    
		     <div class="row">
		    
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Tipo Persona</p>
			  	<select name="id_tipo_persona" id="id_tipo_persona"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultTipoPer as $res) {?>
						<option value="<?php echo $res->id_tipo_persona; ?>"  <?php if ($res->id_tipo_persona == $resEdit->id_tipo_persona ) echo ' selected="selected" '  ; ?>  ><?php echo $res->nombre_tipo_persona; ?> </option>
						
			        <?php } ?>
				</select> 
			  </div>
			  <div class="col-xs-8 col-md-8">
			  	<p  class="formulario-subtitulo" >Dirección</p>
			  	<input type="text" name="direccion_clientes" id="direccion_clientes" value="<?php echo $resEdit->direccion_clientes; ?>" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			  
		    </div>
		    
		    
			  
			  </div>
		    </div> 
          </div> 
          
          <div class="col-lg-4">
		     
		     <div class="panel panel-default">
  			 <div class="panel-body">
		     
		     <h4 style="color:#ec971f; text-align: center;" >Datos del Garante</h4>
		     <hr>
		     <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Nombre</p>
			  	<input type="text" name="nombre_garantes" id="nombre_garantes" value="<?php echo $resEdit->nombre_garantes; ?>" class="form-control" readonly/>
			  </div>
			
		     </div>
		     
		     <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Identificacion</p>
			  	<input type="text" name="identificacion_garantes" id="identificacion_garantes" value="<?php echo $resEdit->identificacion_garantes; ?>" class="form-control" readonly/>
			  </div>
			
		     </div>
		     
		     <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Telefono</p>
			  	<input type="text" name="telefono_garantes" id="telefono_garantes" value="<?php echo $resEdit->telefono_garantes; ?>" class="form-control" readonly/>
			  </div>
			
		     </div>
		     
		     </div>
		     </div>
		     </div>
          
          
		     <?php } } else {?>
		     
		     <div class="col-lg-8">
		     
		    <div class="panel panel-default">
  			<div class="panel-body">
		    <h4 style="color:#ec971f; text-align: center;" >Datos del Cliente</h4>
		  <div class="row">
		    
		    <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Tipo Identificacion</p>
			  	<select name="id_tipo_identificacion" id="id_tipo_identificacion"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultTipoIdent as $resTipoIdent) {?>
						<option value="<?php echo $resTipoIdent->id_tipo_identificacion; ?>"  ><?php echo $resTipoIdent->nombre_tipo_identificacion; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
		    
		    <div class="col-xs-8 col-md-8">
			  	<p  class="formulario-subtitulo" >Nombres </p>
			  	<input type="text" name="nombres_clientes" id="nombres_clientes" value="" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			  </div>
			   
			   
		    <div class="row">
		    
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Teléfono</p>
			  	<input type="text" name="telefono_clientes" id="telefono_clientes" value="" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			  
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Celular </p>
			  	<input type="text" name="celular_clientes" id="celular_clientes" value="" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			  
			  <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Ciudad</p>
			  	<select name="id_ciudad" id="id_ciudad"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultCiu as $res) {?>
						<option value="<?php echo $res->id_ciudad; ?>"  ><?php echo $res->nombre_ciudad; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
		    </div>
		    
		    <div class="row">
		    <div class="col-xs-4 col-md-4">
			  	<p  class="formulario-subtitulo" >Tipo Persona</p>
			  	<select name="id_tipo_persona" id="id_tipo_persona"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultTipoPer as $res) {?>
						<option value="<?php echo $res->id_tipo_persona; ?>"  ><?php echo $res->nombre_tipo_persona; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
			  
			  <div class="col-xs-8 col-md-8">
			  	<p  class="formulario-subtitulo" >Dirección</p>
			  	<input type="text" name="direccion_clientes" id="direccion_clientes" value="" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			  
		    </div>
		    
			  </div>
			   </div> 
		     	 </div>
		     	 
		     	 
		     	 <div class="col-lg-4">
		     
		     <div class="panel panel-default">
  			 <div class="panel-body">
		     
		     <h4 style="color:#ec971f; text-align: center;" >Datos del Garante</h4>
		     
		     <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Nombre</p>
			  	<input type="text" name="nombre_garantes" id="nombre_garantes" value="" class="form-control" readonly/>
			  </div>
			
		     </div>
		     
		     <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Identificacion</p>
			  	<input type="text" name="identificacion_garantes" id="identificacion_garantes" value="" class="form-control" readonly/>
			  </div>
			
		     </div>
		     
		     <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Telefono</p>
			  	<input type="text" name="telefono_garantes" id="telefono_garantes" value="" class="form-control" readonly/>
			  </div>
			
		     </div>
		     
		     </div>
		     </div>
		     </div>
		     	 
		     	 
		     <?php } ?>
		      
		     </div>
		     
		     
		     
		     <div class="col-lg-12">
         
        	    <h4 style="color:#ec971f; text-align: center;" >Registrar Llamada</h4>
            	
               
              
             <div class="panel panel-default">
  			 
  			 <div class="row">
  			 <h4 class="formulario-subtitulo"  style="text-align: center;" >Respondio</h4>
  			 
  			 <div class="col-xs-6 col-md-6" style="text-align: center;">
  			 <p  class="formulario-subtitulo" >Si</p>
  			 <input type="radio" name="recibio_registrar_llamadas" id="recibio_registrar_llamadas_si" value="TRUE" <?php echo $habilitar;?>/>
  			</div>
  			 
  			 <div class="col-xs-6 col-md-6" style="text-align: center;">
  			 <p  class="formulario-subtitulo">No</p>
  			 <input type="radio" name="recibio_registrar_llamadas" id="recibio_registrar_llamadas_no" value="FALSE" <?php echo $habilitar;?>/>
  			</div>
  			 
  			 </div>
  			<br>
            </div>
               	
             <div class="panel panel-default">
  			 <div class="panel-body" >
  			 
  		     <div class="row">
		     	 <div class="col-xs-6 col-md-6">
			  		<p  class="formulario-subtitulo" >Fecha</p>
			  		<input type="text" name="fecha_registrar_llamadas" id="fecha_registrar_llamadas" value="<?php $sdate=date("d")."/".date("m")."/".date("Y"); $stime=date("h").":".date("i"); echo "$sdate";?>" class="form-control" readonly/>
				 </div>
			  
				 <div class="col-xs-6 col-md-6">
			  	    <p  class="formulario-subtitulo" >Hora</p>
			  		<input type="text" name="hora_registrar_llamadas" id="hora_registrar_llamadas" value="<?php $sdate=date("d")."/".date("m")."/".date("Y"); $stime=date("h").":".date("i");  echo "$stime";?>" class="form-control" readonly/>
			 	</div>
			</div>
		    
		      <div class="row">
		     	 <div class="col-xs-6 col-md-6">
			  		<p  class="formulario-subtitulo" >Nombre Contesta LLamada</p>
			  		<input type="text" name="persona_contesta_llamada" id="persona_contesta_llamada" value="" class="form-control"/>
				 </div>
			  
				 <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Parentesco con Cliente</p>
			  	<input type="text" name="parentesco_clientes" id="parentesco_clientes" value="" class="form-control"/>
				</div>
			</div>
			
			
			<div class="row">
			<div class="col-xs-12 col-md-12" >
			  	<p  class="formulario-subtitulo" >Observaciones </p>
	          	<textarea  class="form-control" id="observaciones_registra_llamadas" name="observaciones_registra_llamadas" wrap="physical" rows="3"  onKeyDown="contador(this.form.observaciones_registra_llamadas,this.form.remLen,500);" onKeyUp="contador(this.form.observaciones_registra_llamadas,this.form.remLen,500);"></textarea>
	          	<p  class="formulario-subtitulo" >Te quedan <input type="text" name="remLen" size="2" maxlength="2" value="500" readonly="readonly"> letras por escribir. </p>
	        </div>
			</div>
			
           </div>
           </div> 
           
           	
           </div>
		     
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php  echo $helper->url("RegistrarLlamadas","InsertaRegistrarLlamadas"); ?>'" value="Guardar" class="btn btn-success" <?php echo $habilitar;?>/>
			  </div>
			</div>     
               
		
		 <br>
           <br>
            <br>
          </form>
       
         <!-- termina el form -->
       
       
      </div>
   </div>
   <?php include("view/modulos/footer.php"); ?>
     </body>  
    </html>   