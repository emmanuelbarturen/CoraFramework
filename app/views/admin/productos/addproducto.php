<?php incluir('admin/includes/header.php') ?>
    <h2>Agregar Nuevo producto</h2>
    <hr>
    <form action="<?= action('AdminController@productoStore')?>" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nombre" class="label label-primary" >Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="material" class="label label-primary">Material</label>
                <select  class="form-control" name="material" id="material">
                    <?php foreach ($materiales as $material): ?>
                        <option value="<?=$material['id']?>"><?=$material['nombre']?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="forma" class="label label-primary">Forma</label>
                <select  class="form-control" name="forma" id="forma">
                    <option value="boleado">Boleado</option>
                    <option value="cuadrado">Cuadrado</option>
                    <option value="otro>">Otro</option>
                </select>
            </div>
            <div class="form-group">
                <label for="ancho" class="label label-primary">Ancho</label>
                <input type="text" class="form-control" name="ancho" id="ancho" required>
            </div>
            <div class="form-group">
                <label for="alto" class="label label-primary">Alto</label>
                <input type="text" class="form-control" name="alto" id="alto" required>
            </div>
            <div class="form-group">
                <label for="profundo" class="label label-primary">Profundo</label>
                <input type="text" class="form-control" name="profundo" id="profundo" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group ">
                <label for="disponible" class="label label-primary">Disponible
                <input type="checkbox"  name="estado" value="true" id="disponible" ></label>
                <label for="destacado" class="label label-primary">Producto Destacado
                    <input type="checkbox"  name="destacado" value="true" id="destacado"></label>
            </div>
            <div class="form-group">
                <label for="categoria" class="label label-primary">Categoria</label>
                <select name="categoria" class="form-control" id="categoria">
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?=$categoria['id'] ?>"><?=$categoria['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>

            </div>
            <div class="form-group">
                <label for="subcategoria" class="label label-primary">Sub Categoria</label>
                <select name="subcategoria" class="form-control" id="subcategoria">
                    <?php foreach ($subcategorias as $subcategoria): ?>
                        <option value="<?=$subcategoria['id'] ?>"><?=$subcategoria['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="descripcion" class="label label-primary">Descripcion</label>
                <textarea class="form-control" name="descripcion" id="descripcion"></textarea>
            </div>
        </div>
        <div class="col-md-4 ">
            <div class="form-group">
                <label for="imagen" class="label label-primary">Seleccione una imagen</label>
                <input type="file" name="foto" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-block" >Agregar</button>
            </div>
        </div>
    </form>
<?php incluir('admin/includes/footer.php') ?>