<?php
require_once 'Exception.php';
use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;
/**
 * Class App
 * @package App
 */

class App
{
    protected $controller;
    protected $method ;
    protected $params = [];

    public function __construct()
    {
        $this->startVars();
        $url = $this->parseUrl();
        require_once '../app/controllers/HomeController.php';
        require_once '../app/controllers/AdminController.php';
        $objController=null;
        if (isset($url[0])) {
            if( $url[0]==getenv('ADM_NAME'))
            {
                $objController = new \AdminController();
             if(method_exists('AdminController', str_replace('-','_',$url[1])))
             {
                 $this->method = isset($url[1])?str_replace('-','_',$url[1]):'index';
                 unset($url[0]);
                 unset($url[1]);
             }
             else
                {
                    throw new Exception('el metodo '.$this->method.'  no existe pe chicho');
                }
            }
            elseif (method_exists('HomeController', str_replace('-','_',$url[0]))) {
                $objController = new \HomeController();
                $this->method = isset($url[0])?str_replace('-','_',$url[0]):'index';
                unset($url[0]);
            } else {
                throw new Exception('el metodo '.$this->method.'  no existe pe chicho, ta que estas en nada ah!! xD ');
            }
        }
        else{
            //TODO: Comprobar que controlador y metodo existan o lanzar error
            $objController = new \HomeController();
            $this->method='index';
        }

        $this->params = $url ? array_values($url) : [];
        call_user_func_array([$objController, $this->method], $this->params);
    }


    /**
     * Obtiene el url desde la carpeta public hacia adelante
     * @return array
     * @throws Exception
     */
    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }

    /**
     * Establece las variables que se encuentren en app.conf como globales para su uso en la aplicacion.
     */
    public function startVars()
    {

        $conf_file = file(__DIR__ . '/../../app.conf');
        if (!$conf_file) {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
            throw new Exception("No se encuentra archivo app.conf en la carpeta raiz pe mi querido.... mutilador de frameworks XD! ");
        }
        $env_variables = array('APP_DEBUG', 'DB_HOST', 'DB_DATABASE', 'DB_USERNAME', 'DB_PASSWORD','TIMEZONE','UPLOAD_MAX_FILESIZE','POST_MAX_SIZE','ADM_NAME','DB_MOTOR');
        foreach ($conf_file as $line) {
            $l = explode("=", $line);
            if (in_array($l[0], $env_variables)) {
                $value = trim(array_pop(explode("=", $line)));
                putenv("$l[0]=$value");
            }
        }
        $this->setConfigs();
    }

    public function setConfigs()
    {
        ini_set('date.timezone',getenv('TIMEZONE'));
        ini_set('post_max_size',getenv('POST_MAX_SIZE'));
        ini_set('upload_max_filesize',getenv('UPLOAD_MAX_FILESIZE'));
        ini_set('default_charset', 'UTF-8');
        if (getenv('APP_DEBUG') == 'true') {
            $whoops = new Run();
            $whoops->pushHandler(new PrettyPageHandler());
            $whoops->register();
            ini_set('display_errors', 1);
        } else {
            ini_set('display_errors', 0);
        }
    }
}
