<?php incluir('includes/header.php') ?>
    <div class="container">
        <div style="height: 30px"></div>
        <div class="top-fondo-pro">
            <div>
		<span>
			<h1>Productos</h1>
		</span>
            </div>
        </div>
        <div style="height: 30px"></div>
        <section class="cont-productos">
            <div class="cont-cont">
                <article id="contenedor-productos" class="row">
                    <ol class="breadcrumb text-left">
                        <li><a href="<?=action('HomeController@index') ?>">Home</a>
                        </li>
                        <li class="active"><?=$titulo['nombre'] ?></li>
                    </ol>
                    <?php foreach ($productos as $producto): ?>
                        <div class="col-md-4">
                            <div class="panel panel-default text-center">
                                <div class="panel-heading" style="padding: 0">
                                    <img src="<?=asset($producto['foto_url']) ?>" alt="" style="width: 100%"/>
                                </div>
                                <div class="panel-body">
                                    <h4><?=$producto['nombre'] ?></h4>
                                    <p style="overflow: hidden;"><?=$producto['descripcion'] ?></p>
                                    <a href="<?=action('HomeController@producto',$producto['id']) ?>" class="btn btn-warning">Cotizar</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                    <div class="pagination">

                    </div>
                </article>
                <aside id="menu-productos">
                    <form action="<?=action('HomeController@productos') ?>" method="post">
                        <div class="tit-menu">Productos</div>
                        <?php foreach ($categorias as $categoria): ?>
                            <div class="item-menu">
                                <span><label>
                                        <input type="checkbox" name="categoria[]"
                                               value="<?= $categoria['id'] ?>">
                                        <?= $categoria['nombre'] ?>
                                    </label>
                                    </span>
                            </div>
                        <?php endforeach ?>
                        <div class="tit-menu">Modelos</div>
                        <?php foreach ($subcategorias as $subcategoria): ?>
                            <div class="item-menu">
                                <span><label>
                                        <input type="checkbox" name="subcategoria[]"
                                               value="<?= $subcategoria['id'] ?>">
                                        <?= $subcategoria['nombre'] ?>
                                    </label>
                                    </span>
                            </div>
                        <?php endforeach ?>
                        <div class="tit-menu">Material</div>
                        <?php foreach ($materiales as $material): ?>
                            <div class="item-menu">
                                <span><label>
                                        <input type="checkbox" name="material[]"
                                               value="<?= $material['id'] ?>">
                                        <?= $material['nombre'] ?>
                                    </label></span>
                            </div>
                        <?php endforeach ?>
                        <div class="button">
                            <button class="boton-naranja">Filtrar</button>
                        </div>
                    </form>
                </aside>
            </div>
        </section>
    </div>
    <div class="consultanos">
        <div class="botn">
            <h4 class="azul">¿No encuentras lo que estás buscando?</h4>
            <a href="<?=action('HomeController@contacto') ?>"><button class="boton-naranja">Consultanos para un modelo personalizado</button></a>
        </div>
    </div>
<?php incluir('includes/footer.php') ?>