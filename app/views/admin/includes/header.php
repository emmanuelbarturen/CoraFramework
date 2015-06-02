<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Fioreza :: Admin</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:500,900,300,700,300italic,400' rel='stylesheet' type='text/css'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= asset('css/bootstrap.min.css'); ?>">
</head>
<body style="padding-top: 70px">
<header>
    <nav class="navbar navbar-header navbar-fixed-top navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="<?= action('AdminController@index') ?>" class="navbar-brand">Sistema de administración Fioreza</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="<?= action('AdminController@index') ?>">Home</a></li>
                    <li><a href="<?= action('AdminController@productos')?>">Productos</a></li>
                    <li><a href="<?= action('AdminController@addProducto')?>">Agregar Producto</a></li>
                    <li><a href="<?= action('AdminController@categorias')?>">Categorías</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div class="container">