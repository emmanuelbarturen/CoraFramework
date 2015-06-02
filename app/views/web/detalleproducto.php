<?php incluir('includes/header.php') ?>
<div class="container">
    <div style="height: 40px"></div>
    <div class="row">
        <div class="col-md-7">
            <img src="<?= asset($producto['foto_url']) ?>" alt="" class="img-responsive"/>
        </div>
        <div class="col-md-5">
            <h3><?= $producto['nombre'] ?></h3>
            <p><?= $producto['descripcion'] ?></p>
            <h3>Detalles del Producto</h3>
            <ul>
                <li><strong>Ancho:</strong> <?= $producto['ancho'] ?></li>
                <li><strong>Alto:</strong> <?= $producto['alto'] ?></li>
                <li><strong>Profundo:</strong> <?= $producto['profundo'] ?></li>
                <li><strong>Estado:</strong> <?= $producto['estado']?'Disponible':'Agotado' ?></li>
                <li><strong>Material:</strong><?=Material::find($producto['material_id'])['nombre']; ?></li>
                <li><strong>Categoria:</strong> <?=Categoria::find($producto['categoria_id'])['nombre'] ?></li>
                <li><strong>SubCategoria:</strong><?=Subcategoria::find($producto['subcategoria_id'])['nombre']?></li>
            </ul>
            <button class="boton-naranja" id="btncotizar">Cotizar</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Tal vez te puedan interesar estos productos: </h3>
        </div>
        <?php foreach($relacionados as $row) : ?>
            <div class="servicio-serv">
                <img src="<?= asset($row['foto_url']); ?>" alt="servicio de cromado">
                <div class="hover-serv">
                    <div class="centra-text">
                        <h3><?=$row['nombre'] ?></h3>
                        <p><?=substr($row['descripcion'],0,30).'...'  ?></p>
                        <a href="<?=action('HomeController@producto',$row['id']) ?>" class="btn-blanco">Saber Más</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!--modal-->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
          <form action="#" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Solicitar Cotizacion</h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="panel panel-warning">
                            <div class="panel-heading ">
                                <h3 class="panel-title">Por favor ingrese sus datos:</h3>
                            </div>
                            <div class="panel-body panel-default">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="label label-primary" for="usrNombre">Nombres:</label>
                                        <input type="text" class="form-control" id="usrNombre"/>
                                    </div>
                                    <div class="col-md-6">
                                         <label class="label label-primary" for="usrMail">Email:</label>
                                        <input type="text" class="form-control" id="usrMail"/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                         <label class="label label-primary" for="usrTelefono">Telefono:</label>
                                        <input type="text" class="form-control" id="usrTelefono"/>
                                    </div>
                                    <div class="col-md-6">
                                         <label class="label label-primary" for="usrCelular">Celular:</label>
                                        <input type="text" class="form-control" id="usrCelular"/>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="panel panel-warning">
                            <div class="panel-heading ">
                                <h3 class="panel-title">Datos del Producto:</h3>
                            </div>
                            <div class="panel-body panel-default">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="label label-primary" for="nombreproducto">Producto:</label>
                                        <input type="text" class="form-control" id="nombreproducto" readonly/>
                                    </div>
                                    <div class="col-md-6">
                                         <label class="label label-primary" for="materialproducto">Material:</label>
                                        <input type="text" class="form-control" id="materialproducto" readonly/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="col-md-6"> <label class="label label-primary" for="anchoproducto">Ancho:</label>
                                        <input type="text" class="form-control" id="anchoproducto" readonly/></div>
                                        <div class="col-md-6"><label class="label label-primary" for="profundidadproducto">Profundidad:</label>
                                        <input type="text" class="form-control" id="profundidadproducto" readonly/></div>
                                    </div>
                                    <div class="col-md-6">
                                         <div class="col-md-6"> <label class="label label-primary" for="altoproducto">Alto:</label>
                                        <input type="text" class="form-control" id="altoproducto" readonly/></div>
                                        <div class="col-md-6"><label class="label label-primary" for="formaproducto">Forma:</label>
                                        <input type="text" class="form-control" id="formaproducto" readonly/></div>
                                    </div>
                                </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                        <div class="panel panel-warning">
                            <div class="panel-heading ">
                                <h3 class="panel-title">Datos del Pedido:</h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="label label-primary" for="material">Solicitar en otro Material:</label>
                                        <select name="material" id="material" class="form-control">
                                        <?php foreach($materiales as $row):?>
                                            <option value="<?=$row['id']?>"><?=$row['value']?></option>
                                        <?php endforeach; ?>
                                </select>
                                    </div>
                                    <div class="col-md-6">
                                         <label class="label label-primary" for="cantidad">Cantidad:</label>
                                        <input type="text" class="form-control" id="cantidad" required/>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning" >Enviar</button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div><!-- /.modal -->
<?php incluir('includes/footer.php') ?>