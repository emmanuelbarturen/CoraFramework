<?php
use Core\App;
/*
	emmanuelbarturen@gmail.com
	Para el correcto funcionamiento el servidor debe soportar RewriteRule,RewriteCond
	y RewriteBase para el .htaccess
*/
require_once '../app/init.php';
require_once '../vendor/autoload.php';
new App();

