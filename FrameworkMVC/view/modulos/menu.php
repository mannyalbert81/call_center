<div class="container" style="margin-top: 15px;" >
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
      <a class="navbar-brand" href="#">Menu</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php?controller=Usuarios&action=loguear"><span class="glyphicon glyphicon-home" ><?php echo " Inicio" ;?></span> <span class="sr-only">(current)</span></a></li>
        
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" ><?php echo " Administración" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
        	<li><a href="index.php?controller=Usuarios&action=index"><span class="glyphicon glyphicon-user" aria-hidden="true"> Usuarios</span> </a>
		    </li>
			<li><a href="index.php?controller=Roles&action=index"> <span class="glyphicon glyphicon-list-alt" aria-hidden="true"> Roles de Usuario</span> </a>
			</li>
			<li><a href="index.php?controller=PermisosRoles&action=index"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"> Permisos Roles</span> </a>
			</li>
			<li><a href="index.php?controller=Controladores&action=index"><span class="glyphicon glyphicon-inbox" aria-hidden="true"> Controladores</span> </a>
			</li>
			<li><a href="index.php?controller=Entidades&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Entidades</span> </a>
			</li>
			<li><a href="index.php?controller=TipoIdentificacion&action=index"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"> Tipo de Identificacion</span> </a>
			</li>
			<li><a href="index.php?controller=TipoNotificacion&action=index"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"> Tipo Notificacion</span> </a>
			</li>
			<li><a href="index.php?controller=Notificaciones&action=index"><span class="glyphicon glyphicon-pushpin" aria-hidden="true"> Notificaciones</span> </a>
			</li>
          </ul>
        </li>

        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-refresh" ><?php echo " Procesos" ;?> </span> <span class="caret"></span></a>
          <ul class="dropdown-menu">
        	<li><a href="index.php?controller=Usuarios&action=index"><span class="glyphicon glyphicon-ok" aria-hidden="true"> Importacion de Cartera/Operaciones</span> </a>
		    </li>
			<li><a href="index.php?controller=Roles&action=index"><span class="glyphicon glyphicon-euro" aria-hidden="true"> Recaudacion</span> </a>
			</li>

			<li><a href="index.php?controller=AsignacionSecretarios&action=index"><span class="glyphicon glyphicon-copy" aria-hidden="true"> Asignacion Secretarios</span> </a>
            </li>
			<li><a href="index.php?controller=FirmasDigitales&action=index"><span class="glyphicon glyphicon-pencil" aria-hidden="true"> Firmas Digitales</span> </a>

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