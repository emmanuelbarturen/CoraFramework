<?php
include_once '../app/_core/Redirect.php';
use Philo\Blade\Blade;

class Controller {
    function __construct(){
        foreach (glob('../app/util/*.php') as $filename){include_once $filename;}
    }

    public function view($view,$arr_var=[]){
        $views = app_path(). 'views';
        $cache = app_path() . 'storage/cache';
        $blade = new Blade($views, $cache);
        return $blade->view()->make($view,$arr_var)->render();
    }
}