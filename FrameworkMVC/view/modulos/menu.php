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
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" ><?php echo " AdministraciÃ³n" ;?> </span> <span class="caret"></span></a>
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
			
</ul>
</li>

    <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Mantenimiento" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Ciudad",$controladores) ?>">
			<a href="index.php?controller=Ciudad&action=index"><span class="glyphicon glyphicon-object-align-vertical" aria-hidden="true"> Ciudades</span> </a>
			</li> 
			
		   <li style="<?php echo getcontrolador("Entidades",$controladores) ?>">
            <a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Entidades</span> </a>
			</li> 
			
          <li style="<?php echo getcontrolador("TipoPersona",$controladores) ?>">
            <a href="index.php?controller=TipoPersona&action=index"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Tipo de Personas</span> </a>
			</li>
		
		   <li style="<?php echo getcontrolador("TipoIdentificación",$controladores) ?>">
            <a href="index.php?controller=TipoIdentificación&action=index"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Tipo de Identificación</span> </a>
			</li> 
		   
		   <li style="<?php echo getcontrolador("TipoNotificacion",$controladores) ?>">
			<a href="index.php?controller=TipoNotificacion&action=index"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"> Tipo Notificacion</span> </a>
			</li>
			
			<li style="<?php echo getcontrolador("Notificaciones",$controladores) ?>">
			<a href="index.php?controller=Notificaciones&action=index"><span class="glyphicon glyphicon-globe" aria-hidden="true"> Notificaciones</span> </a>
			</li>     	
</ul>
</li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Procesos" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
            <li style="<?php echo getcontrolador("Clientes",$controladores) ?>">
            <a href="index.php?controller=Clientes&action=ImportacionClientes"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Importar Clientes</span> </a>
			</li>
          
            <li style="<?php echo getcontrolador("Clientes",$controladores) ?>">
            <a href="index.php?controller=Clientes&action=index"><span class="glyphicon glyphicon-option-vertical" aria-hidden="true"> Clientes</span> </a>
			</li>
          	
</ul>
</li>
        

         <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Consultas" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
          
          <li style="<?php echo getcontrolador("Trazas",$controladores) ?>">
          <a href="index.php?controller=Trazas&action=index"><span class="glyphicon glyphicon-save-file" aria-hidden="true"> Auditoria del Sistema</span> </a>
          </li>
           <li style="<?php echo getcontrolador("Clientes",$controladores) ?>">
          <a href="index.php?controller=Clientes&action=consulta"><span class="glyphicon glyphicon-hourglass" aria-hidden="true"> Clientes</span> </a>
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
             <li><a href="/FrameworkMVC/view/ireports/ContNotificacionesReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-envelope" aria-hidden="true"> Notificaciones</span> </a>
            </li>
            <li><a href="/FrameworkMVC/view/ireports/ContTrazasReport.php"onclick="window.open(this.href, this.target, ' width=1000, height=800, menubar=no');return false"><span class="glyphicon glyphicon-share-alt" aria-hidden="true"> Auditoria del Sistema</span> </a>
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