<!DOCTYPE html>
<html lang="es">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - @section('titulo') infinibyte @show</title>
    <link href="{{ asset('admin_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/fonts/material-design-iconic-font/css/material-design-iconic-font.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/font-awesome/4.3.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/fonts/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/owl.carousel.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/owl.theme.default.css') }}" rel="stylesheet">
    <link href="{{ asset('admin_assets/css/style_admin.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
    <header class="header">
        <div class="top clearfix">
            <a href="http://infinibyte.pe/" target="_blank">infinibyte.pe</a> - Administrador web
            <div class="right-icons">
                <a href="#" class="share"><i class="md md-more-vert"></i></a>
            </div> 
            <div class="popup">
                <nav class="social-nav">
                    <ul class="list-unstyled">
                        <li><a href="{{action('MainController@home')}}" target="_blank">WebPage</a></li>
                        <li><a href="{{action('MainController@logout')}}">Salir</a></li>
                    </ul> 
                </nav> 
            </div> 
        </div> 
        <div class="bottom clearfix">
            <div class="title"><a href="{{action('AdminController@index')}}">Sociedad Comercial & Consultores SAC</a> - @section('area') area @show</div>
            <a href="#" class="responsive-menu-open">Menu<i class="fa fa-bars"></i></a>
            <nav class="main-nav">
                <ul class="list-unstyled">
                    <li class="active"><a href="{{action('AdminController@index')}}">Home</a></li>
                    <li><a href="{{action('EventosController@index')}}">Eventos</a></li>
                    <li><a href="{{action('CategoriasController@index')}}">Categorias</a></li>
                    <li><a href="{{action('ContactosController@postulantes')}}">Postulantes</a></li>
                    <li><a href="{{action('ContactosController@mensajes')}}">Contactos</a></li>
                    <li><a href="{{action('AdminController@change_password')}}">Configuraci&oacute;n</a></li>
                </ul>
            </nav> 
        </div> 
    </header> 
    <div class="responsive-menu">
        <a href="#" class="responsive-menu-close">Cerrar <i class="ion-android-close"></i></a>
        <nav class="responsive-nav"></nav> 
    </div> 
    <div class="sections">
        <div class="sections-wrapper clearfix">
            @yield('content')
        </div> 
    </div> 
    <!-- <footer class="footer">
         <div class="bottom">Powered By <a href="#">infinibyte.pe</a>. All Rights Reserved.</div> 
     </footer> --> 
    <script src="{{ asset('admin_assets/js/jquery-1.11.2.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/jquery.inview.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('admin_assets/js/scripts_admin.js') }}"></script>
    @yield('js')
</body>
</html>