<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" id="menu">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="nav navbar-brand" href="<?= action('HomeController@index'); ?>" id="logo"><img src="<?= asset('img/logo.png'); ?>" alt="logo" class="img-responsive"/></a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?= action('HomeController@quienessomos'); ?>">Quienes Somos</a>
                </li>
                <li>
                    <a href="<?= action('HomeController@servicios'); ?>">Servicios</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">productos <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= action('HomeController@productos'); ?>">Ver Todos</a>
                        </li>
                        <?php foreach(Categoria::all() as $categoria):?>
                        <li>
                            <a href="<?= action('HomeController@productos',$categoria['id']); ?>"><?=$categoria['nombre']?></a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
                <li>
                    <a href="<?= action('HomeController@distribuidores'); ?>">Distribuidores</a>
                </li>
                <li>
                    <a href="<?= action('HomeController@contacto'); ?>">Contactenos</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>