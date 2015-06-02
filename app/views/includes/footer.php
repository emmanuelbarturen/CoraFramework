<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h3>Acceso Rápido</h3>
                <ul class="list-group">
                    <li><a href="<?= action('HomeController@index'); ?>">Home</a></li>
                    <li><a href="<?= action('HomeController@quienessomos'); ?>">Quienes Somos</a></li>
                    <li><a href="<?= action('HomeController@servicios'); ?>">Servicios</a></li>
                    <li><a href="<?= action('HomeController@productos'); ?>">Productos</a></li>
                    <li><a href="<?= action('HomeController@distribuidores'); ?>">Distribuidores</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h3>Siguenos: </h3>
                <ul class="list-unstyled list-inline list-social-icons">
                    <li>
                        <a href="#" target="_blank"><i class="fa fa-facebook-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><i class="fa fa-twitter-square fa-2x"></i></a>
                    </li>
                    <li>
                        <a href="#" target="_blank"><i class="fa fa-google-plus-square fa-2x"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-5" >
                <div class="row">
                    <h3>Contactese con Nosotros</h3>
                    <p><i class="fa fa-phone"></i>: (51-1)287 7660 / (51-1)822*4480.</p>
                    <p><i class="fa fa-envelope-o"></i> : <a href="mailto:ventas@fioreza.com"> ventas@fioreza.com</a>
                    </p>
                    <p><i class="fa fa-clock-o"></i>: Lunes - Sabado: 8:00 AM to 6:00 PM</p>
                    <p><i class="fa fa-home"></i>: Parcela II, Mz. B2 Lote 1 Parque industrial de Villa el Salvador.<br> (<small> Frente la estación "Parque Industrial" del tren Eléctrico</small>)</p>
                </div>
            </div>
        </div>
    </div>
    <script src="<?= asset('js/jquery.js'); ?>"></script>
    <script src="<?= asset('js/bootstrap.min.js'); ?>"></script>
    <script src="<?= asset('js/scripts.js'); ?>"></script>
    <script>
        $('.carousel').carousel({
            interval: 3000 //changes the speed
        })
    </script>
</footer>
</body>
</html>
