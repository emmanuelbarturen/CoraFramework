<?php incluir('admin/includes/header.php') ?>
<div class="col-sm-8">
    <h3>Lista categorias</h3>
    <table class="table table-bordered table-hover" >
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th class="col-xs-1">Ver</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($categorias as $key=>$categoria):?>
            <tr>
                <td><?=$key+1?></td>
                <td><?=$categoria['nombre']?></td>
                <td><a href="<?= action('AdminController@eliminarCategoria',$categoria['id'])?>"><button type="submit" class="btn btn-danger">Eliminar</button></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-sm-4">
    <h3>Agregar Categoría</h3>
    <form action="<?= action('AdminController@categoriastore')?>" method="post">
        <div class="form-group">
            <label for="nombre" class="control-label">Nombre</label>
            <input type="text" placeholder="Nombre Categoría" name="nombre" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
<hr>
<div class="col-sm-8">
    <h3>Lista Sub-Categorias</h3>
    <table class="table table-bordered table-hover" >
        <thead>
        <tr>
            <th>#</th>
            <th>Nombre</th>
            <th class="col-xs-1">Ver</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($subcategorias as $key=>$subcategoria):?>
            <tr>
                <td><?=$key+1?></td>
                <td><?=$subcategoria['nombre']?></td>
                <td><a href="<?= action('AdminController@eliminarSubcategoria',$subcategoria['id'])?>"><button type="submit" class="btn btn-danger">Eliminar</button></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-sm-4">
    <h3>Agregar Sub-Categoría</h3>
    <form action="<?= action('AdminController@subcategoriastore')?>" method="post">
        <div class="form-group">
            <label for="nombre" class="control-label">Nombre</label>
            <input type="text" placeholder="Nombre subCategoría" name="nombre" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
<hr>
<div class="col-sm-8">
    <h3>Lista Materiales</h3>
    <table class="table table-bordered table-hover" >
        <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th class="col-xs-1">Ver</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($materiales as $key=>$material):?>
            <tr>
                <td><?=$key+1?></td>
                <td><?=$material['nombre']?></td>
                <td><a href="<?= action('AdminController@eliminarMaterial',$material['id'])?>"><button type="submit" class="btn btn-danger">Eliminar</button></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<div class="col-sm-4">
    <h3>Agregar Material</h3>
    <form action="<?= action('AdminController@materialstore')?>" method="post">
        <div class="form-group">
            <label for="nombre" class="control-label">Nombre</label>
            <input type="text" placeholder="Nombre material" name="nombre" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Agregar</button>
    </form>
</div>
<?php incluir('admin/includes/footer.php') ?>