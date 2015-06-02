<?php incluir('admin/includes/header.php') ?>
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>#</th>
            <th>Foto</th>
            <th>Nombre</th>
            <th>Material</th>
            <th>Forma</th>
            <th>Ancho</th>
            <th>Alto</th>
            <th>Profundo</th>
            <th>Disponible</th>
            <th>Destacado</th>
            <th>Categoria</th>
            <th>Sub Categoria</th>
            <th>Descripción</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($productos as $key=>$producto): ?>
            <tr>
                <td><?=$key+1?></td>
                <td><img class="img-responsive" style="width:70px; height:70px>" src="<?=asset($producto['foto_url'])?>"></td>
                <td><?=$producto['nombre']?></td>
                <td><?=Material::find($producto['material_id'])['nombre']; ?></td>
                <td><?=$producto['forma']?></td>
                <td><?=$producto['ancho']?></td>
                <td><?=$producto['alto']?></td>
                <td><?=$producto['profundo']?></td>
                <td><?=$producto['estado']==1?'SI':'NO'  ?></td>
                <td><?=$producto['is_destacado']==1?'SI':'NO'  ?></td>
                <td><?=Categoria::find($producto['categoria_id'])['nombre'] ?></td>
                <td><?=Subcategoria::find($producto['subcategoria_id'])['nombre']?></td>
                <td><?=$producto['descripcion']?></td>
                <td><a href="<?=action('AdminController@editarProducto',$producto['id'])?>"><button class="btn btn-primary">Editar</button></a>
                    <a href="<?=action('AdminController@eliminarProducto',$producto['id'])?>" onclick="return confirm('Seguro que desea eliminar el producto <?=$producto['nombre']?>')"><button class="btn btn-danger">Eliminar</button></a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php incluir('admin/includes/footer.php') ?>