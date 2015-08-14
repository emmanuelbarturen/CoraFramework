<?php
include_once '../app/_core/Redirect.php';
use Philo\Blade\Blade;

class Controller {
    function __construct(){
        //TODO: llamar a toda la carpeta util
        include_once '../app/util/File.php';
        include_once '../app/util/Helper.php';
        include_once '../app/util/Form.php';
    }

    public function view($view,$arr_var=[]){
        $views = app_path(). 'views';
        $cache = app_path() . 'storage/cache';
        $blade = new Blade($views, $cache);
        return $blade->view()->make($view,$arr_var)->render();
    }
}