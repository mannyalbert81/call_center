
  <?php include("view/modulos/head.php"); ?>
     

<!DOCTYPE HTML>
<html lang="es">

      <head>
      
        <meta charset="utf-8"/>
        <title>Registrar Llamadas - CallCenter 2016</title>
        
     	  <link rel="stylesheet" href="view/css/bootstrap.css">
          <script src="view/js/jquery.js"></script>
		  <script src="view/js/bootstrapValidator.min.js"></script>
		  
		
		
        
	
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
    <body class="cuerpo" >
    
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
       
		?>
 
  
  <div class="container">
  
  <div class="row" style="background-color: #ffffff;">
  
  
    
      <!-- empieza el form --> 
       
      <form action="<?php echo $helper->url("RegistrarLlamadas","index"); ?>" method="post" enctype="multipart/form-data"  class="col-lg-12">
           
           <br>
           
         
         <div class="col-lg-12">
          <div class="well">  
         <h4 style="color:#ec971f; text-align: center;" >Busqueda Cliente</h4>
        <hr/>
		  
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
             
            	
          <?php if(!empty($resultSet))  {?>
		    <div class="col-lg-12">
			
			 <div class="datagrid"> 
      		 <section style="height:120px; overflow-y:scroll;">
       		 <table class="table table-hover ">
  		      <thead>
               <tr >
	            <th style="font-size:100%;">Identificacion</th>
	    		<th style="font-size:100%;">Nombre</th>
	    		<th style="font-size:100%;">Ciudad</th>
	    		<th style="font-size:100%;">Titulo Credito</th>
	    		<th style="font-size:100%;">Monto</th>
	    		<th style="font-size:100%;">Juicio</th>
	    		<th style="font-size:100%;">Abogado Impulsor</th>
	    		<th></th>
	    		</tr>
	   		  </thead>
  		     
  		     
  		      <tfoot>
       		<tr>
					<td colspan="8">
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
		    		</tbody>
		        <?php } }  ?>
           
       	</table>     
      </section>
		      
             </div>
              
             </div>       
		  <?php }?>
       
          <?php if (!empty($resultEdit) ) { foreach($resultEdit as $resEdit) {?>
          
         
          <div class="col-lg-8">
		    <div class="well">  
  			
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
						<option value="<?php echo $res->id_ciudad; ?>" <?php if ($res->id_ciudad == $resEdit->id_ciudad ){ echo ' selected="selected" ';} ?>  ><?php echo $res->nombre_ciudad; ?> </option>
						
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
          
          <div class="col-lg-4">
		     
		    <div class="well">  
		     
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
		     
		     <div class="col-lg-5">	
		    <div class="well">  
  			 <h4 style="color:#ec971f; text-align: center;" >Datos del Juicio</h4>
		     <hr>
  			 
  			 <div class="row">
		    
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >N° Juicio</p>
			  	<input type="text" name="juicio_referido_titulo_credito" id="juicio_referido_titulo_credito" value="<?php if($resEdit->juicio_referido_titulo_credito!=""){ echo $resEdit->juicio_referido_titulo_credito;}else{echo '-sin numero-';} ?>" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			 </div>
		    
		     <div class="row">
		      <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Estados Procesales</p>
			  	<select name="id_estados_procesales_juicios" id="id_estados_procesales_juicios"  class="form-control" <?php echo $habilitar;?>>
					<?php foreach($resultEstPro as $res) {?>
						<option value="<?php echo $res->id_estados_procesales_juicios; ?>" <?php if ($res->id_estados_procesales_juicios == $resEdit->id_estados_procesales_juicios ) echo ' selected="selected" '  ; ?> ><?php echo $res->nombre_estados_procesales_juicios; ?> </option>
			        <?php } ?>
				</select> 
			  </div>
			    
		    </div>
		    
		    <div class="row" style="margin-top:10px">
		    <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Impulsor</p>
			  	<input type="text" name="impulsores" id="impulsores" value="<?php if(!empty($resultAbogados)){echo $resultAbogados[0]->nombre_usuarios;} ?>" class="form-control" readonly/>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Secretario</p>
			  	<input type="text" name="secretarios" id="secretarios" value="<?php if(!empty($resultAbogados)){echo $resultAbogados[1]->nombre_usuarios;} ?>" class="form-control" readonly/>
			  </div>
			 </div>
		    
  			 
  			 
  			 
  			  </div>	 
		  	
		     </div>	
  			 	
  			 	
  			 <div class="col-lg-3">	
		     <div class="well">  
  			 <h4 style="color:#ec971f; text-align: center;" >Datos del Titulo Credito</h4>
		     <hr>
  			 
  			 <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >N° Titulo Credito</p>
			  	<input type="text" name="numero_titulo_credito" id="numero_titulo_credito" value="<?php echo $resEdit->numero_titulo_credito; ?>" class="form-control" disabled="disabled"/>
			    </div>
			 
			 <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Saldo Capital</p>
			  	<input type="text" name="total_saldo_capital_titulo_credito" id="total_saldo_capital_titulo_credito" value="<?php echo $resEdit->total_saldo_capital_titulo_credito; ?>" class="form-control" disabled="disabled"/>
			    </div>
			  
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Total</p>
			  	<input type="text" name="total_total_titulo_credito" id="total_total_titulo_credito" value="<?php echo $resEdit->total_total_titulo_credito; ?>" class="form-control" disabled="disabled"/>
			    </div>
			  
			    
		    </div>
		    
  			  </div>	 
		    
		     </div>		 
		     	 
		      <div class="col-lg-4">	
		     <div class="well">  
  			 <h4 style="color:#ec971f; text-align: center;" >Datos del 2do Garante</h4>
		     <hr>
  			 
		    
			 <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Nombre</p>
			  	<input type="text" name="nombre_garantes_1" id="nombre_garantes_1" value="<?php echo $resEdit->nombre_garantes_1; ?>" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			
		     </div>
		     
		     <div class="row">
		    
			  <div class="col-xs-12 col-md-12">
			  	<p  class="formulario-subtitulo" >Identificación</p>
			  	<input type="text" name="identificacion_garantes_1" id="identificacion_garantes_1" value="<?php echo $resEdit->identificacion_garantes_1; ?>" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			
		     </div>
		     
		     <div class="row">
		    
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Telefono</p>
			  	<input type="text" name="telefono_garantes_1" id="telefono_garantes_1" value="<?php echo $resEdit->telefono_garantes_1; ?>" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			  
			  <div class="col-xs-6 col-md-6">
			  	<p  class="formulario-subtitulo" >Celular</p>
			  	<input type="text" name="celular_garantes_1" id="celular_garantes_1" value="<?php echo $resEdit->celular_garantes_1; ?>" class="form-control" <?php echo $habilitar;?>/>
			  </div>
			
		     </div>
		     
		     </div>	 
		     
		     </div>	
          
          
		     <?php break; } } else {?>
		     
		      
		     <?php } ?>
		      
		    
		    
		     
		     
		     <div class="col-lg-12">
              <div class="col-lg-2">
              </div>
              <div class="col-lg-8">
               <h4 style="color:#ec971f; text-align: center;" >Registrar Llamada</h4>
              
             <div class="well">  
  			 
  			 <div class="row">
  			 <h4 class="formulario-subtitulo"  style="text-align: center;" >Respondio</h4>
  			 
  			 <div class="col-xs-6 col-md-6" style="text-align: center;">
  			 <p  class="formulario-subtitulo" >Si</p>
  			 <input type="radio" name="recibio_registrar_llamadas" id="recibio_registrar_llamadas_si" value="TRUE" <?php if(empty($resultEdit)){echo $habilitar;} ?>/>
  			</div>
  			 
  			 <div class="col-xs-6 col-md-6" style="text-align: center;">
  			 <p  class="formulario-subtitulo">No</p>
  			 <input type="radio" name="recibio_registrar_llamadas" id="recibio_registrar_llamadas_no" value="FALSE" <?php if(empty($resultEdit)){echo $habilitar;} ?>/>
  			</div>
  			 
  			 </div>
  			<br>
            </div>
               	
            <div class="well">  
  			 
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
              <div class="col-lg-2">
              </div>
              </div>
        	
		     
		       <div class="row">
			  <div class="col-xs-12 col-md-12" style="text-align: center;" >
			  	<input type="submit" id="Guardar" name="Guardar" onclick="this.form.action='<?php  echo $helper->url("RegistrarLlamadas","InsertaRegistrarLlamadas"); ?>'" value="Guardar" class="btn btn-success" <?php if(empty($resultEdit)){echo $habilitar;} ?>/>
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