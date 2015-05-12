<?php

class Controller {

    function __construct()
    {   include_once '../app/util/Helpers.php';
        foreach (glob('../app/models/*.php') as $filename)
        {
            include $filename;
        }
    }
    public function view($view,$arr_variables=null)
    {

        if (file_exists('../app/views/'.$view.'.tpl')) {
            $smarty = new SmartyBC();
            $smarty->setCompileDir(dirname( __FILE__ ) . '/../resources/views/smarty/compiled/' );
            $smarty->setCacheDir(dirname( __FILE__ ) . '/../resources/views/smarty/cache/');
            $smarty->setTemplateDir(dirname( __FILE__ ).'/../views/');
            $smarty->caching=getenv('SMARTY_CACHE_VIEWS');
            $smarty->cache_lifetime=getenv('SMARTY_LIFETIME_CACHE_VIEWS');
            if(is_array($arr_variables))
            {
                foreach($arr_variables as $key=>$val)
                {
                    $smarty->assign($key, $val);
                }
            }
            $smarty->display($view.'.tpl');
        }
        else
        {
            throw new \Core\Exception("Oe compare como vas a llamar a la vista: $view si no existe, palta ps...");
        }
    }
}