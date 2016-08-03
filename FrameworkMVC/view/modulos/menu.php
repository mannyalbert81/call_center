<?php 

$controladores=$_SESSION['controladores'];

 function getcontrolador($controlador,$controladores){
 	$display="display:none";
 	
 	if (!empty($controladores))
 	{
 	foreach ($controladores as $res)
 	{
 		if($res->nombre_controladores==$controlador)
 		{
 			$display= "display:block";
 			break;
 			
 		}
 	}
 	}
 	
 	return $display;
 }

 
?>


<div class="container" style="margin-top: 15px; " >
<div class="row">
<div class="col-xs-12">
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>	
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" ><?php echo " Administración" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          
        	<li style="<?php echo getcontrolador("Usuarios",$controladores) ?>">
        	<a href="index.php?controller=Usuarios&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Usuarios</span> </a>
		    </li>
			<li style="<?php echo getcontrolador("Roles",$controladores) ?>">
			<a href="index.php?controller=Roles&action=index"> <span class=" glyphicon glyphicon-asterisk" aria-hidden="true"> Roles de Usuario</span> </a>
			</li>
			<li style="<?php echo getcontrolador("PermisosRoles",$controladores) ?>">
			<a href="index.php?controller=PermisosRoles&action=index"><span class="glyphicon glyphicon-plus" aria-hidden="true"> Permisos Roles</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Controladores",$controladores) ?>">
			<a href="index.php?controller=Controladores&action=index"><span class="glyphicon glyphicon-inbox" aria-hidden="true"> Controladores</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Entidades",$controladores) ?>">
			<a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Entidades</span> </a>
			</li>
			<li style="<?php echo getcontrolador("TipoIdentificacion",$controladores) ?>">
			<a href="index.php?controller=TipoIdentificacion&action=index"><span class="glyphicon glyphicon-time" aria-hidden="true"> Tipo de Identificacion</span> </a>
			</li>
			<li style="<?php echo getcontrolador("TipoNotificacion",$controladores) ?>">
			<a href="index.php?controller=TipoNotificacion&action=index"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"> Tipo Notificacion</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Notificaciones",$controladores) ?>">
			<a href="index.php?controller=Notificaciones&action=index"><span class="glyphicon glyphicon-globe" aria-hidden="true"> Notificaciones</span> </a>
			</li>
			<li style="<?php echo getcontrolador("Repositorio",$controladores) ?>">
			<a href="index.php?controller=Repositorio&action=index"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"> Gestion Repositorios</span> </a>
			</li>
			
			<li role="separator" class="divider"></li>
			
			
            <li style="<?php echo getcontrolador("TipoJuicios",$controladores) ?>">
            <a href="index.php?controller=TipoJuicios&action=index"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"> Tipo de Juicios</span> </a>
			</li>
			<li style="<?php echo getcontrolador("EstadosTitulosCredito",$controladores) ?>">
			<a href="index.php?controller=EstadosTitulosCredito&action=index"><span class="glyphicon glyphicon-collapse-up" aria-hidden="true"> Estado Titulo Credito</span> </a>
			</li>
            <li style="<?php echo getcontrolador("EstadosProcesales",$controladores) ?>">
            <a href="index.php?controller=EstadosProcesales&action=index"><span class="glyphicon glyphicon-log-in" aria-hidden="true"> Estado Procesal</span> </a>
            </li>
            <li style="<?php echo getcontrolador("EtapasJuicios",$controladores) ?>">
            <a href="index.php?controller=EtapasJuicios&action=index"><span class="glyphicon glyphicon-subtitles" aria-hidden="true"> Etapas Juicios</span> </a>
            </li>
            <li style="<?php echo getcontrolador("LotesTituloCredito",$controladores) ?>">
            <a href="index.php?controller=LotesTituloCredito&action=index"><span class="glyphicon glyphicon-cloud-download" aria-hidden="true"> Estado Lotes</span> </a>
            </li>
            <li style="<?php echo getcontrolador("EstAutoPagoJuicios",$controladores) ?>">
            <a href="index.php?controller=EstAutoPagoJuicios&action=index"><span class="glyphicon glyphicon-education" aria-hidden="true"> Estado Auto de Pago</span> </a>
            </li>
            <li style="<?php echo getcontrolador("TipoPersona",$controladores) ?>">
            <a href="index.php?controller=TipoPersona&action=index"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Tipo de Personas</span> </a>
			</li>
			 <li style="<?php echo getcontrolador("Clientes",$controladores) ?>">
            <a href="index.php?controller=Clientes&action=index"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Clientes</span> </a>
			</li>
			
			
</ul>
</li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Procesos" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          	<li style="<?php echo getcontrolador("AsignacionSecretarios",$controladores) ?>">
          	<a href="index.php?controller=AsignacionSecretarios&action=index"><span class="glyphicon glyphicon-copy" aria-hidden="true"> Asignacion Secretarios</span> </a>
            </li>
			<li style="<?php echo getcontrolador("FirmasDigitales",$controladores) ?>">
			<a href="index.php?controller=FirmasDigitales&action=index"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> Firmas Digitales</span> </a>
            </li>
            <li style="<?php echo getcontrolador("CertificadosElectronicos",$controladores) ?>">
            <a href="index.php?controller=CertificadosElectronicos&action=index"><span class="glyphicon glyphicon-bookmark" aria-hidden="true"> Registrar Certificado Electronico</span> </a>
            </li>
            <li style="<?php echo getcontrolador("FirmasDigitales",$controladores) ?>">
            <a href="index.php?controller=FirmasDigitales&action=firmarDocumento"><span class="glyphicon glyphicon-adjust" aria-hidden="true"> Firmar Documento</span> </a>
            </li>
            <li style="<?php echo getcontrolador("AsignacionTituloCredito",$controladores) ?>">
            <a href="index.php?controller=AsignacionTituloCredito&action=index"><span class="glyphicon glyphicon-adjust" aria-hidden="true"> Asignar Titulo Credito</span> </a>
            </li>
            <li style="<?php echo getcontrolador("ReasignarTitulo",$controladores) ?>">
            <a href="index.php?controller=ReasignarTitulo&action=index"><span class="glyphicon glyphicon-edit" aria-hidden="true"> Reasignar Titulo Credito</span> </a>
            </li>
</ul>
</li>
        

         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Consultas" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Trazas",$controladores) ?>">
          <a href="index.php?controller=Trazas&action=index"><span class="glyphicon glyphicon-save-file" aria-hidden="true"> Auditoria del Sistema</span> </a>
          </li>
          <li style="<?php echo getcontrolador("Citaciones",$controladores) ?>">
          <a href="index.php?controller=Citaciones&action=consulta"><span class="glyphicon glyphicon-link" aria-hidden="true"> Citaciones</span> </a>
          </li>
          <li style="<?php echo getcontrolador("Oficios",$controladores) ?>">
          <a href="index.php?controller=Oficios&action=consulta"><span class="glyphicon glyphicon-copy" aria-hidden="true"> Oficios</span> </a>
          </li>
          <li style="<?php echo getcontrolador("Juicio",$controladores) ?>">
          <a href="index.php?controller=Juicio&action=consulta"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"> Juicios</span> </a>
          </li>
          <li style="<?php echo getcontrolador("Clientes",$controladores) ?>">
          <a href="index.php?controller=Clientes&action=consulta"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"> Clientes</span> </a>
          </li>
          <li style="<?php echo getcontrolador("SeguimientoGastos",$controladores) ?>">
          <a href="index.php?controller=SeguimientoGastos&action=index"><span class="glyphicon glyphicon-resize-full" aria-hidden="true"> Gastos</span> </a>
          </li>
          <li style="<?php echo getcontrolador("ConsultaDocumentosImpulsores",$controladores) ?>">
          <a href="index.php?controller=ConsultaDocumentosImpulsores&action=consulta_impulsores_firmados"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Providencias Impulsores</span> </a>
          </li>
          <li style="<?php echo getcontrolador("ConsultaDocumentosSecretarios",$controladores) ?>">
          <a href="index.php?controller=ConsultaDocumentosSecretarios&action=consulta_secretarios_firmados"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Providencias Secretarios</span> </a>
          </li>
          
		  <li style="<?php echo getcontrolador("ConsultaAvocoImpulsores",$controladores) ?>">
          <a href="index.php?controller=ConsultaAvocoImpulsores&action=consulta_impulsores_avoco_firmados"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Avoco Impulsores</span> </a>
          </li>
          <li style="<?php echo getcontrolador("ConsultaAvocoSecretarios",$controladores) ?>">
          <a href="index.php?controller=ConsultaAvocoSecretarios&action=consulta_secretarios_avoco_firmados"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Avoco Secretarios</span> </a>
          </li>	
</ul>
</li>

          <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Juicios" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Juicio",$controladores) ?>">
          <a href="index.php?controller=Juicio&action=index"><span class="glyphicon glyphicon-sort" aria-hidden="true"> Seguimiento Juicio</span> </a>
          </li>
          <li style="<?php echo getcontrolador("AutoPagos",$controladores) ?>">
          <a href="index.php?controller=AutoPagos&action=index"><span class="glyphicon glyphicon-filter" aria-hidden="true"> Auto Pagos</span> </a>
          </li>
          <li style="<?php echo getcontrolador("AprobacionAutoPago",$controladores) ?>">
          <a href="index.php?controller=AprobacionAutoPago&action=index"><span class="glyphicon glyphicon-tasks" aria-hidden="true"> Aprobacion Auto Pagos</span> </a>
          </li>
    	  <li style="<?php echo getcontrolador("ImpresionAutoPago",$controladores) ?>">
    	  <a href="index.php?controller=ImpresionAutoPago&action=index"><span class=" glyphicon glyphicon-triangle-bottom" aria-hidden="true"> Impresion Auto Pagos</span> </a>
          </li>
</ul>
</li>

<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Gastos" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("DistribucionGastos",$controladores) ?>">
          <a href="index.php?controller=DistribucionGastos&action=index"><span class="glyphicon glyphicon-text-background" aria-hidden="true"> Distribucion Gastos</span> </a>
          </li>
          <li style="<?php echo getcontrolador("AprobacionDistribucionGastos",$controladores) ?>">
          <a href="index.php?controller=AprobacionDistribucionGastos&action=index"><span class="glyphicon glyphicon-oil" aria-hidden="true"> Aprobacion Gastos</span> </a>
          </li>
          <li style="<?php echo getcontrolador("Oficios",$controladores) ?>">
          <a href="index.php?controller=Oficios&action=index"><span class="glyphicon glyphicon-leaf" aria-hidden="true"> Generar Oficios</span> </a>
          </li>
          <li style="<?php echo getcontrolador("Oficios",$controladores) ?>">
          <a href="index.php?controller=Oficios&action=consulta_firmar"><span class="glyphicon glyphicon-leaf" aria-hidden="true"> Firmar Oficios</span> </a>
          </li>

</ul>
</li>

<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Citaciones" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Citaciones",$controladores) ?>">
          <a href="index.php?controller=Citaciones&action=index"><span class=" glyphicon glyphicon-usd" aria-hidden="true"> Generar Citaciones</span> </a>
          </li>
          <li style="<?php echo getcontrolador("Citaciones",$controladores) ?>">
          <a href="index.php?controller=Citaciones&action=consulta_firmar"><span class="glyphicon glyphicon-link" aria-hidden="true"> Firmar Citaciones</span> </a>
          </li>
</ul>
</li>
      
<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Reportes" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
            <li><a href="/FrameworkMVC/view/ireports/ContClientesReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"> <span class="glyphicon glyphicon-home" aria-hidden="true"> Clientes</span> </a>
            </li>
            <li><a href="/FrameworkMVC/view/ireports/ContUsuariosReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"> <span class="glyphicon glyphicon-file" aria-hidden="true"> Usuarios</span> </a>
            </li>  
            <li><a href="/FrameworkMVC/view/ireports/ContVehiculosReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"> <span class=" glyphicon glyphicon-print" aria-hidden="true"> Vehiculos Embargados</span> </a>
            </li>   
            <li><a href="/FrameworkMVC/view/ireports/ContAdministradorGastosReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-fullscreen" aria-hidden="true"> Administrador de Gastos</span> </a>
            </li>
            <li><a href="/FrameworkMVC/view/ireports/ContHonorariosReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-th" aria-hidden="true"> Honorarios</span> </a>
            </li>
            <li><a href="/FrameworkMVC/view/ireports/ContNotificacionesReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> Notificaciones</span> </a>
            </li>
            <li><a href="/FrameworkMVC/view/ireports/ContAsignacionSecretariosReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-stop" aria-hidden="true"> Asignacion Secretarios</span> </a>
            </li>
            <li><a href="/FrameworkMVC/view/ireports/ContTrazasReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"> Auditoria del Sistema</span> </a>
            </li>
            <li><a href="/FrameworkMVC/view/ireports/ContJuiciosSubReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"> Juicios</span> </a>
            </li>
</ul>
</li>
      
<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Documentos" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          <li style="<?php echo getcontrolador("Documentos",$controladores) ?>">
          <a href="index.php?controller=Documentos&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Emisón de Providencias</span> </a>
          </li>   
          <li style="<?php echo getcontrolador("ConsultaDocumentosImpulsores",$controladores) ?>">
          <a href="index.php?controller=ConsultaDocumentosImpulsores&action=consulta_impulsores"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Firmar Providencias Impulsores</span> </a>
          </li>
          <li style="<?php echo getcontrolador("ConsultaDocumentosSecretarios",$controladores) ?>">
          <a href="index.php?controller=ConsultaDocumentosSecretarios&action=consulta_secretarios"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Firmar Providencias Secretarios</span> </a>           
          </li>
           <li style="<?php echo getcontrolador("ConsultaDocumentosSecretarios",$controladores) ?>">
          <a href="index.php?controller=AvocoConocimiento&action=index"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Avoco Conocimiento</span> </a>           
          </li>
          
          <li style="<?php echo getcontrolador("ConsultaAvocoImpulsores",$controladores) ?>">
          <a href="index.php?controller=ConsultaAvocoImpulsores&action=consulta_impulsores_avoco"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Firmar Avoco Impulsores</span> </a>
          </li>
          <li style="<?php echo getcontrolador("ConsultaAvocoSecretarios",$controladores) ?>">
          <a href="index.php?controller=ConsultaAvocoSecretarios&action=consulta_secretarios_avoco"><span class=" glyphicon glyphicon-console" aria-hidden="true"> Firmar Avoco Secretarios</span> </a>           
          </li>
</ul>
</li>

</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
</div>
</div>
</div>