<?php incluir('includes/header.php') ?>
    <div class="container">
    <section id="distribuidores">
        <div class="titulo-dis">
            <p>Distribuidores</p>
        </div>
        <div class="contenedor">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Encuentra
                        <small> nuestros productos en:</small>
                    </h1>
                </div>
            </div>
            <div class="distribuidores-img">
                <div class="dist">
                    <img src="<?= asset('img/sodimac-jaladores.jpg'); ?>" alt="Sodimac">
                    <a href="http://www.sodimac.com.pe/sodimac-pe/" target="_blank"><div class="hover"><span><strong>Sodimac</strong></span></div></a>
                </div>
                <div class="dist">
                    <img src="<?= asset('img/promart-jaladores.jpg'); ?>" alt="promart">
                    <a href="http://www.promart.pe/" target="_blank"><div class="hover"><span><strong>Promart</strong></span></div></a>
                </div>
                <div class="dist">
                    <img src="<?= asset('img/la-sirena-perillas.jpg'); ?>" alt="la sirena">
                    <a href="http://www.lasirena.com.pe/" target="_blank"><div class="hover"><span><strong>La Sirena</strong></span></div></a>
                </div>
                <div class="dist">
                    <img src="<?= asset('img/castor-perillas.jpg'); ?>" alt="castor">
                    <a href="http://www.castor.pe/" target="_blank"><div class="hover"><span><strong>Castor</strong></span></div></a>
                </div>
            </div>
        </div>
    </section>
    </div>
<?php incluir('includes/footer.php') ?>