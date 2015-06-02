<?php incluir('admin/includes/header.php') ?>
    <h2>Ficha de edición del producto </h2>
    <form action="<?= action('AdminController@updateProducto',$producto['id'])?>" method="post" enctype="multipart/form-data">
        <div class="col-md-4">
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" class="form-control" name="id" value="<?= $producto['id'] ?>" id="id" readonly>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" value="<?= $producto['nombre'] ?>" id="nombre">
            </div>
            <div class="form-group">
                <label for="material" class="label label-primary">Material</label>
                <select class="form-control" name="material" id="material">
                    <?php foreach ($materiales as $material): ?>
                        <option value="<?= $material['id'] ?>" <?= $material['id']==$producto['material_id']?'selected':'' ?>><?= $material['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="forma" class="label label-primary">Forma</label>
                <select  class="form-control" name="forma" id="forma">
                    <option value="boleado" <?=$producto['forma']=='boleado'?'selected':'' ?>>Boleado</option>
                    <option value="cuadrado" <?=$producto['forma']=='cuadrado'?'selected':'' ?>>Cuadrado</option>
                    <option value="otro>" <?=$producto['forma']=='otro'?'selected':'' ?>>Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ancho">Ancho</label>
                <input type="text" class="form-control" name="ancho" value="<?= $producto['ancho'] ?>" id="ancho">
            </div>
            <div class="form-group">
                <label for="alto">Alto</label>
                <input type="text" class="form-control" name="alto" value="<?= $producto['alto'] ?>" id="alto">
            </div>
            <div class="form-group">
                <label for="profundo">Profundo</label>
                <input type="text" class="form-control" name="profundo" value="<?= $producto['profundo'] ?>"
                       id="profundo">
            </div>
        </div>
        <div class="col-md-4">
            <div style="height: 20px"></div>
            <div class="form-group">
                <label for="estado" class="label label-primary">Disponibilidad
                    <input type="checkbox" name="estado" <?= $producto['estado'] ? 'checked' : '' ?> value="true"
                           id="estado"></label>
            </div>
            <div class="form-group">
                <label for="estado" class="label label-primary">Es un producto destacado?
                    <input type="checkbox" name="destacado" <?= $producto['is_destacado'] ? 'checked' : '' ?>
                           value="true" id="estado">Si
                </label>
            </div>
            <div class="form-group">
                <label for="categoria" class="label label-primary">Categoria</label>
                <select name="categoria" class="form-control" id="categoria">
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id'] ?>" <?= $categoria['id']==$producto['categoria_id']?'selected':'' ?>
                            ><?= $categoria['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="subcategoria" class="label label-primary">Sub Categoria</label>
                <select name="subcategoria" class="form-control" id="subcategoria">
                    <?php foreach ($subcategorias as $subcategoria): ?>
                        <option value="<?= $subcategoria['id'] ?>" <?= $subcategoria['id']==$producto['subcategoria_id']?'selected':'' ?>
                            ><?= $subcategoria['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion" class="label label-primary">Descripcion</label>
                <textarea class="form-control" name="descripcion" id="descripcion"><?= $producto['descripcion'] ?></textarea>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Modificar</button>
            </div>
        </div>
        <div class="col-md-4">
                <img class="img-responsive" src="<?= asset($producto['foto_url']) ?>" id="vistaprevia">
                <div class="form-group">
                    <label for="file">Cambiar foto</label>
                    <input type="file" name="foto" id="fotografia" title="cambiar foto">
                </div>
        </div>
    </form>
<?php incluir('admin/includes/footer.php') ?>