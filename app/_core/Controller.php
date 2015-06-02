<?php

class Controller {

    function __construct()
    {
        include_once '../app/util/File.php';

    }
    public function view($view,$arr_variables=null)
    {

        if (file_exists('../app/views/'.$view.'.php')) {
            if(is_array($arr_variables))
            {
                extract($arr_variables);
            }
            include_once (dirname(dirname(__FILE__)).'/views/'.$view.'.php');
        }
        else
        {
            throw new \Core\Exception("Oe compare como vas a llamar a la vista: $view si no existe, palta ps...");
        }
    }
}