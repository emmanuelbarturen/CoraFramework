<?php incluir('includes/header.php') ?>
    <div class="container">
        <div id="contacto">
            <div class="row cabecera">
                <h1 id="tit-contacto">Contacto</h1>

                <p class="sub-tit">Por favor, dejenos un mensaje y nuestra área de ventas se pondrá en contácto con
                    usted para resolver cualquier duda en cuestión de horas. </p>
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="form">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <input type="text" name="nombre" placeholder="Nombre o Empresa" required>
                            <input type="email" name="correo" placeholder="Email" required>
                            <textarea name="mensaje" cols="30" rows="10"
                                      placeholder="Dejanos todos los requerimientos"></textarea>
                            <input type="submit" class="boton-naranja" value="Enviar">
                        </form>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <iframe id="mapa"
                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d1949.8930721145075!2d-76.93970969742364!3d-12.19494976405771!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2spe!4v1425929180688"
                            frameborder="0" style="border:0"></iframe>

                </div>
            </div>
        </div>
    </div>
<?php incluir('includes/footer.php') ?>